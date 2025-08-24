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
    <title>ERP - Invoice - {{$invoice_no}}</title>
    <link rel="stylesheet" href="{{asset('user/css/bootstrap.min.css')}}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Include jQuery from CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    
    <style>
        body{
            font-family: 'Inter', sans-serif;
        }
        .row{
            margin: 0px!important;
        }
        .col, .col-1, .col-10, .col-11, .col-12, .col-2, .col-3, .col-4, .col-5, .col-6, .col-7, .col-8, .col-9, .col-auto, .col-lg, .col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-lg-auto, .col-md, .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-auto, .col-sm, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-auto, .col-xl, .col-xl-1, .col-xl-10, .col-xl-11, .col-xl-12, .col-xl-2, .col-xl-3, .col-xl-4, .col-xl-5, .col-xl-6, .col-xl-7, .col-xl-8, .col-xl-9, .col-xl-auto{
            padding: 0px!important;
        }
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
        p{
            margin-bottom:0px!important;
        }

        hr {
            margin-top: unset !important;
        }

        @page {
            size: auto;
            margin: 0;
        }

        @media print {
            body {
                -webkit-print-color-adjust: exact!important;
                color-adjust: exact;
            }
            table {
                page-break-after: auto;
                -webkit-print-color-adjust: exact;
                color-adjust: exact;
                border: 1px solid #8b93a3!important; /* Add border styling */
            }
            tr {
                page-break-inside: avoid;
                page-break-after: auto;
                -webkit-print-color-adjust: exact;
                color-adjust: exact;
                border: 1px solid #8b93a3!important; /* Add border styling */
            }
            td {
                page-break-inside: avoid;
                page-break-after: auto;
                -webkit-print-color-adjust: exact;
                color-adjust: exact;
                border: 1px solid #8b93a3!important; /* Add border styling */
                padding: 5px!important;
            }
        }

    </style>
</head>

