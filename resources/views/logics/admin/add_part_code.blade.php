<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>

    <!--=========================*
                Met Data
    *===========================-->
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
            @include('login.flashsearch')
            <div class="row">
                <!-- Disabled forms start -->
                <div class="col-12 mt-4" style="margin-top:0!important;">
                    <div class="card">
                        <div class="card-body">
                            <center>
                                <h5 class="card_title " style="color:#50aaca"> Add Spare Parts Details
                                    <a href="{{ route('part.code.master') }}" class="btn btn-primary btns"> <i class="fa fa-plus-circle"></i>Manage Part Details</a>
                                </h5>
                            </center>
                            <hr>
                            <form method="post" action="{{route('store.part.code')}}">
                                @csrf

                                <div class="form-group">
                                    <label for="disabledTextInput">Spare Part Code <span style="color:red">&#9733;</span></label>

                                    <input type="text" required="" value="{{old('part_code')}}" name="part_code" placeholder="Part Code" class="form-control">

                                </div>

                                <div class="form-group">
                                    <label for="disabledTextInput">Part Name<span style="color:red">&#9733;</span></label>

                                    <input type="text" required="" value="{{old('part_name')}}" name="part_name" placeholder="Part Name" class="form-control">

                                </div>

                                <div class="form-row">
                                    <div class="col-md-12 mb-12">
                                        <div class="form-group">

                                            <label for="disabledSelect">Model No <span style="color:red">&#9733;</span></label>
                                            <select id="choices-multiple-remove-button" placeholder="Select model" multiple name="model_no[]" class="form-control ">
                                                @foreach ($model_list as $key => $vl)

                                                <option value="@php echo $vl->model_no @endphp">@php echo $vl->model_no @endphp </option>;

                                                @endforeach


                                            </select>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="disabledTextInput">HSN Code<span style="color:red">&#9733;</span></label>

                                    <input type="text" required="" value="{{old('hsn_code')}}" name="hsn_code" placeholder="HSN Code" class="form-control">


                                </div>


                                <div class="form-group">
                                    <label for="disabledTextInput">Part Category <span style="color:red">&#9733;</span></label>
                                    <select required="" name="part_category" class="form-control selectsearch">
                                        <option value="">Select</option>
                                        @foreach ($category_list as $key)
                                        <option {{$key->id==old('part_category') ? 'selected':''}} value="{{ $key->id }}">{{ $key->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="disabledTextInput">Part Price <span style="color:red">&#9733;</span></label>
                                    <input type="number" value="{{old('part_price')}}" min="1" required="" name="part_price" class="form-control" placeholder="Spare Parts Price">

                                </div>

                                <div class="form-group">
                                    <label for="disabledTextInput">Gst Percentage% <span style="color:red">&#9733;</span></label>
                                    <input type="text" value="{{old('gst')}}" required="" name="gst" class="form-control" placeholder="Gst Percentage">

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
    <script>
        $(document).ready(function() {

            var multipleCancelButton = new Choices("#choices-multiple-remove-button", {
                removeItemButton: true
                , shouldSort: false
                , fuseOptions: {
                    threshold: 0
                }

            , });


        });

    </script>

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


</body>

</html>
