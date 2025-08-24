<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <script src="{{asset('user/new_js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('user/new_js/jquery.js')}}"></script>
    <link rel="stylesheet" href="{{asset('user/new_css/.min.css')}}">
    <link rel="stylesheet" href="{{asset('user/new_css/bootstrap.min.css')}}">
    <script src="{{asset('user/vendors/sweetalert2/js/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('user/vendors/sweetalert2/js/sweetalert2.all.min.js')}}"></script>

    <script src="{{asset('user/new_js/choices.min.js')}}"></script>

    <script src="{{asset('user/new_js/bootstrap.bundle.min.js')}}"></script>

    <!--=========================*
                Met Data
    *===========================-->
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--=========================*
              Page Title
    *===========================-->
    <title>ERP</title>

    <style>
        .extra {
            font-size: 20px;

            background-color: #ffffff;
            padding-top: 10px;
            padding-bottom: 10px;
            border-radius: 5px;

        }


        .mt-4 {
            margin-top: 0 rem !important;
        }

        .choices__inner {
            min-height: 0px !important;
            background-color: white !important;
        }

        .choices__input {
            background-color: white !important;
            padding: 0px;
        }

    </style>

</head>

<body onload="dis('{{$row->partner_id}}','{{$row->sub_location_id}}','{{$row->delivery_location_id}}'),addr('{{$row->address}}')">

    @include('logics.include.sidemenu')


    <!--==================================*
               Main Content Section
    *====================================-->
    <div class="main-content page-content">

        <!--==================================*
                   Main Section
        *====================================-->
        <div class="main-content-inner">
            <!-- <div class="row">
                  <div class="col-12 mt-4">

                            <center><h4 class="card_title extra" > Create Project </h4></center>


                </div>
            </div> -->
            @include('login.flashsearch')

            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="row">
                <!-- Disabled forms start -->
                <div class="col-12 mt-4" style="margin-top:0!important;">
                    <div class="card">
                        <div class="card-body">
                            <center>
                                <h5 class="card_title " style="color:#50aaca"> Edit Invoice
                                    <a href="{{ route('distributorinvoice.master') }}" class="btn btn-primary btns"> <i class="fa fa-plus-circle"></i>Manage invoice </a>
                                </h5>


                            </center>


                            <hr>
                            <form method="">
                                @csrf
                                <div class="form-row">

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">invoice no <span style="color:red">&#9733;</span></label>
                                            <input readonly value="{{$row->partnerinvoice_no}}" type="text" name="partnerinvoice_no" class="form-control" placeholder="Invoice no">
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-6">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Your Location <span style="color:red">&#9733;</span></label>
                                            <select readonly required="" id="from_location_id" name="from_location_id" class="form-control">
                                                <option disabled="disabled" value="">Select</option>
                                                @foreach ($userlocation as $keys)

                                                <option {{$row->from_location_id==$keys->location_id ? 'selected':'disabled="disabled"'}} value="{{ $keys->location_id }}">{{ $keys->address }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>



                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledSelect">Dealer ID <span style="color:red">&#9733;</span></label>
                                            <input readonly required="" onchange="dis(this.value)" id="dis_name" value="{{$row->partner_id}}" name="partner_id" class="form-control">
                                            <span style="font-size:13px;color:red">@if($temp) Store name:{{$temp->store_name}} @endif</span>

                                        </div>
                                    </div>

                                </div>
                                <div class="form-row">


                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Mobile Number <span style="color:red">&#9733;</span></label>
                                            <input required="" readonly onkeypress="return isNumberKey(event)" minlength="10" maxlength="10" readonly type="text" name="phone" class="form-control phone" placeholder="Mobile Number">
                                        </div>
                                    </div>
                                    <div class="col-md-2 mb-2">
                                        <div class="form-group">
                                            <label style="white-space:nowrap" for="disabledTextInput">Credit Days<span style="color:red">&#9733;</span></label>
                                            <input required="" readonly type="text" name="credit_days" class="form-control credit_days" placeholder="Days">
                                        </div>
                                    </div>

                                    <div class="col-md-2 mb-2">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Credit Limit <span style="color:red">&#9733;</span> </label>
                                            <input required="" readonly type="text" name="credit_limit" class="form-control credit_limit" placeholder="Credit Limit">
                                        </div>
                                    </div>

                                    <div class="col-md-2 mb-2">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Available Limit <span style="color:red">&#9733;</span> </label>
                                            <input required="" readonly type="text" name="available_limit" class="form-control available_limit" placeholder="Available Limit">
                                        </div>
                                    </div>


                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Gstin No </label>
                                            <input readonly type="text" name="gstin_no" class="form-control gstin_no" placeholder="Gstin NO">
                                        </div>
                                    </div>

                                    <input type="hidden" name="partner_type" class="form-control partner_type">




                                </div>


                                <div class="form-row">


                                    <div class="col-md-6 mb-6">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Billing Address (Dealer) &nbsp;&nbsp;&nbsp; <input id="same" name="ch_box_status" value="ch_ked" {{$row->ch_box_status=='ch_ked' ? 'checked' : ''}} type="checkbox">&nbsp;Same as delivery address<span style="color:red">&#9733;</span></label>
                                            <select required="" onchange="addr(this.value)" name="address" class="form-control address">
                                                <option value="">Select</option>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput"> City (Dealer) <span style="color:red">&#9733;</span></label>
                                            <input type="text" readonly name="city" class="form-control citys" placeholder="City"></input>
                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">District (Dealer) <span style="color:red">&#9733;</span></label>
                                            <input type="text" readonly name="district" class="form-control districts" placeholder="District"></input>
                                        </div>
                                    </div>
                                    <input type="hidden" readonly name="state" class="form-control states" placeholder="State"></input>
                                    <input type="hidden" readonly name="country" class="form-control countrys" placeholder="Country"></input>
                                    <input type="hidden" readonly name="pincode" class="form-control pincode" placeholder="Pincode"></input>
                                    <input type="hidden" readonly name="sub_location_id" class="form-control sub_location_id" placeholder="Sub location id"></input>
                                    <input type="hidden" readonly value="{{$row->delivery_location_id}}" name="delivery_location_id" class="form-control delivery_location_id" placeholder="Delivery location id"></input>

                                    <input type="hidden" value="{{$row->partner_name}}" id="txt" name="partner_name">
                                    <input type="hidden" value="{{$row->from_address}}" name="from_address">
                                    <input type="hidden" value="{{$row->created_by}}" id="created_by" name="created_by">

                                </div>
                                <div class="form-row">
                                    @if ($row->ch_box_status=='ch_ked')
                                    <div class="col-md-6 mb-6" style="display:none" id="delivery">

                                        @else
                                        <div class="col-md-6 mb-6" id="delivery">

                                            @endif
                                            <div class="form-group">
                                                <label for="disabledTextInput">Delivery Address</label>
                                                <select onchange="delivery(this.value)" name="delivery_address" class="form-control delivery">
                                                    <option value="">Select</option>

                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row">

                                        <div class="col-md-3 mb-3">
                                            <div class="form-group">
                                                <label for="disabledTextInput">Buyer's Order No</label>
                                                <input type="text" value="{{$row->by_order_no}}" name="by_order_no" class="form-control" placeholder="Buyer's Order No">
                                            </div>
                                        </div>


                                        <div class="col-md-3 mb-3">
                                            <div class="form-group">
                                                <label for="disabledTextInput">Date</label>
                                                <input type="date" value="{{date('Y-m-d',strtotime($row->date))}}" name="date" class="form-control" placeholder="Date">
                                            </div>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <div class="form-group">
                                                <label for="disabledTextInput">Eway Bill No</label>
                                                <input type="text" value="{{$row->ew_bill_no}}" name="ew_bill_no" class="form-control" placeholder="Eway Bill NO">
                                            </div>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <div class="form-group">
                                                <label for="disabledTextInput">Others </label>
                                                <input type="text" value="{{$row->others}}" name="others" class="form-control" placeholder="Others">
                                            </div>
                                        </div>
                                    </div>


                                    <!-- <div class="form-row">

                                    <div class="col-md-1 mb-1">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Import </label>
                                            <input checked value="csv" type="radio" name="type" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-1 mb-1">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Entry </label>
                                            <input type="radio" value="entry" name="type" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3" id="import">
                                        <div class="form-group">
                                            <label for="disabledTextInput">CSV File </label>
                                            <input required="" type="file" name="serial_no" class="form-control" placeholder="Others">
                                            <a download="" href="{{asset('user/csv/serial_format.csv')}}"><span style="font-size:12px;color:green">Download sample file</span></a>


                                        </div>
                                    </div>
                                </div> -->

                                    <div id="entry">

                                        <div class="form-row">


                                            <div class="col-md-4 mb-4">
                                                <div class="form-group">
                                                    <label for="disabledSelect">Category name <span style="color:red">&#9733;</span></label>
                                                    <select onchange="cat(this.value)" name="gategory_id" class="form-control v1 selectsearch" style="width:100%">
                                                        <option value="">Select</option>

                                                        @foreach ($gategory as $key)

                                                        <option value="{{ $key->id }}">{{ $key->gategory_name }}</option>
                                                        @endforeach


                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4 mb-4">
                                                <div class="form-group">
                                                    <label for="disabledTextInput">Model No. <span style="color:red">&#9733;</span></label>
                                                    <select onchange="cod(this.value)" name="model_no" class="form-control model_no v7 selectsearch" style="width:100%">
                                                        <option value="">Select</option>

                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4 mb-4">
                                                <div class="form-group">
                                                    <label for="disabledSelect">Product Description <span style="color:red">&#9733;</span></label>
                                                    <select onchange="product(this.value)" name="description" class="form-control description v2">
                                                        <option value="">Select</option>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">

                                            <div class="col-md-4 mb-4">
                                                <div class="form-group">
                                                    <label for="disabledTextInput">Stock <span style="color:red">&#9733;</span></label>
                                                    <input readonly type="text" name="stock" class="form-control stock v4" placeholder="Stock">

                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-4">
                                                <div class="form-group">
                                                    <label for="disabledTextInput">Price <span style="color:red">&#9733;</span></label>
                                                    <input readonly type="text" name="price" class="form-control rate v5" placeholder="Rate">

                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-4">
                                                <div class="form-group">
                                                    <label for="disabledTextInput">Billing Price <span style="color:red">&#9733;</span></label>
                                                    <input type="text" onkeypress="return isNumberKey(event)" name="billing_price" class="form-control  v6" placeholder="billing price">

                                                </div>
                                            </div>
                                        </div>



                                        <div class="form-row">

                                            <div class="col-md-12 mb-12 serial_no">
                                                <div class="form-group">
                                                    <label for="disabledSelect">Serial No. <span style="color:red">&#9733;</span></label>
                                                    <select name="serial_no[]" class="form-control">
                                                        <option value="">Select</option>

                                                    </select>
                                                </div>
                                            </div>


                                        </div>

                                        <!-- <div class="form-row">

                                        <div class="col-md-3 mb-3">
                                            <div class="form-group">
                                                <label for="disabledTextInput">Basic Allowance </label>
                                                <input readonly value="0" type="number" name="basic_allowance" class="form-control basic_allowance" placeholder="Basic Allowance">
                                                <span style="font-size:12px;color:red">Note: Enter Percentage Value</span>
                                            </div>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <div class="form-group">
                                                <label for="disabledTextInput">STA</label>
                                                <input readonly value="0" type="number" name="sta" class="form-control sta" placeholder="STA">
                                                <span style="font-size:12px;color:red">Note: Enter Amount Value</span>

                                            </div>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <div class="form-group">
                                                <label for="disabledTextInput">Direct Partner Allowance</label>
                                                <input value="0" type="number" min="0" name="partner_allowance" class="form-control" placeholder="Direct Partner Allowance">
                                                <span style="font-size:12px;color:red">Note: Enter Percentage Value</span>
                                            </div>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <div class="form-group">
                                                <label for="disabledTextInput">Addtional Discount</label>
                                                <input value="0" min="0" type="number" name="additional_discount" class="form-control" placeholder="Addtional Discount">
                                                <span style="font-size:12px;color:red">Note: Enter Amount Value</span>

                                            </div>
                                        </div>

                                    </div> -->



                                    </div>

                                    <!-- <div id="importsubmit">
                                    <center><input type="submit" name="submit" class="btn btn-primary mt-4 pl-4 pr-4">
                                    </center>
                                </div> -->

                                    <div id="entrysubmit">
                                        <center><button id="sub_load" type="submit" name="submit" class="btn btn-primary mt-4 pl-4 pr-4 btn-submit">Submit</button>
                                        </center>
                                        <div class="text-center" id="sub_spinner" style="display:none">

                                            <div style="color:#399623" class="spinner-border" role="status">
                                                <span class="visually-hidden"></span>

                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-row">
                                        <span style="color:red">&#9733;</span>
                                        <p>- Mandatory field</p>
                                    </div>

                            </form>
                        </div>
                    </div>
                </div>



                <!-- Striped table start -->
                <div class="col-lg-12 stretched_card mt-mob-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card_title"></h4>
                            <div class="single-table">
                                <div class="table-responsive">
                                    <table class="table table-striped text-center invoice">
                                        <thead class="text-uppercase">
                                            <tr>
                                                <th scope="col">S.no</th>
                                                <th scope="col">Product description</th>
                                                <th scope="col">Billing price</th>
                                                <th scope="col">Qty</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($msg as $key=>$da)
                                            @php
                                            $count = DB::table('distributorserials')->where('partnerinvoices_id','=',$da->id)->count();
                                            @endphp

                                            <tr>
                                                <td scope="row">{{ $key+1 }}</td>
                                                <td>{{$da->description}}</td>
                                                <td>{{$da->billing_price}}</td>
                                                <td>{{$count}}</td>
                                                <td>
                                                    <button onclick="remove({{$da->id}})" class="btn btn-danger"><i class="ti-trash"></i></button>
                                                </td>
                                            </tr>
                                            @endforeach

                                        </tbody>
                                        <tfoot>
                                            <tr>

                                                <td></td>
                                                <td></td>
                                                <td>Total</td>
                                                <td>{{ number_format($sum,2) }}</td>
                                                <td><a href="{{route('distributorinvoice.master')}}"><button class="btn btn-danger">Complete Invoice</button></a></td>


                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Striped table end -->

                <!-- Disabled forms end -->
                <!-- Server side start -->

                <!-- Server side end -->
            </div>
        </div>
        <!--==================================*
                   End Main Section
        *====================================-->

    </div>


    <!--=================================*
           End Main Content Section
    *===================================-->

    <!--=================================*
                  Footer Section
    *===================================-->


    <!-- <script type="text/javascript">
        $(document).ready(function() {
            $('input[type="radio"]').click(function() {
                type = $("input[name='type']:checked").val();
                if (type == 'entry') {
                    document.getElementById('entry').style.display = "block";
                    document.getElementById('import').style.display = "none";
                    document.getElementById('entrysubmit').style.display = "block";
                    document.getElementById('importsubmit').style.display = "none";
                } else {
                    document.getElementById('entry').style.display = "none";
                    document.getElementById('import').style.display = "block";
                    document.getElementById('entrysubmit').style.display = "none";
                    document.getElementById('importsubmit').style.display = "block";

                }
            });
        });
    </script> -->



    <script>
        $(function() {
            $("#dis_name").on("change", function() {
                var option_attribute = $('option:selected', this).attr('data-id');
                $("#txt").val(option_attribute);
            });
        });

    </script>
    <footer>
        @include('logics.include.footer_select')


    </footer>
    <!--=================================*
                End Footer Section
    *===================================-->

    </div>

    <!--=========================*
        End Page Container
*===========================-->


    <!--=========================*
        General Scripts
*===========================-->
    <script>
        $(document).ready(function() {
            $('input[type="checkbox"]').click(function() {
                delivery_type = $('#same').is(':checked');
                if (delivery_type) {
                    document.getElementById('delivery').style.display = "none";
                } else {
                    document.getElementById('delivery').style.display = "block";

                }
            });
        });

    </script>

    <script>
        function remove(id, partnerinvoice_no) {
            var confs = confirm('Are you sure you want to Delete?');
            if (confs == false) {
                return false;
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // event.preventDefault();
            $.ajax({
                type: 'POST'
                , url: "{{ route('distributorinvoice.remove')}}"
                , data: {
                    id: id
                    , partnerinvoice_no: partnerinvoice_no
                }
                , success: function(data) {
                    var n_val = JSON.parse(data);
                    swal({
                        type: "error"
                        , title: "Warning!"
                        , text: n_val.n_out
                        , confirmButtonText: "Ok"
                        , buttonsStyling: !1
                        , confirmButtonClass: "btn btn-danger"
                    });
                    $('.invoice').html(n_val.output);

                },

                error: function(data) {
                    swal({
                        type: "error"
                        , title: "Error!"
                        , text: "Something went wrong!"
                        , confirmButtonText: "Dismiss"
                        , buttonsStyling: !1
                        , confirmButtonClass: "btn btn-danger"
                    })
                }
            , });


        }

    </script>




    <script>
        function dis(dis_id, sub_location_id, delivery_location_id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // event.preventDefault();
            var dis_id = dis_id;
            var location_id = sub_location_id;
            var delivery_location_id = delivery_location_id;

            $.ajax({
                type: 'POST'
                , url: "{{ route('dis_select_edit')}}"
                , data: {
                    dis_id: dis_id
                    , location_id: location_id
                    , delivery_location_id: delivery_location_id
                }
                , success: function(data) {
                    var val = JSON.parse(data);
                    $('.phone').val(val.phone);
                    $('.credit_limit').val(val.credit_limit);
                    $('.available_limit').val(val.available_limit);
                    $('.states').val(val.state);
                    $('.countrys').val(val.country);
                    $('.address').html(val.output);
                    $('.delivery').html(val.delivery);
                    $('.gstin_no').val(val.gstin_no);
                    $('.credit_days').val(val.credit_days);
                    $('.partner_type').val(val.partner_type);

                }
            });


        }

    </script>

    <script>
        function addr(address) {

            var dis_id = $("input[name=partner_id]").val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // event.preventDefault();
            var address = address;
            $.ajax({
                type: 'POST'
                , url: "{{ route('address_select')}}"
                , data: {
                    dis_id: dis_id
                    , address: address
                }
                , success: function(data) {
                    var val = JSON.parse(data);

                    $('.citys').val(val.city);
                    $('.districts').val(val.district);
                    $('.pincode').val(val.pincode);
                    $('.sub_location_id').val(val.location_id);



                }
            });


        }

    </script>

    <script>
        function delivery(address) {

            var dis_id = $("select[name=dis_id]").val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // event.preventDefault();
            var address = address;
            $.ajax({
                type: 'POST'
                , url: "{{ route('address_select')}}"
                , data: {
                    dis_id: dis_id
                    , address: address
                }
                , success: function(data) {
                    var val = JSON.parse(data);
                    $('.delivery_location_id').val(val.location_id);

                }
            });


        }

    </script>

    <script>
        function cat(gategory_id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            event.preventDefault();

            $.ajax({
                type: 'POST'
                , url: "{{ route('model.select')}}"
                , data: {
                    gategory_id: gategory_id
                }
                , success: function(data) {
                    $('.model_no').html(data);


                }
            });


        }

    </script>

    <script>
        function cod(model_no) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            event.preventDefault();

            $.ajax({
                type: 'POST'
                , url: "{{ route('product.select.description')}}"
                , data: {
                    model_no: model_no
                }
                , success: function(data) {
                    $('.description').html(data);

                }
            });


        }

    </script>

    <script>
        function product(description) {
            var dis = document.getElementById("created_by").value;
            if (dis == '') {
                alert('Please Choose Sub dealer');
                return false;
            }

            var from_location_id = document.getElementById("from_location_id").value;
            if (from_location_id == '') {
                alert('Please Choose your location');
                return false;
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            event.preventDefault();
            $.ajax({
                type: 'POST'
                , url: "{{ route('product_select_sub')}}"
                , data: {
                    description: description
                    , from_location_id: from_location_id
                    , dis: dis
                }
                , success: function(data) {
                    var val = JSON.parse(data);
                    $('.serial_no').html(val.output);
                    $('.rate').val(val.price);
                    $('.stock').val(val.stock);
                    // $('.sta').val(val.sta);
                    // $('.basic_allowance').val(val.basic_allowance);
                    // $('.billing_price').val(val.billing_price);


                }
                , error: function(data) {
                    swal({
                        type: "error"
                        , title: "Error!"
                        , text: "Stock not available!"
                        , confirmButtonText: "Dismiss"
                        , buttonsStyling: !1
                        , confirmButtonClass: "btn btn-danger"
                    });
                    $('.v1').val('');
                    $('.v2').val('');
                    $('.v4').val('');
                    $('.v5').val('');
                    $('.v6').val('');
                    $('.v7').val('');
                }
            , });


        }

    </script>


    <script type="text/javascript">
        $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

        });



        $(".btn-submit").click(function(e) {

            document.getElementById('sub_load').disabled = true;
            $("#sub_load").hide();
            document.getElementById('sub_spinner').style.display = "block";


            e.preventDefault();


            var stock = $("input[name=stock]").val();

            if (stock <= 0) {
                swal({
                    type: "error"
                    , title: "Error!"
                    , text: "Stock is below 0 !"
                    , confirmButtonText: "Dismiss"
                    , buttonsStyling: !1
                    , confirmButtonClass: "btn btn-danger"
                });
                document.getElementById('sub_load').disabled = false;
                $("#sub_load").show();
                document.getElementById('sub_spinner').style.display = "none";

                return false;
            }

            var partnerinvoice_no = $("input[name=partnerinvoice_no]").val();

            var partner_name = $("input[name=partner_name]").val();
            var partner_id = $("input[name=partner_id]").val();


            var phone = $("input[name=phone]").val();

            var credit_limit = $("input[name=credit_limit]").val();
            var available_limit = $("input[name=available_limit]").val();
            var credit_days = $("input[name=credit_days]").val();
            var partner_type = $("input[name=partner_type]").val();

            var address = $("select[name=address]").val();

            if (address == '') {
                swal({
                    type: "error"
                    , title: "Error!"
                    , text: "Please choose address"
                    , confirmButtonText: "Dismiss"
                    , buttonsStyling: !1
                    , confirmButtonClass: "btn btn-danger"
                });
                document.getElementById('sub_load').disabled = false;
                $("#sub_load").show();
                document.getElementById('sub_spinner').style.display = "none";

                return false;
            }


            var pincode = $("input[name=pincode]").val();

            var city = $("input[name=city]").val();

            var district = $("input[name=district]").val();

            if (city == '' || district == '') {
                swal({
                    type: "error"
                    , title: "Error!"
                    , text: "Please choose city and district"
                    , confirmButtonText: "Dismiss"
                    , buttonsStyling: !1
                    , confirmButtonClass: "btn btn-danger"
                });
                document.getElementById('sub_load').disabled = false;
                $("#sub_load").show();
                document.getElementById('sub_spinner').style.display = "none";

                return false;
            }

            var state = $("input[name=state]").val();

            var country = $("input[name=country]").val();
            var sub_location_id = $("input[name=sub_location_id]").val();



            var by_order_no = $("input[name=by_order_no]").val();

            var date = $("input[name=date]").val();

            var ew_bill_no = $("input[name=ew_bill_no]").val();

            var others = $("input[name=others]").val();

            var gstin_no = $("input[name=gstin_no]").val();


            var gategory_id = $("select[name=gategory_id]").val();

            var description = $("select[name=description]").val();
            var serial_no = [];
            $(".serial_no :selected").each(function() {
                serial_no.push(this.value);
            });



            var price = $("input[name=price]").val();
            var billing_price = $("input[name=billing_price]").val();

            if (billing_price == '') {
                swal({
                    type: "error"
                    , title: "Error!"
                    , text: "Please enter billing price"
                    , confirmButtonText: "Dismiss"
                    , buttonsStyling: !1
                    , confirmButtonClass: "btn btn-danger"
                });
                document.getElementById('sub_load').disabled = false;
                $("#sub_load").show();
                document.getElementById('sub_spinner').style.display = "none";

                return false;
            }
            // var basic_allowance = $("input[name=basic_allowance]").val();

            // var sta = $("input[name=sta]").val();

            // var partner_allowance = $("input[name=partner_allowance]").val();

            // var additional_discount = $("input[name=additional_discount]").val();
            var created_by = $("input[name=created_by]").val();

            var model_no = $("select[name=model_no]").val();
            var from_address = $("input[name=from_address]").val();
            var from_location_id = $("select[name=from_location_id]").val();


            var same = $('#same').is(':checked');
            if (same) {
                var delivery_address = $("select[name=address]").val();
                var delivery_location_id = $("input[name=sub_location_id]").val();
                var ch_box_status = 'ch_ked';
            } else {
                var delivery_address = $("select[name=delivery_address]").val();
                var delivery_location_id = $("input[name=delivery_location_id]").val();
                var ch_box_status = 'un_ch_ked';

            }

            if (serial_no.length <= 0 || delivery_address == '' || delivery_location_id == '' || partnerinvoice_no == '' || available_limit == '' || credit_limit == '' || partner_name == '' || partner_id == '' || phone == '' || credit_days == '' || partner_type == '' || pincode == '' || state == '' || country == '' || sub_location_id == '' || gategory_id == '' || description == '' || price == '' || billing_price == '' || created_by == '' || model_no == '' || from_address == '' || from_location_id == '') {
                swal({
                    type: "error"
                    , title: "Error!"
                    , text: "Please fill required fileds some fileds are missing"
                    , confirmButtonText: "Dismiss"
                    , buttonsStyling: !1
                    , confirmButtonClass: "btn btn-danger"
                });
                document.getElementById('sub_load').disabled = false;
                $("#sub_load").show();
                document.getElementById('sub_spinner').style.display = "none";

                return false;
            }


            $.ajax({

                type: 'POST',

                url: "{{ route('distributorinvoice.update') }}",

                data: {
                    partnerinvoice_no: partnerinvoice_no
                    , partner_name: partner_name
                    , partner_id: partner_id
                    , phone: phone
                    , credit_limit: credit_limit
                    , credit_days: credit_days
                    , partner_type: partner_type
                    , available_limit: available_limit
                    , address: address
                    , pincode: pincode
                    , city: city
                    , district: district
                    , state: state
                    , country: country
                    , sub_location_id: sub_location_id
                    , by_order_no: by_order_no
                    , date: date
                    , ew_bill_no: ew_bill_no
                    , others: others
                    , gstin_no: gstin_no
                    , gategory_id: gategory_id
                    , description: description
                    , serial_no: serial_no
                    , stock: stock
                    , price: price
                    , billing_price: billing_price
                    , created_by: created_by
                    , model_no: model_no
                    , from_address: from_address
                    , from_location_id: from_location_id
                    , delivery_address: delivery_address
                    , delivery_location_id: delivery_location_id
                    , ch_box_status: ch_box_status
                , }
                , success: function(data) {
                    var res = JSON.parse(data);
                    if (res.status == true) {
                        swal({
                            type: "success"
                            , title: "Success"
                            , text: res.message
                            , buttonsStyling: !1
                            , confirmButtonClass: "btn btn-success"
                        });
                        $('.invoice').html(res.output);
                        $('.v1').val('');
                        $('.v2').val('');
                        $('.v4').val('');
                        $('.v5').val('');
                        $('.v6').val('');
                        $('.v7').val('');


                        ser = "<div class='form-group'><label for='disabledSelect'>Serial No</label> <select name='serial_no[]' class='form-control'><option value=''>Select</option></select></div>";
                        $('.serial_no').html(ser);

                    } else {
                        swal({
                            type: "error"
                            , title: "Error!"
                            , text: res.message
                            , confirmButtonText: "Dismiss"
                            , buttonsStyling: !1
                            , confirmButtonClass: "btn btn-danger"
                        });
                        $('.v1').val('');
                        $('.v2').val('');
                        $('.v4').val('');
                        $('.v5').val('');
                        $('.v6').val('');
                        $('.v7').val('');


                        ser = "<div class='form-group'><label for='disabledSelect'>Serial No</label> <select name='serial_no[]' class='form-control'><option value=''>Select</option></select></div>";
                        $('.serial_no').html(ser);
                    }
                    document.getElementById('sub_load').disabled = false;
                    $("#sub_load").show();
                    document.getElementById('sub_spinner').style.display = "none";


                }
                , error: function(data) {
                    swal({
                        type: "error"
                        , title: "Error!"
                        , text: "Please fill required fileds!"
                        , confirmButtonText: "Dismiss"
                        , buttonsStyling: !1
                        , confirmButtonClass: "btn btn-danger"
                    });
                    $('.v1').val('');
                    $('.v2').val('');
                    $('.v4').val('');
                    $('.v5').val('');
                    $('.v6').val('');
                    $('.v7').val('');


                    ser = "<div class='form-group'><label for='disabledSelect'>Serial No</label> <select name='serial_no[]' class='form-control'><option value=''>Select</option></select></div>";
                    $('.serial_no').html(ser);
                    document.getElementById('sub_load').disabled = false;
                    $("#sub_load").show();
                    document.getElementById('sub_spinner').style.display = "none";

                },

            });



        });

    </script>
</body>

</html>
