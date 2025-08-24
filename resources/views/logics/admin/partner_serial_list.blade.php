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

        @media (min-width: 576px) {
            .modal-dialog {
                max-width: 500px !important;
                margin: 1.75rem auto;
            }

            .row {
                justify-content: flex-end;
            }
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
                            <h4 class="header-title" style="display:flex;justify-content: space-between;align-content: space-around;">Serial No List
                            <a href="{{ route('add.dealer.purchase') }}" class="btn btn-primary btns"> <i class="fa fa-plus-circle"></i> Add Serial No CSV Upload</a>

                            </h4>
                            <br>

                            <br>


                            <div class="table-responsive datatable-primary">
                                <table id="dataTable2" class="text-center boh">
                                    <thead class="text-capitalize">
                                        <tr>
                                            <th>S.NO </th>
                                            <th>Product category</th>
                                            <th>Model No</th>
                                            <th>Available Quantity</th>
                                            <th>Sold Quantity</th>
                                            <th>return Quantity</th>
                                            <th>date</th>
                                            <th>action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($serials as $key=>$vl)

                                        @if ($partner_type=='sub_dealer')
                                        @php
                                        $count = DB::table('distributorserials')->where('partner_id',$partner_id)->where('model_no',$vl->model_no)->where('status','unused')->get();
                                        $count_list = DB::table('distributorserials')->where('partner_id',$partner_id)->where('model_no',$vl->model_no)->get();
                                        $sold_count = DB::table('distributorserials')->where('partner_id',$partner_id)->where('model_no',$vl->model_no)->where('status','used')->get();
                                        $return_count = DB::table('distributorserials')->where('partner_id',$partner_id)->where('model_no',$vl->model_no)->where('status','return')->get();

                                        @endphp

                                        @else

                                        @php
                                        $count = DB::table('disserials')->where('dis_id',$vl->dis_id)->where('model_no',$vl->model_no)->where('status','unused')->get();
                                        $count_list = DB::table('disserials')->where('dis_id',$vl->dis_id)->where('model_no',$vl->model_no)->get();
                                        $sold_count = DB::table('disserials')->where('dis_id',$vl->dis_id)->where('model_no',$vl->model_no)->where('status','used')->get();
                                        $return_count = DB::table('disserials')->where('dis_id',$vl->dis_id)->where('model_no',$vl->model_no)->where('status','return')->get();
                                        @endphp
                                        @endif

                                        @php
                                        $cat = DB::table('gategories')->where('id',$vl->gategory_id)->first();
                                        @endphp
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$cat ? $cat->gategory_name:''}}</td>
                                            <td>{{$vl->model_no}}</td>
                                            <td>{{count($count)}}</td>
                                            <td>{{count($sold_count)}}</td>
                                            <td>{{count($return_count)}}</td>

                                            <td>{{basicDateFormat($vl->created_at)}}</td>
                                            <td class="editc">
                                                <button><i class="fa fa-check"  data-placement="top" title="Serial" data-bs-toggle="modal" data-bs-target="#exampleModal{{$vl->id}}" style="color:green"></i></button>

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
    @foreach ($serials as $key=>$vl)
    @if ($partner_type=='sub_dealer')
    @php
    $count_list = DB::table('distributorserials')->where('partner_id',$partner_id)->where('model_no',$vl->model_no)->get();

    @endphp

    @else

    @php
    $count_list = DB::table('disserials')->where('dis_id',$vl->dis_id)->where('model_no',$vl->model_no)->get();
    @endphp
    @endif

    <div class="modal fade" id="exampleModal{{$vl->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Serial No List</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive datatable-primary">
                        <table id="dataTables{{$vl->id}}" class="text-center boh">
                            <thead class="text-capitalize">
                                <tr>
                                    <th style="text-align:center">S.NO </th>
                                    <th style="text-align:center">Serial No</th>
                                    <th style="text-align:center">Status</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($count_list as $key=>$set)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>
                                        {{$set->serial_no}}
                                    </td>
                                    @if ($set->status=='unused')
                                    <td style="color:red">
                                        In Stock
                                    </td>
                                    @elseif($set->status=='return')
                                    <td style="color:blue">
                                        Return
                                    </td>
                                    @elseif($set->status=='used')
                                    <td style="color:green">
                                        Sold
                                    </td>

                                    @else
                                    <td style="color:red">
                                        Pending
                                    </td>
                                    @endif

                                </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#dataTables{{$vl->id}}').DataTable({
                dom: 'Bfrtip'
                , buttons: [{
                        extend: 'copy'
                        , exportOptions: {
                            columns: [0, 1, 2]
                        }
                    }
                    , {
                        extend: 'csv'
                        , exportOptions: {
                            columns: [0, 1, 2]
                        }
                    }
                    , {
                        extend: 'excel'
                        , exportOptions: {
                            columns: [0, 1, 2]
                        }
                    }



                ],

            });
        });

    </script>

    @endforeach


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
                    , {
                        extend: 'pdf'
                        , orientation: 'landscape',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        }
                    }
                    , {
                        extend: 'print'
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
