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
                            <center><h5 class="card_title " style="color:#50aaca"> Add brand
                            <a href="{{ route('brand.create') }}" class="btn btn-primary btns" > <i class="fa fa-plus-circle"></i>Manage Brand</a>  </h5></center>
                            <hr>
                            <form method="post" enctype="multipart/form-data" action="{{route('brand.store')}}">
                                @csrf

                                    <div class="form-group">
                                        <label for="disabledTextInput">Brand name <span style="color:red">&#9733;</span></label>
                                        <input type="text" value="{{old('brand_name')}}" required="" name="brand_name" class="form-control @error('brand_name') is-invalid @enderror" placeholder="Brand name">
                                        @error('brand_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="disabledTextInput">Brand code <span style="color:red">&#9733;</span></label>
                                        <input type="text" required="" value="{{old('brand_code')}}" name="brand_code" class="form-control @error('brand_code') is-invalid @enderror" placeholder="Brand code">
                                        @error('brand_code')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                    </div>

                                    <center><h5 class="card_title " style="color:#50aaca"> Brand image <span style="color:red">&#9733;</span> </h5></center>


                                    <div class="form-group dropzone">
                                    <img src="{{asset('user/images/upload.svg')}}" class="upload-icon" />
                                      <input required="" accept="image/*" type="file" name="brand_image" class="form-control upload-input @error('brand_image') is-invalid @enderror"  >
                                   

                                      </div>




                                   <center><button id="yarabtnsubmit" type="submit" class="btn btn-primary mt-4 pl-4 pr-4">Submit</button>
                                   </center>
                                   @error('brand_image')
                                   <span class="text-danger">{{ $message }}</span>
                               @enderror
                                   <div class="form-row">
                                    <span style="color:red">&#9733;</span>
                                    <p>- Mandatory field</p>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

            

<style>
    .btn:hover {
	background: rebeccapurple;
	box-shadow: 0 3px 0 0 deeppink;
}
.dropzone {

	height: 80px;
	border: 1px dashed #999;
	border-radius: 3px;
	text-align: center;
}

.upload-icon {
	margin: 25px 2px 2px 2px;
    animation: hop 2s infinite;
}

.upload-input {
	position: relative;
	top: -62px;
	left: 0;
	width: 100%;
	height: 100%;
	opacity: 0;
}

@keyframes hop {
    10% { transform: scale(1.1, .8) translateY(5%) }
    15% { transform: scale(.9, 1.1) translateY(-80%)}
    25% { transform: scale(1.05, .9) translateY(-100%) }
    30% { transform: scale(1) translateY(-60%) }
    40% { transform: scale(1.05, 1) translateY(0) }
    41% { transform: scale(1.1, .9) }
    50% { transform: translateY(-15%) }
    60% { transform: translateY(0) }
}
</style>


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
