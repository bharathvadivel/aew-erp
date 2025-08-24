{{-- Login check --}}

@if (session()->get('partner_type')=='')
<script>
    window.location.href = "{{ route('/')}}";

</script>
@endif



<link rel="shortcut icon" type="image/x-icon" href="{{asset('user/images/favicon.png')}}">

<!--=========================*
        Bootstrap Css
        *===========================-->
<link rel="stylesheet" href="{{asset('user/css/bootstrap.min.css')}}">

<!--=========================*
           Toastr Css
           *===========================-->
<link rel="stylesheet" href="{{asset('user/vendors/toastr/css/toastr.min.css')}}">

<!--=========================*
          Custom CSS
          *===========================-->
<link rel="stylesheet" href="{{asset('user/css/style.css')}}">

<!--=========================*
           Owl CSS
           *===========================-->
<link href="{{asset('user/css/owl.carousel.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('user/css/owl.theme.default.min.css')}}" rel="stylesheet" type="text/css">

<!--=========================*
           Morris Css
           *===========================-->
<link rel="stylesheet" href="{{asset('user/vendors/charts/morris-bundle/morris.css')}}">

<!--=========================*
        Font Awesome
        *===========================-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

<!--=========================*
         Themify Icons
         *===========================-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/themify-icons/0.1.2/css/themify-icons.css">

<!--=========================*
           Ionicons
           *===========================-->
<link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet">

<!--=========================*
           Sweet Alert Css
           *===========================-->
<link rel="stylesheet" href="{{asset('user/vendors/sweetalert2/css/sweetalert2.min.css')}}">

<!--=========================*
           Summernot
           *===========================-->
<link rel="stylesheet" href="{{asset('user/vendors/summernote/dist/summernote-bs4.css')}}">

<!--=========================*
          EtLine Icons
          *===========================-->
<link href="{{asset('user/css/et-line.css')}}" rel="stylesheet">

<!--=========================*
          Feather Icons
          *===========================-->
<link href="{{asset('user/css/feather.css')}}" rel="stylesheet">

<!--=========================*
          Flag Icons
          *===========================-->
<link href="{{asset('user/css/flag-icon.min.css')}}" rel="stylesheet">

<!--=========================*
          Material Icons
          *===========================-->
<link href="https://cdn.jsdelivr.net/npm/@mdi/font@5.4.55/css/materialdesignicons.min.css" rel="stylesheet">

<!--=========================*
          Modernizer
          *===========================-->
<script src="{{asset('user/js/modernizr-2.8.3.min.js')}}"></script>

<!--=========================*
           Metis Menu
           *===========================-->
<link rel="stylesheet" href="{{asset('user/css/metisMenu.css')}}">

<!--=========================*
           Slick Menu
           *===========================-->
<link rel="stylesheet" href="{{asset('user/css/slicknav.min.css')}}">

<!--=========================*
          Flag Icons
          *===========================-->
<link href="{{asset('user/css/flag-icon.min.css')}}" rel="stylesheet">

<!--=========================*
          Material Icons
          *===========================-->
<!-- <link href="{{asset('user/css/materialdesignicons.min.css')}}" rel="stylesheet"> -->

<!--=========================*
           AM Chart
           *===========================-->
<link rel="stylesheet" href="{{asset('user/vendors/am-charts/css/am-charts.css')}}" type="text/css" media="all">

<!--=========================*
           Morris Css
           *===========================-->
<link rel="stylesheet" href="{{asset('user/vendors/charts/morris-bundle/morris.css')}}">

<!--=========================*
       J Vector Map Css
       *===========================-->
<link href="{{asset('user/vendors/j-vectormap/jquery-jvectormap-1.2.2.css')}}" rel="stylesheet" type="text/css">


<!--=========================*
     Fullscreen Calendar
     *===========================-->
<link rel="stylesheet" href="{{asset('user/vendors/fullcalendar/dist/fullcalendar.min.css')}}">
<link rel="stylesheet" href="{{asset('user/vendors/fullcalendar/dist/fullcalendar.print.min.css')}}" media="print">

<!--=========================*
           Fancy Box
           *===========================-->
<link rel="stylesheet" href="{{asset('user/css/jquery.fancybox.css')}}">

<!--=========================*
           Js Grid
           *===========================-->
