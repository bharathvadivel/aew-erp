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
    <title>ERP - DC - {{$dc_no}}</title>
    <link rel="stylesheet" href="{{asset('user/css/bootstrap.min.css')}}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
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
            }
            tr {
                page-break-inside: avoid;
                page-break-after: auto;
                -webkit-print-color-adjust: exact;
                color-adjust: exact;
            }
            th {
                page-break-inside: avoid;
                page-break-after: auto;
                -webkit-print-color-adjust: exact;
                color-adjust: exact;
            }
            td {
                page-break-inside: avoid;
                page-break-after: auto;
                -webkit-print-color-adjust: exact;
                color-adjust: exact;
            }
            thead {
                display: table-header-group;
                -webkit-print-color-adjust: exact;
                color-adjust: exact;
            }
            tbody {
                display: table-body-group;
                -webkit-print-color-adjust: exact;
                color-adjust: exact;
            }
            tfoot {
                display: table-footer-group;
                -webkit-print-color-adjust: exact;
                color-adjust: exact;
            }
        }

    </style>
    <script>
        function convertIndianCurrencyToWords(number) {
            const words = ["", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine",
                "Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eighteen", "Nineteen"];

            const tens = ["", "", "Twenty", "Thirty", "Forty", "Fifty", "Sixty", "Seventy", "Eighty", "Ninety"];

            const thousands = ["", "Thousand", "Lakh", "Crore"];

            function convertThreeDigitsToWords(num) {
                let result = '';

                const hundreds = Math.floor(num / 100);
                num %= 100;

                if (hundreds > 0) {
                    result += words[hundreds] + ' Hundred';
                    if (num > 0) {
                        result += ' and ';
                    }
                }

                if (num > 0) {
                    if (num < 20) {
                        result += words[num];
                    } else {
                        result += tens[Math.floor(num / 10)];
                        num %= 10;
                        if (num > 0) {
                            result += '-' + words[num];
                        }
                    }
                }

                return result;
            }

            if (number === 0) {
                return 'Zero';
            }

            let result = '';
            let groupCount = 0;

            while (number > 0) {
                const remainder = number % 1000;
                if (remainder > 0) {
                    let groupWords = convertThreeDigitsToWords(remainder);
                    groupWords += ' ' + thousands[groupCount];
                    if (result !== '') {
                        groupWords += ' ';
                    }
                    result = groupWords + result;
                }
                number = Math.floor(number / 1000);
                groupCount++;
            }

            return result;
        }
    </script>
</head>

