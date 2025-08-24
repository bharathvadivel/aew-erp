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
                <div class="col-12 mt-4" style="margin-top:0!important;">
                    <div class="card">
                        <div class="card-body">
                            <center>
                                <h5 class="card_title " style="color:#50aaca"> Add Invoice
                                    <a href="{{ route('disinvoice.master') }}" class="btn btn-primary btns"> <i class="fa fa-plus-circle"></i>Manage invoice </a>
                                </h5>
                            </center>

                            <form method="post" enctype="multipart/form-data" action="{{route('warehouseinvoice.csv.store')}}">
                                @csrf
                                <div class="form-row">

                                    <div class="col-md-4 mb-4">
                                        <div class="form-group">
                                            <label for="disabledTextInput">invoice no <span style="color:red">&#9733;</span></label>
                                            <input readonly id="inid" value="{{$disinvoice_no}}" type="text" name="disinvoice_no" class="form-control" placeholder="Invoice no">

                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-4">
                                        <div class="form-group">
                                            <label for="disabledSelect">From Warehouse<span style="color:red">&#9733;</span></label>
                                            <select required="" onchange="getinvoiceno()" id="warehouse_id" name="created_by" class="form-control selectsearch">
                                                <option value="">Select</option>
                                                @foreach ($fromwarehouse as $key)
                                                <option {{ $key->warehouse_id==$login_id ? 'selected':''}} value="{{ $key->warehouse_id }}">{{ $key->name }}({{$key->warehouse_id}})</option>
                                                @endforeach

                                            </select>

                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-4">
                                        <div class="form-group">
                                            <label for="disabledSelect">To Warehouse <span style="color:red">&#9733;</span></label>
                                            <select required="" onchange="towarehouse(this.value)" id="dis_id" name="dis_id" class="form-control selectsearch">
                                                <option value="">Select</option>
                                                @foreach ($towarehouse as $key)
                                                <option value="{{ $key->warehouse_id }}">{{ $key->name }}({{$key->warehouse_id}})</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                </div>

                                <div class="form-row">
                                    <div class="col-md-4 mb-4">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Bill Type <span style="color:red">&#9733;</span></label>
                                            <select required="" onchange="getinvoiceno()" id="bill_type" name="bill_type" class="form-control">
                                                <option value="">Select Bill Type</option>
                                                <option value="0">Invoice</option>
                                                <option value="1">Delivery Note</option>
                                            </select>

                                        </div>
                                    </div>


                                    <div class="col-md-4 mb-4">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Mobile Number <span style="color:red">&#9733;</span></label>
                                            <input required="" onkeypress="return isNumberKey(event)" minlength="10" maxlength="10" readonly type="text" class="form-control phone" placeholder="Mobile Number">
                                        </div>
                                    </div>


                                    <div class="col-md-4 mb-4">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Gstin No </label>
                                            <input readonly type="text" class="form-control gstin_no" placeholder="Gstin NO">
                                        </div>
                                    </div>
                                    <input type="hidden" value="{{$login_id}}" name="login_id">
                                    <input type="hidden" name="partner_type" class="form-control partner_type">
                                </div>


                                <div class="form-row">
                                    <div class="col-md-12 mb-12">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Billing Address <span style="color:red">&#9733;</span> <input id="same" name="ch_box_status" value="ch_ked" checked type="checkbox">&nbsp;Same as delivery address</label>
                                            <select required="" name="location_id" class="form-control billingaddress selectsearch">
                                                <option value="">Select</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row" style="display:none;" id="deliveryaddress">
                                    <div class="col-md-6 mb-6">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Delivery Address <span style="color:red">&#9733;</span></label>
                                            <select style="width: 590px" onchange="newDeliveryAddress(this.value)" name="delivery_location_id" class="form-control deliveryaddress selectsearch">
                                                <option value="">Select</option>
                                                <option value="new">Add New</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-6" style="display:none;" id="newdeliveryaddress">
                                        <div class="form-group">
                                            <label for="disabledTextInput">New Delivery Address</label>
                                            <input type="text" name="new_delivery_address" class="form-control" placeholder="New delivery address">
                                        </div>
                                    </div>
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
                                            <label for="disabledTextInput"> Vehicle Number/Others </label>

                                            <input type="text" name="others" class="form-control" placeholder="Vehicle Number/Others">

                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Distance</label>
                                            <input type="text" name="distance" class="form-control" placeholder="In KM">
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Transport ID</label>
                                            <input type="text" name="transporter_id" class="form-control" placeholder="Transport ID">
                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Transport Name</label>
                                            <input type="text" name="transporter_name" class="form-control" placeholder="Transport Name">
                                        </div>
                                    </div>

                                </div>


                                <div class="form-row">

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
                                            <input required="" type="file" accept=".xlsx, .xls, .csv" name="serial_no_list" class="form-control" placeholder="Serial no list">
                                            <a download="serial_format_upload.csv" href="{{asset('user/csv/serial_format_upload.csv')}}"><span style="font-size:12px;color:green">Download sample file</span></a>



                                        </div>
                                    </div>
                                </div>

                                <div style="display:none" id="entry">

                                    <div class="form-row">


                                        <div class="col-md-4 mb-4">
                                            <div class="form-group">
                                                <label for="disabledSelect">Category name <span style="color:red">&#9733;</span></label>
                                                <select onchange="category(this.value)" name="gategory_id" class="form-control gategory_id selectsearch" style="width:100%">
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
                                                <select onchange="model(this.value)" name="model_no" class="form-control model_no selectsearch" style="width:100%">
                                                    <option value="">Select</option>

                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4 mb-4">
                                            <div class="form-group">
                                                <label for="disabledSelect">Product Description <span style="color:red">&#9733;</span></label>
                                                <input readonly type="text" name="description" class="form-control description" placeholder="Description">

                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row">

                                        <div class="col-md-4 mb-4">
                                            <div class="form-group">
                                                <label for="disabledTextInput">Stock <span style="color:red">&#9733;</span></label>
                                                <input readonly type="text" name="stock" class="form-control stock" placeholder="Stock">

                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-4">
                                            <div class="form-group">
                                                <label for="disabledTextInput">Price <span style="color:red">&#9733;</span></label>
                                                <input readonly type="text" name="price" class="form-control rate" placeholder="Rate">

                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-4">
                                            <div class="form-group">
                                                <label for="disabledTextInput">Billing Price <span style="color:red">&#9733;</span></label>
                                                <input  type="text" name="billing_price" class="form-control billing_price" placeholder="billing price">

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

                                    <div class="form-row">

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
                                                <input value="0" type="number" name="partner_allowance" class="form-control partner_allowance" placeholder="Direct Partner Allowance">
                                                <span style="font-size:12px;color:red">Note: Enter Percentage Value</span>
                                            </div>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <div class="form-group">
                                                <label for="disabledTextInput">Addtional Discount</label>
                                                <input value="0" type="number" name="additional_discount" class="form-control additional_discount" placeholder="Addtional Discount">
                                                <span style="font-size:12px;color:red">Note: Enter Amount Value</span>

                                            </div>
                                        </div>

                                    </div>




                                </div>

                                <div id="importsubmit">
                                    <center><input type="submit" name="submit" class="btn btn-primary mt-4 pl-4 pr-4">
                                    </center>
                                </div>

                                <div id="entrysubmit" style="display:none">
                                    <center><button id="ajaxsubmit" type="submit" name="submit" class="btn btn-primary mt-4 pl-4 pr-4 btn-submit">Submit</button>
                                    </center>
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

    <script type="text/javascript">
        // import and entry hide and show
        $(document).ready(function() {
            $('input[type="radio"]').click(function() {
                type = $("input[name='type']:checked").val();
                if (type == 'entry') {
                    $('#entry').show();
                    $('#import').hide();
                    $('#entrysubmit').show();
                    $('#importsubmit').hide();
                } else {
                    $('#entry').hide();
                    $('#import').show();
                    $('#entrysubmit').hide();
                    $('#importsubmit').show();
                }
            });
        });

        // delivery address change
        $(document).ready(function() {
            $('input[type="checkbox"]').click(function() {
                delivery_type = $('#same').is(':checked');
                if (delivery_type) {
                    $('#deliveryaddress').hide();
                } else {
                    $('#deliveryaddress').show();
                }
            });
        });

        // new delivery address type
        function newDeliveryAddress(value) {
            if (value == "new") {
                $('#newdeliveryaddress').show();
            } else {
                $('#newdeliveryaddress').hide();
            }
        }

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
    function getinvoiceno() {
        var partner_id = $('#warehouse_id').val();
        var bill_type = $('#bill_type').val();

        if (partner_id == '' || bill_type == '') {
            return true;
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        event.preventDefault();

        $.ajax({
            type: 'POST'
            , url: "{{ route('warehouse.invoiceno')}}"
            , data: {
                partner_id: partner_id
                , bill_type: bill_type
            }
            , success: function(data) {
                $('#inid').val(data);
            }
            , error: function(data) {
                swal({
                    type: "error"
                    , title: "Error!"
                    , text: "get Invoice No, failed!"
                    , confirmButtonText: "Dismiss"
                    , buttonsStyling: !1
                    , confirmButtonClass: "btn btn-danger"
                })
            }

        });

        clearlist();
    }

</script>



    <script>
        function remove(id) {

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
                , url: "{{ route('warehouseinvoice.remove')}}"
                , data: {
                    id: id
                , }
                , success: function(data) {
                    var val = JSON.parse(data);
                    swal({
                        type: "error"
                        , title: "Warning!"
                        , text: val.message
                        , confirmButtonText: "Ok"
                        , buttonsStyling: !1
                        , confirmButtonClass: "btn btn-danger"
                    });
                     val.status ? $('.invoice').html(val.output):'';

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
        function towarehouse(dis_id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var dis_id = dis_id;
            $.ajax({
                type: 'POST'
                , url: "{{ route('towarehouse.details')}}"
                , data: {
                    dis_id: dis_id
                }
                , success: function(data) {
                        var val = JSON.parse(data);
                        var billingaddress = val.output;
                      var  deliveryaddress = '<option value="">Select</option><option value="new">Add New</option>';
                         deliveryaddress += val.output;
                        $('.phone').val(val.phone);
                        $('.billingaddress').html(billingaddress);
                        $('.deliveryaddress').html(deliveryaddress);
                        $('.gstin_no').val(val.gstin_no);
                        $('.partner_type').val(val.partner_type);
                        clearlist();
                    }

                , error: function(data) {
                    swal({
                        type: "error"
                        , title: "Error!"
                        , text: "please check to warehouse !"
                        , confirmButtonText: "Dismiss"
                        , buttonsStyling: !1
                        , confirmButtonClass: "btn btn-danger"
                    });
                    clearlist();
                }

            });


        }

    </script>


    <script>
        function category(gategory_id) {
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
                , error: function(data) {
                    swal({
                        type: "error"
                        , title: "Error!"
                        , text: "please check category!"
                        , confirmButtonText: "Dismiss"
                        , buttonsStyling: !1
                        , confirmButtonClass: "btn btn-danger"
                    });
                    clearlist();
                }
            });


        }

    </script>

    <script>
        function model(model_no) {
            var dis_id = document.getElementById("dis_id").value;
            var warehouse_id = document.getElementById("warehouse_id").value;

            if (dis_id == '') {
                alert('Please Choose To Warehouse');
                return false;
            }
            if (warehouse_id == '') {
                alert('Please Choose From Warehouse');
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
                , url: "{{ route('dis.model.details')}}"
                , data: {
                    model_no: model_no
                    , dis_id: dis_id
                    , warehouse_id: warehouse_id

                }
                , success: function(data) {
                    var val = JSON.parse(data);
                    $('.serial_no').html(val.output);
                    $('.rate').val(val.price);
                    $('.stock').val(val.stock);
                    $('.sta').val(val.sta);
                    $('.basic_allowance').val(val.basic_allowance);
                    $('.billing_price').val(val.billing_price);
                    $('.description').val(val.description);
                }
                , error: function(data) {
                    swal({
                        type: "error"
                        , title: "Error!"
                        , text: "please check model no!"
                        , confirmButtonText: "Dismiss"
                        , buttonsStyling: !1
                        , confirmButtonClass: "btn btn-danger"
                    });
                    clearlist();
                }

            });


        }

    </script>

    <script>
        function clearlist() {
            $('.gategory_id').val('');
            $('.description').val('');
            $('.stock').val('');
            $('.rate').val('');
            $('.billing_price').val('');
            $('.model_no').html('<option value="">select</option>');
            $('.sta').val(0);
            $('.partner_allowance').val(0);
            $('.basic_allowance').val(0);
            $('.additional_discount').val(0);
            var ser = "<div class='form-group'><label for='disabledSelect'>Serial No</label> <select name='serial_no[]' class='form-control'><option value=''>Select</option></select></div>";
            $('.serial_no').html(ser);
        }

    </script>



    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(".btn-submit").click(function(e) {
            ajaxloderIn();
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
                ajaxloderOut();
                return false;
            }

            var disinvoice_no = $("input[name=disinvoice_no]").val();
            var dis_id = $("select[name=dis_id]").val();
            var created_by = $("select[name=created_by]").val();
            if (created_by == dis_id) {
                swal({
                    type: "error"
                    , title: "Error!"
                    , text: "From warehouse and To warehouse is same!"
                    , confirmButtonText: "Dismiss"
                    , buttonsStyling: !1
                    , confirmButtonClass: "btn btn-danger"
                });
                ajaxloderOut();
                return false;
            }

            var partner_type = $("input[name=partner_type]").val();
            var location_id = $("select[name=location_id]").val();
            if (location_id == '') {
                swal({
                    type: "error"
                    , title: "Error!"
                    , text: "Please choose address"
                    , confirmButtonText: "Dismiss"
                    , buttonsStyling: !1
                    , confirmButtonClass: "btn btn-danger"
                });
                ajaxloderOut();
                return false;
            }


            var by_order_no = $("input[name=by_order_no]").val();

            var date = $("input[name=date]").val();

            var ew_bill_no = $("input[name=ew_bill_no]").val();

            var others = $("input[name=others]").val();

            var distance = $("input[name=distance]").val();

            var transporter_id = $("input[name=transporter_id]").val();

            var transporter_name = $("input[name=transporter_name]").val();

            var gategory_id = $("select[name=gategory_id]").val();

            var serial_no = [];
            $(".serial_no :selected").each(function() {
                serial_no.push(this.value);
            });

            var price = $("input[name=price]").val();
            var billing_price = $("input[name=billing_price]").val();
            var basic_allowance = $("input[name=basic_allowance]").val();
            var sta = $("input[name=sta]").val();
            var partner_allowance = $("input[name=partner_allowance]").val();
            var additional_discount = $("input[name=additional_discount]").val();
            var created_by = $("select[name=created_by]").val();
            var model_no = $("select[name=model_no]").val();
            var bill_type = $("select[name=bill_type]").val();
            var login_id = $("input[name=login_id]").val();
            var same = $('#same').is(':checked');
            if (same) {
                var delivery_location_id = $("select[name=location_id]").val();
                var ch_box_status = 'ch_ked';
            } else {
                var delivery_location_id = $("select[name=delivery_location_id]").val();
                var ch_box_status = 'un_ch_ked';

            }
            //new delivery address check
            if (delivery_location_id == 'new') {
                var new_delivery_address = $("input[name=new_delivery_address]").val();
                if (new_delivery_address == '') {
                    swal({
                        type: "error"
                        , title: "Error!"
                        , text: "Please enter new delivery address"
                        , confirmButtonText: "Dismiss"
                        , buttonsStyling: !1
                        , confirmButtonClass: "btn btn-danger"
                    });
                    ajaxloderOut();
                    return false;
                }
            } else {
                var new_delivery_address = '';
            }


            //check required fields
            if (serial_no.length <= 0 || bill_type == '' || delivery_location_id == '' || disinvoice_no == '' || dis_id == '' || partner_type == '' || location_id == '' || gategory_id == '' || price == '' || billing_price == '' || basic_allowance == '' || sta == '' || partner_allowance == '' || additional_discount == '' || created_by == '' || model_no == '' || login_id == '') {
                swal({
                    type: "error"
                    , title: "Error!"
                    , text: "Please fill required fileds some fileds are missing"
                    , confirmButtonText: "Dismiss"
                    , buttonsStyling: !1
                    , confirmButtonClass: "btn btn-danger"
                });
                ajaxloderOut();
                return false;
            }

            $.ajax({
                type: 'POST'
                , url: "{{ route('warehouseinvoice.store') }}"
                , data: {
                    disinvoice_no: disinvoice_no
                    , dis_id: dis_id
                    , bill_type: bill_type
                    , partner_type: partner_type
                    , location_id: location_id
                    , by_order_no: by_order_no
                    , date: date
                    , ew_bill_no: ew_bill_no
                    , others: others
                    , distance: distance
                    , transporter_id: transporter_id
                    , transporter_name: transporter_name
                    , gategory_id: gategory_id
                    , serial_no: serial_no
                    , price: price
                    , billing_price: billing_price
                    , basic_allowance: basic_allowance
                    , sta: sta
                    , partner_allowance: partner_allowance
                    , additional_discount: additional_discount
                    , created_by: created_by
                    , model_no: model_no
                    , new_delivery_address: new_delivery_address
                    , delivery_location_id: delivery_location_id
                    , ch_box_status: ch_box_status
                    , login_id: login_id,

                }
                , success: function(data) {
                    var res = JSON.parse(data);
                    if (res.status == true) {
                        swal({
                            type: "success"
                            , title: "Success"
                            , text: res.message
                            , buttonsStyling: !1
                            , confirmButtonClass: "btn btn-success"
                        })
                        $('.invoice').html(res.output);
                        clearlist();
                    } else {
                        swal({
                            type: "error"
                            , title: "Error!"
                            , text: res.message
                            , confirmButtonText: "Dismiss"
                            , buttonsStyling: !1
                            , confirmButtonClass: "btn btn-danger"
                        });
                        clearlist();

                    }
                    ajaxloderOut();
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
                    clearlist();
                    ajaxloderOut();
                }
            , });
        });

    </script>
</body>

</html>
