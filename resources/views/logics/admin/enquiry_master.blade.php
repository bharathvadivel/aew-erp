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

                            <form method="GET" action="{{route('enquiry.master')}}">

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
                                                <th>Age</th>
                                                <th>Service Canter</th>
                                                <th>Status</th>
                                                <th>Remarks</th>
                                                <th>Service Type</th>
                                                <th>Product Name</th>
                                                <th>Model No.</th>
                                                <th>Product Serial No.</th>
                                                <th>Customer Name</th>
                                                <th>Allocated Date</th>
                                                <th>End Date</th>
                                                <th>Closed Date</th>
                                                <th>Created By</th>
                                                <th>Action</th>
                                            </tr>

                                        </thead>
                                        <tbody>
                                            @if(count($enquiry) > 0)
                                                @foreach ($enquiry as $key=>$vl)
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


                                                    @if($vl->status!='Not allocated')
                                                        @php
                                                        $allocated_date_row=basicDateFormat($vl->created_at)
                                                        @endphp
                                                    @else
                                                        @php
                                                        $allocated_date_row='00-00-0000'
                                                        @endphp
                                                    @endif

                                                    @if($vl->status=='Allocated' || $vl->status=='Part(s) In-Progress' || $vl->status=='Part(s) Approved')
                                                        @php $color="color:#ffbb44"; @endphp
                                                    @elseif($vl->status=='Assigned')
                                                        @php $color="color:#37b3c9"; @endphp
                                                    @elseif($vl->status=='Closing request')
                                                        @php $color="color:#67479e"; @endphp
                                                    @elseif($vl->status=='Cancel request' || $vl->status=='Reappoinment' || $vl->status=='Not allocated' || $vl->status=='Part pending')
                                                        @php $color="color:#f24734"; @endphp
                                                    @elseif($vl->status=='Transfer request')
                                                        @php $color="color:#67479e"; @endphp
                                                    @else
                                                        @php $color="color:#2fe65e"; @endphp
                                                    @endif



                                                    <tr>
                                                        <td>{{$key+1}}</td>
                                                        <td>{{$vl->call_id}}</td>
                                                        <td>{{$aging_time}}</td>
                                                        <td>{{$vl->service_center ? $vl->service_center->service_center_name : ''}}</td>
                                                        <td style="@php echo $color @endphp">
                                                            <p class="status_color">{{$vl->status}}</p>
                                                        </td>
                                                        <td>{{$vl->remarks}}</td>
                                                        <td>{{$vl->service_type}}</td>
                                                        <td>{{$vl->product ? $vl->product->description : ''}}</td>
                                                        <td>{{ $vl->model_no}}</td>
                                                        <td>{{$vl->serial_no}}</td>
                                                        <td>{{$vl->customer_name}}</td>
                                                        <td>{{$allocated_date_row}}</td>
                                                        <td>{{basicDateFormat($vl->end_date)}}</td>
                                                        <td>{{$closed_date}}</td>
                                                        <td>{{$vl->created_by}}</td>
                                                        <td>

                                                            <button><i  data-placement="top" title="View"  class="fa fa-eye" data-toggle="modal" data-target="#exampleModalLong{{$vl->id}}" style="color:#1e7e34"></i></button>

                                                            <!-- <button><i class="fa fa-clipboard" style="color:#1e7e34"></i></button> -->

                                                            @if($vl->status=='Allocated' or $vl->status=='Assigned' or $vl->status=='Not allocated')
                                                            <a href="{{route('enquiry.edit',$vl->id)}}"><i data-placement="top" title="Edit" style="color:#ffbb44" class="fa fa-edit"></i></a>
                                                            @endif

                                                            @if($vl->status=='Assigned' or $vl->status=='Allocated' or $vl->status=='Closing request' or $vl->status=='Part pending' or $vl->status=='Part(s) In-Progress' or $vl->status=='Cancel request' or $vl->status=="Reappoitnment")
                                                            <a href="{{route('enquiry.admin',$vl->id)}}"><i data-placement="top" title="Status Update" class="fa fa-check" style="color:#37b3c9"></i></a>
                                                            @endif

                                                            @if($vl->status=='Completed' || $vl->status=='Part pending' || $vl->status=='Part(s) In-Progress' || $vl->status=='Cancelled' || $vl->status=='Completed part return pending' || $vl->status=='Completed part return processed' || $vl->status=='Completed part return success')
                                                            <a target="_blank" href="{{route('enquiry.rma',$vl->id)}}"><button><i data-placement="top" title="RMA Report" class="fa fa-bar-chart" style="color:#1e7e34"></i></button></a>
                                                            @endif

                                                            @if($vl->status=='Reappoinment' or $vl->status=='Cancel request')
                                                            <button><i data-placement="top" title="Reallocate" class="fa fa-history" data-bs-toggle="modal" data-bs-target="#allocate{{$vl->id}}" style="color:#f24734"></i></button>
                                                            @endif

                                                            @if($vl->status=='Transfer request' || $vl->status=='Not allocated')
                                                            <button><i data-placement="top" title="Transfer" class="fa fa-exchange" data-bs-toggle="modal" data-bs-target="#call_transfer{{$vl->id}}" style="color:#f24734"></i></button>
                                                            @endif

                                                            @if($vl->status=='Part pending' || $vl->status=='Part(s) In-Progress')
                                                            <button><i data-placement="top" title="Part Order" class="fa fa-shopping-cart" data-bs-toggle="modal" data-bs-target="#cart{{ $vl->id }}" style="color:#f24734"></i></button>
                                                            @endif

                                                            <button><i data-placement="top" title="Cancel" class="fa fa-close" data-bs-toggle="modal" data-bs-target="#call_cancel{{$vl->id}}" style="color:#ffbb44"></i></button>

                                                            <div class="modal fade" id="call_cancel{{$vl->id}}" tabindex="-1" aria-labelledby="call_cancelLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content model_color">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="call_cancelLabel">Call cancel</h5>

                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <form method="post" action="{{route('enquiry.cancel',$vl->id)}}">
                                                                            <div class="modal-body">
                                                                            
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

                                                            <div class="modal fade" id="call_transfer{{$vl->id}}" tabindex="-1" aria-labelledby="call_transferLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content model_color">
                                                                        <div class="modal-header">

                                                                            <h5 class="modal-title" id="call_transferLabel">Call transfer</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <form method="post" action="{{route('enquiry.transfer',$vl->id)}}">
                                                                            <div class="modal-body">
                                                                            
                                                                                @csrf
                                                                                <div class="mb-3">
                                                                                    <label for="recipient-name" class="col-form-label">Call ID:</label>
                                                                                    <input type="text" readonly name="call_id" value="{{$vl->call_id}}" class="form-control" id="recipient-name">
                                                                                </div>

                                                                                <div class="mb-3">
                                                                                    <label for="recipient-name" class="col-form-label">Service center</label>

                                                                                    <select class="form-control" required="" name="service_id" id="">
                                                                                        <option>Select service center</option>
                                                                                        @foreach ($service_center as $ij)
                                                                                        <option value="{{$ij->service_id}}">{{$ij->service_center_name}}</option>
                                                                                        @endforeach

                                                                                    </select>

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


                                                            <div class="modal fade" id="allocate{{$vl->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content model_color">
                                                                        <div class="modal-header">

                                                                            <h5 class="modal-title" id="exampleModalLabel">Call Allocate</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <form method="post" action="{{route('enquiry.allocate',$vl->id)}}">
                                                                            <div class="modal-body">
                                                                            
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


                                                            <!-- Large modal -->
                                                            <div class="modal" id="cart{{ $vl->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <form method="post" action="{{route('enquiry.part.order',$vl->id)}}">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleModalLabel">Part Order</h5>
                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                            </div>
                                                                        
                                                                            <div class="modal-body">
                                                                                @csrf
                                                                                @php
                                                                                    // Retrieve data from the enquirylists table
                                                                                    $enquiryLists = DB::table('enquirylists')
                                                                                        ->where('enquiry_id', $vl->id)
                                                                                        ->where(function ($query) {
                                                                                            $query->where('status', 'Part pending')
                                                                                                ->orWhere('status', 'Part(s) In-Progress');
                                                                                        })
                                                                                        ->orderBy('id', 'desc')
                                                                                        ->first();

                                                                                    // Initialize arrays
                                                                                    $part_code = [];
                                                                                    $part_name = [];
                                                                                    $fulfill_status = [];

                                                                                    if ($enquiryLists) {
                                                                                        // Decode JSON arrays
                                                                                        $part_code = json_decode($enquiryLists->part_code);
                                                                                        $part_name = json_decode($enquiryLists->part_name);
                                                                                        $fulfill_status = json_decode($enquiryLists->fulfillment_status, true);
                                                                                    }

                                                                                    // Fetch relevant products based on part codes
                                                                                    $partNew = DB::table('products')
                                                                                        ->whereIn('model_no', $part_code)
                                                                                        ->get();
                                                                                @endphp
                                                                                <div class="mb-3">
                                                                                    <label for="recipient-name" class="col-form-label">Call ID:</label>
                                                                                    <input type="text" readonly name="call_id" value="{{$vl->call_id}}" class="form-control" id="recipient-name">
                                                                                </div>
                                                                                <div>
                                                                                    <!-- <label for="recipient-name" class="col-form-label">Part Code & Part Name:</label> -->
                                                                                    <table class="table table-striped">
                                                                                        <thead style="background-color: #010203; color: #FFFFFF;">
                                                                                            <tr>
                                                                                                <td>Part Code</td>
                                                                                                <td>Part Name</td>
                                                                                                <td>Update Availability</td>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            @foreach ($partNew as $keylist)
                                                                                                
                                                                                                @if (in_array($keylist->model_no, $part_code))
                                                                                                    <tr>
                                                                                                        <td>
                                                                                                            <input class="form-control" type="text" name="part_code[]" value="{{ $keylist->model_no }}" readonly>
                                                                                                        </td>
                                                                                                        <td>{{ $keylist->description }}</td>
                                                                                                        <td>
                                                                                                            <div class="form-check form-check-inline">
                                                                                                                <input class="form-check-input" type="radio" id="fulfillment_{{ $keylist->model_no }}" name="fulfillment_status[{{ $keylist->model_no }}]" value="approve" @if(isset($fulfill_status[$keylist->model_no]) && $fulfill_status[$keylist->model_no] === 'approve') checked @endif>
                                                                                                                <label class="form-check-label" for="fulfillment_{{ $keylist->model_no }}">Approve</label>
                                                                                                            </div>
                                                                                                            <div class="form-check form-check-inline">
                                                                                                                <input class="form-check-input" type="radio" id="on_hold_{{ $keylist->model_no }}" name="fulfillment_status[{{ $keylist->model_no }}]" value="onhold" @if(isset($fulfill_status[$keylist->model_no]) && $fulfill_status[$keylist->model_no] === 'onhold') checked @endif>
                                                                                                                <label class="form-check-label" for="on_hold_{{ $keylist->model_no }}">On Hold</label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                @endif
                                                                                            @endforeach
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>
                                                                                <!-- <div class="mb-3">
                                                                                    <label for="recipient-name" class="col-form-label">Part Code & Part Name:</label>
                                                                                    <select style="height: 225px;" required="" name="part_code[]" class="form-control" multiple>

                                                                                        @foreach ($partNew as $key=>$keylist)

                                                                                        <option {{in_array($keylist->model_no,$part_code) ? 'selected':''}} value="{{$keylist->model_no}}">{{ $keylist->model_no }} ({{ $keylist->description }})</option>

                                                                                        @endforeach


                                                                                    </select>
                                                                                </div> -->
                                                                                <div class="mb-3">
                                                                                    <label for="message-text" class="col-form-label">Reason:</label>
                                                                                    <textarea class="form-control" required="" name="remarks" id="message-text">Spare part(s) ordered</textarea>
                                                                                </div>
                                                                                @if($enquiryLists)

                                                                                <input type="hidden" readonly name="enquirylist_id" value="{{$enquiryLists->id}}" class="form-control" id="recipient-name">
                                                                                @else
                                                                                <input type="hidden" readonly name="enquirylist_id" value="" class="form-control" id="recipient-name">
                                                                                @endif
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                                            </div>
                                                                        </form>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- Large modal -->


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
                                                                                $enq_last=DB::table('enquirylists')->where('call_id',$vl->call_id)->orderBy('id','desc')->first();
                                                                                @endphp
                                                                                @if ($enq_last)

                                                                                <div class="col-3"> Handle by:</div>
                                                                                <div class="col-3">{{$vl->executive_name}}</div>
                                                                                <div class="col-3">Allocated Date:</div>
                                                                                <div class="col-3">{{basicDateFormat($enq_last->created_at)}}</div>
                                                                                <div class="col-3">End Date:</div>
                                                                                <div class="col-3">{{basicDateFormat($enq_last->end_date)}}</div>
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
                                                                                $enq=DB::table('enquirylists')->where('call_id',$vl->call_id)->get();
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
                                                                                    <p style="white-space:normal;#ffffff;background-color:{{ $color }}">{{$dt->status}}</p>
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
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

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
</body>

</html>
