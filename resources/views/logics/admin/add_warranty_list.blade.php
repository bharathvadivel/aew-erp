<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>

    <!--=========================*
                Met Data
    *===========================-->
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

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

<body onload="cat('{{ old('gategory_id') }}')">

    @include('logics.include.sidemenu')


    <!--==================================*
               Main Content Section
    *====================================-->
    <div class="main-content page-content">

        <!--==================================*
                   Main Section
        *====================================-->
        <div class="main-content-inner">

            @include('login.flash')
            <div class="row">
                <!-- Disabled forms start -->
                <div class="col-12 mt-4" style="margin-top:0!important;">
                    <div class="card">
                        <div class="card-body">
                            <center>
                                <h5 class="card_title " style="color:#50aaca"> Add Warranty list
                                    <a href="{{ url('view_warraanty') }}" class="btn btn-primary btns"> <i class="fa fa-plus-circle"></i>Manage Warranty Logics</a>
                                </h5>
                            </center>
                            <hr>
                            <form method="post" action="{{ url('store_warranty_list') }}">
                                @csrf


                                <div class="form-row">
                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Category <span style="color:red">&#9733;</span></label>
                                            <select onchange="cat(this.value)" required="" name="gategory_id" class="form-control  @error('gategory_id') is-invalid @enderror">
                                                <option value="" selected hidden disabled>Select</option>
                                                @foreach ($category_list as $key)
                                                <option {{ $key->id == old('gategory_id') ? 'selected' : '' }} value="{{ $key->id }}">{{ $key->gategory_name }}</option>
                                                @endforeach
                                            </select>
                                            @error('gategory_id')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                    </div>


                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Model No <span style="color:red">&#9733;</span></label>
                                            <select onchange="model(this.value)" required="" name="model_no" class="form-control model_no  @error('model_no') is-invalid @enderror">
                                                <option value="">Select</option>
                                            </select>
                                            @error('model_no')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Serial No<span style="color:red">&#9733;</span></label>
                                            <input type="text" required="" value="{{ old('serial_no') }}" name="serial_no" class="form-control @error('serial_no') is-invalid @enderror" placeholder="Serial no">
                                            @error('serial_no')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Date of Manufacturing <span style="color:red">&#9733;</span></label>
                                            <input type="date" value="{{ old('dom') }}" required="" name="dom" class="form-control @error('dom') is-invalid @enderror" placeholder="DOM">
                                            @error('dom')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Date of Purchase </label>
                                            <input type="date" onchange="expDate(this.value)"  name="date_of_purchase" class="form-control @error('date_of_purchase') is-invalid @enderror" placeholder="DOP">
                                            @error('date_of_purchase')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>



                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Standard Warranty <span style="color:red">&#9733;</span></label>
                                            <input type="" id="standrad_warranty" value="{{ old('standard_warranty') }}" required="" name="standard_warranty" class="form-control standard_warranty @error('standard_warranty') is-invalid @enderror" placeholder="In years">
                                            @error('standard_warranty')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Extended Warranty <span style="color:red">&#9733;</span></label>
                                            <input type="" id="extended_warranty" value="{{ old('extended_warranty') }}" required="" name="extended_warranty" class="form-control extended_warranty @error('extended_warranty') is-invalid @enderror" placeholder="In years">
                                            @error('extended_warranty')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>



                                </div>



                                <div class="form-row">
                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Part 1 <span style="color:red">&#9733;</span></label>
                                            <input type="" required="" value="{{ old('part1') }}" name="part1" class="form-control part1 @error('part1') is-invalid @enderror" placeholder="Part 1">
                                            @error('part1')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                    </div>


                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Part 1 Warranty <span style="color:red">&#9733;</span></label>
                                            <input type="" id="part1_warranty" required="" value="{{ old('part1_warranty') }}" name="part1_warranty" class="form-control part1_warranty @error('part1_warranty') is-invalid @enderror" placeholder="In years">
                                            @error('part1_warranty')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Part 2 <span style="color:red">&#9733;</span></label>
                                            <input type="" required="" value="{{ old('part2') }}" name="part2" class="form-control part2 @error('part2') is-invalid @enderror" placeholder="Part 2">
                                            @error('part2')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Part 2 Warranty<span style="color:red">&#9733;</span></label>
                                            <input type="" id="part2_warranty" required="" value="{{ old('part2_warranty') }}" name="part2_warranty" class="form-control part2_warranty @error('part2_warranty') is-invalid @enderror" placeholder="In years">
                                            @error('part2_warranty')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Standard warranty exp date</label>
                                            <input type="date"  id="standrad_warranty_exp_date" name="standard_warranty_exp_date" class="form-control  @error('standard_warranty_exp_date') is-invalid @enderror" placeholder="In Date">
                                            @error('standard_warranty_exp_date')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Extended warranty exp date</label>
                                            <input type="date"  id="extended_warranty_exp_date" name="extended_warranty_exp_date" class="form-control @error('extended_warranty_exp_date') is-invalid @enderror" placeholder="In Date">
                                            @error('extended_warranty_exp_date')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Part 1 warranty exp date</label>
                                            <input type="date"  name="part1_warranty_exp_date" id="part1_warranty_exp_date" class="form-control @error('part1_warranty_exp_date') is-invalid @enderror" placeholder="In Date">
                                            @error('part1_warranty_exp_date')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Part 2 warranty exp date</label>
                                            <input type="date" id="part2_warranty_exp_date" name="part2_warranty_exp_date" class="form-control @error('part2_warranty_exp_date') is-invalid @enderror" placeholder="In Date">
                                            @error('part2_warranty_exp_date')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Customer Name</label>
                                            <input type="text" value="{{ old('customer_name') }}" name="customer_name" class="form-control @error('customer_name') is-invalid @enderror" placeholder="customer name">
                                            @error('customer_name')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Customer Phone</label>
                                            <input type="text"  value="{{ old('customer_phone') }}" name="customer_phone" class="form-control @error('customer_phone') is-invalid @enderror" placeholder="customer phone">
                                            @error('customer_phone')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                    </div>


                                </div>

                                <center><button id="yarabtnsubmit" class="btn btn-primary mt-4 pl-4 pr-4">Submit</button>
                                </center>
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

    <!--=========================*
       Based on model_no auto filling Scripts
