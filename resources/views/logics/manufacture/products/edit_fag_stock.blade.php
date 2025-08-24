<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
?>
<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <script src="{{asset('user/new_js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('user/new_js/jquery.js')}}"></script>
    <link rel="stylesheet" href="{{asset('user/new_css/choices.min.css')}}" />
    <link rel="stylesheet" href="{{asset('user/new_css/bootstrap.min.css')}}" />
    <script src="{{asset('user/vendors/sweetalert2/js/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('user/vendors/sweetalert2/js/sweetalert2.all.min.js')}}"></script>

    <script src="{{asset('user/new_js/choices.min.js')}}"></script>

    <script src="{{asset('user/new_js/bootstrap.bundle.min.js')}}"></script>

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

        .choices__inner {
            min-height: 0px !important;
            background-color: white !important;
        }

        .choices__input {
            background-color: white !important;
            padding: 0px;
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

            @include('login.flashsearch')

            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="row">
                <div class="col-12 mt-4" style="margin-top:0!important;">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card_title " style="color:#50aaca"> Update FAG Stock
                                <a href="{{ route('product.master') }}" class="btn btn-primary btns">View Products</a>
                            </h5>
                            <hr>
                            <form method="POST" action="{{ route('update.fag.stock') }}">
                                @csrf
                                <div class="table-responsive datatable-primary">
                                    <table id="dataTable" class="table text-center table-striped table-bordered" style="width: 100%;">
                                        <thead class="text-capitalize">
                                            <tr>
                                                <th>Model No</th>
                                                <th>Model Name</th>
                                                <th>FAG Stock Qty <span style="color:red">&#9733;</span></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($models as $key=>$vl)
                                            <tr>
                                                <td>
                                                    <input style="background: none; border: none;" class="modelCode1 form-control" type="text" name="model_code{{$key}}[]" value="{{$vl->model_code}}" readonly/>
                                                </td>
                                                <td>
                                                    <input style="background: none; border: none;" class="modelName1 form-control" type="text" name="model_name{{$key}}[]" value="{{$vl->model_name}}" readonly/>
                                                </td>
                                                <td>
                                                    <input class="fag1 form-control" type="number" name="fag{{$key}}[]" value="{{$vl->fully_assembled_qty}}" />
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div>
                                    <input type="submit" class="btn btn-primary mt-4 pl-4 pr-4" value="Update"/>
                                </div>

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

    </div>

    <!--=========================*
        End Page Container
    *===========================-->


    <!--=========================*
        General Scripts
    *===========================-->

    <script  type="text/javascript">

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
    </script>
</body>

</html>