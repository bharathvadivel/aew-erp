<!DOCTYPE html>
<html>

<head>
    <style>
        * {
            margin: 0px;
            padding: 5px;
        }

        @media print {
            @page {
                margin-top: 0;
                margin-bottom: 0;
            }

            body {
                padding-top: 72px;
                padding-bottom: 72px;
            }
        }

        table {
            border-collapse: collapse;
            table-layout: fixed;
            width: 100%;
        }

        table td,
        th {

            border: solid 1px #666;
            width: 100%;
            word-wrap: break-word;
            text-align: center;
        }

        img {
            width: 100px;
            height: 100px;

        }

        .left {
            text-align: left;
            vertical-align: top;
            padding: 0
        }

    </style>
</head>

<body onload="window.print()">

    <h2>RMA- FORMAT FOR APPROVAL</h2>

    <table style="width:100%">
        <tr>
            <th>Details</th>
            <th>Data</th>
            <th>Symptoms of the issue</th>
            <th>Model & Serial</th>
            <th colspan="2">Part Serial</th>
        </tr>
        <tr>
            <td>Call ID</td>
            <td>{{$row->call_id}}</td>
            <td rowspan="7">@if ($row->service_type!='Installation')@if($list && $list->symptoms_issue!='')<a target="_blank" href="{{ $list::EnquiryImage($list->symptoms_issue) }}"><img src="{{ $list::EnquiryImage($list->symptoms_issue) }}"></a>@endif @endif</td>
            <td rowspan="7">@if($list && $list->back_serial!='')<a target="_blank" href="{{ $list::EnquiryImage($list->back_serial) }}"><img src="{{ $list::EnquiryImage($list->back_serial) }}"></a>@endif</td>
            <td rowspan="7" colspan="2">@if ($row->service_type!='Installation')@if($list && $list->panel_serial!='')<a target="_blank" href="{{ $list::EnquiryImage($list->panel_serial) }}"><img src="{{ $list::EnquiryImage($list->panel_serial) }}"></a>@endif @endif</td>





        </tr>
        <tr>
            <td>Invoice Date</td>
            <td>{{$row->date_of_purchase ? basicDateFormat($row->date_of_purchase):''}}</td>

        </tr>

        <tr>
            <td>Customer Name</td>
            <td>{{$row->customer_name}}</td>
        </tr>
        <tr>
            <td>ASC Name</td>
            <td>{{$row->service_center_name}}</td>
        </tr>
        <tr>
            <td>Service Executive</td>
            <td>{{$row->executive_name}}</td>
        </tr>
        <tr>
            <td>Model No</td>
            <td>{{$row->model_no}}</td>
        </tr>
        <tr>
            <td>Serial No</td>
            <td>{{$row->serial_no}}</td>
        </tr>
        <tr>
            <th colspan="2"></th>
            @if ($row->service_type=='Installation')
            <th>Product</th>

            @else
            <th>Product</th>


            @endif
            <th>Invoice copy</th>
            <th colspan="2">Part</th>

        </tr>
        <tr style="height:200px">
            <td colspan="2"></td>
            <td>@if($list && $list->product_fit!='')<a target="_blank" href="{{ $list::EnquiryImage($list->product_fit) }}"><img src="{{ $list::EnquiryImage($list->product_fit) }}"></a>@endif</td>
            <td>@if($list && $list->invoice_copy!='')<a target="_blank" href="{{ $list::EnquiryImage($list->invoice_copy) }}"><img src="{{ $list::EnquiryImage($list->invoice_copy) }}"></a>@endif</td>

            <td colspan="2">@if ($row->service_type!='Installation')@if($list && $list->warranty_card!='')<a target="_blank" href="{{ $list::EnquiryImage($list->warranty_card) }}"><img src="{{ $list::EnquiryImage($list->warranty_card) }}"></a>@endif @endif</td>


        </tr>
        <tr style="height:80px">
            <td colspan="3"></td>
            <th colspan="3" class="left">Service head recommendation</th>
        </tr>
        <tr style="height:80px">
            <th colspan="3" class="left">CFO recommendation:-</th>
            <td colspan="3" class="left">MD recommendation</td>
        </tr>
        <tr style="height:25px;">
            <td rowspan="2" class="left">Logistics INCH</td>
            <td rowspan="2" class="left">BR.Manager</td>
            <td rowspan="2" class="left">BR.Service</td>
            <td></td>
            <td rowspan="2" class="left">BR.Comm</td>
            <td rowspan="2" class="left">SER Head</td>

        </tr>
        <tr style="height:25px;">
            <td></td>
        </tr>


    </table>

</body>

</html>
