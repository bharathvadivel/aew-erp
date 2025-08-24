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
    <link rel="stylesheet" href="{{asset('user/new_css/choices.min.css')}}">
    <link rel="stylesheet" href="{{asset('user/new_css/bootstrap.min.css')}}">
    <script src="{{asset('user/new_js/choices.min.js')}}"></script>

    <script src="{{asset('user/new_js/bootstrap.bundle.min.js')}}"></script>


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

        .showreq {
            display: none;
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
            <div class="row">
                <!-- Disabled forms start -->
                <div class="col-12 mt-4" style="margin-top:0!important;">
                    <div class="card">
                        <div class="card-body">
                            <center>
                                <h5 class="card_title " style="color:#50aaca"> Complete Service Enquiry
                                    <a href="{{ route('enquiry.master') }}" class="btn btn-primary btns"> <i class="fa fa-plus-circle"></i>Manage service enquiry</a>
                                </h5>


                            </center>


                            <hr>
                            <form method="post" enctype="multipart/form-data" action="{{route('enquiry.check.admin')}}">
                                @csrf

                                <input type="hidden" name="service_id" value="{{$row->service_id}}">
                                <input type="hidden" name="service_type" value="{{$row->service_type}}">
                                <input type="hidden" name="service_center_name" value="{{$row->service_center_name}}">
                                <input type="hidden" name="executive_id" value="{{$row->executive_id}}">
                                <input type="hidden" name="executive_name" value="{{$row->executive_name}}">

                                <input type="hidden" name="invoice_no" value="{{$row->invoice_no}}">
                                <input type="hidden" name="enquiry_id" value="{{$row->id}}">
                                <input type="hidden" id="otp_status" name="otp_status" value="">

                                @if($row->status!='Closing request')

                                <input type="hidden" name="status" value="Completed">

                                @endif
                                <input type="hidden" name="end_date" value="{{$row->end_date}}">




                                <div class="form-row">

                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Call ID. <span style="color:red">&#9733;</span></label>
                                            <input required="" readonly value="{{$row->call_id}}" type="text" name="call_id" class="form-control" placeholder="Call ID">
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Customer Name <span style="color:red">&#9733;</span></label>
                                            <input required="" value="{{$row->customer_name}}" type="text" name="customer_name" class="form-control" placeholder="Name">
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Customer Phone No </label>
                                            <input value="{{$row->customer_phone}}" onkeypress="return isNumberKey(event)" minlength="10" maxlength="10" type="text" name="customer_phone" class="form-control" placeholder="Phone">
                                        </div>
                                    </div>

                                </div>


                                <div class="form-row">

                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Model No. </label>
                                            <select type="text" id="model_no_serial" name="model_no" class="form-control selectsearch">
                                                <option value="">Select model no</option>
                                                @foreach ($model as $key=>$set)
                                                <option {{$set->model_no==$row->model_no ? 'selected':''}} value="{{$set->model_no}}">{{$set->model_no}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Serial NO. <span style="color:red">&#9733;</span></label>
                                            <input required="" onfocusout="w_serial_check()" id="serial_no" type="text" value="{{$row->serial_no}}" name="serial_no" class="form-control" placeholder="Serial NO">

                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-4">
                                        <div class="form-group">
                                            <label for="disabledSelect">Dealer store Name</label>
                                            <select onchange="dealer(this.value)" id="partner_name" name="partner_id" class="form-control dealer_name selectsearch">
                                                <option value="">Select</option>
                                                @foreach ($partner as $key)
                                                <option {{$row->partner_id==$key->partner_id ? 'selected':'' }} value="{{ $key->partner_id }}" data-id="{{ $key->name }}">{{ $key->store_name }}({{$key->partner_id}})</option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                    <input type="hidden" value="{{$row->partner_name}}" id="txt" name="partner_name">

                                    <script>
                                        $(function() {
                                            $("#partner_name").on("change", function() {
                                                var option_attribute = $('option:selected', this).attr('data-id');
                                                $("#txt").val(option_attribute);
                                            });
                                        });

                                    </script>

                                </div>

                                <div class="form-row">

                                    <div class="col-md-4 mb-4">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Dealer Phone No </label>
                                            <input value="{{$row->partner_phone}}" type="text" onkeypress="return isNumberKey(event)" minlength="10" maxlength="10" name="partner_phone" class="form-control phone" placeholder="Phone">
                                        </div>
                                    </div>


                                    <div class="col-md-4 mb-4">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Date Of Purchase <span style="color:red">&#9733;</span></label>
                                            <input type="date" required="" value="{{$row->date_of_purchase}}" name="date_of_purchase" class="form-control purchase_date" placeholder="Date of purchase">
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-4">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Service Type <span style="color:red">&#9733;</span></label>
                                            <input type="text" readonly value="{{$row->service_type}}" name="service_type" class="form-control purchase_date" placeholder="Service Type">
                                        </div>
                                    </div>
                                </div>
                                @if ($list)
                                    @php
                                        $part_code=json_decode($list->model_no);
                                    @endphp
                                @else
                                    @php
                                        $part_code=array();
                                    @endphp
                                @endif
                                <div class="form-row">
                                    <div class="col-md-12 mb-12">
                                        <div class="form-group">
                                            <label for="disabledSelect">Part Code & Part Name </label>
                                            <select id="part_code" multiple name="part_code[]" class="form-control">
                                                @php
                                                    $compatibleModels = DB::table('products')->where('compatible_models', 'LIKE', '%' . $row->model_no . '%')->get();
                                                @endphp
                                                @foreach ($compatibleModels as $key)
                                                    <option value="{{ $key->model_no }}">{{ $key->description }} ({{ $key->model_no }})</option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-12 mb-12">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Remarks </label>
                                            <textarea required="" name="remarks" class="form-control">{{$row->remarks}}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-2 mb-2">
                                        <div class="form-group">
                                            <label style="white-space:nowrap" for="disabledTextInput">Closing Request</label>

                                            <input onclick="reqclosing()" type="radio" value="Closing request" name="status" class="form-control">


                                        </div>
                                    </div>
                                    @if($row->service_type!='Installation')
                                    <div class="col-md-2 mb-2">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Part Pending</label>
                                            <input onclick="reqpending()" value="Part pending" type="radio" name="status" class="form-control">

                                        </div>
                                    </div>
                                    @endif
                                    {{-- <div class="col-md-2 mb-2">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Cancel request</label>
                                            <input onclick="reqcancel()" value="Cancel request" type="radio" name="status" class="form-control">

                                        </div>
                                    </div> --}}

                                    <div class="col-md-2 mb-2">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Reappoinment</label>
                                            <input onclick="reqcancel()" value="Reappoinment" type="radio" name="status" class="form-control">
                                        </div>
                                    </div>
                                </div>


                                <div class="form-row">
                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <span>
                                                @if($pic)
                                                @if($pic->invoice_copy)
                                                <input id="oldinvoice" type="hidden" value="yes">

                                                <a target="_blank" id="invoice_copy_link" href="{{$pic::EnquiryImage($pic->invoice_copy)}}"><img id="invoice_copy" style="width:100px;height:100px" src="{{$pic::EnquiryImage($pic->invoice_copy)}}"></a>

                                                @else
                                                <input id="oldinvoice" type="hidden" value="no">

                                                <a target="_blank" href="" id="invoice_copy_link"> <img id="invoice_copy" style="width:100px;height:100px" src="{{asset('user/images/document.png')}}"></a>
                                                @endif

                                                @else
                                                <input id="oldinvoice" type="hidden" value="no">

                                                <a target="_blank" href="" id="invoice_copy_link"> <img id="invoice_copy" style="width:100px;height:100px" src="{{asset('user/images/document.png')}}"></a>


                                                @endif
                                            </span>

                                            <input id="invoice_copy_data" onchange="loadFile(event,'invoice_copy')" style="width:37%" type="file" accept="image/*" name="invoice_copy" class="form-control">
                                            <label for="disabledTextInput">Invoice Copy <span class="showreq invoicecopy" style="color:red">&#9733;</span></label>

                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <span>
                                                @if($pic)

                                                @if($pic->back_serial)
                                                <input id="oldbackserial" type="hidden" value="yes">

                                                <a target="_blank" id="back_serial_link" href="{{$pic::EnquiryImage($pic->back_serial)}}"><img id="back_serial" style="width:100px;height:100px" src="{{$pic::EnquiryImage($pic->back_serial)}}"></a>
                                                @else
                                                <input id="oldbackserial" type="hidden" value="no">
                                                <a target="_blank" href="" id="back_serial_link"> <img id="back_serial" style="width:100px;height:100px" src="{{asset('user/images/document.png')}}"></a>
                                                @endif

                                                @else
                                                <input id="oldbackserial" type="hidden" value="no">
                                                <a target="_blank" href="" id="back_serial_link"> <img id="back_serial" style="width:100px;height:100px" src="{{asset('user/images/document.png')}}"></a>
                                                @endif

                                            </span>

                                            <input id="back_serial_data" onchange="loadFile(event,'back_serial')" style="width:37%" type="file" accept="image/*" name="back_serial" class="form-control">
                                            <label for="disabledTextInput">Model & Serial No. <span class="showreq modelserial" style="color:red">&#9733;</span></label>



                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <span>
                                                @if($pic)
                                                @if($pic->product_fit)
                                                <input id="oldproductfit" type="hidden" value="yes">

                                                <a target="_blank" id="product_fit_link" href="{{$pic::EnquiryImage($pic->product_fit)}}"><img id="product_fit" style="width:100px;height:100px" src="{{$pic::EnquiryImage($pic->product_fit)}}"></a>
                                                @else
                                                <input id="oldproductfit" type="hidden" value="no">

                                                <a target="_blank" href="" id="product_fit_link"> <img id="product_fit" style="width:100px;height:100px" src="{{asset('user/images/document.png')}}"></a>
                                                @endif

                                                @else
                                                <input id="oldproductfit" type="hidden" value="no">

                                                <a target="_blank" href="" id="product_fit_link"><img id="product_fit" style="width:100px;height:100px" src="{{asset('user/images/document.png')}}"></a>


                                                @endif

                                            </span>

                                            <input id="product_fit_data" onchange="loadFile(event,'product_fit')" style="width:37%" type="file" accept="image/*" name="product_fit" class="form-control">
                                            <label for="disabledTextInput"> Product Image <span class="showreq product" style="color:red">&#9733;</span></label>




                                        </div>
                                    </div>
                                    @if($row->service_type!='Installation')

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <span>
                                                @if($pic)
                                                @if($pic->symptoms_issue)
                                                <a target="_blank" id="symptoms_issue_link" href="{{$pic::EnquiryImage($pic->symptoms_issue)}}"> <img id="symptoms_issue" style="width:100px;height:100px" src="{{$pic::EnquiryImage($pic->symptoms_issue)}}"></a>
                                                @else
                                                <a target="_blank" href="" id="symptoms_issue_link"> <img id="symptoms_issue" style="width:100px;height:100px" src="{{asset('user/images/document.png')}}"></a>
                                                @endif

                                                @else
                                                <a target="_blank" href="" id="symptoms_issue_link"> <img id="symptoms_issue" style="width:100px;height:100px" src="{{asset('user/images/document.png')}}"></a>

                                                @endif

                                            </span>

                                            <input id="symptoms_issue_data" onchange="loadFile(event,'symptoms_issue')" style="width:37%" type="file" accept="image/*" name="symptoms_issue" class="form-control">
                                            <label for="disabledTextInput">Symptoms of the issue <span class="showreq symptoms" style="color:red">&#9733;</span></label>


                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">


                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <span>
                                                @if($pic)
                                                @if($pic->panel_serial)
                                                <a target="_blank" id="panel_serial_link" href="{{$pic::EnquiryImage($pic->panel_serial)}}"><img id="panel_serial" style="width:100px;height:100px" src="{{$pic::EnquiryImage($pic->panel_serial)}}"></a>
                                                @else
                                                <a target="_blank" href="" id="panel_serial_link"> <img id="panel_serial" style="width:100px;height:100px" src="{{asset('user/images/document.png')}}"></a>
                                                @endif

                                                @else
                                                <a target="_blank" href="" id="panel_serial_link"> <img id="panel_serial" style="width:100px;height:100px" src="{{asset('user/images/document.png')}}"></a>
                                                @endif

                                            </span>

                                            <input id="panel_serial_data" onchange="loadFile(event,'panel_serial')" style="width:37%" type="file" accept="image/*" name="panel_serial" class="form-control">
                                            <label for="disabledTextInput">Part Serial Image. <span class="showreq partserial" style="color:red">&#9733;</span></label>




                                        </div>
                                    </div>


                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <span>
                                                @if($pic)
                                                @if($pic->warranty_card)
                                                <a target="_blank" id="warranty_card_link" href="{{$pic::EnquiryImage($pic->warranty_card)}}"> <img id="warranty_card" style="width:100px;height:100px" src="{{$pic::EnquiryImage($pic->warranty_card)}}"></a>
                                                @else
                                                <a target="_blank" href="" id="warranty_card_link"> <img id="warranty_card" style="width:100px;height:100px" src="{{asset('user/images/document.png')}}"></a>

                                                @endif

                                                @else
                                                <a target="_blank" href="" id="warranty_card_link"> <img id="warranty_card" style="width:100px;height:100px" src="{{asset('user/images/document.png')}}"></a>

                                                @endif

                                            </span>
                                            <input id="warranty_card_data" onchange="loadFile(event,'warranty_card')" style="width:37%" type="file" accept="image/*" name="warranty_card" class="form-control">
                                            <label for="disabledTextInput">Part Image <span class="showreq partimage" style="color:red">&#9733;</span></label>


                                        </div>
                                    </div>
                                    @endif

                                    <div class="col-md-6 mb-6">
                                        <div class="form-group">
                                            <span>
                                                @if($pic)
                                                @if($pic->other)
                                                @php
                                                $multi=json_decode($pic->other);
                                                @endphp
                                                <div class="preview-area">
                                                    @foreach ($multi as $item)

                                                    <a target="_blank" href="{{$pic::EnquiryImage($item)}}"> <img id="others" style="width:100px;height:100px" src="{{$pic::EnquiryImage($item)}}"></a>

                                                    @endforeach
                                                </div>

                                                @else
                                                <div class="preview-area">


                                                    <img style="width:100px;height:100px;" id="others" src="{{asset('user/images/document.png')}}">

                                                </div>
                                                @endif

                                                @else
                                                <div class="preview-area">


                                                    <img style="width:100px;height:100px;" id="others" src="{{asset('user/images/document.png')}}">

                                                </div>
                                                @endif

                                            </span>

                                            <input type="file" id="working_product_data" onchange="loadFileMultiple(event,'others')" name="other[]" accept="image/*" multiple class="form-control">
                                            <label for="disabledTextInput">Working Product <span class="showreq working" style="color:red">&#9733;</span></label>


                                        </div>
                                    </div>
                                </div>

                                @if($row->status=='Closing request')

                                    <div class="form-row">
                                        <div class="col-md-2 mb-2">
                                            <div class="form-group">
                                                <label for="disabledTextInput">Reappointment</label>
                                                <input value="Reappoinment" type="radio" name="status" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-2 mb-2">
                                            <div class="form-group">
                                                <label for="disabledTextInput">Complete</label>
                                                <input value="Completed" type="radio" name="status" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-2 mb-2">
                                            <div class="form-group">
                                                <label style="white-space:nowrap" for="disabledTextInput">Complete part return pending</label>
                                                <input value="Completed part return pending" type="radio" name="status" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">

                                        @if ($list)
                                            @php
                                                $xyz=0;
                                                $part_con='';
                                                $part_code=json_decode($list->part_code);
                                            @endphp
                                            @foreach ($part_code as $key)
                                                @php
                                                    $ch_parts=DB::table('parts')->where('part_code',$key)->first();
                                                    $part_cat=DB::table('spareparts_models')->where('id',$ch_parts->category_id)->where('category_name','!=','Non Returnable (C)')->first();

                                                @endphp
                                                @if ($part_code)
                                                    @php
                                                    $xyz=1;
                                                    $part_con.=$key.',';
                                                    @endphp
                                                @endif
                                            @endforeach
                                            @if ($xyz==1)
                                                <p style="color:#ff4d4d">Note - This part codes {{ $part_con }} necessary to return</p>
                                            @else
                                                <p style="color:#ff4d4d">Note - This part codes not necessary to return</p>
                                            @endif
                                        @endif

                                    </div>

                                @endif

                                <center><button type="submit" class="btn btn-primary mt-4 pl-4 pr-4">Complete</button></center>
                                <div class="form-row">
                                    <span style="color:red">&#9733;</span>
                                    <p>- Mandatory field</p>
                                </div>
                            </form>
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
    <script>
        $(document).ready(function () {
            // Function to filter options based on user input
            function filterOptions(searchTerm) {
                $('.choices__list .choices__item').each(function () {
                    var optionText = $(this).text().toLowerCase();
                    if (optionText.includes(searchTerm)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            }

            // Event listener for input changes
            $('#filterInput').on('input', function () {
                var searchTerm = $(this).val().toLowerCase();
                filterOptions(searchTerm);
            });
        });
    </script>

    <script>
        function reqcancel() {
            $(".showreq").hide();
        }

        function reqpending() {
            $(".invoicecopy").show();
            $(".modelserial").show();
            $(".product").show();
            $(".symptoms").show();
            $(".partserial").show();
            $(".partimage").show();
            $(".working").hide();
        }

        function reqclosing() {
            $(".invoicecopy").show();
            $(".modelserial").show();
            $(".product").show();
            var service_type = $("input[name=service_type]").val();
            if (service_type != 'Installation') {
                $(".symptoms").show();
            } else {
                $(".symptoms").hide();

            }
            $(".partserial").hide();
            $(".partimage").hide();
            $(".working").show();

        }

    </script>

    <script>
        $(document).ready(function() {

            var multipleCancelButton = new Choices("#part_code", {
                removeItemButton: true
                , shouldSort: false
                , fuseOptions: {
                    threshold: 0
                }

            , });


        });

    </script>

    <script>
        $(document).ready(function() {

            var multipleCancelButton = new Choices("#part_name", {
                removeItemButton: true
                , shouldSort: false
                , fuseOptions: {
                    threshold: 0
                }

            , });


        });

    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        var loadFile = function(event, id) {
            var image = document.getElementById(id);
            image.src = URL.createObjectURL(event.target.files[0]);
            var link = document.getElementById(id + '_link');
            link.href = URL.createObjectURL(event.target.files[0]);
        };

    </script>
    <script>
        var loadFileMultiple = function(event, id) {
            $('.preview-area').empty('');
            var imgArray = event.target.files;
            for (var i = 0; i < imgArray.length; i++) {
                var objectUrl = URL.createObjectURL(imgArray[i]);
                $('.preview-area').append('<a target="_blank" href="' + objectUrl + '"><img src="' + objectUrl + '" style="width:100px;height:100px" /></a>&nbsp;');


            }
        };

    </script>

    <script>
        function w_serial_check() {
            var serial_no = $("input[name=serial_no]").val();
            if (serial_no == "") {
                return false;
            }
            var model_no_serial = $("#model_no_serial").val();
            if (model_no_serial == '')

            {
                Swal.fire({
                    icon: 'error'
                    , title: 'Oops...'
                    , text: 'Please select a model'
                })
                return false

            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // event.preventDefault();
            $.ajax({
                type: 'POST'
                , url: "{{ route('w.serial.check')}}"

                , data: {
                    serial_no: serial_no
                    , model_no: model_no_serial

                }
                , success: function(data) {
                    if (data == 'success') {} else {
                        $("input[name=serial_no]").val('');
                        Swal.fire({
                            icon: 'error'
                            , title: 'Oops...'
                            , text: 'Invalid serial no'
                        })

                    }

                }
            });


        }

    </script>



    <script>
        function dis() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var part_code = document.getElementById('part_code').value;
            // event.preventDefault();
            var part_code = part_code;
            $.ajax({
                type: 'POST',
                url: "{{ route('part')}}",
                data: {
                    part_code: part_code
                },
                success: function(data) {
                    $('.part_name').html(data);
                }
            });
        }

    </script>
    <script>
        function dealer(dis_id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // event.preventDefault();
            var dis_id = dis_id;
            $.ajax({
                type: 'POST'
                , url: "{{ route('partner.details')}}"
                , data: {
                    dis_id: dis_id
                }
                , success: function(data) {
                    var val = JSON.parse(data);
                    $('.phone').val(val.phone);

                }
            });


        }

    </script>

    <!--=================================*
                  Footer Section
    *===================================-->
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


</body>

</html>
