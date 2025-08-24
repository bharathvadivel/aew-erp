<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>

    <!--=========================*
        Met Data
        *===========================-->
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="{{asset('user/vendors/sweetalert2/js/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('user/vendors/sweetalert2/js/sweetalert2.all.min.js')}}"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">

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

        h4 {
            font-size: 15px !important;
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
                            <form method="POST" action="{{route('attendance.month.report')}}">
                                @csrf
                                <div class="form-row">
                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Employee</label>
                                            <select name="partner_id" class="form-control">



                                                <option value="all">All</option>

                                                @foreach ($users as $key)
                                                <option {{$key->partner_id==$partner_id ? 'selected':''}} value="{{$key->partner_id}}">{{$key->name}} ({{$key->partner_id}})</option>



                                                @endforeach

                                            </select>

                                        </div>
                                    </div>


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


                            <h4 class="header-title">Month Wise Attendance Report</h4>
                            <br>


                            <div class="table-responsive datatable-primary ">

                                <table id="dataTable2" class="display update_data" style="width:100%">

                                    <thead class="text-capitalize ">

                                        <tr>
                                            <th>S.NO </th>
                                            <th>Employee ID</th>
                                            <th>Employee Type</th>
                                            <th>Name </th>
                                            <th>TP</th>
                                            <th>TA</th>
                                            <th>TL</th>
                                            <th>TPL</th>
                                            <th>TH</th>
                                            <th>THP</th>
                                            <th>Total Days</th>
                                            @for ($i=01;$i<=31;$i++) <th>{{$i}}</th>
                                                @endfor
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($output as $key=>$vl)

                                        @php


                                        $datas=DB::table('attendances')
                                        ->select('partner_id',DB::raw('count(CASE
                                        WHEN status="P" THEN 0
                                        END) presents'),DB::raw('count(CASE
                                        WHEN status="A" THEN 0
                                        END) absents'),DB::raw('count(CASE
                                        WHEN status="L" THEN 0
                                        END) leaves'),DB::raw('count(CASE
                                        WHEN status="H" THEN 0
                                        END) holidays'),DB::raw('count(CASE
                                        WHEN status="PL" THEN 0
                                        END) paidleaves'),DB::raw('count(CASE
                                        WHEN status="HP" THEN 0
                                        END) halfdays'))
                                        ->where('partner_id', $vl->partner_id)
                                        ->whereMonth('date',$month)
                                        ->distinct('date')
                                        ->get();

                                        $half=$datas[0]->halfdays;
                                        $in=$half/2;
                                        $total=$datas[0]->presents+$datas[0]->holidays+$datas[0]->paidleaves+$in;

                                        @endphp
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$vl->partner_id}}</td>
                                            <td>{{$vl->partner_type}}</td>
                                            <td>{{$vl->name}}</td>
                                            <td>{{$datas[0]->presents}}</td>
                                            <td>{{$datas[0]->absents}}</td>
                                            <td>{{$datas[0]->leaves}}</td>
                                            <td>{{$datas[0]->paidleaves}}</td>
                                            <td>{{$datas[0]->holidays}}</td>
                                            <td>{{$datas[0]->halfdays}}</td>
                                            <td>{{$total}}</td>
                                            @for ($i=01;$i<=31;$i++) @php $date_ch=$year_ch.'-'.$month.'-'.$i; $ch_list=DB::table('attendances')->where('date',$date_ch)

                                                ->where('partner_id',$vl->partner_id)
                                                ->first();
                                                @endphp
                                                @if($ch_list)
                                                <td>{{$ch_list->status}}</td>
                                                @else
                                                <td>-</td>
                                                @endif

                                                @endfor






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
            $('#dataTable2').DataTable({
                dom: 'Bfrtip'
                , buttons: [{
                        extend: 'copy'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41]
                        }
                    }
                    , {
                        extend: 'csv'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41]


                        }
                    }
                    , {
                        extend: 'excel'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41]


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

    <script>
        function del(id) {
            var chs = confirm('Are you sure you want to delete this Category?');
            if (chs) {
                document.location.href = "{{url('gategory_delete')}}/" + id;
            }

        }

    </script>

    @include('logics.include.datatable')


    <!--=========================*
                                                Scripts
                                                *===========================-->


</body>
</html>
