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
                            <h5 class="card_title " style="color:#50aaca"> Add Item Loss
                                <a href="{{ route('la.master') }}" class="btn btn-primary btns">Manage L&As</a>
                            </h5>
                            <hr>
                            <form method="post" enctype="multipart/form-data" action="{{route('la.store')}}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="row">
                                            
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="forInvoiceNo">L&A No <span style="color:red">&#9733;</span></label>
                                                    <input readonly id="forInvoiceNo" value="{{$invoice_no}}" type="text" name="invoice_no" class="form-control" style="background: #efefef;">

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="forInvoiceDate">L&A Date</label>
                                                    <input id="forInvoiceDate" type="date" value="@php echo date('Y-m-d')@endphp" name="invoice_date" class="form-control" placeholder="Date">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                
                                            </div>
                                            <div class="col-md-6">
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
                                                <th>Qty</th>
                                                <th>Process Code</th>
                                                <th>Remarks</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <input style="display: none;" class="itemType2" type="text" name="item_type2" id="itemType2">
                                                <td><input class="item_code form-control" type="text" name="item_code" id="item_code"></td>
                                                <td><input class="item_desc form-control" type="text" name="item_desc" id="item_desc"></td>
                                                <td class="text-left">
                                                    <input class="qty form-control" type="text" name="qty" id="qty">
                                                    <span>Total Qty: <label class="totalQty" name="totalQty" id="totalQty"></label></span>
                                                </td>
                                                <td><input class="operation_name form-control" type="text" name="operation_name" id="operation_name"></td>
                                                <td><input class="remarks form-control" type="text" name="remarks" id="remarks"></td>

                                                <td class="editc">
                                                    <a class="insert-row" onclick="insertRow()"><i data-placement="top" title="Insert" class="fa fa-plus" style="color:white; background: blue; box-shadow: none; border-radius: 3px; padding: 10px;"></i></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                
                                <hr>

                                <div>
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <div class="form-group">
                                                <label for="forClientNote">Note</label>
                                                <textarea class="form-control" id="forClientNote" name="forClientNote" rows="3">Items verified and handovered.</textarea>
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

    </div>

    <!--=========================*
        End Page Container
    *===========================-->


    <!--=========================*
        General Scripts
    *===========================-->

    <script  type="text/javascript">
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
                url: "{{ route('la.item.remove')}}",
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
                url: "{{ route('la.itemcode.select')}}",
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
                url: "{{ route('la.product.select')}}",
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
            var invoiceNo = document.getElementById('forInvoiceNo').value;
            var invoiceDate = document.getElementById('forInvoiceDate').value;
            var itemType = document.getElementById('itemType2').value;
            var itemCode = document.getElementById('item_code').value;
            var itemDesc = document.getElementById('item_desc').value;
            var qty = document.getElementById('qty').value;
            var operation_name = document.getElementById('operation_name').value;
            var remarks = document.getElementById('remarks').value;

            // Perform database insertion here using Ajax or another method
            // After successful insertion, append a new row to the table
            // For demonstration purposes, let's assume a successful insertion

            $.ajax({
                type: 'POST',
                url: "{{ route('la.item.insert')}}",
                data: {
                    invoiceNo: invoiceNo,
                    invoiceDate: invoiceDate,
                    itemType: itemType,
                    itemCode: itemCode,
                    itemDesc: itemDesc,
                    qty: qty,
                    operation_name:operation_name,
                    remarks: remarks
                },
                
                success: function(data) {
                    var val = JSON.parse(data);
                    $('#dataTable').append(val.output);
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
                url: "{{ route('la.item.remove')}}",
                data: {
                    invoiceNo: invoiceNo,
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
            $('.operation_name').val('');
            $('.remarks').val('');
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
    </script>
</body>

</html>
