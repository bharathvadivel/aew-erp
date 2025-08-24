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
                            <form method="POST" action="{{route('scpinvoice.master')}}">
                                @csrf
                                <div class="form-row">
                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">From Date <span style="color:red">&#9733;</span></label>
                                            <input type="date" value="{{$from_date}}" required="" name="from_date" class="form-control">

                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">To Date <span style="color:red">&#9733;</span></label>
                                            <input type="date" value="{{$to_date}}" required="" name="to_date" class="form-control">

                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Sales Executive</label>
                                            <select required="" name="exe" class="form-control">
                                                <option value="all">All</option>

                                                @foreach ($exe as $key)
                                                <option {{$key->exe_id==$exe_value ? 'selected':''}} value="{{$key->exe_id}}">{{$key->name}}({{$key->exe_id}})</option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Direct Partner</label>
                                            <select name="service_id" class="form-control">
                                                <option value="all">All</option>

                                                @foreach ($data as $key)
                                                <option {{$key->service_id==$service_id_value ? 'selected':''}} value="{{$key->service_id}}">{{$key->service_center_name}}({{$key->service_id}})</option>
                                                @endforeach

                                            </select>

                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Catgeory</label>
                                            <select name="gategory_id" class="form-control">
                                                <option value="all">All</option>
                                                @foreach ($gategory as $key)
                                                <option {{$key->id==$gategory_id ? 'selected':''}} value="{{$key->id}}">{{$key->gategory_name}}</option>
                                                @endforeach
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
                            <h4 class="header-title">Manage Invoice

                            </h4>
                            <br>


                            <div class="table-responsive datatable-primary">
                                <table id="dataTable" class="text-center boh">

                                    <thead class="text-capitalize">
                                        <tr>
                                            <th>S.NO </th>
                                            <th>Invoice NO</th>
                                            <th>Invoice Date</th>
                                            <th>Store Name</th>
                                            <th class="thdis">Address</th>
                                            <th>Mobile Number</th>
                                            <th>Category Name</th>
                                            <th>Model No</th>
                                            <th>Product Description</th>
                                            <th>HSN No</th>
                                            <th class="thdis">GSTIN-NO</th>
                                            <th class="thdis">Billing Price</th>
                                            <th>Qty</th>
                                            <th class="thdis">Serial No</th>
                                            <th class="thdis">Basic Allowance</th>
                                            <th class="thdis">STA</th>
                                            <th class="thdis">Partner Allowance</th>
                                            <th class="thdis">Discount</th>
                                            <th class="thdis">Taxable Value</th>
                                            <th class="thdis">GST(%)</th>
                                            <th class="thdis">CGST</th>
                                            <th class="thdis">SGST</th>
                                            <th class="thdis">IGST</th>
                                            <th class="thdis">Sub Total</th>
                                            <th class="thdis">TCS Value</th>
                                            <th>Net Value</th>
                                            <th class="thdis">Sales Executive</th>
                                            <th class="thdis">Round off (Net Total)</th>
                                            <th class="thdis">Net Total</th>
                                            <th>Status</th>
                                            @if (session()->get('partner_type')!='Accounts')

                                            <th>Action</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($scpinvoices as $key=>$vl)
                                        @php
                                        $sn = DB::table('scp_serials')->where('scp_invoice_id',$vl->id)->pluck('serial_no')->toArray();
                                        $basic_allowance=(($vl->billing_price*$vl->qty)/100) * $vl->basic_allowance;
                                        $sta=$vl->qty*$vl->sta;
                                        $partner_allowance=(($vl->billing_price*$vl->qty)/100) * $vl->partner_allowance;
                                        $additional_discount=$vl->qty*$vl->additional_discount;
                                        $tax=$vl->sub_total;
                                        @endphp

                                        @if($vl->state=='TAMILNADU')
                                        @php
                                        $gst=$vl->gst;
                                        $cgst=($vl->gst)/2;
                                        $cgst=($tax-($tax/(1+($gst/100))))/2;
                                        $igst=0;
                                        @endphp
                                        @else
                                        @php
                                        $cgst=0;
                                        $gst=$vl->gst; $igst=($tax-($tax/(1+($gst/100))));
                                        @endphp
                                        @endif
                                        @php
                                        $taxable_value=$tax/(1+($gst/100));
                                        $tcs=($tax/100)*$vl->tcs;
                                        $net_total=$tax+$tcs;
                                        $status_color=($vl->status=='Completed' ||  $vl->status=='Transfered') ? 'green' : 'red';
                                        @endphp
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$vl->scp_invoice_no}}</td>
                                            <td>{{date('d-m-Y',strtotime($vl->date))}}</td>
                                            <td>{{ ($vl->partners) ? $vl->partners->store_name: ($vl->towarehouse ? $vl->towarehouse->name:'' )}}</td>
                                            <td class="thdis">{{$vl->address,$vl->district}}</td>
                                            <td>{{$vl->partners ? $vl->partners->phone: ($vl->towarehouse ? $vl->towarehouse->phone:'' )}}</td>
                                            <td>{{$vl->gategory ? $vl->gategory->gategory_name:''}}</td>
                                            <td>{{$vl->model_no}}</td>
                                            <td>{{$vl->product ? $vl->product->description:''}}</td>
                                            <td>{{$vl->product ? $vl->product->hsn_code:''}}</td>
                                            <td class="thdis">{{ ($vl->partners) ? $vl->partners->gstin_no: ($vl->towarehouse ? $vl->towarehouse->gstin_no:'' )}}</td>
                                            <td class="thdis">{{number_format($vl->billing_price,2)}}</td>
                                            <td>{{$vl->qty}}</td>
                                            <td class="thdis">{{implode(",",$sn)}}</td>
                                            <td class="thdis">{{number_format($basic_allowance,2)}}</td>
                                            <td class="thdis">{{number_format($sta,2)}}</td>
                                            <td class="thdis">{{number_format($partner_allowance,2)}}</td>
                                            <td class="thdis">{{number_format($additional_discount,2)}}</td>
                                            <td class="thdis">{{number_format($vl->taxable_value,2)}}</td>
                                            <td class="thdis">{{$gst}}</td>
                                            <td class="thdis">{{number_format($cgst,2)}}</td>
                                            <td class="thdis">{{number_format($cgst,2)}}</td>
                                            <td class="thdis">{{number_format($igst,2)}}</td>
                                            <td class="thdis">{{number_format($vl->sub_total,2)}}</td>
                                            <td class="thdis">{{number_format($vl->tcs_val,2)}}</td>
                                            <td>{{number_format($vl->sub_total+$vl->tcs_val,2)}}</td>
                                            <td class="thdis">{{ $vl->asm ? $vl->asm->name:''}}</td>
                                            <td class="thdis">{{number_format($vl->round_off,2)}}</td>
                                            <td class="thdis">{{number_format($vl->grand_total,2)}}</td>
                                            <td style="color:{{ $status_color}}">{{$vl->status}}</td>
                                            @if (session()->get('partner_type')!='Accounts')

                                            <td class="editc">
                                               <a href="{{ route('scpinvoice.json',$vl->scp_invoice_no)}}">
                                                        <i class="fa fa-download" data-placement="top" title="Download" style="color:green"></i></a>
                                                @if ($vl->partner_type=='warehouse')
                                                <a target="_blank" href="{{url('warehouse-invoice-pdf/'.$vl->scp_invoice_no)}}"><i  data-placement="top" title="Invoice" class="fa fa-eye" style="color:red"></i></a>
                                                <a href="{{route('warehouseinvoice.edit',$vl->scp_invoice_no)}}"><i  data-placement="top" title="Edit" class="fa fa-edit" style="color:#056c91"></i></a>
                                                <form onsubmit="return confirm('Are you sure you want to delete?');" action="{{ route('scpinvoice.delete',$vl->scp_invoice_no)}}" method="POST">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <button><i  data-placement="top" title="Delete" class="fa fa-trash" style="color:red"></i></button>
                                                </form>
                                                @else
                                                <a target="_blank" href="{{url('generatepdf/'.$vl->scp_invoice_no)}}"><i class="fa fa-eye" style="color:red"></i></a>
                                                <a href="{{route('scpinvoice.edit',$vl->scp_invoice_no)}}"><i  data-placement="top" title="Edit" class="fa fa-edit" style="color:#056c91"></i></a>
                                                <form onsubmit="return confirm('Are you sure you want to delete?');" action="{{ route('scpinvoice.delete',$vl->scp_invoice_no)}}" method="POST">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <button><i  data-placement="top" title="Delete" class="fa fa-trash" style="color:red"></i></button>
                                                </form>

                                                @endif
                                            </td>
                                            @endif
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
            margin-top: 21px;

        }

    </style>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                dom: 'Bfrtip'
                , buttons: [{
                        extend: 'copy'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28]
                        }
                    }
                    , {
                        extend: 'csv'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28]


                        }
                    }
                    , {
                        extend: 'excel'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28]

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
