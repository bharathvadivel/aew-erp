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
                            <h5 class="card_title " style="color:#50aaca"> Update FAG Stock in Bulk
                                <a href="{{ url('product') }}" class="btn btn-primary btns"> <i class="fa fa-plus-circle"></i>View Products</a>
                            </h5>
                            <hr>                            
                            <form method="post" enctype="multipart/form-data" action="{{url('import_fag_stock')}}">
                                @csrf
                                
                                <ol style="color: red; font-size: 14px;margin: 0px 0px 20px 20px;">
                                    <li>* indicates required fields , Columns "model_code", "fag_stock"</li>
                                    <li>Format the excel file to (.CSV) before uploading</li>
                                </ol>
                                <p style="color: red; font-size: 18px;margin: 0px 0px 20px 20px;font-weight:bold;">*Note: Do Not Edit model_code, It Should Not Be Repeated. Changing Item_Code May Reflect In Data Collision Or Lose.</p>
                                <div class="form-group">
                                    <label for="disabledTextInput">Choose CSV File</label>
                                    <input type="file" required="" name="fag_stock_data" class="form-control">
                                </div>

                                <div style="font-size: 18px;margin: 0px 0px 20px 20px;">*Download all Models as <span style="font-weight:bold;color:green;">CSV Data</span> from <a style="font-weight:bold;color:green;border-bottom: 1px dashed green;" href="{{url('product')}}">Products</a> Page. To edit and update in bulk.</div>
                                

                                <button type="submit" class="btn btn-primary mt-4 pl-4 pr-4">Submit</button>

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
    <!--=========================*
        End Page Container
    *===========================-->

    <!--=========================*
        General Scripts
    *===========================-->

</body>

</html>
