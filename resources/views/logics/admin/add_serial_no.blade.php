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

    </style>

</head>

<body onload="cat('{{ old('gategory_id') }}'),cod('{{ old('model_no') }}'),p_cod('{{ old('description') }}')">






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
                            <center>
                                <h5 class="card_title " style="color:#50aaca;display:flex;justify-content: space-between;align-content: space-around;">
                                    Add Serial No
                                    <a href="{{ route('serial.no.master') }}" class="btn btn-primary btns"> <i class="fa fa-plus-circle"></i>Manage Serial No List</a>

                                </h5>


                            </center>

                            <hr>
                            <form method="post" enctype="multipart/form-data" action="{{ route('serial.no.store') }}">
                                @csrf
                                <div class="form-row">
                                    <div class="col-md-4 mb-4">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Purchase No.<span style="color:red">&#9733;</span></label>
                                            <input type="text" required="" value="{{ old('purchase_no') }}" name="purchase_no" class="form-control" placeholder="Enter Purchase No.">
                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledSelect">Type <span style="color:red">&#9733;</span></label>
                                            <select onchange="check_type(this.value)" class="form-control  @error('type') is-invalid @enderror" name="type">
                                                <option value="purchase">Purchase</option>
                                                <option value="salesreturn">Sales return</option>
                                            </select>
                                            @error('type')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-5 mb-3">
                                        <div class="form-group">
                                            <label for="disabledSelect">Suppliers<span style="color:red">&#9733;</span></label>
                                            <input type="text" value="" id="supplier_text" name="suppliers" class="form-control" placeholder="Suppliers">
                                            <select id="supplier_select" onchange="check_type(this.value)" name="suppliers" class="form-control selectsearch">
                                                <option value="">Select</option>
                                                @foreach ($partner as $key)
                                                <option value="{{ $key->partner_id }}">
                                                    {{ $key->store_name }}({{ $key->partner_id }})</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>



                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Date <span style="color:red">&#9733;</span></label>
                                            <input type="date" value="@php echo date('Y-m-d') @endphp" name="date" class="form-control" placeholder="Date">
                                        </div>
                                    </div>

                                    <div class="col-md-9 mb-3">
                                        <div class="form-group">
                                            <label for="disabledSelect">Warehouse<span style="color:red">&#9733;</span></label>
                                            <select required="" name="warehouse_id" class="form-control">
                                                <option value="">Select</option>
                                                @foreach ($warehouse as $key)
                                                <option {{ $key->warehouse_id == session()->get('partner_id') ? 'selected' : ($key->warehouse_id == old('warehouse_id') ? 'selected' : '') }} value="{{ $key->warehouse_id }}">{{ $key->warehouse_id }} - {{ $key->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-9 mb-9">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Remarks.<span style="color:red">&#9733;</span></label>
                                            <textarea type="text" required="" name="remarks" class="form-control" placeholder="Remarks">{{ old('remarks') }}</textarea>
                                        </div>
                                    </div>


                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">CSV Upload <span style="color:red">&#9733;</span></label>
                                            <input required="" type="file" name="serial" class="form-control">
                                            <a download="serial_format.csv" href="{{ asset('user/csv/purchase_serial_format.csv') }}"><span style="font-size:12px;color:green">Download sample file</span></a>

                                        </div>
                                    </div>
                                </div>










                                <center><button type="submit" class="btn btn-primary mt-4 pl-4 pr-4">Submit</button>
                                </center>
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
        @include('logics.include.footer')

    </footer>
    <!--=================================*
                End Footer Section
    *===================================-->

    </div>
    <!--=========================*
        End Page Container
*===========================-->


    <script>
        $('#supplier_text').show();
        $('#supplier_select').hide();
        $("#supplier_text").prop('disabled', false);
        $("#supplier_select").prop('disabled', true);

        function check_type(type) {
            if (type == 'purchase') {
                $("#supplier_text").prop('disabled', false);
                $("#supplier_select").prop('disabled', true);
                $('#supplier_text').show();
                $('#supplier_select').hide();
            } else {
                $("#supplier_text").prop('disabled', true);
                $("#supplier_select").prop('disabled', false);
                $('#supplier_select').show();
                $('#supplier_text').hide();
            }
        };

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
                , url: "{{ route('model.select') }}"
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
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            event.preventDefault();

            $.ajax({
                type: 'POST'
                , url: "{{ route('product.select.description') }}"
                , data: {
                    model_no: model_no
                }
                , success: function(data) {
                    $('.description').html(data);

                }
            });


        }

    </script>


    <script>
        function p_cod(description) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            event.preventDefault();

            $.ajax({
                type: 'POST'
                , url: "{{ route('product.code') }}"
                , data: {
                    description: description
                }
                , success: function(data) {
                    $('.product_code').val(data);

                }
            });


        }

    </script>
    <!--=========================*
        General Scripts
*===========================-->


</body>

</html>

