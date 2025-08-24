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
                                <h5 class="card_title " style="color:#50aaca;display:flex;justify-content: space-between;align-content: space-around;"> Add Price Details
                                    <a href="{{ route('price.master') }}" class="btn btn-primary btns"> <i class="fa fa-plus-circle"></i>Manage Price List</a>
                                    <a href="{{ route('price') }}" class="btn btn-primary btns"> <i class="fa fa-plus-circle"></i>Add Price CSV Upload</a>
                               
                                </h5>


                            </center>


                            <hr>
                            <form method="post" action="{{route('price.insert')}}">
                                @csrf
                                <div class="form-row">

                                <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="disabledSelect">Product name</label>
                                            <select required="" name="product_name" class="form-control">
                                                <option value="">Select</option>
                                                @foreach ($product as $key)

                                                <option value="{{ $key->product_name }}">{{ $key->product_name }}</option>
                                                @endforeach


                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="disabledSelect">Product category</label>
                                            <select required="" name="product_category" class="form-control">
                                                <option value="">Select</option>
                                                @foreach ($gategory as $key)

                                                <option value="{{ $key->gategory_name }}">{{ $key->gategory_name }}</option>
                                                @endforeach


                                            </select>
                                        </div>
                                    </div>

                               
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Model no</label>
                                            <input  type="text" name="model_no" class="form-control" placeholder="Model NO">
                                        </div>
                                    </div>
                                  
                                </div>


                                <div class="form-row">
                               

                                <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Price</label>
                                            <input required="" min="1" type="number" name="price" class="form-control" placeholder="Price">
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Discount MRP</label>
                                            <input required="" type="number" min="1" name="discount_mrp" class="form-control" placeholder="Discount MRP">
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="disabledSelect">Distributor</label>
                                            <select required="" name="distributor" class="form-control">
                                                <option value="">Select</option>
                                                @foreach ($distributor as $key)

                                                <option value="{{ $key->name }}">{{ $key->name }}</option>
                                                @endforeach


                                            </select>
                                        </div>
                                    </div>



                                </div>


                                <div class="form-row">

                                <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="disabledSelect">Dealer</label>
                                            <select required="" name="dealor" class="form-control">
                                                <option value="">Select</option>
                                                @foreach ($dealor as $key)

                                                <option value="{{ $key->name }}">{{ $key->name }}</option>
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