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
                            <h5 class="card_title " style="color:#50aaca"> Edit Machine Bill
                                <a href="{{ route('mb.master') }}" class="btn btn-primary btns"> <i class="fa fa-plus-circle"></i>Manage Bills </a>
                            </h5>
                            <hr>
                            <form method="post" enctype="multipart/form-data" action="{{route('mb.update')}}">
                                @csrf

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="forBillingAddress">Billing Address<span style="color:red">&#9733;</span></label>
                                                    <textarea class="form-control" id="forBillingAddress" name="forBillingAddress" rows="3" required="">{{$invoices->customer_bill_address}}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="forShippingAddress">Shipping Address</label>
                                                    <textarea class="form-control" id="forShippingAddress" name="forShippingAddress" rows="3">{{$invoices->customer_ship_address}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="forCustomerMobileNo">Mobile No.<span style="color:red">&#9733;</span></label>
                                                    <input id="forCustomerMobileNo" required="" minlength="10" maxlength="10" type="text" class="form-control phone" name="customer_mobile" value="{{$invoices->customer_mobile_no}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="row">
                                            <div class="col-md-6">
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="forInvoiceNo">Bill No <span style="color:red">&#9733;</span></label>
                                                    <input readonly id="forInvoiceNo" value="{{$invoice_no}}" type="text" name="invoice_no" class="form-control" style="background: #efefef;">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="forInvoiceDate">Bill Date</label>
                                                    <input id="forInvoiceDate" type="date" value="{{date('Y-m-d',strtotime($invoices->invoice_date))}}" name="invoice_date" class="form-control" placeholder="Date">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <div class="form-group">
                                            <label class="form-check-label mr-3">Select Item:</label>
                                            <input style="display: none;" class="itemType" type="text" name="item_type" id="itemType" value="SPG">
                                            <select id="forModelNo" onchange="processItem(this.value)" name="model_no" class="form-control model_no selectsearch">
                                                <option value="">Click Item to Add</option>
                                                @foreach($rc_materials as $key => $vl)
                                                <option value="{{$vl->material_code}}">{{$vl->material_code}} - {{$vl->material_desc}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <label class="form-check-label">Category: <span class="material_category"></span></label><br/>
                                        <label class="form-check-label">Converted To Items: <span class="material_converted_items"></span></label><br/>
                                        <input style="display: none;" class="unProcessedItemCodeQty" type="text" name="unProcessedItemCodeQty" id="unProcessedItemCodeQty">
                                        <label class="form-check-label mr-3">Total Qty: <span class="material_qty"></span></label>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <div class="form-group">
                                            <label for="process_item" class="form-check-label mr-3">Select Processing Item:</label>
                                            <select id="process_item" onchange="model(this.value)" name="process_item" class="form-control model_no selectsearch">
                                                <option value="">Click Item to Add</option>
                                                @foreach($rc_materials as $key => $vl)
                                                <option value="{{$vl->material_code}}">{{$vl->material_code}} - {{$vl->material_desc}}</option>
                                                @endforeach
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
                                                <th>Category</th>
                                                <th>Qty</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <input style="display: none;" class="itemType2" type="text" name="item_type2" id="itemType2" value="SPG">
                                                <td><input class="item_code form-control" type="text" name="item_code" id="item_code"></td>
                                                <td><input class="item_desc form-control" type="text" name="item_desc" id="item_desc"></td>
                                                <td><input class="item_category form-control" type="text" name="item_category" id="item_category"></td>
                                                <td class="text-left">
                                                    <input class="qty form-control" type="text" name="qty" id="qty">
                                                    <span>Total Qty: <label class="totalQty" name="totalQty" id="totalQty"></label></span>
                                                </td>

                                                <td class="editc">
                                                    <a class="insert-row" onclick="insertRow()"><i data-placement="top" title="Insert" class="fa fa-plus" style="color:white; background: blue; box-shadow: none; border-radius: 3px; padding: 10px;"></i></a>
                                                </td>
                                            </tr>
                                            @foreach($invoice_details as $key=>$vl)
                                                <tr>
                                                    <td>
                                                        <input style="display: none; background: #e0e0e0;" class="itemType3" type="text" name="itemType3" id="itemType3" value="{{$vl->item_type}}">
                                                        <input style="background: #e0e0e0;" class="item_code1 form-control" type="text" name="item_code1" id="item_code1" value="{{$vl->item_code}}" readonly>
                                                    </td>
                                                    <td><input style="background: #e0e0e0;" class="item_desc1 form-control" type="text" name="item_desc1" id="item_desc1" value="{{$vl->item_desc}}" readonly></td>
                                                    <td><input style="background: #e0e0e0;" class="item_category1 form-control" type="text" name="item_category1" id="item_category1" value="{{$vl->item_category}}" readonly></td>
                                                    <td>
                                                        <input style="background: #e0e0e0;" class="qty1 form-control" type="text" name="qty1" id="qty1" value="{{$vl->item_qty}}" readonly>
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
                                                <label for="forClientNote">Client Note</label>
                                                <textarea class="form-control" id="forClientNote" name="forClientNote" rows="3">{{$invoices->client_note}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            
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
                url: "{{ route('mb.itemcode.select')}}",
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
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                url: "{{ route('mb.product.select')}}",
                data: {
                    model_no: model_no
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
                        $('.item_code').val(val.item_code);
                        $('.item_desc').val(val.item_desc);
                        $('.item_category').val(val.item_category);
                        $('.totalQty').text(val.totalQty);
                        $('.uom').text(val.uom);
                    }
                },
                error: function(data) {
                    swal({
                        type: "error",
                        title: "Error!",
                        text: "Please check the Material!",
                        confirmButtonText: "Dismiss",
                        buttonsStyling: !1,
                        confirmButtonClass: "btn btn-danger"
                    });
                }
            });
        }

        function processItem(model_no) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                url: "{{ route('mb.process.product.select')}}",
                data: {
                    model_no: model_no
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
                        $('.material_category').text(val.category); // Update category
                        $('.material_converted_items').text(val.converted_to_item_code); // Update converted_to_item_code
                        $('.material_qty').text(val.qty); // Update qty
                        $('.unProcessedItemCodeQty').val(val.qty); // Update qty
                    }
                },
                error: function(data) {
                    swal({
                        type: "error",
                        title: "Error!",
                        text: "Please check the Material!",
                        confirmButtonText: "Dismiss",
                        buttonsStyling: !1,
                        confirmButtonClass: "btn btn-danger"
                    });
                }
            });
        }
        
        function insertRow() {
            // Get input values
            var invoiceNo = document.getElementById('forInvoiceNo').value;
            var invoiceDate = document.getElementById('forInvoiceDate').value;
            var unprocessed_item_code = document.getElementById('forModelNo').value;
            var unprocessed_item_code_qty = document.getElementById('unProcessedItemCodeQty').value;
            var itemType = document.getElementById('itemType2').value;
            var itemCode = document.getElementById('item_code').value;
            var itemDesc = document.getElementById('item_desc').value;
            var itemCategory = document.getElementById('item_category').value;
            var qty = document.getElementById('qty').value;

            // Perform database insertion here using Ajax or another method
            // After successful insertion, append a new row to the table
            // For demonstration purposes, let's assume a successful insertion

            $.ajax({
                type: 'POST',
                url: "{{ route('mb.item.insert')}}",
                data: {
                    invoiceNo: invoiceNo,
                    invoiceDate: invoiceDate,
                    unprocessed_item_code: unprocessed_item_code,
                    unprocessed_item_code_qty: unprocessed_item_code_qty,
                    itemType: itemType,
                    itemCode: itemCode,
                    itemDesc: itemDesc,
                    itemCategory: itemCategory,
                    qty: qty
                },
                
                success: function(data) {
                    var val = JSON.parse(data);
                    $('#dataTable').append(val.output);
                    $('.material_qty').text(val.subtractQty); // Update qty
                    $('.unProcessedItemCodeQty').val(val.subtractQty); // Update qty
                    clearlist();
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
            var unprocessed_item_code = document.getElementById('forModelNo').value;
            var itemType = $(this).closest('tr').find('.itemType3').val();
            var itemCode = $(this).closest('tr').find('.item_code1').val();
            var qty = $(this).closest('tr').find('.qty1').val();

            var rowToRemove = $(this).closest('tr'); // Store the reference

            $.ajax({
                type: 'POST',
                url: "{{ route('mb.item.remove')}}",
                data: {
                    invoiceNo: invoiceNo,
                    unprocessed_item_code: unprocessed_item_code,
                    itemCode: itemCode,
                    itemType: itemType, // Add this line if itemType is needed on the server-side
                    qty: qty // Add this line if qty is needed on the server-side
                },
                
                success: function(data) {
                    var val = JSON.parse(data);
                    // $('#subTotal').val(val.subTotalSum);
                    // $('#netTotal').val(val.netTotalSum);
                    // $('#gstPercentage').val(val.gstAveragePercentage);
                    // $('#gstAmount').val(val.gstAvgAmount);
                    rowToRemove.remove(); // Use the stored reference to remove the row
                    $('.material_qty').text(val.updatedQty); // Update qty
                    $('.unProcessedItemCodeQty').val(val.updatedQty); // Update qty
                    clearlist();
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
            $('.item_code').val('');
            $('.item_desc').val('');
            $('.item_category').val('');
            $('.qty').val('');
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    </script>
</body>

</html>
