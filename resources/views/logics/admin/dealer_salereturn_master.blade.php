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

        a,
        button {
            padding: 0.5em 0.6em;

        }

        @media (min-width: 576px) {
            .modal-dialog {
                max-width: 450px !important;
                margin: 1.75rem auto;
            }

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
                            <form method="POST" action="{{route('dealer.salereturn.master')}}">
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
                                            <label for="disabledTextInput">Invoice</label>
                                            <select name="salereturn_no" class="form-control">


                                                <option value="all">All</option>

                                                @foreach ($list as $key)
                                                <option {{$key->salereturn_no==$salereturn_no ? 'selected':''}} value="{{$key->salereturn_no}}">{{$key->salereturn_no}}</option>
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

                            <h4 class="header-title">Manage Sale Return Invoice
                                <a href="{{ route('dealer.salereturn') }}" class="btn btn-primary btns"> <i class="fa fa-plus-circle"></i> Add Invoice</a>
                            </h4>
                            <br>


                            <div class="table-responsive datatable-primary">
                                <table id="dataTable" class="text-center boh">
                                    <thead class="text-capitalize">
                                        <tr>
                                            <th>S.NO </th>
                                            <th>Return Invoice NO</th>
                                            <th>Dealer Store Name</th>
                                            <th>Dealer Address</th>
                                            <th>Distributor Mobile Number</th>
                                            <th>Distributor Store Name</th>
                                            <th>Delivery Address</th>
                                            <th>Category Name</th>
                                            <th>Model No</th>
                                            <th>Product Description</th>
                                            <th>HSN No</th>
                                            <th class="thdis">GSTIN-NO</th>
                                            <th class="thdis">Billing Price</th>
                                            <th>Qty</th>
                                            <th class="thdis">Serial No</th>
                                            {{-- <th class="thdis">Basic Allowance</th>
                                            <th class="thdis">STA</th>
                                            <th class="thdis">Partner Allowance</th>
                                            <th class="thdis">Discount</th> --}}
                                            <th class="thdis">Taxable Value</th>
                                            <th class="thdis">GST(%)</th>
                                            <th class="thdis">CGST</th>
                                            <th class="thdis">SGST</th>
                                            <th class="thdis">IGST</th>
                                            <th class="thdis">Sub Total</th>
                                            <th class="thdis">TCS Value</th>
                                            <th>Net Value</th>
                                            <th class="thdis">Round off (Net Total)</th>
                                            <th class="thdis">Net Total</th>
                                            <th>Invoice Date</th>
                                            <th>Status</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($partnerinvoices as $key=>$vl)

                                        @php
                                        $ab = DB::table('distributors')->where('partner_id',$vl->partner_id)->first();
                                        $dv = DB::table('distributors')->where('partner_id',$vl->delivery_id)->first();
                                        $sn = DB::table('distributorserials')->where('salereturn_no',$vl->salereturn_no)->where('partnerinvoices_salereturn_id',$vl->id)->where('status','return')->pluck('serial_no')->toArray();
                                        $basic_allowance=0;
                                        $sta=0;
                                        $partner_allowance=0;
                                        $additional_discount=0;
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
                                        @endphp
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$vl->salereturn_no}}</td>
                                            <td>{{$ab->store_name}}</td>
                                            <td>{{$vl->address,$vl->district}}</td>
                                            <td>{{$dv->phone}}</td>
                                            <td>{{$dv->store_name}}</td>
                                            <td>{{$vl->delivery_address}}</td>
                                            <td>{{$vl->gategory}}</td>
                                            <td>{{$vl->model_no}}</td>
                                            <td>{{$vl->description}}</td>
                                            <td>{{$vl->hsn_code}}</td>
                                            <td class="thdis">{{$dv->gstin_no}}</td>
                                            <td class="thdis">{{number_format($vl->billing_price,2)}}</td>
                                            <td>{{$vl->qty}}</td>
                                            <td class="thdis">{{implode(",",$sn)}}</td>
                                            {{-- <td class="thdis">{{number_format($basic_allowance,2)}}</td>
                                            <td class="thdis">{{number_format($sta,2)}}</td>
                                            <td class="thdis">{{number_format($partner_allowance,2)}}</td>
                                            <td class="thdis">{{number_format($additional_discount,2)}}</td> --}}
                                            <td class="thdis">{{number_format($vl->taxable_value,2)}}</td>
                                            <td class="thdis">{{$gst}}</td>
                                            <td class="thdis">{{number_format($cgst,2)}}</td>
                                            <td class="thdis">{{number_format($cgst,2)}}</td>
                                            <td class="thdis">{{number_format($igst,2)}}</td>
                                            <td class="thdis">{{number_format($vl->sub_total,2)}}</td>
                                            <td class="thdis">{{number_format($vl->tcs_val,2)}}</td>
                                           <td>{{number_format($vl->sub_total+$vl->tcs_val,2)}}</td>
                                           <td class="thdis">{{number_format($vl->round_off,2)}}</td>
                                            <td class="thdis">{{number_format($vl->grand_total,2)}}</td>
                                            <td>{{date('Y-m-d h:i A',strtotime($vl->date))}}</td>
                                            @if($vl->status=='Pending' || $vl->status=='Cancel')

                                            <td style="color:red">{{$vl->status}}</td>
                                            @else
                                            <td style="color:green">{{$vl->status}}</td>
                                            @endif

                                            <td>
                                                @if($vl->status!='Cancel')

                                                <a href="{{route('dealer.salereturn.print',$vl->salereturn_no)}}"><i  data-placement="top" title="Invoice" class="fa fa-eye" style="color:red"></i></a>
                                                @endif
                                                @if($vl->status=='Pending')


                                             <a href="{{route('dealer.salereturn.edit',$vl->salereturn_no)}}"><i  data-placement="top" title="Edit" class="fa fa-edit" style="color:#056c91"></i></a>
                                                @if (session()->get('partner_type')=='admin' || session()->get('partner_type')=='distributor')

                                                <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal{{$vl->id}}"><i  data-placement="top" title="Change Status" class="fa fa-check" style="color:green"></i></a>
                                                @endif

                                                @endif

                                                @if($vl->status=='Pending')

                                                <form onsubmit="return confirm('Are you sure you want to delete?');" action="{{ route('dealer.salereturn.delete',$vl->salereturn_no)}}" method="POST">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <button><i  data-placement="top" title="Delete" class="fa fa-trash" style="color:red"></i></button>
                                                </form>
                                                @endif



                                            </td>
                                        </tr>

                                        <div class="modal fade" id="exampleModal{{$vl->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Direct Partner Sale Return</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post" action="{{route('dealer.salereturn.status')}}">
                                                            @csrf
                                                            <div class="mb-3">
                                                                <label for="recipient-name" class="col-form-label">Sale return no:</label>
                                                                <input class="form-control" readonly name="salereturn_no" value="{{$vl->salereturn_no}}">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="recipient-name" class="col-form-label">Status:</label>
                                                                <select name="status" class="form-control" id="recipient-name">
                                                                    <option value="Complete">Complete</option>
                                                                    <option value="Cancel">Cancel</option>

                                                                </select>
                                                            </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success">Submit</button>
                                                    </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
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
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26]
                        }
                    }
                    , {
                        extend: 'csv'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26]


                        }
                    }
                    , {
                        extend: 'excel'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26]

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
