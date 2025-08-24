<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>

    <!--=========================*
                Met Data
    *===========================-->
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
                                <h5 class="card_title " style="color:#50aaca"> Edit Location </h5>
                            </center>
                            <hr>
                            <form method="post" action="{{url('state_update')}}">
                                @csrf

                                <div class="form-group">
                                    <label for="disabledTextInput">Pincode<span style="color:red">&#9733;</span></label>
                                    <input type="text" required="" value="{{$state->pincode}}" name="pincode" class="form-control" placeholder="Pincode">
                                </div>

                                 <div class="form-group">
                                     <label for="disabledTextInput">Citycode<span style="color:red">&#9733;</span></label>
                                     <input type="text" required="" value="{{$state->city_code}}" name="city_code" class="form-control" placeholder="Citycode">

                                 </div>


                                <div class="form-group">
                                    <label for="disabledTextInput">Area<span style="color:red">&#9733;</span></label>

                                    <input type="text" required="" value="{{$state->area}}" name="area" class="form-control" placeholder="Area">

                                </div>


                                <div class="form-group">
                                    <label for="disabledTextInput">City name <span style="color:red">&#9733;</span></label>
                                    <input type="text" required="" value="{{$state->city}}" name="city" class="form-control" placeholder="City Name">
                                </div>



                                <div class="form-group">
                                    <label for="disabledTextInput">District name <span style="color:red">&#9733;</span></label>
                                    <input required="" value="{{$state->district}}" type="text" name="district" class="form-control" placeholder="District Name">
                                </div>


                                <div class="form-group">
                                    <label for="disabledTextInput">State name <span style="color:red">&#9733;</span></label>
                                    <input type="text" required="" value="{{$state->state}}" list="state" name="state" class="form-control" placeholder="State Name">
                                </div>



                                <input type="hidden" name="id" value="{{$state->id}}">
                                <div class="form-group" style="display:none">
                                    <label for="disabledTextInput">Country </label>
                                    <input type="text" value="India" name="country" class="form-control" placeholder="Enter your country">
                                </div>

                                <div class="form-group">
                                    <label for="disabledSelect">Status</label>
                                    <select name="status" class="form-control">
                                        <option {{$state->status=='Enable' ? 'selected':''}} value="Enable">Enable</option>
                                        <option {{$state->status=='Disable' ? 'selected':''}} value="Disable">Disable</option>
                                    </select>
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


</body>

</html>
