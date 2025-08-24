<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>

    <!--=========================*
                Met Data
    *===========================-->
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('logics.include.datatabledesign')

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

        .status_color {
            border: 3px solid #000000;
            padding: 5px;
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
            @include('login.flash')

            <div class="row">
                <!-- Primary table -->
                <div class="col-12 mt-4">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{route('enquiry.manage.admin',$service_id)}}">
                                @csrf
                                <div class="form-row">



                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Year<span style="color:red">&#9733;</span></label>
                                            <select required="" class="form-control" name="year">

                                                @for ($year = date('Y'); $year > date('Y') - 10; $year--)
                                                <option {{$year==$year_ch ? 'selected' : ''}} value="{{$year}}">
                                                    {{$year}}
                                                </option>
                                                @endfor

                                            </select>



                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Month<span style="color:red">&#9733;</span></label>
                                            <select required="" class="form-control" name="month" id="month">


                                                <option {{$month=='01' ? 'selected' : ''}} value="01">January</option>
                                                <option {{$month=='02' ? 'selected' : ''}} value="02">February</option>
                                                <option {{$month=='03' ? 'selected' : ''}} value="03">March</option>
                                                <option {{$month=='04' ? 'selected' : ''}} value="04">April</option>
                                                <option {{$month=='05' ? 'selected' : ''}} value="05">May</option>
                                                <option {{$month=='06' ? 'selected' : ''}} value="06">June</option>
                                                <option {{$month=='07' ? 'selected' : ''}} value="07">July</option>
                                                <option {{$month=='08' ? 'selected' : ''}} value="08">August</option>
                                                <option {{$month=='09' ? 'selected' : ''}} value="09">September</option>
                                                <option {{$month=='10' ? 'selected' : ''}} value="10">October</option>
                                                <option {{$month=='11' ? 'selected' : ''}} value="11">November</option>
                                                <option {{$month=='12' ? 'selected' : ''}} value="12">December</option>

                                            </select>


                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Status<span style="color:red">&#9733;</span></label>
                                            <select required="" class="form-control" name="status">
                                                <option {{$status=='All' ? 'selected' : ''}} value="All">All</option>
                                                <option {{$status=='Pending' ? 'selected' : ''}} value="Pending">Pending</option>
                                                <option {{$status=='Allocated' ? 'selected' : ''}} value="Allocated">Allocated</option>
                                                <option {{$status=='Completed' ? 'selected' : ''}} value="Completed">All Completed List</option>
                                            </select>


                                        </div>
                                    </div>



                                    <div class="col-md-1 mb-1">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Filter<span style="color:red">&#9733;</span></label>
                                            <input style="cursor: pointer;background-color:#585858;color:white" type="submit" value="Search" class="form-control">




                                        </div>
                                    </div>


                                </div>
                            </form>

                            <h4 class="header-title">Manage Service Enquiry
                                <a href="{{ route('add.enquiry') }}" class="btn btn-primary btns"> <i class="fa fa-plus-circle"></i> Add Service Enquiry</a>
                            </h4>
                            <br>


                            <div class="table-responsive datatable-primary">
                                <table id="dataTable" class="text-center boh">
                                    <thead class="text-capitalize">
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
                                            <th>Finished Date</th>
                                            <th>Assign</th>
                                            <th>TAT (Days)</th>
                                            <th>Aging Time (Days)</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
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
                                        @elseif($vl->status=='Cancel request')
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


                                        @if($vl->status=='Completed' || $vl->status=='Cancelled' || $vl->status=='Transfered' || $vl->status=='Completed part return pending' || $vl->status=='Completed part return processed' || $vl->status=='Completed part return success')
                                        @php
                                        $aging_time='----';
                                        @endphp
                                        @else
                                        @php
                                        $date1=date_create(date('Y-m-d',strtotime($vl->created_at)));
                                        $date2=date_create(date('Y-m-d'));
                                        $diff=date_diff($date1,$date2);
                                        $aging_time=$diff->format("%a");
                                        @endphp
                                        @endif

                                        @php
                                        $date3=date_create(date('Y-m-d',strtotime($vl->created_at)));
                                        $date4=($vl->status=='Completed' || $vl->status=='Cancelled' || $vl->status=='Transfered' || $vl->status=='Completed part return pending' || $vl->status=='Completed part return processed' || $vl->status=='Completed part return success') ? date_create(date('Y-m-d',strtotime($vl->updated_at))) :date_create(date('Y-m-d')); ;
                                        $diff_tata=date_diff($date3,$date4);
                                        $tat=$diff_tata->format("%a");
                                        @endphp

                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$vl->call_id}}</td>
                                            <td>{{$vl->description}}</td>
                                            <td>{{$vl->model_no}}</td>
                                            <td>{{$vl->customer_name}}</td>
                                            <td>{{$vl->service_type}}</td>
                                            <td>{{$vl->service_center_name}}</td>
                                            <td>{{$vl->customer_phone}}</td>
                                            <td>{{$vl->customer_pincode}}</td>
                                            <td>{{$vl->store_name}}</td>
                                            <td>{{basicDateFormat($vl->created_at)}}</td>
                                            <form action="{{ route('enquiry.assign.admin')}}" method="POST">
                                                @csrf
                                                <td>
                                                    <select required="" name="executive_id" class="form-control">
                                                        <option value="">Select</option>

                                                        @foreach ($exe as $key)
                                                        <option {{$key->executive_id==$executive_id ? 'selected':''}} value="{{$key->executive_id}}">{{ $key->name }} ({{$key->executive_id}})</option>
                                                        @endforeach

                                                    </select>
                                                </td>

                                                <td><input required="" value="{{$end_date}}" name="end_date" type="date" class="form-control"></td>
                                                <input name="call_id" value="{{$vl->call_id}}" type="hidden" class="form-control">
                                                <input name="service_type" value="{{$vl->service_type}}" type="hidden" class="form-control">
                                                <input name="service_id" type="hidden" value="{{$vl->service_id}}" class="form-control">
                                                <input name="service_center_name" type="hidden" value="{{$vl->service_center_name}}" class="form-control">
                                                <input name="model_no" type="hidden" value="{{$vl->model_no}}" class="form-control">
                                                <input name="invoice_no" type="hidden" value="{{$vl->invoice_no}}" class="form-control">
                                                <input name="date_of_purchase" type="hidden" value="{{$vl->date_of_purchase}}" class="form-control">
                                                <input name="customer_name" type="hidden" value="{{$vl->customer_name}}" class="form-control">
                                                <input name="serial_no" type="hidden" value="{{$vl->serial_no}}" class="form-control">
                                                <input name="partner_id" type="hidden" value="{{$vl->partner_id}}" class="form-control">
                                                <input name="partner_name" type="hidden" value="{{$vl->partner_name}}" class="form-control">
                                                <input name="enquiry_id" type="hidden" value="{{$vl->id}}" class="form-control">


                                                @if ($vl->status=='Assigned' || $vl->status=='Allocated' || $vl->status=='Transfer request')
                                                <td><button type="submit" class="btn btn-success">Assign</button></td>
                                                @else
                                                <td><button disabled type="submit" class="btn btn-danger">Assign</button></td>

                                                @endif
                                            </form>
                                            <td>{{$closed_date}}</td>
                                            <td>{{$tat}}</td>
                                            <td>{{$aging_time}}</td>
                                            <td style="@php echo $color @endphp">
                                                <p class="status_color">{{$vl->status}}</p>
                                            </td>
                                            <td>
                                                <button><i class="fa fa-eye" data-toggle="modal" data-target="#exampleModalLong{{$vl->id}}" style="color:#1e7e34"></i></button>
                                                @if($vl->status=='Completed part return pending' || $vl->status=='Completed part return processed')
                                                <button><i class="fa fa-refresh" data-bs-toggle="modal" data-bs-target="#partreturn{{$vl->id}}" style="color:#1e7e34"></i></button>
                                                @endif
                                                @if($vl->status=='Assigned' or $vl->status=='Allocated' or $vl->status=='Part pending' or $vl->status=='Cancel request')

                                                <button><i class="fa fa-exchange" data-bs-toggle="modal" data-bs-target="#exampleModal{{$vl->id}}" style="color:#f24734"></i></button>
                                                @endif
                                                @if($vl->status=='Assigned' or $vl->status=='Allocated' or $vl->status=='Part pending' or $vl->status=='Completed part return pending' or $vl->status=='Completed part return processed')
                                                <a href="{{route('enquiry.admin',$vl->id)}}"><i class="fa fa-check" style="color:#37b3c9"></i></a>
                                                @endif
                                            </td>
                                        </tr>


                                        <div class="modal fade" id="exampleModal{{$vl->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                                <label for="message-text" class="col-form-label">Reason:</label>
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
                                                            <div class="col-3">Customer Pincode:</div>
                                                            <div class="col-3">{{$vl->customer_pincode}}</div>

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
                                        @endforeach


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Primary table -->
            </div>
        </div>
        <!--==================================*
                   End Main Section
        *====================================-->
    </div>
    <!--=================================*
           End Main Content Section
    *===================================-->
    <style>
        .editc {
            display: flex;
            justify-content: space-around;

        }

    </style>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                dom: 'Bfrtip'
                , buttons: [{
                        extend: 'copy'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17]
                        }
                    }
                    , {
                        extend: 'csv'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17]


                        }
                    }
                    , {
                        extend: 'excel'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17]

                        }
                    }


                ],

            });
        });

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

    </div>
    <!--=========================*
        End Page Container
*===========================-->

    @include('logics.include.datatable')



    <!--=========================*
            Scripts
*===========================-->


</body>

</html>
