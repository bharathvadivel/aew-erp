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

        .page-item.active .page-link {
            z-index: 3;
            color: #fff !important;
            background-color: #00ACD6 !important;
            border-color: #00ACD6 !important;
            border-radius: 50%;
            padding: 6px 12px;
        }

        .page-link {
            z-index: 3;
            color: #00ACD6 !important;
            background-color: #fff;
            border-color: #007bff;
            border-radius: 50%;
            padding: 6px 12px !important;
        }

        .page-item:first-child .page-link {
            border-radius: 30% !important;
        }

        .page-item:last-child .page-link {
            border-radius: 30% !important;
        }

        .pagination li {
            padding: 3px;
        }

        .disabled .page-link {
            color: #212529 !important;
            opacity: 0.5 !important;
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

                <!-- Striped table start -->
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card_title">Collection List</h4>
                            <div class="single-table">
                                <div class="table-responsive">
                                    <table class="table table-striped text-center">
                                        <thead class="text-uppercase">
                                            <tr>
                                                <th>S.NO </th>
                                                <th>Partner Name</th>
                                                <th>Partner Type</th>
                                                <th>Credit Limit</th>
                                                <th>Available Limit</th>
                                                <th>Total Order Amount</th>
                                                <th>Total Sales Amount</th>
                                                <th>Total Return Sales Amount</th>
                                                <th>Total Collected Sales Amount</th>
                                                <th>Action</th>
                                            </tr>

                                        </thead>
                                        <tbody>
                                            @foreach ($row_direct_partner as $key => $vl)
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
                                            ->where('dis_id', $vl->partner_id)
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

                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $vl->partner_name }} ({{$vl->partner_store_name}})</td>
                                                <td>{{ $vl->partner_type }}</td>
                                                <td>{{ $list->credit_limit }}</td>
                                                <td>{{ $list->available_limit }}</td>
                                                <td>{{ $total_order }}</td>
                                                <td>{{ $total_sale_amount}}</td>
                                                <td>{{ $total_return_amount }}</td>
                                                <td>{{ $collect }}</td>

                                                <td>
                                                    <a href="{{ route('amount.collect.master', $vl->partner_id) }}"><i  data-placement="top" title="View" class="fa fa-link" style="color:#056c91;margin: 10px;"></i></a>
                                                </td>
                                            </tr>

                                            @endforeach

                                        </tbody>
                                    </table>
                                    {!! $row_direct_partner->links('pagination::bootstrap-5')!!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Striped table end -->

                <!-- Primary table -->
            </div>
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
    <script>
        $(document).ready(function() {
            $('#dataTable2').DataTable({
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
