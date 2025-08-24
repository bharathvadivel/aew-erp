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

        .thdis {
            display: none;
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
                            <h4 class="header-title">Manage Invoice
                            </h4>
                            <br>
                            <form method="POST" action="{{route('partorder.invoice.master')}}">
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



                                    <div class="col-md-1 mb-1">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Filter<span style="color:red">&#9733;</span></label>
                                            <input style="cursor: pointer;background-color:#585858;color:white" type="submit" value="Search" class="form-control">




                                        </div>
                                    </div>


                                </div>
                            </form>


                            <div class="table-responsive datatable-primary">
                                <table id="dataTable" class="text-center boh">
                                    <thead class="text-capitalize">
                                        <tr>
                                            <th>S.NO </th>
                                            <th>Invoice NO</th>
                                            <th>Invoice Date</th>
                                            <th>Call ID</th>
                                            <th class="thdis">Warranty Type</th>
                                            <th>Service Enquriry Type</th>
                                            <th>Billing Address</th>
                                            <th>GST No.</th>
                                            <th>Service Center Name</th>
                                            <th>Service Center Address</th>
                                            <th class="thdis">Service Center City</th>
                                            <th class="thdis">Service Center District</th>
                                            <th class="thdis">Service Center State</th>
                                            <th>Mobile Number</th>
                                            <th class="thdis">Model Number</th>
                                            <th class="thdis">Serial Number</th>
                                            <th>Part Code</th>
                                            <th>Part Name</th>
                                            <th>HSN CODE</th>
                                            <th>Qty</th>
                                            <th>Price</th>
                                            <th class="thdis">GST</th>
                                            <th class="thdis">CGST</th>
                                            <th class="thdis">SGST</th>
                                            <th class="thdis">IGST</th>
                                            <th class="thdis">Sub Total</th>
                                            <th>Net Value</th>
                                            <th class="thdis">Round off (Net Total)</th>
                                            <th class="thdis">Net Total</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($invoice_no as $key=>$vl)
                                        @if($vl->service_center_state=='TAMILNADU')
                                        @php
                                        $gst_val=($vl->price/100) * $vl->gst;
                                        $off_gst=$gst_val/2;
                                        $full_gst=0;
                                        @endphp
                                        @else
                                        @php
                                        $off_gst=0;
                                        $full_gst=($vl->price/100) * $vl->gst;
                                        @endphp
                                        @endif
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$vl->invoice_no}}</td>
                                            <td>{{basicDateFormat($vl->created_at)}}</td>
                                            <td>{{$vl->call_id}}</td>
                                            <td class="thdis">{{$vl->warranty_type}}</td>
                                            <td>{{$vl->service_type}}</td>
                                              <td>{{$vl->billing_service_center ? $vl->billing_service_center->address:''}}</td>
                                              <td>{{$vl->billing_service_center ? $vl->billing_service_center->gst_no:''}}</td>
                                            <td>{{$vl->service_center_name}}</td>
                                            <td>{{$vl->service_center_address}}</td>
                                            <td class="thdis">{{$vl->service_center_city}}</td>
                                            <td class="thdis">{{$vl->service_center_district}}</td>
                                            <td class="thdis">{{$vl->service_center_state}}</td>
                                            <td>{{$vl->service_center_phone }}</td>
                                            <td class="thdis">{{$vl->model_no }}</td>
                                            <td class="thdis">{{$vl->serial_no }}</td>
                                            <td>{{$vl->part_code }}</td>
                                            <td>{{$vl->part_name }}</td>
                                            <td>{{$vl->hsn_code }}</td>
                                            <td>{{$vl->qty }}</td>
                                            <td>{{number_format($vl->price,2) }}</td>
                                            <td class="thdis">{{$vl->gst }}</td>
                                            <td class="thdis">{{number_format($off_gst,2)}}</td>
                                            <td class="thdis">{{number_format($off_gst,2)}}</td>
                                            <td class="thdis">{{number_format($full_gst,2)}}</td>
                                            <td class="thdis">{{number_format($vl->subtotal,2)}}</td>
                                            <td>{{number_format($vl->total,2)}}</td>
                                            <td class="thdis">{{number_format($vl->round_off,2)}}</td>
                                            <td class="thdis">{{number_format($vl->grand_total,2)}}</td>
                                            <td class="editc">
                                                <a href="{{route('partorder.invoice.stream.pdf',$vl->invoice_no)}}"><i data-placement="top" title="Invoice" class="fa fa-eye" style="color:red"></i></a>
                                                {{-- <a href="{{route('partorder.invoice.edit',$vl->invoice_no)}}"><i  data-placement="top" title="Edit" class="fa fa-edit" style="color:#056c91"></i></a> --}}

                                                <form onsubmit="return confirm('Are you sure you want to delete?');" action="{{ route('partorder.invoice.delete',$vl->invoice_no)}}" method="POST">
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
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26,27,28]
                        }
                    }
                    , {
                        extend: 'csv'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26,27,28]


                        }
                    }
                    , {
                        extend: 'excel'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26,27,28]

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
