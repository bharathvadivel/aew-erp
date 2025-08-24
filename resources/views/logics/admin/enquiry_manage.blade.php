<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>

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

        .model_color {
            border: 3px solid #ff0000 !important;

        }


        @media only screen and (min-width: 576px) {

            .modal-dialog {
                max-width: 1000px !important;
                margin: 1.75rem auto;
            }
        }

        .col-3 {
            padding-bottom: 30px;
        }

        .col-2 {
            padding-bottom: 20px;
            border: 1px solid #000000;
            text-align: center;
            padding: 6px;
            white-space: normal;
        }

        .modal-open .modal {
            overflow: scroll;
            /* overflow-x: hidden; */
            /* overflow-y: auto; */
        }

        select[multiple] option:checked {
            background: #C0C0C0;
        }



        .d-sm-flex {
            width: 100% !important;
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

            <div class="row">
                <!-- Striped table start -->
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <form method="GET" action="{{route('enquiry.manage')}}">

                                <div class="form-row">

                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Search</label>

                                            <input type="text" value="{{$search}}" name="search" class="form-control" placeholder="Search Serial No / Call ID / Customer Name / Mobile No / Alternative Mobile No  ...">

                                        </div>
                                    </div>

                                    <div class="col-md-1 mb-1">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Filter</label>
                                            <input style="cursor: pointer;background-color:#585858;color:white" type="submit" value="Search" class="form-control">
                                        </div>
                                    </div>


                                </div>
                            </form>

                            <h4 class="header-title">Manage Service Enquiry
                                <a href="{{ route('add.enquiry') }}" class="btn btn-primary btns"> <i class="fa fa-plus-circle"></i> Add Service Enquiry</a>
                            </h4>
                            <br>
                            <div class="single-table">
                                <div class="table-responsive">
                                    <table class="table table-striped text-center">
                                        <thead class="text-uppercase">
                                            <tr>
                                                <th>S.NO </th>
                                                <th>Call ID</th>
                                                <th>Product Description</th>
                                                <th>Model No.</th>
                                                <th>Customer Name</th>
                                                <th>Service Type</th>
                                                <th>Service Canter Name</th>
                                                <th>Customer Phone</th>
                                                <th>Customer Pincode</th>
                                                <th>Store Name</th>
                                                <th>Allocated Date</th>
                                                <th style="white-space:nowrap">Service Executive</th>
                                                <th>End Date</th>
                                                <th>Assign</th>
                                                <th>Closed Date</th>
                                                <th>Aging Time (Days)</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>

                                        </thead>
                                        <tbody>
                                            @if(count($enquiry) > 0)
                                            @foreach ($enquiry as $key=>$vl)

                                            @if($vl->closed_date!='')
                                            @php
                                            $closed_date=basicDateFormat($vl->closed_date)
                                            @endphp
                                            @else
                                            @php
                                            $closed_date='00-00-0000'
                                            @endphp
                                            @endif


                                            @if($vl->status=='Allocated')
                                            @php $color="color:#ffbb44"; @endphp
                                            @elseif($vl->status=='Assigned')
                                            @php $color="color:#37b3c9"; @endphp
                                            @elseif($vl->status=='Closing request')
                                            @php $color="color:#67479e"; @endphp
                                            @elseif($vl->status=='Cancel request' || $vl->status=='Reappoinment')
                                            @php $color="color:#f24734"; @endphp
                                            @elseif($vl->status=='Transfer request')
                                            @php $color="color:#67479e"; @endphp
                                            @else
                                            @php $color="color:#2fe65e"; @endphp
                                            @endif

                                            @php

                                            $exe = DB::table('executives')->where('service_id',$vl->service_id)->get();

                                            $enq_list = DB::table('enquirylists')->where('call_id',$vl->call_id)->orderBy('id','desc')->first();

                                            $enq_list_ch=DB::table('enquirylists')->where('call_id',$vl->call_id)->where('status','Reappointment')->orderBy('id','desc')->first();

                                            @endphp

                                            @if($enq_list)

                                            @if($enq_list_ch)

                                            @php
                                            $executive_id=$enq_list_ch->executive_id;
                                            $end_date=$enq_list_ch->end_date;
                                            @endphp

                                            @else

                                            @php
                                            $executive_id=$enq_list->executive_id;
                                            $end_date=$enq_list->end_date;
                                            @endphp

                                            @endif

                                            @else

                                            @php
                                            $executive_id='';
                                            $end_date='';
                                            @endphp

                                            @endif


                                            @php
                                            // aging time (aging time is difference between call closed date to created date )
                                            $date1=date_create(date('Y-m-d', strtotime($vl->created_at)));
                                            @endphp
                                            @if ($vl->closed_date!='')
                                            @php
                                            $date2=date_create(date('Y-m-d', strtotime($vl->closed_date)));
                                            $closed_date=basicDateFormat($vl->closed_date);
                                            @endphp
                                            @else
                                            @php
                                            $date2=date_create(date('Y-m-d'));
                                            $closed_date='00-00-0000';
                                            @endphp
                                            @endif
                                            @php
                                            $diff=date_diff($date1, $date2);
                                            $aging_time=$diff->format("%a");
                                            @endphp




                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{$vl->call_id}}</td>
                                                <td>{{$vl->product ? $vl->product->description : ''}}</td>
                                                <td>{{$vl->model_no}}</td>
                                                <td>{{$vl->customer_name}}</td>
                                                <td>{{$vl->service_type}}</td>
                                                <td>{{$vl->service_center ? $vl->service_center->service_center_name : ''}}</td>
                                                <td>{{$vl->customer_phone}}</td>
                                                <td>{{$vl->customer_pincode}}</td>
                                                <td>{{$vl->store_name}}</td>
                                                <td>{{basicDateFormat($vl->created_at)}}</td>

                                                <td>
                                                    <select id="executive_id{{$vl->id}}" required="" name="executive_id" class="form-control">
                                                        <option value="">Select</option>

                                                        @foreach ($exe as $key)
                                                        <option {{$key->executive_id==$executive_id ? 'selected':''}} value="{{$key->executive_id}}">{{ $key->name }} ({{$key->executive_id}})</option>
                                                        @endforeach

                                                    </select>
                                                </td>


                                                <td><input id="end_date{{$vl->id}}" required="" value="{{$end_date}}" name="end_date" type="date" class="form-control"></td>
                                                <input id="call_id{{$vl->id}}" name="call_id" value="{{$vl->call_id}}" type="hidden" class="form-control">
                                                <input id="service_type{{$vl->id}}" name="service_type" value="{{$vl->service_type}}" type="hidden" class="form-control">
                                                <input id="service_id{{$vl->id}}" name="service_id" type="hidden" value="{{$vl->service_id}}" class="form-control">
                                                <input id="service_center_name{{$vl->id}}" name="service_center_name" type="hidden" value="{{$vl->service_center_name}}" class="form-control">
                                                <input id="model_no{{$vl->id}}" name="model_no" type="hidden" value="{{$vl->model_no}}" class="form-control">
                                                <input id="invoice_no{{$vl->id}}" name="invoice_no" type="hidden" value="{{$vl->invoice_no}}" class="form-control">
                                                <input id="date_of_purchase{{$vl->id}}" name="date_of_purchase" type="hidden" value="{{$vl->date_of_purchase}}" class="form-control">
                                                <input id="customer_name{{$vl->id}}" name="customer_name" type="hidden" value="{{$vl->customer_name}}" class="form-control">
                                                <input id="serial_no{{$vl->id}}" name="serial_no" type="hidden" value="{{$vl->serial_no}}" class="form-control">
                                                <input id="partner_id{{$vl->id}}" name="partner_id" type="hidden" value="{{$vl->partner_id}}" class="form-control">
                                                <input id="partner_name{{$vl->id}}" name="partner_name" type="hidden" value="{{$vl->partner_name}}" class="form-control">
                                                <input id="enquiry_id{{$vl->id}}" name="enquiry_id" type="hidden" value="{{$vl->id}}" class="form-control">


                                                @if ($vl->status=='Assigned' || $vl->status=='Allocated' || $vl->status=='Transfer request')

                                                <td><button onclick="sent_otp({{$vl->customer_phone}},{{$vl->id}})" class="btn btn-success">Assign</button></td>
                                                @else
                                                <td><button disabled type="submit" class="btn btn-danger">Assign</button></td>

                                                @endif
                                                </form>
                                                <td>{{$closed_date}}</td>
                                                {{-- <td>{{$tat}}</td> --}}
                                                <td>{{$aging_time}}</td>
                                                <td style="@php echo $color @endphp">
                                                    <p class="status_color">{{$vl->status}}</p>
                                                </td>
                                                <td>
                                                    <button><i data-placement="top" title="View" class="fa fa-eye" data-toggle="modal" data-target="#exampleModalLong{{$vl->id}}" style="color:#1e7e34"></i></button>
                                                    @if($vl->status=='Completed part return pending' || $vl->status=='Completed part return processed')
                                                    <button><i data-placement="top" title="Part return" class="fa fa-refresh" data-bs-toggle="modal" data-bs-target="#partreturn{{$vl->id}}" style="color:#1e7e34"></i></button>
                                                    <a target="_blank" href="{{route('enquiry.dc',$vl->id)}}"><button><i data-placement="top" title="DC"  class="fa fa-file" style="color:#1e7e34"></i></button></a>


                                                    @endif
                                                    @if($vl->status=='Completed' || $vl->status=='Part pending' || $vl->status=='Cancelled' || $vl->status=='Completed part return pending' || $vl->status=='Completed part return processed' || $vl->status=='Completed part return success')
                                                    <a target="_blank" href="{{route('enquiry.rma',$vl->id)}}"><button><i data-placement="top" title="RMA Report" class="fa fa-bar-chart" style="color:#1e7e34"></i></button></a>

                                                    @endif

                                                    @if($vl->status=='Assigned' or $vl->status=='Reappoinment' or $vl->status=='Allocated' or $vl->status=='Part pending')

                                                    <button><i data-placement="top" title="Transfer" class="fa fa-exchange" data-bs-toggle="modal" data-bs-target="#exampleModal{{$vl->id}}" style="color:#f24734"></i></button>
                                                    @endif
                                                    @if($vl->status=='Assigned' or $vl->status=='Reappoinment' or $vl->status=='Allocated' or $vl->status=='Part pending')
                                                    <a href="{{route('enquiry.admin',$vl->id)}}"><i data-placement="top" title="Status Update" class="fa fa-check" style="color:#37b3c9"></i></a>
                                                    @endif
                                                </td>
                                            </tr>


                                            <div class="modal fade" id="exampleModal{{$vl->id}}" data-toggle="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content model_color">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Transfer request</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="post" action="{{route('enquiry.transfer.request',$vl->id)}}">
                                                                @csrf
                                                                <div class="mb-3">
                                                                    <label for="recipient-name" class="col-form-label">Call ID:</label>
                                                                    <input type="text" readonly name="call_id" value="{{$vl->call_id}}" class="form-control" id="recipient-name">
                                                                </div>


                                                                <div class="mb-3">
                                                                    <label for="message-text" class="col-form-label">Reason:</label>
                                                                    <textarea class="form-control" required="" name="remarks" id="message-text"></textarea>
                                                                </div>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Submit</button>
                                                        </div>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>



                                            <div class="modal fade" id="partreturn{{ $vl->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Part return</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="post" action="{{route('enquiry.part.processed',$vl->id)}}">
                                                                @csrf
                                                                <div class="mb-3">
                                                                    <label for="recipient-name" class="col-form-label">Call ID:</label>
                                                                    <input type="text" readonly name="call_id" value="{{$vl->call_id}}" class="form-control" id="recipient-name">
                                                                </div>


                                                                <div class="mb-3">
                                                                    <label for="message-text" class="col-form-label">Remarks:</label>
                                                                    <textarea class="form-control" required="" name="remarks" id="message-text"></textarea>
                                                                </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Submit</button>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>



                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModalLong{{$vl->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-xl" role="document">
                                                    <div class="modal-content model_color">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">View Service Enquiry Details</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-8 ms-auto">
                                                                    <h5 style="color: #9908bd;padding-bottom:30px">Product details</h5>
                                                                </div>
                                                            </div>
                                                            <div class="row">

                                                                <div class="col-3">Call ID: </div>
                                                                <div class="col-3">{{$vl->call_id}}</div>
                                                                <div class="col-3">Serial No:</div>
                                                                <div class="col-3">{{$vl->serial_no}}</div>
                                                                <div class="col-3">Model No: </div>
                                                                <div class="col-3">{{$vl->model_no}}</div>
                                                                <div class="col-3">Description:</div>
                                                                <div class="col-3">{{$vl->description}}</div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-8 ms-auto">
                                                                    <h5 style="color: #9908bd;padding-bottom:30px">Customer details</h5>
                                                                </div>
                                                            </div>
                                                            <div class="row">

                                                                <div class="col-3">Customer Name: </div>
                                                                <div class="col-3">{{$vl->customer_name}}</div>
                                                                <div class="col-3">Customer Mobile No:</div>
                                                                <div class="col-3">{{$vl->customer_phone}}</div>

                                                                <div class="col-3">Customer City: </div>
                                                                <div class="col-3">{{$vl->customer_city}}</div>
                                                                <div class="col-3">Customer Area: </div>
                                                                <div class="col-3">{{$vl->customer_area}}</div>

                                                                <div class="col-3">Customer District: </div>
                                                                <div class="col-3">{{$vl->customer_district}}</div>
                                                                <div class="col-3">Customer State: </div>
                                                                <div class="col-3">{{$vl->customer_state}}</div>


                                                                <div class="col-3">Customer Pincode:</div>
                                                                <div class="col-3">{{$vl->customer_pincode}}</div>
                                                                <div class="col-3"></div>
                                                                <div class="col-3"></div>



                                                                <div class="col-3">Customer Address: </div>
                                                                <div class="col-9">{{$vl->customer_address}}</div>

                                                                <div class="col-3">Customer Remarks: </div>
                                                                <div class="col-9">{{$vl->customer_remarks}}</div>

                                                            </div>

                                                            <div class="row">
                                                                <div class="col-8 ms-auto">
                                                                    <h5 style="color: #9908bd;padding-bottom:30px">Sales details</h5>
                                                                </div>
                                                            </div>
                                                            <div class="row">

                                                                <div class="col-3">Dealer Name: </div>
                                                                <div class="col-3">{{$vl->partner_name}}</div>
                                                                <div class="col-3"> Dealer Mobile No:</div>
                                                                <div class="col-3">{{$vl->partner_phone}}</div>

                                                                <div class="col-3">Date Of Purchase:</div>
                                                                <div class="col-3">{{basicDateFormat($vl->date_of_purchase)}}</div>
                                                                <div class="col-3">Service Type:</div>
                                                                <div class="col-3">{{$vl->service_type}}</div>

                                                                <div class="col-3">Warranty Type: </div>
                                                                <div class="col-3">{{$vl->warranty_type}}</div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-8 ms-auto">
                                                                    <h5 style="color: #9908bd;padding-bottom:30px">Enquiry status</h5>
                                                                </div>
                                                            </div>
                                                            <div class="row">

                                                                <div class="col-3">Service center Name: </div>
                                                                <div class="col-3">{{$vl->service_center_name}}</div>
                                                                @php
                                                                $enq_last=DB::table('enquirylists')->where('service_id',$vl->service_id)->where('call_id',$vl->call_id)->first();
                                                                @endphp
                                                                @if ($enq_last)

                                                                <div class="col-3"> Handle by:</div>
                                                                <div class="col-3">{{$vl->executive_name}}</div>
                                                                <div class="col-3">Allocated Date:</div>
                                                                <div class="col-3">{{basicDateFormat($enq_last->created_at)}}</div>
                                                                <div class="col-3">End Date:</div>
                                                                <div class="col-3">{{basicDateFormat($enq_last->created_at)}}</div>
                                                                @else
                                                                <div class="col-3"> Handle by:</div>
                                                                <div class="col-3">---</div>
                                                                <div class="col-3">Allocated Date:</div>
                                                                <div class="col-3">---</div>
                                                                <div class="col-3">End Date:</div>
                                                                <div class="col-3">---</div>
                                                                @endif


                                                            </div>

                                                            <div class="row">
                                                                <div class="col-8 ms-auto">
                                                                    <h5 style="color: #9908bd;padding-bottom:30px">Progress details</h5>
                                                                </div>
                                                            </div>
                                                            <div class="row" style="border:3px solid #000000;margin:20px">

                                                                @php
                                                                $enq=DB::table('enquirylists')->where('service_id',$vl->service_id)->where('call_id',$vl->call_id)->get();
                                                                @endphp
                                                                @if($enq->isNotEmpty())


                                                                <div class="col-2"> S.No</div>
                                                                <div class="col-2">Date</div>
                                                                <div class="col-2">Remarks</div>
                                                                <div class="col-2">Service Branch</div>
                                                                <div class="col-2">Handle By</div>
                                                                <div class="col-2">Status</div>

                                                                @foreach ($enq as $xy=>$dt)

                                                                @if($dt->status=='Completed' || $dt->status=='Cancelled' || $dt->status=='Transfered' || $dt->status=='Completed part return success')
                                                                @php
                                                                $color='#2fe65e';
                                                                @endphp
                                                                @else
                                                                @php
                                                                $color='#ff0000';
                                                                @endphp
                                                                @endif

                                                                <div class="col-2">{{$xy+1}}</div>
                                                                <div class="col-2">{{railwayDateTimeFormat($dt->created_at)}}</div>
                                                                <div class="col-2">{{$dt->remarks}}</div>
                                                                <div class="col-2">{{$dt->service_center_name}}</div>
                                                                <div class="col-2">{{$dt->executive_name}}</div>
                                                                <div class="col-2">
                                                                    <p style="white-space:normal;color:#ffffff;background-color:{{ $color }}">{{$dt->status}}</p>
                                                                </div>

                                                                @endforeach


                                                                @else

                                                                <div class="col-2">S.No</div>
                                                                <div class="col-2">Date</div>
                                                                <div class="col-2">Remarks</div>
                                                                <div class="col-2">Service Branch</div>
                                                                <div class="col-2">Handle By</div>
                                                                <div class="col-2">Status</div>

                                                                <div class="col-2">1</div>
                                                                <div class="col-2">{{railwayDateTimeFormat($vl->created_at)}}</div>

                                                                <div class="col-2"></div>
                                                                <div class="col-2">{{$vl->service_center_name}}</div>
                                                                <div class="col-2">---</div>
                                                                <div class="col-2">
                                                                    <p style="white-space:normal;color:#ffffff;background-color:#ff0000">{{$vl->status}}</p>
                                                                </div>

                                                                @endif


                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="modal fade" id="otp{{$vl->id}}" tabindex="-1" aria-labelledby="otp" aria-hidden="true">
                                                <div class="modal-dialog" style="max-width: 500px !important;">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">OTP verification</h5>
                                                            <button type="button" onclick="refresh_page()" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form>
                                                                <div class="mb-3">
                                                                    <label style="display:flex;justify-content: space-around;" for="recipient-name" class="col-form-label">OTP we just send to <p style="color:red;display: contents;">{{ $vl->customer_phone }}</p></label>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                    </div>


                                                                    <div class="col-md-4">
                                                                        <label style="display:flex;justify-content: space-around;" for="recipient-name" class="col-form-label">Enter OTP</label>
                                                                        <input type="text" id="otp_number{{$vl->id}}" style="border: 2px solid #ff0000;" class="form-control" id="recipient-name" minlength="4" maxlength="4" onkeypress="return isNumberKey(event)">
                                                                    </div>
                                                                    <div class="col-md-4">

                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label style="display:flex;justify-content: space-around;color:red;white-space:nowrap" for="recipient-name" id="countdowntimer{{$vl->id}}" class="col-form-label">10 minutes remaining</label>
                                                                        <u>
                                                                            <p onclick="resent_otp({{$vl->customer_phone}},{{$vl->id}})" style="display:none;margin: 12px;cursor:pointer;color:#37b3c9" id="resent{{$vl->id}}">Resent OTP</p>
                                                                        </u>
                                                                    </div>
                                                                    <div class="col-md-4">

                                                                    </div>
                                                                </div>

                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" onclick="refresh_page()" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button id="timesubmit" type="button" onclick="otp_verify({{$vl->customer_phone}},{{$vl->id}})" class="btn btn-success">Verify</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                            @else
                                            <tr>
                                                <td colspan="16">No result found</td>
                                            </tr>
                                            @endif


                                        </tbody>
                                    </table>
                                    {{$enquiry->appends(request()->except('page'))->links('pagination::bootstrap-5')}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Striped table end -->
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
                                    Scripts
                                    *===========================-->

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function refresh_page() {
            location.reload();
        }

    </script>
    <script>
        function sent_otp(phone, id) {

            var executive_id_data = 'executive_id' + id;
            var executive_id = document.getElementById(executive_id_data).value;

            var end_date_data = 'end_date' + id;
            var end_date = document.getElementById(end_date_data).value;

            if (executive_id == '' || end_date == '') {
                Swal.fire({
                    icon: 'error'
                    , title: 'Oops...'
                    , text: 'Please Choose Executive and End date!'
                })
                return false;
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var phone = phone;
            var template = 'assign';

            // event.preventDefault();
            $.ajax({
                type: 'POST'
                , url: "{{ route('sent.otp')}}"
                , data: {
                    phone: phone
                    , template: template

                }
                , success: function(val) {

                    if (val.status == true) {
                        $('#otp' + id).modal('show');
                        var counttimer = 'countdowntimer' + id;
                        var resent = 'resent' + id;

                        var timeLeft = 600;
                        var elem = document.getElementById(counttimer);
                        var timerId = setInterval(function() {
                            if (timeLeft == -1) {
                                clearTimeout(timerId);
                                document.getElementById(resent).style.display = 'block';
                                document.getElementById(counttimer).style.display = 'none';
                                document.getElementById('timesubmit').style.display = 'none';
                            } else {
                                var mNew = Math.floor(timeLeft / 60);
                                var sNew = timeLeft % 60;

                                mNew = mNew < 10 ? '0' + mNew : mNew;
                                sNew = sNew < 10 ? '0' + sNew : sNew;

                                elem.innerHTML = mNew + ':' + sNew + ' minutes remaining';
                                timeLeft--;
                            }
                        }, 1000);
                    } else {
                        Swal.fire({
                            icon: 'error'
                            , title: 'Oops...'
                            , text: 'Sent OTP failed try again'
                        })
                        return false;
                    }
                }
            });


        }

    </script>

    <script>
        function otp_verify(phone, id) {

            var otp_number_data = 'otp_number' + id;
            var otp = document.getElementById(otp_number_data).value;

            if (otp == '') {
                Swal.fire({
                    icon: 'error'
                    , title: 'Oops...'
                    , text: 'Please enter OTP'
                })
                return false;
            }

            var executive_id_data = 'executive_id' + id;
            var executive_id = document.getElementById(executive_id_data).value;

            var end_date_data = 'end_date' + id;
            var end_date = document.getElementById(end_date_data).value;

            var call_id_data = 'call_id' + id;
            var call_id = document.getElementById(call_id_data).value;

            var service_type_data = 'service_type' + id;
            var service_type = document.getElementById(service_type_data).value;

            var service_id_data = 'service_id' + id;
            var service_id = document.getElementById(service_id_data).value;

            var service_center_name_data = 'service_center_name' + id;
            var service_center_name = document.getElementById(service_center_name_data).value;

            var model_no_data = 'model_no' + id;
            var model_no = document.getElementById(model_no_data).value;

            var invoice_no_data = 'invoice_no' + id;
            var invoice_no = document.getElementById(invoice_no_data).value;

            var date_of_purchase_data = 'date_of_purchase' + id;
            var date_of_purchase = document.getElementById(date_of_purchase_data).value;

            var customer_name_data = 'customer_name' + id;
            var customer_name = document.getElementById(customer_name_data).value;

            var serial_no_data = 'serial_no' + id;
            var serial_no = document.getElementById(serial_no_data).value;

            var partner_id_data = 'partner_id' + id;
            var partner_id = document.getElementById(partner_id_data).value;

            var partner_name_data = 'partner_name' + id;
            var partner_name = document.getElementById(partner_name_data).value;

            var enquiry_id_data = 'enquiry_id' + id;
            var enquiry_id = document.getElementById(enquiry_id_data).value;

            var phone = phone;


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // event.preventDefault();
            $.ajax({
                type: 'POST'
                , url: "{{ route('enquiry.assign')}}"
                , data: {
                    phone: phone
                    , id: id
                    , executive_id: executive_id
                    , end_date: end_date
                    , call_id: call_id
                    , service_type: service_type
                    , service_id: service_id
                    , service_center_name: service_center_name
                    , model_no: model_no
                    , invoice_no: invoice_no
                    , date_of_purchase: date_of_purchase
                    , customer_name: customer_name
                    , serial_no: serial_no
                    , partner_id: partner_id
                    , partner_name: partner_name
                    , enquiry_id: enquiry_id
                    , otp: otp
                , }
                , success: function(data) {
                    if (data == 'success') {
                        Swal.fire(
                            'Good job!'
                            , 'Executive assigned successfully!'
                            , 'success'
                        ).then(function() {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error'
                            , title: 'Oops...'
                            , confirmButtonColor: "#ff0000"
                            , text: 'Invalid OTP'
                        })
                        return false;
                    }
                }
            });


        }

    </script>

    <script>
        function resent_otp(phone, id) {



            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var phone = phone;

            // event.preventDefault();
            $.ajax({
                type: 'POST'
                , url: "{{ route('resent.otp')}}"
                , data: {
                    phone: phone
                }
                , success: function(val) {

                    if (val.status == true) {
                        Swal.fire(
                            'Good job!'
                            , 'OTP resent successfully!'
                            , 'success'
                        );
                        var counttimer = 'countdowntimer' + id;
                        var resent = 'resent' + id;
                        document.getElementById(resent).style.display = 'none';
                        document.getElementById(counttimer).style.display = 'block';
                        document.getElementById('timesubmit').style.display = 'block';


                        var timeLeft = 600;
                        var elem = document.getElementById(counttimer);
                        var timerId = setInterval(function() {
                            if (timeLeft == -1) {
                                clearTimeout(timerId);
                                document.getElementById(resent).style.display = 'block';
                                document.getElementById(counttimer).style.display = 'none';
                                document.getElementById('timesubmit').style.display = 'none';
                            } else {
                                var mNew = Math.floor(timeLeft / 60);
                                var sNew = timeLeft % 60;

                                mNew = mNew < 10 ? '0' + mNew : mNew;
                                sNew = sNew < 10 ? '0' + sNew : sNew;
                                elem.innerHTML = mNew + ':' + sNew + ' minutes remaining';

                                timeLeft--;
                            }
                        }, 1000);
                    } else {
                        Swal.fire({
                            icon: 'error'
                            , title: 'Oops...'
                            , text: 'Resent OTP failed try again'
                        })
                        return false;
                    }
                }
            });


        }

    </script>

</body>

</html>
