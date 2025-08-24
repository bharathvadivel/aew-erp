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
                                <h4 class="header-title">Spare Parts Order list
                                </h4>
                                <br>


                                <div class="table-responsive datatable-primary">
                                    <table id="dataTable2" class="text-center boh">
                                        <thead class="text-capitalize">
                                            <tr>
                                                <th>S.NO </th>
                                                <th>Call ID</th>
                                                <th>Service ID</th>
                                                <th>Service Center Name</th>
                                                <th>Category Name</th>
                                                <th>Part Name</th>
                                                <th>Spare Model No.</th>
                                                <th>Quantity</th>
                                                <th>Price</th>
                                                <th>Total</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $var = DB::table('services')->where('service_id', $partorder->service_id)->first();
                                                $sp_model_no = json_decode($partorder->part_code);
                                                $sp_part_name = json_decode($partorder->part_name);
                                            @endphp
                                            <tr>
                                                <td>{{ 1 }}</td>
                                                <td>{{ $partorder->call_id }}</td>
                                                <td>{{ $partorder->service_id }}</td>
                                                <td>{{ $var->service_center_name }}</td>
                                                <td>{{ $gategory->gategory_name }}</td>
                                                <td>{{ $sp_part_name[0] }}</td>
                                                <td>{{ $sp_model_no[0] }}</td>
                                                <td>{{ $qty }}</td>
                                                <td>{{ $productPrice }}</td>
                                                <td>{{ $grandTotalPrice }}</td>
                                                <td>{{ basicDateFormat($partorder->created_at) }}</td>
                                                <td></td>
                                            </tr>
                                            <tfoot>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>Grand Total</td>
                                                <td>{{ $grandTotalPrice }}</td>
                                                <td></td>
                                                @if ($status=='Part(s) Approved')
                                                    @if(session()->get('partner_type')=='warehouse')
                                                        <td>
                                                            <button data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-success">Add Invoice</button>
                                                        </td>
                                                    @endif
                                                @else
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
            </div>

            <!--==================================*
                End Main Section
            *====================================-->
        </div>

        <!--=================================*
            End Main Content Section
        *===================================-->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Invoice</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @php
                            $where = DB::table('userlocations')->where('location_id',$var->location_id)->first();
                            $get_dis = DB::table('services')->where('service_id',$service_id)->first();
                            $locations = DB::table('userlocations')->where('partner_id',$service_id)->get();
                        @endphp
                        <form method="post" action="{{route('scpinvoice.partorder.store')}}">
                            @csrf
                            <!-- <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">From Address</label>
                                <select onchange="addr(this.value)" name="from_address" id="from_address" class="form-control">
                                    <option value="">Choose from address</option>
                                    @foreach ($locations as $set)
                                        <option value="{{$set->address}}">{{$set->address}}</option>
                                    @endforeach
                                </select>
                            </div> -->
                            <input type="hidden" value="{{$partorder->call_id}}" name="call_id">
                            <input type="hidden" value="{{$scp_invoice_no}}" name="scp_invoice_no">
                            <input type="hidden" value="{{$service->location_id}}" name="location_id">
                            <input type="hidden" value="{{$service->service_id}}" name="service_id">
                            <input type="hidden" value="service_center" name="partner_type">
                            <input type="hidden" value="{{$service->service_center_name}}" name="partner_name">
                            <input type="hidden" value="{{$service->phone}}" name="phone">
                            <input type="hidden" value="{{$service->address}}" name="address">
                            <input type="hidden" value="{{$where->pincode}}" name="pincode">
                            <input type="hidden" value="{{$service->city}}" name="city">
                            <input type="hidden" value="{{$service->district}}" name="district">
                            <input type="hidden" value="{{$var->location_id}}" name="sub_location_id">
                            <input type="hidden" value="{{$service->address}}" name="delivery_address">
                            <input type="hidden" value="{{$var->location_id}}" name="delivery_location_id">
                            <input type="hidden" name="state" value="{{$service->state}}">
                            <input type="hidden" name="date" value="{{date('Y-m-d')}}">
                            <input type="hidden" name="gstin_no" value="{{$get_dis->gstin_no}}">
                            <div class="mb-3">
                                <label for="by_order_no" class="col-form-label">Buyer's Order No</label>
                                <input type="text" class="form-control" name="by_order_no">
                            </div>
                            <div class="mb-3">
                                <label for="ew_bill_no" class="col-form-label">Eway Bill No</label>
                                <input type="text" class="form-control" name="ew_bill_no">
                            </div>
                            <div class="mb-3">
                                <label for="distance" class="col-form-label">Distance</label>
                                <input type="text" class="form-control" name="distance">
                            </div>
                            <div class="mb-3">
                                <label for="others" class="col-form-label">Vehicle Number/Others</label>
                                <input type="text" class="form-control" name="others">
                            </div>
                            <div class="mb-3">
                                <label for="docket_no" class="col-form-label">Docket No</label>
                                <input type="text" class="form-control" name="docket_no">
                            </div>
                            <div class="mb-3">
                                <label for="transporter_name" class="col-form-label">Transporter Name</label>
                                <input type="text" class="form-control" name="transporter_name">
                            </div>
                            <div class="mb-3">
                                <label for="additional_discount" class="col-form-label">Additional Discount</label>
                                <input type="text" class="form-control" name="additional_discount">
                            </div>

                            @php
                            
                            $product= DB::table('products')->where('id',$product->id)->first();
                            $data = DB::table('serials')->where('model_no',$partorder->model_no)->where('status','unused')->get();
                            $sp_model_no = json_decode($partorder->part_code);
                            $sp_part_name = json_decode($partorder->part_name);
                            @endphp
                            <input type="hidden" name="gategory" value="{{$gategory->gategory_name}}">
                            <input type="hidden" name="description" value="{{$sp_part_name[0]}}">
                            <input type="hidden" name="model_no" value="{{$sp_model_no[0]}}">
                            <input type="hidden" name="gst" value="{{$product->gst}}">
                            <input type="hidden" name="price" value="{{$product->mrp}}">
                            <input type="hidden" name="billing_price" value="{{$productPrice}}">
                            <input type="hidden" name="total" value="{{$grandTotalPrice}}">
                            <input type="hidden" name="ch_qty" value="{{$qty}}">
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Serial No ({{$sp_model_no[0]}},{{$sp_part_name[0]}}) <span style="color: red;">(Qty:{{$qty}})</span></label>
                                <select id="choices-multiple-remove-button{{$partorder->id}}" placeholder="Select Serial no" multiple name="serial_no" class="form-control">
                                    @foreach ($serials as $key => $vl)
                                    <option value="{{$vl->serial_no}}">{{$vl->serial_no}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="hidden" name="created_by" value="{{$login_id}}">
                            <input type="hidden" name="ch_box_status" value="ch_ked">
                            <input type="hidden" name="to_id" value="{{$service->service_id}}">

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" onclick="return check()" class="btn btn-success">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function check() {
                var ch = document.getElementById("from_address").value;
                if (ch == '') {
                    alert('Please choose from address');
                    return false;
                } else {
                    return true;
                }
            }
        </script>

        <style>
            .editc {
                display: flex;
                justify-content: space-around;

            }
        </style>
            <script>
                $(document).ready(function() {
                    var multipleCancelButton = new Choices("#choices-multiple-remove-button{{$partorder->id}}", {
                        removeItemButton: true,
                        shouldSort: false,
                        fuseOptions: {
                            threshold: 0
                        },
                    });
                });
            </script>

        <script>
            function addr(address) {
                var dis_id = $("input[name=to_id]").val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                // event.preventDefault();
                var address = address;
                $.ajax({
                    type: 'POST',
                    url: "{{ route('address_select')}}",
                    data: {
                        dis_id: dis_id,
                        address: address
                    },
                    success: function(data) {
                        var val = JSON.parse(data);
                        $('.location_id').val(val.location_id);
                    }
                });
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
