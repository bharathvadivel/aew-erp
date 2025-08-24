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
            width: 40% !important;


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
        #tab4Content {

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
                <div onClick="JavaScript:selectTab(4),sec('tab4Content')" class="col-xl-4 col-md-6 col-lg-12 stretched_card">

                    <div class="card mb-mob-4 icon_card primary_card_bg">
                        <!-- Card body -->
                        <div class="card-body">
                            <p class="card-title mb-0 text-white">Total Distributor</p>
                            <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                                <h2 class="mb-0 text-white heart">{{$total_distributor}}</h2>
                                <div class="arrow_icon"><i class="fa fa-plus"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div onClick="JavaScript:selectTab(4),sec('tab4Content')" class="col-xl-4 col-md-6 col-lg-12 stretched_card">

                    <div class="card mb-mob-4 icon_card info_card_bg">
                        <!-- Card body -->
                        <div class="card-body">
                            <p class="card-title mb-0 text-white">Total Direct Dealer</p>
                            <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                                <h2 class="mb-0 text-white heart">{{$total_direct_dealer}}</h2>
                                <div class="arrow_icon"><i class="fa fa-plus"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div onClick="JavaScript:selectTab(1),sec('tab1Content')" class="col-xl-4 col-md-6 col-lg-12 stretched_card">

                    <div class="card mb-mob-4 icon_card success_card_bg">
                        <!-- Card body -->
                        <div class="card-body">
                            <p class="card-title mb-0 text-white">Total Order</p>
                            <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                                <h2 class="mb-0 text-white heart">{{$total_order}}</h2>
                                <div class="arrow_icon"><i class="fa fa-plus"></i></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row" style="padding-bottom:50px">
                <div onClick="JavaScript:selectTab(3),sec('tab3Content')" class="col-xl-4 col-md-6 col-lg-12 stretched_card">

                    <div class="card mb-mob-4 icon_card warning_card_bg">
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
                <div onClick="JavaScript:selectTab(2),sec('tab2Content')" class="col-xl-4 col-md-6 col-lg-12 stretched_card">

                    <div class="card mb-mob-4 icon_card primary_card_bg">
                        <!-- Card body -->
                        <div class="card-body">
                            <p class="card-title mb-0 text-white">Total Collection</p>
                            <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                                <h2 class="mb-0 text-white heart">{{number_format($total_collection,2)}}</h2>
                                <div class="arrow_icon"><i class="fa fa-rupee"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="row">
                <div class="card-body">
                    <form method="post" action="{{route('asm.dashboard')}}">
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
                                <label onClick="JavaScript:selectTab(1);" class="dtslable">Order</label>
                                <label onClick="JavaScript:selectTab(2);">Collection</label>
                                <label onClick="JavaScript:selectTab(3);">Sales</label>
                                <label onClick="JavaScript:selectTab(4);">Direct Partners</label>


                            </div>

                            {{-- <h4 class="mt-0 header-title">Today Call Details</h4> --}}

                            <div class="table-responsive datatable-primary">
                                <table class="table myTable" id="dataTable" class="text-center boh">
                                    <thead>
                                        <tr>
                                            <th>S.NO </th>
                                            <th>Order ID</th>

                                            <th>Warehouse</th>

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
                                        @foreach ($order as $key=>$vl)
                                        @php
                                        $color= $vl->status=='Pending'? '#ffbb44' : 'green';
                                        $color="color:".$color;

                                        $check=new LoginController;
                                        $order_name=$check->partner_details($vl->order_by);
                                        $partner_name=$check->partner_details($vl->partner_id);
                                        @endphp

                                        @php
                                        $let = DB::table('warehouses')->where('warehouse_id',$vl->to_id)->first();
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
                                            <td><a target="_blank" href="{{route('single.order',$vl->order_id)}}"><i class="fa fa-check" style="color:#056c91"></i>
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
                                <label onClick="JavaScript:selectTab(1);">Order</label>
                                <label onClick="JavaScript:selectTab(2);" class="dtslable">Collection</label>
                                <label onClick="JavaScript:selectTab(3);">Sales</label>
                                <label onClick="JavaScript:selectTab(4);">Direct Partners</label>


                            </div>
                            <div class="table-responsive datatable-primary">
                                <table class="table myTable" id="dataTable1" class="text-center boh">
                                    <thead>
                                        <tr>
                                            <th>S.NO </th>
                                            <th>Partner Name</th>
                                            <th>Partner Type</th>
                                            <th>Credit Limit</th>
                                            <th>Available Limit</th>
                                            <th>Total Order Amount</th>
                                            <th>Total Sales Amount</th>
                                            <th>Total Return Sales Amount</th>
                                            <th>Total Collected Sales Amount</th>
                                            {{-- <th>Total Pending Collect Sales Amount</th> --}}
                                            <th>Action</th>
                                        </tr>
                                        <input id="status" type="hidden" name="status" value="0">
                                    </thead>
                                    <tbody>
                                        @foreach ($collection as $key => $vl)
                                        @php
                                        $total_sale_amount=0;
                                        $total_return_amount=0;
                                        @endphp
                                        @if ($vl->partner_type=='sub_dealer')
                                        @php
                                        $total_sale_amount = DB::table('distributorinvoices')
                                        ->where('partner_id', $vl->partner_id)
                                        ->sum('grand_total');
                                        $total_return_amount = DB::table('dealersalereturns')
                                        ->where('partner_id', $vl->partner_id)
                                        ->sum('grand_total');
                                        @endphp
                                        @else
                                        @php
                                        $total_sale_amount = DB::table('disinvoices')
                                        ->where('dis_id', $vl->partner_id)
                                        ->sum('grand_total');
                                        $total_return_amount = DB::table('salereturns')
                                        ->where('dis_id', $vl->partner_id)
                                        ->sum('grand_total');
                                        @endphp
                                        @endif

                                        @php
                                        $collect = DB::table('amountcollects')
                                        ->where('partner_id', $vl->partner_id)
                                        ->sum('amount');

                                        $list = DB::table('distributors')
                                        ->where('partner_id', $vl->partner_id)
                                        ->first();


                                        $total_order = DB::table('apiorders')
                                        ->where('partner_id', $vl->partner_id)
                                        ->sum('grand_total');
                                        @endphp





                                        {{-- @php
                                                            $pending_amount=$total_sale_amount-$total_return_amount;
                                                            $pending_sales_amount=$pending_amount-$collect;

                                                            @endphp --}}
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $vl->partner_name }} ({{$vl->partner_store_name}})</td>
                                            <td>{{ $vl->partner_type }}</td>
                                            <td>{{ $list->credit_limit }}</td>
                                            <td>{{ $list->available_limit }}</td>
                                            <td>{{ $total_order }}</td>
                                            <td>{{ $total_sale_amount}}</td>
                                            <td>{{ $total_return_amount }}</td>
                                            <td>{{ $collect }}</td>
                                            {{-- <td>{{ $pending_sales_amount }}</td> --}}

                                            <td>
                                                <a target="_blank" href="{{ route('amount.collect.master', $vl->partner_id) }}"><i class="fa fa-link" style="color:#056c91;margin: 10px;"></i></a>
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


            <div id="tab3Content" class="row">
                <div class="col-xl-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div class="dts">
                                <label onClick="JavaScript:selectTab(1);">Order</label>
                                <label onClick="JavaScript:selectTab(2);">Collection</label>
                                <label onClick="JavaScript:selectTab(3);" class="dtslable">Sales</label>
                                <label onClick="JavaScript:selectTab(4);">Direct Partners</label>

                            </div>
                            <div class="table-responsive datatable-primary">
                                <table class="table myTable" id="dataTable2" class="text-center boh">
                                    <thead>
                                        <tr>
                                            <th>S.NO </th>
                                            <th>Invoice NO</th>
                                            <th>Direct Partner Name</th>
                                            <th>Direct Partner Address</th>
                                            <th>Mobile Number</th>
                                            <th>Grand Total</th>
                                            <th>Invoice Date</th>
                                            <th>action</th>
                                        </tr>
                                        <input id="status" type="hidden" name="status" value="0">
                                    </thead>
                                    <tbody>
                                        @foreach ($disinvoices as $key=>$vl)
                                        @php
                                        $ab = DB::table('distributors')->where('partner_id',$vl->dis_id)->first();
                                        @endphp
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$vl->disinvoice_no}}</td>
                                            <td>{{$vl->dis_name}}</td>
                                            <td>{{$vl->address,$vl->district}}</td>
                                            <td>{{$ab->phone}}</td>
                                            <td>{{$vl->grand_total}}</td>
                                            <td>{{date('Y-m-d h:i A',strtotime($vl->date))}}</td>
                                            <td style="display: -webkit-inline-box;">
                                                <a target="_blank" href="{{route('disinvoice.print',$vl->disinvoice_no)}}"><i  data-placement="top" title="Invoice" class="fa fa-eye" style="color:red"></i></a>

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

            <div id="tab4Content" class="row">
                <div class="col-xl-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div class="dts">
                                <label onClick="JavaScript:selectTab(1);">Order</label>
                                <label onClick="JavaScript:selectTab(2);">Collection</label>
                                <label onClick="JavaScript:selectTab(3);">Sales</label>
                                <label onClick="JavaScript:selectTab(4);" class="dtslable">Direct Partners</label>


                            </div>
                            <div class="table-responsive datatable-primary">
                                <table class="table myTable" id="dataTable3" class="text-center boh">
                                    <thead>
                                        <tr>
                                            <th>S.NO </th>
                                            <th>Direct Partners Type</th>
                                            <th>Direct Partners-ID</th>
                                            <th>Company/Store Name</th>
                                            <th>Owner Name</th>
                                            <th class="thdis">Email</th>
                                            <th class="thdis">DOB</th>
                                            <th class="thdis">GSTIN-NO</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <th>Pincode</th>
                                            <th class="thdis">City</th>
                                            <th class="thdis">District</th>
                                            <th class="thdis">State</th>
                                            <th class="thdis">Country</th>
                                            <th>Credit limit</th>
                                            <th>Credit days</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                        </tr>

                                        <input id="status" type="hidden" name="status" value="0">
                                    </thead>
                                    <tbody>
                                        @foreach ($direct_partner as $key=>$vl)
                                        @php
                                        $color= $vl->status=='Enable'? 'green' : 'red';
                                        $color="color:".$color;
                                        $places = DB::table('userlocations')->where('partner_id',$vl->partner_id)->get();


                                        @endphp
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$vl->partner_type}}</td>
                                            <td>{{$vl->partner_id}}</td>
                                            <td>{{$vl->store_name}}</td>
                                            <td>{{$vl->name}}</td>
                                            <td class="thdis">{{$vl->email}}</td>
                                            <td class="thdis">{{$vl->dob}}</td>
                                            <td class="thdis">{{$vl->gstin_no}}</td>
                                            <td>{{$vl->phone}}</td>
                                            <td>
                                                <select>

                                                    @foreach ($places as $set=>$jk)
                                                    <option>{{$jk->address}}</option>
                                                    @endforeach
                                                </select>


                                            </td>
                                            <td>
                                                <select>

                                                    @foreach ($places as $set)
                                                    <option>{{$set->pincode}}</option>
                                                    @endforeach
                                                </select>


                                            </td>
                                            <td class="thdis">

                                                <select>

                                                    @foreach ($places as $set)
                                                    <option>{{$set->city}}</option>
                                                    @endforeach
                                                </select>


                                            </td>
                                            <td class="thdis">

                                                <select>

                                                    @foreach ($places as $set)
                                                    <option>{{$set->district}}</option>
                                                    @endforeach
                                                </select>


                                            </td>

                                            <td class="thdis">{{$vl->state}}</td>
                                            <td class="thdis">{{$vl->country}}</td>
                                            <td>{{$vl->credit_limit}}</td>
                                            <td>{{$vl->credit_days}}</td>

                                            <td style="{{ $color }}">{{$vl->status}}</td>
                                            <td>{{basicDateFormat($vl->created_at)}}</td>

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
            document.getElementById('tab4Content').style.display = "none";




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
                                         function sec(id) {
                                             window.location.href = '#' + id;

                                         }

                                     </script>

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
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                        }
                    }
                    , {
                        extend: 'csv'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]

                        }
                    }
                    , {
                        extend: 'excel'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                        }
                    }
                    , {
                        extend: 'pdf'
                        , orientation: 'landscape'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                        }
                    }
                    , {
                        extend: 'print'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
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
                            columns: [0, 1, 2, 3, 4, 5, 6]
                        }
                    }
                    , {
                        extend: 'csv'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6]

                        }
                    }
                    , {
                        extend: 'excel'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6]
                        }
                    }
                    , {
                        extend: 'pdf'
                        , orientation: 'landscape'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6]
                        }
                    }
                    , {
                        extend: 'print'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6]
                        }
                    }


                ],

            });
        });

        $(document).ready(function() {
            $('#dataTable3').DataTable({
                dom: 'Bfrtip'
                , buttons: [{
                        extend: 'copy'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18]
                        }
                    }
                    , {
                        extend: 'csv'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18]


                        }
                    }
                    , {
                        extend: 'excel'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18]

                        }
                    }
                    , {
                        extend: 'pdf'
                        , orientation: 'landscape'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18]

                        }
                    }
                    , {
                        extend: 'print'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18]

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
