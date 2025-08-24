<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>

    <!--=========================*
        Met Data
        *===========================-->
        <meta charset="UTF-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

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

                .ship {
                    font-size: 15px;
                    margin-left: 101px !important;
                }

                .bill {
                    font-size: 15px;
                }

                .pull-right {
                    float: right;
                }

                .invoice-title-edit {
                    display: flex !important;
                    justify-content: space-between !important;
                }

                .invoice-title-edit-dat {
                    display: flex !important;
                    justify-content: flex-end;
                }

                address {
                    margin-bottom: 1rem !important;
                }

                h3 {
                    font-size: 0rem !important;
                    margin-bottom: 0rem !important;
                }

                @page {
                    size: auto;
                    margin: 0;
                }

                @media print {
                    table {
                        page-break-after: auto
                    }

                    tr {
                        page-break-inside: avoid;
                        page-break-after: auto
                    }

                    td {
                        page-break-inside: avoid;
                        page-break-after: auto
                    }

                    thead {
                        display: table-header-group
                    }

                    tfoot {
                        display: table-footer-group
                    }
                }

            </style>
            <link rel="stylesheet" href="{{asset('user/css/bootstrap.min.css')}}">

        </head>

        <body onload="window.print()">


            <!--==================================*
                Main Content Section
                *====================================-->
                <div class="main-content page-content">

                    <!--==================================*
                        Main Section
                        *====================================-->



                        <body class="fixed-left">


                            <div class="content-page">
                                <div class="content">

                                    <div class="page-content-wrapper">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <div class="card m-b-20">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="invoice-title-edit">
                                                                        <img style="max-width: 6%;height: 33px;" src="{{asset('login/img/logo1.png')}}" alt="logo">
                                                                        <h4 style="font-size: 16px;" class="font-16 pull-right"><strong>Date:{{date('Y-m-d')}}</strong></h4>
                                                                        <h4 style="font-size: 16px;" class="pull-right font-16"><strong>Invoice No #{{$row[0]->invoice_no}}</strong></h4>

                                                                    </div>
                                                                    <hr>
                                                                            <div class="row">
                                                                                <div class="col-md-4 col-sm-12 col-xs-12">
                                                                                    <address class="bill">
                                                                                        @php
                                                                                        $partner_id=$row[0]->created_by;
                                                                                        $from = DB::table('admins')->where('partner_id',$partner_id)->first();
                                                                                        @endphp
                                                                                        <strong>From:</strong><br>
                                                                                        <div class="col-md-12 disp_addrs ">
                                                                                            <span class="user_order_add">{{$from->name}}</span>
                                                                                        </div>
                                                                                        <div class="col-md-12 disp_addrs ">
                                                                                            <span class="user_order_add">{{$from->phone}}</span>
                                                                                        </div>

                                                                                        <div class="col-md-12 disp_addrs">
                                                                                            <span class="user_order_add">{{$from->address}}</span>
                                                                                        </div>
                                                                                        <div class="col-md-12 disp_addrs">
                                                                                            <span style="font-size:14px" class="user_order_add"><b>GSTIN\UIN :</b>{{$from->gstin_no}}</span>
                                                                                        </div>
                                                                                        <div class="col-md-12 disp_addrs">
                                                                                            <span style="font-size:14px" class="user_order_add"><b>Call ID :</b>{{$row[0]->call_id}}</span>
                                                                                        </div>

                                                                                    </address>
                                                                                </div>
                                                                                <div class="col-md-4 col-sm-12 col-xs-12">
                                                                                    <address class="ship">
                                                                                        <strong>Billed To:</strong><br>

                                                                                        <div class="col-md-12 disp_addrs">
                                                                                            <span class="user_order_add"><b></b>{{ $row[0]->billing_service_center ? $row[0]->billing_service_center->service_center_name:'' }}</span>
                                                                                        </div>
                                                                                        <div class="col-md-12 disp_addrs">
                                                                                            <span class="user_order_add">{{ $row[0]->billing_service_center ? $row[0]->billing_service_center->phone:'' }}</span>
                                                                                        </div>

                                                                                        <div class="col-md-12 disp_addrs">
                                                                                            <span class="user_order_add">{{$row[0]->billing_service_center ? $row[0]->billing_service_center->address:''}} </span>
                                                                                        </div>
                                                                                        <div class="col-md-12 disp_addrs">
                                                                                            <span style="font-size:14px" class="user_order_add"><b>GSTIN\UIN :</b>{{$row[0]->billing_service_center ? $row[0]->billing_service_center->gstin_no!='null' ? $row[0]->billing_service_center->gstin_no:'' :''}}</span>

                                                                                        </div>



                                                                                    </address>
                                                                                </div>
                                                                                <div class="col-md-4 col-sm-12 col-xs-12">
                                                                                    <address class="ship">
                                                                                        <strong>Shipped To:</strong><br>

                                                                                        <div class="col-md-12 disp_addrs">
                                                                                            <span class="user_order_add"><b></b>{{ $row[0]->delivery_service_center ? $row[0]->delivery_service_center->service_center_name:'' }}</span>
                                                                                        </div>
                                                                                        <div class="col-md-12 disp_addrs">
                                                                                            <span class="user_order_add">{{ $row[0]->delivery_service_center ? $row[0]->delivery_service_center->phone:'' }}</span>
                                                                                        </div>

                                                                                        <div class="col-md-12 disp_addrs">
                                                                                            <span class="user_order_add">{{$row[0]->delivery_service_center ? $row[0]->delivery_service_center->address:''}} </span>
                                                                                        </div>
                                                                                        <div class="col-md-12 disp_addrs">
                                                                                            <span style="font-size:14px" class="user_order_add"><b>GSTIN\UIN :</b>{{$row[0]->delivery_service_center ? $row[0]->delivery_service_center->gstin_no!='null' ? $row[0]->delivery_service_center->gstin_no:'' :''}}</span>




                                                                                        </div>



                                                                                    </address>
                                                                                </div>

                                                                            </div>

                                                                    @php
                                                                    $date=$row[0]->created_at!='' ? {{basicDateFormat($row[0]->created_at)}}:$date='---';

                                                                    @endphp
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="panel panel-default">
                                                                                <div class="p-2">
                                                                                    <h3 class="panel-title font-20"><strong style="font-size:18px">Order Summary</strong></h3>
                                                                                </div>
                                                                                <div class="col-md-12">
                                                                                    <div class="col-md-2" style="padding: 0px;margin-top: 6px;">
                                                                                        <label>Product Details :</label>
                                                                                    </div>

                                                                                </div>

                                                                                <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12 overflow-div padd_lef_rgt">
                                                                                    <div class="table-responsive">
                                                                                        <table border="1" class="table borderclr table-bordered">
                                                                                            <thead>
                                                                                                <tr>
                                                                                                    <th rowspan="2">S.No</th>
                                                                                                    {{-- <th rowspan="2">Part Code</th> --}}
                                                                                                    <th rowspan="2">Part Category</th>
                                                                                                    <th rowspan="2">Part name</th>
                                                                                                    <th rowspan="2">HSN-CODE</th>
                                                                                                    <th rowspan="2">Price</th>
                                                                                                    <th rowspan="2">Qty</th>
                                                                                                    <th rowspan="2">Taxable Value</th>
                                                                                                    @if($row[0]->service_center_state=='TAMILNADU' )
                                                                                                    <th colspan="2" style="text-align: center;">CGST</th>
                                                                                                    <th colspan="2" style="text-align: center;">SGST</th>
                                                                                                    @else
                                                                                                    <th colspan="4" style="text-align: center;">IGST</th>
                                                                                                    @endif
                                                                                                    <th rowspan="2">Price</th>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    @if($row[0]->service_center_state=='TAMILNADU' )

                                                                                                    <th>Rate</th>
                                                                                                    <th>Amount</th>
                                                                                                    <th>Rate</th>
                                                                                                    <th>Amount</th>
                                                                                                    @else

                                                                                                    <th colspan="2">Rate</th>
                                                                                                    <th colspan="2">Amount</th>
                                                                                                    @endif
                                                                                                </tr>
                                                                                            </thead>
                                                                                            <tbody>

                                                                                                @php
                                                                                                $sub_total=0;
                                                                                                $sub_gst=0;
                                                                                                $total_qty=0;

                                                                                                $pay=0;
                                                                                                $s_taxable=0;
                                                                                                $s_gst=0;
                                                                                                $s_gst_off=0;
                                                                                                $s_total=0;
                                                                                                @endphp
                                                                                                @foreach ($row as $key=>$vl)
                                                                                                @php
                                                                                                $tax=$vl->qty * $vl->price;
                                                                                                $gst=$vl->gst;
                                                                                                $cgst=$vl->gst/2;
                                                                                                $sgst=$vl->gst/2;
                                                                                                $gst_value_ch=($tax/100)*$cgst;
                                                                                                $gst_amount_ch=($tax/100)*$gst;

                                                                                                $gst_value=$tax+$gst_value_ch;
                                                                                                $gst_amount=$tax+$gst_amount_ch;

                                                                                                $sub_gst+=$gst_amount_ch;

                                                                                                $total_qty+=$vl->qty;


                                                                                                $inctax=$gst_amount_ch;

                                                                                                $sub_total+=$tax;

                                                                                                $off_gst=$gst_amount_ch/2;

                                                                                                $off_gst_val=$off_gst;


                                                                                                $pay+=$gst_amount;
                                                                                                $s_taxable+=$tax;
                                                                                                $s_gst+=$gst_amount;
                                                                                                $s_gst_off+=$off_gst;
                                                                                                $s_total+=$gst_amount;

                                                                                                @endphp

                                                                                                <tr>
                                                                                                    <td>{{$key+1}}</td>
                                                                                                    {{-- <td>{{ $vl->part_code}}</td> --}}
                                                                                                    <td>{{ $vl->part_category}}</td>
                                                                                                    <td>{{ $vl->part_name}}</td>
                                                                                                    <td>{{ $vl->hsn_code}}</td>
                                                                                                    <td>{{ number_format($vl->price,2) }}</td>
                                                                                                    <td>{{ $vl->qty }}</td>
                                                                                                    <td>{{number_format($vl->qty*$vl->price,2) }}</td>


                                                                                                    @if($row[0]->service_center_state=='TAMILNADU' )
                                                                                                    <td>{{ $cgst}} %</td>
                                                                                                    <td>{{number_format($off_gst_val,2)}}</td>
                                                                                                    <td>{{ $sgst}} %</td>
                                                                                                    <td>{{number_format($off_gst_val,2)}}</td>
                                                                                                    @else
                                                                                                    <td colspan="2">{{ $gst}} %</td>
                                                                                                    <td colspan="2">{{number_format($gst_amount_ch,2)}}</td>
                                                                                                    @endif

                                                                                                    <td>{{number_format($gst_amount,2)}}</td>
                                                                                                </tr>

                                                                                                @endforeach

                                                                                                <tr>
                                                                                                    <td colspan="4"></td>
                                                                                                    <td></td>
                                                                                                    <td>{{$total_qty}}</td>
                                                                                                    <td>{{number_format($s_taxable,2)}}</td>
                                                                                                    @if($row[0]->service_center_state=='TAMILNADU' )
                                                                                                    <td style="text-align: center" colspan="2">{{number_format($s_gst_off,2)}}</td>
                                                                                                    <td style="text-align: center" colspan="2">{{number_format($s_gst_off,2)}}</td>
                                                                                                    @else
                                                                                                    <td style="text-align: center" colspan="4">{{number_format($s_gst,2)}}</td>
                                                                                                    @endif
                                                                                                    <td>{{number_format($s_total,2)}}</td>


                                                                                                </tr>

                                                                                                <tr>
                                                                                                    <th rowspan="5" colspan="9"></th>
                                                                                                    <th colspan="2" class="text-right">Qty</th>
                                                                                                    <th class="text-right">{{ $total_qty }}</th>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <th colspan="2" class="text-right">Sub Total</th>
                                                                                                    <th class="text-right">{{number_format($sub_total,2)}}</th>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <th colspan="2" class="text-right">GST</th>

                                                                                                    <th class="text-right">{{number_format($sub_gst,2)}}</th>
                                                                                                </tr>

                                                                                                <tr>
                                                                                                    <th colspan="2" class="text-right">Round off</th>
                                                                                                    <th class="text-right">{{number_format($row[0]->round_off,2)}}</th>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <th colspan="2" class="text-right">Net Total</th>
                                                                                                    <th class="text-right">{{number_format($row[0]->grand_total,2)}}</th>

                                                                                                </tr>
                                                                                                <tr>

                                                                                                    <th colspan="12" style="text-transform: uppercase;word-break: break-all;">Amount in words : {{App\Http\Controllers\AdminController::words($row[0]->grand_total)}}</th>




                                                                                                </tr>

                                                                                            </tbody>


                                                                                        </table>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="d-print-none">
                                                                                    <div class="pull-right">
                                                                                        <a href="{{url('partorder_invoice_stream_pdf/'.$row[0]->invoice_no)}}" target="_blank" class="btn btn-success waves-effect waves-light "></i>Print</a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </body>

                    </html>
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
                                margin-top: 21px;

                            }

                        </style>
                        <!--=================================*
                            Footer Section
                            *===================================-->

                            <!--=================================*
                                End Footer Section
                                *===================================-->

                            </div>
                            <!--=========================*
                                End Page Container
                                *===========================-->




                                <script src="{{asset('user/vendors/data-table/js/jquery.dataTables.js')}}"></script>
                                <script src="{{asset('user/vendors/data-table/js/jquery.dataTables.min.js')}}"></script>
                                <script src="{{asset('user/vendors/data-table/js/dataTables.bootstrap4.min.js')}}"></script>
                                <script src="{{asset('user/vendors/data-table/js/dataTables.responsive.min.js')}}"></script>
                                <script src="{{asset('user/vendors/data-table/js/responsive.bootstrap.min.js')}}"></script>

                                <!-- Data table Init -->
                                <script src="{{asset('user/js/init/data-table.js')}}"></script>


                                <!--=========================*
                                    Scripts
                                    *===========================-->


                                </body>

                                </html>
