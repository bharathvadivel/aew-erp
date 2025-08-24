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
                            <center>
                                <h5 class="card_title " style="color:#50aaca"> Add Warranty
                                    <a href="{{ url('view_warraanty') }}" class="btn btn-primary btns"> <i class="fa fa-plus-circle"></i>Manage Warranty </a>
                                </h5>
                            </center>
                            <hr>
                            <form method="post" action="{{url('upload-warranty')}}" enctype="multipart/form-data">
                                @csrf


                                <div class="form-row">

                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">CSV FILE <span style="color:red">&#9733;</span></label>
                                            <input type="file" class="form-control" name="file" required="">
                                            <a download="warranty_format.csv" href="{{asset('user/csv/warranty_format.csv')}}"><span style="font-size:12px;color:green">Download sample file</span></a>

                                        </div>
                                    </div>









                                </div>


                                <center><button id="yarabtnsubmit" type="submit" class="btn btn-primary mt-4 pl-4 pr-4">Submit</button>
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


    <!--=========================*
        General Scripts
*===========================-->

    <script>
        function callmyfun(val) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST'
                , url: "{{ url('check_category')}}"
                , data: {
                    id: val,

                }
                , success: function(data) {

                    if (data === "Type C") {

                        var op = "<option value='Goods'>Goods</option>";

                        document.getElementById("assign").innerHTML = op;
                    } else {
                        var op = "<option value='Goods'>Goods</option><option value='Defective'>Defective</option>";



                        document.getElementById("assign").innerHTML = op;
                    }

                }
            });
        }

    </script>

</body>

</html>
