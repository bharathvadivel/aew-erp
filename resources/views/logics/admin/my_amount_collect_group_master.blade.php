<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>

    <!--=========================*
        Met Data
        *===========================-->
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('logics.include.datatabledesign')

    <!--=========================*
            Page Title
            *===========================-->
    <title>ERP</title>

    <style>
        .boh {

            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);


            padding-bottom: 50px;
            padding-top: 50px;
        }

        i.fas {
            display: inline-block;
            border-radius: 60px;
            box-shadow: 0 0 4px #888;
            padding: 0.5em 0.6em;

        }

        @media (min-width: 576px) {
            .modal-dialog {
                max-width: 500px !important;
                margin: 1.75rem auto;
            }

            .row {
                justify-content: flex-end;
            }
        }

    </style>
</head>

<body>

    @include('logics.include.sidemenu')

    <!--==================================*
                Main Content Section
                *====================================-->
    <div class="main-content page-content">

        <!--==================================*
                        Main Section
                        *====================================-->
        <div class="main-content-inner">
            @include('login.flash')

            <div class="row">
                <!-- Primary table -->
                <div class="col-12 mt-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title" style="display:flex;justify-content: space-between;align-content: space-around;">
                                Collection List

                            </h4>
                            <form method="POST" action="{{route('my.amount.collect.group.master')}}">
                                @csrf
                                <div class="form-row">



                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Year<span style="color:red">&#9733;</span></label>
                                            <select required="" class="form-control" name="year">

                                                @for ($year = date('Y'); $year > date('Y') - 10; $year--)
                                                <option {{$year==$year_ch ? 'selected' : ''}} value="{{$year}}">
                                                    {{$year}}
                                                </option>
                                                @endfor

                                            </select>



                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Month<span style="color:red">&#9733;</span></label>
                                            <select required="" class="form-control" name="month" id="month">


                                                <option {{$month=='01' ? 'selected' : ''}} value="01">January</option>
                                                <option {{$month=='02' ? 'selected' : ''}} value="02">February</option>
                                                <option {{$month=='03' ? 'selected' : ''}} value="03">March</option>
                                                <option {{$month=='04' ? 'selected' : ''}} value="04">April</option>
                                                <option {{$month=='05' ? 'selected' : ''}} value="05">May</option>
                                                <option {{$month=='06' ? 'selected' : ''}} value="06">June</option>
                                                <option {{$month=='07' ? 'selected' : ''}} value="07">July</option>
                                                <option {{$month=='08' ? 'selected' : ''}} value="08">August</option>
                                                <option {{$month=='09' ? 'selected' : ''}} value="09">September</option>
                                                <option {{$month=='10' ? 'selected' : ''}} value="10">October</option>
                                                <option {{$month=='11' ? 'selected' : ''}} value="11">November</option>
                                                <option {{$month=='12' ? 'selected' : ''}} value="12">December</option>

                                            </select>


                                        </div>
                                    </div>



                                    <div class="col-md-1 mb-1">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Filter<span style="color:red">&#9733;</span></label>
                                            <input style="cursor: pointer;background-color:#585858;color:white" type="submit" value="Search" class="form-control">




                                        </div>
                                    </div>


                                </div>
                            </form>


                            <div class="table-responsive datatable-primary">
                                <table id="dataTable" class="text-center boh">
                                    <thead class="text-capitalize">
                                        <tr>
                                            <th>S.NO </th>
                                            <th>Party name</th>
                                            <th>Sales</th>
                                            <th>Collection</th>
                                            <th>Outstanding</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($row as $key => $vl)
                                        @php
                                        $total_sale_amount=0;
                                        $total_return_amount=0;
                                        @endphp
                                        @if ($vl->partner_type=='sub_dealer')
                                        @php
                                        $total_sale_amount = DB::table('distributorinvoices')
                                        ->where('partner_id', $vl->partner_id)
                                        ->sum('grand_total');
                                        $total_return_amount = DB::table('dealersalereturns')
                                        ->where('partner_id', $vl->partner_id)
                                        ->where('status','Complete')
                                        ->sum('grand_total');
                                        @endphp
                                        @else
                                        @php
                                        $total_sale_amount = DB::table('disinvoices')
                                        ->where('dis_id',$vl->partner_id)
                                        ->sum('grand_total');
                                        $total_return_amount = DB::table('salereturns')
                                        ->where('dis_id', $vl->partner_id)
                                        ->where('status','Complete')
                                        ->sum('grand_total');
                                        @endphp
                                        @endif

                                        @php
                                        $collect = DB::table('amountcollects')
                                        ->where('partner_id', $vl->partner_id)
                                        ->where('payment_status','Success')
                                        ->sum('amount');

                                        $list = DB::table('distributors')
                                        ->where('partner_id', $vl->partner_id)
                                        ->first();

                                        $total_order = DB::table('apiorders')
                                        ->where('partner_id', $vl->partner_id)
                                        ->sum('grand_total');
                                        @endphp
                                        @php
                                        $outstanding=$total_sale_amount-$collect;
                                        @endphp

                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{$vl->partner_store_name}}-({{ $vl->partner_id }})</td>
                                            <td>{{ $total_sale_amount}}</td>
                                            <td>{{ $collect }}</td>
                                            <td>{{ $outstanding }}</td>
                                            <td>
                                                <a href="{{ route('my.amount.collect.master', $vl->partner_id) }}"><i data-placement="top" title="View" class="fa fa-link" style="color:#056c91;margin: 10px;"></i></a>
                                            </td>
                                        </tr>

                                        @endforeach


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Primary table -->
            </div>
        </div>
        <!--==================================*
                                End Main Section
                                *====================================-->
    </div>
    <!--=================================*
                                End Main Content Section
                                *===================================-->


    <style>
        .editc {
            display: flex;
            justify-content: space-around;

        }

    </style>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                dom: 'Bfrtip'
                , buttons: [{
                        extend: 'copy'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                        }
                    }
                    , {
                        extend: 'csv'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]


                        }
                    }
                    , {
                        extend: 'excel'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]

                        }
                    }


                ],

            });
        });

    </script>

    <!--=================================*
                                    Footer Section
                                    *===================================-->
    <footer>
        @include('logics.include.footer')
    </footer>
    <!--=================================*
                                        End Footer Section
                                        *===================================-->

    </div>
    <!--=========================*
                                        End Page Container
                                        *===========================-->




    @include('logics.include.datatable')



    <!--=========================*
                                            Scripts
                                            *===========================-->


</body>

</html>
