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

        .form-row {
            padding: 20px !important;
        }

        @page {
            size: auto;
            margin: 0;
        }
        .form-row > .col, .form-row > [class*="col-"]
{
padding-top: 35px;
}

    </style>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">

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
            box-shadow: 0 0 4px #888;
            padding: 0.5em 0.6em;

        }
        .dc-container {
            margin: 0 10px;
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            justify-content: space-between;

        }

        .dc-wrapper {
            margin-top: 20%;
            display: flex;
            flex-direction: column;
            align-items: center;

        }

        .dc-wrapper img {
            height: 100%;
            width: 50%;

        }


    </style>


</head>

<body onload="employee_print()">


    <!--==================================*
               Main Content Section
    *====================================-->
    <!--==================================*
                   Main Section
        *====================================-->


    <div style="page-break-after: always !important;" class="card">

        <div class="card-body">

            <hr>

            <div class="form-row">

                <div class="col-md-6 mb-6">
                    <div class="form-group">
                        <label for="disabledTextInput">Employee ID </label>
                        <input readonly value="{{$row->emp_id}}" type="text" name="emp_id" class="form-control" placeholder="Employee ID">

                    </div>
                </div>

                <div class="col-md-6 mb-6">
                    <div class="form-group">
                        <label for="disabledTextInput">Name </label>
                        <input required="" value="{{$row->name}}" type="text" name="name" class="form-control" placeholder="Name">
                    </div>
                </div>

                <div class="col-md-6 mb-6">
                    <div class="form-group">
                        <label for="disabledTextInput">Father/Guardian/Spouse Name</label>
                        <input value="{{$row->a_name}}" type="text" name="a_name" class="form-control" placeholder="Father/Guardian/Spouse Name">
                    </div>
                </div>

                <div class="col-md-6 mb-6">
                    <div class="form-group">
                        <label for="disabledTextInput">Father/Guardian/Spouse Mobile No.</label>
                        <input value="{{$row->a_phone}}" type="text" name="a_phone" class="form-control" placeholder="Father/Guardian/Spouse Mobile No">
                    </div>
                </div>


            </div>
            <div class="form-row">


                <div class="col-md-12 mb-12">
                    <div class="form-group">
                        <label for="disabledTextInput">Address </label>
                        <textarea required="" type="text" name="address" class="form-control" placeholder="Address">{{$row->address}}</textarea>
                    </div>
                </div>
            </div>
            <div class="form-row">

                <div class="col-md-6 mb-6">
                    <div class="form-group">
                        <label for="disabledTextInput">DOB </label>
                        <input required="" value="{{$row->dob}}" type="date" name="dob" class="form-control" placeholder="Date of birth">
                    </div>
                </div>

                <div class="col-md-6 mb-6">
                    <div class="form-group">
                        <label for="disabledTextInput">Personal Mobile No. </label>
                        <input required="" value="{{$row->phone}}" onkeypress="return isNumberKey(event)" minlength="10" maxlength="10" type="text" name="phone" class="form-control" placeholder="Personal Mobile No">
                    </div>
                </div>

                <div class="col-md-6 mb-6">
                    <div class="form-group">
                        <label for="disabledTextInput">E-mail ID </label>
                        <input type="email" value="{{$row->email}}" name="email" class="form-control" placeholder="Email">
                    </div>
                </div>

                <div class="col-md-6 mb-6">
                    <div class="form-group">
                        <label for="disabledTextInput">Emergency Conatct No. </label>
                        <input value="{{$row->e_phone}}" onkeypress="return isNumberKey(event)" minlength="10" maxlength="10" type="text" name="e_phone" class="form-control" placeholder="Emergency Conatct No">
                    </div>
                </div>




            </div>
            <div class="form-row">

                <div class="col-md-6 mb-6">
                    <div class="form-group">
                        <label for="disabledTextInput">Bank Name </label>
                        <input required="" value="{{$row->bank}}" type="text" name="bank" class="form-control" placeholder="Bank Name">
                    </div>
                </div>

                <div class="col-md-6 mb-6">
                    <div class="form-group">
                        <label for="disabledTextInput">Bank Account No </label>
                        <input required="" value="{{$row->account_no}}" type="text" name="account_no" class="form-control" placeholder="Bank Account No.">
                    </div>
                </div>

                <div class="col-md-6 mb-6">
                    <div class="form-group">
                        <label for="disabledTextInput">IFSC Code </label>
                        <input required="" type="text" value="{{$row->ifsc_code}}" name="ifsc_code" class="form-control" placeholder="IFSC Code">
                    </div>
                </div>

                <div class="col-md-6 mb-6">
                    <div class="form-group">
                        <label for="disabledTextInput">Branch Name </label>
                        <input required="" value="{{$row->branch}}" type="text" name="branch" class="form-control" placeholder="Branch Name ">
                    </div>
                </div>




            </div>

            <div class="form-row">

                <div class="col-md-6 mb-6">
                    <div class="form-group">
                        <label for="disabledTextInput">Passport No. </label>
                        <input type="text" value="{{$row->passport_no}}" name="passport_no" class="form-control" placeholder="Passport No">
                    </div>
                </div>

                <div class="col-md-6 mb-6">
                    <div class="form-group">
                        <label for="disabledTextInput">Date of joining </label>
                        <input required="" value="{{$row->doj}}" type="date" name="doj" class="form-control" placeholder="Date of joining ">
                    </div>
                </div>

                <div class="col-md-6 mb-6">
                    <div class="form-group">
                        <label for="disabledTextInput">Blood Group </label>
                        <input required="" value="{{$row->blood_group}}" type="text" name="blood_group" class="form-control" placeholder="Blood Group">
                    </div>
                </div>

                <div class="col-md-6 mb-6">
                    <div class="form-group">
                        <label for="disabledTextInput">Aadhar No. </label>
                        <input required="" value="{{$row->aadhar_no}}" type="text" name="aadhar_no" class="form-control" placeholder="Aadhar No">
                    </div>
                </div>




            </div>
            <div class="form-row">



                <div class="col-md-6 mb-6">
                    <div class="form-group">
                        <label style="white-space:nowrap" for="disabledTextInput">Employee Type </label>
                        <input required="" value="{{$row->employee_type}}" list="type" type="text" name="employee_type" placeholder="Employee Type" class="form-control">
                    </div>
                </div>

                <datalist id="type">
                    <option value="Demonstrator">
                    <option value="Sales Man">
                    <option value="GM">
                    <option value="HR">
                    <option value="Accounts">
                    <option value="TL">
                    <option value="Driver">
                </datalist>

                <div class="col-md-6 mb-6">

                    <div class="form-group">
                        <label for="disabledSelect">Status</label>
                        <select name="status" class="form-control">
                            <option {{$row->status=='Enable' ? 'selected':''}} value="Enable">Enable</option>
                            <option {{$row->status=='Disable' ? 'selected':''}} value="Disable">Disable</option>
                        </select>
                    </div>
                </div>


            </div>


        </div>
    </div>
    </div>



    <div style="page-break-before: always;" class="dc-container">

        <div class="dc-wrapper">
            <label for="disabledTextInput">Passport Size Photo </label>
            <img style="page-break-before: always;" src="{{ $row::proof($row->photo)}}">
        </div>
    </div>
    <div style="page-break-before: always;" class="dc-container">



        <div class="dc-wrapper">
            <label for="disabledTextInput">Aadhar Proof </label>

            <img style="page-break-before: always;" src="{{ $row::proof($row->aadhar) }}">
        </div>
    </div>
    <div style="page-break-before: always;" class="dc-container">




        <div class="dc-wrapper">
            <label for="disabledTextInput">Driving License</label>

            <img src="{{  $row::proof($row->license)}}">

        </div>
    </div>


<div style="page-break-before: always;" class="dc-container">


        <div class="dc-wrapper">
            <label for="disabledTextInput">Certificate Of Education</label>

            <img style="page-break-before: always;" src="{{  $row::proof($row->education)}}">

        </div>




    </div>




    <script>
        function employee_print() {
            window.print();
        }

    </script>

</body>

</html>

