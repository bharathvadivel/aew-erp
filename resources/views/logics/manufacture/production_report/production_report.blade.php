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
            padding: 0.5em 0.6em;
        }

        .thdis {
            display: none;
        }

        #invDownloadOpt:after{
            content:none!important;
        }
        .red {
            color: red; /* Style for zero values */
        }
        .blue {
            color: blue; /* Style for non-zero values */
            font-weight: bold;
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
                            <h4 class="header-title">Production Report</h4>
                            <br>
                            <div class="table-responsive datatable-primary table-striped">
                                <table id="dataTable" class="text-center" style="width: 100%">
                                    <thead class="text-capitalize">
                                        <tr>
                                            <th rowspan="2" style="text-align: center;">Model No</th>
                                            <th rowspan="2" style="text-align: center;">Pending Qty</th>
                                            <th rowspan="2" style="text-align: center;">Round Off Qty</th>
                                            <th rowspan="2" style="text-align: center;">Total Production Qty</th>
                                            <th colspan="2" style="text-align: center;">Assembly Completed</th>
                                            <th colspan="2" style="text-align: center;">Testing Completed </th>
                                            <th colspan="2" style="text-align: center;">Painting Completed </th>
                                            <th colspan="2" style="text-align: center;">Packing Completed </th>
                                        </tr>
                                        <tr>
                                            <th style="text-align: center;">Ok</th>
                                            <th style="text-align: center;">Not Ok</th>
                                            <th style="text-align: center;">Ok</th>
                                            <th style="text-align: center;">Not Ok</th>
                                            <th style="text-align: center;">Ok</th>
                                            <th style="text-align: center;">Not Ok</th>
                                            <th style="text-align: center;">Ok</th>
                                            <th style="text-align: center;">Not Ok</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                            @foreach ($p_models as $key => $vl)
                                                @php
                                                    $orderedQty = DB::table('order_details')->where('item_code', $vl->model_code)->sum('item_qty');
                                                    $dispatchedQty = DB::table('dispatch_details')->where('item_code', $vl->model_code)->sum('item_qty');

                                                    $pendingQty = $orderedQty - $dispatchedQty;

                                                    $totalPendingQty = $pendingQty + $vl->adjust_production_qty;

                                                    $assembly_ok_qty = DB::table('job_cards')->where('model_code', $vl->model_code)->where('worked_dept', 'Assembly')->sum('approved_qty');
                                                    $testing_ok_qty = DB::table('job_cards')->where('model_code', $vl->model_code)->where('worked_dept', 'Testing')->sum('approved_qty');
                                                    $painting_ok_qty = DB::table('job_cards')->where('model_code', $vl->model_code)->where('worked_dept', 'Painting')->sum('approved_qty');
                                                    $packing_ok_qty = DB::table('job_cards')->where('model_code', $vl->model_code)->where('worked_dept', 'Packing')->sum('approved_qty');

                                                    $assembly_not_ok_qty = DB::table('job_cards')->where('model_code', $vl->model_code)->where('worked_dept', 'Assembly')->sum('defective_qty');
                                                    $testing_not_ok_qty = DB::table('job_cards')->where('model_code', $vl->model_code)->where('worked_dept', 'Testing')->sum('defective_qty');
                                                    $painting_not_ok_qty = DB::table('job_cards')->where('model_code', $vl->model_code)->where('worked_dept', 'Painting')->sum('defective_qty');
                                                    $packing_not_ok_qty = DB::table('job_cards')->where('model_code', $vl->model_code)->where('worked_dept', 'Packing')->sum('defective_qty');
                                                @endphp
                                                <tr>
                                                    <td style="text-align: center;">{{$vl->model_code}}</td>
                                                    <td style="text-align: center;">
                                                        <a data-toggle="modal" data-target="#myModal{{ $key }}" style="text-align:center;font-size: 12px;cursor:pointer;border-bottom: 1px dashed #8b93a3;">
                                                            <span title="Click to View Dealer Detail">{{$pendingQty}}</span>
                                                        </a>
                                                        <div class="modal fade" id="myModal{{ $key }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        
                                                                        <h5 class="modal-title" id="exampleModalLabel" style="text-align:left;">
                                                                            Dealer Wise Order Data
                                                                            <br/>
                                                                            <span style="font-size:12px;">Displaying Pending Order's stock info by Dealers for the Model: <strong style="color:blue;font-size:14px;">{{ $vl->model_code }}</strong></span>
                                                                         </h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body" style="max-height: 480px;overflow-y:scroll;padding:0px 1rem 1rem 1rem;">
                                                                        <!-- Add content for your modal here -->
                                                                        <table class="table table-striped table-bordered" style="width:100%;">
                                                                            <thead class="text-capitalize" style="position:sticky;top:0;z-index: 1;">
                                                                                <tr>
                                                                                    <th style="background:#e0e0e0;border:2px solid #ABB2B9!important;">S.No.</th>
                                                                                    <th style="background:#e0e0e0;border:2px solid #ABB2B9!important;">Dealer Name</th>
                                                                                    <th style="text-align:center;background:#e0e0e0;border:2px solid #ABB2B9!important;">Order Qty</th>
                                                                                    <th style="text-align:center;background:#e0e0e0;border:2px solid #ABB2B9!important;">Total Dispatched Qty</th>
                                                                                    <th style="text-align:center;background:#e0e0e0;border:2px solid #ABB2B9!important;">Pending Qty</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody style="position:relative;padding-top: 40px;">
                                                                                @php
                                                                                    // Fetch customer names linked with orders
                                                                                    $customerNames = DB::table('contacts')
                                                                                        ->join('orders', 'contacts.id', '=', 'orders.customer_id')
                                                                                        ->pluck('contacts.customer_name', 'contacts.id');

                                                                                    // Fetch total ordered qty per customer for the given model code
                                                                                    $orderQuantities = DB::table('order_details')
                                                                                        ->join('orders', 'order_details.invoice_no', '=', 'orders.invoice_no')
                                                                                        ->select('orders.customer_id', DB::raw('SUM(order_details.item_qty) as total_order_qty'))
                                                                                        ->where('order_details.item_code', $vl->model_code)
                                                                                        ->groupBy('orders.customer_id')
                                                                                        ->pluck('total_order_qty', 'orders.customer_id');

                                                                                    // Fetch total dispatched qty per customer for the given model code
                                                                                    $dispatchedQuantities = DB::table('dispatch_details')
                                                                                        ->join('dispatchs', 'dispatch_details.invoice_no', '=', 'dispatchs.invoice_no')
                                                                                        ->select('dispatchs.customer_id', DB::raw('SUM(dispatch_details.item_qty) as total_dispatch_qty'))
                                                                                        ->where('dispatch_details.item_code', $vl->model_code)
                                                                                        ->groupBy('dispatchs.customer_id')
                                                                                        ->pluck('total_dispatch_qty', 'dispatchs.customer_id');

                                                                                    // Calculate pending qty = ordered - dispatched for each customer
                                                                                    $pendingQuantities = [];
                                                                                    foreach ($orderQuantities as $customerId => $orderQty) {
                                                                                        $dispatchedQty = $dispatchedQuantities[$customerId] ?? 0;
                                                                                        $pendingQuantities[$customerId] = $orderQty - $dispatchedQty;
                                                                                    }
                                                                                @endphp
                                                                                @foreach ($customerNames as $customerId => $customerName)
                                                                                    @php
                                                                                        $orderQty = $orderQuantities[$customerId] ?? 0;
                                                                                        $dispatchQty = $dispatchedQuantities[$customerId] ?? 0;
                                                                                        $pendingQty = $pendingQuantities[$customerId] ?? ($orderQty - $dispatchQty);
                                                                                    @endphp
                                                                                    <tr>
                                                                                        <td>{{ $loop->iteration }}</td>
                                                                                        <td>{{ $customerName }}</td>
                                                                                        <td style="text-align:center;">{{ $orderQty }}</td>
                                                                                        <td style="text-align:center;">{{ $dispatchQty }}</td>
                                                                                        <td style="text-align:center;">{{ $pendingQty }}</td>
                                                                                    </tr>
                                                                                @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td style="text-align: center;">
                                                        <span data-toggle="modal" data-target="#updateAdjQtyModal{{ $vl->id }}" 
                                                            style="text-align:center;font-size: 12px;cursor:pointer;border-bottom: 1px dashed #8b93a3;">
                                                            <span title="Click to update adjusting pending qty">
                                                                {{ !empty($vl->adjust_production_qty) ? $vl->adjust_production_qty : 0 }}
                                                            </span>
                                                        </span>
                                                    </td>
                                                    <td style="text-align: center;">{{$totalPendingQty}}</td>
                                                    <td style="text-align: center;">{{$assembly_ok_qty}}</td>
                                                    <td style="text-align: center;">{{$assembly_not_ok_qty}}</td>
                                                    <td style="text-align: center;">{{$testing_ok_qty}}</td>
                                                    <td style="text-align: center;">{{$testing_not_ok_qty}}</td>
                                                    <td style="text-align: center;">{{$painting_ok_qty}}</td>
                                                    <td style="text-align: center;">{{$painting_not_ok_qty}}</td>
                                                    <td style="text-align: center;">{{$packing_ok_qty}}</td>
                                                    <td style="text-align: center;">{{$packing_not_ok_qty}}</td>
                                                </tr>
                                                <!-- Modal -->
                                                <div class="modal fade" id="updateAdjQtyModal{{ $vl->id }}" tabindex="-1" role="dialog" 
                                                    aria-labelledby="updateAdjQtyModalLabel{{ $vl->id }}" aria-hidden="true">
                                                    <form method="post" enctype="multipart/form-data" action="{{ route('update.model.adj.qty') }}">
                                                        @csrf
                                                        <input type="hidden" name="model_code" value="{{ $vl->model_code }}">

                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Adjust Pending Qty For {{ $vl->model_code }}</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="text-align:left;min-height: 180px;overflow-y:scroll;padding:1rem;">
                                                                    <div class="row">
                                                                        <div class="col-md-6 mb-2">
                                                                            <div class="form-group">
                                                                                <label for="roundOffValue{{ $vl->id }}">Enter Number to Round OFF Total Pending Qty:</label>
                                                                                <input type="text" name="roundOffValue" id="roundOffValue{{ $vl->id }}" class="form-control">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-success">Submit</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
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
        }

    </style>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                dom: 'Bfrtip',
                buttons: [],
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
