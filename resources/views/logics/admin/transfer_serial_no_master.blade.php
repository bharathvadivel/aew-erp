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
                            <h4 class="header-title" style="display:flex;justify-content: space-between;align-content: space-around;">
                                Transfer Serial
                                No List

                                <a href="{{ route('transfer.serial.no') }}" class="btn btn-primary btns"> <i class="fa fa-plus-circle"></i> Transfer Serial No</a>
                            </h4>
                            <br>

                            <br>


                            <div class="table-responsive datatable-primary">
                                <table id="dataTable2" class="display" style="width:100%">
                                    <thead class="text-capitalize">
                                        <tr>
                                            <th>S.NO </th>
                                            <th>Transfer No</th>
                                            <th>From Warehouse</th>
                                            <th>To Warehouse</th>
                                            <th>Product category</th>
                                            <th>Model No</th>
                                            <th>Description</th>
                                            <th>Quantity</th>
                                            <th>Serial No</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($row as $key => $vl)
                                        @php
                                        $count = DB::table('transferseriallists')
                                        ->where('transfer_no', $vl->transfer_no)
                                        ->count();
                                        $from = DB::table('warehouses')
                                        ->where('warehouse_id', $vl->from_warehouse_id)
                                        ->first();
                                        $to = DB::table('warehouses')
                                        ->where('warehouse_id', $vl->to_warehouse_id)
                                        ->first();
                                        $newPro = DB::table('gategories')->where('id',$vl->gategory_id)->first();

                                        @endphp
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $vl->transfer_no }}</td>
                                            <td>{{ $from->name }}</td>
                                            <td>{{ $to->name }}</td>
                                            <td>{{ $newPro->gategory_name }}</td>
                                            <td>{{ $vl->model_no }}</td>
                                            <td>{{ $vl->description }}</td>
                                            <td>{{$count}}</td>
                                            <td> <button><i  data-placement="top" title="Serial" class="fa fa-check" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $vl->id }}" style="color:green"></i></button>
                                            </td>
                                            <td>{{basicDateFormat($vl->created_at)}}</td>
                                            <td>

                                                {{-- <a href="{{ route('transfer.serial.no.edit', $vl->id) }}"><i  data-placement="top" title="Edit" class="fa fa-edit" style="color:#056c91;"></i></a> --}}
                                                <form onsubmit="return confirm('Are you sure you want to delete?');" action="{{ route('transfer.serial.no.delete', $vl->id) }}" method="POST">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <button><i  data-placement="top" title="Delete" class="fa fa-trash" style="color:red"></i></button>
                                                </form>
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

    @foreach ($row as $key=>$vl)
    @php
    $count = DB::table('transferseriallists')
    ->where('transfer_no', $vl->transfer_no)
    ->get();
    @endphp
    <div class="modal fade" id="exampleModal{{$vl->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Serial No List</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive datatable-primary">
                        <table id="dataTables{{$vl->id}}" class="text-center boh">
                            <thead class="text-capitalize">
                                <tr>
                                    <th style="text-align:center">S.NO </th>
                                    <th style="text-align:center">Serial No</th>
                                    <th style="text-align:center">Status</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($count as $key=>$set)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>
                                        {{$set->serial_no}}
                                    </td>

                                    <td style="color:green">
                                        {{ $set->status }}
                                    </td>


                                </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#dataTables{{$vl->id}}').DataTable({
                dom: 'Bfrtip'
                , buttons: [{
                        extend: 'copy'
                        , exportOptions: {
                            columns: [0, 1, 2]
                        }
                    }
                    , {
                        extend: 'csv'
                        , exportOptions: {
                            columns: [0, 1, 2]
                        }
                    }
                    , {
                        extend: 'excel'
                        , exportOptions: {
                            columns: [0, 1, 2]
                        }
                    }



                ],

            });
        });

    </script>

    @endforeach
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
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 9]
                        }
                    }
                    , {
                        extend: 'csv'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 9]
                        }
                    }
                    , {
                        extend: 'excel'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 9]
                        }
                    }
                    , {
                        extend: 'pdf'
                        , orientation: 'landscape',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 9]
                        }
                    }
                    , {
                        extend: 'print'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 9]
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