<body onload="printAndClose()">

    <!--==================================*
        Main Content Section
    *====================================-->
    <div class="main-content page-content">

        <!--==================================*
            Main Section
        *====================================-->
        <div style="padding: 2%;font-size:14px;">
            <div class="content-page">
                <div class="content">

                    <div class="page-content-wrapper">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="row">
                                        <div class="col-md-12" style="height:170px;"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <p style="text-align: center;font-size: 16px;font-weight:700;">TAX INVOICE</p>
                                            <p style="text-align: right;font-size: 14px;">(BUYER COPY)</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            @php
                                                $getCustomer = DB::table('contacts')->where('id', $invoices->customer_id)->first();
                                                $getFY = DB::table('financial_years')->orderby('id', 'desc')->first();
                                            @endphp
                                            <table class="table" style="width: 100%; vertical-align: middle;">
                                                <tr>
                                                    <td colspan="2" rowspan="3">
                                                        <span style="font-size: 14px;">
                                                            <p style="margin-bottom: 0px;font-weight:400;">
                                                                <span style="font-size: 14px;font-weight:700;">Criar Solutions Private Limited - {{$getFY->fy_start_year}}-{{$getFY->fy_end_year}}</span><br>
                                                                <span>Coimbatore - 641029.</span>
                                                            </p>
                                                        </span>
                                                    </td>
                                                    <td colspan="3">
                                                        <span style="font-size: 12px;">Invoice No</span><br/>
                                                        <span style="font-size: 14px;"><strong>{{$invoice_no}}</strong></span>
                                                    </td>
                                                    <td colspan="3">
                                                        <span style="font-size: 12px;">Invoice Date</span><br/>
                                                        <span style="font-size: 14px;"><strong>{{date('d-m-Y', strtotime($invoices->invoice_date))}}</strong></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3">
                                                        <span style="font-size: 12px;">Delivery Note</span><br/>
                                                        <span style="font-size: 14px;"><strong>{{$invoices->delivery_note}}</strong></span>
                                                    </td>
                                                    <td colspan="3">
                                                        <span style="font-size: 12px;">Mode/Terms of Payment</span><br/>
                                                        <span style="font-size: 14px;"><strong>{{$invoices->terms_of_payment}}</strong></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3">
                                                        <span style="font-size: 12px;">Buyer's Order No</span><br/>
                                                        <span style="font-size: 14px;"><strong>{{$invoices->buyer_order_no}}</strong></span>
                                                    </td>
                                                    <td colspan="3">
                                                        <span style="font-size: 12px;">Buyer's Order Dated</span><br/>
                                                        <span style="font-size: 14px;"><strong>{{ $invoices->buyer_order_date ? date('d-m-Y', strtotime($invoices->buyer_order_date)) : '' }}</strong></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" rowspan="3">
                                                        <span>Buyer (Bill To):</span><br/>
                                                        <span style="font-size: 14px;">
                                                            <p style="margin-bottom: 0px;font-weight:400;">
                                                                <span style="font-size: 14px;font-weight:700;">{{$getCustomer->customer_name}}</span><br>
                                                                <span>{{$getCustomer->customer_billing_address}}</span><br>
                                                                <span>Phone: {{$getCustomer->customer_mobile_no}}</span><br>
                                                                <span>GST No. : {{$getCustomer->customer_gst_no}}</span><br>
                                                                <span>State Code : {{$getCustomer->state_code}}</span>
                                                            </p>
                                                        </span>
                                                    </td>
                                                    <td colspan="3">
                                                        <span style="font-size: 12px;">Dispatch Doc No</span><br/>
                                                        <span style="font-size: 14px;"><strong>{{$invoices->dispatch_doc_no}}</strong></span>
                                                    </td>
                                                    <td colspan="3">
                                                        <span style="font-size: 12px;">Delivery Note Date</span><br/>
                                                        <span style="font-size: 14px;"><strong>{{ $invoices->delivery_note_date ? date('d-m-Y', strtotime($invoices->delivery_note_date)) : '' }}</strong></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3">
                                                        <span style="font-size: 12px;">Dispatch Through</span><br/>
                                                        <span style="font-size: 14px;"><strong>{{$invoices->dispatch_through}}</strong></span>
                                                    </td>
                                                    <td colspan="3">
                                                        <span style="font-size: 12px;">Destination</span><br/>
                                                        <span style="font-size: 14px;"><strong>{{$invoices->destination}}</strong></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="6">
                                                        <span style="font-size: 12px;">Terms of Delivery</span><br/>
                                                        <span style="font-size: 14px;"><strong>{{$invoices->terms_of_delivery}}</strong></span>
                                                    </td>
                                                </tr>

                                                <!-- Items Listing -->
                                                <tr>
                                                    <td style="font-size: 12px;text-align: center;width:15px;">S.No.</td>
                                                    <td style="font-size: 12px;text-align: center;">Description of Goods</td>
                                                    <td style="font-size: 12px;text-align: center;">HSN/SAC</td>
                                                    <td style="font-size: 12px;text-align: center;">Qty</td>
                                                    <td style="font-size: 12px;text-align: center;">Per UoM</td>
                                                    <td style="font-size: 12px;text-align: center;">Rate</td>
                                                    <td style="font-size: 12px;text-align: center;">GST %</td>
                                                    <td style="font-size: 12px;text-align: center;">Amount</td>
                                                </tr>
                                                @php
                                                    $indetail = DB::table('invoice_details')->where('invoice_no',$invoice_no)->get();
                                                    $totalQty = $indetail->sum('item_qty');
                                                    $totalRate = $indetail->sum('item_price');
                                                    $totalSubTotal = $indetail->sum('item_sub_total');
                                                @endphp
                                                @foreach ($indetail as $key=>$vl)
                                                <tr>
                                                    <td style="font-size: 12px;text-align: center;">{{$key+1}}</td>
                                                    <td style="font-size: 12px;text-align: left;">
                                                        <strong>{{$vl->item_code}} - {{$vl->item_desc}}</strong>
                                                        @if(!empty($vl->item_add_desc))
                                                            <br>{{$vl->item_add_desc}}
                                                        @endif
                                                    </td>
                                                    <td style="font-size: 12px;text-align: center;">{{$vl->item_hsnsac_code}}</td>
                                                    <td style="font-size: 12px;text-align: center;">{{$vl->item_qty}}</td>
                                                    <td style="font-size: 12px;text-align: center;">{{$vl->item_uom}}</td>
                                                    <td style="font-size: 12px;text-align: right;">{{$vl->item_price}}</td>
                                                    <td style="font-size: 12px;text-align: center;">{{$vl->item_gst_percent}} %</td>
                                                    <td style="font-size: 12px;text-align: right;">{{$vl->item_sub_total}}</td>
                                                </tr>
                                                @endforeach

                                                <!-- Amount Charged Calculation -->
                                                @php
                                                    $invtaxsums = DB::table('invoice_details')->where('invoice_no',$invoice_no)->get();
                                                    $totalRate = $invtaxsums->sum('item_price');

                                                    $sumTaxableValue = $invtaxsums->sum('item_sub_total');

                                                    $sumCGSTPercentage = $invtaxsums->avg('central_gst_percent');
                                                    $sumCGSTAmount = $invtaxsums->sum('central_tax_amount');
                                                    
                                                    $sumSGSTPercentage = $invtaxsums->avg('state_gst_percent');
                                                    $sumSGSTAmount = $invtaxsums->sum('state_tax_amount');
                                                    
                                                    $sumIGSTPercentage = $sumCGSTPercentage+$sumSGSTPercentage;
                                                    $sumIGSTAmount = $sumSGSTAmount+$sumCGSTAmount;

                                                    $sumTaxAmount = $invtaxsums->sum('tax_amount');

                                                    $getNetTotal = DB::table('invoices')->where('invoice_no',$invoice_no)->first();
                                                    $NetAmount = $getNetTotal->net_total;
                                                @endphp

                                                @if($getCustomer->state_code == 33)
                                                    <tr>
                                                        <td colspan="2" style="text-align: right;">
                                                            <br>
                                                            <span style="font-size: 14px;"><strong>OUTPUT CGST @ {{$sumCGSTPercentage}}%</strong></span><br>
                                                            <span style="font-size: 14px;"><strong>OUTPUT SGST @ {{$sumSGSTPercentage}}%</strong></span><br>
                                                            @if($getNetTotal->round_off_value != '' && $getNetTotal->round_off_value != 0)
                                                            <span style="font-size: 14px;"><strong>ROUNDED OF</strong></span>
                                                            @endif
                                                        </td>
                                                        <td colspan="6" style="text-align: right;">
                                                            <span style="font-size: 14px;">{{number_format($sumTaxableValue,2, '.', '')}}</span><br>
                                                            <span style="font-size: 14px;"><strong>{{number_format($sumCGSTAmount,2, '.', '')}}</strong></span><br>
                                                            <span style="font-size: 14px;"><strong>{{number_format($sumSGSTAmount,2, '.', '')}}</strong></span><br>
                                                            @if($getNetTotal->round_off_value != '' && $getNetTotal->round_off_value != 0)
                                                            <span style="font-size: 14px;"><strong>{{$getNetTotal->round_off_value,2, '.', ''}}</strong></span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @else
                                                    <tr>
                                                        <td colspan="2" style="text-align: right;">
                                                            <br>
                                                            <span style="font-size: 14px;"><strong>OUTPUT IGST @ {{$sumIGSTPercentage}}%</strong></span><br>
                                                            @if($getNetTotal->round_off_value != '' && $getNetTotal->round_off_value != 0)
                                                            <span style="font-size: 14px;"><strong>ROUNDED OF</strong></span>
                                                            @endif
                                                        </td>
                                                        <td colspan="6" style="text-align: right;">
                                                            <span style="font-size: 14px;">{{number_format($sumTaxableValue,2, '.', '')}}</span><br>
                                                            <span style="font-size: 14px;"><strong>{{number_format($sumIGSTAmount,2, '.', '')}}</strong></span><br>
                                                            @if($getNetTotal->round_off_value != '' && $getNetTotal->round_off_value != 0)
                                                            <span style="font-size: 14px;"><strong>{{number_format($getNetTotal->round_off_value,2, '.', '')}}</strong></span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endif
                                                
                                                <tr>
                                                    <td colspan="2" style="text-align: right;">
                                                        <span style="font-size: 14px;"><strong>Total</strong></span>
                                                    </td>
                                                    <td>&nbsp;</td>
                                                    <td style="text-align: center;">
                                                        <span style="font-size: 14px;"><strong>{{$totalQty}}</strong></span>
                                                    </td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td style="text-align: right;">
                                                        <span style="font-size: 14px;"><strong>₹{{ number_format($NetAmount, 2, '.', '') }}</strong></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="8">Amount Charged (in words) <strong>INR <span class="rupee-number">{{number_format($NetAmount, 2, '.', '')}}</span></strong></td>
                                                </tr>

                                                <!-- Tax Amount Calculation -->
                                                @if($getCustomer->state_code == 33)
                                                    <tr>
                                                        <td colspan="2" rowspan="2" style="font-size: 12px;text-align: center;vertical-align:middle;">HSN/SAC</td>
                                                        <td rowspan="2" style="font-size: 12px;text-align: center;vertical-align:middle;">Tax Value</td>
                                                        <td colspan="2" style="font-size: 12px;text-align: center;vertical-align:middle;">CGST</td>
                                                        <td colspan="2" style="font-size: 12px;text-align: center;vertical-align:middle;">SGST</td>
                                                        <td rowspan="2" style="font-size: 12px;text-align: center;vertical-align:middle;">Tax Amount</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="font-size: 12px;text-align: center;vertical-align:middle;">Rate</td>
                                                        <td style="font-size: 12px;text-align: center;vertical-align:middle;">Amount</td>
                                                        <td style="font-size: 12px;text-align: center;vertical-align:middle;">Rate</td>
                                                        <td style="font-size: 12px;text-align: center;vertical-align:middle;">Amount</td>
                                                    </tr>
                                                @else
                                                    <tr>
                                                        <td colspan="2" rowspan="2" style="font-size: 12px;text-align: center;vertical-align:middle;">HSN/SAC</td>
                                                        <td colspan="2" rowspan="2" style="font-size: 12px;text-align: center;vertical-align:middle;">Tax Value</td>
                                                        <td colspan="2" style="font-size: 12px;text-align: center;vertical-align:middle;">IGST</td>
                                                        <td colspan="2" rowspan="2" style="font-size: 12px;text-align: center;vertical-align:middle;">Tax Amount</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="font-size: 12px;text-align: center;vertical-align:middle;">Rate</td>
                                                        <td style="font-size: 12px;text-align: center;vertical-align:middle;">Amount</td>
                                                    </tr>
                                                @endif
                                                
                                                @php
                                                    $invhsngroupdetail = DB::table('invoice_details')->where('invoice_no', $invoice_no)->groupby('item_hsnsac_code')->get();
                                                @endphp

                                                @foreach ($invhsngroupdetail as $key=>$vl)
                                                    @php
                                                        $invtaxsums = DB::table('invoice_details')->where('invoice_no', $invoice_no)->where('item_hsnsac_code',$vl->item_hsnsac_code)->get();
                                                        $totalRate = $invtaxsums->sum('item_price');

                                                        $sumTaxableValue = $invtaxsums->sum('item_sub_total');

                                                        $sumCGSTPercentage = $invtaxsums->avg('central_gst_percent');
                                                        $sumCGSTAmount = $invtaxsums->sum('central_tax_amount');
                                                        
                                                        $sumSGSTPercentage = $invtaxsums->avg('state_gst_percent');
                                                        $sumSGSTAmount = $invtaxsums->sum('state_tax_amount');
                                                        
                                                        $sumIGSTPercentage = $sumCGSTPercentage+$sumSGSTPercentage;
                                                        $sumIGSTAmount = $sumSGSTAmount+$sumCGSTAmount;

                                                        $sumTaxAmount = $invtaxsums->sum('tax_amount');
                                                    @endphp
                                                    @if($getCustomer->state_code == 33)
                                                        <tr>
                                                            <td colspan="2" style="font-size: 14px;text-align: center;">{{$vl->item_hsnsac_code}}</td>
                                                            <td style="font-size: 14px;text-align: right;">{{number_format($sumTaxableValue, 2, '.', '')}}</td>
                                                            <td style="font-size: 14px;text-align: right;">{{$sumCGSTPercentage}}%</td>
                                                            <td style="font-size: 14px;text-align: right;">{{number_format($sumCGSTAmount,2, '.', '')}}</td>
                                                            <td style="font-size: 14px;text-align: right;">{{$sumSGSTPercentage}}%</td>
                                                            <td style="font-size: 14px;text-align: right;">{{number_format($sumSGSTAmount, 2, '.', '')}}</td>
                                                            <td style="font-size: 14px;text-align: right;">{{number_format($sumTaxAmount, 2, '.', '')}}</td>
                                                        </tr>
                                                    @else
                                                        <tr>
                                                            <td colspan="2" style="font-size: 14px;text-align: center;">{{$vl->item_hsnsac_code}}</td>
                                                            <td colspan="2" style="font-size: 14px;text-align: right;">{{number_format($sumTaxableValue, 2, '.', '')}}</td>
                                                            <td style="font-size: 14px;text-align: right;">{{$sumIGSTPercentage}}%</td>
                                                            <td style="font-size: 14px;text-align: right;">{{number_format($sumIGSTAmount,2, '.', '')}}</td>
                                                            <td colspan="2" style="font-size: 14px;text-align: right;">{{number_format($sumTaxAmount, 2, '.', '')}}</td>
                                                        </tr>
                                                    @endif
                                                @endforeach

                                                @php
                                                    $invtaxsums = DB::table('invoice_details')->where('invoice_no',$invoice_no)->get();
                                                    $totalRate = $invtaxsums->sum('item_price');

                                                    $sumTaxableValue = $invtaxsums->sum('item_sub_total');

                                                    $sumCGSTPercentage = $invtaxsums->sum('central_gst_percent');
                                                    $sumCGSTAmount = $invtaxsums->sum('central_tax_amount');
                                                    
                                                    $sumSGSTPercentage = $invtaxsums->sum('state_gst_percent');
                                                    $sumSGSTAmount = $invtaxsums->sum('state_tax_amount');
                                                    
                                                    $sumIGSTPercentage = $sumCGSTPercentage+$sumSGSTPercentage;
                                                    $sumIGSTAmount = $sumSGSTAmount+$sumCGSTAmount;

                                                    $sumTaxAmount = $invtaxsums->sum('tax_amount');
                                                @endphp

                                                @if($getCustomer->state_code == 33)
                                                    <tr>
                                                        <td colspan="2" style="text-align: right;">
                                                            <span style="font-size: 14px;"><strong>Total</strong></span>
                                                        </td>
                                                        <td style="text-align: center;">
                                                            <span style="font-size: 14px;"><strong>{{number_format($sumTaxableValue, 2, '.', '')}}</strong></span>
                                                        </td>
                                                        <td>&nbsp;</td>
                                                        <td style="text-align: right;">
                                                            <span style="font-size: 14px;"><strong>{{number_format($sumCGSTAmount, 2, '.', '')}}</strong></span>
                                                        </td>
                                                        <td>&nbsp;</td>
                                                        <td style="text-align: right;">
                                                            <span style="font-size: 14px;"><strong>{{number_format($sumSGSTAmount, 2, '.', '')}}</strong></span>
                                                        </td>
                                                        <td style="text-align: right;">
                                                            <span style="font-size: 14px;"><strong>{{number_format($sumTaxAmount, 2, '.', '')}}</strong></span>
                                                        </td>
                                                    </tr>
                                                @else
                                                    <tr>
                                                        <td colspan="2" style="text-align: right;">
                                                            <span style="font-size: 14px;"><strong>Total</strong></span>
                                                        </td>
                                                        <td colspan="2" style="text-align: right;">
                                                            <span style="font-size: 14px;"><strong>{{number_format($sumTaxableValue, 2, '.', '')}}</strong></span>
                                                        </td>
                                                        <td>&nbsp;</td>
                                                        <td style="text-align: right;">
                                                            <span style="font-size: 14px;"><strong>{{number_format($sumIGSTAmount, 2, '.', '')}}</strong></span>
                                                        </td>
                                                        <td colspan="2" style="text-align: right;">
                                                            <span style="font-size: 14px;"><strong>{{number_format($sumTaxAmount, 2, '.', '')}}</strong></span>
                                                        </td>
                                                    </tr>
                                                @endif
                                                <tr>
                                                    <td colspan="8">Tax Amount (in Words) <strong>INR <span onload="updateRupeeWords()" class="rupee-number">{{number_format($sumTaxAmount, 2, '.', '')}}</span></strong></td>
                                                </tr>
                                                
                                                <tr>
                                                    <td colspan="2" rowspan="2">
                                                        <p style="font-size: 14px;">
                                                            <span><strong><u>Declaration</u></strong></span><br>
                                                            <span>{{$invoices->declaration}}</span>
                                                        </p>
                                                    </td>
                                                    <td colspan="6">
                                                        <p style="font-size: 14px;">
                                                            <span><strong><u>Company's Bank Account</u></strong></span><br>
                                                            Account Holder Name: <strong>LB EQUIPMENTS PRIVATE LIMITED</strong><br>
                                                            Bank Name: <strong>BANK OF BARODA</strong><br>
                                                            A/c No: <strong>29040200014115</strong><br>
                                                            Branch: <strong>Saibaba Colony</strong><br>
                                                            IFSC Code: <strong>BARB0SAICOI</strong><br>
                                                            <span style="font-size: 12px;font-weight:600;">(in IFSC-5th Character is Zero, 10th Character is alphabet O)</span>
                                                        </p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="6" style="text-align:center;font-weight:700;font-size: 14px;">
                                                        For LB EQUIPMENTS PRIVATE LIMITED
                                                        <br>
                                                        <br>
                                                        <br>
                                                        <br>
                                                        Authorised Signatory
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <p style="text-align: center">This is a Computer Generated Invoice</p>                                                    
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
    <!--==================================*
        End Main Section
    *====================================-->




    <!--=========================*
        Scripts
    *===========================-->
    <script type="text/javascript">
        // Function to convert numbers to Indian Rupee words
        function convertToIndianRupeeWords(number) {
            var words = ["Zero", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Ten",
                "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eighteen", "Nineteen"];
            var tens = ["", "", "Twenty", "Thirty", "Forty", "Fifty", "Sixty", "Seventy", "Eighty", "Ninety"];
            var scales = ["", "Thousand", "Lakh", "Crore"];

            function convertGroup(number, scaleIndex) {
                var num = parseInt(number, 10);
                var result = '';
                if ((num < 0) || (num > 999999999)) {
                    return "NUMBER OUT OF RANGE!";
                }
                if (num >= 10000000) {
                    result += convertGroup(Math.floor(num / 10000000), scaleIndex + 1) + ' Crore ';
                    num %= 10000000;
                }
                if (num >= 100000) {
                    result += convertGroup(Math.floor(num / 100000), scaleIndex + 1) + ' Lakh ';
                    num %= 100000;
                }
                if (num >= 1000) {
                    result += convertGroup(Math.floor(num / 1000), scaleIndex + 1) + ' Thousand ';
                    num %= 1000;
                }
                if (num >= 100) {
                    result += words[Math.floor(num / 100)] + ' Hundred ';
                    num %= 100;
                }
                if (num > 0) {
                    if (result !== '') result += ' and ';
                    if (num < 20) {
                        result += words[num];
                    } else {
                        result += tens[Math.floor(num / 10)];
                        if ((num % 10) > 0) result += ' ' + words[num % 10];
                    }
                }
                return result;
            }

            if (number === 0) return 'Zero';

            // Split the number into rupees and paise parts
            var numParts = number.toString().split(".");
            var rupees = parseInt(numParts[0], 10);
            var paise = parseInt(numParts[1] || 0, 10);

            // Convert rupees to words
            var rupeeWords = convertGroup(rupees, 0);

            // Convert paise to words
            var paiseWords = '';
            if (paise > 0) {
                paiseWords = ' and ' + convertGroup(paise, 0) + ' Paise';
            } else {
                paiseWords = ' Zero Paise';
            }

            // Combine rupees and paise words
            return rupeeWords + ' Rupees' + paiseWords;
        }

        // Function to update specific td elements with Indian Rupee words
        function updateRupeeWords() {
            $('.rupee-number').each(function() {
                var number = $(this).text();
                var rupeeWords = convertToIndianRupeeWords(number);
                $(this).text(rupeeWords);
            });
        }

        // Execute updateRupeeWords() when the window is loaded
        window.onload = function() {
            updateRupeeWords();
            window.print();

            // Close the tab or window
            window.onafterprint = function () {
                window.close();
            };
        };

        // function printAndClose() {
        //     // Print the content
        //     window.print();

        //     // Close the tab or window
        //     window.onafterprint = function () {
        //         window.close();
        //     };
        // }
    </script>
    

</body>


</html>