<link type="text/css" rel="stylesheet" href="{{asset('user/vendors/js-grid/css/jsgrid.min.css')}}">
<link type="text/css" rel="stylesheet" href="{{asset('user/vendors/js-grid/css/jsgrid-theme.min.css')}}">

<!--=========================*
           Ladda Button
           *===========================-->
<link rel="stylesheet" href="{{asset('user/vendors/ladda-button/css/ladda-themeless.min.css')}}">

<!--=========================*
           Datatable
           *===========================-->
<!-- Start datatable css -->
<link rel="stylesheet" type="text/css" href="{{asset('user/vendors/data-table/css/jquery.dataTables.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('user/vendors/data-table/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('user/vendors/data-table/css/responsive.bootstrap.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('user/vendors/data-table/css/responsive.jqueryui.min.css')}}">

<!--=========================*
        Google Fonts
        *===========================-->

<!-- Font USE: 'Roboto', sans-serif;-->
<link rel="preconnect" href="https://fonts.gstatic.com">
<!-- <link href="css2.css?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet"> -->


<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
<style>
    i.feather {
        /*  display: inline-block;*/
        border-radius: 60px;
        box-shadow: 0 0 4px #888;
        padding: 0.5em 0.6em;

    }


    i.fa {
        /*  display: inline-block;*/
        border-radius: 60px;
        padding: 0.5em 0.6em;

    }

    @media only screen and (min-width: 768px) {
        .token_ref {
            margin-top: 34px;
        }
    }

    .notification-area li {
        margin-left: 150px;
    }

    .heart {
        animation: heartbeat 2.5s infinite;
    }

    @keyframes heartbeat {
        0% {
            transform: scale(.75);
        }

        20% {
            transform: scale(1);
        }

        40% {
            transform: scale(.75);
        }

        60% {
            transform: scale(1);
        }

        80% {
            transform: scale(.75);
        }

        100% {
            transform: scale(.75);
        }
    }

    .dataTable {
        width: -webkit-fill-available !important;
    }

    .card-title {
        font-size: 16px !important;
    }

    .primary_card_bg {
        background: #5584AC !important;
    }

    .info_card_bg {
        background: #F3826F !important;

    }

    .success_card_bg {
        background: #AD9D9D !important;

    }

    .warning_card_bg {
        background: #7267CB !important;

    }

    .stretched_card {
        cursor: pointer;
    }

    .dropdown_user .user_bio .name {
        white-space: break-spaces;
    }

    .invoice-title-edit-dat {
        display: flex !important;
        justify-content: flex-end;
    }

    .invoice-title-edit-new {
        display: flex !important;
        justify-content: center;
    }

    @media (min-width: 768px) {
        .side_collapsed .menu-inner {
            height: unset !important;
        }
    }

    .text-danger {
        font-size: 14px;
    }


    #cover-spin {
        position: fixed;
        width: 100%;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        background-color: rgba(255, 255, 255, 0.7);
        z-index: 9999;
        display: block;
    }

    @-webkit-keyframes spin {
        from {
            -webkit-transform: rotate(0deg);
        }

        to {
            -webkit-transform: rotate(360deg);
        }
    }

    @keyframes spin {
        from {
            transform: rotate(0deg);
        }

        to {
            transform: rotate(360deg);
        }
    }

    #cover-spin::after {
        content: '';
        display: block;
        position: absolute;
        left: 48%;
        top: 40%;
        width: 40px;
        height: 40px;
        border-style: solid;
        border-color: black;
        border-top-color: transparent;
        border-width: 4px;
        border-radius: 50%;
        -webkit-animation: spin .8s linear infinite;
        animation: spin .8s linear infinite;
    }

</style>



<!-- SIDEBAR -->
<script>
    setTimeout(loaderTimeOut, 1000);

    function loaderTimeOut() {
        $('#cover-spin').hide(0);

    }

    function ajaxloderIn() {
        document.getElementById('ajaxsubmit').disabled = true;
        $('#cover-spin').show(0);
    }

    function ajaxloderOut() {
        document.getElementById('ajaxsubmit').disabled = false;
        $('#cover-spin').hide(0);
    }

</script>
<div id="cover-spin"></div>



<!--=========================*
     Page Container
     *===========================-->
