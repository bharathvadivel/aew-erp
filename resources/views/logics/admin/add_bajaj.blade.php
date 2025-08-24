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
                            <center><h5 class="card_title" style="color:#50aaca;display:flex;justify-content: space-between;align-content: space-around;"> Add Bajaj/TVS Finance Serial List
                            <a href="{{ url('bajaj_master') }}" class="btn btn-primary btns" > <i class="fa fa-plus-circle"></i>Manage Bajaj/TVS Finance List</a>

                        </h5></center>


                            <hr>
                            <form method="post" enctype="multipart/form-data" action="{{route('bajaj.store')}}">
                                @csrf



                                    <div class="form-group">
                                        <label for="disabledTextInput">Import CSV file</label>
                                        <input type="file" name="bajaj"  class="form-control" >
                                        <a download="bajaj.csv" href="{{asset('user/csv/bajaj.csv')}}"><span style="font-size:12px;color:green">Download sample file</span></a>

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
