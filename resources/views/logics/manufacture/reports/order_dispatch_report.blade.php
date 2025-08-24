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
                            <h4 class="header-title">Total Pending Orders
                            </h4>
                            <br>
                            <div class="table-responsive datatable-primary">
                                <table id="dataTable" class="text-center" style="width: 100%; border-collapse: collapse;">
                                    <thead class="text-capitalize">
                                        <tr>
                                            <th style="min-width: 250px; text-align: center; border: 1px solid #ddd; padding: 8px;font-weight:bold;" class="sticky-left">Dealers</th>
                                            @foreach ($p_models as $mod)
                                                <th style="text-align: center; min-width: 80px; border: 1px solid #ddd; padding: 8px;font-weight:bold;">{{ $mod->model_code }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($customers as $key => $customer)
                                            <tr>
                                                <td style="text-align:center; border: 1px solid #ddd; padding: 8px;">{{ $customer->customer_name }}</td>
                                                @foreach ($p_models as $mod)
                                                    @php
                                                        $total_qty = $summaryData[$customer->id][$mod->model_code] ?? 0;
                                                    @endphp
                                                    <td style="text-align: center; min-width: 80px; border: 1px solid #ddd; padding: 8px;" class="{{ $total_qty == 0 ? 'red' : 'blue' }}">{{ $total_qty }}</td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                        <tr style="background: #f5f5f5; font-weight: bold;">
                                            <th style="text-align:center; border: 1px solid #ddd; padding: 8px;font-weight:bold;">Total Pending Qty</th>
                                            @foreach ($p_models as $mod)
                                                @php
                                                    $grand_total_qty = collect($summaryData)->sum(fn($customerData) => $customerData[$mod->model_code] ?? 0);
                                                @endphp
                                                <th style="text-align: center; border: 1px solid #ddd; padding: 8px;font-weight:bold;">{{ $grand_total_qty }}</th>
                                            @endforeach
                                        </tr>
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
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'csv', 
                    },
                    {
                        extend: 'excel',
                    },
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
