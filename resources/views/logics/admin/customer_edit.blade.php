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
                                <h5 class="card_title " style="color:#50aaca"> Edit Customer
                                    <a href="{{ route('customer.master') }}" class="btn btn-primary btns"> <i class="fa fa-plus-circle"></i>Manage Customer</a>
                                </h5>


                            </center>


                            <hr>
                            <form method="post" action="{{route('customer.update',$row->id)}}">
                                @csrf
                                <div class="form-row">



                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Name</label>
                                            <input required="" value="{{$row->name}}" type="text" name="name" class="form-control" placeholder="Name">
                                        </div>
                                    </div>


                                    <div class="col-md-8 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Address</label>
                                            <input required="" value="{{$row->address}}" type="text" name="address" class="form-control" placeholder="Address">
                                        </div>
                                    </div>

                                </div>


                                <div class="form-row">


                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Pincode</label>
                                            <input required="" value="{{$row->pincode}}" type="text" name="pincode" class="form-control" placeholder="Pincode">
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Phone</label>
                                            <input type="number" value="{{$row->phone}}" name="phone" class="form-control" placeholder="Phone">
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="disabledSelect">City</label>
                                            <input type="text" value="{{$row->city}}" name="city" class="form-control" placeholder="City">

                                        </div>
                                    </div>


                                </div>

                                <div class="form-row">

                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="disabledSelect">District</label>
                                            <select required="" name="district" class="form-control">
                                                <option value="">Select</option>
                                                @foreach ($district as $key)

                                                <option {{$row->district==$key->district ? 'selected':''}} value="{{ $key->district }}">{{ $key->district }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="disabledSelect">State</label>
                                            <select required="" name="state" class="form-control">
                                                <option value="">Select</option>
                                                @foreach ($state as $key)

                                                <option {{$row->state==$key->state ? 'selected':''}} value="{{ $key->state }}">{{ $key->state }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                </div>



                                <center><button type="submit" class="btn btn-primary mt-4 pl-4 pr-4">Submit</button>
                                </center>

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


    <!--=========================*
        General Scripts
*===========================-->


</body>

</html>