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
                            <h5 class="card_title " style="color:#50aaca"> Edit Model</h5>
                            <hr>
                            <form method="post" action="{{url('model_update')}}">
                                @csrf

                                <input type="text" value="{{$model->id}}" required="" name="id" style="display: none;">

                                <div class="form-group">
                                    <label for="disabledTextInput">Model Code <span style="color:red">&#9733;</span></label>
                                    <input type="text" value="{{$model->model_code}}" required="" name="model_code" class="form-control" placeholder="Model Code">
                                </div>

                                <div class="form-group">
                                    <label for="disabledTextInput">Model Name</label>
                                    <input type="text" value="{{$model->model_name}}" name="model_name" class="form-control" placeholder="Model Name">
                                </div>

                                <div class="form-group">
                                    <label for="disabledTextInput">Model Description <span style="color:red">&#9733;</span></label>
                                    <input type="text" value="{{$model->model_desc}}" required="" name="model_desc" class="form-control" placeholder="Model Description">
                                </div>

                                <div class="form-group">
                                    <label for="disabledTextInput">Power</label>
                                    <input type="text" value="{{$model->power}}" name="power" class="form-control" placeholder="Power">
                                </div>

                                <div class="form-group">
                                    <label for="disabledTextInput">Head Range</label>
                                    <input type="text" value="{{$model->head_range}}" name="head_range" class="form-control" placeholder="Head Range">
                                </div>

                                <div class="form-group">
                                    <label for="disabledTextInput">Discharge</label>
                                    <input type="text" value="{{$model->discharge}}" name="discharge" class="form-control" placeholder="Discharge">
                                </div>

                                <div class="form-group">
                                    <label for="disabledTextInput">Pipe Size</label>
                                    <input type="text" value="{{$model->pipe_size}}" name="pipe_size" class="form-control" placeholder="Pipe Size">
                                </div>

                                <div class="form-group">
                                    <label for="disabledTextInput">Order</label>
                                    <input type="text" value="{{$model->order}}" name="order" class="form-control" placeholder="Order">
                                </div>

                                <div class="form-group">
                                    <label for="disabledSelect">Status <span style="color:red">&#9733;</span></label>
                                    <select name="status" class="form-control">
                                        <option {{$model->status=='Enable' ? 'selected':''}} value="Enable">Enable</option>
                                        <option {{$model->status=='Disable' ? 'selected':''}} value="Disable">Disable</option>
                                    </select>
                                </div>

                                <center>
                                    <button type="submit" class="btn btn-primary mt-4 pl-4 pr-4">Submit</button>
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
