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

    <script src="{{asset('user/new_js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('user/new_js/jquery.js')}}"></script>
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

    </style>

</head>

<body onload="cat('{{old('gategory_id')}}')">


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
                                    Transfer Serial No
                                    <a href="{{ route('transfer.serial.no.master') }}" class="btn btn-primary btns">
                                        <i class="fa fa-plus-circle"></i>Manage Transfer List</a>

                                </h5>


                            </center>


                            <hr>
                            <form method="post" action="{{ route('transfer.serial.no.store') }}">
                                @csrf
                                <div class="form-row">

                                    <input type="hidden" name="product_code" class="form-control product_code" placeholder="Product code">

                                    <input type="hidden" name="login_id" value="{{ $partner_id }}" class="form-control" placeholder="Login ID">
                                    <div class="col-md-4 mb-4">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Transfer ID<span style="color:red">&#9733;</span></label>
                                            <input readonly value="{{ $transfer_no }}" required="" type="text" name="transfer_no" class="form-control">

                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-4">
                                        <div class="form-group">
                                            <label for="disabledSelect">From Warehouse<span style="color:red">&#9733;</span></label>
                                            <select id="from_warehouse_id" required="" name="from_warehouse_id" class="form-control">
                                                <option value="">Select</option>
                                                @foreach ($from_warehouse as $key)
                                                <option {{ $key->warehouse_id == session()->get('partner_id') ? 'selected' : ($key->warehouse_id==old('from_warehouse_id') ? 'selected':'') }} value="{{ $key->warehouse_id }}">{{ $key->name }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-4">
                                        <div class="form-group">
                                            <label for="disabledSelect">TO Warehouse<span style="color:red">&#9733;</span></label>
                                            <select required="" name="to_warehouse_id" id="to_warehouse_id" class="form-control">
                                                <option value="">Select</option>
                                                @foreach ($to_warehouse as $key)
                                                <option {{($key->warehouse_id==old('to_warehouse_id') ? 'selected':'')}} value="{{ $key->warehouse_id }}">{{ $key->name }}
                                                </option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-4 mb-4">
                                        <div class="form-group">
                                            <label for="disabledSelect">Product category <span style="color:red">&#9733;</span></label>
                                            <select onchange="cat(this.value)" required="" name="gategory_id" class="form-control">
                                                <option value="">Select</option>
                                                @foreach ($gategory as $key)
                                                <option {{$key->id==old('gategory_id') ? 'selected':''}} value="{{ $key->id }}">
                                                    {{ $key->gategory_name }}</option>
                                                @endforeach


                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-4">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Model No. <span style="color:red">&#9733;</span></label>
                                            <select onchange="cod(this.value)" required="" name="model_no" class="form-control model_no">
                                                <option value="">Select</option>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-4">
                                        <div class="form-group">
                                            <label for="disabledSelect">Product Description <span style="color:red">&#9733;</span></label>
                                            <select onchange="p_cod(this.value)" id="description" required="" name="description" class="form-control description">
                                                <option value="">Select</option>

                                            </select>
                                        </div>
                                    </div>


                                </div>

                                <div class="form-row">

                                    <div class="col-md-10 mb-10 serial_no">
                                        <div class="form-group">
                                            <label for="disabledSelect">Serial No. <span style="color:red">&#9733;</span></label>
                                            <select name="serial_no[]" class="form-control">
                                                <option value="">Select</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2 mb-2">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Stock<span style="color:red">&#9733;</span></label>
                                            <input readonly required="" type="text" name="stock" class="form-control stock">

                                        </div>
                                    </div>


                                </div>

                                {{-- <div class="row">
                                    <div class="col-md-6 mb-6">
                                        <div class="form-group">
                                            <label for="disabledTextInput">CSV Upload <span style="color:red">&#9733;</span></label>
                                            <input required="" type="file" name="serial" class="form-control">
                                            <a download="" href="{{asset('user/csv/serial_format.csv')}}"><span style="font-size:12px;color:green">Download sample file</span></a>

                        </div>
                    </div>
                </div> --}}










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
            var from_warehouse_id = document.getElementById("from_warehouse_id").value;
            var to_warehouse_id = document.getElementById("to_warehouse_id").value;

            if (from_warehouse_id == to_warehouse_id) {
                alert('From Warehouse and To Warehouse are not Same');
                $('#description').val('');
                return false;
            }

            if (from_warehouse_id == '') {
                alert('Please choose from warehouse');
                $('#description').val('');

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
                , url: "{{ route('transfer.select.serial.no') }}"
                , data: {
                    description: description
                    , warehouse_id: from_warehouse_id
                }
                , success: function(data) {
                    var vl = JSON.parse(data)
                    $('.product_code').val(vl.product_code);
                    $('.serial_no').html(vl.output);
                    $('.stock').val(vl.stock);



                }
            });


        }

    </script>
    <!--=========================*
        General Scripts
*===========================-->


</body>

</html>
