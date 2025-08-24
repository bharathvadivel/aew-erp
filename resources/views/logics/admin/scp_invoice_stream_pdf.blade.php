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

        .invoice-title-edit-new {
            display: flex !important;
            justify-content: center;
        }

        address {
            margin-bottom: 1rem !important;
        }

        h3 {
            font-size: 0rem !important;
            margin-bottom: 0rem !important;
        }

        hr {
            margin-top: unset !important;
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
                                                @php
                                                $login_id=$scpinvoices[0]->created_by;
                                                $from = DB::table('admins')->where('partner_id',$login_id)->first();
                                                @endphp
                                                @if ($from)
                                                @php
                                                $from = DB::table('admins')->where('partner_id',$login_id)->first();
                                                @endphp
                                                @else
                                                @php
                                                $from = DB::table('warehouses')->where('warehouse_id',$login_id)->first();
                                                @endphp
                                                @endif

                                                <div class="col-md-12">
                                                    <h4 style="text-align: right">TAX INVOICE</h4>

                                                    <div class="invoice-title-edit">
                                                        <img style="width: 8%;height: 32px;" src="{{asset('login/img/logo1.png')}}" alt="logo">
                                                        <h4 style="font-size: 19px;margin:-5px 0px 0px 100px" class="font-16"><strong>{{$from->name}}</strong></h4>
                                                        <h4 style="font-size: 16px;" class="font-16 pull-right"><strong>Invoice No:{{$scpinvoices[0]->scp_invoice_no}}</strong></h4>
                                                    </div>
                                                    <div class="invoice-title-edit-new">
                                                        <h4 style="font-size: 13px;" class="font-16 pull-right">{{$from->address}}</h4>
                                                    </div>

                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                                            <address class="bill">
                                                                @php
                                                                $login_id=$scpinvoices[0]->created_by;
                                                                $from = DB::table('admins')->where('partner_id',$login_id)->first();
                                                                @endphp
                                                                @if ($from)
                                                                @php
                                                                $from = DB::table('admins')->where('partner_id',$login_id)->first();
                                                                @endphp
                                                                @else
                                                                @php
                                                                $from = DB::table('warehouses')->where('warehouse_id',$login_id)->first();
                                                                @endphp
                                                                @endif
                                                                <strong>From:</strong><br>
                                                                <div class="col-md-12 disp_addrs ">
                                                                    <span class="user_order_add">{{$from->name}}</span>
                                                                </div>


                                                                <div class="col-md-12 disp_addrs">
                                                                    <span class="user_order_add">{{$from->address}}</span>
                                                                </div>
                                                                <div class="col-md-12 disp_addrs">
                                                                    <span class="user_order_add"><b>State Code</b>: 33</span>
                                                                </div>

                                                                <div class="col-md-12 disp_addrs">
                                                                    <span style="font-size:14px" class="user_order_add"><b>GSTIN\UIN :</b> {{$from->gstin_no}}</span>
                                                                </div>
                                                                <div class="col-md-12 disp_addrs">
                                                                    <span class="user_order_add"><b>PH :</b> {{ $from->phone }}</span>
                                                                </div>

                                                            </address>
                                                        </div>
                                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                                            <address class="bill">
                                                                @php
                                                                $scp_id=$scpinvoices[0]->scp_id;
                                                                $location_id=$scpinvoices[0]->location_id;
                                                                $billto = DB::table('services')->where('service_id',$scp_id)->first();
                                                                $billto_location = DB::table('userlocations')->where('partner_id',$scp_id)->where('location_id',$location_id)->first();
                                                                @endphp
                                                                <strong>Billed To:</strong><br>
                                                                <div class="col-md-12 disp_addrs ">
                                                                    <span class="user_order_add">{{$billto->service_center_name}}</span>
                                                                </div>


                                                                <div class="col-md-12 disp_addrs">
                                                                    <span class="user_order_add">@if($billto_location) {{$billto_location->address}} @endif</span>
                                                                </div>


                                                                <div class="col-md-12 disp_addrs">
                                                                    <span style="font-size:14px" class="user_order_add"><b>GSTIN\UIN :</b> {{$billto->gstin_no}}</span>
                                                                </div>
                                                                <div class="col-md-12 disp_addrs">
                                                                    <span class="user_order_add"><b>PH :</b> {{ $billto->phone }}</span>
                                                                </div>

                                                            </address>
                                                        </div>
                                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                                            <address class="ship">
                                                                @php
                                                                $scp_id=$scpinvoices[0]->scp_id;
                                                                $delivery_location_id=$scpinvoices[0]->delivery_location_id;
                                                                $shipped= DB::table('services')->where('service_id',$scp_id)->first();
                                                                $shipped_location = DB::table('userlocations')->where('partner_id',$scp_id)->where('location_id',$delivery_location_id)->first();
                                                                @endphp
                                                                <strong>Shipped To:</strong><br>

                                                                <div class="col-md-12 disp_addrs">
                                                                    <span class="user_order_add">@if($shipped_location) {{$shipped_location->address}} @else  {{ $disinvoices[0]->new_delivery_address}} @endif</span>
                                                                </div>


                                                                <div class="col-md-12 disp_addrs">
                                                                    <span style="font-size:14px" class="user_order_add"><b>GSTIN\UIN :</b> {{ $shipped->gstin_no }}</span>
                                                                </div>
                                                                <div class="col-md-12 disp_addrs">
                                                                    <span class="user_order_add"><b>PH :</b> {{ $shipped->phone }}</span>
                                                                </div>


                                                            </address>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        @php
                                                        $by_order_no=$scpinvoices[0]->by_order_no!='' ?$scpinvoices[0]->by_order_no :$by_order_no='---';
                                                        $date=$scpinvoices[0]->date!='' ? date('d-m-Y',strtotime($scpinvoices[0]->date)):$date='---';
                                                        $ew_bill_no=$scpinvoices[0]->ew_bill_no!='' ? $scpinvoices[0]->ew_bill_no:$ew_bill_no='---';
                                                        $others=$scpinvoices[0]->others!='' ? $scpinvoices[0]->others:$others='---';
                                                        @endphp
                                                        <div class="col-md-3 col-sm-12 col-xs-12 text-center m-t-30">
                                                            <address>
                                                                <strong style="font-size:15px">Dated:</strong><br>
                                                                {{ $date }}
                                                            </address>
                                                        </div>


                                                        <div class="col-md-3 col-sm-12 col-xs-12 m-t-30 text-center">
                                                            <address>
                                                                <strong style="font-size:15px">Buyer's Order No:</strong><br>




                                                                {{ $by_order_no }}
                                                            </address>
                                                        </div>

                                                        <div class="col-md-3 col-sm-12 col-xs-12 m-t-30 text-center">
                                                            <address>
                                                                <strong style="font-size:15px">Eway Bill No:</strong><br>
                                                                {{ $ew_bill_no }}
                                                            </address>
                                                        </div>
                                                        <div class="col-md-3 col-sm-12 col-xs-12 m-t-30 text-center">
                                                            <address>
                                                                <strong style="font-size:15px">Vehicle Number/Others:</strong><br>

                                                                {{$others}}
                                                            </address>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="panel panel-default">
                                                                <div class="p-2">
                                                                    <h3 class="panel-title font-20"><strong style="font-size:18px">Description of Goods</strong></h3>

                                                                </div>

                                                                <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12 overflow-div padd_lef_rgt">
                                                                    <div class="table-responsive">
                                                                        <table border="1" class="table borderclr table-bordered">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th rowspan="2">S.No</th>
                                                                                    <th rowspan="2">Model No</th>
                                                                                    <th rowspan="2">HSN-code</th>
                                                                                    <th rowspan="2">Unit Price (&#8377;)</th>
                                                                                    <th rowspan="2">Qty</th>
                                                                                    {{-- <th rowspan="2">Discount</th> --}}
                                                                                    <th style="white-space: nowrap" rowspan="2">Taxable Value (&#8377;)</th>
                                                                                    @if($scpinvoices[0]->state=='TAMILNADU' )
                                                                                    <th colspan="2" style="text-align: center;">CGST</th>
                                                                                    <th colspan="2" style="text-align: center;">SGST</th>
                                                                                    @else
                                                                                    <th colspan="4" style="text-align: center;">IGST</th>
                                                                                    @endif
                                                                                    <th style="white-space: nowrap" rowspan="2">Net Price (&#8377;)</th>
                                                                                </tr>
                                                                                <tr>
                                                                                    @if($scpinvoices[0]->state=='TAMILNADU' )
                                                                                    <th>Rate</th>
                                                                                    <th style="white-space: nowrap">Amount (&#8377;)</th>
                                                                                    <th>Rate</th>
                                                                                    <th style="white-space: nowrap">Amount (&#8377;)</th>
                                                                                    @else

                                                                                    <th colspan="2">Rate</th>
                                                                                    <th style="white-space: nowrap" colspan="2">Amount (&#8377;)</th>
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
                                                                                $set_tcs_total=0;
                                                                                @endphp
                                                                                @foreach ($scpinvoices as $key=>$vl)
                                                                                @php
                                                                                $newPro=DB::table('products')->where('model_no',$vl->model_no)->first();
                                                                                $tax=$vl->qty * $vl->total;
                                                                                $gst=$vl->gst;
                                                                                $cgst=$vl->gst/2;
                                                                                $sgst=$vl->gst/2;
                                                                                $gst_value_ch=$tax/(1+($cgst/100));
                                                                                $gst_amount_ch=$tax/(1+($gst/100));
                                                                                $s_list=DB::table('scp_serials')->where('scp_invoice_id',$vl->id)->pluck('serial_no')->toArray();


                                                                                $gst_value=$tax-$gst_value_ch;
                                                                                $gst_amount=$tax-$gst_amount_ch;


                                                                                $sub_gst+=$gst_amount;

                                                                                $total_qty+=$vl->qty;


                                                                                $inctax=$vl->taxable_value;

                                                                                $sub_total+=$inctax;

                                                                                $off_gst=$gst_amount/2;

                                                                                $off_gst_val=$off_gst;


                                                                                $pay+=$tax;


                                                                                $s_taxable+=$inctax;
                                                                                $s_gst+=$gst_amount;
                                                                                $s_gst_off+=$off_gst;
                                                                                $s_total+=$tax;
                                                                                $dicountprice=$vl->billing_price-$vl->additional_discount;

                                                                                $set_tcs_total+=$vl->tcs_val;
                                                                                @endphp

                                                                                <tr>
                                                                                    <td>{{$key+1}}</td>
                                                                                    <td>{{ $vl->model_no}}</td>
                                                                                    <td>{{ $newPro->hsn_code }}</td>
                                                                                    <td>{{ number_format($dicountprice,2) }}</td>
                                                                                    <td>{{ $vl->qty }}</td>
                                                                                    {{-- <td>{{ number_format($vl->additional_discount,2) }}</td> --}}
                                                                                    <td>{{number_format($inctax,2) }}</td>


                                                                                    @if($scpinvoices[0]->state=='TAMILNADU' )
                                                                                    <td>{{ $cgst}} %</td>
                                                                                    <td>{{number_format($off_gst_val,2)}}</td>
                                                                                    <td>{{ $sgst}} %</td>
                                                                                    <td>{{number_format($off_gst_val,2)}}</td>
                                                                                    @else
                                                                                    <td colspan="2">{{ $gst}} %</td>
                                                                                    <td colspan="2">{{number_format($gst_amount,2)}}</td>
                                                                                    @endif

                                                                                    <td>{{number_format($tax,2)}}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td style="word-break: break-all;" colspan="11">
                                                                                        Description:{{$newPro->description}}
                                                                                        <br>
                                                                                        Serial No: {{ implode(",",$s_list) }}

                                                                                    </td>
                                                                                </tr>
                                                                                @endforeach
                                                                                @if ($scpinvoices[0]->tcs!=0)
                                                                                @php
                                                                                $set_total=$set_tcs_total;
                                                                                $net_total=$pay+$set_total;
                                                                                $set_tcs=$scpinvoices[0]->tcs."%";
                                                                                @endphp
                                                                                @else
                                                                                @php
                                                                                $set_total=0;
                                                                                $net_total=$pay;
                                                                                $set_tcs="NA";
                                                                                @endphp
                                                                                @endif
                                                                                @php
                                                                                $round_off=round($net_total)-$net_total;
                                                                                @endphp
                                                                                <tr>
                                                                                    <td colspan="3"></td>
                                                                                    <td></td>
                                                                                    <td>{{$total_qty}}</td>
                                                                                    <td>{{number_format($s_taxable,2)}}</td>
                                                                                    @if($scpinvoices[0]->state=='TAMILNADU' )
                                                                                    <td style="text-align: center" colspan="2">{{number_format($s_gst_off,2)}}</td>
                                                                                    <td style="text-align: center" colspan="2">{{number_format($s_gst_off,2)}}</td>
                                                                                    @else
                                                                                    <td style="text-align: center" colspan="4">{{number_format($s_gst,2)}}</td>
                                                                                    @endif
                                                                                    <td>{{number_format($s_total,2)}}</td>


                                                                                </tr>
                                                                                <tr>
                                                                                    {{-- <th rowspan="3" align="center" colspan="9"></th> --}}
                                                                                    <th style="line-height: 25px;font-weight: normal;" rowspan="3" colspan="8">Declaration: We declare that this invoice shows the actual price of the goods described
                                                                                        and that all particulars are true and correct.
                                                                                        We had received the goods as per the ordered quantity & in Good Condition. We
                                                                                        accept / agree to pay the company for this invoice on a credit of 30 days without any
                                                                                        interest and/or credit period between 30 days to 90 days with an additional 2% interest
                                                                                        per Month. I/We unconditionally agree to pay for the invoice in the above terms.
                                                                                        <br> This is a computer generated invoice. Subjected to the Coimbatore judiciary</th>



                                                                                    <th colspan="2" class="text-right">Qty</th>
                                                                                    <th class="text-right">{{ $total_qty }}</th>
                                                                                </tr>
                                                                                <tr>

                                                                                    <th colspan="2" class="text-right">Sub Total (&#8377;)</th>
                                                                                    <th class="text-right">{{number_format($sub_total,2)}}</th>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th colspan="2" class="text-right">GST (&#8377;)</th>

                                                                                    <th class="text-right">{{number_format($sub_gst,2)}}</th>
                                                                                </tr>

                                                                                <tr>


                                                                                    <th style="text-align:end" rowspan="2" colspan="8">{{$from->name}}
                                                                                    </th>



                                                                                    <th colspan="2" class="text-right">TCS ({{$set_tcs}}) (&#8377;)</th>
                                                                                    <th class="text-right">{{number_format($set_total,2)}}</th>


                                                                                </tr>
                                                                                <tr>
                                                                                    <th colspan="2" class="text-right">Round off (&#8377;)</th>
                                                                                    <th class="text-right">{{number_format($scpinvoices[0]->round_off,2)}}</th>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th style="text-align:end;border-top: 2px solid #FFFFFF !important;" rowspan="1" colspan="8">Authorised Signatory

                                                                                    </th>

                                                                                    <th colspan="2" class="text-right">Net Total (&#8377;)</th>
                                                                                    <th class="text-right">{{number_format($scpinvoices[0]->grand_total,2)}}</th>

                                                                                </tr>




                                                                                <tr>
                                                                                    <th colspan="11" style="text-transform: uppercase;word-break: break-all;">Amount in words : {{App\Http\Controllers\AdminController::words($scpinvoices[0]->grand_total)}} ONLY</th>


                                                                                </tr>


                                                                            </tbody>



                                                                        </table>
                                                                    </div>
                                                                </div>
                                                                <div class="d-print-none">
                                                                    <div class="pull-right">
                                                                        <a href="{{route('generate.scpinvoice.pdf',$scpinvoices[0]->scp_invoice_no)}}" target="_blank" class="btn btn-success waves-effect waves-light "></i>Print</a>
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

