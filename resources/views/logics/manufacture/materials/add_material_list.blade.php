<!DOCTYPE html>
<html class="no-js" lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
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
            Main Section
        *====================================-->
        <div class="main-content page-content">
            <div class="main-content-inner">
                @include('login.flash')
                <div class="row">
                    <div class="col-12 mt-4" style="margin-top:0!important;">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card_title " style="color:#50aaca"> Import Items
                                    <a href="{{ url('material_master') }}" class="btn btn-primary btns"> <i class="fa fa-plus-circle"></i>Manage Items</a>
                                </h5>
                                <hr>
                                <form method="post" enctype="multipart/form-data" action="{{url('import_materials')}}">
                                    @csrf
                                    
                                    <ol style="color: red; font-size: 14px;margin: 0px 0px 20px 20px;">
                                        <li>* indicates required fields , Columns "Item Code", "Item Description", "Item Group Code", "Unit of Measure", "Total Stock Qty"</li>
                                        <li>Format the excel file to (.CSV) before uploading</li>
                                    </ol>
                                    <p style="color: red; font-size: 18px;margin: 0px 0px 20px 20px;font-weight:bold;">*Note: Item_Code Should Not Be Repeated</p>
                                    <div class="form-group">
                                        <label for="disabledTextInput">Choose CSV File</label>
                                        <input type="file" required="" name="materials" class="form-control">
                                        <a href="{{ route('download.items.import.sample') }}"><span style="font-size:16px;color:green;margin-top:10px;">Download sample file</span></a>
                                    </div>

                                    <button type="submit" class="btn btn-primary mt-4 pl-4 pr-4">Submit</button>

                                    <div class="form-row">
                                        <span style="color:red">&#9733;</span>
                                        <p>- Mandatory field</p>
                                    </div>
                                </form>
                                <hr>
                                <form method="post" enctype="multipart/form-data" action="{{url('import_material_compatibles')}}">
                                    @csrf
                                    
                                    <ol style="color: red; font-size: 14px;margin: 0px 0px 20px 20px;">
                                        <li>* indicates required fields , Columns "Item Code", "Model No", "Minimum Assembly Qty Per Set"</li>
                                        <li>Format the excel file to (.CSV) before uploading</li>
                                    </ol>
                                    <p style="color: red; font-size: 18px;margin: 0px 0px 20px 20px;font-weight:bold;">*Note: Item_Code May Be Repeated, Since we need to apply same Item_code for different Model_No</p>
                                    <div class="form-group">
                                        <label for="disabledTextInput">Choose CSV File</label>
                                        <input type="file" required="" name="materialcompatibles" class="form-control">
                                        <a href="{{ route('download.items.compatible.import.sample') }}"><span style="font-size:16px;color:green;margin-top:10px;">Download sample file</span></a>
                                    </div>

                                    <button type="submit" class="btn btn-primary mt-4 pl-4 pr-4">Submit</button>

                                    <div class="form-row">
                                        <span style="color:red">&#9733;</span>
                                        <p>- Mandatory field</p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
    </body>
</html>