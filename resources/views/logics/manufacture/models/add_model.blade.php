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
   .extra
   {
       font-size: 20px;

    background-color: #ffffff;
    padding-top: 10px;
    padding-bottom: 10px;
    border-radius: 5px;

}


.mt-4 {
     margin-top: 0 rem!important;
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
                            <h5 class="card_title " style="color:#50aaca"> Add New Model
                                <a href="{{ route('model.master') }}" class="btn btn-primary btns" > <i class="fa fa-plus-circle"></i>Manage Models</a>
                            </h5>
                            <hr>
                            <form method="post" action="{{route('model.store')}}">
                                @csrf
                                
                                <div class="form-group">
                                    <label for="disabledTextInput">Model Code <span style="color:red">&#9733;</span></label>
                                    <input type="text" value="{{old('model')}}" required="" name="model_code" class="form-control" placeholder="Model Code">
                                </div>

                                <div class="form-group">
                                    <label for="disabledTextInput">Model Name</label>
                                    <input type="text" value="{{old('model')}}" name="model_name" class="form-control" placeholder="Model Name">
                                </div>

                                <div class="form-group">
                                    <label for="disabledTextInput">Model Description <span style="color:red">&#9733;</span></label>
                                    <input type="text" value="{{old('model')}}" required="" name="model_desc" class="form-control" placeholder="Model Description">
                                </div>

                                <div class="form-group">
                                    <label for="disabledTextInput">Power</label>
                                    <input type="text" value="{{old('model')}}" name="power" class="form-control" placeholder="Power">
                                </div>

                                <div class="form-group">
                                    <label for="disabledTextInput">Head Range</label>
                                    <input type="text" value="{{old('model')}}" name="head_range" class="form-control" placeholder="Head Range">
                                </div>

                                <div class="form-group">
                                    <label for="disabledTextInput">Discharge</label>
                                    <input type="text" value="{{old('model')}}" name="discharge" class="form-control" placeholder="Discharge">
                                </div>

                                <div class="form-group">
                                    <label for="disabledTextInput">Pipe Size</label>
                                    <input type="text" value="{{old('model')}}" name="pipe_size" class="form-control" placeholder="Pipe Size">
                                </div>

                                <div class="form-group">
                                    <label for="disabledTextInput">Order</label>
                                    <input type="text" value="{{old('model')}}" name="order" class="form-control" placeholder="Order">
                                </div>
                                    
                                <center>
                                    <button id="yarabtnsubmit" type="submit" class="btn btn-primary mt-4 pl-4 pr-4">Submit</button>
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
