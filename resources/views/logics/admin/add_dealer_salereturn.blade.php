<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <script src="{{asset('user/new_js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('user/new_js/jquery.js')}}"></script>
    <link rel="stylesheet" href="{{asset('user/new_css/choices.min.css')}}">
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

<body onload="dis('{{$partner_id}}')">

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
            @include('login.flash')

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
                                <h5 class="card_title " style="color:#50aaca"> Add Sale Return Invoice
                                    <a href="{{ route('dealer.salereturn.master') }}" class="btn btn-primary btns"> <i class="fa fa-plus-circle"></i>Manage invoice </a>
                                </h5>


                            </center>


                            <hr>
                            <form>

                                <div class="form-row">

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Sale return no <span style="color:red">&#9733;</span></label>
                                            <input id="inid" readonly value="{{$salereturn_no}}" type="text" name="salereturn_no" class="form-control" placeholder="Invoice no">

                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledSelect">Dealer <span style="color:red">&#9733;</span></label>
                                            <select required="" onchange="dis(this.value),adm(this.value)" id="partner_name" name="partner_id" class="form-control">
                                                <option value="">Select</option>

                                                @foreach ($partner as $key)

                                                <option {{$key->partner_id==session()->get('partner_id') ? 'selected' : '' }} value="{{ $key->partner_id }}" data-id="{{ $key->name }}">{{ $key->store_name }}({{$key->partner_id}})</option>
                                                @endforeach


                                            </select>

                                        </div>
                                    </div>



                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Mobile Number <span style="color:red">&#9733;</span></label>
                                            <input required="" onkeypress="return isNumberKey(event)" minlength="10" maxlength="10" readonly type="text" name="phone" class="form-control phone" placeholder="Mobile Number">
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label style="white-space:nowrap" for="disabledTextInput">Credit Days<span style="color:red">&#9733;</span></label>
                                            <input required="" readonly type="text" name="credit_days" class="form-control credit_days" placeholder="Days">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">



                                    <div class="col-md-4 mb-4">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Credit Limit <span style="color:red">&#9733;</span> </label>
                                            <input required="" readonly type="text" name="credit_limit" class="form-control credit_limit" placeholder="Credit Limit">
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-4">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Available Limit <span style="color:red">&#9733;</span> </label>
                                            <input required="" readonly type="text" name="available_limit" class="form-control available_limit" placeholder="Available Limit">
                                        </div>
                                    </div>


                                    <div class="col-md-4 mb-4">
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
                                            <label for="disabledTextInput">Address <span style="color:red">&#9733;</span></label>
                                            <select required="" onchange="addr(this.value)" name="address" class="form-control address">
                                                <option value="">Select</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">City <span style="color:red">&#9733;</span></label>
                                            <input type="text" readonly name="city" class="form-control citys" placeholder="City"></input>
                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">District <span style="color:red">&#9733;</span></label>
                                            <input type="text" readonly name="district" class="form-control districts" placeholder="District"></input>
                                        </div>
                                    </div>
                                    <input type="hidden" readonly name="state" class="form-control states" placeholder="State"></input>
                                    <input type="hidden" readonly name="country" class="form-control countrys" placeholder="Country"></input>
                                    <input type="hidden" readonly name="pincode" class="form-control pincode" placeholder="Pincode"></input>
                                    <input type="hidden" readonly name="location_id" class="form-control location_id" placeholder="Location id"></input>

                                </div>

                                <div class="form-row">

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Buyer's Order No</label>
                                            <input type="text" name="by_order_no" class="form-control" placeholder="Buyer's Order No">
                                        </div>
                                    </div>


                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Date</label>
                                            <input type="date" value="@php echo date('Y-m-d')@endphp" name="date" class="form-control" placeholder="Date">
                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Eway Bill No</label>
                                            <input type="text" name="ew_bill_no" class="form-control" placeholder="Eway Bill NO">
                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Others </label>
                                            <input type="text" name="others" class="form-control" placeholder="Others">
                                        </div>
                                    </div>
                                </div>





                                <div class="form-row">

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledSelect">Purchase Invoice no <span style="color:red">&#9733;</span></label>
                                            <select onchange="inv(this.value)" id="partnerinvoice_no" name="partnerinvoice_no" class="form-control partnerinvoice_no">
                                                <option value="">Select</option>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledSelect">Category name <span style="color:red">&#9733;</span></label>
                                            <select onchange="cat(this.value)" name="gategory_id" class="form-control v1 gategory_id">
                                                <option value="">Select</option>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Model No. <span style="color:red">&#9733;</span></label>
                                            <select onchange="cod(this.value)" required="" name="model_no" class="form-control model_no v7">
                                                <option value="">Select</option>

                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-md-3 mb-3">
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
                                            <input readonly type="text" name="billing_price" class="form-control billing_price v6" placeholder="billing price">

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


                                <input type="hidden" id="txt" name="partner_name">

                                <input type="hidden" value="{{$partner_id}}" name="created_by">
                                <input type="hidden" class="delivery_address" name="delivery_address">
                                <input type="hidden" class="delivery_location_id" name="delivery_location_id">
                                <input type="hidden" class="delivery_id" name="delivery_id">
                                <input type="hidden" class="total" name="total">
                                <input type="hidden" class="tcs" name="tcs">

                                <div>
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
    <script>
        function adm(inid) {

            if (inid == '') {
                swal({
                    type: "error"
                    , title: "Warning!"
                    , text: "Please Select Dealer!"
                    , confirmButtonText: "Ok"
                    , buttonsStyling: !1
                    , confirmButtonClass: "btn btn-danger"
                });
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
                , url: "{{ route('sub.inid')}}"
                , data: {
                    inid: inid

                }
                , success: function(data) {
                    $('#inid').val(data);
                }
            });


        }

    </script>



    <!--=================================*
                            End Main Content Section
                            *===================================-->

    <!--=================================*
                                Footer Section
                                *===================================-->

    <script>
        $(function() {
            $("#partner_name").on("change", function() {
                var option_attribute = $('option:selected', this).attr('data-id');
                $("#txt").val(option_attribute);
            });
        });

    </script>
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


    <!--=========================*
                                        General Scripts
                                        *===========================-->



    <script>
        function remove(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // event.preventDefault();
            $.ajax({
                type: 'POST'
                , url: "{{ route('dealer.salereturn.remove')}}"
                , data: {
                    id: id
                , }
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
        function dis(partner_id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // event.preventDefault();
            var partner_id = partner_id;
            $.ajax({
                type: 'POST'
                , url: "{{ route('distributor.select.invoice')}}"
                , data: {
                    partner_id: partner_id
                }
                , success: function(data) {
                    var val = JSON.parse(data);
                    $('.phone').val(val.phone);
                    $('.credit_limit').val(val.credit_limit);
                    $('.available_limit').val(val.available_limit);
                    $('.states').val(val.state);
                    $('.countrys').val(val.country);
                    $('.address').html(val.output);
                    $('.partnerinvoice_no').html(val.partnerinvoice_no);
                    $('.gstin_no').val(val.gstin_no);
                    $('.credit_days').val(val.credit_days);
                    $('.partner_type').val(val.partner_type);
                    $("#txt").val(val.partner_name);

                    $('.v1').val('');
                    $('.v2').val('');
                    $('.v4').val('');
                    $('.v5').val('');
                    $('.v6').val('');
                    $('.v7').val('');

                    var ser = "<div class='form-group'><label for='disabledSelect'>Serial No <span style='color:red'>&#9733;</span></label> <select name='serial_no[]' class='form-control'> <option value= '' > Select </option> </select> </div> ";

                    $('.serial_no').html(ser);
                }
            });


        }

    </script>

    <script>
        function addr(address) {

            var partner_id = $("select[name=partner_id]").val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // event.preventDefault();
            var address = address;
            $.ajax({
                type: 'POST'
                , url: "{{ route('dealer.address.select')}}"
                , data: {
                    partner_id: partner_id
                    , address: address
                }
                , success: function(data) {
                    var val = JSON.parse(data);
                    $('.citys').val(val.city);
                    $('.districts').val(val.district);
                    $('.pincode').val(val.pincode);
                    $('.location_id').val(val.location_id);
                }
            });


        }

    </script>

    <script>
        function inv(partnerinvoice_no) {

            var partner_id = $("select[name=partner_id]").val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // event.preventDefault();
            var partnerinvoice_no = partnerinvoice_no;
            $.ajax({
                type: 'POST'
                , url: "{{ route('partnerinvoice_no.select')}}"
                , data: {
                    partner_id: partner_id
                    , partnerinvoice_no: partnerinvoice_no
                }
                , success: function(data) {
                    var val = JSON.parse(data);
                    $('.gategory_id').html(val.output);
                    $('.tcs').val(val.tcs);
                    $('.v1').val('');
                    $('.v2').val('');
                    $('.v4').val('');
                    $('.v5').val('');
                    $('.v6').val('');
                    $('.v7').val('');

                    var ser = "<div class='form-group'><label for='disabledSelect'>Serial No <span style='color:red'>&#9733;</span></label> <select name='serial_no[]' class='form-control'> <option value= '' > Select </option> </select> </div> ";

                    $('.serial_no').html(ser);

                }
            });


        }

    </script>



    <script>
        function cat(gategory_id) {
            var partnerinvoice_no = document.getElementById("partnerinvoice_no").value;

            if (partnerinvoice_no == '') {
                alert('Please Choose Invoice No.');
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
                , url: "{{ route('partnerinvoice_no.model.select')}}"
                , data: {
                    gategory_id: gategory_id
                    , partnerinvoice_no: partnerinvoice_no
                }
                , success: function(data) {
                    $('.model_no').html(data);
                    $('.v2').val('');
                    $('.v4').val('');
                    $('.v5').val('');
                    $('.v6').val('');

                    var ser = "<div class='form-group'><label for='disabledSelect'>Serial No <span style='color:red'>&#9733;</span></label> <select name='serial_no[]' class='form-control'> <option value= '' > Select </option> </select> </div> ";
                    $('.serial_no').html(ser);

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
                    $('.v4').val('');
                    $('.v5').val('');
                    $('.v6').val('');

                    var ser = "<div class='form-group'><label for='disabledSelect'>Serial No <span style='color:red'>&#9733;</span></label> <select name='serial_no[]' class='form-control'> <option value= '' > Select </option> </select> </div> ";
                    $('.serial_no').html(ser);
                }
            });


        }

    </script>

    <script>
        function product(description) {
            var partnerinvoice_no = document.getElementById("partnerinvoice_no").value;
            var partner_id = $("select[name=partner_id]").val();
            var model_no = $("select[name=model_no]").val();

            if (partnerinvoice_no == '') {
                alert('Please Choose Invoice No.');
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
                , url: "{{ route('dealer.product.select')}}"
                , data: {
                    description: description
                    , partner_id: partner_id
                    , model_no: model_no
                    , partnerinvoice_no: partnerinvoice_no
                , }
                , success: function(data) {
                    var val = JSON.parse(data);
                    $('.serial_no').html(val.output);
                    $('.rate').val(val.price);
                    $('.stock').val(val.stock);
                    $('.total').val(val.total);
                    $('.billing_price').val(val.billing_price);
                    $('.delivery_id').val(val.delivery_id);
                    $('.delivery_address').val(val.delivery_address);
                    $('.delivery_location_id').val(val.delivery_location_id);

                }
                , error: function(data) {
                    swal({
                        type: "error"
                        , title: "Error!"
                        , text: "please fill required fileds!"
                        , confirmButtonText: "Dismiss"
                        , buttonsStyling: !1
                        , confirmButtonClass: "btn btn-danger"
                    })
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
            var salereturn_no = $("input[name=salereturn_no]").val();

            var partnerinvoice_no = $("select[name=partnerinvoice_no]").val();

            var partner_name = $("input[name=partner_name]").val();
            var partner_id = $("select[name=partner_id]").val();


            var phone = $("input[name=phone]").val();

            var credit_limit = $("input[name=credit_limit]").val();
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

            var state = $("input[name=state]").val();

            var country = $("input[name=country]").val();

            var location_id = $("input[name=location_id]").val();

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

            var created_by = $("input[name=created_by]").val();
            var delivery_id = $("input[name=delivery_id]").val();
            var available_limit = $("input[name=available_limit]").val();
            var total = $("input[name=total]").val();
            var delivery_address = $("input[name=delivery_address]").val();
            var delivery_location_id = $("input[name=delivery_location_id]").val();
            var tcs = $("input[name=tcs]").val();
            var model_no = $("select[name=model_no]").val();

            if (serial_no.length <= 0 || salereturn_no == '' || partnerinvoice_no == '' || partner_name == '' || partner_id == '' || phone == '' || credit_limit == '' || credit_days == '' || partner_type == '' || pincode == '' || city == '' || district == '' || state == '' || country == '' || location_id == '' || gategory_id == '' || description == '' || price == '' || billing_price == '' || created_by == '' || delivery_id == '' || available_limit == '' || total == '' || delivery_address == '' || delivery_location_id == '' || model_no == '') {
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

                url: "{{ route('return.partnerinvoice.store') }}",

                data: {
                    salereturn_no: salereturn_no
                    , partnerinvoice_no: partnerinvoice_no
                    , partner_id: partner_id
                    , partner_name: partner_name
                    , phone: phone
                    , available_limit: available_limit
                    , credit_limit: credit_limit
                    , credit_days: credit_days
                    , partner_type: partner_type
                    , address: address
                    , pincode: pincode
                    , city: city
                    , district: district
                    , state: state
                    , country: country
                    , location_id: location_id
                    , by_order_no: by_order_no
                    , date: date
                    , ew_bill_no: ew_bill_no
                    , others: others
                    , gstin_no: gstin_no
                    , gategory_id: gategory_id
                    , description: description
                    , model_no: model_no
                    , serial_no: serial_no
                    , stock: stock
                    , price: price
                    , total: total
                    , billing_price: billing_price
                    , created_by: created_by
                    , delivery_id: delivery_id
                    , delivery_address: delivery_address
                    , delivery_location_id: delivery_location_id
                    , tcs: tcs
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
                        , text: "Something went wrong please fill required fileds!"
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
