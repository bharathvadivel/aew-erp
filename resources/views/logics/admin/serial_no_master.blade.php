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
        .thdis {
        display: none;
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
                            <h4 class="header-title" style="display:flex;justify-content: space-between;align-content: space-around;">Purchase List
                                @if(session()->get('partner_type')!='Accounts')


                                <a href="{{ route('add_serial_no') }}" class="btn btn-primary btns"> <i class="fa fa-plus-circle"></i> Add Serial No CSV Upload</a>
                                @endif
                            </h4>
                            <br>

                            <br>
                            @if(session()->get('partner_type')=='admin' || session()->get('partner_type')=='Accounts' || session()->get('partner_type')=='factory_admin')


                            <form method="POST" action="{{route('warehouse.search')}}">
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
                                            <th>Purchase No.</th>
                                            <th>Warehouse</th>
                                            <th>Product category</th>
                                            <th>Model No</th>
                                            <th>Qty</th>
                                            <th class="thdis">GST</th>
                                            <th class="thdis">Total</th>
                                            <th>Remarks</th>
                                            <th>Date</th>

                                            @if(session()->get('partner_type')!='Accounts')
                                            <th>Action</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($serials as $key=>$vl)
                                        @php
                                        $who = DB::table('warehouses')->where('warehouse_id',$vl->warehouse_id)->first();
                                        $qty = DB::table('serials')->where('warehouse_id',$vl->warehouse_id)->where('purchase_no',$vl->purchase_no)->where('model_no',$vl->model_no)->count();
                                        $total = DB::table('serials')->where('warehouse_id',$vl->warehouse_id)->where('purchase_no',$vl->purchase_no)->where('model_no',$vl->model_no)->sum('price');


                                        $newPro = DB::table('gategories')->where('id',$vl->gategory_id)->first();

                                        @endphp
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$vl->purchase_no}}</td>
                                            <td>{{$who->name}}</td>
                                            <td>{{$newPro->gategory_name}}</td>
                                            <td>{{$vl->model_no}}</td>
                                            <td>{{$qty}}</td>
                                            <td  class="thdis">{{$vl->gst}}</td>
                                            <td  class="thdis">{{$total}}</td>
                                            <td>{{$vl->remarks}}</td>
                                            <td>{{basicDateFormat($vl->created_at)}}</td>
                                            @if(session()->get('partner_type')!='Accounts')
                                            <td class="editc">
                                                <form onsubmit="return confirm('Are you sure you want to delete?');" action="{{ route('purchase.delete')}}" method="POST">
                                                    <input type="hidden" name="purchase_no" value="{{$vl->purchase_no}}">
                                                    <input type="hidden" name="model_no" value="{{$vl->model_no}}">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <button><i  data-placement="top" title="Delete" class="fa fa-trash" style="color:red"></i></button>
                                                </form>
                                            </td>
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
                dom: 'Bfrtip'
                , buttons: [{
                        extend: 'copy'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6,7]
                        }
                    }
                    , {
                        extend: 'csv'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6,7]
                        }
                    }
                    , {
                        extend: 'excel'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6,7]
                        }
                    }
                    , {
                        extend: 'pdf'
                        , orientation: 'landscape',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6,7]
                        }
                    }
                    , {
                        extend: 'print'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6,7]
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
