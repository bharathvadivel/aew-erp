<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>

    <!--=========================*
                Met Data
    *===========================-->
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- CSS for searching -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- JS for searching -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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

        .select2-container .select2-selection--single .select2-selection__rendered {
            padding-top: 5px;
        }

        .select2-container .select2-selection--single {
            height: 40px;
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
            <div class="row">
                <!-- Disabled forms start -->
                <div class="col-12 mt-4" style="margin-top:0!important;">
                    <div class="card">
                        <div class="card-body">
                            <center>
                                <h5 class="card_title" style="color:#50aaca;display:flex;justify-content: space-between;align-content: space-around;"> Add Bajaj/TVS Finance Serial List
                                    <a href="{{ url('bajaj_master') }}" class="btn btn-primary btns"> <i class="fa fa-plus-circle"></i>Manage Bajaj/TVS Finance List</a>

                                </h5>
                            </center>


                            <hr>
                            <form method="post" action="{{route('bajaj.new.store')}}">
                                @csrf


                                <div class="form-group">
                                    <label for="disabledSelect">Product category <span style="color:red">&#9733;</span></label>
                                    <select onchange="cat(this.value)" required="" name="gategory_id" class="form-control selectsearch">
                                        <option value="">Select</option>
                                        @foreach ($gategory as $key)
                                        <option {{old('gategory_id')==$key->id ? 'selected':'' }} value="{{ $key->id }}">{{ $key->gategory_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="disabledTextInput">Model No. <span style="color:red">&#9733;</span></label>
                                    <select id="model_no" required="" name="model_no" class="form-control model_no selectsearch">

                                        @if(old('model_no')!='')
                                        <option selected value="{{old('model_no')}}">{{old('model_no')}}</option>
                                        @else
                                        <option value="">Select</option>
                                        @endif
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label for="disabledTextInput">Serial No.</label>
                                    <input type="text" value="{{old('serial_no')}}" required="" name="serial_no" placeholder="Serial no" class="form-control">
                                    <p><span style="font-size:12px;color:red">Sample Serial No format 32NHJ210120,32NHI210360,32NHJ210310,32NHJ210140</span></p>
                                </div>
                                <div class="form-group">
                                    <label for="disabledSelect">Status</label>
                                    <select required="" name="status" class="form-control">
                                        <option value="">Select</option>
                                        <option {{'unused'==old('status') ? 'selected':''}} value="unused">unused</option>
                                        <option {{'used'==old('status') ? 'selected':''}} value="used">used</option>
                                    </select>
                                </div>

                                <center><button type="submit" class="btn btn-primary mt-4 pl-4 pr-4">Submit</button>
                                </center>

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
        @include('logics.include.footer_select')

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


    <!--=========================*
        General Scripts
*===========================-->


</body>
</html>
