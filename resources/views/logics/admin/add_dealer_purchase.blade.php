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

<body onload="cat('{{old('gategory_id')}}'),cod('{{old('model_no')}}'),p_cod('{{old('description')}}')">






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
                                <h5 class="card_title " style="color:#50aaca;display:flex;justify-content: space-between;align-content: space-around;"> Add Serial No
                                    <a href="{{ route('partner.serial.list') }}" class="btn btn-primary btns"> <i class="fa fa-plus-circle"></i>Manage Serial No List</a>

                                </h5>


                            </center>


                            <hr>
                            <form method="post" enctype="multipart/form-data" action="{{route('dealer.serial.store')}}">
                                @csrf
                                <div class="form-row">
                                    <div class="col-md-4 mb-4">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Purchase No.<span style="color:red">&#9733;</span></label>
                                            <input type="text" required="" value="{{old('partnerinvoice_no')}}" name="partnerinvoice_no" class="form-control" placeholder="Product no.">


                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-4">
                                        <div class="form-group">
                                            <label for="disabledSelect">Product category <span style="color:red">&#9733;</span></label>
                                            <select onchange="cat(this.value)" required="" name="gategory_id" class="form-control">
                                                <option value="">Select</option>
                                                @foreach ($gategory as $key)
                                                <option {{$key->id==old('gategory_id') ? 'selected':''}} value="{{ $key->id }}">{{ $key->gategory_name }}</option>

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


                                </div>


                                <div class="form-row">

                                    <input type="hidden" name="product_code" class="form-control product_code" placeholder="Product code">

                                    <div class="col-md-6 mb-6">
                                        <div class="form-group">
                                            <label for="disabledSelect">Product Description <span style="color:red">&#9733;</span></label>
                                            <select onchange="p_cod(this.value)" required="" name="description" class="form-control description">
                                                <option value="">Select</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-9 mb-9">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Remarks.<span style="color:red">&#9733;</span></label>
                                            <textarea type="text" required="" name="remarks" class="form-control" placeholder="Remarks">{{old('remarks')}}</textarea>
                                        </div>
                                    </div>


                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">CSV Upload <span style="color:red">&#9733;</span></label>
                                            <input required="" type="file" name="serial" class="form-control">
                                            <a download="serial_format.csv" href="{{asset('user/csv/serial_format.csv')}}"><span style="font-size:12px;color:green">Download sample file</span></a>

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
        function cat(gategory_id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            event.preventDefault();

            $.ajax({
                type: 'POST'
                , url: "{{ route('model.select')}}"
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
                , url: "{{ route('product.select.description')}}"
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
                , url: "{{ route('product.code')}}"
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
