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
                                <h5 class="card_title " style="color:#50aaca"> Add Product
                                    <a href="{{ route('product.master') }}" class="btn btn-primary btns"> <i class="fa fa-plus-circle"></i>Manage Product</a></h5>


                            </center>


                            <hr>
                            <form method="post" enctype="multipart/form-data" action="{{route('product.store')}}">
                                @csrf
                                <div class="form-row">

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Model No. <span style="color:red">&#9733;</span></label>
                                            <input required="" value="{{old('model_no')}}" type="text" name="model_no" class="form-control  @error('model_no') is-invalid @enderror" placeholder="Model No">
                                            @error('model_no')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <input readonly value="{{$product_code}}" type="hidden" name="product_code" class="form-control" placeholder="Product code">

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">HSN code <span style="color:red">&#9733;</span></label>
                                            <input required="" value="{{old('hsn_code')}}" type="text" name="hsn_code" class="form-control @error('hsn_code') is-invalid @enderror" placeholder="HSN CODE">
                                            @error('hsn_code')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">EAN<span style="color:red">&#9733;</span></label>
                                            <input required="" value="{{old('ean')}}" type="text" name="ean" class="form-control @error('ean') is-invalid @enderror" placeholder="European Article Number">
                                            @error('ean')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Product Description <span style="color:red">&#9733;</span></label>
                                            <input required="" value="{{old('description')}}" type="text" name="description" class="form-control @error('description') is-invalid @enderror" placeholder="Description">
                                            @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                    </div>
                                </div>


                                <div class="form-row">



                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledSelect">Category name <span style="color:red">&#9733;</span></label>
                                            <select required="" name="gategory_id" class="form-control @error('gategory_id') is-invalid @enderror">
                                                <option value="">Select</option>

                                                @foreach ($gategory as $key)

                                                <option {{old('gategory_id')==$key->id ? 'selected':''}} value="{{ $key->id }}">{{ $key->gategory_name }}</option>

                                                @endforeach


                                            </select>
                                            @error('gategory_id')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledSelect">Brand name <span style="color:red">&#9733;</span></label>
                                            <select required="" name="brand_id" class="form-control @error('brand_id') is-invalid @enderror">
                                                <option value="">Select</option>
                                                @foreach ($brand as $key)

                                                <option {{old('brand_id')==$key->id ? 'selected':''}} value="{{ $key->id }}">{{ $key->brand_name }}</option>



                                                @endforeach


                                            </select>
                                            @error('brand_id')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledSelect">Product Status <span style="color:red">&#9733;</span></label>
                                            <select required="" name="product_status" class="form-control  @error('product_status') is-invalid @enderror">
                                                <option value="">Select</option>
                                                <option {{old('product_status')=='Current' ? 'selected':''}} value="Current">Current</option>
                                                <option {{old('product_status')=='EOL' ? 'selected':''}} value="EOL">EOL</option>
                                            </select>
                                            @error('product_status')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Basic Allowance </label>
                                            <input value="0" type="text" name="basic_allowance" class="form-control @error('basic_allowance') is-invalid @enderror" placeholder="Basic Allowance">

                                            <span style="font-size:12px;color:red">Note: Enter Percentage Value</span>
                                            <br>
                                            @error('basic_allowance')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">


                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">STA </label>
                                            <input value="0" type="text" min="0" name="sta" class="form-control @error('sta') is-invalid @enderror" placeholder="STA">
                                            <span style="font-size:12px;color:red">Note: Enter Amount Value</span>
                                            <br>
                                            @error('sta')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">GST <span style="color:red">&#9733;</span></label>
                                            <input required="" value="0" type="text" name="gst" class="form-control @error('gst') is-invalid @enderror" placeholder="GST">

                                            <span style="font-size:12px;color:red">Note: Enter Percentage Value</span>
                                            <br>
                                            @error('gst')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">MRP <span style="color:red">&#9733;</span></label>
                                            <input required="" type="text" value="{{old('mrp')}}" name="mrp" class="form-control @error('mrp') is-invalid @enderror" placeholder="MRP">
                                            @error('mrp')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>


                                <div class="form-row">

                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">MOP <span style="color:red">&#9733;</span></label>
                                            <input required="" value="{{old('mop')}}" type="text" name="mop" class="form-control @error('mop') is-invalid @enderror" placeholder="MOP">
                                            @error('mop')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-4">
                                        <div class="form-group">
                                            <label for="disabledSelect">Bajaj Service Eligible <span style="color:red">&#9733;</span></label>
                                            <select required="" name="bajaj_status" class="form-control  @error('bajaj_status') is-invalid @enderror">
                                                <option value="">Select</option>
                                                <option {{old('bajaj_status')=='Yes' ? 'selected':''}} value="Yes">Yes</option>
                                                <option {{old('bajaj_status')=='No' ? 'selected':''}} value="No">No</option>
                                            </select>
                                            @error('bajaj_status')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-4">
                                        <div class="form-group">
                                            <label for="disabledSelect">Free Installation Eligible <span style="color:red">&#9733;</span></label>
                                            <select required="" name="enquiry_status" class="form-control  @error('enquiry_status') is-invalid @enderror">
                                                <option value="">Select</option>
                                                <option {{old('enquiry_status')=='Yes' ? 'selected':''}} value="Yes">Yes</option>
                                                <option {{old('enquiry_status')=='No' ? 'selected':''}} value="No">No</option>
                                            </select>
                                            @error('enquiry_status')
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
