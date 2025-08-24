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
            font-size:0rem !important;
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
                                <div  class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="card m-b-20">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h4 style="text-align: right">TAX INVOICE</h4>
                                                    <div class="invoice-title-edit">
                                                        <img style="max-width: 6%;height: 33px;" src="{{asset('login/img/logo1.png')}}" alt="logo">
                                                        <h4 style="font-size: 16px;" class="font-16 pull-right"><strong>Date:{{date('Y-m-d')}}</strong></h4>
                                                        <h4 style="font-size: 16px;" class="font-16 pull-right"><strong>Sale Return Invoice No:{{$partnerinvoice_no[0]->salereturn_no}}</strong></h4>

                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-6 col-sm-12 col-xs-12">
                                                            <address class="bill">
                                                                @php
                                                                $partner_id=$partnerinvoice_no[0]->partner_id;
                                                                $location_id=$partnerinvoice_no[0]->location_id;
                                                                $from= DB::table('distributors')->where('partner_id',$partner_id)->first();
                                                                @endphp
                                                                <strong>From:</strong><br>
                                                                <div class="col-md-12 disp_addrs ">
                                                                    <span class="user_order_add">{{$from->store_name}}</span>
                                                                </div>
                                                                <div class="col-md-12 disp_addrs">
                                                                    <span class="user_order_add">{{ $from->phone }}</span>
                                                                </div>

                                                                <div class="col-md-12 disp_addrs">
                                                                    <span class="user_order_add">{{$partnerinvoice_no[0]->address}}</span>
                                                                </div>


                                                                <div class="col-md-12 disp_addrs">
                                                                    <span style="font-size:14px" class="user_order_add"><b>GSTIN\UIN :</b> {{$from->gstin_no}}</span>
                                                                </div>
                                                            </address>
                                                        </div>

                                                        <div class="col-md-6 col-sm-12 col-xs-12">
                                                            <address class="ship">
                                                                @php
                                                                $delivery_id=$partnerinvoice_no[0]->delivery_id;
                                                                $delivery = DB::table('distributors')->where('partner_id',$delivery_id)->first();
                                                                @endphp

                                                                <strong>Billed To:</strong><br>
                                                                <div class="col-md-12 disp_addrs ">
                                                                    <span class="user_order_add">{{$delivery->name}}</span>
                                                                </div>
                                                                <div class="col-md-12 disp_addrs">
                                                                    <span class="user_order_add">{{ $delivery->phone }}</span>
                                                                </div>

                                                                <div class="col-md-12 disp_addrs">
                                                                    <span class="user_order_add">{{$partnerinvoice_no[0]->delivery_address}}</span>
                                                                </div>


                                                                <div class="col-md-12 disp_addrs">
                                                                    <span style="font-size:14px" class="user_order_add"><b>GSTIN\UIN :</b> {{ $delivery->gstin_no }}</span>
                                                                </div>

                                                            </address>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-3 col-sm-12 col-xs-12 m-t-30 text-center">
                                                            <address>
                                                                <strong style="font-size:15px">Buyer's Order No:</strong><br>

                                                                @php
                                                                $by_order_no=$partnerinvoice_no[0]->by_order_no!='' ?$partnerinvoice_no[0]->by_order_no :$by_order_no='---';
                                                                $date=$partnerinvoice_no[0]->date!='' ? date('Y-m-d',strtotime($partnerinvoice_no[0]->date)):$date='---';
                                                                $ew_bill_no=$partnerinvoice_no[0]->ew_bill_no!='' ? $partnerinvoice_no[0]->ew_bill_no:$ew_bill_no='---';
                                                                $others=$partnerinvoice_no[0]->others!='' ? $partnerinvoice_no[0]->others:$others='---';
                                                                @endphp


                                                                {{ $by_order_no }}
                                                            </address>
                                                        </div>
                                                        <div class="col-md-3 col-sm-12 col-xs-12 text-center m-t-30">
                                                            <address>
                                                                <strong style="font-size:15px">Dated:</strong><br>
                                                                {{ $date }}
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
                                                                                    <th rowspan="2">Model No</th>
                                                                                    <th rowspan="2">HSN-code</th>
                                                                                    <th rowspan="2">Price</th>
                                                                                    <th rowspan="2">Qty</th>
                                                                                    <th rowspan="2">Taxable Value</th>
                                                                                    @if($partnerinvoice_no[0]->state=='TAMILNADU' )
                                                                                    <th colspan="2" style="text-align: center;">CGST</th>
                                                                                    <th colspan="2" style="text-align: center;">SGST</th>
                                                                                    @else
                                                                                    <th colspan="4" style="text-align: center;">IGST</th>
                                                                                    @endif
                                                                                    <th rowspan="2">Total</th>
                                                                                </tr>
                                                                                <tr>
                                                                                    @if($partnerinvoice_no[0]->state=='TAMILNADU' )

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
                                                                                @foreach ($partnerinvoice_no as $key=>$vl)
                                                                                @php
                                                                                $tax=$vl->qty * $vl->total;
                                                                                $gst=$vl->gst;
                                                                                $cgst=$vl->gst/2;
                                                                                $sgst=$vl->gst/2;
                                                                                $gst_value_ch=$tax/(1+($cgst/100));
                                                                                $gst_amount_ch=$tax/(1+($gst/100));
                                                                                $s_list=DB::table('distributorserials')->where('salereturn_no',$partnerinvoice_no[0]->salereturn_no)->where('partnerinvoices_salereturn_id',$vl->id)->where('status','return')->pluck('serial_no')->toArray();

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

                                                                                @endphp

                                                                                <tr>
                                                                                    <td>{{$key+1}}</td>
                                                                                    <td>{{ $vl->model_no}}</td>
                                                                                    <td>{{ $vl->hsn_code }}</td>
                                                                                    <td>{{ number_format($vl->billing_price,2) }}</td>
                                                                                    <td>{{ $vl->qty }}</td>
                                                                                    <td>{{number_format($inctax,2) }}</td>


                                                                                    @if($partnerinvoice_no[0]->state=='TAMILNADU' )
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
                                                                                    <td style="word-break: break-all;" colspan="15">
                                                                                           Description:{{$vl->description}}
                                                                                         <br>
                                                                                        Serial No: {{ implode(",",$s_list) }}

                                                                                    </td>
                                                                                </tr>
                                                                                @endforeach
                                                                                @if ($partnerinvoice_no[0]->tcs!=0)
                                                                                @php
                                                                                $set_total=($sub_total/100)*$partnerinvoice_no[0]->tcs;
                                                                                $net_total=$pay+$set_total;
                                                                                $set_tcs=$partnerinvoice_no[0]->tcs;
                                                                                @endphp
                                                                                @else
                                                                                @php
                                                                                $set_total=0;
                                                                                $net_total=$pay;
                                                                                $set_tcs=0.00;
                                                                                @endphp
                                                                                @endif

                                                                                <tr>
                                                                                    <td colspan="3"></td>
                                                                                    <td>{{$total_qty}}</td>
                                                                                    <td></td>
                                                                                    <td>{{number_format($s_taxable,2)}}</td>
                                                                                    @if($partnerinvoice_no[0]->state=='TAMILNADU' )
                                                                                    <td style="text-align: center" colspan="2">{{number_format($s_gst_off,2)}}</td>
                                                                                    <td style="text-align: center" colspan="2">{{number_format($s_gst_off,2)}}</td>
                                                                                    @else
                                                                                    <td style="text-align: center" colspan="4">{{number_format($s_gst,2)}}</td>
                                                                                    @endif
                                                                                    <td>{{number_format($s_total,2)}}</td>


                                                                                </tr>


                                                                                <tr>
                                                                                    <th rowspan="6" colspan="8"></th>
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
                                                                                    <th colspan="2" class="text-right">TCS ({{$set_tcs}}%)</th>
                                                                                    <th class="text-right">{{number_format($set_total,2)}}</th>


                                                                                </tr>

                                                                                <tr>
                                                                                    <th colspan="2" class="text-right">Round off</th>
                                                                                    <th class="text-right">{{number_format($partnerinvoice_no[0]->round_off,2)}}</th>
                                                                                </tr>

                                                                                <tr>
                                                                                    <th colspan="2" class="text-right">Net Total</th>
                                                                                    <th class="text-right">{{number_format($partnerinvoice_no[0]->grand_total,2)}}</th>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th colspan="12" style="text-transform: uppercase;word-break: break-all;">Amount in words : {{App\Http\Controllers\AdminController::words($partnerinvoice_no[0]->grand_total)}}</th>




                                                                                </tr>
                                                                            </tbody>
                                                                        </table>

                                                                    </div>
                                                                </div>
                                                                <div class="d-print-none">
                                                                    <div class="pull-right">
                                                                        <a href="{{url('dealer_salereturn_stream_pdf/'.$partnerinvoice_no[0]->salereturn_no)}}" target="_blank" class="btn btn-success waves-effect waves-light "></i>Print</a>
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

