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
                                    <a href="{{ route('enquiry.manage') }}" class="btn btn-primary btns"> <i class="fa fa-plus-circle"></i>Manage service enquiry</a>
                                </h5>


                            </center>


                            <hr>
                            <form method="post" enctype="multipart/form-data" action="{{route('enquiry.check.admin')}}">
                                @csrf

                                <input type="hidden" name="service_id" value="{{$row->service_id}}">
                                <input type="hidden" id="service_type" name="service_type" value="{{$row->service_type}}">
                                <input type="hidden" name="service_center_name" value="{{$row->service_center_name}}">
                                <input type="hidden" name="executive_id" value="{{$row->executive_id}}">
                                <input type="hidden" name="executive_name" value="{{$row->executive_name}}">

                                <input type="hidden" name="invoice_no" value="{{$row->invoice_no}}">

                                <input type="hidden" name="enquiry_id" value="{{$row->id}}">
                                <input type="hidden" name="end_date" value="{{$row->end_date}}">

                                <input type="hidden" name="ch_status" value="{{$row->status}}">

                                <input type="hidden" id="otp_status" name="otp_status" value="">


                                <div class="form-row">

                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Call ID. <span style="color:red">&#9733;</span></label>
                                            <input id="call_id" readonly value="{{$row->call_id}}" type="text" name="call_id" class="form-control" placeholder="Call ID">
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Customer Name <span style="color:red">&#9733;</span></label>
                                            <input id="customer_name" value="{{$row->customer_name}}" type="text" name="customer_name" class="form-control" placeholder="Name">
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
                                            <select type="text" name="model_no" id="model_no_serial" class="form-control selectsearch">
                                                <option value="">Select model no</option>
                                                @foreach ($model as $key=>$set)
                                                <option {{$set->model_no==$row->model_no ? 'selected':''}} value="{{$set->model_no}}">{{$set->model_no}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Serial NO</label>
                                            <input onfocusout="w_serial_check()" id="serial_no" type="text" value="{{$row->serial_no}}" name="serial_no" class="form-control" placeholder="Serial NO">

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
                                            <input type="date" value="{{$row->date_of_purchase}}" name="date_of_purchase" class="form-control purchase_date" placeholder="Date of purchase">
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
                                $part_code=json_decode($list->part_code);
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

                                                @foreach ($part as $key)

                                                <option {{in_array($key->part_code,$part_code) ? 'selected':''}} value="{{ $key->part_code }}">{{ $key->part_code }} ({{ $key->part_name }})</option>
                                                @endforeach


                                            </select>

                                        </div>
                                    </div>


                                </div>
                                <div class="form-row">
                                    <div class="col-md-12 mb-12">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Remarks </label>
                                            <textarea required="" name="remarks" id="remarks_message" class="form-control"></textarea>
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
                                                <input id="oldsymptoms" type="hidden" value="yes">

                                                <a target="_blank" id="symptoms_issue_link" href="{{$pic::EnquiryImage($pic->symptoms_issue)}}"> <img id="symptoms_issue" style="width:100px;height:100px" src="{{$pic::EnquiryImage($pic->symptoms_issue)}}"></a>
                                                @else
                                                <input id="oldsymptoms" type="hidden" value="no">
                                                <a target="_blank" href="" id="symptoms_issue_link"> <img id="symptoms_issue" style="width:100px;height:100px" src="{{asset('user/images/document.png')}}"></a>
                                                @endif

                                                @else
                                                <input id="oldsymptoms" type="hidden" value="no">
                                                <a target="_blank" href="" id="symptoms_issue_link"> <img id="symptoms_issue" style="width:100px;height:100px" src="{{asset('user/images/document.png')}}"></a>

                                                @endif

                                            </span>

                                            <input id="symptoms_issue_data" onchange="loadFile(event,'symptoms_issue')" style="width:37%" type="file" accept="image/*" name="symptoms_issue" class="form-control">
                                            <label for="disabledTextInput">Symptoms of the issue <span class="showreq symptoms" style="color:red">&#9733;</span></label>


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
                                                @if($pic->panel_serial)
                                                <input id="oldpanelserial" type="hidden" value="yes">
                                                <a target="_blank" id="panel_serial_link" href="{{$pic::EnquiryImage($pic->panel_serial)}}"><img id="panel_serial" style="width:100px;height:100px" src="{{$pic::EnquiryImage($pic->panel_serial)}}"></a>
                                                @else
                                                <input id="oldpanelserial" type="hidden" value="no">
                                                <a target="_blank" href="" id="panel_serial_link"> <img id="panel_serial" style="width:100px;height:100px" src="{{asset('user/images/document.png')}}"></a>
                                                @endif

                                                @else
                                                <input id="oldpanelserial" type="hidden" value="no">
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
                                                <input id="oldwarranty" type="hidden" value="yes">
                                                <a target="_blank" id="warranty_card_link" href="{{$pic::EnquiryImage($pic->warranty_card)}}"> <img id="warranty_card" style="width:100px;height:100px" src="{{$pic::EnquiryImage($pic->warranty_card)}}"></a>
                                                @else
                                                <input id="oldwarranty" type="hidden" value="no">
                                                <a target="_blank" href="" id="warranty_card_link"> <img id="warranty_card" style="width:100px;height:100px" src="{{asset('user/images/document.png')}}"></a>

                                                @endif

                                                @else
                                                <input id="oldwarranty" type="hidden" value="no">
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

                                


                                <center><button onclick="sent_otp({{$row->customer_phone}},{{$row->id}})" type="button" class="btn btn-primary mt-4 pl-4 pr-4">Complete</button>

                                    <center><input type="submit" style="visibility:hidden" id="submitform" class="btn btn-primary mt-4 pl-4 pr-4"></center>
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

    <div class="modal fade" id="otp" tabindex="-1" aria-labelledby="otp" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 500px !important;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">OTP verification</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label style="display:flex;justify-content: space-around;" for="recipient-name" class="col-form-label">OTP we just send to <p style="color:red;display: contents;">{{ $row->customer_phone }}</p></label>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                            </div>


                            <div class="col-md-4">
                                <label style="display:flex;justify-content: space-around;" for="recipient-name" class="col-form-label">Enter OTP</label>
                                <input type="text" id="otp_number" style="border: 2px solid #ff0000;" class="form-control" id="recipient-name" minlength="4" maxlength="4" onkeypress="return isNumberKey(event)">
                            </div>
                            <div class="col-md-4">

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                            </div>
                            <div class="col-md-4">
                                <label style="display:flex;justify-content: space-around;color:red;white-space:nowrap" for="recipient-name" id="countdowntimer" class="col-form-label">10 minutes remaining</label>
                                <u>
                                    <p onclick="resent_otp({{$row->customer_phone}},{{$row->id}})" style="display:none;margin: 12px;cursor:pointer;color:#37b3c9" id="resent">Resent OTP</p>
                                </u>
                            </div>
                            <div class="col-md-4">

                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="otp_pending()" class="btn btn-danger">OTP Pending</button>
                    <button type="button" id="timesubmit" onclick="otp_verify({{$row->customer_phone}},{{$row->id}})" class="btn btn-success">Verify OTP</button>
                </div>
            </div>
        </div>
    </div>

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

            // event.preventDefault();
            var part_code = part_code;
            $.ajax({
                type: 'POST'
                , url: "{{ route('part')}}"
                , data: {
                    part_code: part_code
                }
                , success: function(data) {
                    $('.part_name').html(data);

                }
            });


        }

    </script>


    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        function otp_pending() {
            $("input[name=otp_status]").val('OTP Pending');
            document.getElementById("submitform").click();
        }

    </script>

    <script>
        function sent_otp(phone, id) {

            var call_id = $("input[name=call_id]").val();
            var serial_no = $("input[name=serial_no]").val();
            var customer_name = $("input[name=customer_name]").val();
            var ch_status = $("input[name=ch_status]").val();
            var re_status = $("input[name=status]:checked").val();

            var service_type = $("input[name=service_type]").val();
            var partcodeArray = $("#part_code").val();

            var remarks = $("#remarks_message").val();

            if (remarks == '') {
                Swal.fire({
                    icon: 'error'
                    , title: 'Oops...'
                    , text: 'Please enter remarks'
                })
                return false;
            }

            if (re_status == 'Cancel request' || re_status == 'Reappoinment') {

                document.getElementById("submitform").click();
                return false;
            }


            if (!re_status) {
                Swal.fire({
                    icon: 'error'
                    , title: 'Oops...'
                    , text: 'Please choose status'
                })
                return false;
            }

            if (call_id == "" || customer_name == "") {
                Swal.fire({
                    icon: 'error'
                    , title: 'Oops...'
                    , text: 'Please enter all required fileds'
                })
                return false;
            }

            if (re_status == 'Closing request') {
                if (serial_no == '') {
                    Swal.fire({
                        icon: 'error'
                        , title: 'Oops...'
                        , text: 'Please enter serial no'
                    })
                    return false;
                }

            }



            if (re_status != 'Cancel request') {
                if (ch_status == 'Assigned' || ch_status == 'Allocated' || ch_status == 'Part pending' || ch_status == 'Reappoinment') {
                    if (service_type == 'Installation') {

                        var invoice_copy = $('#invoice_copy_data')[0].files.length;
                        var back_serial = $('#back_serial_data')[0].files.length;
                        var product_fit = $('#product_fit_data')[0].files.length;
                        var working_product = $('#working_product_data')[0].files.length;




                        if (invoice_copy == 0 || back_serial == 0 || product_fit == 0 || working_product == 0) {
                            Swal.fire({
                                icon: 'error'
                                , title: 'Oops...'
                                , text: 'Please choose required images'
                            })
                            return false;
                        }


                    } else {

                        if (re_status == 'Part pending') {
                            if (partcodeArray.length < 1) {
                                Swal.fire({
                                    icon: 'error'
                                    , title: 'Oops...'
                                    , text: 'Please choose part codes'
                                })
                                return false;

                            }

                            var oldpf = $("#oldproductfit").val();
                            var oldbs = $("#oldbackserial").val();
                            var oldin = $("#oldinvoice").val();
                            var oldsymptoms = $("#oldsymptoms").val();
                            var oldpanelserial = $("#oldpanelserial").val();
                            var oldwarranty = $("#oldwarranty").val();



                            var invoice_copy = oldin == 'no' ? $('#invoice_copy_data')[0].files.length : 1;
                            var back_serial = oldbs == 'no' ? $('#back_serial_data')[0].files.length : 1;
                            var product_fit = oldpf == 'no' ? $('#product_fit_data')[0].files.length : 1;
                            var symptoms_issue = oldsymptoms == 'no' ? $('#symptoms_issue_data')[0].files.length : 1;
                            var panel_serial = oldpanelserial == 'no' ? $('#panel_serial_data')[0].files.length : 1;
                            var warranty_card = oldwarranty == 'no' ? $('#warranty_card_data')[0].files.length : 1;


                            if (invoice_copy == 0 || back_serial == 0 || product_fit == 0 || symptoms_issue == 0 || panel_serial == 0 || warranty_card == 0) {
                                Swal.fire({
                                    icon: 'error'
                                    , title: 'Oops...'
                                    , text: 'Please choose required images'
                                })
                                return false;
                            }
                            document.getElementById("submitform").click();
                            return false;
                        } else {
                            var oldpf = $("#oldproductfit").val();
                            var oldbs = $("#oldbackserial").val();
                            var oldin = $("#oldinvoice").val();
                            var oldsymptoms = $("#oldsymptoms").val();


                            var invoice_copy = oldin == 'no' ? $('#invoice_copy_data')[0].files.length : 1;
                            var back_serial = oldbs == 'no' ? $('#back_serial_data')[0].files.length : 1;
                            var product_fit = oldpf == 'no' ? $('#product_fit_data')[0].files.length : 1;
                            var symptoms_issue = oldsymptoms == 'no' ? $('#symptoms_issue_data')[0].files.length : 1;
                            var working_product = $('#working_product_data')[0].files.length;



                            if (symptoms_issue == 0 || invoice_copy == 0 || back_serial == 0 || product_fit == 0 || working_product == 0) {
                                Swal.fire({
                                    icon: 'error'
                                    , title: 'Oops...'
                                    , text: 'Please choose required images'
                                })
                                return false;
                            }


                        }



                    }
                }
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var phone = phone;
            var template = 'complete';

            // event.preventDefault();
            $.ajax({
                type: 'POST'
                , url: "{{ route('sent.otp')}}"
                , data: {
                    phone: phone
                    , template: template
                }
                , success: function(val) {

                    if (val.status == true) {
                        $('#otp').modal('show');
                        var counttimer = 'countdowntimer';
                        var resent = 'resent';

                        var timeLeft = 600;
                        var elem = document.getElementById(counttimer);
                        var timerId = setInterval(function() {
                            if (timeLeft == -1) {
                                clearTimeout(timerId);
                                document.getElementById(resent).style.display = 'block';
                                document.getElementById(counttimer).style.display = 'none';
                                document.getElementById('timesubmit').style.display = 'none';

                            } else {
                                var mNew = Math.floor(timeLeft / 60);
                                var sNew = timeLeft % 60;

                                mNew = mNew < 10 ? '0' + mNew : mNew;
                                sNew = sNew < 10 ? '0' + sNew : sNew;
                                elem.innerHTML = mNew + ':' + sNew + ' minutes remaining';
                                timeLeft--;

                            }
                        }, 1000);
                    } else {
                        Swal.fire({
                            icon: 'error'
                            , title: 'Oops...'
                            , text: 'Sent OTP failed try again'
                        })
                        return false;
                    }
                }
            });


        }



        function otp_verify(phone) {

            var otp_number_data = 'otp_number';
            var otp = document.getElementById(otp_number_data).value;

            if (otp == '') {
                Swal.fire({
                    icon: 'error'
                    , title: 'Oops...'
                    , text: 'Please enter OTP'
                })
                return false;
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var phone = phone;

            // event.preventDefault();
            $.ajax({
                type: 'POST'
                , url: "{{ route('verify.otp')}}"
                , data: {
                    phone: phone
                    , otp: otp
                }
                , success: function(val) {

                    if (val.status == true) {
                        Swal.fire(
                            'Good job!'
                            , 'Enquiry status updated successfully!'
                            , 'success'
                        ).then(function() {
                               $("input[name=otp_status]").val('OTP Success');
                            document.getElementById("submitform").click();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error'
                            , title: 'Oops...'
                            , confirmButtonColor: "#ff0000"
                            , text: 'Invalid OTP'
                        })
                        return false;
                    }
                }
            });


        }


        function resent_otp(phone, id) {



            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var phone = phone;

            // event.preventDefault();
            $.ajax({
                type: 'POST'
                , url: "{{ route('resent.otp')}}"
                , data: {
                    phone: phone
                }
                , success: function(val) {

                    if (val.status == true) {
                        Swal.fire(
                            'Good job!'
                            , 'OTP resent successfully!'
                            , 'success'
                        );
                        var counttimer = 'countdowntimer';
                        var resent = 'resent';
                        document.getElementById(resent).style.display = 'none';
                        document.getElementById(counttimer).style.display = 'block';
                        document.getElementById('timesubmit').style.display = 'block';


                        var timeLeft = 600;
                        var elem = document.getElementById(counttimer);
                        var timerId = setInterval(function() {
                            if (timeLeft == -1) {
                                clearTimeout(timerId);
                                document.getElementById(resent).style.display = 'block';
                                document.getElementById(counttimer).style.display = 'none';
                                document.getElementById('timesubmit').style.display = 'none';

                            } else {
                                var mNew = Math.floor(timeLeft / 60);
                                var sNew = timeLeft % 60;

                                mNew = mNew < 10 ? '0' + mNew : mNew;
                                sNew = sNew < 10 ? '0' + sNew : sNew;
                                elem.innerHTML = mNew + ':' + sNew + ' minutes remaining';
                                timeLeft--;

                            }
                        }, 1000);
                    } else {
                        Swal.fire({
                            icon: 'error'
                            , title: 'Oops...'
                            , text: 'Resent OTP failed try again'
                        })
                        return false;
                    }
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
