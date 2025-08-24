<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <script src="{{asset('user/new_js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('user/new_js/jquery.js')}}"></script>
    <link rel="stylesheet" href="{{asset('user/new_css/bootstrap.min.css')}}">
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
   .extra
   {
        font-size: 20px;
        background-color: #ffffff;
        padding-top: 10px;
        padding-bottom: 10px;
        border-radius: 5px;
    }

    .mt-4 {
        margin-top: 0 rem!important;
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
            @include('login.flash')
            <div class="row">
                <!-- Disabled forms start -->
                <div class="col-12 mt-4" style="margin-top:0!important;">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card_title " style="color:#50aaca"> Add Item
                                <a href="{{ route('material.master') }}" class="btn btn-primary btns" > <i class="fa fa-plus-circle"></i>Manage Items</a>
                            </h5>
                            <hr>
                            <form method="post" action="{{route('material.store')}}">
                                @csrf

                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="disabledSelect">Item Group <span style="color:red">&#9733;</span></label>
                                            <select name="item_group_code" class="form-control">
                                                <option value="">Select Item Group</option>
                                                @foreach ($item_groups as $key)
                                                    <option {{old('material')==$key->item_group_code ? 'selected':'' }} value="{{ $key->item_group_code }}">{{ $key->item_group_code }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Item Code <span style="color:red">&#9733;</span></label>
                                            <input type="text" value="{{old('material')}}" required="" name="material_code" id="material_code" class="form-control" placeholder="Item Code">
                                            <div id="materialCodeError" style="color: red;"></div>
                                        </div>
                                    </div>

                                    <div class="col-3">
                                        <div class="form-group">
                                            <label class="form-check-label mr-3">Consider for Build Count?</label><br/>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" value="yes" type="radio" id="consider_build1" name="consider_build" checked>
                                                <label class="form-check-label" for="consider_build1" style="margin-right:15px;">Yes</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" value="no" type="radio" id="consider_build2" name="consider_build">
                                                <label class="form-check-label" for="consider_build2">No</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="disabledTextInput">Item Group Description <span style="color:red">&#9733;</span></label>
                                    <input type="text" value="{{old('material')}}" required="" name="item_group_desc" class="form-control" placeholder="Item Group Description">
                                    <span style="font-size: 12px;font-weight: 500;">Changing item description will automatically updated in item_group data too.</span>
                                </div>
                                
                                <div class="form-group">
                                    <label for="disabledTextInput">Item Description <span style="color:red">&#9733;</span></label>
                                    <input type="text" value="{{old('material')}}" required="" name="material_desc" class="form-control" placeholder="Item Description">
                                </div>

                                <div class="form-group">
                                    <label for="category">Category<span style="color:red">&#9733;</span></label>
                                    <select name="category" id="category" class="form-control">
                                        <option value="">Select Unit</option>
                                        <option value="Casting">Casting</option>
                                        <option value="Rough Casting">Rough Casting</option>
                                        <option value="Machining Ref">Machining Ref</option>
                                        <option value="Packing">Packing</option>
                                        <option value="Rotor with Shaft">Rotor with Shaft</option>
                                        <option value="SS Body">SS Body</option>
                                        <option value="Stampings">Stampings</option>
                                        <option value="Store items">Store items</option>
                                        <option value="Winding">Winding</option>
                                        <option value="Others">Others</option>
                                    </select>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Unit of Measure <span style="color:red">&#9733;</span></label>
                                            <select name="uom" class="form-control">
                                                <option value="">Select Unit</option>
                                                @foreach ($units as $key)
                                                    <option {{old('material')==$key->unit_code ? 'selected':'' }} value="{{ $key->unit_code }}">{{ $key->unit_code }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Total Stock Qty <span style="color:red">&#9733;</span></label>
                                            <input type="text" value="{{old('material')}}" required="" name="total_stock_qty" class="form-control" placeholder="Total Stock Qty">
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <div class="form-group">
                                            <label class="form-check-label mr-3">Select Product:</label>
                                            <input style="display: none;" class="itemType" type="text" name="item_type" id="itemType">
                                            <select onchange="model(this.value)" name="model_code" class="form-control">
                                                <option value="" disabled selected>Click Product To Add Suitable Model</option>
                                                @foreach ($models as $key)
                                                    <option {{old('material')==$key->model_code ? 'selected':'' }} value="{{ $key->model_code }}">{{ $key->model_code }}</option>
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
                                                <th>Suitable Model <span style="color:red">&#9733;</span></th>
                                                <th>Minimum Assembly Qty Per Set <span style="color:red">&#9733;</span></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><input class="suitableModelCode form-control" type="text" name="suitable_model_code" id="suitable_model_code"></td>
                                                <td class="text-left">
                                                    <input class="qty form-control" type="text" name="min_assembly_qty_set" id="min_assembly_qty_set">
                                                </td>
                                                <td class="editc">
                                                    <a class="insert-row" onclick="insertRow()"><i data-placement="top" title="Insert" class="fa fa-plus" style="color:white; background: blue; box-shadow: none; border-radius: 3px; padding: 10px;"></i></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <button id="spbtnsubmit" type="submit" class="btn btn-primary mt-4 pl-4 pr-4">Submit</button>
                                
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

    <!--=================================*
                  Footer Section
    *===================================-->
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
    // $(document).ready(function () {
    //     $('select[name="item_group_code"]').change(function () {
    //         var prefix = $(this).val();

    //         // Use AJAX to send a request to the server
    //         $.ajax({
    //             type: 'POST',
    //             url: '{{ route('gen.material.code')}}', // Update with the actual server-side processing script
    //             data: {prefix: prefix, _token: '{{ csrf_token() }}'}, // Send the selected prefix to the server
    //             dataType: 'json', // Expect JSON response
    //             success: function (data) {
    //                 // Update material_code based on the response
    //                 $('input[name="material_code"]').val(data.materialCode);

    //                 // You can also use data.updatedCCode if you need to use the updated CCode in the client-side
    //             },
    //             error: function (xhr, status, error) {
    //                 console.error('Error:', status, error);
    //             }
    //         });
    //     });
    // });

    $(document).ready(function () {
        $('select[name="item_group_code"]').change(function () {
            var prefix = $(this).val();

            // Use AJAX to send a request to the server
            $.ajax({
                type: 'POST',
                url: '{{ route('get.item.description')}}', // Update with the actual server-side processing script
                data: {prefix: prefix, _token: '{{ csrf_token() }}'}, // Send the selected prefix to the server
                dataType: 'json', // Expect JSON response
                success: function (data) {
                    // Update material_code based on the response
                    $('input[name="item_group_desc"]').val(data.itemDesc);

                    // You can also use data.updatedCCode if you need to use the updated CCode in the client-side
                },
                error: function (xhr, status, error) {
                    console.error('Error:', status, error);
                }
            });
        });
    });

    // Wait for the document to be ready
    $(document).ready(function () {
        // Attach an event handler to the input field
        $('#material_code').on('input', function () {
            // Get the entered material code
            var material_code = $(this).val();

            // Make an AJAX request to check for duplicates
            $.ajax({
                type: 'POST',
                url: "{{ route('check.material.duplicate') }}", // Replace with your actual route
                data: {
                    material_code: material_code,
                    // Add any additional data you need to send to the server
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    // If a duplicate is found
                    if (data.duplicate) {
                        // Display the error message
                        $('#materialCodeError').text('Item Code already exists');
                        
                        // Disable the submit button
                        $('#spbtnsubmit').prop('disabled', true);
                    } else {
                        // If no duplicate is found, clear the error message
                        $('#materialCodeError').text('');
                        
                        // Enable the submit button
                        $('#spbtnsubmit').prop('disabled', false);
                    }
                },
                error: function () {
                    // Handle the error if the AJAX request fails
                    console.log('Error checking for duplicate material code');
                }
            });
        });
    });

    function model(model_no) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: "{{ route('material.product.select')}}",
            data: {
                model_no: model_no
            },
            success: function(data) {
                var val = JSON.parse(data);
                $('.suitableModelCode').val(val.model_code);
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

    function insertRow() {
        // Get input values
        var materialCode = document.getElementById('material_code').value;
        var suitableModelCode = document.getElementById('suitable_model_code').value;
        var minQty = document.getElementById('min_assembly_qty_set').value;

        // Perform database insertion here using Ajax or another method
        // After successful insertion, append a new row to the table
        // For demonstration purposes, let's assume a successful insertion

        $.ajax({
            type: 'POST',
            url: "{{ route('material.model.insert')}}",
            data: {
                materialCode: materialCode,
                suitableModelCode: suitableModelCode,
                minQty: minQty
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
        var material_code = document.getElementById('material_code').value;
        var suitable_model_code = $(this).closest('tr').find('.suitableModelCode1').val();

        var rowToRemove = $(this).closest('tr'); // Store the reference
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: "{{ route('material.model.remove')}}",
            data: {
                material_code: material_code,
                suitable_model_code: suitable_model_code
            },
            
            success: function(data) {
                var val = JSON.parse(data);
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
        $('.suitableModelCode').val('');
        $('.qty').val('');
    }
</script>

</body>
</html>
