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
            padding: 0.5em 1em;
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
                            <h4 class="header-title">Manage Delivery Challan
                                <a href="{{ route('add.dc') }}"class="btn btn-primary btns"><i class="fa fa-plus-circle"></i> Create DC </a>
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
                                            <th style="text-align: center">S.No.</th>
                                            <th style="text-align: center">DC No.</th>
                                            <th style="text-align: center">DC Date</th>
                                            <th style="text-align: center">Customer</th>
                                            <th style="text-align: center">Qty</th>
                                            <th style="text-align: center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dcs as $key=>$vl)
                                        @php
                                            $indetail = DB::table('delivery_challan_details')->where('dc_no',$vl->dc_no)->get();
                                            $inv_item_qty = DB::table('delivery_challan_details')->select(DB::raw('count(dc_no) as qty'))->where('dc_no', $vl->dc_no)->value('qty');
                                            // $inpaydetail = DB::table('dc_payment_details')->select(DB::raw('count(dc_payment_amount) as paid_amount'))->where('dc_no', $vl->dc_no)->value('paid_amount'); 
                                        @endphp
                                        <tr>
                                            <td style="text-align: center">{{$key+1}}</td>
                                            <td style="text-align: center">{{$vl->dc_no}}</td>
                                            <td style="text-align: center">{{date('d-m-Y',strtotime($vl->dc_date))}}</td>
                                            <td style="text-align: center">{{$vl->customer_name}}</td>
                                            <td style="text-align: center">{{$inv_item_qty}}</td>
                                            <td class="editc">
                                                <a target="_blank" href="{{url('generatedcpdf/'.$vl->dc_no)}}"><i class="fa fa-download" style="color:red"></i></a>
                                                <a href="{{route('dc.edit',$vl->dc_no)}}"><i  data-placement="top" title="Edit" class="fa fa-edit" style="color:#056c91"></i></a>
                                                <form onsubmit="return confirm('Are you sure you want to delete?');" action="{{ route('dc.delete',$vl->dc_no)}}" method="POST">
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
            justify-content: center;
        }

    </style>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                dom: 'Bfrtip'
                , buttons: [{
                        extend: 'copy'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                        }
                    }
                    , {
                        extend: 'csv'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                        }
                    }
                    , {
                        extend: 'excel'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]

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