<body onload="window.print()">


    <!--==================================*
               Main Content Section
    *====================================-->
    <div class="main-content page-content">

        <!--==================================*
                   Main Section
        *====================================-->



        <body style="padding: 2%;font-size:14px;">


            <div class="content-page">
                <div class="content">

                    <div class="page-content-wrapper">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p style="text-align: center">INVOICE UNDER GOODS AND SERVICE TAX - RULES, 2017</p>                                                    
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-bordered" style="width: 100%; vertical-align: middle;">
                                                <thead>
                                                    <tr>
                                                        <th rowspan="2" style="vertical-align: middle;text-align:center;"><img style="width: auto;height: 120px;" src="{{asset('login/img/logo.png')}}" alt="logo"></th>
                                                        <th style="width: 70%; vertical-align: middle;" rowspan="2">
                                                            <h4 style="font-size: 22px;color:#EC1C24;"><strong>Criar Solutions Private Limited</strong></h4>
                                                            <p style="margin-bottom: 0px;font-weight:400;">
                                                                <span>Coimbatore - 641029.</span>
                                                            </p>
                                                        </th>
                                                        <th style="width: 15%;text-align:center;">TAX DC</th>
                                                    </tr>
                                                    <tr>
                                                        <th style="width: 15%;text-align:center;"></th>
                                                    </tr>
                                                </thead>
                                            </table>

                                            <table class="table table-bordered" style="width: 100%; vertical-align: middle;">
                                                <tbody>
                                                    <tr>
                                                        <td rowspan="3" style="width: 60%;">Billing To:</span><br>
                                                            <p>
                                                                <span style="font-size:18px;font-weight: 700;">{{$dcs->customer_name}}</span><br>
                                                                {{$dcs->customer_bill_address}}<br>
                                                                Phone: {{$dcs->customer_mobile_no}}<br>
                                                                GSTIN: {{$dcs->customer_gst_no}}
                                                            </p>
                                                        </td>
                                                        <td style="">DC No:<br><span style="font-weight: 700;">{{$dc_no}}</span></td>
                                                        <td style="">DC Date:<br><span style="font-weight: 700;">{{date('d-m-Y', strtotime($dcs->dc_date))}}</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="">Buyer Order No:<br><span style="font-weight: 700;"></span></td>
                                                        <td style="">DC Due Date:<br><span style="font-weight: 700;">{{date('d-m-Y', strtotime($dcs->dc_due_date))}}</span></td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                            <table class="table table-bordered" style="width: 100%; vertical-align: middle;">
                                                <thead>
                                                    <tr style="text-align: center;">
                                                        <th>S. No.</th>
                                                        <th>Particulars</th>
                                                        <th>HSN/SAC</th>
                                                        <th>Rate</th>
                                                        <th>Qty</th>
                                                        <th>GST</th>
                                                        <th>Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $indetail = DB::table('dc_details')->where('dc_no',$dc_no)->get();
                                                    @endphp
                                                    @foreach ($indetail as $key=>$vl)
                                                        
                                                        <tr>
                                                            <td style="text-align: center;">{{$key+1}}</td>
                                                            <td><strong>{{$vl->item_code}}</strong> - {{$vl->item_desc}}</td>
                                                            <td style="text-align: center;">{{$vl->hsn_sac_code}}</td>
                                                            <td style="text-align: right;">₹{{$vl->item_price}}</td>
                                                            <td style="text-align: center;">{{$vl->item_qty}}</td>
                                                            <td style="text-align: center;">{{$vl->item_gst_percent}} %</td>
                                                            <td style="text-align: right;">₹{{$vl->item_total}}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>

                                            <table class="table table-bordered" style="width: 40%;vertical-align:middle;float:right;">
                                                <tbody>                                                        
                                                    <tr>
                                                        <td style="text-align: left;font-weight: 700;">Subtotal</td>
                                                        <td style="text-align: right;">₹{{$dcs->billing_price}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align: left;font-weight: 700;">CGST @ {{number_format(abs($dcs->gst_percentage / 2))}}%</td>
                                                        <td style="text-align: right;">₹{{$dcs->cgst}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align: left;font-weight: 700;">SGST @ {{number_format(abs($dcs->gst_percentage / 2))}}%</td>
                                                        <td style="text-align: right;">₹{{$dcs->cgst}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align: left;font-weight: 700;">Net Payable</td>
                                                        <td style="text-align: right;">₹{{$dcs->net_total}}</td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                            <table class="table table-bordered" style="width: 100%;vertical-align: middle;">
                                                <?php
                                                    $amount = $dcs->net_total;
                                                    $integerPart = (int)$amount;
                                                    $decimalPart = (int)(($amount - $integerPart) * 100);
                                                ?>
                                                <tbody>
                                                    <tr>
                                                        <td colspan="2">
                                                            Net Payable (in words)
                                                            <strong>
                                                                <script>
                                                                    document.write('INR ' + convertIndianCurrencyToWords(<?=$integerPart?>) + ' Rupees and ' + convertIndianCurrencyToWords(<?=$decimalPart?>) + ' Paise Only');
                                                                </script>
                                                            </strong>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td style="width:50%;">Client Note:<br>{{$dcs->client_note}}</td>
                                                        <td>
                                                            <strong><u>Company's Bank Account</u></strong>
                                                            <br>
                                                            Account Holder Name: <strong>LB EQUIPMENTS PRIVATE LIMITED</strong><br>
                                                            Bank Name: <strong>BANK OF BARODA</strong><br>
                                                            A/c No: <strong>29040200014115</strong><br>
                                                            Branch: <strong>Saibaba Colony</strong><br>
                                                            IFSC Code: <strong>BARB0SAICOI</strong><br>
                                                            <span style="font-size: 10px;font-weight:600;">(in IFSC-5th Character is Zero, 10th Character is alphabet O)</span>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td style="width:50%;">Disclaimer:<br>We declare that this delivery challan shows the actual price of the goods described and that all particulars are true and correct.</td>
                                                        <td style="text-align:center;font-weight:600;">
                                                            For LB EQUIPMENTS PRIVATE LIMITED
                                                            <br>
                                                            <br>
                                                            <br>
                                                            <br>
                                                            <br>
                                                            <br>
                                                            Authorised Signatory
                                                        </td>
                                                    </tr>
                                                </tbody>
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


</body>
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

