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

        @media (max-width: 767px) {
            .fa-edit {
                display: none !important;
            }

            .fa-trash {
                display: none !important;
            }

            .deshow {
                display: none !important;
            }

            .mbshow {
                display: block !important;
            }


        }

        .deshow {
            display: block;
        }

        .mbshow {
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


                            <form method="POST" action="{{route('deainvoice.master')}}">
                                @csrf
                                <div class="form-row">
                                    <div class="col-md-2 mb-2">
                                        <div class="form-group">
                                            <label for="disabledTextInput">From Date <span style="color:red">&#9733;</span></label>
                                            <input type="date" value="{{$from_date}}" required="" name="from_date" class="form-control">

                                        </div>
                                    </div>
                                    <div class="col-md-2 mb-2">
                                        <div class="form-group">
                                            <label for="disabledTextInput">To Date <span style="color:red">&#9733;</span></label>
                                            <input type="date" value="{{$to_date}}" required="" name="to_date" class="form-control">

                                        </div>
                                    </div>



                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Customer</label>
                                            <select name="customer_phone" class="form-control">

                                                <option value="all">All</option>

                                                @foreach ($data as $key)
                                                <option {{$key->customer_phone==$customer_phone ? 'selected':''}} value="{{$key->customer_phone}}">{{$key->customer_name}}({{$key->customer_phone}})</option>
                                                @endforeach

                                            </select>

                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Invoice</label>
                                            <select name="customerinvoice_no" class="form-control">

                                                <option value="all">All</option>

                                                @foreach ($list as $key)
                                                <option {{$key->customerinvoice_no==$customerinvoice_no ? 'selected':''}} value="{{$key->customerinvoice_no}}">{{$key->customerinvoice_no}}</option>




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
                                <a href="{{ route('deainvoice') }}" class="btn btn-primary btns"> <i class="fa fa-plus-circle"></i> Add Invoice</a>
                            </h4>
                            <br>


                            <div class="table-responsive datatable-primary">
                                <table id="dataTable2" class="text-center boh">
                                    <thead class="text-capitalize">
                                        <tr>
                                            <th>S.NO </th>
                                            <th>Invoice NO</th>
                                            <th>Customer Name</th>
                                            <th>Customer Address</th>
                                            <th class="thdis">Customer Area</th>
                                            <th class="thdis">Customer City</th>
                                            <th class="thdis"> Customer District</th>
                                            <th class="thdis">Customer State</th>
                                            <th>Customer Number</th>
                                            <th>Category Name</th>
                                            <th>Model No</th>
                                            <th>Product Description</th>
                                            <th>HSN No</th>
                                            <th class="thdis">Billing Price</th>
                                            <th>Qty</th>
                                            <th class="thdis">Serial No</th>
                                            <th class="thdis">Taxable Value</th>
                                            <th class="thdis">GST(%)</th>
                                            <th class="thdis">CGST</th>
                                            <th class="thdis">SGST</th>
                                            <th class="thdis">IGST</th>
                                            <th class="thdis">Sub Total</th>
                                            <th>Net Value</th>
                                            <th class="thdis">Round off (Net Total)</th>
                                            <th class="thdis">Net Total</th>
                                            <th>Sales Executive</th>
                                            <th>Invoice Date</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($deainvoices as $key=>$vl)


                                        @php
                                        $sn = DB::table('deaserials')->where('deainvoices_id',$vl->id)->pluck('serial_no')->toArray();
                                        $exe = DB::table('promoters')->where('promoter_id',$vl->promoter_id)->first();
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
                                        $net_total=$tax;
                                        @endphp
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$vl->customerinvoice_no}}</td>

                                            <td>{{$vl->customer_name}}</td>
                                            <td>{{$vl->address}}</td>
                                            <td class="thdis">{{$vl->area}}</td>

                                            <td class="thdis">{{$vl->city}}</td>

                                            <td class="thdis">{{$vl->district}}</td>

                                            <td class="thdis">{{$vl->state}}</td>

                                            <td>{{$vl->customer_phone}}</td>
                                            <td>{{$vl->gategory}}</td>
                                            <td>{{$vl->model_no}}</td>
                                            <td>{{$vl->description}}</td>
                                            <td>{{$vl->hsn_code}}</td>
                                            <td class="thdis">{{number_format($vl->billing_price,2)}}</td>
                                            <td>{{$vl->qty}}</td>
                                            <td class="thdis">{{implode(",",$sn)}}</td>
                                            <td class="thdis">{{number_format($vl->taxable_value,2)}}</td>
                                            <td class="thdis">{{$gst}}</td>
                                            <td class="thdis">{{number_format($cgst,2)}}</td>
                                            <td class="thdis">{{number_format($cgst,2)}}</td>
                                            <td class="thdis">{{number_format($igst,2)}}</td>
                                            <td class="thdis">{{number_format($vl->sub_total,2)}}</td>
                                            <td>{{number_format($vl->sub_total,2)}}</td>
                                            <td class="thdis">{{number_format($vl->round_off,2)}}</td>
                                            <td class="thdis">{{number_format($vl->grand_total,2)}}</td>
                                            <td>@if($exe) {{$exe->name}} @endif</td>

                                            <td>{{date('Y-m-d h:i A',strtotime($vl->date))}}</td>
                                            <td class="editc">
                                                <a class="deshow" target="_blank" href="{{route('deainvoice.print.pdf',$vl->customerinvoice_no)}}"><i  data-placement="top" title="Invoice" class="fa fa-eye" style="color:red"></i></a>
                                                <a class="mbshow" href="{{route('deainvoice.print.pdf',$vl->customerinvoice_no)}}"><i  data-placement="top" title="Invoice" class="fa fa-eye" style="color:red"></i></a>
                                                <a href="{{route('deainvoice.edit',$vl->customerinvoice_no)}}"><i  data-placement="top" title="Edit" class="fa fa-edit" style="color:#056c91"></i></a>
                                                <form onsubmit="return confirm('Are you sure you want to delete?');" action="{{ route('deainvoice.delete',$vl->customerinvoice_no)}}" method="POST">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <button><i  data-placement="top" title="Delete" class="fa fa-trash" style="color:red"></i></button>
                                                </form>
                                            </td>
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

        }

    </style>
    <script>
        $(document).ready(function() {
            $('#dataTable2').DataTable({

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
