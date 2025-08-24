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

                @media only screen and (max-width: 767px) {
                    .btnRemove {
                        margin-left: 106px !important;
                        background-color: red;
                        width: 24px !important;
                        height: 23px !important;
                        margin-top: -38px !important;
                    }

                }

                .btnRemove {
                    background-color: red;
                    width: 24px;
                    height: 23px;
                    margin-top: 5px;

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
                            @include('login.flashsearch')
                            <div class="row">
                                <!-- Disabled forms start -->
                                <div class="col-12 mt-4" style="margin-top:0!important;">
                                    <div class="card">
                                        <div class="card-body">
                                            <center>
                                                <h5 class="card_title " style="color:#50aaca"> Add Product Model Details
                                                    <a href="{{ route('product.image') }}" class="btn btn-primary btns"> <i class="fa fa-plus-circle"></i>Manage Product Model Details</a>
                                                </h5>
                                            </center>
                                            <hr>
                                            <form method="post" enctype="multipart/form-data" action="{{route('store.product.image')}}">

                                                @csrf
                                                <div class="form-group">
                                                    <label for="disabledTextInput">Model No. <span style="color:red">&#9733;</span></label>
                                                    <select required="" name="model_no" class="form-control selectsearch @error('model_no') is-invalid @enderror">

                                                        <option value="">Select</option>
                                                        @foreach ($row as $key)
                                                        <option {{old('model_no')==$key->model_no ? 'selected':''}} value="{{ $key->model_no }}">{{ $key->model_no }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('model_no')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror

                                                </div>
                                                <div class="form-group">
                                                    <label for="disabledTextInput">Modal Image<span style="color:red">&#9733;</span></label>
                                                    <input type="file" required="" accept="image/*" name="model_image" class="form-control @error('model_image') is-invalid @enderror">
                                                    @error('model_image')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror

                                                </div>
                                                <div class="form-group">
                                                    <input id="btnAdd" class="btn btn-success mt-4 pl-4 pr-4" type="button" value="Add Features" />
                                                </div>


                                                <div id="keyvalue">

                                                    <div class="form-row con">
                                                        <div class="col-md-5 mb-5"><input type="text" required="" name="title[]" placeholder="title" class="form-control" /></div>
                                                        <div class="col-md-5 mb-5"><input type="text" required="" name="value[]" placeholder="value" class="form-control" /></div><input type="button" class="btnRemove" value="X" />
                                                    </div>

                                                </div>


                                                <center><button id="yarabtnsubmit" type="submit" class="btn btn-primary mt-4 pl-4 pr-4">Submit</button>
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
                                <script>
                                    $(document).ready(function() {
                                        $("#btnAdd").click(function() {
                                            $("#keyvalue").append('<div class="form-row con"><div class="col-md-5 mb-5"><input type="text" required="" name="title[]" placeholder="title" class="form-control" /></div><div class="col-md-5 mb-5"><input type="text" required="" name="value[]" placeholder="value" class="form-control" /></div><input type="button" class="btnRemove" value="X" /></div>');
                                        });
                                        $('body').on('click', '.btnRemove', function() {
                                            $(this).parent('div.con').remove()

                                        });
                                    });

                                </script>
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


                                    </body>
                                    </html>
