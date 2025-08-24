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

        #tab2Content {

            display: block;
        }

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


        .thdis {
            display: none;
        }

        .crd {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: flex-end;
            align-content: center;
        }

        .card-columns {
            display: flex;
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
                <div onclick="window.location.href ='{{route('partorder.master')}}'" class="col-xl-3 col-md-6 col-lg-12 stretched_card">
                    <div class="card mb-mob-4 icon_card primary_card_bg">
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
                <div onclick="window.location.href ='{{route('partorder.master')}}'" class="col-xl-3 col-md-6 col-lg-12 stretched_card">

                    <div class="card mb-mob-4 icon_card info_card_bg">
                        <!-- Card body -->
                        <div class="card-body">
                            <p class="card-title mb-0 text-white">Total Processed Order</p>
                            <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                                <h2 class="mb-0 text-white heart">{{$total_process_order}}</h2>

                                <div class="arrow_icon"><i class="fa fa-plus"></i></div>

                            </div>
                        </div>
                    </div>
                </div>
                <div onclick="window.location.href ='{{route('partorder.master')}}'" class="col-xl-3 col-md-6 col-lg-12 stretched_card">

                    <div class="card mb-mob-4 icon_card success_card_bg">

                        <!-- Card body -->
                        <div class="card-body">
                            <p class="card-title mb-0 text-white">Total Pending Order</p>
                            <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                                <h2 class="mb-0 text-white heart">{{$total_pending_order}}</h2>

                                <div class="arrow_icon"><i class="fa fa-plus"></i></div>

                            </div>
                        </div>
                    </div>
                </div>

                <div onclick="window.location.href ='{{route('enquiry.master.return')}}'" class="col-xl-3 col-md-6 col-lg-12 stretched_card">
                    <div class="card mb-mob-4 icon_card warning_card_bg">

                        <!-- Card body -->
                        <div class="card-body">
                            <p class="card-title mb-0 text-white">Total Part Return Pending</p>
                            <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                                <h2 class="mb-0 text-white heart">{{$total_pending}}</h2>

                                <div class="arrow_icon"><i class="fa fa-plus"></i></div>

                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <div class="row" style="padding-bottom:50px">
                <div onclick="window.location.href ='{{route('enquiry.master.return')}}'" class="col-xl-3 col-md-6 col-lg-12 stretched_card">

                    <div class="card mb-mob-4 icon_card primary_card_bg">
                        <!-- Card body -->
                        <div class="card-body">
                            <p class="card-title mb-0 text-white">Total Part Return Processed</p>
                            <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                                <h2 class="mb-0 text-white heart">{{$total_process}}</h2>

                                <div class="arrow_icon"><i class="fa fa-plus"></i></div>

                            </div>
                        </div>
                    </div>
                </div>
                <div onclick="window.location.href ='{{route('enquiry.master.return')}}'" class="col-xl-3 col-md-6 col-lg-12 stretched_card">

                    <div class="card mb-mob-4 icon_card info_card_bg">

                        <!-- Card body -->
                        <div class="card-body">
                            <p class="card-title mb-0 text-white">Total Part Return Success</p>
                            <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                                <h2 class="mb-0 text-white heart">{{ $total_success}}</h2>

                                <div class="arrow_icon"><i class="fa fa-plus"></i></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


            <div class="card-columns">
                @foreach ($part_category as $key=>$vl )

                @php
                $stock = DB::table('parts')->where('category_id',$vl->id)->sum('qty');
                @endphp
                @if ($key==0)
                <div class="card bg-primarys">
                    @elseif ($key==1)
                    <div class="card bg-warnings">

                        @else
                        <div class="card bg-lights">

                            @endif
                            <div class="card-body">
                                <div class="crd">
                                    <p class="card-text">{{$vl->category_name}} (Stock)</p>
                                    <h2 class="card-text heart">{{$stock}}</h2>

                                </div>

                            </div>
                        </div>

                        @endforeach

                    </div>




                    <div class="row">
                        <div class="card-body">
                            <form method="post" action="{{route('factory.dashboard')}}">
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







                    <div id="tab2Content" class="row">
                        <div class="col-xl-12">
                            <div class="card m-b-30">
                                <div class="card-body">
                                    <div class="dts">
                                        <label onClick="JavaScript:selectTab(2);" class="dtslable">Order</label>
                                        <label onClick="JavaScript:selectTab(3);">Part Return List</label>
                                    </div>
                                    <div class="table-responsive datatable-primary">
                                        <table class="table myTable" id="dataTable1" class="text-center boh">
                                            <thead>
                                                <tr>
                                                    <th>S.NO </th>
                                                    <th>Call ID</th>
                                                    <th>Service Type</th>
                                                    <th>Service Center Name</th>
                                                    <th>Service Center Phone</th>
                                                    <th>Service Center Address</th>
                                                    <th>Service Center City</th>
                                                    <th class="thdis">Service Center District</th>
                                                    <th class="thdis">Service Center State</th>
                                                    <th class="thdis">Customer Name</th>
                                                    <th>Part Code</th>
                                                    <th>Part Name</th>
                                                    <th>Quantity</th>
                                                    <th>Warranty Type</th>
                                                    <th>Remarks</th>
                                                    <th>Status</th>
                                                    <th>date</th>
                                                    <th>action</th>

                                                </tr>
                                                <input id="status" type="hidden" name="status" value="0">
                                            </thead>
                                            <tbody>
                                                @foreach ($order as $key=>$vl)
                                                @php
                                                $color= $vl->status=='Pending'? 'red' : 'green';
                                                $color="color:".$color;
                                                $part_code_data=array_values(json_decode($vl->part_code));
                                                $part_code=implode(', ', $part_code_data);
                                                $part_name_data=json_decode($vl->part_name);
                                                $part_name=implode(', ', $part_name_data);


                                                @endphp
                                                <tr>
                                                    <td>{{$key+1}}</td>
                                                    <td>{{$vl->call_id}}</td>
                                                    <td>{{$vl->service_type}}</td>
                                                    <td>{{$vl->service_center_name}}</td>
                                                    <td>{{$vl->service_center_phone}}</td>
                                                    <td>{{$vl->service_center_address}}</td>
                                                    <td>{{$vl->service_center_city}}</td>
                                                    <td class="thdis">{{$vl->service_center_district}}</td>
                                                    <td class="thdis">{{$vl->service_center_state}}</td>
                                                    <td class="thdis">{{$vl->customer_name}}</td>
                                                    <td>{{$part_code}}</td>
                                                    <td>{{$part_name}}</td>
                                                    <td>1</td>
                                                    <td>{{$vl->warranty_type}}</td>
                                                    <td>{{$vl->remarks}}</td>
                                                    <td style="{{ $color }}">{{$vl->status}}</td>
                                                    <td>{{basicDateFormat($vl->created_at)}}</td>
                                                    <td>
                                                        @if ($vl->status=='Pending')
                                                        <a target="_blank" style="padding: 13px;" href="{{route('add.partorder.invoice',$vl->id)}}"><i  data-placement="top" title="Add Invoice" class="fa fa-check" style="color:#056c91"></i></a>


                                                        @endif

                                                        <form style="padding: 15px;" onsubmit="return confirm('Are you sure you want to delete?');" action="{{ route('partorder.delete',$vl->id)}}" method="POST">
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


                    <div id="tab3Content" class="row">
                        <div class="col-xl-12">
                            <div class="card m-b-30">
                                <div class="card-body">
                                    <div class="dts">
                                        <label onClick="JavaScript:selectTab(2);">Order</label>
                                        <label onClick="JavaScript:selectTab(3);" class="dtslable">Part Return List</label>

                                    </div>
                                    <div class="table-responsive datatable-primary">
                                        <table class="table myTable" id="dataTable2" class="text-center boh">
                                            <thead>
                                                <tr>
                                                    <th>S.NO </th>
                                                    <th>Call ID</th>
                                                    <th>Product Description</th>
                                                    <th>Part Name</th>
                                                    <th>Part Code</th>
                                                    <th class="thdis">Model No.</th>
                                                    <th class="thdis">Customer Name</th>
                                                    <th class="thdis">Service Type</th>
                                                    <th>Service Canter Name</th>
                                                    <th>Service Canter Address</th>
                                                    <th>Quantity</th>
                                                    <th>Remarks</th>
                                                    <th class="thdis">Customer Phone</th>
                                                    <th class="thdis">Customer Pincode</th>
                                                    <th class="thdis">Store Name</th>
                                                    <th class="thdis">Allocated Date</th>
                                                    <th class="thdis">Created By</th>
                                                    <th class="thdis">TAT (Days)</th>
                                                    <th class="thdis">Aging Time (Days)</th>
                                                    <th>Status</th>

                                                </tr>
                                                <input id="status" type="hidden" name="status" value="0">
                                            </thead>
                                            <tbody>
                                                @foreach ($part_return as $key=>$vl)

                                                @if($vl->status=='Completed part return pending' || $vl->status=='Completed part return processed')
                                                @php $color="color:#ff0000"; @endphp
                                                @else
                                                @php $color="color:#2fe65e"; @endphp
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
                                                $date4=($vl->status=='Completed' || $vl->status=='Cancelled' || $vl->status=='Transfered' || $vl->status=='Completed part return pending' || $vl->status=='Completed part return processed' || $vl->status=='Completed part return success') ? date_create(date('Y-m-d',strtotime($vl->updated_at))) :date_create(date('Y-m-d'));
                                                $diff_tata=date_diff($date3,$date4);
                                                $tat=$diff_tata->format("%a");
                                                @endphp
                                                @php
                                                $sc = DB::table('services')->where('service_id',$vl->service_id)->first();
                                                $call = DB::table('enquirylists')->where('call_id',$vl->call_id)->where('status','Completed part return processed')->orderBy('id','desc')->first();

                                                $part_code_data=json_decode($call->part_code);
                                                $part_code=implode(', ', $part_code_data);
                                                $part_name_data=json_decode($call->part_name);
                                                $part_name=implode(', ', $part_name_data);


                                                @endphp

                                                <tr>
                                                    <td>{{$key+1}}</td>
                                                    <td>{{$vl->call_id}}</td>
                                                    <td>{{$vl->description}}</td>
                                                    <td>{{$part_name}}</td>
                                                    <td>{{$part_code}}</td>
                                                    <td class="thdis">{{$vl->model_no}}</td>
                                                    <td class="thdis">{{$vl->customer_name}}</td>
                                                    <td class="thdis">{{$vl->service_type}}</td>
                                                    <td>{{$vl->service_center_name}}</td>
                                                    <td>{{$sc->address}}</td>
                                                    <td>1</td>
                                                    <td>{{$call->remarks}}</td>
                                                    <td class="thdis">{{$vl->customer_phone}}</td>
                                                    <td class="thdis">{{$vl->customer_pincode}}</td>
                                                    <td class="thdis">{{$vl->store_name}}</td>
                                                    <td class="thdis">{{basicDateFormat($vl->created_at)}}</td>
                                                    <td class="thdis">{{$vl->created_by}}</td>
                                                    <td class="thdis">{{$tat}}</td>
                                                    <td class="thdis">{{$aging_time}}</td>
                                                    <td style="@php echo $color @endphp">
                                                        <p class="status_color">{{$vl->status}}</p>
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
            $('#dataTable1').DataTable({
                dom: 'Bfrtip'
                , buttons: [{
                        extend: 'copy'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16]
                        }
                    }
                    , {
                        extend: 'csv'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16]


                        }
                    }
                    , {
                        extend: 'excel'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16]

                        }
                    }
                    , {
                        extend: 'pdf'
                        , orientation: 'landscape'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16]

                        }
                    }
                    , {
                        extend: 'print'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16]

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
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19]

                        }
                    }
                    , {
                        extend: 'csv'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19]


                        }
                    }
                    , {
                        extend: 'excel'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19]

                        }
                    }
                    , {
                        extend: 'pdf'
                        , orientation: 'landscape'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19]

                        }
                    }
                    , {
                        extend: 'print'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19]

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
