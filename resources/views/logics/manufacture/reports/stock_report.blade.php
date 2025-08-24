<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>

    <!--=========================*
        Met Data
    *===========================-->
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!--=========================*
        Page Title
    *===========================-->
    <title>ERP</title>

    <style>
        .dts {
            display: flex;
            flex-direction: row;
            justify-content: start;
            top: 0px;
            left: 0;
            margin-bottom: 15px;
            flex-wrap: wrap;
            width: 25% !important;
        }

        .dtslable {
            color: #eb7b18;
        }

        label {
            cursor: pointer;
            font-size: 20px;
        }

        .boh {

            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            padding-bottom: 50px;
            padding-top: 50px;
        }

        i.fa {
            display: inline-block;
            border-radius: 60px;
            padding: 0.5em 0.6em;
            margin: 5px;

        }

        .status_color {
            border: 3px solid #000000;
            padding: 5px;
        }

        .btn {
            background-color: silver;
        }

        #tab1Content {
            display: block;
        }

        #tab2Content {
            display: none;
        }

        @media only screen and (min-width: 576px) {

            .modal-dialog {
                max-width: 500px !important;
                margin: 1.75rem auto;
            }
        }

        .arrow_icon {
            background: transparent !important;
        }

        .thdis {
            display: none;
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
            @include('login.flash')

            <div class="row">
                <!-- Striped table start -->
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                        <div id="tab1Content" class="row">
                            <div class="col-xl-12">
                                <div class="dts">
                                    <label onClick="JavaScript:selectTab(1);" style="background: red;color:#fff;padding:10px 20px;">General</label>
                                    <label onClick="JavaScript:selectTab(2);" style="background: #eb7b18;color:#fff;padding:10px 20px;">By Models</label>
                                </div>
                                <br>
                                <form method="GET" action="{{route('export.low.product.stock')}}">
                                    @csrf
                                    <div class="form-row">
                                        <div class="col-md-3 mb-3">
                                            <div class="form-group">
                                                <label for="model_code">Model Code<span style="color:red">&#9733;</span></label>
                                                <select id="model_code" required="" name="model_code" class="form-control model_code selectsearch">
                                                    <option value="All">All</option>
                                                    @foreach ($models as $key => $vl)
                                                        <option value="{{$vl->model_code}}">{{$vl->model_code}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <div class="form-group">
                                                <label for="to_build_count">Model Code<span style="color:red">&#9733;</span></label>
                                                <input type="number" name="to_build_count" id="to_build_count" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-1 mb-1">
                                            <div class="form-group">
                                                <label for="submit">Export</label>
                                                <input style="cursor: pointer;background-color:#585858;color:white" type="submit" id="submit" value="Download" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>


                        <div id="tab2Content" class="row">
                            <div class="col-xl-12">
                                <div class="dts">
                                    <label onClick="JavaScript:selectTab(1);" style="background: red;color:#fff;padding:10px 20px;">General</label>
                                    <label onClick="JavaScript:selectTab(2);" style="background: #eb7b18;color:#fff;padding:10px 20px;">By Models</label>
                                </div>
                                <br>
                                <form method="GET" action="{{route('export.low.product.stock.by.model')}}">
                                    <table id="dataTable" style="width: 100%;text-align:center;">
                                        <thead>
                                            <tr style="text-align:center;">
                                                <th style="text-align:center;font-weight:bold;font-size:18px;">Model Code:</th>
                                                <th style="text-align:center;font-weight:bold;font-size:18px;">To Build Count:</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($models as $key => $vl)
                                                <tr>
                                                    <td style="text-align:center;font-size:16px;">{{ $vl->model_code }}</td>
                                                    <td><input type="number" name="to_build_count_{{$vl->id}}" id="to_build_count_{{$vl->id}}" class="form-control"></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <button type="submit" class="btn btn-primary mt-4 pl-4 pr-4" style="float:right;">Export</button>
                                </form>
                            </div>
                        </div>
                            
                            

                        </div>
                    </div>
                    <!-- Striped table end -->
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
            @include('logics.include.footer_select')
        </footer>
        <!--=================================*
            End Footer Section
        *===================================-->
        <script>
            function selectTab(tabIndex) {
                //Hide All Tabs
                document.getElementById('tab1Content').style.display = "none";
                document.getElementById('tab2Content').style.display = "none";

                //Show the Selected Tab
                document.getElementById('tab' + tabIndex + 'Content').style.display = "block";


            }

        </script>
    </div>
    <!--=========================*
        End Page Container
    *===========================-->

    <!--=========================*
        Scripts
    *===========================-->
</body>

</html>
