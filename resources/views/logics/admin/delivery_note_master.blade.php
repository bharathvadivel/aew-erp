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
    <title>ERP</title>

    <style>
        .boh {

            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);


            padding-bottom: 50px;
            padding-top: 50px;
        }

        i.fa {
            display: inline-block;
            border-radius: 60px;
            box-shadow: 0 0 4px #888;
            padding: 0.5em 0.6em;
            margin: 5px;

        }

        .status_color {
            border: 3px solid #000000;
            padding: 5px;
        }

        .model_color {
            border: 3px solid #ff0000 !important;

        }


        @media only screen and (min-width: 576px) {

            .modal-dialog {
                max-width: 1000px !important;
                margin: 1.75rem auto;
            }
        }

        .col-3 {
            padding-bottom: 30px;
        }

        .col-2 {
            padding-bottom: 20px;
            border: 1px solid #000000;
            text-align: center;
            padding: 6px;
            white-space: normal;
        }

        .modal-open .modal {
            overflow: scroll;
            /* overflow-x: hidden; */
            /* overflow-y: auto; */
        }

        select[multiple] option:checked {
            background: #C0C0C0;
        }



        .d-sm-flex {
            width: 100% !important;
        }

        .editc {
            display: flex;
            justify-content: space-around;

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
            @include('login.flashsearch')

            <div class="row">
                <!-- Striped table start -->
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card_title">Delivery Notes</h4>


                            <div class="single-table">
                                <div class="table-responsive">
                                    <table class="table table-striped text-center">
                                        <thead class="text-uppercase">
                                            <tr>
                                                <th>S.NO </th>
                                                <th>Invoice NO</th>
                                                <th>Invoice Date</th>
                                                <th>From Warehouse</th>
                                                <th>From Address</th>
                                                <th>Mobile Number</th>
                                                <th>Total Qty</th>
                                                <th>Grand Total</th>
                                                <th>Status</th>
                                                <th>Action</th>

                                            </tr>

                                        </thead>
                                        <tbody>
                                            @if(count($disinvoices) > 0)
                                            @foreach ($disinvoices as $key=>$vl)
                                            @php
                                            $qty = DB::table('disinvoices')->where('disinvoice_no',$vl->disinvoice_no)->sum('qty');
                                            $status_color=$vl->status=='Transfered'  ? 'green' : 'red';
                                            @endphp

                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{$vl->disinvoice_no}}</td>
                                                <td>{{date('d-m-Y',strtotime($vl->date))}}</td>
                                                <td>{{ $vl->fromwarehouse ? $vl->fromwarehouse->name:'' }}</td>
                                                <td>{{ $vl->fromwarehouse ? $vl->fromwarehouse->address:'' }}</td>
                                                <td>{{ $vl->fromwarehouse ? $vl->fromwarehouse->phone:'' }}</td>
                                                <td>{{$qty}}</td>
                                                <td>{{number_format($vl->grand_total,2)}}</td>
                                                <td style="color:{{ $status_color}}">{{$vl->status}}</td>
                                                <td class="editc">
                                                    <a target="_blank" href="{{url('warehouse-invoice-pdf/'.$vl->disinvoice_no)}}"><i  data-placement="top" title="Invoice" class="fa fa-eye" style="color:red"></i></a>
                                                    @if($vl->status=='Pending')
                                                    <form onsubmit="return confirm('Are you sure you want to approve?');" action="{{ route('warehouseinvoice.approve',$vl->disinvoice_no)}}" method="POST">
                                                        <input type="hidden" name="_method" value="POST">
                                                        <input type="hidden" name="status" value="Approved">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <button><i  data-placement="top" title="Approve" class="fa fa-check" style="color:green"></i></button>
                                                    </form>
                                                    <form onsubmit="return confirm('Are you sure you want to Reject?');" action="{{ route('warehouseinvoice.approve',$vl->disinvoice_no)}}" method="POST">
                                                        <input type="hidden" name="_method" value="POST">
                                                        <input type="hidden" name="status" value="Rejected">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <button><i  data-placement="top" title="Reject" class="fa fa-remove" style="color:red"></i></button>
                                                    </form>
                                                    @endif

                                                </td>

                                            </tr>
                                            @endforeach


                                            @else
                                            <tr>
                                                <td colspan="16">No result found</td>
                                            </tr>
                                            @endif


                                        </tbody>
                                    </table>
                                    {{$disinvoices->appends(request()->except('page'))->links('pagination::bootstrap-5')}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Striped table end -->
            </div>
        </div>
        <!--==================================*
                        End Main Section
                        *====================================-->
    </div>

    <!--=================================*
                        End Main Content Section
                        *===================================-->






    <!--=================================*
                            Footer Section
                            *===================================-->
    <footer>
        @include('logics.include.footer_select')

    </footer>
    <!--=================================*
                                End Footer Section
                                *===================================-->

    </div>
    <!--=========================*
                                End Page Container
                                *===========================-->




    <!--=========================*
                                    Scripts
                                    *===========================-->


</body>

</html>
