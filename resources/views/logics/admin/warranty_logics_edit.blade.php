<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>

    <!--=========================*
                Met Data
    *===========================-->
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

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
                                <h5 class="card_title " style="color:#50aaca"> Edit Warranty logics
                                    <a href="{{ url('manage_warranty_logics') }}" class="btn btn-primary btns"> <i class="fa fa-plus-circle"></i>Manage Warranty Logics</a>
                                </h5>
                            </center>
                            <hr>
                            <form method="post" action="{{url('update_warranty_logics')}}">
                                @csrf

                                <input type="hidden" class="form-control" value="{{$row->id}}" name="id">


                                <div class="form-row">
                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Product Category <span style="color:red">&#9733;</span></label>
                                            <select required="" name="gategory_id" class="form-control  @error('gategory_id') is-invalid @enderror">
                                                <option value="{{ $category_list->id }}">{{ $category_list->gategory_name }}</option>
                                            </select>
                                            @error('gategory_id')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                    </div>



                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Model No <span style="color:red">&#9733;</span></label>
                                            <input type="text" value="{{$row->model_no}}" required="" name="model_no" class="form-control @error('model_no') is-invalid @enderror">
                                            @error('model_no')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                    </div>




                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Standard Warranty <span style="color:red">&#9733;</span></label>
                                            <input type="text" value="{{$row->standard_warranty}}" required="" name="standard_warranty" class="form-control @error('standard_warranty') is-invalid @enderror" placeholder="In years">
                                            @error('standard_warranty')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Extended Warranty <span style="color:red">&#9733;</span></label>
                                            <input type="text" value="{{$row->extended_warranty}}" required="" name="extended_warranty" class="form-control @error('extended_warranty') is-invalid @enderror" placeholder="In years">

                                            @error('extended_warranty')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>



                                </div>



                                <div class="form-row">
                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Part 1 <span style="color:red">&#9733;</span></label>
                                            <input type="text" required="" value="{{$row->part1}}" name="part1" class="form-control @error('part1') is-invalid @enderror" placeholder="Part 1">
                                            @error('part1')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                    </div>


                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Part 1 Warranty <span style="color:red">&#9733;</span></label>
                                            <input type="text" required="" value="{{$row->part1_warranty}}" name="part1_warranty" class="form-control @error('part1_warranty') is-invalid @enderror" placeholder="In years">
                                            @error('part1_warranty')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Part 2 <span style="color:red">&#9733;</span></label>
                                            <input type="text" required="" value="{{$row->part2}}" name="part2" class="form-control @error('part2') is-invalid @enderror" placeholder="Part 2">
                                            @error('part2')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Part 2 Warranty<span style="color:red">&#9733;</span></label>
                                            <input type="text" required="" value="{{$row->part2_warranty}}" name="part2_warranty" class="form-control @error('part2_warranty') is-invalid @enderror" placeholder="In years">
                                            @error('part2_warranty')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                    </div>


                                </div>













                                <center><button id="yarabtnsubmit" class="btn btn-primary mt-4 pl-4 pr-4">Submit</button>
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
