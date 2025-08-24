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
                            <h4 class="header-title">Dispatch Master
                                <a href="{{ route('manage.dispatch') }}"class="btn btn-primary btns"><i class="fa fa-th-list"></i> Manage Dispatch </a>
                                <a href="{{ route('add.dispatch') }}" class="btn btn-primary btns mr-2"><i class="fa fa-plus-circle"></i> Create Dispatch </a>
                            </h4>
                            <br>
                            <div class="table-responsive datatable-primary">
                                <table id="dataTable" class="text-center" style="width: 100%">
                                    <thead class="text-capitalize">
                                        <tr>
                                            <th style="min-width: 250px; text-align: center;" class="sticky-left">Dealers</th>
                                            @foreach ($p_models as $mod)
                                                <th style="text-align: center; min-width: 80px;">{{ $mod->model_code }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($customers as $key => $customer)
                                            <tr>
                                                <td style="text-align:center;">
                                                    <a href="{{route('dispatch.by.customer.id',$customer->id)}}" style="text-align:center;font-weight: bold;color:blue;cursor:pointer;border-bottom: 1px dashed grey;">
                                                        <span title="Click to View Why?">{{ $customer->customer_name }}</span>
                                                    </a>
                                                </td>
                                                @foreach ($p_models as $mod)
                                                    @php
                                                        $total_qty = $summaryData[$customer->id][$mod->model_code] ?? 0;
                                                    @endphp
                                                    <td style="text-align: center; min-width: 80px;" class="{{ $total_qty == 0 ? 'red' : 'blue' }}">{{ $total_qty }}</td>
                                                @endforeach
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