<div id="page-container">

    <!--==================================*
           Header Section
           *====================================-->
    <div class="header-area">

        <!--======================*
               Logo
               *=========================-->
        <div class="header-area-left">
            <a href="#" class="logo">
                <span>
                    <img src="{{asset('login/img/logo.png')}}" alt="" height="18">
                </span>
                <i>
                    <img src="{{asset('login/img/logo.png')}}" alt="" height="22">
                </i>
            </a>
        </div>
        <!--======================*
              End Logo
              *=========================-->

        <div class="row align-items-center header_right">
            <!--==================================*
                 Navigation and Search
                 *====================================-->
            <div class="col-md-4 d_none_sm d-flex align-items-center">
            </div>

            <div class="col-md-6 d_none_sm d-flex justify-content-end">
            </div>

            <!--==================================*
                 End Navigation and Search
                 *====================================-->
            <!--==================================*
                 Notification Section
                 *====================================-->
            <div class="col-md-2 col-sm-12 ">
                <ul class="notification-area pull-right">
                    <!-- <li class="user-dropdown">
                        <a class="btn" href="{{url('/logout')}}"><i class="ti-power-off"></i>Logout</a>
                    </li> -->
                    <li class="user-dropdown">
                        <div class="dropdown">
                            <button class="btn dropdown-toggle" onclick="p_hide()" type="button" id="dropdownMenuButton" aria-haspopup="true" aria-expanded="false">
                                <img src="{{asset('user/images/user.png')}}" alt="" class="img-fluid">
                            </button>
                            <div onclick="p_hide()" class="dropdown-menu dropdown_user" id="p_hide" aria-labelledby="dropdownMenuButton">

                                <div class="dropdown-header d-flex flex-column align-items-center">
                                    {{-- <div class="user_img mb-3">
                                        <img src="{{asset('user/images/User_Circle.png')}}" alt="User Image">
                                    </div> --}}
                                    <div class="user_bio text-center">
                                        <p class="name font-weight-bold mb-0">{{session()->get('name')}}</p>
                                        <p class="email text-muted mb-3"><a class="pl-3 pr-3" href="#">{{session()->get('phone')}}</a></p>
                                    </div>
                                </div>
                                <a class="dropdown-item" href="{{url('/user_profile')}}"><i class="ti-user"></i> Profile</a>
                                <span role="separator" class="divider"></span>
                                <a class="dropdown-item" href="{{url('/logout')}}"><i class="ti-power-off"></i>Logout</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        <!--==================================*
                 End Notification Section
                 *====================================-->
    </div>

</div>
<!--==================================*
           End Header Section
           *====================================-->

<!--=========================*
         Side Bar Menu
         *===========================-->
<div class="sidebar_menu">
    <div class="menu-inner">
        <div id="sidebar-menu">
            <!--=========================*
                       Main Menu
                       *===========================-->
            <ul class="metismenu" id="sidebar_menu">



                {{-- admin menu --}}
                @include('logics.include.admin_menu')

                <!-- <li>
                    <a href="{{url('view_warraanty')}}">
                        <i class="fa fa-database"></i>
                        <span>Warranty Check</span>
                    </a>
                </li>

                <li>
                    <a href="{{url('clear_cache')}}">
                        <i class="fa fa-database"></i>
                        <span>Clear Cache</span>
                    </a>
                </li> 

                <li>
                    <a href="{{route('logout')}}">
                        <i class="fa fa-user"></i>
                        <span>Logout</span>
                    </a>
                </li> -->



            </ul>
            <!--=========================*
                      End Main Menu
                      *===========================-->
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<p style="display: none" id="p_hide_check">1</p>
<script>
    function p_hide() {

        var el = document.getElementById("p_hide");
        var ch = document.getElementById("p_hide_check").innerHTML;


        // Adding Single class
        if (ch == 1) {
            el.classList.add("show");
            document.getElementById("p_hide_check").innerHTML = 0;
        } else {
            el.classList.remove("show");
            document.getElementById("p_hide_check").innerHTML = 1;

        }
    }

    /* Function to generate combination of password */
    function generateP() {
        var pass = '';
        var str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ' +
            'abcdefghijklmnopqrstuvwxyz0123456789@#$';

        for (let i = 1; i <= 10; i++) {
            var char = Math.floor(Math.random() *
                str.length + 1);

            pass += str.charAt(char)
        }

        return pass;
    }

    function gfg_Run() {
        document.getElementById("token_refresh").value = generateP();
    }

</script>
<!--=========================*
       End Side Bar Menu
       *===========================-->
