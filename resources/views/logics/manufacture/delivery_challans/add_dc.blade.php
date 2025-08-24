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
                            <h5 class="card_title " style="color:#50aaca"> Create DC
                                <a href="{{ route('dc.master') }}" class="btn btn-primary btns">Manage Delivery Challan</a>
                            </h5>
                            <hr>
                            <form method="post" enctype="multipart/form-data" action="{{route('dc.store')}}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="forCustomerName">Customer Name<span style="color:red">&#9733;</span></label>
                                                    <select id="forCustomerName" required="" onchange="getCustomer(this.value)" name="customer_name" class="form-control customer_name selectsearch">
                                                        <option value="">Select Customer</option>
                                                        @foreach ($customers as $key => $vl)
                                                            <option value="{{ $vl->id }}"> {{ $vl->customer_type }} - {{ $vl->customer_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="forBillingAddress">Billing Address:</label>
                                                    <textarea readonly style="border: none;width:100%" rows="5" class="forBillingAddress" id="forBillingAddress" name="forBillingAddress"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="forShippingAddress">Shipping Address:</label>
                                                    <textarea readonly style="border: none;width:100%" rows="5" class="forShippingAddress" id="forShippingAddress" name="forShippingAddress"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="forCustomerMobileNo">Mobile No:</label>
                                                    <input readonly style="border: none;" id="forCustomerMobileNo" class="phone" name="customer_mobile"/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="forGSTNo">GSTIN No:</label>
                                                    <input readonly style="border: none;" id="forGSTNo" class="gstin_no" name="customer_gst_no"/>
                                                </div>
                                                
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-2">
                                                <div class="form-group">
                                                    <label for="forTermsofDelivery">Terms of Delivery</label>
                                                    <textarea id="forTermsofDelivery" type="text" name="forTermsofDelivery" class="form-control" rows="5"></textarea>
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
                                                    <label for="forInvoiceNo">DC No <span style="color:red">&#9733;</span></label>
                                                    <input readonly id="forInvoiceNo" value="{{$dc_no}}" type="text" name="dc_no" class="form-control" style="background: #efefef;">

                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="forInvoiceDate">DC Date</label>
                                                    <input id="forInvoiceDate" type="date" value="@php echo date('Y-m-d')@endphp" name="dc_date" class="form-control" placeholder="Date">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="forBuyerOrderNo">Buyer's Order No</label>
                                                    <input id="forBuyerOrderNo" type="text" name="forBuyerOrderNo" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="forBuyerOrderDate">Buyer's Order Date</label>
                                                    <input id="forBuyerOrderDate" type="date" name="forBuyerOrderDate" class="form-control" placeholder="Date">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="forDispatchDocNo">Dispatch Doc No</label>
                                                    <input id="forDispatchDocNo" type="text" name="forDispatchDocNo" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="forDispatchedThrough">Dispatched Through</label>
                                                    <input id="forDispatchedThrough" type="text" name="forDispatchedThrough" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="forDestination">Destination</label>
                                                    <input id="forDestination" type="text" name="forDestination" class="form-control">
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

                                            <div class="form-check form-check-inline">
                                                <input onclick="itemcode(this.value)" class="form-check-input" type="radio" name="item_type" id="forItemType3" value="NSG">
                                                <label class="form-check-label" for="forItemType3">Non Standard Goods</label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <input style="display: none;" class="itemType" type="text" name="item_type" id="itemType">
                                            <select id="forModelNo" onchange="model(this.value)" name="model_no" class="form-control model_no selectsearch">
                                                <option value="">Click Item to Add</option>
                                            </select>
                                        </div>
                                        <p class="custom-message" style="color:blue;font-size:18px;font-weight:bold;"></p>
                                    </div>
                                </div>

                                <hr>

                                <div class="table-responsive datatable-primary">
                                    <table id="dataTable" class="table text-center table-striped table-bordered" style="width: 100%;">
                                        <thead class="text-capitalize">
                                            <tr>
                                                <th>Item Code</th>
                                                <th>Description</th>
                                                <th>Additional Desc</th>
                                                <th>HSN/SAC Code</th>
                                                <th>Qty</th>
                                                <th>per UoM</th>
                                                <th>Rate</th>
                                                <th>Approx Value</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <input style="display: none;" class="itemType2" type="text" name="item_type2" id="itemType2">
                                                <td style="max-width:150px;"><input class="item_code form-control" type="text" name="item_code" id="item_code"></td>
                                                <td><textarea class="item_desc form-control" type="text" name="item_desc" id="item_desc"></textarea></td>
                                                <td><textarea class="item_addl_desc form-control" type="text" name="item_addl_desc" id="item_addl_desc"></textarea></td>
                                                <td style="max-width:150px;"><input class="item_hsnsac_code form-control" type="text" name="item_hsnsac_code" id="item_hsnsac_code"></td>
                                                <td class="text-left" style="max-width:80px;">
                                                    <input class="qty form-control" type="text" name="qty" id="qty">
                                                    <span style="font-size: 10px;">Total Qty: <label class="totalQty" name="totalQty" id="totalQty" style="font-size: 10px;"></label></span>
                                                </td>
                                                <td style="max-width:80px;"><input class="item_uom form-control" type="text" name="item_uom" id="item_uom"></td>
                                                <td style="max-width:120px;"><input class="rate form-control" type="text" name="rate" id="rate"></td>
                                                <td style="max-width:120px;"><input class="amount form-control" type="text" name="amount" id="amount" readonly style="border: none;"></td>

                                                <td class="editc">
                                                    <a class="insert-row" onclick="insertRow()"><i data-placement="top" title="Insert" class="fa fa-check" style="color:white; background: blue; box-shadow: none; border-radius: 3px; padding: 10px;"></i></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                    
                                <hr>

                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="forClientNote">Client Note</label>
                                                    <textarea class="form-control" id="forClientNote" name="forClientNote" rows="3">Thank you for the business</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="forRemarks">Remarks</label>
                                                    <textarea class="form-control" id="forRemarks" name="forRemarks" rows="3"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                    </div>
                                    
                                    <div class="col-md-4 mb-3">
                                        <table style="float: right;">
                                            <tbody>
                                                <tr>
                                                    <td><span style="font-size: 16px;">Total :</span></td>
                                                    <td></td>
                                                    <td>
                                                        <input id="subTotal" type="number" name="subTotal" class="form-control subTotal" style="border: 0px;" readonly>
                                                    </td>
                                                </tr>
                                                <!-- <tr>
                                                    <td><span style="font-size: 16px;">Discount</span></td>
                                                    <td></td>
                                                    <td>
                                                        <input id="forDiscount" type="number" name="discount" class="form-control discount" placeholder="Discount">
                                                        <span style="font-size:12px;color:red">Note: Enter Amount Value</span>
                                                    </td>
                                                </tr> -->
                                            </tbody>
                                        </table>
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

                <!-- Striped table start -->
                <div class="col-lg-12 stretched_card mt-mob-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card_title"></h4>
                            <div class="single-table">
                                <div class="table-responsive">
                                    <table class="table table-striped text-center dc">

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
    
    <script  type="text/javascript">
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
                type: 'POST'
                , url: "{{ route('dc.item.remove')}}"
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
                   val.status ? $('.dc').html(val.output):'';
                }
                , error: function(data) {
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
                url: "{{ route('dc.itemcode.select')}}",
                data: {
                    item_type: item_type
                },
                success: function(data) {
                    var val = JSON.parse(data);
                    var itemtype = val.item_type;
                    if (itemtype === 'NSG') {
                        // Show the select element with ID 'forModelNo'
                        $('.model_no').html(val.output);
                        $('.itemType2').val(itemtype);
                        // Display a custom message
                        $('.custom-message').show().text('Please Fill The Item Details Directly!');
                    } else {
                        // Show the select element with ID 'forModelNo'
                        $('.model_no').html(val.output);
                        $('.itemType').val(itemtype);

                        // Hide the custom message element
                        $('.custom-message').hide();
                    }
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
                url: "{{ route('dc.product.select')}}",
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
            $('.model_no').hide();
            // Add an input event listener to the rate input
            $('#rate').on('input', function() {
                // Get the values of qty and rate
                var qtyValue = parseFloat($('#qty').val()) || 0;
                var rateValue = parseFloat($(this).val()) || 0;

                // Calculate the amount by multiplying qty and rate
                var amountValue = qtyValue * rateValue;

                // Update the amount input
                $('#amount').val(amountValue.toFixed(2)); // Adjust the number of decimals as needed
            });
        });
        
        function insertRow() {
            // Get input values
            var dcNo = document.getElementById('forInvoiceNo').value;
            var dcDate = document.getElementById('forInvoiceDate').value;
            var itemType = document.getElementById('itemType2').value;
            var itemCode = document.getElementById('item_code').value;
            var itemDesc = document.getElementById('item_desc').value;
            var itemAddlDesc = document.getElementById('item_addl_desc').value;
            var itemHSNCode = document.getElementById('item_hsnsac_code').value;
            var itemPrice = document.getElementById('rate').value;

            // Check if the input is empty
            if (itemPrice === '') {
                itemPrice = 0;
            }
            var qty = document.getElementById('qty').value;
            var uom = document.getElementById('item_uom').value;
            var itemSubTotal = parseFloat(qty) * parseFloat(itemPrice);

            // Perform database insertion here using Ajax or another method
            // After successful insertion, append a new row to the table
            // For demonstration purposes, let's assume a successful insertion

            $.ajax({
                type: 'POST',
                url: "{{ route('dc.item.insert')}}",
                data: {
                    dcNo: dcNo,
                    dcDate: dcDate,
                    itemType: itemType,
                    itemCode: itemCode,
                    itemDesc: itemDesc,
                    itemAddlDesc: itemAddlDesc,
                    itemHSNCode: itemHSNCode,
                    itemPrice: itemPrice,
                    qty: qty,
                    uom: uom,
                    itemSubTotal: itemSubTotal
                },
                
                success: function(data) {
                    var val = JSON.parse(data);
                    $('#dataTable').append(val.output);
                    $('#subTotal').val(val.subTotalSum);
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
            var dcNo = document.getElementById('forInvoiceNo').value;
            var itemType = $(this).closest('tr').find('.itemType3').val();
            var itemCode = $(this).closest('tr').find('.item_code1').val();
            var qty = $(this).closest('tr').find('.qty1').val();

            var rowToRemove = $(this).closest('tr'); // Store the reference

            $.ajax({
                type: 'POST',
                url: "{{ route('dc.item.remove')}}",
                data: {
                    dcNo: dcNo,
                    itemCode: itemCode,
                    itemType: itemType, // Add this line if itemType is needed on the server-side
                    qty: qty // Add this line if qty is needed on the server-side
                },
                
                success: function(data) {
                    var val = JSON.parse(data);
                    $('#subTotal').val(val.subTotalSum);
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
            $('.itemType2').val('');
            $('.item_code').val('');
            $('.item_desc').val('');
            $('.qty').val('');
            $('.item_uom').val('');
            $('.rate').val('');
            $('.amount').val(0);
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    </script>
</body>

</html>
