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

    <script src="{{ asset('user/vendors/sweetalert2/js/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('user/vendors/sweetalert2/js/sweetalert2.all.min.js') }}"></script>
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

<body onload="p_cod('{{ $row->description }}')">

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
                            <form method="post" action="{{ route('transfer.serial.no.update') }}">
                                @csrf
                                <div class="form-row">

                                    <input type="hidden" value="{{ $row->product_code }}" name="product_code" class="form-control" placeholder="Product code">

                                    <input type="hidden" name="login_id" value="{{ $row->login_id }}" class="form-control" placeholder="Login ID">
                                    <input type="hidden" name="transferserial_id" value="{{ $row->id }}" class="form-control">
                                    <div class="col-md-4 mb-4">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Transfer ID<span style="color:red">&#9733;</span></label>
                                            <input readonly value="{{ $row->transfer_no }}" required="" type="text" name="transfer_no" class="form-control">

                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-4">
                                        <div class="form-group">
                                            <label for="disabledSelect">From Warehouse<span style="color:red">&#9733;</span></label>
                                            <input readonly value="{{ $row->from_warehouse_id }}" required="" type="text" id="from_warehouse_id" name="from_warehouse_id" class="form-control">

                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-4">
                                        <div class="form-group">
                                            <label for="disabledSelect">TO Warehouse<span style="color:red">&#9733;</span></label>
                                            <input readonly value="{{ $row->to_warehouse_id }}" required="" type="text" id="to_warehouse_id" name="to_warehouse_id" class="form-control">

                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-4 mb-4">
                                        <div class="form-group">
                                            <label for="disabledSelect">Product category <span style="color:red">&#9733;</span></label>
                                            <input readonly value="{{ $row->gategory }}" required="" type="text" name="gategory" class="form-control">

                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-4">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Model No. <span style="color:red">&#9733;</span></label>
                                            <input readonly value="{{ $row->model_no }}" required="" type="text" name="model_no" class="form-control">

                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-4">
                                        <div class="form-group">
                                            <label for="disabledSelect">Product Description <span style="color:red">&#9733;</span></label>
                                            <input readonly value="{{ $row->description }}" required="" type="text" name="description" class="form-control">

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

                                @php
                                $list = DB::table('transferseriallists')
                                ->where('transfer_no', $row->transfer_no)
                                ->orderBy('id', 'desc')
                                ->get();

                                @endphp
                                @foreach ($list as $key)
                                @php
                                $from = DB::table('warehouses')
                                ->where('warehouse_id', $row->from_warehouse_id)
                                ->first();
                                $to = DB::table('warehouses')
                                ->where('warehouse_id', $row->to_warehouse_id)
                                ->first();
                                @endphp
                                <div class="form-row">
                                    <div class="col-md-3 mb-2">
                                        <div class="form-group">
                                            <label for="disabledTextInput">From Warehouse<span style="color:red">&#9733;</span></label>
                                            <input readonly value="{{ $from->name }}" type="text" class="form-control">

                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <div class="form-group">
                                            <label for="disabledTextInput">To Warehouse<span style="color:red">&#9733;</span></label>
                                            <input readonly value="{{ $to->name }}" type="text" class="form-control">

                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Serial No<span style="color:red">&#9733;</span></label>
                                            <input readonly type="text" value="{{ $key->serial_no }}" class="form-control">

                                        </div>
                                    </div>
                                    <div class="col-md-1 mb-1">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Remove</label>
                                            <button onclick="remove('{{ $key->id }}')" class="form-control btn btn-danger">Delete</button>

                                        </div>
                                    </div>
                                </div>
                                @endforeach

                                {{-- <div class="row">
                                    <div class="col-md-6 mb-6">
                                        <div class="form-group">
                                            <label for="disabledTextInput">CSV Upload <span style="color:red">&#9733;</span></label>
                                            <input required="" type="file" name="serial" class="form-control">
                                            <a download="" href="{{asset('user/csv/serial_format.csv')}}"><span style="font-size:12px;color:green">Download sample file</span></a>

                        </div>
                    </div>
                </div> --}}










                <center><button onclick="return check()" type="submit" class="btn btn-primary mt-4 pl-4 pr-4">Submit</button>
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
        function check() {
            var serial_no = [];
            $(".serial_no :selected").each(function() {
                serial_no.push(this.value);
            });

            if (serial_no.length > 0) {
                return true;
            } else {
                alert('Please Choose Serial No');
                return false;
            }
        }

    </script>
    <script>
        function remove(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            event.preventDefault();

            $.ajax({
                type: 'POST'
                , url: "{{ route('transfer.single.serial.no.delete') }}"
                , data: {
                    id: id
                }
                , success: function(data) {
                    if (data == true) {
                        swal({
                            type: "error"
                            , title: "Warning!"
                            , text: "Deleted Successfully!"
                            , confirmButtonText: "Ok"
                            , buttonsStyling: !1
                            , confirmButtonClass: "btn btn-danger"
                        }).then(function() {
                            location.reload();
                        });

                    } else {
                        swal({
                            type: "error"
                            , title: "Warning!"
                            , text: "This Serial No ,Delete failed.because This serial No, used!"
                            , confirmButtonText: "Ok"
                            , buttonsStyling: !1
                            , confirmButtonClass: "btn btn-danger"
                        });
                    }

                }
            });


        }

    </script>
    <script>
        function cat(gategory) {
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
                    gategory: gategory
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
                return false;
            }

            if (from_warehouse_id == '') {
                alert('Please Enter from warehouse');

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