*===========================-->
    <script>
        function model(model_no) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            event.preventDefault();
            $.ajax({
                type: 'POST'
                , url: "{{ route('warranty.select') }}"
                , data: {
                    model_no: model_no
                }
                , success: function(data) {
                    $('.part1').val(data.part1);
                    $('.part2').val(data.part2);
                    $('.part1_warranty').val(data.part1_warranty);
                    $('.part2_warranty').val(data.part2_warranty);
                    $('.standard_warranty').val(data.standard_warranty);
                    $('.extended_warranty').val(data.extended_warranty);
                }
            });
        }

    </script>

    <!--=========================*
       Based on DOP auto filling Exp date Scripts
*===========================-->

    <script>
        function expDate(date) {
            // standarad waranaty exp date check
            var standrad_warranty = $("#standrad_warranty").val();
            if (standrad_warranty % 1 !== 0) {
                var standrad_warranty_year = Math.trunc(standrad_warranty);
                var standrad_warranty_month = standrad_warranty.toString().split('.')[1];
            } else {
                var standrad_warranty_year = Math.trunc(standrad_warranty);
                var standrad_warranty_month = 0;
            }
            var standrad_warranty_date = new Date(date);


            standrad_warranty_date.setFullYear(standrad_warranty_date.getFullYear() + parseInt(standrad_warranty_year)
                , standrad_warranty_date.getMonth() + parseInt(standrad_warranty_month));
            const standard_year = standrad_warranty_date.getFullYear();
            const standard_day = String(standrad_warranty_date.getDate()).padStart(2, '0');
            const standard_month = String(standrad_warranty_date.getMonth() + 1).padStart(2, '0');
            const standrad_warranty_exp_date = standard_year + '-' + standard_month + '-' + standard_day;
         if(standrad_warranty > 0)
         {
            $("#standrad_warranty_exp_date").val(standrad_warranty_exp_date);

         }


            // extended waranaty exp date check
            var extended_warranty = $("#extended_warranty").val();
            if (extended_warranty % 1 !== 0) {
                var extended_warranty_year = Math.trunc(extended_warranty);
                var extended_warranty_month = extended_warranty.toString().split('.')[1];
            } else {
                var extended_warranty_year = Math.trunc(extended_warranty);
                var extended_warranty_month = 0;
            }
            var extended_warranty_date = new Date(date);


            extended_warranty_date.setFullYear(extended_warranty_date.getFullYear() + parseInt(extended_warranty_year)
                , extended_warranty_date.getMonth() + parseInt(extended_warranty_month));
            const extended_year = extended_warranty_date.getFullYear();
            const extended_day = String(extended_warranty_date.getDate()).padStart(2, '0');
            const extended_month = String(extended_warranty_date.getMonth() + 1).padStart(2, '0');
            const extended_warranty_exp_date = extended_year + '-' + extended_month + '-' + extended_day;
            if(extended_warranty > 0)
            {
            $("#extended_warranty_exp_date").val(extended_warranty_exp_date);
            }

            // part1 waranaty exp date check
            var part1_warranty = $("#part1_warranty").val();
            if (part1_warranty % 1 !== 0) {
                var part1_warranty_year = Math.trunc(part1_warranty);
                var part1_warranty_month = part1_warranty.toString().split('.')[1];
            } else {
                var part1_warranty_year = Math.trunc(part1_warranty);
                var part1_warranty_month = 0;
            }
            var part1_warranty_date = new Date(date);


            part1_warranty_date.setFullYear(part1_warranty_date.getFullYear() + parseInt(part1_warranty_year)
                , part1_warranty_date.getMonth() + parseInt(part1_warranty_month));
            const part1_year = part1_warranty_date.getFullYear();
            const part1_day = String(part1_warranty_date.getDate()).padStart(2, '0');
            const part1_month = String(part1_warranty_date.getMonth() + 1).padStart(2, '0');
            const part1_warranty_exp_date = part1_year + '-' + part1_month + '-' + part1_day;
            if(part1_warranty > 0)
            {
            $("#part1_warranty_exp_date").val(part1_warranty_exp_date);
            }


            // part2 waranaty exp date check
            var part2_warranty = $("#part2_warranty").val();
            if (part2_warranty % 1 !== 0) {
                var part2_warranty_year = Math.trunc(part2_warranty);
                var part2_warranty_month = part2_warranty.toString().split('.')[1];
            } else {
                var part2_warranty_year = Math.trunc(part2_warranty);
                var part2_warranty_month = 0;
            }
            var part2_warranty_date = new Date(date);


            part2_warranty_date.setFullYear(part2_warranty_date.getFullYear() + parseInt(part2_warranty_year)
                , part2_warranty_date.getMonth() + parseInt(part2_warranty_month));
            const part2_year = part2_warranty_date.getFullYear();
            const part2_day = String(part2_warranty_date.getDate()).padStart(2, '0');
            const part2_month = String(part2_warranty_date.getMonth() + 1).padStart(2, '0');
            const part2_warranty_exp_date = part2_year + '-' + part2_month + '-' + part2_day;
            if(part2_warranty > 0)
            {
            $("#part2_warranty_exp_date").val(part2_warranty_exp_date);
            }


        }

    </script>



</body>

</html>
