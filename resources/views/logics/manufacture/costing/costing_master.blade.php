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

        .dte {
            display: flex;
            flex-direction: row;
            justify-content: end;
            margin-bottom: 15px;
            flex-wrap: wrap;
            width: 100% !important;
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
            box-shadow: 0 0 4px #888;
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

            <div id="tab1Content" class="row">
                <div class="col-xl-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            
                            <div class="dts">
                                <label onClick="JavaScript:selectTab(1);" style="background: red;color:#fff;padding:10px 20px;">Materials</label>
                                <label onClick="JavaScript:selectTab(2);" style="background: #eb7b18;color:#fff;padding:10px 20px;">Products</label>
                            </div>
                            <h4 class="dte">
                                <a href="{{ route('import.costing') }}"class="btn btn-primary btns mr-2"><i class="fa fa-download"></i> Import Costing</a>
                                <a href="{{ route('costing.lock') }}"class="btn btn-primary btns mr-2"><i class="fa fa-lock"></i> Lock</a>
                            </h4>

                            <div class="table-responsive datatable-primary">
                                <table id="dataTable" style="width: 100%;text-align:center;">
                                    <thead>
                                        <tr style="text-align:center;">
                                            <th style="text-align:center;">S.No.</th>
                                            <th style="text-align:center;">tem Code</th>
                                            <th style="text-align:center;">Description</th>
                                            <th style="text-align:center;">Price</th>
                                            <th style="text-align:center;">Compared<br/>To Last Price</th>
                                            <th style="text-align:center;">How Much Vary<br/>From Last Price</th>
                                            <th style="text-align:center;">Last<br/>Pricing</th>
                                            
                                            <th style="text-align:center;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($materials as $key => $vl)
                                            @php
                                                $price = DB::table('costings')->where('item_code', $vl->material_code)->orderBy('id', 'desc')->first();
                                                $material_previous_pricing = DB::table('costings')
                                                    ->where('item_code', $vl->material_code)
                                                    ->orderBy('id', 'desc')
                                                    ->skip(1) // Skip the first row (index 0)
                                                    ->take(1) // Take only one row after skipping
                                                    ->value('pricing');
                                            @endphp
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $vl->material_code }}</td>
                                                <td>{{ $vl->material_desc }}</td>
                                                <td style="font-size:center;">{{ $price ? $price->pricing : '-' }}</td>
                                                <td>
                                                    @if($price)
                                                        @if($price->up_down_same == "Increased")
                                                            Loss
                                                        @elseif($price->up_down_same == "Decreased")
                                                            Profit
                                                        @elseif($price->up_down_same == "Same")
                                                            Same
                                                        @else
                                                            -
                                                        @endif
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($price)
                                                        @if($price->up_down_same == "Increased")
                                                            +{{ $price->how_much }}
                                                        @elseif($price->up_down_same == "Decreased")
                                                            -{{ $price->how_much }}
                                                        @else
                                                            {{ $price->how_much }}
                                                        @endif
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td>{{ $material_previous_pricing ? $material_previous_pricing : '-' }}</td>
                                                <td class="editc">
                                                    <a href="{{route('costing.edit',$vl->material_code)}}"><i  data-placement="top" title="Edit" class="fa fa-edit" style="color:#056c91"></i></a>
                                                </td>
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
                                <label onClick="JavaScript:selectTab(1);" style="background: red;color:#fff;padding:10px 20px;">Materials</label>
                                <label onClick="JavaScript:selectTab(2);" style="background: #eb7b18;color:#fff;padding:10px 20px;">Products</label>
                            </div>
                            <h4 class="dte">
                                <a href="{{ route('import.costing') }}"class="btn btn-primary btns mr-2"><i class="fa fa-download"></i> Import Costing</a>
                                <a href="{{ route('costing.lock') }}"class="btn btn-primary btns mr-2"><i class="fa fa-lock"></i> Lock</a>
                            </h4>
                            <br>

                            <div class="table-responsive datatable-primary">
                                <table id="dataTable1" style="width: 100%;text-align:center;">
                                    <thead>
                                        <tr style="text-align:center;">
                                            <th style="text-align:center;">S.No.</th>
                                            <th style="text-align:center;">Model No</th>
                                            <th style="text-align:center;">Model Name</th>
                                            <th style="text-align:center;">Description</th>
                                            <th style="text-align:center;">Price</th>
                                            <th style="text-align:center;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($models as $key => $vl)
                                            @php
                                                $suitable_materials = DB::table('material_compatible_models')->where('model_code', $vl->model_code)->get();
                                                $model_pricing = 0; // Initialize model_pricing for each model

                                                foreach ($suitable_materials as $material) {
                                                    $material_pricing = DB::table('costings')->where('item_code', $material->material_code)->orderBy('id', 'desc')->value('pricing');
                                                    if ($material_pricing !== null) {
                                                        $model_pricing += $material_pricing * $material->min_assembly_qty_set;
                                                    }
                                                }

                                                if($model_pricing <= 0){
                                                    $color = "text-align:center;font-size: 20px;color:red;cursor:pointer;border-bottom: 1px dashed red;";
                                                } else {
                                                    $color = "text-align:center;font-size: 20px;color:blue;cursor:pointer;border-bottom: 1px dashed blue;";
                                                }
                                            @endphp
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $vl->model_code }}</td>
                                                <td>{{ $vl->model_name }}</td>
                                                <td>{{ $vl->model_desc }}</td>
                                                <td style="text-align:center;">
                                                    <a data-toggle="modal" data-target="#myModal{{ $key }}" style="{{$color}}">
                                                        <span title="Click to View Why?">{{ $model_pricing }}</span>
                                                    </a>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="myModal{{ $key }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document" style="max-width:1000px !important;">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel" style="text-align:left;">
                                                                        Items Costing
                                                                    </h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="max-height: 480px;overflow-y:scroll;padding:0px 1rem 1rem 1rem;">
                                                                    <!-- Add content for your modal here -->
                                                                    <table class="table table-striped table-bordered" style="width:100%;">
                                                                        <thead class="text-capitalize" style="position:sticky;top:0;z-index: 1;">
                                                                            <tr>
                                                                                <th style="text-align:center;background:#e0e0e0;border:2px solid #ABB2B9!important;">S.No.</th>
                                                                                <th style="text-align:center;background:#e0e0e0;border:2px solid #ABB2B9!important;">Item Code</th>
                                                                                <th style="text-align:center;background:#e0e0e0;border:2px solid #ABB2B9!important;">Current<br/>Pricing</th>
                                                                                <th style="text-align:center;background:#e0e0e0;border:2px solid #ABB2B9!important;">Inequalities<br/>From Previous Price</th>
                                                                                <th style="text-align:center;background:#e0e0e0;border:2px solid #ABB2B9!important;">How Much Differs<br/>From Previous Price</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody style="position:relative;padding-top: 40px;">
                                                                            @php
                                                                                $materials = DB::table('material_compatible_models')->where('model_code', $vl->model_code)->get();
                                                                            @endphp
                                                                            @foreach ($materials as $key => $vols)
                                                                                @php
                                                                                    $costing_data = DB::table('costings')->where('item_code', $vols->material_code)->orderby('id', 'desc')->first();
                                                                                    
                                                                                @endphp
                                                                                @if($costing_data)
                                                                                    @php
                                                                                        $req_material_amount = $vols->min_assembly_qty_set * $costing_data->pricing;
                                                                                    @endphp
                                                                                    <tr>
                                                                                        <td style="text-align:center;">{{ $key + 1 }}</td>
                                                                                        <td style="text-align:center;">{{ $vols->material_code }}</td>
                                                                                        <td style="text-align:center;">{{ $req_material_amount }}</td>
                                                                                        <td style="text-align:center;">{{ $costing_data->up_down_same }}</td>
                                                                                        <td style="text-align:center;">{{ $costing_data->how_much }}</td>
                                                                                    </tr>
                                                                                @else
                                                                                    <tr>
                                                                                        <td style="text-align:center;">{{ $key + 1 }}</td>
                                                                                        <td style="text-align:center;">{{ $vols->material_code }}</td>
                                                                                        <td style="text-align:center;">0</td>
                                                                                        <td style="text-align:center;"></td>
                                                                                        <td style="text-align:center;"></td>
                                                                                    </tr>
                                                                                @endif
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="{{ route('costing.model.report', ['model_code' => $vl->model_code]) }}"><i  data-placement="top" title="Download" class="fa fa-download" style="color:#056c91"></i></a>
                                                </td>
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
            $('#dataTable').DataTable({
                dom: 'Bfrtip'
                , buttons: [{
                        extend: 'copy'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        }
                    }
                    , {
                        extend: 'csv'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]

                        }
                    }
                    , {
                        extend: 'excel'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        }
                    }
                    , {
                        extend: 'pdf'
                        , orientation: 'landscape'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        }
                    }
                    , {
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
            $('#dataTable1').DataTable({
                dom: 'Bfrtip'
                , buttons: [{
                        extend: 'copy'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        }
                    }
                    , {
                        extend: 'csv'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]

                        }
                    }
                    , {
                        extend: 'excel'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        }
                    }
                    , {
                        extend: 'pdf'
                        , orientation: 'landscape'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        }
                    }
                    , {
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
