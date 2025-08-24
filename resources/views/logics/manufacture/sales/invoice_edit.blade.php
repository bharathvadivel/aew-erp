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
                <!-- Disabled forms start -->
                <div class="col-12 mt-4" style="margin-top:0!important;">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card_title " style="color:#50aaca"> Edit Invoice
                                <a href="{{ route('invoice.master') }}" class="btn btn-primary btns"> <i class="fa fa-plus-circle"></i>Manage invoice </a>
                            </h5>
                            <hr>
                            <form method="post" enctype="multipart/form-data" action="{{route('invoice.update')}}">
                                @csrf

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="forCustomerName">Customer Name<span style="color:red">&#9733;</span></label>
                                                <select id="forCustomerName" required="" onchange="getinwdCustomer(this.value)" name="customer_name" class="form-control customer_name selectsearch">
                                                    <option value="">Select Customer</option>
                                                    @foreach ($customers as $key => $vl)
                                                        <option value="{{ $vl->id }}" @if ($vl->id == $customer_id) selected @endif> {{ $vl->customer_type }} - {{ $vl->customer_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        @php
                                            $getCustomer = DB::table('contacts')->where('id', $customer_id)->first();
                                        @endphp
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="forBillingAddress">Billing Address:<span style="color:red">&#9733;</span></label><br>
                                                    <textarea readonly style="border: none;width:100%" rows="5" class="forBillingAddress" id="forBillingAddress" name="forBillingAddress">{{$getCustomer->customer_billing_address}}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="forShippingAddress">Shipping Address:</label>
                                                    <textarea readonly style="border: none;width:100%" rows="5" class="forShippingAddress" id="forShippingAddress" name="forShippingAddress">{{$getCustomer->customer_shipping_address}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <!-- <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="forCustomerMobileNo">Mobile No.<span style="color:red">&#9733;</span></label>
                                                    <input readonly id="forCustomerMobileNo" required="" type="text" class="form-control phone" style="border: none;" name="phone">
                                                </div>
                                            </div> -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="forGSTNo">GSTIN No.</label>
                                                    <input readonly id="forGSTNo" type="text" class="form-control gstin_no" name="gstin_no" style="border: none;">
                                                </div>
                                            </div>
                                            <div class="col-md-6"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-2">
                                                <div class="form-group">
                                                    <label for="forTermsofDelivery">Terms of Delivery</label>
                                                    <textarea id="forTermsofDelivery" type="text" name="forTermsofDelivery" class="form-control" rows="5">{{$invoices->terms_of_delivery}}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-2">
                                                <div class="form-group">
                                                    <label for="forDeliveryNote">Delivery Note</label>
                                                    <input id="forDeliveryNote" type="text" name="forDeliveryNote" class="form-control forDeliveryNote" value="{{$invoices->delivery_note}}">
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <div class="form-group">
                                                    <label for="forDeliveryNoteDate">Delivery Note Date</label>
                                                    <input id="forDeliveryNoteDate" type="date" name="forDeliveryNoteDate" class="form-control forDeliveryNoteDate" placeholder="Date" value="{{$invoices->delivery_note_date ? date('d-m-Y',strtotime($invoices->delivery_note_date)) : ''}}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-2">
                                                <div class="form-group">
                                                    <label for="forTermsPayment">Mode/Terms of Payment</label>
                                                    <input id="forTermsPayment" type="text" name="forTermsPayment" class="form-control forTermsPayment" value="{{$invoices->terms_of_payment}}">
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="row">
                                            <div class="col-md-6">
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="forInvoiceNo">invoice no <span style="color:red">&#9733;</span></label>
                                                    <input id="forInvoiceNo" value="{{$invoice_no}}" type="text" name="invoice_no" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="forInvoiceDate">Invoice Date</label>
                                                    <input id="forInvoiceDate" type="date" value="{{date('Y-m-d',strtotime($invoices->invoice_date))}}" name="invoice_date" class="form-control" placeholder="Date">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="forBuyerOrderNo">Buyer's Order No</label>
                                                    <input id="forBuyerOrderNo" type="text" name="forBuyerOrderNo" class="form-control forBuyerOrderNo" value="{{$invoices->buyer_order_no}}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="forBuyerOrderDate">Buyer's Order Date</label>
                                                    <input id="forBuyerOrderDate" type="date" name="forBuyerOrderDate" class="form-control forBuyerOrderDate" placeholder="Date" value="{{$invoices->buyer_order_date ? date('Y-m-d',strtotime($invoices->buyer_order_date)) : ''}}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="forDispatchDocNo">Dispatch Doc No</label>
                                                    <input id="forDispatchDocNo" type="text" name="forDispatchDocNo" class="form-control forDispatchDocNo" value="{{$invoices->dispatch_doc_no}}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="forDispatchedThrough">Dispatched Through</label>
                                                    <input id="forDispatchedThrough" type="text" name="forDispatchedThrough" class="form-control forDispatchedThrough" value="{{$invoices->dispatch_through}}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="forDestination">Destination</label>
                                                    <input id="forDestination" type="text" name="forDestination" class="form-control forDestination" value="{{$invoices->destination}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <div class="form-group">
                                            <label class="form-check-label mr-3">Select Item Type:</label>
                                            <div class="form-check form-check-inline">
                                                <input onclick="itemcode(this.value)" class="form-check-input" type="radio" name="item_type" id="forItemType1" value="SPG">
                                                <label class="form-check-label" for="forItemType1">Spare Part Goods</label>
                                            </div>     
                                            
                                            <div class="form-check form-check-inline">
                                                <input onclick="itemcode(this.value)" class="form-check-input" type="radio" name="item_type" id="forItemType2" value="FAG">
                                                <label class="form-check-label" for="forItemType2">Fully Assembled Goods</label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <input style="display: none;" class="itemType" type="text" name="item_type" id="itemType">
                                            <select id="forModelNo" onchange="model(this.value)" name="model_no" class="form-control model_no selectsearch">
                                                <option value="">Click Item to Add</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <div class="table-responsive datatable-primary">
                                    <table id="dataTable" class="table text-center table-striped table-bordered" style="width: 100%;">
                                        <thead class="text-capitalize">
                                            <tr>
                                                <th>Item</th>
                                                <th>Description</th>
                                                <th>HSN/SAC Code</th>
                                                <th>Qty</th>
                                                <th>per UoM</th>
                                                <th>Rate</th>
                                                <th>GST %</th>
                                                <th>Amount</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td style="max-width:150px;">
                                                    <input style="display: none;" class="itemType2" type="text" name="item_type2" id="itemType2">
                                                    <input class="item_code form-control" type="text" name="item_code" id="item_code">
                                                </td>
                                                <td>
                                                    <input class="item_desc form-control" type="text" name="item_desc" id="item_desc">
                                                    <br>
                                                    <b>Additional Description:</b>
                                                    <input class="item_add_desc form-control" type="text" name="item_add_desc" id="item_add_desc">
                                                </td>
                                                <td style="max-width:150px;"><input class="item_hsnsac_code form-control" type="text" name="item_hsnsac_code" id="item_hsnsac_code"></td>
                                                <td style="max-width:80px;">
                                                    <input class="qty form-control" type="text" name="qty" id="qty">
                                                    <span>Total Qty: <label class="totalQty" name="totalQty" id="totalQty"></label></span>
                                                </td>
                                                <td style="max-width:80px;"><input class="item_uom form-control" type="text" name="item_uom" id="item_uom"></td>
                                                <td style="max-width:120px;"><input class="rate form-control" type="text" name="rate" id="rate"></td>
                                                <td style="max-width:80px;"><input class="tax form-control" type="text" name="tax" id="tax"></td>
                                                <td style="max-width:120px;"><input class="amount form-control" type="text" name="amount" id="amount" readonly style="background:none;border: none;"></td>

                                                <td class="editc">
                                                    <a class="insert-row" onclick="insertRow()"><i data-placement="top" title="Insert" class="fa fa-check" style="color:white; background: blue; box-shadow: none; border-radius: 3px; padding: 10px;"></i></a>
                                                </td>
                                            </tr>
                                            @foreach($invoice_details as $key=>$vl)
                                                <tr>
                                                    <td style="max-width:150px;">
                                                        <input style="display: none;" class="itemType3" type="text" name="item_type3" id="itemType3" value="{{$vl->item_type}}">
                                                        <input style="background:none;border:none;" class="item_code1 form-control" type="text" name="item_code1" id="item_code1" value="{{$vl->item_code}}" readonly>
                                                    </td>
                                                    <td>
                                                        <input style="background:none;border:none;" class="item_desc1 form-control" type="text" name="item_desc1" id="item_desc1" value="{{$vl->item_desc}}" readonly>
                                                        <br>
                                                        <b>Additional Description:</b>
                                                        <input style="background:none;border:none;" class="item_add_desc1 form-control" type="text" name="item_add_desc1" id="item_add_desc1" value="{{$vl->item_add_desc}}" readonly>
                                                    </td>
                                                    <td style="max-width:150px;">
                                                        <input style="background:none;border:none;" class="item_hsnsac_code1 form-control" type="text" name="item_hsnsac_code1" id="item_hsnsac_code1" value="{{$vl->item_hsnsac_code}}" readonly>
                                                    </td>
                                                    <td style="max-width:80px;">
                                                        <input style="background:none;border:none;" class="qty1 form-control" type="text" name="qty1" id="qty1" value="{{$vl->item_qty}}" readonly>
                                                    </td>
                                                    <td style="max-width:80px;">
                                                        <input style="background:none;border:none;" class="item_uom1 form-control" type="text" name="item_uom1" id="item_uom1" value="{{$vl->item_uom}}" readonly>
                                                    </td>
                                                    <td style="max-width:120px;">
                                                        <input style="background:none;border:none;" class="rate1 form-control" type="text" name="rate1" id="rate1" value="{{$vl->item_price}}" readonly>
                                                    </td>
                                                    <td style="max-width:80px;">
                                                        <input style="background:none;border:none;" class="tax1 form-control" type="text" name="tax1" id="tax1" value="{{$vl->item_gst_percent}}" readonly>
                                                    </td>
                                                    <td style="max-width:120px;">
                                                        <input style="background:none;border:none;" class="amount1 form-control" type="text" name="amount1" id="amount1" value="{{$vl->item_net_total}}" readonly>
                                                    </td>
                                                    <td class="editc">
                                                        <a class="delete-row"><i data-placement="top" title="Delete" class="fa fa-trash" style="color:white; background: red; box-shadow: none; border-radius: 3px; padding: 10px;"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                
                                <hr>

                                <div>
                                <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <div class="form-group">
                                                <label for="forClientNote">Declaration</label>
                                                <textarea class="form-control" id="forClientNote" name="forClientNote" rows="3">{{$invoices->declaration}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <table style="float: right;">
                                                <tbody>
                                                    <tr>
                                                        <td><span style="font-size: 16px;">Sub Total :</span></td>
                                                        <td></td>
                                                        <td>
                                                            <input id="subTotal" type="number" name="subTotal" class="form-control subTotal" style="background:none;border:none;" value="{{$invoices->subtotal}}" readonly>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><span style="font-size: 16px;">Discount</span></td>
                                                        <td></td>
                                                        <td>
                                                            <input id="forDiscount" type="number" name="discount" value="0" class="form-control discount" value="{{$invoices->discount}}">
                                                            <span style="font-size:12px;color:red">Note: Enter Amount Value</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><span style="font-size: 16px;">Taxable Value :</span></td>
                                                        <td></td>
                                                        <td>
                                                            <input id="taxTotal" type="number" name="taxTotal" class="form-control taxTotal" style="background:none;border:none;" value="{{$invoices->taxable_value}}" readonly>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="font-size: 16px;">GST :</td>
                                                        <td><input style="width: 100px;background:none;border:none;" id="gstPercentage" type="number" step="0.01" name="gstPercentage" class="form-control gstPercentage" value="{{$invoices->gst_percentage}}"></td>
                                                        <td style="font-size: 16px;">
                                                            <input id="gstAmount" type="number" step="0.01" name="gstAmount" class="form-control gstAmount" style="background:none;border:none;" value="{{$invoices->total_gst_amount}}" readonly>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><span style="font-size: 16px;">Net Total :</span></td>
                                                        <td></td>
                                                        <td>
                                                            <input id="netTotal" type="number" name="netTotal" class="form-control netTotal" style="background:none;border:none;" value="{{$invoices->net_total}}" readonly>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>

                                <div>
                                    <input type="submit" name="submit" class="btn btn-primary mt-4 pl-4 pr-4">
                                </div>

                                <div class="form-row">
                                    <span style="color:red">&#9733;</span>
                                    <p>- Mandatory field</p>
                                </div>

                            </form>
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

        <footer>
            @include('logics.include.footer_select')
        </footer>
        <!--=================================*
                    End Footer Section
        *===================================-->

    <!--=========================*
        End Page Container
    *===========================-->


    <!--=========================*
        General Scripts
    *===========================-->
    <script>
        // Attach the change event to the forDiscount input field
        $('#forDiscount').on('keyup', function() {
            var discount = document.getElementById("forDiscount").value;
            // Assuming you have subTotal and taxTotal elements with appropriate IDs
            var subTotal = parseFloat($('#subTotal').val()) || 0;
            var gstPercentage = parseFloat($('#gstPercentage').val()) || 0;
            var taxTotal = subTotal - parseFloat(discount) || 0;

            var gstAmount = parseFloat(taxTotal*(gstPercentage/100));
            var netTotal = parseFloat(gstAmount+taxTotal);

            // Set the calculated taxTotal value
            $('#taxTotal').val(taxTotal.toFixed(2));
            $('#gstAmount').val(gstAmount.toFixed(2));
            $('#netTotal').val(netTotal.toFixed(2));
        });

        function getCustomer(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                url: "{{ route('get.customer.data.by.id')}}",
                data: {
                    customer_id: id
                },
                
                success: function(data) {
                    var val = JSON.parse(data)[0];
                    $('.forBillingAddress').text(val.customer_billing_address);
                    $('.forShippingAddress').text(val.customer_shipping_address);
                    $('.phone').val(val.customer_mobile_no);
                    $('.gstin_no').val(val.customer_gst_no);
                },
                error: function(data) {
                    swal({
                        type: "error",
                        title: "Error!",
                        text: "something went wrong!",
                        confirmButtonText: "Dismiss",
                        buttonsStyling: !1,
                        confirmButtonClass: "btn btn-danger"
                    });
                }
            });
        }

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
            $.ajax({
                type: 'POST',
                url: "{{ route('invoice.item.remove')}}",
                data: {
                    id: id,
                },
                success: function(data) {
                    var val = JSON.parse(data);
                    swal({
                        type: "error",
                        title: "Warning!",
                        text: val.message,
                        confirmButtonText: "Ok",
                        buttonsStyling: !1,
                        confirmButtonClass: "btn btn-danger"
                    });
                   val.status ? $('.invoice').html(val.output):'';
                },
                error: function(data) {
                    swal({
                        type: "error",
                        title: "Error!",
                        text: "Something went wrong!",
                        confirmButtonText: "Dismiss",
                        buttonsStyling: !1,
                        confirmButtonClass: "btn btn-danger"
                    })
                },
            });
        }

        function itemcode(item_type) {

            if (item_type == '') {
                alert('Please Choose Item Type');
                return false;
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // event.preventDefault();

            $.ajax({
                type: 'POST',
                url: "{{ route('inv.itemcode.select')}}",
                data: {
                    item_type: item_type
                },
                success: function(data) {
                    var val = JSON.parse(data);
                    $('.model_no').html(val.output);
                    $('.itemType').val(val.item_type);
                },
                error: function(data) {
                    swal({
                        type: "error",
                        title: "Error!",
                        text: "Please check Item Type!",
                        confirmButtonText: "Dismiss",
                        buttonsStyling: !1,
                        confirmButtonClass: "btn btn-danger"
                    });
                    clearlist();
                }
            });
        }

        function model(model_no) {
            var itemType = document.getElementById("itemType").value;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                url: "{{ route('inv.product.select')}}",
                data: {
                    model_no: model_no,
                    itemType: itemType
                },
                
                success: function(data) {
                    var val = JSON.parse(data);
                    if (val.error) {
                        swal({
                            type: "error",
                            title: "Error!",
                            text: val.error,
                            confirmButtonText: "Dismiss",
                            buttonsStyling: false,
                            confirmButtonClass: "btn btn-danger"
                        });
                    } else {
                        $('.itemType2').val(val.itemType);
                        $('.item_code').val(val.item_code);
                        $('.item_desc').val(val.item_desc);
                        $('.totalQty').text(val.totalQty);
                        $('.uom').text(val.uom);
                    }
                },
                error: function(data) {
                    swal({
                        type: "error",
                        title: "Error!",
                        text: "Please check the Material or Model!",
                        confirmButtonText: "Dismiss",
                        buttonsStyling: !1,
                        confirmButtonClass: "btn btn-danger"
                    });
                }
            });
        }

        // Wait for the document to be ready
        $(document).ready(function() {
            // Add an input event listener to the rate input
            $('#qty').on('input', function() {
                // Get the values of qty and rate
                var qtyValue = parseFloat($(this).val()) || 0;
                var taxpercent = parseFloat($('#tax').val()) || 0;
                var rateValue = parseFloat($('#rate').val()) || 0;

                // Calculate the amount by multiplying qty and rate
                var amountValue = qtyValue * rateValue;
                var taxamountValue = (amountValue+(amountValue*(taxpercent/100)));

                // Update the amount input
                $('#amount').val(taxamountValue.toFixed(2)); // Adjust the number of decimals as needed
            });

            // Add an input event listener to the rate input
            $('#rate').on('input', function() {
                // Get the values of qty and rate
                var qtyValue = parseFloat($('#qty').val()) || 0;
                var taxpercent = parseFloat($('#tax').val()) || 0;
                var rateValue = parseFloat($(this).val()) || 0;

                // Calculate the amount by multiplying qty and rate
                var amountValue = qtyValue * rateValue;
                var taxamountValue = (amountValue+(amountValue*(taxpercent/100)));

                // Update the amount input
                $('#amount').val(taxamountValue.toFixed(2)); // Adjust the number of decimals as needed
            });

            $('#tax').on('input', function() {
                // Get the values of qty and rate
                var qtyValue = parseFloat($('#qty').val()) || 0;
                var taxpercent = parseFloat($(this).val()) || 0;
                var rateValue = parseFloat($('#rate').val()) || 0;

                // Calculate the amount by multiplying qty and rate
                var amountValue = qtyValue * rateValue;
                var taxamountValue = (amountValue+(amountValue*(taxpercent/100)));

                // Update the amount input
                $('#amount').val(taxamountValue.toFixed(2)); // Adjust the number of decimals as needed
            });
        });
        
        function insertRow() {
            // Get input values
            var invoiceNo = document.getElementById('forInvoiceNo').value;
            var itemType = document.getElementById('itemType2').value;
            var itemCode = document.getElementById('item_code').value;
            var itemDesc = document.getElementById('item_desc').value;
            var itemAddDesc = document.getElementById('item_add_desc').value;
            var item_hsnsac_code = document.getElementById('item_hsnsac_code').value;
            var qty = document.getElementById('qty').value;
            var item_uom = document.getElementById('item_uom').value;
            var itemPrice = document.getElementById('rate').value;
            var itemSubTotal = parseFloat(qty) * parseFloat(itemPrice);
            var tax = document.getElementById('tax').value;
            var tax_amount = parseFloat((itemSubTotal*(tax/100)));

            var state_gst_percent = parseInt(tax/2);
            var state_tax_amount = parseFloat((itemSubTotal*(state_gst_percent/100)));

            var central_gst_percent = parseInt(tax/2);
            var central_tax_amount = parseFloat((itemSubTotal*(central_gst_percent/100)));

            var netTotal = parseFloat(itemSubTotal+(itemSubTotal*(tax/100)));

            // Perform database insertion here using Ajax or another method
            // After successful insertion, append a new row to the table
            // For demonstration purposes, let's assume a successful insertion

            $.ajax({
                type: 'POST',
                url: "{{ route('invoice.item.insert')}}",
                data: {
                    invoiceNo: invoiceNo,
                    itemType: itemType,
                    itemCode: itemCode,
                    itemDesc: itemDesc,
                    itemAddDesc: itemAddDesc,
                    item_hsnsac_code: item_hsnsac_code,
                    qty: qty,
                    item_uom: item_uom,
                    itemPrice: itemPrice,
                    itemSubTotal: itemSubTotal,
                    tax: tax,
                    tax_amount: tax_amount,
                    state_gst_percent: state_gst_percent,
                    state_tax_amount: state_tax_amount,
                    central_gst_percent: central_gst_percent,
                    central_tax_amount: central_tax_amount,
                    netTotal: netTotal
                },
                
                success: function(data) {
                    var val = JSON.parse(data);
                    $('#dataTable').append(val.output);
                    $('#subTotal').val(val.subTotalSum);
                    $('#taxTotal').val(val.subTotalSum);
                    $('#netTotal').val(val.netTotalSum);
                    $('#gstPercentage').val(val.gstAveragePercentage);
                    $('#gstAmount').val(val.gstAvgAmount);
                },
                error: function(data) {
                    swal({
                        type: "error",
                        title: "Error!",
                        text: "Something went wrong, Try again later!",
                        confirmButtonText: "Dismiss",
                        buttonsStyling: !1,
                        confirmButtonClass: "btn btn-danger"
                    });
                    clearlist();
                }
            });
            clearlist();
        }

        // Event delegation for dynamically added elements
        $('#dataTable').on('click', '.delete-row', function() {
            var invoiceNo = document.getElementById('forInvoiceNo').value;
            var itemType = $(this).closest('tr').find('.itemType3').val();
            var itemCode = $(this).closest('tr').find('.item_code1').val();
            var qty = $(this).closest('tr').find('.qty1').val();

            var rowToRemove = $(this).closest('tr'); // Store the reference

            $.ajax({
                type: 'POST',
                url: "{{ route('invoice.item.remove')}}",
                data: {
                    invoiceNo: invoiceNo,
                    itemCode: itemCode,
                    itemType: itemType, // Add this line if itemType is needed on the server-side
                    qty: qty // Add this line if qty is needed on the server-side
                },
                
                success: function(data) {
                    var val = JSON.parse(data);
                    $('#subTotal').val(val.subTotalSum);
                    $('#netTotal').val(val.netTotalSum);
                    $('#gstPercentage').val(val.gstAveragePercentage);
                    $('#gstAmount').val(val.gstAvgAmount);
                    rowToRemove.remove(); // Use the stored reference to remove the row
                },
                error: function(data) {
                    swal({
                        type: "error",
                        title: "Error!",
                        text: "Something went wrong, Try again later!",
                        confirmButtonText: "Dismiss",
                        buttonsStyling: !1,
                        confirmButtonClass: "btn btn-danger"
                    });
                    clearlist();
                }
            });
            clearlist();
        });
    
        function clearlist() {
            // Reset radio buttons
            $('input[name="item_type"]').prop('checked', false);

            // Reset select input
            $('#forModelNo')
                .find('option')
                .remove()
                .end()
                .append('<option value=""></option>')
                .val('')
            ;

            $('.itemType2').val('');
            $('.item_code').val('');
            $('.item_desc').val('');
            $('.item_add_desc').val('');
            $('.item_hsnsac_code').val('');
            $('.qty').val('');
            $('.item_uom').val('');
            $('.rate').val('');
            $('.tax').val(0);
            $('.amount').val(0);
            $('.discount').val(0);
            $('.taxTotal').val(0);
            $('.totalQty').text(0);
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        

    </script>
</body>

</html>
