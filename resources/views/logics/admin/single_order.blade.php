<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>

    <!--=========================*
        Met Data
        *===========================-->
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{asset('user/new_js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('user/new_js/jquery.js')}}"></script>
    <link rel="stylesheet" href="{{asset('user/new_css/choices.min.css')}}">
    <link rel="stylesheet" href="{{asset('user/new_css/bootstrap.min.css')}}">
    <script src="{{asset('user/vendors/sweetalert2/js/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('user/vendors/sweetalert2/js/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('user/new_js/choices.min.js')}}"></script>

    <script src="{{asset('user/new_js/bootstrap.bundle.min.js')}}"></script>



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
                            <h4 class="header-title">Order list
                            </h4>
                            <br>


                            <div class="table-responsive datatable-primary">
                                <table id="dataTable2" class="text-center boh">
                                    <thead class="text-capitalize">
                                        <tr>
                                            <th>S.NO </th>
                                            <th>Order ID</th>

                                            <th>Partner ID</th>
                                            <th>Store Name</th>
                                            <th>Credit Limit</th>
                                            <th>Available Limit</th>
                                            <th>Category name</th>
                                            <th>Description</th>
                                            <th>Model No.</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Total</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($order as $key=>$vl)
                                        @php
                                        $grand_total=$vl->grand_total;

                                        $var = DB::table('distributors')->where('partner_id',$let->partner_id)->first();

                                        @endphp
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$vl->order_id}}</td>
                                            <td>{{$let->partner_id}}</td>
                                            <td>{{$let->name}}</td>
                                            <td>{{$var->credit_limit}}</td>
                                            <td>{{$var->available_limit}}</td>
                                            <td>{{$vl->category_name}}</td>
                                            <td>{{$vl->description}}</td>
                                            <td>{{$vl->model_no}}</td>
                                            <td>{{$vl->qty}}</td>
                                            <td>{{$vl->price}}</td>
                                            <td>{{$vl->total}}</td>
                                            <td>{{basicDateFormat($vl->created_at)}}</td>
                                        </tr>
                                        @endforeach
                                    <tfoot>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>


                                        <td>Grand Total</td>
                                        <td>{{ $grand_total }}</td>
                                        @if ($status=='Pending')
                                        @if(session()->get('partner_type')=='admin' || session()->get('partner_type')=='warehouse')


                                        <td> <button data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-success">Add Invoice</button></td>



                                        @endif
                                        @else
                                        <td></td>
                                        @endif



                                    </tfoot>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Primary table -->
            </div>
            <div class="col-12 mt-4">







            </div>
        </div>

        <!--==================================*
                            End Main Section
                            *====================================-->
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Invoice</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @php
                    $where = DB::table('userlocations')->where('location_id',$let->location_id)->first();
                    $get_dis = DB::table('distributors')->where('partner_id',$let->partner_id)->first();
                    $warehouse = DB::table('warehouses')->where('warehouse_id',$let->to_id)->first();


                    @endphp
                    <form method="post" action="{{route('disinvoice.order')}}">
                        @csrf


                        <input type="hidden" name="order_id" value="{{$order_id}}">
                        <input type="hidden" value="{{$let->partner_id}}" name="dis_id">
                        <input type="hidden" value="{{$let->partner_type}}" name="partner_type">
                        <input type="hidden" value="{{$let->location_id}}" name="location_id">
                        <input type="hidden" value="{{$let->location_id}}" name="delivery_location_id">
                        <input type="hidden" name="date" value="{{date('Y-m-d')}}">
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Buyer's Order No</label>
                            <input type="text" class="form-control" name="by_order_no">
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Eway Bill No</label>
                            <input type="text" class="form-control" name="ew_bill_no">
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Vehicle Number/Others</label>
                            <input type="text" class="form-control" name="others">
                        </div>

                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Distance</label>
                            <input type="text" placeholder="In KM" class="form-control" name="distance">
                        </div>

                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Transporter ID</label>
                            <input type="text" class="form-control" name="transporter_id">
                        </div>

                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Transporter Name</label>
                            <input type="text" class="form-control" name="transporter_name">
                        </div>


                        @foreach ($order as $key=>$vl)
                        @php
                        $ch_qty= DB::table('apiorderlists')->where('id',$vl->id)->where('order_id',$order_id)->where('model_no',$vl->model_no)->sum('qty');

                        $product= DB::table('products')->where('model_no',$vl->model_no)->first();
                        $data = DB::table('serials')->where('warehouse_id',$to_id)->where('model_no',$vl->model_no)->where('status','unused')->get();

                        @endphp
                        <input type="hidden" name="apiorderlist_id[]" value="{{$vl->id}}">
                        <input type="hidden" name="model_no[]" value="{{$vl->model_no}}">
                        <input type="hidden" name="qty[]" value="{{$vl->qty}}">
                        <input type="hidden" name="price[]" value="{{$product->mrp}}">
                        <input type="hidden" name="billing_price[]" value="{{$vl->price}}">
                        <input type="hidden" name="total[]" value="{{$vl->total}}">
                        <input type="hidden" name="basic_allowance[]" value="{{$vl->basic_allowance}}">
                        <input type="hidden" name="sta[]" value="{{$vl->sta}}">
                        <input type="hidden" name="partner_allowance[]" value="0">
                        <input type="hidden" name="additional_discount[]" value="0">
                        <input type="hidden" name="ch_qty[]" value="{{$ch_qty}}">
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Serial No ({{$vl->model_no}},{{$vl->description}})(Qty:{{$vl->qty}})</label>
                            <select id="choices-multiple-remove-button{{$vl->id}}" placeholder="Select Serial no" multiple name="serial_no[{{$key}}][]" class="form-control">

                                @foreach ($data as $key => $vl)
                                <option value="{{$vl->serial_no}}">{{$vl->serial_no}}</option>

                                @endforeach

                            </select>


                        </div>

                        @endforeach
                        <input type="hidden" name="created_by" value="{{$to_id}}">
                        <input type="hidden" name="ch_box_status" value="ch_ked">
                        <input type="hidden" name="login_id" value="{{$login_id}}">


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Submit</button>

                </div>
                </form>


            </div>
        </div>
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
    @foreach ($order as $key=>$vl)
    <script>
        $(document).ready(function() {

            var multipleCancelButton = new Choices("#choices-multiple-remove-button{{$vl->id}}", {
                removeItemButton: true
                , shouldSort: false
                , fuseOptions: {
                    threshold: 0
                }

            , });


        });

    </script>
    @endforeach

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




    <script src="{{asset('user/vendors/data-table/js/jquery.dataTables.js')}}"></script>
    <script src="{{asset('user/vendors/data-table/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('user/vendors/data-table/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('user/vendors/data-table/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('user/vendors/data-table/js/responsive.bootstrap.min.js')}}"></script>

    <!-- Data table Init -->
    <script src="{{asset('user/js/init/data-table.js')}}"></script>


    <!--=========================*
                                        Scripts
                                        *===========================-->


</body>

</html>
