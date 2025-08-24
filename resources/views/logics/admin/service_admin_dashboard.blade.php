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
    @include('logics.include.datatabledesign')


    <meta name="csrf-token" content="{{ csrf_token() }}">

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
            width: 77% !important;


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

        #tab2Content,
        #tab3Content,
        #tab4Content,
        #tab5Content {
            display: none;
        }

        @media only screen and (min-width: 576px) {

            .modal-dialog {
                max-width: 500px !important;
                margin: 1.75rem auto;
            }
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
                <div onClick="JavaScript:selectTab(1),sec('tab1Content')" class="col-xl-4 col-md-6 col-lg-12 stretched_card">

                    <div class="card mb-mob-4 icon_card primary_card_bg">
                        <!-- Card body -->
                        <div class="card-body">
                            <p class="card-title mb-0 text-white">Today Enquiries</p>
                            <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                                <h2 class="mb-0 text-white heart">{{$total_today_enquiry}}</h2>
                                <div class="arrow_icon"><i class="ion-arrow-up-c text-primary"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div onclick="window.location.href ='{{route('enquiry.master')}}'" class="col-xl-4 col-md-6 col-lg-12 stretched_card">

                    <div class="card mb-mob-4 icon_card info_card_bg">
                        <!-- Card body -->
                        <div class="card-body">
                            <p class="card-title mb-0 text-white">Total Enquiries</p>
                            <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                                <h2 class="mb-0 text-white heart">{{$total_enquiry}}</h2>
                                <div class="arrow_icon"><i class="ion-arrow-up-c text-info"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div onClick="JavaScript:selectTab(4),sec('tab4Content')" class="col-xl-4 col-md-6 col-lg-12 stretched_card">

                    <div class="card mb-mob-4 icon_card success_card_bg">
                        <!-- Card body -->
                        <div class="card-body">
                            <p class="card-title mb-0 text-white">Over all Completed Enquiries</p>
                            <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                                <h2 class="mb-0 text-white heart">{{$total_complete_enquiry}}</h2>
                                <div class="arrow_icon"><i class="ion-arrow-up-c text-success"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div onClick="JavaScript:selectTab(2),sec('tab2Content')" class="col-xl-4 col-md-6 col-lg-12 stretched_card">

                    <div class="card mb-mob-4 icon_card warning_card_bg">
                        <!-- Card body -->
                        <div class="card-body">
                            <p class="card-title mb-0 text-white">Over all Pending Enquiries</p>
                            <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                                <h2 class="mb-0 text-white heart">{{$total_pending_enquiry}}</h2>
                                <div class="arrow_icon"><i class="ion-arrow-down-c text-warning"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div onclick="window.location.href ='{{route('executive.master')}}'" class="col-xl-4 col-md-6 col-lg-12 stretched_card">


                    <div class="card mb-mob-4 icon_card info_card_bg">
                        <!-- Card body -->
                        <div class="card-body">
                            <p class="card-title mb-0 text-white">Total Services Executives</p>
                            <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                                <h2 class="mb-0 text-white heart">{{$total_executives}}</h2>
                                <div class="arrow_icon"><i class="ion-arrow-up-c text-info"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div onclick="window.location.href ='{{route('service.master')}}'" class="col-xl-4 col-md-6 col-lg-12 stretched_card">

                    <div class="card mb-mob-4 icon_card info_card_bg">
                        <!-- Card body -->
                        <div class="card-body">
                            <p class="card-title mb-0 text-white">Total Services Centers</p>
                            <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                                <h2 class="mb-0 text-white heart">{{$service_center}}</h2>
                                <div class="arrow_icon"><i class="ion-arrow-up-c text-info"></i></div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>


            <div class="row">
                <div class="card-body">
                    <h4 class="card_title">Search Details</h4>
                    <div class="form-row align-items-center">
                        <div class="col-sm-6 my-6">
                            <label class="sr-only" for="inlineFormInputName">Name</label>
                            <input type="text" class="form-control" id="search" placeholder="Search Serial No / Call ID / Customer Name / Mobile No / Alternative Mobile No  ...">
                        </div>


                        <div class="col-auto my-1">
                            <button onclick="sea()" class="btn btn-primary">Search</button>
                        </div>
                    </div>


                </div>
            </div>

            <div style="display:none" class="row search" style="padding-bottom:50px">

            </div>




            <div class="row">
                <div class="card-body">
                    <form method="post" action="{{route('enquiry.dashboard')}}">
                        @csrf

                        <div class="form-row align-items-center">
                            <div class="col-sm-3 my-3">
                                <label for="inlineFormInputName">Filter</label>
                                <select required="" onchange="filter_data(this.value)" name="filter" class="form-control">
                                    <option value="">Select</option>
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
                                <label onClick="JavaScript:selectTab(1);" class="dtslable">Today Call Details</label>
                                <label onClick="JavaScript:selectTab(2);">Over all Pending Calls</label>
                                <label onClick="JavaScript:selectTab(3);">Close Request Calls</label>
                                <label onClick="JavaScript:selectTab(5);">Part Return Calls</label>
                                <label onClick="JavaScript:selectTab(4);">Over all Completed Calls</label>
                            </div>

                            <div class="table-responsive datatable-primary">
                                <table class="table myTable" id="dataTable" class="text-center boh">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Call ID</th>
                                            <th>Description</th>
                                            <th>Service Type </th>
                                            <th>Customer Name</th>
                                            <th>Customer Phone</th>
                                            <th>Executive</th>
                                            <th>Allocated Date</th>
                                            <th>End Date</th>
                                            <th>Closed Date</th>
                                            {{-- <th>TAT (Days)</th> --}}
                                            <th>Aging Time (Days)</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($today_enquiry as $val=>$key)


                                        @if ($key->executive_name!='')
                                        @php
                                        $executive=$key->executive_name.' ('.$key->executive_id.')';
                                        @endphp
                                        @else
                                        @php
                                        $executive='---';
                                        @endphp
                                        @endif

                                        @if ($key->end_date!='')
                                        @php
                                        $end_date=basicDateFormat($key->end_date);
                                        @endphp
                                        @else
                                        @php
                                        $end_date='---';
                                        @endphp
                                        @endif

                                        @if($key->closed_date!='')
                                        @php
                                        $closed_date=basicDateFormat($key->closed_date)
                                        @endphp
                                        @else
                                        @php
                                        $closed_date='00-00-0000'
                                        @endphp
                                        @endif

                                        @if($key->status!='Not allocated')
                                        @php
                                        $created_at=$key->created_at
                                        @endphp
                                        @else
                                        @php
                                        $created_at='0000-00-00'
                                        @endphp
                                        @endif



                                        @if($key->status=='Allocated' || $key->status=='Not allocated')
                                        @php $status='Pending';
                                        $color='#ffcf67';
                                        $alert='alert alert-warning';
                                        @endphp
                                        @elseif($key->status=='Completed')
                                        @php $status='Completed';
                                        $color='#2fe65e';
                                        $alert='alert alert-success';
                                        @endphp
                                        @elseif($key->status=='Cancelled')
                                        @php $status='Cancelled';
                                        $color='#2fe65e';
                                        $alert='alert alert-success';
                                        @endphp
                                        @else
                                        @php $status='Processed';
                                        $color='#7deafd';
                                        $alert='alert alert-info';
                                        @endphp

                                        @endif

                                        @if($key->status=='Completed' || $key->status=='Cancelled' || $key->status=='Transfered' || $key->status=='Completed part return pending' || $key->status=='Completed part return processed' || $key->status=='Completed part return success' || $key->status=='Closing request' || $key->status=='Cancel request' || $key->status=='Transfer request')
                                        @php
                                        $date1=date_create(date('Y-m-d',strtotime($key->created_at)));
                                        $date2=date_create(date('Y-m-d',strtotime($key->closed_date)));
                                        $diff=date_diff($date1,$date2);
                                        $aging_time=$diff->format("%a");
                                        @endphp

                                        @else
                                        @php
                                        $date1=date_create(date('Y-m-d',strtotime($key->created_at)));
                                        $date2=date_create(date('Y-m-d'));
                                        $diff=date_diff($date1,$date2);
                                        $aging_time=$diff->format("%a");
                                        @endphp
                                        @endif


                                        <tr style="background-color:{{$color}};">


                                            <th>{{$val+1}}</th>
                                            <th>{{$key->call_id}}</th>
                                            <th>{{$key->description}}</th>
                                            <th>{{$key->service_type}}</th>
                                            <th>{{$key->customer_name}}</th>
                                            <th>{{$key->customer_phone}}</th>
                                            <th>{{$executive}}</th>
                                            <th>{{$created_at}}</th>
                                            <th>{{$end_date}}</th>
                                            <th>{{$closed_date}}</th>
                                            {{-- <th>{{$tat}}</th> --}}
                                            <th>{{$aging_time}}</th>
                                            <th class="text-center">
                                                <div class="{{$alert}}" role="alert" style="padding-top: 1px; padding-bottom: 1px; margin-top: 5px;  margin-bottom: 5px;">
                                                    {{ $status }}
                                                </div>
                                            </th>
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
                                <label onClick="JavaScript:selectTab(1);">Today Call Details</label>
                                <label onClick="JavaScript:selectTab(2);" class="dtslable">Over all Pending Calls</label>
                                <label onClick="JavaScript:selectTab(3);">Close Request Calls</label>
                                <label onClick="JavaScript:selectTab(5);">Part Return Calls</label>
                                <label onClick="JavaScript:selectTab(4);">Over all Completed Calls</label>
                            </div>

                            <div class="table-responsive datatable-primary">
                                <table class="table myTable" id="dataTable1" class="text-center boh">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Call ID</th>
                                            <th>Product Name</th>
                                            <th>Service Type </th>
                                            <th>Customer Name</th>
                                            <th>Customer Phone</th>
                                            <th>Executive</th>
                                            <th>Allocated Date</th>
                                            <th>End Date</th>
                                            <th>Closed Date</th>
                                            {{-- <th>TAT (Days)</th> --}}
                                            <th>Aging Time (Days)</th>
                                            <th>Status</th>
                                        </tr>
                                        <input id="status" type="hidden" name="status" value="0">
                                    </thead>
                                    <tbody>
                                        @foreach ($pending_enquiry as $val=>$key)


                                        @if ($key->executive_name!='')
                                        @php
                                        $executive=$key->executive_name.' ('.$key->executive_id.')';
                                        @endphp
                                        @else
                                        @php
                                        $executive='---';
                                        @endphp
                                        @endif

                                        @if ($key->end_date!='')
                                        @php
                                        $end_date=basicDateFormat($key->end_date);
                                        @endphp
                                        @else
                                        @php
                                        $end_date='---';
                                        @endphp
                                        @endif

                                        @if($key->closed_date!='')
                                        @php
                                        $closed_date=basicDateFormat($key->closed_date)
                                        @endphp
                                        @else
                                        @php
                                        $closed_date='00-00-0000'
                                        @endphp
                                        @endif

                                        @if($key->status!='Not allocated')
                                        @php
                                        $created_at=$key->created_at
                                        @endphp
                                        @else
                                        @php
                                        $created_at='0000-00-00'
                                        @endphp
                                        @endif



                                        @if($key->status!='Allocated' && $key->status!='Not allocated')
                                        @php $status='Processed';
                                        $color='#7deafd';
                                        $alert='alert alert-info';
                                        @endphp
                                        @else
                                        @php $status='Pending';
                                        $color='#ffcf67';
                                        $alert='alert alert-warning';
                                        @endphp
                                        @endif

                                        @if($key->status=='Completed' || $key->status=='Cancelled' || $key->status=='Transfered' || $key->status=='Completed part return pending' || $key->status=='Completed part return processed' || $key->status=='Completed part return success' || $key->status=='Closing request' || $key->status=='Cancel request' || $key->status=='Transfer request')
                                        @php
                                        $date1=date_create(date('Y-m-d',strtotime($key->created_at)));
                                        $date2=date_create(date('Y-m-d',strtotime($key->closed_date)));
                                        $diff=date_diff($date1,$date2);
                                        $aging_time=$diff->format("%a");
                                        @endphp

                                        @else
                                        @php
                                        $date1=date_create(date('Y-m-d',strtotime($key->created_at)));
                                        $date2=date_create(date('Y-m-d'));
                                        $diff=date_diff($date1,$date2);
                                        $aging_time=$diff->format("%a");
                                        @endphp
                                        @endif


                                        <tr style="background-color:{{$color}};">


                                            <th>{{$val+1}}</th>
                                            <th>{{$key->call_id}}</th>
                                            <th>{{$key->description}}</th>
                                            <th>{{$key->service_type}}</th>
                                            <th>{{$key->customer_name}}</th>
                                            <th>{{$key->customer_phone}}</th>
                                            <th>{{$executive}}</th>
                                            <th>{{$created_at}}</th>
                                            <th>{{$end_date}}</th>
                                            <th>{{$closed_date}}</th>
                                            {{-- <th>{{$tat}}</th> --}}
                                            <th>{{$aging_time}}</th>
                                            <th class="text-center">
                                                <div class="{{$alert}}" role="alert" style="padding-top: 1px; padding-bottom: 1px; margin-top: 5px;  margin-bottom: 5px;">
                                                    {{ $status }}
                                                </div>
                                            </th>
                                        </tr>
                                        @endforeach


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div id="tab3Content" class="row">
                <div class="col-xl-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div class="dts">
                                <label onClick="JavaScript:selectTab(1);">Today Call Details</label>
                                <label onClick="JavaScript:selectTab(2);">Over all Pending Calls</label>
                                <label onClick="JavaScript:selectTab(3);" class="dtslable">Close Request Calls</label>
                                <label onClick="JavaScript:selectTab(5);">Part Return Calls</label>
                                <label onClick="JavaScript:selectTab(4);">Over all Completed Calls</label>
                            </div>

                            <div class="table-responsive datatable-primary">
                                <table class="table myTable" id="dataTable2" class="text-center boh">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Call ID</th>
                                            <th>Product Name</th>
                                            <th>Service Type </th>
                                            <th>Customer Name</th>
                                            <th>Customer Phone</th>
                                            <th>Executive</th>
                                            <th>Allocated Date</th>
                                            <th>End Date</th>
                                            <th>Closed Date</th>
                                            {{-- <th>TAT (Days)</th> --}}
                                            <th>Aging Time (Days)</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($closing_enquiry as $val=>$key)


                                        @if ($key->executive_name!='')
                                        @php
                                        $executive=$key->executive_name.' ('.$key->executive_id.')';
                                        @endphp
                                        @else
                                        @php
                                        $executive='---';
                                        @endphp
                                        @endif

                                        @if ($key->end_date!='')
                                        @php
                                        $end_date=basicDateFormat($key->end_date);
                                        @endphp
                                        @else
                                        @php
                                        $end_date='---';
                                        @endphp
                                        @endif

                                        @if($key->closed_date!='')
                                        @php
                                        $closed_date=basicDateFormat($key->closed_date)
                                        @endphp
                                        @else
                                        @php
                                        $closed_date='00-00-0000'
                                        @endphp
                                        @endif


                                        @if($key->status=='Completed' || $key->status=='Cancelled' || $key->status=='Transfered' || $key->status=='Completed part return pending' || $key->status=='Completed part return processed' || $key->status=='Completed part return success' || $key->status=='Closing request' || $key->status=='Cancel request' || $key->status=='Transfer request')
                                        @php
                                        $date1=date_create(date('Y-m-d',strtotime($key->created_at)));
                                        $date2=date_create(date('Y-m-d',strtotime($key->closed_date)));
                                        $diff=date_diff($date1,$date2);
                                        $aging_time=$diff->format("%a");
                                        @endphp

                                        @else
                                        @php
                                        $date1=date_create(date('Y-m-d',strtotime($key->created_at)));
                                        $date2=date_create(date('Y-m-d'));
                                        $diff=date_diff($date1,$date2);
                                        $aging_time=$diff->format("%a");
                                        @endphp
                                        @endif




                                        <tr style="background-color:#cd6fd059;">


                                            <th>{{$val+1}}</th>
                                            <th>{{$key->call_id}}</th>
                                            <th>{{$key->description}}</th>
                                            <th>{{$key->service_type}}</th>
                                            <th>{{$key->customer_name}}</th>
                                            <th>{{$key->customer_phone}}</th>
                                            <th>{{$executive}}</th>
                                            <th>{{date('Y-m-d',strtotime($key->created_at))}}</th>
                                            <th>{{$end_date}}</th>
                                            <th>{{$closed_date}}</th>
                                            {{-- <th>{{$tat}}</th> --}}
                                            <th>{{$aging_time}}</th>
                                            <th class="text-center">
                                                <div class="alert alert-info" role="alert" style="padding-top: 1px; padding-bottom: 1px; margin-top: 5px;  margin-bottom: 5px;">
                                                    <a target="_blank" href="{{route('enquiry.admin',$key->id)}}"> <i class="btn-sm btn-info mdi mdi-check-all"></i></a>
                                                </div>
                                            </th>
                                        </tr>
                                        @endforeach


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="tab4Content" class="row">
                <div class="col-xl-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div class="dts">
                                <label onClick="JavaScript:selectTab(1);">Today Call Details</label>
                                <label onClick="JavaScript:selectTab(2);">Over all Pending Calls</label>
                                <label onClick="JavaScript:selectTab(3);">Close Request Calls</label>
                                <label onClick="JavaScript:selectTab(5);">Part Return Calls</label>
                                <label onClick="JavaScript:selectTab(4);" class="dtslable">Over all Completed Calls</label>
                            </div>

                            <div class="table-responsive datatable-primary">
                                <table class="table myTable" id="dataTable4" class="text-center boh">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Call ID</th>
                                            <th>Product Name</th>
                                            <th>Service Type </th>
                                            <th>Customer Name</th>
                                            <th>Customer Phone</th>
                                            <th>Executive</th>
                                            <th>Allocted Date</th>
                                            <th>End Date</th>
                                            <th>Closed Date</th>
                                            {{-- <th>TAT (Days)</th> --}}
                                            <th>Aging Time (Days)</th>

                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($complete_enquiry as $val=>$key)


                                        @if ($key->executive_name!='')
                                        @php
                                        $executive=$key->executive_name.' ('.$key->executive_id.')';
                                        @endphp
                                        @else
                                        @php
                                        $executive='---';
                                        @endphp
                                        @endif

                                        @if ($key->end_date!='')
                                        @php
                                        $end_date=basicDateFormat($key->end_date);
                                        @endphp
                                        @else
                                        @php
                                        $end_date='---';
                                        @endphp
                                        @endif

                                        @if($key->closed_date!='')
                                        @php
                                        $closed_date=basicDateFormat($key->closed_date)
                                        @endphp
                                        @else
                                        @php
                                        $closed_date='00-00-0000'
                                        @endphp
                                        @endif



                                        @if($key->status=='Completed' || $key->status=='Cancelled' || $key->status=='Transfered' || $key->status=='Completed part return pending' || $key->status=='Completed part return processed' || $key->status=='Completed part return success' || $key->status=='Closing request' || $key->status=='Cancel request' || $key->status=='Transfer request')
                                        @php
                                        $date1=date_create(date('Y-m-d',strtotime($key->created_at)));
                                        $date2=date_create(date('Y-m-d',strtotime($key->closed_date)));
                                        $diff=date_diff($date1,$date2);
                                        $aging_time=$diff->format("%a");
                                        @endphp

                                        @else
                                        @php
                                        $date1=date_create(date('Y-m-d',strtotime($key->created_at)));
                                        $date2=date_create(date('Y-m-d'));
                                        $diff=date_diff($date1,$date2);
                                        $aging_time=$diff->format("%a");
                                        @endphp
                                        @endif




                                        <tr style="background-color:#2fe65e;">


                                            <th>{{$val+1}}</th>
                                            <th>{{$key->call_id}}</th>
                                            <th>{{$key->description}}</th>
                                            <th>{{$key->service_type}}</th>
                                            <th>{{$key->customer_name}}</th>
                                            <th>{{$key->customer_phone}}</th>
                                            <th>{{$executive}}</th>
                                            <th>{{basicDateFormat($key->created_at)}}</th>
                                            <th>{{$end_date}}</th>
                                            <th>{{$closed_date}}</th>
                                            {{-- <th>{{$tat}}</th> --}}
                                            <th>{{$aging_time}}</th>

                                            <th class="text-center">
                                                <div class="alert alert-success" role="alert" style="padding-top: 1px; padding-bottom: 1px; margin-top: 5px;  margin-bottom: 5px;">
                                                    {{ $key->status }}
                                                </div>
                                            </th>
                                        </tr>
                                        @endforeach


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div id="tab5Content" class="row">
                <div class="col-xl-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div class="dts">
                                <label onClick="JavaScript:selectTab(1);">Today Call Details</label>
                                <label onClick="JavaScript:selectTab(2);">Over all Pending Calls</label>
                                <label onClick="JavaScript:selectTab(3);">Close Request Calls</label>
                                <label onClick="JavaScript:selectTab(5);" class="dtslable">Part Return Calls</label>
                                <label onClick="JavaScript:selectTab(4);">Over all Completed Calls</label>
                            </div>

                            <div class="table-responsive datatable-primary">
                                <table class="table myTable" id="dataTable5" class="text-center boh">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Call ID</th>
                                            <th>Product Name</th>
                                            <th>Service Type </th>
                                            <th>Customer Name</th>
                                            <th>Customer Phone</th>
                                            <th>Executive</th>
                                            <th>Allocated Date</th>
                                            <th>End Date</th>
                                            <th>Closed Date</th>
                                            {{-- <th>TAT (Days)</th> --}}
                                            <th>Aging Time (Days)</th>

                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($part_data as $val=>$key)


                                        @if ($key->executive_name!='')
                                        @php
                                        $executive=$key->executive_name.' ('.$key->executive_id.')';
                                        @endphp
                                        @else
                                        @php
                                        $executive='---';
                                        @endphp
                                        @endif

                                        @if ($key->end_date!='')
                                        @php
                                        $end_date=basicDateFormat($key->end_date);
                                        @endphp
                                        @else
                                        @php
                                        $end_date='---';
                                        @endphp
                                        @endif
                                        @if($key->closed_date!='')
                                        @php
                                        $closed_date=basicDateFormat($key->closed_date)
                                        @endphp
                                        @else
                                        @php
                                        $closed_date='00-00-0000'
                                        @endphp
                                        @endif



                                        @if($key->status=='Completed' || $key->status=='Cancelled' || $key->status=='Transfered' || $key->status=='Completed part return pending' || $key->status=='Completed part return processed' || $key->status=='Completed part return success' || $key->status=='Closing request' || $key->status=='Cancel request' || $key->status=='Transfer request')
                                        @php
                                        $date1=date_create(date('Y-m-d',strtotime($key->created_at)));
                                        $date2=date_create(date('Y-m-d',strtotime($key->closed_date)));
                                        $diff=date_diff($date1,$date2);
                                        $aging_time=$diff->format("%a");
                                        @endphp

                                        @else
                                        @php
                                        $date1=date_create(date('Y-m-d',strtotime($key->created_at)));
                                        $date2=date_create(date('Y-m-d'));
                                        $diff=date_diff($date1,$date2);
                                        $aging_time=$diff->format("%a");
                                        @endphp
                                        @endif




                                        <tr style="background-color:#cd6fd059;">


                                            <th>{{$val+1}}</th>
                                            <th>{{$key->call_id}}</th>
                                            <th>{{$key->description}}</th>
                                            <th>{{$key->service_type}}</th>
                                            <th>{{$key->customer_name}}</th>
                                            <th>{{$key->customer_phone}}</th>
                                            <th>{{$executive}}</th>
                                            <th>{{basicDateFormat($key->created_at)}}</th>
                                            <th>{{$end_date}}</th>
                                            <th>{{$closed_date}}</th>
                                            {{-- <th>{{$tat}}</th> --}}
                                            <th>{{$aging_time}}</th>

                                            <th class="text-center">
                                                <div class="alert alert-warning" role="alert" style="padding-top: 1px; padding-bottom: 1px; margin-top: 5px;  margin-bottom: 5px;">
                                                    {{ $key->status }}
                                                </div>
                                            </th>
                                        </tr>
                                        @endforeach


                                    </tbody>
                                </table>
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
            document.getElementById('tab3Content').style.display = "none";
            document.getElementById('tab4Content').style.display = "none";
            document.getElementById('tab5Content').style.display = "none";





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
        function sec(id) {
            window.location.href = '#' + id;

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


    @include('logics.include.datatable')

    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                dom: 'Bfrtip'
                , buttons: [{
                        extend: 'copy'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                        }
                    }
                    , {
                        extend: 'csv'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                        }
                    }
                    , {
                        extend: 'excel'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                        }
                    }

                    , {
                        extend: 'print'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                        }
                    }


                ],

            });
        });

    </script>
    <script>
        $(document).ready(function() {
            $('#dataTable1').DataTable({
                dom: 'Bfrtip'
                , buttons: [{
                        extend: 'copy'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                        }
                    }
                    , {
                        extend: 'csv'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                        }
                    }
                    , {
                        extend: 'excel'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                        }
                    }

                    , {
                        extend: 'print'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                        }
                    }


                ],

            });
        });

    </script>
    <script>
        $(document).ready(function() {
            $('#dataTable2').DataTable({
                dom: 'Bfrtip'
                , buttons: [{
                        extend: 'copy'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                        }
                    }
                    , {
                        extend: 'csv'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                        }
                    }
                    , {
                        extend: 'excel'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                        }
                    }

                    , {
                        extend: 'print'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                        }
                    }


                ],

            });
        });

    </script>
    <script>
        $(document).ready(function() {
            $('#dataTable4').DataTable({
                dom: 'Bfrtip'
                , buttons: [{
                        extend: 'copy'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                        }
                    }
                    , {
                        extend: 'csv'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                        }
                    }
                    , {
                        extend: 'excel'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                        }
                    }

                    , {
                        extend: 'print'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                        }
                    }


                ],

            });
        });

    </script>
    <script>
        $(document).ready(function() {
            $('#dataTable5').DataTable({
                dom: 'Bfrtip'
                , buttons: [{
                        extend: 'copy'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                        }
                    }
                    , {
                        extend: 'csv'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                        }
                    }
                    , {
                        extend: 'excel'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                        }
                    }

                    , {
                        extend: 'print'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                        }
                    }


                ],

            });
        });

    </script>





















    <!--=========================*
                                            Scripts
                                            *===========================-->


</body>

</html>
