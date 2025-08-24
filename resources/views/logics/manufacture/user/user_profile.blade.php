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
                            <h5 class="card_title" style="color:#50aaca">Profile</h5>
                            <hr>

                            <div class="d-flex align-items-start">
                                <div class="nav flex-column nav-pills mr-1" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                    <button class="nav-link active" id="v-pills-account-tab" data-bs-toggle="pill" data-bs-target="#v-pills-account" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">Account</button>
                                    <button class="nav-link" id="v-pills-security-tab" data-bs-toggle="pill" data-bs-target="#v-pills-security" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">Security</button>
                                    
                                </div>
                                <div class="tab-content" id="v-pills-tabContent">
                                    <div class="tab-pane fade show active" id="v-pills-account" role="tabpanel" aria-labelledby="v-pills-account-tab" style="border-left: 2px solid #e0e0e0;padding-left:15px;">
                                        <form method="post" action="{{route('user.update')}}">
                                            @csrf

                                            <div class="form-group">
                                                <label for="partner_id">User ID</label>
                                                <input type="text" value="{{$user_data->partner_id}}" id="partner_id" name="partner_id" class="form-control" readonly style="background: #e0e0e0;border:none;">
                                            </div>

                                            <div class="form-group">
                                                <label for="partner_type">Privilege</label>
                                                <input type="text" value="{{$user_data->partner_type}}" id="partner_type" name="partner_type" class="form-control" readonly style="background: #e0e0e0;border:none;">
                                            </div>

                                            <div class="form-group">
                                                <label for="phone">Phone</label>
                                                <input type="number" value="{{$user_data->phone}}" id="phone" name="phone" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" value="{{$user_data->email}}" id="email" name="email" class="form-control">
                                            </div>

                                            <button type="submit" class="btn btn-primary mt-1 pl-4 pr-4">Save</button>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-security" role="tabpanel" aria-labelledby="v-pills-security-tab" style="border-left: 2px solid #e0e0e0;padding-left:15px;">
                                        <form method="post" action="{{route('user.password.update')}}">
                                            @csrf

                                            <div class="form-group">
                                                <label for="pswd">User Password</label>
                                                <input hidden type="text" value="{{$user_data->partner_id}}" name="partner_id">
                                                <input type="password" value="" id="pswd" name="pswd" class="form-control">
                                            </div>

                                            <button type="submit" class="btn btn-primary mt-1 pl-4 pr-4">Save</button>
                                        </form>
                                        
                                        @if (session()->get('partner_type')=='admin')
                                        <hr style="margin: 30px 0px;">

                                        <form method="post" action="{{route('costing.password.update')}}">
                                            @csrf


                                            <div class="form-group">
                                                <label for="cpswd">Costing Password</label>
                                                <input hidden type="text" value="{{$user_data->partner_id}}" name="partner_id">
                                                <input type="password" value="" id="cpswd" name="cpswd" class="form-control">
                                            </div>

                                            <button type="submit" class="btn btn-primary mt-1 pl-4 pr-4">Save</button>
                                        </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
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
