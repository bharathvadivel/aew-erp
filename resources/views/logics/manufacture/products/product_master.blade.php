<?php
ini_set('max_execution_time', 300);
?>
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
                            <h4 class="header-title">Products
                                <a href="{{ route('update.fag.stock') }}"class="btn btn-primary btns"><i class="fa fa-plus-circle"></i> Update FAG Stock </a>
                            </h4>
                            <br>

                            <div class="table-responsive datatable-primary">
                                <table id="dataTable2" class="display" style="width:100%">
                                    <thead class="text-capitalize">
                                        <tr>
                                            <th>S.No.</th>
                                            <th>model_code</th>
                                            <th>Description</th>
                                            <th>Specification</th>
                                            <th style="text-align:center;">fag_stock</th>
                                            <th style="text-align:center;">Ready To Build?</th>
                                            <th style="text-align:center;">BOM</th>
                                            <th style="text-align:center;">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($models as $key => $vl)
                                            @php
                                                // Check if the model is present in the productsCount array
                                                $readyToBuild = DB::table('materials as a')
                                                    ->select('a.total_stock_qty', 'b.min_assembly_qty_set', DB::raw('ROUND(a.total_stock_qty / b.min_assembly_qty_set) as calculated_column'))
                                                    ->join('material_compatible_models as b', 'a.material_code', '=', 'b.material_code')
                                                    ->where('b.model_code', $vl->model_code)
                                                    ->where('a.consider_build_count', 'yes')
                                                    ->orderBy('calculated_column', 'asc')
                                                    ->first();

                                                if ($readyToBuild) {
                                                    // Access the 'total_stock_qty' property
                                                    $result = $readyToBuild->calculated_column;
                                                    if($result <= 0){
                                                        $result=0;
                                                        $color = "text-align:center;font-size: 20px;color:red;cursor:pointer;border-bottom: 1px dashed red;";
                                                    } else {
                                                        $color = "text-align:center;font-size: 20px;color:blue;cursor:pointer;border-bottom: 1px dashed blue;";
                                                    }
                                                } else {
                                                    $result=0;
                                                    $color = "text-align:center;font-size: 20px;color:red;";
                                                }

                                                // Check if the model is present in the productsCount array
                                                $readyToBuildIncNO = DB::table('materials as a')
                                                    ->select('a.total_stock_qty', 'b.min_assembly_qty_set', DB::raw('ROUND(a.total_stock_qty / b.min_assembly_qty_set) as calculated_column'))
                                                    ->join('material_compatible_models as b', 'a.material_code', '=', 'b.material_code')
                                                    ->where('b.model_code', $vl->model_code)
                                                    ->orderBy('calculated_column', 'asc')
                                                    ->first();

                                                if ($readyToBuildIncNO) {
                                                    // Access the 'total_stock_qty' property
                                                    $resultNo = $readyToBuildIncNO->calculated_column;
                                                    if($resultNo <= 0){
                                                        $resultNo=0;
                                                        $colorNo = "text-align:center;font-size: 14px;color:red;cursor:pointer;border-bottom: 1px dashed red;";
                                                    } else {
                                                        $colorNo = "text-align:center;font-size: 14px;color:blue;cursor:pointer;border-bottom: 1px dashed blue;";
                                                    }
                                                } else {
                                                    $resultNo=0;
                                                    $colorNo = "text-align:center;font-size: 14px;color:red;";
                                                }

                                                $fagqty = DB::table('p_models')->where('model_code', $vl->model_code)->first();
                                                if ($fagqty->fully_assembled_qty <= 0) {
                                                    $fagcolor = "text-align:center;font-size: 20px;color:red;";
                                                } else {
                                                    $fagcolor = "text-align:center;font-size: 20px;color:blue;";
                                                }
                                            @endphp
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $vl->model_code }}</td>
                                                <td>{{ $vl->model_desc }}</td>
                                                <td>Power: {{ $vl->power }} <br> Head Range: {{ $vl->head_range }} <br> Discharge: {{ $vl->discharge }} <br> Pipe Size: {{ $vl->pipe_size }}</td>
                                                <td style="{{$fagcolor}}">{{ $fagqty->fully_assembled_qty }}</td>

                                                <!-- Modal OUTPUT for ITEMS with YES ONLY -->
                                                <td style="text-align:center;">
                                                    <a data-toggle="modal" data-target="#myModal{{ $key }}" style="{{$color}}">
                                                        <span title="Click to View Why?">{{ $result }}</span>
                                                    </a>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="myModal{{ $key }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    @php
                                                                        $materials_count = DB::table('materials as a')
                                                                            ->select(
                                                                                'a.material_code',
                                                                                DB::raw('COUNT(CASE WHEN a.consider_build_count = "yes" THEN 1 END) as count_yes'),
                                                                                DB::raw('COUNT(CASE WHEN a.consider_build_count = "no" THEN 1 END) as count_no'),
                                                                                DB::raw('COUNT(a.material_code) as total_count')
                                                                            )
                                                                            ->join('material_compatible_models as b', 'a.material_code', '=', 'b.material_code')
                                                                            ->where('b.model_code', $vl->model_code)
                                                                            ->first();
                                                                    @endphp
                                                                    <h5 class="modal-title" id="exampleModalLabel" style="text-align:left;">
                                                                        Items Stock Data
                                                                        <br/>
                                                                        <span style="font-size:12px;">Displaying Item's stock info which are considered Ready-To-Build the Model: <strong style="color:blue;font-size:14px;">{{ $vl->model_code }}</strong></span>
                                                                        <br/>
                                                                        <span style="font-size:14px;">Total Items: <span style="color:blue;font-weight:bold;">{{ $materials_count->total_count }}</span> <span style="color:#e0e0e0;">&nbsp;/&nbsp;</span> YES: <span style="color:blue;font-weight:bold;">{{ $materials_count->count_yes }}</span> <span style="color:#e0e0e0;">&nbsp;/&nbsp;</span> NO: <span style="color:red;font-weight:bold;">{{ $materials_count->count_no }}</span></span>
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
                                                                                <th style="background:#e0e0e0;border:2px solid #ABB2B9!important;">S.No.</th>
                                                                                <th style="background:#e0e0e0;border:2px solid #ABB2B9!important;">Item Code</th>
                                                                                <th style="background:#e0e0e0;border:2px solid #ABB2B9!important;">Description</th>
                                                                                <th style="text-align:center;background:#e0e0e0;border:2px solid #ABB2B9!important;">Total Stock</th>
                                                                                <th style="text-align:center;background:#e0e0e0;border:2px solid #ABB2B9!important;">Min. Assembly Qty</th>
                                                                                <th style="text-align:center;background:#e0e0e0;border:2px solid #ABB2B9!important;">Possible To Build</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody style="position:relative;padding-top: 40px;">
                                                                            @php
                                                                                $materialstocks = DB::table('materials as a')
                                                                                    ->select('a.material_code', 'a.material_desc', 'a.total_stock_qty', 'b.min_assembly_qty_set', DB::raw('ROUND(a.total_stock_qty / b.min_assembly_qty_set) as calculated_column'))
                                                                                    ->join('material_compatible_models as b', 'a.material_code', '=', 'b.material_code')
                                                                                    ->where('b.model_code', $vl->model_code)
                                                                                    ->where('a.consider_build_count', 'yes')
                                                                                    ->orderBy('calculated_column', 'asc')
                                                                                    ->get();
                                                                            @endphp
                                                                            @foreach ($materialstocks as $matkey => $vols)
                                                                                @php
                                                                                    // Access the 'calculated_column' property within the loop
                                                                                    $result = $vols->calculated_column;
                                                                                    if ($result <= 0) {
                                                                                        $result = 0;
                                                                                        $color = "text-align:center;color:red;font-weight:bold;";
                                                                                    } else {
                                                                                        $color = "text-align:center;color:blue;font-weight:bold;";
                                                                                    }
                                                                                @endphp
                                                                                <tr style="background: {{ $matkey == 0 ? '#D1FFBD' : '' }};">
                                                                                    <td>{{ $matkey + 1 }}</td>
                                                                                    <td>{{ $vols->material_code }}</td>
                                                                                    <td>{{ $vols->material_desc }}</td>
                                                                                    <td style="text-align:center;">{{ $vols->total_stock_qty }}</td>
                                                                                    <td style="text-align:center;">{{ $vols->min_assembly_qty_set }}</td>
                                                                                    <td style="{{$color}}">{{ $result }}</td>
                                                                                </tr>
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
                                                
                                                <!-- Modal OUTPUT for ITEMS with YES and NO -->
                                                <td style="text-align:center;">
                                                    <a data-toggle="modal" data-target="#myNoModal{{ $key }}" style="{{$colorNo}}">
                                                        <span title="Click to View How?">Click to View</span>
                                                    </a>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="myNoModal{{ $key }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    @php
                                                                        $materials_count = DB::table('materials as a')
                                                                            ->select(
                                                                                'a.material_code',
                                                                                DB::raw('COUNT(CASE WHEN a.consider_build_count = "yes" THEN 1 END) as count_yes'),
                                                                                DB::raw('COUNT(CASE WHEN a.consider_build_count = "no" THEN 1 END) as count_no'),
                                                                                DB::raw('COUNT(a.material_code) as total_count')
                                                                            )
                                                                            ->join('material_compatible_models as b', 'a.material_code', '=', 'b.material_code')
                                                                            ->where('b.model_code', $vl->model_code)
                                                                            ->first();
                                                                    @endphp
                                                                    <h5 class="modal-title" id="exampleModalLabel" style="text-align:left;">
                                                                        Bills of Materials
                                                                        <br/>
                                                                        <span style="font-size:12px;">Displaying list of items and stock info for the Model: <strong style="color:blue;font-size:14px;">{{ $vl->model_code }}</strong></span>
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
                                                                                <th style="background:#e0e0e0;border:2px solid #ABB2B9!important;">S.No.</th>
                                                                                <th style="background:#e0e0e0;border:2px solid #ABB2B9!important;">Item Code</th>
                                                                                <th style="background:#e0e0e0;border:2px solid #ABB2B9!important;">Description</th>
                                                                                <th style="text-align:center;background:#e0e0e0;border:2px solid #ABB2B9!important;">Total Stock</th>
                                                                                <th style="text-align:center;background:#e0e0e0;border:2px solid #ABB2B9!important;">Min. Assembly Qty</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody style="position:relative;padding-top:40px;">
                                                                            @php
                                                                                $materialstocks = DB::table('materials as a')
                                                                                    ->select('a.material_code', 'a.material_desc', 'a.total_stock_qty', 'a.consider_build_count', 'b.min_assembly_qty_set', DB::raw('ROUND(a.total_stock_qty / b.min_assembly_qty_set) as calculated_column'))
                                                                                    ->join('material_compatible_models as b', 'a.material_code', '=', 'b.material_code')
                                                                                    ->where('b.model_code', $vl->model_code)
                                                                                    ->orderBy('calculated_column', 'asc')
                                                                                    ->get();
                                                                            @endphp
                                                                            @foreach ($materialstocks as $noMatkey => $vols)
                                                                                
                                                                                <tr style="background: {{ $noMatkey == 0 ? '#D1FFBD' : '' }};">
                                                                                    <td>{{ $noMatkey + 1 }}</td>
                                                                                    <td>{{ $vols->material_code }}</td>
                                                                                    <td>{{ $vols->material_desc }}</td>
                                                                                    <td style="text-align:center;">{{ $vols->total_stock_qty }}</td>
                                                                                    <td style="text-align:center;">{{ $vols->min_assembly_qty_set }}</td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <a href="{{route('export.bom.excel',$vl->model_code)}}" class="btn btn-success"><i class="fa fa-download" style="padding:0px;"></i> Excel</a>
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>

                                                @if ($vl->status == 'Enable')
                                                    <td style="text-align:center;"><span class="badge badge-success">In Sales</span></td>
                                                @else
                                                    <td style="text-align:center;"><span class="badge badge-danger">Stopped</span></td>
                                                @endif
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
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'copy',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6]
                        }
                    },
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: [1, 4]
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6]
                        }
                    },
                    {
                        extend: 'pdf',
                        orientation: 'landscape',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6]
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
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

    <script>
        function del(id) {
            var chs = confirm('Are you sure you want to delete this Material?');
            if (chs) {
                document.location.href = "{{ url('material_delete') }}/" + id;
            }
        }
    </script>

    @include('logics.include.datatable')


    <!--=========================*
        Scripts
    *===========================-->


</body>

</html>
