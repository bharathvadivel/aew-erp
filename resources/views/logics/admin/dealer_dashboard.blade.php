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

        #tab2Content,
        #tab3Content {
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

        .bg-primarys {
            background-color: #FCD1D1 !important
        }

        .bg-successs {
            background-color: #ECE2E1 !important;
        }

        .bg-lights {
            background-color: #D3E0DC !important;
        }

        .bg-warnings {
            background-color: #AEE1E1 !important;
        }

        .bg-infos {
            background-color: #FCD1D1 !important;
        }

        .bg-dangers {
            background-color: #A8A4CE !important;
        }

        .crd {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: flex-end;
            align-content: center;
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



                <div onclick="window.location.href ='{{route('my.order')}}'" class="col-xl-3 col-md-6 col-lg-12 stretched_card">


                    <div class="card mb-mob-3 icon_card success_card_bg">
                        <!-- Card body -->
                        <div class="card-body">
                            <p class="card-title mb-0 text-white">Total My Order</p>
                            <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                                <h2 class="mb-0 text-white heart">{{$total_our_order}}</h2>

                                <div class="arrow_icon"><i class="fa fa-plus"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div onclick="window.location.href ='{{route('my.order')}}'" class="col-xl-3 col-md-6 col-lg-12 stretched_card">

                    <div class="card mb-mob-3 icon_card warning_card_bg">
                        <!-- Card body -->
                        <div class="card-body">
                            <p class="card-title mb-0 text-white">Total My Pending Order</p>

                            <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                                <h2 class="mb-0 text-white heart">{{$total_our_pending_order}}</h2>

                                <div class="arrow_icon"><i class="fa fa-plus"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div onclick="window.location.href ='{{route('deainvoice.master')}}'" class="col-xl-3 col-md-6 col-lg-12 stretched_card">


                    <div class="card mb-mob-3 icon_card primary_card_bg">

                        <!-- Card body -->
                        <div class="card-body">
                            <p class="card-title mb-0 text-white">Total Sales</p>
                            <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                                <h2 class="mb-0 text-white heart">{{number_format($total_sales,2)}}</h2>
                                <div class="arrow_icon"><i class="fa fa-rupee"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div onclick="window.location.href ='{{route('partner.serial.list')}}'" class="col-xl-3 col-md-6 col-lg-12 stretched_card">


                    <div class="card mb-mob-3 icon_card primary_card_bg">

                        <!-- Card body -->
                        <div class="card-body">
                            <p class="card-title mb-0 text-white">Total  Quantity</p>
                            <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                                <h2 class="mb-0 text-white heart">{{$total_serials}}</h2>

                                <div class="arrow_icon"><i class="fa fa-plus"></i></div>
                            </div>
                        </div>
                    </div>
                </div>




            </div>
            <div class="row" style="padding-bottom:50px">

                <div onclick="window.location.href ='{{route('partner.serial.list')}}'" class="col-xl-3 col-md-6 col-lg-12 stretched_card">

                    <div class="card mb-mob-3 icon_card info_card_bg">

                        <!-- Card body -->
                        <div class="card-body">
                            <p class="card-title mb-0 text-white">Total Sold</p>
                            <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                                <h2 class="mb-0 text-white heart">{{$total_used}}</h2>

                                <div class="arrow_icon"><i class="fa fa-plus"></i></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div onclick="window.location.href ='{{route('partner.serial.list')}}'" class="col-xl-3 col-md-6 col-lg-12 stretched_card">

                    <div class="card mb-mob-3 icon_card success_card_bg">

                        <!-- Card body -->
                        <div class="card-body">
                            <p class="card-title mb-0 text-white">Total Unsold</p>
                            <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                                <h2 class="mb-0 text-white heart">{{$total_unused}}</h2>


                                <div class="arrow_icon"><i class="fa fa-plus"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div onclick="window.location.href ='{{route('partner.serial.list')}}'" class="col-xl-3 col-md-6 col-lg-12 stretched_card">

                    <div class="card mb-mob-3 icon_card primary_card_bg">

                        <!-- Card body -->
                        <div class="card-body">
                            <p class="card-title mb-0 text-white">Total Return</p>
                            <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                                <h2 class="mb-0 text-white heart">{{$total_return}}</h2>

                                <div class="arrow_icon"><i class="fa fa-plus"></i></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div onclick="window.location.href ='{{route('my.amount.collect.group.master')}}'" class="col-xl-3 col-md-6 col-lg-12 stretched_card">


                    <div class="card mb-mob-3 icon_card info_card_bg">

                        <!-- Card body -->
                        <div class="card-body">
                            <p class="card-title mb-0 text-white">Total Paid</p>
                            <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                                <h2 class="mb-0 text-white heart">{{$total_paid}}</h2>


                                <div class="arrow_icon"><i class="fa fa-plus"></i></div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>



            <div class="card-columns">
                @foreach ($gategory as $key=>$vl )
                @php
                $stock = DB::table('distributorserials')->where('partner_id',$partner_id)->where('status','unused')->where('gategory',$vl->gategory_name)->count();

                @endphp
                @if ($key==0)
                <div class="card bg-primarys">
                    @elseif ($key==1)
                    <div class="card bg-warnings">
                        @elseif ($key==2)

                        <div class="card bg-successs">
                            @elseif ($key==3)

                            <div class="card bg-dangers">
                                @elseif ($key==4)

                                <div class="card bg-infos">
                                    @else
                                    <div class="card bg-lights">

                                        @endif
                                        <div class="card-body">
                                            <div class="crd">
                                                <p class="card-text">{{$vl->gategory_name}} (Stock)</p>
                                                <h2 class="card-text heart">{{$stock}}</h2>

                                            </div>

                                        </div>
                                    </div>

                                    @endforeach

                                </div>



                                <div class="row">
                                    <div class="card-body">
                                        <form method="post" action="{{route('dealer.dashboard')}}">
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
                                                    <label onClick="JavaScript:selectTab(1);" class="dtslable">My Order</label>
                                                    <label onClick="JavaScript:selectTab(2);">Inventory</label>
                                                    <label onClick="JavaScript:selectTab(3);">Sales</label>
                                                </div>

                                                {{-- <h4 class="mt-0 header-title">Today Call Details</h4> --}}

                                                <div class="table-responsive datatable-primary">
                                                    <table class="table myTable" id="dataTable" class="text-center boh">
                                                        <thead>
                                                            <tr>
                                                                <th>S.NO </th>
                                                                <th>Order ID</th>
                                                                <th>Distributor</th>
                                                                <th>Company/Store name</th>
                                                                <th>Partner id</th>
                                                                <th>Partner type</th>
                                                                <th>Address</th>
                                                                <th>Order by</th>
                                                                <th>Grand total</th>
                                                                <th>Status</th>
                                                                <th>Date</th>
                                                                <th>Order Details</th>

                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php
                                                            use App\Http\Controllers\LoginController;
                                                            @endphp
                                                            @foreach ($our_order as $key=>$vl)



                                                            @php
                                                            $color= $vl->status=='Pending'? '#ffbb44' : 'green';
                                                            $color="color:".$color;

                                                            $check=new LoginController;
                                                            $order_name=$check->partner_details($vl->order_by);
                                                            $partner_name=$check->partner_details($vl->partner_id);
                                                            @endphp

                                                            @php
                                                            $let = DB::table('distributors')->where('partner_id',$vl->to_id)->first();
                                                            @endphp
                                                            <tr>
                                                                <td>{{$key+1}}</td>
                                                                <td>{{$vl->order_id}}</td>
                                                                <td>{{$vl->to_id}} ({{$let->name}})</td>
                                                                <td>{{$vl->store_name}}</td>
                                                                <td>{{$vl->partner_id}} ({{ $partner_name }})</td>
                                                                <td>{{$vl->partner_type}}</td>
                                                                <td>{{$vl->address}}</td>
                                                                <td>{{$vl->order_by}} ({{ $order_name }})</td>
                                                                <td>{{$vl->grand_total}}</td>
                                                                <td style="@php echo $color @endphp">{{$vl->status}}</td>
                                                                <td>{{basicDateFormat($vl->created_at)}}</td>
                                                                <td><a target="_blank" href="{{route('my.single.order',$vl->order_id)}}"><i class="fa fa-check" style="color:#056c91"></i>
                                                                        {{-- <form onsubmit="return confirm('Are you sure you want to delete?');" action="{{ route('order.delete',$vl->id)}}" method="POST">
                                                                        <input type="hidden" name="_method" value="DELETE">
                                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                        <button><i class="fa fa-trash" style="color:red"></i></button>
                                                                        </form> --}}
                                                                    </a>

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
                                                    <label onClick="JavaScript:selectTab(1);">My Order</label>
                                                    <label onClick="JavaScript:selectTab(2);" class="dtslable">Inventory</label>
                                                    <label onClick="JavaScript:selectTab(3);">Sales</label>
                                                </div>
                                                <div class="table-responsive datatable-primary">
                                                    <table class="table myTable" id="dataTable1" class="text-center boh">
                                                        <thead>
                                                            <tr>
                                                                <th>S.NO </th>
                                                                <th>Store Name</th>
                                                                <th>Product category</th>
                                                                <th>Model No</th>
                                                                <th>Available Quantity</th>
                                                                <th>Sold Quantity</th>
                                                                <th>Return Quantity</th>
                                                                <th>Date</th>
                                                                <th>Action</th>
                                                            </tr>
                                                            <input id="status" type="hidden" name="status" value="0">
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($serials as $key=>$vl)
                                                            @php
                                                            $count = DB::table('distributorserials')->where('partner_id',$vl->partner_id)->where('model_no',$vl->model_no)->where('status','unused')->get();
                                                            $count_list = DB::table('distributorserials')->where('partner_id',$vl->partner_id)->where('model_no',$vl->model_no)->get();
                                                            $sold_count = DB::table('distributorserials')->where('partner_id',$vl->partner_id)->where('model_no',$vl->model_no)->where('status','used')->get();
                                                            $return_count = DB::table('distributorserials')->where('partner_id',$vl->partner_id)->where('model_no',$vl->model_no)->where('status','return')->get();

                                                            $who = DB::table('distributors')->where('partner_id',$vl->partner_id)->first();

                                                            @endphp
                                                            <tr>
                                                                <td>{{$key+1}}</td>
                                                                <td>{{$who->store_name}}</td>
                                                                <td>{{$vl->gategory}}</td>
                                                                <td>{{$vl->model_no}}</td>
                                                                <td>{{count($count)}}</td>
                                                                <td>{{count($sold_count)}}</td>
                                                                <td>{{count($return_count)}}</td>
                                                                <td>{{basicDateFormat($vl->created_at)}}</td>
                                                                <td class="editc">
                                                                    <button><i  data-placement="top" title="Serial" class="fa fa-check" data-bs-toggle="modal" data-bs-target="#exampleModal{{$vl->id}}" style="color:green"></i></button>
                                                                    {{--

                                                                    <form onsubmit="return confirm('Are you sure you want to delete?');" action="{{ route('serial.no.delete',$vl->id)}}" method="POST">
                                                                    <input type="hidden" name="_method" value="DELETE">
                                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                    <button><i class="fa fa-trash" style="color:red"></i></button>
                                                                    </form> --}}
                                                                </td>
                                                            </tr>
                                                            <div class="modal fade" id="exampleModal{{$vl->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog  modal-dialog-centered">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Serial No List</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">

                                                                            <div class="row" style="color: #9908bd;padding-bottom:30px">
                                                                                <div class="col-5">Serial No: </div>
                                                                                <div class="col-5">Status:</div>
                                                                            </div>

                                                                            @foreach ($count_list as $key)


                                                                            <div class="row" style="padding-bottom:15px">
                                                                                <div class="col-5">{{$key->serial_no}}</div>
                                                                                @if ($key->status=='unused')
                                                                                <div class="col-5" style="color:red">Unsold</div>
                                                                                @elseif($key->status=='return')
                                                                                <div class="col-5" style="color:blue">Return</div>
                                                                                @else

                                                                                <div class="col-5" style="color:green">Sold</div>
                                                                                @endif
                                                                            </div>
                                                                            @endforeach

                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                        </div>
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
                                </div>


                                <div id="tab3Content" class="row">
                                    <div class="col-xl-12">
                                        <div class="card m-b-30">
                                            <div class="card-body">
                                                <div class="dts">
                                                    <label onClick="JavaScript:selectTab(1);">My Order</label>
                                                    <label onClick="JavaScript:selectTab(2);">Inventory</label>
                                                    <label onClick="JavaScript:selectTab(3);" class="dtslable">Sales</label>

                                                </div>
                                                <div class="table-responsive datatable-primary">
                                                    <table class="table myTable" id="dataTable2" class="text-center boh">
                                                        <thead>
                                                            <tr>
                                                               <th>S.NO </th>
                                                               <th>Invoice NO</th>
                                                               <th>Customer Name</th>
                                                               <th>Customer Address</th>
                                                               <th class="thdis">Customer Area</th>
                                                               <th class="thdis">Customer City</th>
                                                               <th class="thdis"> Customer District</th>
                                                               <th class="thdis">Customer State</th>
                                                               <th>Customer Number</th>
                                                               <th>Category Name</th>
                                                               <th>Model No</th>
                                                               <th>Product Description</th>
                                                               <th>HSN No</th>
                                                               <th class="thdis">Billing Price</th>
                                                               <th>Qty</th>
                                                               <th class="thdis">Serial No</th>
                                                               <th class="thdis">Taxable Value</th>
                                                               <th class="thdis">GST(%)</th>
                                                               <th class="thdis">CGST</th>
                                                               <th class="thdis">SGST</th>
                                                               <th class="thdis">IGST</th>
                                                               <th class="thdis">Sub Total</th>
                                                               <th>Net Value</th>
                                                               <th class="thdis">Round off (Net Total)</th>
                                                               <th class="thdis">Net Total</th>
                                                               <th>Sales Executive</th>
                                                               <th>Invoice Date</th>
                                                               <th>Action</th>

                                                            </tr>

                                                            <input id="status" type="hidden" name="status" value="0">
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($deainvoices as $key=>$vl)


                                                            @php
                                                            $sn = DB::table('deaserials')->where('deainvoices_id',$vl->id)->pluck('serial_no')->toArray();
                                                            $exe = DB::table('promoters')->where('promoter_id',$vl->promoter_id)->first();
                                                            $tax=$vl->sub_total;
                                                            @endphp

                                                            @if($vl->state=='TAMILNADU')

                                                            @php
                                                            $gst=$vl->gst;
                                                            $cgst=($vl->gst)/2;
                                                            $cgst=($tax-($tax/(1+($gst/100))))/2;
                                                            $igst=0;
                                                            @endphp
                                                            @else
                                                            @php
                                                            $cgst=0;
                                                            $gst=$vl->gst; $igst=($tax-($tax/(1+($gst/100))));
                                                            @endphp
                                                            @endif
                                                            @php
                                                            $taxable_value=$tax/(1+($gst/100));
                                                            $net_total=$tax;
                                                            @endphp
                                                            <tr>
                                                                <td>{{$key+1}}</td>
                                                                <td>{{$vl->customerinvoice_no}}</td>

                                                                <td>{{$vl->customer_name}}</td>
                                                                <td>{{$vl->address}}</td>
                                                                <td class="thdis">{{$vl->area}}</td>

                                                                <td class="thdis">{{$vl->city}}</td>

                                                                <td class="thdis">{{$vl->district}}</td>

                                                                <td class="thdis">{{$vl->state}}</td>

                                                                <td>{{$vl->customer_phone}}</td>
                                                                <td>{{$vl->gategory}}</td>
                                                                <td>{{$vl->model_no}}</td>
                                                                <td>{{$vl->description}}</td>
                                                                <td>{{$vl->hsn_code}}</td>
                                                                <td class="thdis">{{number_format($vl->billing_price,2)}}</td>
                                                                <td>{{$vl->qty}}</td>
                                                                <td class="thdis">{{implode(",",$sn)}}</td>
                                                                <td class="thdis">{{number_format($vl->taxable_value,2)}}</td>
                                                                <td class="thdis">{{$gst}}</td>
                                                                <td class="thdis">{{number_format($cgst,2)}}</td>
                                                                <td class="thdis">{{number_format($cgst,2)}}</td>
                                                                <td class="thdis">{{number_format($igst,2)}}</td>
                                                                <td class="thdis">{{number_format($vl->sub_total,2)}}</td>
                                                                <td>{{number_format($vl->sub_total,2)}}</td>
                                                                <td class="thdis">{{number_format($vl->round_off,2)}}</td>
                                                                <td class="thdis">{{number_format($vl->grand_total,2)}}</td>
                                                                <td>@if($exe) {{$exe->name}} @endif</td>

                                                                <td>{{date('Y-m-d h:i A',strtotime($vl->date))}}</td>
                                                                <td class="editc">
                                                                    <a target="_blank" href="{{route('deainvoice.print.pdf',$vl->customerinvoice_no)}}"><i   data-placement="top" title="Invoice" class="fa fa-eye" style="color:red"></i></a>
                                                                    <a href="{{route('deainvoice.edit',$vl->customerinvoice_no)}}"><i  data-placement="top" title="Edit" class="fa fa-edit" style="color:#056c91"></i></a>
                                                                    <form onsubmit="return confirm('Are you sure you want to delete?');" action="{{ route('deainvoice.delete',$vl->customerinvoice_no)}}" method="POST">
                                                                        <input type="hidden" name="_method" value="DELETE">
                                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                        <button><i  data-placement="top" title="Delete" class="fa fa-trash" style="color:red"></i></button>
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


                    $(document).ready(function() {
                        $('#dataTable1').DataTable({
                            dom: 'Bfrtip'
                            , buttons: [{
                                    extend: 'copy'
                                    , exportOptions: {
                                        columns: [0, 1, 2, 3, 4, 5, 6, 7]
                                    }
                                }
                                , {
                                    extend: 'csv'
                                    , exportOptions: {
                                        columns: [0, 1, 2, 3, 4, 5, 6, 7]

                                    }
                                }
                                , {
                                    extend: 'excel'
                                    , exportOptions: {
                                        columns: [0, 1, 2, 3, 4, 5, 6, 7]
                                    }
                                }
                                , {
                                    extend: 'pdf'
                                    , orientation: 'landscape'
                                    , exportOptions: {
                                        columns: [0, 1, 2, 3, 4, 5, 6, 7]
                                    }
                                }
                                , {
                                    extend: 'print'
                                    , exportOptions: {
                                        columns: [0, 1, 2, 3, 4, 5, 6, 7]
                                    }
                                }


                            ],

                        });
                    });

                    $(document).ready(function() {
                        $('#dataTable2').DataTable({
                            dom: 'Bfrtip'
                            , buttons: [{
                                    extend: 'copy'
                                    , exportOptions: {
                                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21,22,23,24,25,26]

                                    }
                                }
                                , {
                                    extend: 'csv'
                                    , exportOptions: {
                                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21,22,23,24,25,26]



                                    }
                                }
                                , {
                                    extend: 'excel'
                                    , exportOptions: {
                                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21,22,23,24,25,26]


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
