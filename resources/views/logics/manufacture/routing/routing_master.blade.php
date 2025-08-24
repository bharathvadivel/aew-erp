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
                            <h4 class="header-title">Manage Routings
                            <a href="{{ route('import.routing') }}"class="btn btn-primary btns mr-2"><i class="fa fa-download"></i> Import Routing</a>
                            </h4>
                            <br>

                            <div class="table-responsive datatable-primary">
                                <table id="dataTable" class="display text-center" style="width: 100%;text-align:center;">
                                    <thead class="text-capitalize">
                                        <tr>
                                            <th style="text-align:center;">S.No.</th>
                                            <th style="text-align:center;">Item Code</th>
                                            <th style="text-align:center;">Item Description</th>
                                            <th style="text-align:center;">Item Group Code</th>
                                            <th style="text-align:center;">Item Group Description</th>
                                            <th style="text-align:center;">Routing Last Update</th>
                                            <th style="text-align:center;">Item Converted To</th>
                                            <th style="text-align:center;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($material as $key => $vl)
                                            @php
                                                $routing = DB::table('routings')->where('material_code', $vl->material_code)->first();
                                                $routing_detail = DB::table('routing_details')->where('material_code', $vl->material_code)->orderBy('id', 'desc')->first();
                                            @endphp
                                            <tr>
                                                <td>{{$key + 1}}</td>
                                                <td>{{$vl->material_code}}</td>
                                                <td>{{$vl->material_desc}}</td>
                                                <td>{{$vl->item_group_code}}</td>
                                                <td>{{$vl->item_group_desc}}</td>
                                                <td>
                                                    @if ($routing_detail)
                                                        Status: {{$routing_detail->status}} <br/> Remarks: {{$routing_detail->remarks}}
                                                    @else
                                                        Status: <br/> Remarks:
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($routing && $routing->converted_to_item_code != null)
                                                        {{$routing->converted_to_item_code}}
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                <td class="editc">
                                                    <a href="{{route('routing.edit', $vl->material_code)}}"><i data-placement="top" title="Edit" class="fa fa-edit" style="color:#056c91"></i></a>
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
            justify-content: center;
        }

    </style>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                dom: 'Bfrtip'
                , buttons: [{
                        extend: 'copy'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        }
                    }
                    , {
                        extend: 'csv'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]


                        }
                    }
                    , {
                        extend: 'excel'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]

                        }
                    },
                    {
                        extend: 'pdf',
                        orientation: 'landscape',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
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
