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
                            <h4 class="header-title" style="display:flex;justify-content: space-between;align-content: space-around;">Stock List

                            </h4>
                            <br>

                            <br>
                            @if(session()->get('partner_type')=='admin' || session()->get('partner_type')=='Accounts')


                            <form method="POST" action="{{route('stock.search')}}">
                                @csrf
                                <div class="form-row">

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Warehouse</label>
                                            <select name="warehouse_id" class="form-control">
                                                @foreach ($warehouse as $key)
                                                <option {{$key->warehouse_id==$warehouse_id ? 'selected':''}} value="{{$key->warehouse_id}}">{{$key->name}}</option>

                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-1 mb-1">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Filter<span style="color:red">&#9733;</span></label>
                                            <input style="cursor: pointer;background-color:#585858;color:white" type="submit" value="Search" class="form-control">
                                        </div>
                                    </div>


                                </div>
                            </form>
                            @endif






                            <div class="table-responsive datatable-primary">
                                <table id="dataTable2" class="display" style="width:100%">
                                    <thead class="text-capitalize">
                                        <tr>
                                            <th>S.NO </th>
                                            <th>Warehouse</th>
                                            <th>Product category</th>
                                            <th>Model No</th>
                                            <th>Available Quantity</th>
                                            <th>Sold Quantity</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($serials as $key=>$vl)
                                        @php
                                        $count = DB::table('serials')->where('warehouse_id',$warehouse_id)->where('model_no',$vl->model_no)->where('status','unused')->count();
                                        $sold_count = DB::table('serials')->where('warehouse_id',$warehouse_id)->where('model_no',$vl->model_no)->where('status','used')->count();
                                        $who = DB::table('warehouses')->where('warehouse_id',$vl->warehouse_id)->first();
                                        $newPro = DB::table('gategories')->where('id',$vl->gategory_id)->first();


                                        @endphp
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$who->name}}</td>
                                            <td>{{$newPro->gategory_name}}</td>
                                            <td>{{$vl->model_no}}</td>
                                            <td>{{$count}}</td>
                                            <td>{{$sold_count}}</td>
                                            <td>{{basicDateFormat($vl->created_at)}}</td>
                                            <td class="editc">
                                                <button><i  data-placement="top" title="Serial" class="fa fa-check" data-bs-toggle="modal" data-bs-target="#exampleModal{{$vl->id}}" style="color:green"></i></button>
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


    @foreach ($serials as $key=>$vl)
    @php
    $count_list = DB::table('serials')->where('warehouse_id',$vl->warehouse_id)->where('model_no',$vl->model_no)->get();
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

                                @foreach ($count_list as $key=>$set)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>
                                        {{$set->serial_no}}
                                    </td>
                                    @if ($set->status=='unused')
                                    <td style="color:red">
                                        In Stock
                                    </td>
                                    @elseif($set->status=='transfered')
                                    <td style="color:red">
                                        Transfered
                                    </td>
                                                                        @elseif($set->status=='used')
                                                                        <td style="color:green">
                                                                            Sold

                                                                        </td>

                                    @else
                                    <td style="color:red">
                                        Pending
                                    </td>
                                    @endif

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
                    , {
                        extend: 'pdf'
                        , orientation: 'landscape',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6]
                        }
                    }
                    , {
                        extend: 'print'
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
