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
                            <h4 class="header-title">Bill of Materials
                                <a href="{{ route('material.list.qty.import') }}"class="btn btn-primary btns "><i class="fa fa-pencil"></i> Update Qty</a>
                                <a href="{{ route('material.list.import') }}"class="btn btn-primary btns mr-2"><i class="fa fa-download"></i> Import Items</a>
                                <a href="{{ route('add.material') }}"class="btn btn-primary btns mr-2"><i class="fa fa-plus-circle"></i> Add Item</a>
                            </h4>
                            <br>


                            <div class="table-responsive datatable-primary">
                                <table id="dataTable2" class="display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>S.No.</th>
                                            <th>item_code</th>
                                            <th>description</th>
                                            <th>item_group_code</th>
                                            <th>item_group_description</th>
                                            <th>category</th>
                                            <th>total_stock_qty</th>
                                            <th>uom</th>
                                            <th>consider_build_count</th>
                                            <th>Compatible Model / Min. Assembly Qty</th>
                                            <th>Status</th>
                                            <th>Action</th>
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
                                                $compatibleModelString = implode('<br/>', $compatibleModelStrings);
                                                // $compatibleModelString = implode('.<br>. ', $compatibleModelStrings);
                                            @endphp
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $vl->material_code }}</td>
                                                <td>{{ $vl->material_desc }}</td>
                                                <td>{{ $vl->item_group_code }}</td>
                                                <td>{{ $item_groups ? $item_groups->item_group_desc : 'N/A' }}</td>
                                                <td>{{ $vl->category }}</td>
                                                <td>{{ $vl->total_stock_qty }}</td>
                                                <td>{{ $vl->uom }}</td>
                                                <td>{{ $vl->consider_build_count }}</td>
                                                <td>{!! $compatibleModelString !!}</td>
                                                
                                                @if ($vl->deleted_status == 0)
                                                    <td><span class="badge badge-success">Active</span></td>

                                                    <td class="editc">
                                                        <a href="{{ url('material_edit/' . $vl->id) }}"><i data-placement="top" title="Edit" class="fa fa-edit" style="color:#056c91"></i></a>
                                                        &nbsp;&nbsp;
                                                        <a onclick="return del('{{ $vl->id }}');"><i data-placement="top" title="Delete" class="fa fa-trash" style="color:red"></i></a>
                                                    </td>
                                                @else
                                                    <td><span class="badge badge-danger">Inactive</span></td>

                                                    <td></td>
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
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        }
                    },
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5, 6, 7, 8]
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5, 6, 7, 8, 9]
                        }
                    },
                    {
                        extend: 'pdf',
                        orientation: 'landscape',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                        }
                    },
                    {
                        extend: 'print',
                        orientation: 'landscape',
                        exportOptions: {
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
