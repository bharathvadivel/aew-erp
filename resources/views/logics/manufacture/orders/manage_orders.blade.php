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
                            <h4 class="header-title">Manage Orders
                                <a href="{{ route('order.master') }}"class="btn btn-primary btns"><i class="fa fa-th-list"></i> Order Master </a>
                                <a href="{{ route('add.order') }}" class="btn btn-primary btns mr-2"><i class="fa fa-plus-circle"></i> Create Order </a>
                            </h4>
                            <br>
                            <form method="POST" action="{{route('manage.orders')}}">
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
                                            <th style="text-align: center;">S.No.</th>
                                            <th style="text-align: left;">Dealer Name</th>
                                            <th style="text-align: center;">Order No.</th>
                                            <th style="text-align: center;">Order Date</th>
                                            <th style="text-align: center;">No. Of Models in This Order</th>
                                            <th style="text-align: center;">Client Note</th>
                                            <th style="text-align: center;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($invoices as $key=>$vl)
                                        @php
                                            $indetail = DB::table('order_details')->where('invoice_no',$vl->invoice_no)->get();
                                            $inv_item_qty = DB::table('order_details')->select(DB::raw('count(invoice_no) as qty'))->where('invoice_no', $vl->invoice_no)->value('qty');
                                            $getContact = DB::table('contacts')->where('id',$vl->customer_id)->first();
                                        @endphp
                                        <tr>
                                            <td style="text-align: center;">{{$key+1}}</td>
                                            <td style="text-align: left;">{{$getContact->customer_name}}</td>
                                            <td style="text-align: center;">{{$vl->invoice_no}}</td>
                                            <td style="text-align: center;">{{date('d-m-Y',strtotime($vl->invoice_date))}}</td>
                                            <td style="text-align: center;">{{$inv_item_qty}}</td>
                                            <td style="text-align: center;">{{$vl->client_note}}</td>
                                            <td style="text-align: center;" class="editc">
                                                <a href="{{route('order.edit',$vl->invoice_no)}}"><i  data-placement="top" title="Edit" class="fa fa-edit" style="color:#056c91"></i></a>
                                                <form onsubmit="return confirm('Are you sure you want to delete?');" action="{{ route('order.delete',$vl->invoice_no)}}" method="POST">
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
                            columns: [0, 1, 2, 3, 4, 5]
                        }
                    }
                    , {
                        extend: 'csv'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]


                        }
                    }
                    , {
                        extend: 'excel'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]

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
