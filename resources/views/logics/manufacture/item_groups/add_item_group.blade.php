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
                            <h5 class="card_title " style="color:#50aaca"> Add Item Group
                                <a href="{{ route('item.group.master') }}" class="btn btn-primary btns" > <i class="fa fa-plus-circle"></i>Manage Item Groups</a>
                            </h5>
                            <hr>
                            <form method="post" action="{{route('item.group.store')}}">
                                @csrf
                                
                                <div class="form-group">
                                    <label for="disabledTextInput">Item Group Code <span style="color:red">&#9733;</span></label>
                                    <input type="text" value="{{old('item_group')}}" required="" name="item_group_code" class="form-control" placeholder="Item Group Code">
                                </div>

                                <div class="form-group">
                                    <label for="disabledTextInput">Item Group Name</label>
                                    <input type="text" value="{{old('item_group')}}" name="item_group_name" class="form-control" placeholder="Item Group Name">
                                </div>

                                <div class="form-group">
                                    <label for="disabledTextInput">Item Group Description <span style="color:red">&#9733;</span></label>
                                    <input type="text" value="{{old('item_group')}}" required="" name="item_group_desc" class="form-control" placeholder="Item Group Description">
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
