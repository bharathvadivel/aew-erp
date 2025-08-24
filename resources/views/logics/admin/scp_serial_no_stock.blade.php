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

        i.fas {
            display: inline-block;
            border-radius: 60px;
            box-shadow: 0 0 4px #888;
            padding: 0.5em 0.6em;

        }

        @media (min-width: 576px) {
            .modal-dialog {
                max-width: 500px !important;
                margin: 1.75rem auto;
            }

            .row {
                justify-content: flex-end;
            }
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
                            <h4 class="header-title" style="display:flex;justify-content: space-between;align-content: space-around;">Stock List

                            </h4>
                            <br>

                            <br>
                            @if(session()->get('partner_type')=='admin' || session()->get('partner_type')=='Accounts' || session()->get('partner_type')=='warehouse')
                            <form method="POST" action="{{route('scp.stock.search')}}">
                                @csrf
                                <div class="form-row">

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Service Center</label>
                                            <select name="service_id" class="form-control">
                                                @foreach ($services as $key)
                                                <option {{$key->service_id==$service_id ? 'selected':''}} value="{{$key->service_id}}">{{$key->service_center_name}} - ({{$key->service_id}})</option>
                                                @endforeach
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
                            @endif

                            <div class="table-responsive datatable-primary">
                                <table id="dataTable2" class="display" style="width:100%">
                                    <thead class="text-capitalize">
                                        <tr>
                                            <th>S.NO </th>
                                            @if(session()->get('partner_type')=='admin' || session()->get('partner_type')=='Accounts' || session()->get('partner_type')=='warehouse')
                                            <th>SCP ID</th>
                                            <th>Service Center Name</th>
                                            <th>Authority</th>
                                            @endif
                                            <th>Invoice No</th>
                                            <th>Serial No</th>
                                            <th>Product category</th>
                                            <th>Model No</th>
                                            <th>Availability</th>
                                            <th>Goods Status</th>
                                            <th>Consumed?</th>
                                            <th>Consumed Against</th>
                                            <th>Defect Status</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @empty($serials)
                                            <p>No stocks available</p>
                                        @else
                                            @foreach ($serials as $key=>$vl)
                                                @php
                                                    $who = DB::table('services')->where('service_id',$vl->scp_id)->first();
                                                    $newPro = DB::table('gategories')->where('id',$vl->gategory_id)->first();
                                                @endphp
                                                <tr>
                                                    <td>{{$key+1}}</td>
                                                    @if(session()->get('partner_type')=='admin' || session()->get('partner_type')=='Accounts' || session()->get('partner_type')=='warehouse')
                                                    <td>{{$vl->scp_id}}</td>
                                                    <td>{{$who->service_center_name}}</td>
                                                    <td>{{$who->name}}</td>
                                                    @endif
                                                    <td>{{$vl->scp_invoice_no}}</td>
                                                    <td>{{$vl->serial_no}}</td>
                                                    <td>{{$newPro->gategory_name}}</td>
                                                    <td>{{$vl->model_no}}</td>
                                                    <td>{{$vl->status}}</td>
                                                    <td>
                                                        @if($vl->sp_goods_status == 'Good')
                                                            Good
                                                        @elseif($vl->sp_goods_status == 'Mismatch')
                                                            Mismatch
                                                        @elseif($vl->sp_goods_status == 'Defect')
                                                            Defect
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($vl->consume_status == '0')
                                                            No
                                                        @else
                                                            Yes
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($vl->consume_status == '0')
                                                            -
                                                        @else
                                                            {{$vl->call_id}}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($vl->defect_status == '1')
                                                            Defect After Consume
                                                        @elseif($vl->defect_status == '2')
                                                            Due to In-Transit
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    <td>{{basicDateFormat($vl->created_at)}}</td>
                                                    <!-- <td class="editc">
                                                        <button><i  data-placement="top" title="Serial" class="fa fa-check" data-bs-toggle="modal" data-bs-target="#exampleModal{{$vl->id}}" style="color:green"></i></button>
                                                    </td> -->
                                                    <td>
                                                        @if($vl->type == 'Stock Transfer' && $vl->sp_goods_status == 'Good' && $vl->status == 'unused')
                                                            <button class="btn btn-success" data-placement="top" data-bs-toggle="modal" data-bs-target="#consumeModal{{$vl->id}}">Consume</button>
                                                        @elseif($vl->type == 'Stock Transfer' && $vl->sp_goods_status != 'Good')
                                                            <button><a type="button" class="btn btn-warning" data-toggle="modal" data-target="#goodsstatusModal{{$vl->id}}">Update Goods</a></button>
                                                        @endif
                                                        
                                                        <!-- Consume modal -->
                                                            <div class="modal" id="consumeModal{{ $vl->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <form method="post" action="{{route('scp.serial.consume.status.update',$vl->id)}}">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="myModalLabel">Consume Stock</h5>
                                                                                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                @csrf
                                                                                <div class="form-row">
                                                                                    @php
                                                                                        $scp_serials = $partNew = DB::table('scp_serials')->where('id', $vl->id)->get();
                                                                                    @endphp
                                                                                    @foreach ($scp_serials as $slist)
                                                                                        <div class="col-md-12 mb-12">
                                                                                            <input type="hidden" readonly name="scp_serial_id" value="{{$slist->id}}" class="form-control" id="scp_serial_id">
                                                                                            <p style="font-size: 16px;"><strong>Serial No:</strong> {{$slist->serial_no}}</p>
                                                                                        </div>
                                                                                    @endforeach
                                                                                </div>
                                                                                <div class="form-row">
                                                                                    <div class="col-md-12 mb-12">
                                                                                        @php
                                                                                            $scp_approved_calls = DB::table('enquiries')->where('service_id', $service_id)->where('status', 'Part(s) Delivered')->get();
                                                                                        @endphp
                                                                                        @if($scp_approved_calls->isEmpty())
                                                                                            <p style="font-size: 16px;"><strong>Enquiry(s):</strong> <span style="color: red;">No Part(s) delivered yet, please update status</span></p>
                                                                                        @else
                                                                                            <p style="font-size: 16px;"><strong>Enquiry(s):</strong></p>
                                                                                            <select name="call_id" class="form-control">
                                                                                                @foreach ($scp_approved_calls as $ckey)
                                                                                                <option value="{{$ckey->call_id}}">{{$ckey->call_id}} - ({{$ckey->service_id}})</option>
                                                                                                @endforeach
                                                                                            </select>
                                                                                        @endif
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                                            </div>
                                                                        </form>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <!-- Consume modal -->
                                                        
                                                        <!-- Goods Status modal -->
                                                            <div class="modal" id="goodsstatusModal{{ $vl->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <form method="post" action="{{route('scp.serial.goods.status.update',$vl->id)}}">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleModalLabel">Update Goods Status</h5>
                                                                                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                                                            </div>
                                                                        
                                                                            <div class="modal-body">
                                                                                @csrf
                                                                                <div>
                                                                                    <table class="table table-striped">
                                                                                        <thead style="background-color: #010203; color: #FFFFFF;">
                                                                                            <tr>
                                                                                                <td>Serial No</td>
                                                                                                <td>Model No</td>
                                                                                                <td>Goods Status</td>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            @php
                                                                                                $scp_serials = DB::table('scp_serials')->where('id', $vl->id)->get();
                                                                                            @endphp
                                                                                            @foreach ($scp_serials as $slist)
                                                                                                <tr>
                                                                                                    <td>{{ $slist->serial_no }}</td>
                                                                                                    <td>{{ $slist->model_no }}</td>
                                                                                                    <td>
                                                                                                        <input type="hidden" readonly name="scp_serial_id" value="{{$slist->id}}" class="form-control" id="scp_serial_id">
                                                                                                        <div class="form-check form-check-inline">
                                                                                                            <input class="form-check-input" type="radio" id="gstatus_{{ $slist->id }}" name="goods_status[{{ $slist->id }}]" value="Good" @if(isset($slist->sp_goods_status) && $slist->sp_goods_status === 'Good') checked @endif required>
                                                                                                            <label class="form-check-label" for="gstatus_{{ $slist->id }}">Good</label>
                                                                                                        </div>
                                                                                                        <div class="form-check form-check-inline">
                                                                                                            <input class="form-check-input" type="radio" id="mstatus_{{ $slist->id }}" name="goods_status[{{ $slist->id }}]" value="Mismatch" @if(isset($slist->sp_goods_status) && $slist->sp_goods_status === 'Mismatch') checked @endif>
                                                                                                            <label class="form-check-label" for="mstatus_{{ $slist->id }}">Mismatch</label>
                                                                                                        </div>
                                                                                                        <div class="form-check form-check-inline">
                                                                                                            <input class="form-check-input" type="radio" id="dstatus_{{ $slist->id }}" name="goods_status[{{ $slist->id }}]" value="Defect" @if(isset($slist->sp_goods_status) && $slist->sp_goods_status === 'Defect') checked @endif>
                                                                                                            <label class="form-check-label" for="dstatus_{{ $slist->id }}">Defect</label>
                                                                                                        </div>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            @endforeach
                                                                                        </tbody>
                                                                                    </table>

                                                                                    <div class="form-row">
                                                                                        <div class="col-md-12 mb-12">
                                                                                            @php
                                                                                                $scp_approved_calls = DB::table('enquiries')->where('service_id', $service_id)->where('status', 'Part(s) In-Transit')->get();
                                                                                            @endphp
                                                                                            @if($scp_approved_calls->isEmpty())
                                                                                                <p style="font-size: 16px;"><strong>Enquiry(s):</strong> <span style="color: red;">No Calls Approved Yet</span></p>
                                                                                            @else
                                                                                                <p style="font-size: 16px;"><strong>Enquiry(s):</strong></p>
                                                                                                <select name="call_id" class="form-control" required>
                                                                                                    <option value="">Select Enquiry ID</option>
                                                                                                    @foreach ($scp_approved_calls as $ckey)
                                                                                                    <option value="{{$ckey->call_id}}">{{$ckey->call_id}} - ({{$ckey->service_id}})</option>
                                                                                                    @endforeach
                                                                                                </select>
                                                                                            @endif
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                                            </div>
                                                                        </form>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <!-- Goods Status modal -->
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endempty

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
        Scripts
    *===========================-->


</body>

</html>
