<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>

    <!--=========================*
        Met Data
    *===========================-->
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{asset('user/new_npm_css/bootstrap.min.css')}}" rel="stylesheet" crossorigin="anonymous">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('logics.include.datatabledesign')

    <!--=========================*
        Page Title
    *===========================-->
    <title>ERP</title>

    <style>
        .dts {
            display: flex;
            flex-direction: row;
            justify-content: start;
            top: 0px;
            left: 0;
            margin-bottom: 15px;
            flex-wrap: wrap;
            width: 25% !important;
        }

        .dtslable {
            color: #eb7b18;
        }

        label {
            cursor: pointer;
            font-size: 20px;
        }

        .boh {

            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            padding-bottom: 50px;
            padding-top: 50px;
        }

        i.fa {
            display: inline-block;
            border-radius: 60px;
            padding: 0.5em 0.6em;
            margin: 5px;

        }

        .status_color {
            border: 3px solid #000000;
            padding: 5px;
        }

        .btn {
            background-color: silver;
        }

        #tab1Content {
            display: block;
        }

        #tab2Content {
            display: none;
        }

        @media only screen and (min-width: 576px) {

            .modal-dialog {
                max-width: 500px !important;
                margin: 1.75rem auto;
            }
        }

        .arrow_icon {
            background: transparent !important;
        }

        .thdis {
            display: none;
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



            <div class="row" style="padding-bottom:50px">
                <div onclick="window.location.href ='{{route('invoice.master')}}'" class="col-xl-3 col-md-6 col-lg-12 stretched_card">

                    <div class="card mb-mob-4 icon_card primary_card_bg">
                        <!-- Card body -->
                        <div class="card-body">
                            <!-- Preparing to print current finalcial year -->
                            @php
                                $currentYear = date('Y');
                                $currentMonth = date('m');
                                if ($currentMonth >= 4) {
                                    $startYear = $currentYear % 100;
                                    $endYear = ($currentYear + 1) % 100;
                                } else {
                                    $startYear = ($currentYear - 1) % 100;
                                    $endYear = $currentYear % 100;
                                }
                                $financialYear = str_pad($startYear, 2, '0', STR_PAD_LEFT) . '-' . str_pad($endYear, 2, '0', STR_PAD_LEFT);
                            @endphp

                            <p class="card-title mb-0 text-white">Total Sales - {{ $financialYear }}</p>
                            <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                                <h2 class="mb-0 text-white">{{number_format($total_sold_count)}}</h2>
                                <div class="heart"><i class="fa fa-calculator"></i></div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div onclick="window.location.href ='{{route('product.master')}}'" class="col-xl-3 col-md-6 col-lg-12 stretched_card">
                    <div class="card mb-mob-4 icon_card info_card_bg">
                        <!-- Card body -->
                        <div class="card-body">
                            <p class="card-title mb-0 text-white">Total FAG Stock</p>
                            <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                                <h2 class="mb-0 text-white">{{number_format($fag_stocks)}}</h2>
                                <div class="heart"><i class="fa fa-shopping-cart"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="tab1Content" class="row">
                <div class="col-xl-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            
                            <div class="dts">
                                <label onClick="JavaScript:selectTab(1);" style="background: red;color:#fff;padding:10px 20px;">No Stock</label>
                                <label onClick="JavaScript:selectTab(2);" style="background: #eb7b18;color:#fff;padding:10px 20px;">Low Stock</label>
                            </div>
                            <br>
                            <a href="{{ route('export.no.stock.excel') }}"class="btn btn-primary"><i class="fa fa-download"></i> Export No-Stock Report</a>
                            <br><br>
                            <div class="table-responsive datatable-primary">
                                <table id="dataTable1" style="width: 100%;text-align:center;">
                                    <thead>
                                        <tr style="text-align:center;">
                                            <th style="text-align:center;">S.No.</th>
                                            <th style="text-align:center;">item_code</th>
                                            <th style="text-align:center;">description</th>
                                            <th style="text-align:center;">item_group</th>
                                            <th style="text-align:center;">total_stock_qty</th>
                                            <th style="text-align:center;">uom</th>
                                            <th style="text-align:center;">Compatible Model / Min. Assembly Qty</th>
                                            <th style="text-align:center;">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($materials as $key => $vl)
                                            @php
                                                $item_groups = DB::table('item_groups')->where('item_group_code', $vl->item_group_code)->first();
                                                
                                                $compatibleModels = DB::table('material_compatible_models')->where('material_code', $vl->material_code)->get();
                                                $compatibleModelStrings = [];

                                                foreach ($compatibleModels as $compatibleModel) {
                                                    $compatibleModelStrings[] = $compatibleModel->model_code . ' / ' . $compatibleModel->min_assembly_qty_set . ' ' .$vl->uom;
                                                }

                                                // $compatibleModelString = implode('.<br>. ', $compatibleModelStrings);
                                            @endphp
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $vl->material_code }}</td>
                                                <td>{{ $vl->material_desc }}</td>
                                                <td>{{ $vl->item_group_code }} - {{ $item_groups ? $item_groups->item_group_desc : 'N/A' }}</td>
                                                <td style="color: red;font-size: 20px; font-weight: bold;text-align:center;">
                                                    {{ $vl->total_stock_qty }}
                                                </td>
                                                <td>{{ $vl->uom }}</td>
                                                <td>
                                                    @foreach ($compatibleModelStrings as $compatibleModelString)
                                                        <p>{{ $compatibleModelString }}</p>
                                                    @endforeach
                                                </td>
                                                
                                                @if ($vl->deleted_status == 0)
                                                    <td><span class="badge badge-success">Active</span></td>
                                                @else
                                                    <td><span class="badge badge-danger">Inactive</span></td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div id="tab2Content" class="row">
                <div class="col-xl-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div class="dts">
                                <label onClick="JavaScript:selectTab(1);" style="background: red;color:#fff;padding:10px 20px;">No Stock</label>
                                <label onClick="JavaScript:selectTab(2);" style="background: #eb7b18;color:#fff;padding:10px 20px;">Low Stock</label>
                            </div>
                            <br>
                            <a href="{{ route('export.low.stock.excel') }}"class="btn btn-primary"><i class="fa fa-download"></i> Export Low-Stock Report</a>
                            <br><br>
                            <div class="table-responsive datatable-primary">
                                <table id="dataTable2" style="width: 100%;text-align:center;">
                                    <thead>
                                        <tr style="text-align:center;">
                                            <th style="text-align:center;">S.No.</th>
                                            <th style="text-align:center;">item_code</th>
                                            <th style="text-align:center;">description</th>
                                            <th style="text-align:center;">item_group</th>
                                            <th style="text-align:center;">total_stock_qty</th>
                                            <th style="text-align:center;">uom</th>
                                            <th style="text-align:center;">Compatible Model / Min. Assembly Qty</th>
                                            <th style="text-align:center;">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($material as $key => $vl)
                                            @php
                                                $item_groups = DB::table('item_groups')->where('item_group_code', $vl->item_group_code)->first();
                                                
                                                $compatibleModels = DB::table('material_compatible_models')->where('material_code', $vl->material_code)->get();
                                                $compatibleModelStrings = [];

                                                foreach ($compatibleModels as $compatibleModel) {
                                                    $compatibleModelStrings[] = $compatibleModel->model_code . ' / ' . $compatibleModel->min_assembly_qty_set . ' ' .$vl->uom;
                                                }

                                                // $compatibleModelString = implode('.<br>. ', $compatibleModelStrings);
                                            @endphp
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $vl->material_code }}</td>
                                                <td>{{ $vl->material_desc }}</td>
                                                <td>{{ $vl->item_group_code }} - {{ $item_groups ? $item_groups->item_group_desc : 'N/A' }}</td>
                                                <td style="color: red;font-size: 20px; font-weight: bold;text-align:center;">
                                                    {{ $vl->total_stock_qty }}
                                                </td>
                                                <td>{{ $vl->uom }}</td>
                                                <td>
                                                    @foreach ($compatibleModelStrings as $compatibleModelString)
                                                        <p>{{ $compatibleModelString }}</p>
                                                    @endforeach
                                                </td>
                                                
                                                @if ($vl->deleted_status == 0)
                                                    <td><span class="badge badge-success">Active</span></td>
                                                @else
                                                    <td><span class="badge badge-danger">Inactive</span></td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--==================================*
        End Main Section
    *====================================-->

    <script>
        function selectTab(tabIndex) {
            //Hide All Tabs
            document.getElementById('tab1Content').style.display = "none";
            document.getElementById('tab2Content').style.display = "none";

            //Show the Selected Tab
            document.getElementById('tab' + tabIndex + 'Content').style.display = "block";
        }
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

    <!--=========================*
        End Page Container
    *===========================-->
    <script>

        $(document).ready(function() {
            $('#dataTable1').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'copy',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        }
                    },
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]

                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        }
                    },
                    {
                        extend: 'pdf',
                        orientation: 'landscape',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        }
                    },
                    {
                        extend: 'print',
                        orientation: 'landscape',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        }
                    }
                ],
            });
        });

        $(document).ready(function() {
            $('#dataTable2').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'copy',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        }
                    },
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]

                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        }
                    },
                    {
                        extend: 'pdf',
                        orientation: 'landscape',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        }
                    },
                    {
                        extend: 'print',
                        orientation: 'landscape',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        }
                    }
                ],

            });
        });
    </script>

    @include('logics.include.datatable')


    <!--=========================*
        Scripts
    *===========================-->


</body>

</html>
