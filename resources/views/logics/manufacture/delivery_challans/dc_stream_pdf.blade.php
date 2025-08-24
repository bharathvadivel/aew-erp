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
    <title>{{$dc_no}}</title>
    <link rel="stylesheet" href="{{asset('user/css/bootstrap.min.css')}}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Include jQuery from CDN -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

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

<body onload="printAndClose()">


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
                                    <div class="row ">
                                        <div class="col-md-12 mt-2 mb-3">
                                            <h4 style="text-align: center;font-size: 24px;"><strong>DELIVERY NOTE</strong></h4>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table" style="width: 100%; vertical-align: middle;">
                                                <tr>
                                                    <td colspan="4" rowspan="3" style="width: 50%;">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <img style="width: auto;height: 80px;" src="{{asset('login/img/logo.png')}}" alt="logo">
                                                            </div>
                                                            <div class="col-md-8">
                                                                <h4 style="font-size: 18px;"><strong>Criar Solutions Private Limited</strong></h4>
                                                                <p style="margin-bottom: 0px;font-weight:400;">
                                                                    <span>Coimbatore - 641029.</span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td colspan="2">
                                                        <span>DC No</span><br/>
                                                        <span style="font-size: 16px;"><strong>{{$dc_no}}</strong></span>
                                                    </td>
                                                    <td colspan="2">
                                                        <span>DC Date</span><br/>
                                                        <span style="font-size: 16px;"><strong>{{date('d-m-Y', strtotime($dcs->dc_date))}}</strong></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <span>Buyer's Order No</span><br/>
                                                        <span style="font-size: 16px;"><strong>{{$dcs->buyer_order_no}}</strong></span>
                                                    </td>
                                                    <td colspan="2">
                                                        <span>Buyer's Order Dated</span><br/>
                                                        <span style="font-size: 16px;"><strong>{{ $dcs->buyer_order_date ? date('Y-m-d', strtotime($dcs->buyer_order_date)) : '' }}</strong></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <span>Dispatch Doc No</span><br/>
                                                        <span style="font-size: 16px;"><strong>{{$dcs->dispatch_doc_no}}</strong></span>
                                                    </td>
                                                    <td colspan="2">
                                                        <span>Dispatch Through</span><br/>
                                                        <span style="font-size: 16px;"><strong>{{$dcs->dispatch_through}}</strong></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4" rowspan="2">
                                                        <span>Buyer (Bill To)</span><br/>
                                                        <span style="font-size: 16px;">
                                                            <span style="font-size:18px;font-weight: 700;">{{$dcs->customer_name}}</span><br>
                                                            {{$dcs->customer_bill_address}}<br>
                                                            Phone: {{$dcs->customer_mobile_no}}<br>
                                                            GSTIN: {{$dcs->customer_gst_no}}
                                                        </span>
                                                    </td>
                                                    <td colspan="4">
                                                        <span>Destination</span><br/>
                                                        <span style="font-size: 16px;"><strong>{{$dcs->destination}}</strong></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4">
                                                        <span>Terms of Delivery</span><br/>
                                                        <span style="font-size: 16px;">{{$dcs->terms_of_delivery}}</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: center;">S.No.</td>
                                                    <td colspan="2" style="text-align: center;">Discription of Goods</td>
                                                    <td style="text-align: center;">HSN/SAC Code</td>
                                                    <td style="text-align: center;">Rate</td>
                                                    <td style="text-align: center;">Qty</td>
                                                    <td style="text-align: center;">per UoM</td>
                                                    <td style="text-align: center;">Approx Value</td>
                                                </tr>
                                                @php
                                                    $indetail = DB::table('delivery_challan_details')->where('dc_no',$dc_no)->get();
                                                    $totalQty = $indetail->sum('item_qty');
                                                    $totalAmount = $indetail->sum('item_sub_total');
                                                @endphp
                                                @foreach ($indetail as $key=>$vl)
                                                <tr>
                                                    <td style="text-align: center;border-bottom: none;">{{$key+1}}</td>
                                                    <td colspan="2"><strong>{{$vl->item_code}}</strong> <br/> {{$vl->item_desc}}</td>
                                                    <td style="text-align: center;">{{$vl->item_hsnsac_code}}</td>
                                                    <td style="text-align: right;">₹{{$vl->item_price}}</td>
                                                    <td style="text-align: center;"><span style="font-size: 16px;"><strong>{{$vl->item_qty}}</strong></span> </td>
                                                    <td style="text-align: center;"><span style="font-size: 16px;"><strong>{{$vl->item_uom}}</strong></span> </td>
                                                    <td style="text-align: right;">₹{{$vl->item_sub_total}}</td>
                                                </tr>
                                                @endforeach
                                                <tr>
                                                    <td colspan="4" style="text-align: right;">
                                                        <span style="font-size: 16px;"><strong>Total</strong></span>
                                                    </td>
                                                    <td>&nbsp;</td>
                                                    <td style="text-align: center;"><span style="font-size: 16px;"><strong>{{$totalQty}}</strong></span></td>
                                                    <td>&nbsp;</td>
                                                    <td style="text-align: right;">
                                                        <span style="font-size: 16px;"><strong>₹{{$totalAmount}}</strong></span>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td colspan="4">
                                                        <span style="font-style: italic;">Remarks:</span><br/>
                                                        <span>{{$dcs->remarks}}</span>
                                                    </td>
                                                    <td colspan="4" rowspan="2" style="text-align:center;">
                                                        @php
                                                            $fy = DB::table('financial_years')->orderby('id','desc')->first();
                                                            $start_year = $fy->fy_start_year;
                                                            $end_year = $fy->fy_end_year;
                                                        @endphp
                                                        <strong>For LB EQUIPMENTS PRIVATE LIMITED - {{$start_year}}-{{$end_year}}</strong>
                                                        <br>
                                                        <br>
                                                        <br>
                                                        <br>
                                                        <br>
                                                        <br>
                                                        Authorised Signatory
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4">
                                                        <span style="font-style: italic;">Note:</span><br/>
                                                        <span>{{$dcs->client_note}}</span>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row ">
                                        <div class="col-md-12">
                                            <p style="text-align: center;font-size: 16px;">This is a Computer Generated Invoice</p>
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
    <script>
        function printAndClose() {
            // Print the content
            window.print();

            // Close the tab or window
            window.onafterprint = function () {
                window.close();
            };
        }
    </script>

</body>

</html>

