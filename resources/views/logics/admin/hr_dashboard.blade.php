<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>

    <!--=========================*
        Met Data
        *===========================-->
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{asset('user/new_npm_css/bootstrap.min.css')}}" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('logics.include.datatabledesign')


    <!--=========================*
            Page Title
            *===========================-->
    <title>ERP</title>

    <style>
        .dts {
            display: flex;
            flex-direction: row;
            justify-content: space-around;
            top: 0px;
            left: 0;
            margin-bottom: 29px;
            flex-wrap: wrap;
            width: 25% !important;


        }

        .dtslable {
            text-decoration-line: underline;
            text-underline-offset: 8px;
            text-decoration-color: red;
            color: #49bf2d;
        }

        label {
            cursor: pointer;
        }

        .boh {

            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);


            padding-bottom: 50px;
            padding-top: 50px;
        }

        i.fa {
            display: inline-block;
            border-radius: 60px;
            box-shadow: 0 0 4px #888;
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

<body onload="filter_data('{{$filter}}')">

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



            <div class="row" style="padding-bottom:50px">
                <div  class="col-xl-3 col-md-4 col-lg-12 stretched_card">


                    <div class="card mb-mob-4 icon_card primary_card_bg">
                        <!-- Card body -->
                        <div class="card-body">
                            <p class="card-title mb-0 text-white">Total Employee</p>
                            <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                                <h2 class="mb-0 text-white heart">{{$total_employee}}</h2>
                                <div class="arrow_icon"><i class="fa fa-plus"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-4 col-lg-12 stretched_card">
                    <div class="card mb-mob-4 icon_card success_card_bg">
                        <!-- Card body -->
                        <div class="card-body">
                            <p class="card-title mb-0 text-white">Attendance Employee</p>

                            <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                                <h2 class="mb-0 text-white heart">{{$total_attendance_employee}}</h2>

                                <div class="arrow_icon"><i class="fa fa-plus"></i></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div onclick="window.location.href ='{{route('attendance.day.report')}}'" class="col-xl-3 col-md-4 col-lg-12 stretched_card">


                    <div class="card mb-mob-4 icon_card info_card_bg">
                        <!-- Card body -->
                        <div class="card-body">
                            <p class="card-title mb-0 text-white">People present today</p>

                            <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                                <h2 class="mb-0 text-white heart">{{$present}}</h2>
                                <div class="arrow_icon"><i class="fa fa-plus"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div onclick="window.location.href ='{{route('attendance.day.report')}}'"  class="col-xl-3 col-md-4 col-lg-12 stretched_card">

                    <div class="card mb-mob-4 icon_card success_card_bg">
                        <!-- Card body -->
                        <div class="card-body">
                            <p class="card-title mb-0 text-white">Peoble absent today</p>

                            <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                                <h2 class="mb-0 text-white heart">{{$absent}}</h2>
                                <div class="arrow_icon"><i class="fa fa-plus"></i></div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <div class="row" style="padding-bottom:50px">
                <div onclick="window.location.href ='{{route('attendance.day.report')}}'" class="col-xl-3 col-md-4 col-lg-12 stretched_card">

                    <div class="card mb-mob-4 icon_card success_card_bg">
                        <!-- Card body -->
                        <div class="card-body">
                            <p class="card-title mb-0 text-white">Peoble leave today</p>

                            <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                                <h2 class="mb-0 text-white heart">{{$leave}}</h2>
                                <div class="arrow_icon"><i class="fa fa-plus"></i></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div onclick="window.location.href ='{{route('attendance.day.report')}}'" class="col-xl-3 col-md-4 col-lg-12 stretched_card">
                    <div class="card mb-mob-4 icon_card primary_card_bg">
                        <!-- Card body -->
                        <div class="card-body">
                            <p class="card-title mb-0 text-white">Peoble half day today</p>
                            <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                                <h2 class="mb-0 text-white heart">{{$halfday}}</h2>
                                <div class="arrow_icon"><i class="fa fa-plus"></i></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>



            <div class="row">
                <div class="card-body">
                    <form method="post" action="{{route('hr.dashboard')}}">
                        @csrf

                        <div class="form-row align-items-center">
                            <div class="col-sm-3 my-3">
                                <label for="inlineFormInputName">Filter</label>
                                <select required="" onchange="filter_data(this.value)" name="filter" class="form-control">
                                    <option {{$filter=='today' ? 'selected':''}} value="today">Today</option>
                                    <option {{$filter=='month' ? 'selected':''}} value="month">This Month</option>
                                    <option {{$filter=='custom' ? 'selected':''}} value="custom">Custom</option>

                                </select>
                            </div>


                            <div style="display:none" id="from_date" class="col-sm-3 my-3">
                                <label for="inlineFormInputName">From Date</label>

                                <input type="date" value="{{$from_date}}" class="form-control" name="from_date">
                            </div>
                            <div style="display:none" id="to_date" class="col-sm-3 my-3">
                                <label for="inlineFormInputName">To Date</label>

                                <input type="date" value="{{$to_date}}" class="form-control" name="to_date">
                            </div>

                            <div class="col-sm-1 my-1">
                                <label for="inlineFormInputName"></label>
                                <input style="margin-top: 6px;background-color:#585858;color:white" type="submit" value="Search" class="form-control">

                            </div>
                        </div>
                    </form>



                </div>
            </div>


            <div id="tab1Content" class="row">
                <div class="col-xl-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div class="dts">
                                <label onClick="JavaScript:selectTab(1);" class="dtslable">Employee list</label>
                                <label onClick="JavaScript:selectTab(2);">Attendance</label>
                            </div>


                            <div class="table-responsive datatable-primary">
                                <table class="table myTable" id="dataTable" class="text-center boh">
                                    <thead>
                                        <tr>
                                            <th>S.NO </th>
                                            <th>Employee-ID</th>
                                            <th>Name (Employee)</th>
                                            <th>Father/Guardian/Spouse Name </th>
                                            <th>Father/Guardian/Spouse Mobile No.</th>
                                            <th>Address (Employee)</th>
                                            <th>DOB (Employee)</th>
                                            <th>Personal Mobile No. (Employee)</th>
                                            <th>E-mail ID (Employee)</th>
                                            <th>Emergency Conatct No. (Employee)</th>
                                            <th>Bank Name (Employee)</th>
                                            <th>Bank Account No (Employee)</th>
                                            <th>IFSC Code (Employee)</th>
                                            <th>Branch Name (Employee)</th>
                                            <th>Passport No. (Employee)</th>
                                            <th>Date of joining (Employee)</th>
                                            <th>Blood Group (Employee)</th>
                                            <th>Aadhar No. (Employee) </th>
                                            <th class="thdis">Passport Size Photo</th>
                                            <th class="thdis">Aadhar Proof</th>
                                            <th class="thdis">Driving License </th>
                                            <th class="thdis">Certificate Of Education</th>
                                            <th>Employee Type</th>
                                            <th>Status</th>
                                            <th>Print</th>
                                            <th>Action</th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($emp_data as $key=>$vl)

                                        @php
                                        $color= $vl->status=='Enable'? 'green' : 'red';
                                        $color="color:".$color;
                                        @endphp
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$vl->emp_id}}</td>
                                            <td>{{$vl->name}}</td>
                                            <td>{{$vl->a_name}}</td>
                                            <td>{{$vl->a_phone}}</td>
                                            <td>{{$vl->address}}</td>
                                            <td>{{$vl->phone}}</td>
                                            <td>{{$vl->dob}}</td>
                                            <td>{{$vl->email}}</td>
                                            <td>{{$vl->e_phone}}</td>
                                            <td>{{$vl->bank}}</td>
                                            <td>{{$vl->account_no}}</td>
                                            <td>{{$vl->ifsc_code}}</td>
                                            <td>{{$vl->branch}}</td>
                                            <td>{{$vl->passport_no}}</td>
                                            <td>{{$vl->doj}}</td>
                                            <td>{{$vl->blood_group}}</td>
                                            <td>{{$vl->aadhar_no}}</td>
                                            <td class="thdis"><a href="{{ asset('user/images/employee/'.$vl->photo) }}" target="_blank"><img style="width: 34px;" src="{{ asset('user/images/file.png') }}"></a></td>
                                            <td class="thdis"><a href="{{ asset('user/images/employee/'.$vl->aadhar) }}" target="_blank"><img style="width: 34px;" src="{{ asset('user/images/file.png') }}"></a></td>
                                            <td class="thdis"><a href="{{ asset('user/images/employee/'.$vl->license) }}" target="_blank"><img style="width: 34px;" src="{{ asset('user/images/file.png') }}"></a></td>
                                            <td class="thdis"><a href="{{ asset('user/images/employee/'.$vl->education) }}" target="_blank"><img style="width: 34px;" src="{{ asset('user/images/file.png') }}"></a></td>




                                            <td>{{$vl->employee_type}}</td>

                                            <td style="{{ $color }}">{{$vl->status}}</td>

                                            <td><a target="_blank" href="{{route('employee.print',$vl->id)}}"><i  data-placement="top" title="Employee Details" class="fa fa-print" style="color:green"></i></a>

                                            <td><a href="{{route('employee.edit',$vl->id)}}"><i  data-placement="top" title="Edit" class="fa fa-edit" style="color:#056c91"></i></a>

                                                <form onsubmit="return confirm('Are you sure you want to delete?');" action="{{ route('employee.delete',$vl->id)}}" method="POST">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <button><i  data-placement="top" title="Delete" class="fa fa-trash" style="color:red"></i></button>
                                                </form>
                                                <form onsubmit="return confirm('Are you sure you want to login?');" action="{{ route('login.by.admin')}}" method="POST">
                                                    <input type="hidden" name="_method" value="POST">
                                                    <input type="hidden" name="phone" value="{{$vl->phone}}">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <button><i  data-placement="top" title="Login" class="fa fa-sign-in" style="color:red"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="tab2Content" class="row">
                <div class="col-xl-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div class="dts">
                                <label onClick="JavaScript:selectTab(1);">Employee list</label>
                                <label onClick="JavaScript:selectTab(2);" class="dtslable">Attendance</label>

                            </div>


                            <div class="table-responsive datatable-primary">
                                <table class="table myTable" id="dataTable1" class="text-center boh">
                                    <thead>
                                        <tr>
                                            <th>S.NO </th>
                                            <th>Employee ID</th>
                                            <th>Employee Type</th>
                                            <th>Name </th>
                                            <th>Date</th>
                                            <th>Place</th>
                                            <th>Punch In</th>
                                            <th>Punch Out</th>
                                            <th>Working Time</th>
                                            <th>Remarks</th>
                                            <th>Attendance</th>




                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($attendance as $key=>$vl)
                                        @php
                                        $color= ($vl->status=='A' || $vl->status=='L' ) ? 'red' : 'green';


                                        $color="color:".$color;

                                        @endphp

                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$vl->partner_id}}</td>
                                            <td>{{$vl->partner_type}}</td>
                                            <td>{{$vl->name}}</td>
                                            <td>{{$vl->date}}</td>
                                            <td>{{$vl->place}}</td>
                                            <td>{{$vl->in_time}}</td>
                                            <td>{{$vl->out_time}}</td>
                                            <td>{{$vl->working_time}}</td>
                                            <td>{{$vl->remarks}}</td>
                                            <td style="{{ $color }}">{{$vl->status}}</td>


                                        </tr>
                                        @endforeach


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>







        </div>
    </div>




    <!--==================================*
                                End Main Section
                                *====================================-->
    </div>
    </div>



    <script>
        function selectTab(tabIndex) {
            //Hide All Tabs
            document.getElementById('tab1Content').style.display = "none";
            document.getElementById('tab2Content').style.display = "none";


            //Show the Selected Tab
            document.getElementById('tab' + tabIndex + 'Content').style.display = "block";


        }

        function filter_data(value) {
            //Hide All Tabs
            if (value == 'custom') {
                document.getElementById('from_date').style.display = "block";
                document.getElementById('to_date').style.display = "block";
            } else {
                document.getElementById('from_date').style.display = "none";
                document.getElementById('to_date').style.display = "none";
            }

        }

    </script>

    <script>
        function sea() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // event.preventDefault();
            var search = document.getElementById('search').value;
            if (search == '') {
                alert('Please typa a value');
            }
            $.ajax({
                type: 'POST'
                , url: "{{ route('enquiry.search')}}"
                , data: {
                    search: search
                }
                , success: function(data) {
                    $('.search').show();
                    $('.search').html(data);

                }
            });


        }

    </script>

    <!--=================================*
                            Footer Section
                            *===================================-->
    <footer>
        @include('logics.include.footer')
    </footer>
    <!--=================================*
                                End Footer Section
                                *===================================-->

    <!--=========================*
                                    End Page Container
                                    *===========================-->
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                dom: 'Bfrtip'
                , buttons: [{
                        extend: 'copy'
                        , exportOptions: {
                            columns: [0, 2, 3, 4, 5, 7, 9, 10, 11, 12, 13, 14, 15, 16, 22, 23]

                        }
                    }
                    , {
                        extend: 'csv'
                        , exportOptions: {
                            columns: [0, 2, 3, 4, 5, 7, 9, 10, 11, 12, 13, 14, 15, 16, 22, 23]



                        }
                    }
                    , {
                        extend: 'excel'
                        , exportOptions: {
                            columns: [0, 2, 3, 4, 5, 7, 9, 10, 11, 12, 13, 14, 15, 16, 22, 23]


                        }
                    }
                    , {
                        extend: 'pdf'
                        , orientation: 'landscape'
                        , exportOptions: {
                            columns: [0, 2, 3, 4, 5, 7, 9, 10, 11, 12, 13, 14, 15, 16, 22, 23]


                        }
                    }
                    , {
                        extend: 'print'
                        , exportOptions: {
                            columns: [0, 2, 3, 4, 5, 7, 9, 10, 11, 12, 13, 14, 15, 16, 22, 23]

                        }
                    }


                ],

            });
        });


        $(document).ready(function() {
            $('#dataTable1').DataTable({
                dom: 'Bfrtip'
                , buttons: [{
                        extend: 'copy'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
                        }
                    }
                    , {
                        extend: 'csv'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]

                        }
                    }
                    , {
                        extend: 'excel'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
                        }
                    }
                    , {
                        extend: 'pdf'
                        , orientation: 'landscape'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
                        }
                    }
                    , {
                        extend: 'print'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
                        }
                    }


                ],

            });
        });

    </script>

    @include('logics.include.datatable')


    <!--=========================*
                                        Scripts
                                        *===========================-->


</body>

</html>
