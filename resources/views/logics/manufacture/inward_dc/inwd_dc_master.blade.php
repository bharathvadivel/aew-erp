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
                            <h4 class="header-title">Manage Inward DC
                                <a href="{{ route('add.inwd.dc') }}"class="btn btn-primary btns"><i class="fa fa-plus-circle"></i> Create Inward DC </a>
                            </h4>
                            <br>
                            <form method="POST" action="{{route('dc.master')}}">
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

                                    <div class="col-md-1 mb-1">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Filter<span style="color:red">&#9733;</span></label>
                                            <input style="cursor: pointer;background-color:#585858;color:white" type="submit" value="Search" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <div class="table-responsive datatable-primary">
                                <table id="dataTable" class="text-center" style="width: 100%">
                                    <thead class="text-capitalize">
                                        <tr>
                                            <th>S.No.</th>
                                            <th>DC No.</th>
                                            <th>DC Date</th>
                                            <th>Customer Bill No</th>
                                            <th>Customer Bill Date</th>
                                            <th>Customer Name</th>
                                            <th>Qty</th>
                                            <th>Estimated Amount</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($invoices as $key=>$vl)
                                        @php
                                            $indetail = DB::table('inward_dc_details')->where('invoice_no',$vl->invoice_no)->get();
                                            $inv_item_qty = DB::table('inward_dc_details')->select(DB::raw('count(invoice_no) as qty'))->where('invoice_no', $vl->invoice_no)->value('qty');
                                        @endphp
                                        <tr>
                                        <td>{{$key+1}}</td>
                                            <td>{{$vl->invoice_no}}</td>
                                            <td>{{date('d-m-Y',strtotime($vl->invoice_date))}}</td>
                                            <td>{{$vl->customer_bill_no}}</td>
                                            <td>{{date('d-m-Y',strtotime($vl->customer_bill_date))}}</td>
                                            <td>{{$vl->customer_name}}</td>
                                            <td>{{$inv_item_qty}}</td>
                                            <td>{{number_format($vl->estimated_amount,2)}}</td>
                                            <td class="editc">
                                                <a href="{{route('inwd.dc.edit',$vl->invoice_no)}}"><i  data-placement="top" title="Edit" class="fa fa-edit" style="color:#056c91"></i></a>
                                                <form onsubmit="return confirm('Are you sure you want to delete?');" action="{{ route('inwd.dc.delete',$vl->invoice_no)}}" method="POST">
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
