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
                                <h5 class="card_title " style="color:#50aaca"> Edit marketing creatives
                                <a href="{{ route('marketing.master') }}" class="btn btn-primary btns"> <i class="fa fa-plus-circle"></i>Manage Marketing Creatives</a>

                            </h5>
                            <hr>
                            <form method="post" enctype="multipart/form-data" action="{{route('marketing.update',$row->id)}}">
                                @csrf

                                <div class="form-group">
                                    <label for="disabledTextInput">Title<span style="color:red">&#9733;</span></label>
                                    <input required="" type="text" value="{{$row->title}}" name="title" class="form-control" placeholder="Brand name">
                                    @if ($errors->has('title'))
                                    <span class="text-danger">{{ $errors->first('title') }}</span>
                                    @endif
                                </div>



                                <center>
                                    <h5 class="card_title " style="color:#50aaca"> Marketing creatives image </h5>
                                </center>

                                @php
                                $value=json_decode($row->posts,true);
                                @endphp
                                <div class="form-group dropzone">

                                <img src="{{asset('user/images/upload.svg')}}" class="upload-icon" />


                                    <input type="file" multiple name="posts[]" class="form-control upload-input">

                                </div>
                                @if ($errors->has('posts.*'))
                                    <span class="text-danger">{{ $errors->first('posts.*') }}</span>
                                    @endif



                                <center><button type="submit" class="btn btn-primary mt-4 pl-4 pr-4">Submit</button>
                                </center>
                                <div class="form-row">
                                    <span style="color:red">&#9733;</span>
                                    <p>- Mandatory field</p>
                                </div>
                                <div class="form-group">

                                    @foreach($value as $img)

                                    <img src="{{ url('/').'/'.$img }}" class="form-control "/>
                                    @endforeach
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
                        height: 60%;
                        width: 10%;
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
                        10% {
                            transform: scale(1.1, .8) translateY(5%)
                        }

                        15% {
                            transform: scale(.9, 1.1) translateY(-70%)
                        }

                        25% {
                            transform: scale(1.05, .9) translateY(-70%)
                        }

                        30% {
                            transform: scale(1) translateY(-50%)
                        }

                        40% {
                            transform: scale(1.05, 1) translateY(0)
                        }

                        41% {
                            transform: scale(1.1, .9)
                        }

                        50% {
                            transform: translateY(-15%)
                        }

                        60% {
                            transform: translateY(0)
                        }
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
