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
                            <h4 class="header-title">Products
                                <a href="{{ route('product') }}" class="btn btn-primary btns"> <i class="fa fa-plus-circle"></i> Add Product</a></h4>
                            <br>


                            <div class="table-responsive datatable-primary">
                                <table id="dataTable2" class="display" style="width:100%">
                                    <thead class="text-capitalize">
                                        <tr>
                                            <th>S.NO </th>
                                            <th>Model No</th>
                                            <th>HSN code</th>
                                            <th>EAN</th>
                                            <th>Product description</th>
                                            <th>Category name</th>
                                            <th>Brand name</th>
                                            <th>Basic allowance</th>
                                            <th>STA</th>
                                            <th>GST</th>
                                            <th>MRP</th>
                                            <th>MOP</th>
                                            <th>Product status</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($product as $key=>$vl)
                                        @php
                                        $color= $vl->status=='Enable'? 'green' : 'red';
                                        $color="color:".$color;

                                        @endphp
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$vl->model_no}}</td>
                                            <td>{{$vl->hsn_code}}</td>
                                            <td>{{$vl->ean}}</td>
                                            <td>{{$vl->description}}</td>
                                            <td>{{$vl->gategory ? $vl->gategory->gategory_name:''}}</td>
                                            <td>{{$vl->brand ? $vl->brand->brand_name:''}}</td>
                                            <td>{{$vl->basic_allowance}}</td>
                                            <td>{{$vl->sta}}</td>
                                            <td>{{$vl->gst}}</td>
                                            <td>{{$vl->mrp}}</td>
                                            <td>{{$vl->mop}}</td>
                                            <td>{{$vl->product_status}}</td>
                                            <td style="{{ $color }}">{{$vl->status}}</td>
                                            <td>{{basicDateFormat($vl->created_at)}}</td>
                                            <td class="editc"><a href="{{route('product.edit',$vl->id)}}"><i  data-placement="top" title="Edit" class="fa fa-edit" style="color:#056c91"></i></a>

                                                {{-- <form onsubmit="return confirm('Are you sure you want to delete?');" action="{{ route('product.delete',$vl->id)}}" method="POST">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <button><i  data-placement="top" title="Delete" class="fa fa-trash" style="color:red"></i></button>
                                                </form> --}}
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
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14]
                        }
                    }
                    , {
                        extend: 'csv'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14]

                        }
                    }
                    , {
                        extend: 'excel'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14]
                        }
                    }
                    , {
                        extend: 'pdf'
                        , orientation: 'landscape'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14]
                        }
                    }
                    , {
                        extend: 'print'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14]
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
