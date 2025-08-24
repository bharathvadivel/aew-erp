<!doctype html>

<html>

<head>
    <meta charset="utf-8">
    <title>DC</title>
    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 5px solid #6b71b3;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
            font-size: 16px;
            line-height: 24px;
            font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 0px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }
            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }
        /** RTL **/

        .rtl {
            direction: rtl;
            font-family: Tahoma, "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
        }

        .rtl table {
            text-align: right;
        }

        .rtl table tr td:nth-child(2) {
            text-align: left;
        }

        .border_need {
            border: 2px solid #555b9d;
        }

        .border_right {
            border-right: 2px solid #555b9d;
        }

        .border_left {
            border-left: 2px solid #555b9d;
        }

        .border_bottom {
            border-bottom: 2px solid #555b9d;
        }

        .border_top {
            border-top: 2px solid #555b9d;
        }
    </style>
</head>



<body>

    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0" class="border_need">
            <tr class="top ">
                <td colspan="2">
                    <table class="border_bottom">
                        <tr>
                            <td style="display: flex;align-items: center;" class="border_right">
                                <div><img src="{{asset('login/img/logo.png')}}" style="max-width:130px;"><br>

                                    <span>({{$temp->service_center_name}})</span> </div>




                                    <div>
                                        <p style="text-align: right;">{{$temp->address}} pincode:{{$temp->pincode}},ph :{{$temp->phone}}<br> Mail:{{$temp->email}}
                                            <br> GSTIN : {{$temp->gstin_no}}</p>
                                        </div>

                                    </td>




                                    <td>
                                        <div style="white-space:nowrap;color: black;"> <span style="    text-align: left;">DELIVERY NOTE</span></div>
                                        <div>
                                            <label style="float:left">No :</label><br>
                                            <label style="float:left">Date :</label>
                                        </div>


                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr class="information">
                        <td colspan="2">
                            <table>
                                <tr>
                                    <td>
                                        <p style="color: #555b9d">Mrs.__________________________________________________________</p>
                                        <p style="color: #555b9d">______________________________________________________________</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>


                        <table class="border_left border_right border_bottom">
                            <th class="border_bottom"> S.NO
                            </th>
                            <th class="border_bottom">Particulars</th>
                            <th class="border_bottom">Qty</th>
                            <th class="border_bottom">Rate</th>
                            <th class="border_bottom">GST</th>
                            <th class="border_bottom">Amount</th>

                            <tbody>
                                @if($list->part_code)

                                @foreach (json_decode($list->part_code) as $key=>$vl)
                                @php
                                $part_name=json_decode($list->part_name);
                                $parts = DB::table('parts')->where('part_code',$vl)->first();
                                $amount=($parts->price/100) * $parts->gst_percentage;
                                $total=$parts->price+$amount;

                                @endphp
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td style="float:left">{{$vl}} ({{$part_name[$key]}})</td>
                                    <td>1</td>
                                    <td>{{$parts->price}}</td>
                                    <td>{{$parts->gst_percentage}}</td>
                                    <td>{{number_format($total,2)}}</td>

                                </tr>
                                @endforeach
                                @endif

                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>

                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>

                                </tr>
                                <tr>
                                    <td>Remarks / Reference:</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>

                                </tr>


                            </tbody>

                        </table>

                    </tr>
                    <tr>
                        <table class="border_left border_right border_bottom">

                            <th class="border-top">Reciedved goods In Good Condtion</th>
                            <th class="border-top">Prepared by</th>
                            <th class="border-top">Checked By</th>
                            <th class="border-top">Autorized By</th>

                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>

                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>

                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Receiver's Sign with seal</td>

                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>



                            </tbody>


                        </table>
                    </tr>







                </table>
            </div>
        </body>

        </html>
