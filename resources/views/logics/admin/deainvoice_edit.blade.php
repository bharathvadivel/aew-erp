<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <script type="text/javascript" src="{{asset('user/new_js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('user/new_js/jquery.js')}}"></script>
    <link rel="stylesheet" href="{{asset('user/new_css/choices.min.css')}}">
    <link rel="stylesheet" href="{{asset('user/new_css/bootstrap.min.css')}}">
    <script type="text/javascript" src="{{asset('user/new_js/choices.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('user/new_js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('user/vendors/sweetalert2/js/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('user/vendors/sweetalert2/js/sweetalert2.all.min.js')}}"></script>




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
                                    <a href="{{ route('deainvoice.master') }}" class="btn btn-primary btns"> <i class="fa fa-plus-circle"></i>Manage invoice </a>
                                </h5>


                            </center>


                            <hr>
                            <form method="">
                                @csrf
                                <div class="form-row">

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">invoice no <span style="color:red">&#9733;</span></label>
                                            <input readonly value="{{$row->customerinvoice_no}}" type="text" name="customerinvoice_no" class="form-control" placeholder="Invoice no">
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-6">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Your Location <span style="color:red">&#9733;</span></label>
                                            <select readonly required="" id="sub_location_id" name="sub_location_id" class="form-control">
                                                @foreach ($userlocation as $keys)

                                                <option {{$row->sub_location_id==$keys->location_id ? 'selected':'disabled="disabled"'}} value="{{ $keys->location_id }}">{{ $keys->address }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>



                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Customer Name <span style="color:red">&#9733;</span></label>
                                            <input required="" type="text" value="{{$row->customer_name}}" name="customer_name" class="form-control" placeholder="Customer Name">
                                        </div>
                                    </div>


                                </div>
                                <div class="form-row">


                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Mobile Number (Customer) <span style="color:red">&#9733;</span></label>
                                            <input required="" value="{{$row->customer_phone}}" onkeypress="return isNumberKey(event)" minlength="10" maxlength="10" type="text" name="customer_phone" class="form-control" placeholder="Mobile Number">
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-6">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Address (Customer) <span style="color:red">&#9733;</span></label>
                                            <input type="text" readonly required="" value="{{$row->address}}" name="address" class="form-control">

                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput"> Pincode (Customer) <span style="color:red">&#9733;</span></label>
                                            <input type="text" oninput="new_location(this.value)" readonly value="{{$row->pincode}}" onkeypress="return isNumberKey(event)" minlength="6" maxlength="6" name="pincode" class="form-control" placeholder="Pincode"></input>

                                        </div>
                                    </div>


                                    <input type="hidden" value="{{$row->partner_type}}" name="partner_type" class="form-control">




                                </div>


                                <div class="form-row">

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput"> Area (Customer) <span style="color:red">&#9733;</span></label>
                                            <select readonly required="" name="area" class="form-control  new_area">
                                                <option selected value="{{$row->area}}">{{$row->area}}</option>

                                            </select>


                                        </div>
                                    </div>


                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput"> City (Customer) <span style="color:red">&#9733;</span></label>
                                            <input readonly type="text" value="{{$row->city}}" name="city" class="form-control cityread new_city" placeholder="City"></input>

                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">

                                        <div class="form-group">
                                            <label for="recipient-name">District (Customer) <span style="color:red">&#9733;</span></label>
                                            <input readonly required="" value="{{$row->district}}" name="district" class="form-control districtread new_district" placeholder="District">



                                        </div>
                                    </div>



                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledSelect">State (Customer) <span style="color:red">&#9733;</span></label>
                                            <input readonly required="" value="{{$row->state}}" name="state" class="form-control stateread new_state" placeholder="State">



                                        </div>
                                    </div>

                                </div>
                                <div class="form-row">


                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledSelect">Brand Promoter</label>
                                            <select required="" name="promoter_id" class="form-control">
                                                <option value="">Select</option>
                                                @foreach ($promoter as $set)

                                                <option {{$row->promoter_id==$set->promoter_id ? 'selected':'disabled'}} value="{{ $set->promoter_id }}">{{ $set->promoter_id }} ({{ $set->name }})</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>



                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Date</label>
                                            <input readonly type="date" value="{{date('Y-m-d',strtotime($row->date))}}" name="date" class="form-control" placeholder="Date">
                                        </div>
                                    </div>

                                </div>


                                <div>

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
                                         <input readonly type="text" class="form-control description v2" name="description" placeholder="Description">


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

                                               <div class="col-md-4 mb-4">
                                                   <div class="form-group">
                                                       <label for="disabledTextInput">Book Installation Enquiry Calls</label>
                                                       <input style="height:35px; width:35px; vertical-align: middle;" value="Yes" type="radio" name="enquiry_status" class="form-control enquiry_call">
                                                   </div>
                                               </div>
                                               <div class="col-md-4 mb-4">
                                                   <div class="form-group">
                                                       <label for="disabledTextInput" style="white-space:nowrap">Skip Enquiry Calls</label>
                                                       <input style="height:35px; width:35px; vertical-align: middle;" value="No" type="radio" name="enquiry_status" class="form-control enquiry_call">
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


                                    <input type="hidden" value="{{$partner_id}}" id="created_by" name="created_by">

                                    <input type="hidden" value="{{$locat ? $locat->lat:''}}" id="lat" name="lat">



                                    <input type="hidden" id="lang" value="{{$locat ? $locat->lang:''}}" name="lang">



                                </div>



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
                                            $count = DB::table('deaserials')->where('deainvoices_id','=',$da->id)->count();
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
                                                <td><a href="{{route('deainvoice.master')}}"><button class="btn btn-danger">Complete Invoice</button></a></td>


                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

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
                , url: "{{ route('deainvoice.remove')}}"
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
            var partner_id = document.getElementById("created_by").value;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            event.preventDefault();

            $.ajax({
                type: 'POST'
                , url: "{{ route('dea.model.details')}}"
                , data: {
                    model_no: model_no
                    , partner_id: partner_id,


                }
                , success: function(data) {
                        var val = JSON.parse(data);
                        $('.serial_no').html(val.output);
                        $('.rate').val(val.price);
                        $('.stock').val(val.stock);
                        $('.description').val(val.description);
                    }

                , error: function(data) {
                    swal({
                        type: "error"
                        , title: "Error!"
                        , text: "Stock not available!"
                        , confirmButtonText: "Dismiss"
                        , buttonsStyling: !1
                        , confirmButtonClass: "btn btn-danger"
                    })
                }

            });


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

            var customerinvoice_no = $("input[name=customerinvoice_no]").val();

            var customer_name = $("input[name=customer_name]").val();


            var customer_phone = $("input[name=customer_phone]").val();

            var partner_type = $("input[name=partner_type]").val();
            var sub_location_id = $("select[name=sub_location_id]").val();




            var address = $("input[name=address]").val();

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


            var lat = $("input[name=lat]").val();

            var lang = $("input[name=lang]").val();

            var city = $("input[name=city]").val();

            var area = $("select[name=area]").val();

            var district = $("input[name=district]").val();

            var state = $("input[name=state]").val();

            if (area == '' || city == '' || district == '' || state == '' || pincode == '') {
                swal({
                    type: "error"
                    , title: "Error!"
                    , text: "Please choose customer pincode,area,city,district,state"
                    , confirmButtonText: "Dismiss"
                    , buttonsStyling: !1
                    , confirmButtonClass: "btn btn-danger"
                });
                document.getElementById('sub_load').disabled = false;
                $("#sub_load").show();
                document.getElementById('sub_spinner').style.display = "none";

                return false;
            }



            var date = $("input[name=date]").val();

            var gategory_id = $("select[name=gategory_id]").val();

            var description = $("input[name=description]").val();
            var model_no = $("select[name=model_no]").val();

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



            var created_by = $("input[name=created_by]").val();
            var promoter_id = $("select[name=promoter_id]").val();
            var enquiry_status = $("input[name='enquiry_status']:checked").val();


            if (serial_no.length <= 0 || customerinvoice_no=='' || customer_phone=='' || customer_name=='' || partner_type=='' || sub_location_id=='' || date=='' || gategory_id=='' || description=='' || model_no=='' || price=='' || created_by=='' || enquiry_status=='') {


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

                url: "{{ route('deainvoice.update') }}",

                data: {
                    customerinvoice_no: customerinvoice_no
                    , customer_name: customer_name
                    , customer_phone: customer_phone
                    , partner_type: partner_type
                    , sub_location_id: sub_location_id
                    , address: address
                    , pincode: pincode
                    , lat: lat
                    , lang: lang
                    , city: city
                    , area: area
                    , district: district
                    , state: state
                    , date: date
                    , gategory_id: gategory_id
                    , model_no: model_no
                    , description: description
                    , serial_no: serial_no
                    , stock: stock
                    , price: price
                    , billing_price: billing_price
                    , created_by: created_by
                    , promoter_id: promoter_id
                    ,enquiry_status:enquiry_status

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
                        $('.v1').val('');
                        $('.v2').val('');
                        $('.v4').val('');
                        $('.v5').val('');
                        $('.v6').val('');
                        $('.v7').val('');
                        $('.enquiry_call').prop("checked" , false );


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
                        $('.enquiry_call').prop("checked" , false );

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
                    $('.enquiry_call').prop("checked" , false );


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
