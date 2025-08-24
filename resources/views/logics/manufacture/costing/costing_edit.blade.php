<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <!--=========================*
        Met Data
    *===========================-->
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{asset('user/new_npm_css/bootstrap.min.css')}}" rel="stylesheet" crossorigin="anonymous">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('logics.include.datatabledesign')

    <!--=========================*
        Page Title
    *===========================-->
    <title>ERP</title>

    <style>
        .dts {
            display: flex;
            flex-direction: row;
            justify-content: start;
            top: 0px;
            left: 0;
            margin-bottom: 15px;
            flex-wrap: wrap;
            width: 25% !important;
        }

        .dtslable {
            color: #eb7b18;
        }

        label {
            cursor: pointer;
            font-size: 20px;
        }

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

        .btn {
            background-color: silver;
        }

        #tab1Content {
            display: block;
        }

        #tab2Content {
            display: none;
        }

        @media only screen and (min-width: 576px) {

            .modal-dialog {
                max-width: 500px !important;
                margin: 1.75rem auto;
            }
        }

        .arrow_icon {
            background: transparent !important;
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
            <!-- <div class="row">
                    <div class="col-12 mt-4">
                        <center><h4 class="card_title extra" > Create Project </h4></center>
                    </div>
            </div> -->
            @include('login.flash')
            <div class="row">
                <!-- Disabled forms start -->
                <div class="col-4 mt-4" style="margin-top:0!important;">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card_title " style="color:#50aaca"> Costing for #{{$material_code}}</h5>
                            <hr>
                            <form method="post" action="{{url('costing_update')}}">
                                @csrf

                                <div class="form-group">
                                    <label for="item_code">Item Code</label>
                                    <input type="text" value="{{$material->material_code}}" id="item_code" name="item_code" class="form-control" readonly style="background-color: #e0e0e0;">
                                </div>

                                <div class="form-group">
                                    <label for="item_desc">Item Description</label>
                                    <input type="text" value="{{$material->material_desc}}" id="item_desc" name="item_desc" class="form-control" readonly style="background-color: #e0e0e0;">
                                </div>

                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="text" value="" id="price" name="price" class="form-control">
                                </div>

                                <button type="submit" class="btn btn-primary mt-4 pl-4 pr-4">Update Price</button>

                                <div class="form-row">
                                    <span style="color:red">&#9733;</span>
                                    <p>- Mandatory field</p>
                                </div>


                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-8 mt-4" style="margin-top:0!important;">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card_title " style="color:#50aaca">#{{$material_code}} Costing History</h5>
                            <hr>
                            <div class="table-responsive datatable-primary">
                                <table id="dataTable" style="width: 100%;text-align:center;">
                                    <thead>
                                        <tr style="text-align:center;">
                                            <th style="text-align:center;">#</th>
                                            <th style="text-align:center;">Created At</th>
                                            <th style="text-align:center;">Price</th>
                                            <th style="text-align:center;">Compared<br/>To Last Price</th>
                                            <th style="text-align:center;">How Much Vary<br/>From Last Price</th>
                                            <th style="text-align:center;">Entry<br/>Origin</th>
                                            <th style="text-align:center;">Invoice No</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($costing_data)
                                            @foreach ($costing_data as $key => $vl)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ date('d-m-Y', strtotime($vl->created_at)) }}<br/>{{ date('h:i:s A', strtotime($vl->created_at)) }}</td>
                                                    <td>{{ $vl->pricing }}</td>
                                                    <td>{{ $vl->up_down_same }}</td>
                                                    <td>{{ $vl->how_much }}</td>
                                                    <td>{{ $vl->entry_origin }}</td>
                                                    <td>{{ $vl->inwd_invoice_no }}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="4">No Records Found!</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>






                <!-- Disabled forms end -->
                <!-- Server side start -->

                <!-- Server side end -->
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
        @include('logics.include.footer')
    </footer>
    <!--=================================*
        End Footer Section
    *===================================-->

    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                dom: 'Bfrtip'
                , buttons: [{
                        extend: 'copy'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        }
                    }
                    , {
                        extend: 'csv'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]

                        }
                    }
                    , {
                        extend: 'excel'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        }
                    }
                    , {
                        extend: 'pdf'
                        , orientation: 'landscape'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        }
                    }
                    , {
                        extend: 'print',
                        orientation: 'landscape',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        }
                    }


                ],

            });
        });
    </script>

    @include('logics.include.datatable')

    </div>
    <!--=========================*
        End Page Container
    *===========================-->


<!--=========================*
    General Scripts
*===========================-->


</body>

</html>
