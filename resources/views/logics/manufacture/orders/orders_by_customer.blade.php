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
            padding: 0.5em 0.6em;
        }

        .thdis {
            display: none;
        }

        #invDownloadOpt:after{
            content:none!important;
        }
        .red {
            color: red; /* Style for zero values */
        }
        .blue {
            color: blue; /* Style for non-zero values */
            font-weight: bold;
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
                            @php
                                $getContact = DB::table('contacts')->where('id',$id)->first();
                            @endphp
                            <h4 class="header-title">Order History by {{$getContact->customer_name}}
                                <a href="{{ route('manage.orders') }}"class="btn btn-primary btns"><i class="fa fa-th-list"></i> Order Master </a>
                                <a href="{{ route('manage.orders') }}"class="btn btn-primary btns mr-2"><i class="fa fa-th-list"></i> Manage Orders </a>
                                <a href="{{ route('add.order') }}" class="btn btn-primary btns mr-2"><i class="fa fa-plus-circle"></i> Create Order </a>
                            </h4>
                            <br>
                            <div class="table-responsive datatable-primary">
                                <table id="dataTable" class="text-center" style="width: 100%">
                                    <thead class="text-capitalize">
                                        <tr>
                                            <th style="text-align: center;">#</th>
                                            <th style="text-align: center;">Customer Name</th>
                                            <th style="text-align: center;">Order No</th>
                                            <th style="text-align: center;">Order Date</th>
                                            <th style="text-align: center;">Model Code</th>
                                            <th style="text-align: center;">Qty</th>
                                            <th style="text-align: center;">Client Note</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($invoices as $key => $vl)
                                            <tr>
                                                <td style="text-align: center;">{{$key+1}}</td>
                                                <td style="text-align: center;">{{$getContact->customer_name}}</td>
                                                <td style="text-align:center;">{{ $vl->invoice_no }}</td>
                                                <td style="text-align:center;">{{ date('d-m-Y',strtotime($vl->invoice_date)) }}</td>
                                                <td style="text-align:center;">{{ $vl->item_code }}</td>
                                                <td style="text-align:center;">{{ $vl->item_qty }}</td>
                                                <td style="text-align:center;">{{ $vl->client_note }}</td>
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
                            columns: [0, 1, 2, 3, 4, 5, 6]
                        }
                    }
                    , {
                        extend: 'csv'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6]


                        }
                    }
                    , {
                        extend: 'excel'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6]

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
