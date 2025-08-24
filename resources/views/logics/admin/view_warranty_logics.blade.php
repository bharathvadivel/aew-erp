<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>

    <!--=========================*
                Met Data
    *===========================-->
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
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
                            <h4 class="header-title">Warranty Logics
                                <a href="{{ url('add_warranty_logics') }}" class="btn btn-primary btns"> <i class="fa fa-plus-circle"></i> Add New Logics </a></h4>
                            <br>


                            <div class="table-responsive datatable-primary">
                                <table id="dataTable" class="text-center boh">
                                    <thead class="text-capitalize">
                                        <tr>
                                            <th>S.NO </th>
                                            <th>Model No</th>
                                            <th>Product Category</th>
                                            <th>Standard Warranty</th>
                                            <th>Extended Warranty</th>
                                            <th>Part 1</th>
                                            <th>Part 1 waaranty</th>
                                            <th>Part 2</th>
                                            <th>Part 2 waaranty</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($logics_list as $key=>$vl)


                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$vl->model_no}}</td>
                                            <td>{{$vl->gategory}}</td>
                                            <td>{{$vl->standard_warranty}}</td>
                                            <td>{{$vl->extended_warranty}}</td>
                                            <td>{{$vl->part1}}</td>
                                            <td>{{$vl->part1_warranty}}</td>
                                            <td>{{$vl->part2}}</td>
                                            <td>{{$vl->part2_warranty}}</td>

                                            <td class="editc"><a target="_blank" href="{{route('edit.warranty.logics',$vl->id)}}"><i  data-placement="top" title="Edit" class="fa fa-edit" style="color:#056c91"></i></a>
                                                &nbsp;&nbsp;
                                                <a onclick="return del('{{$vl->id}}','warlogics');"><i  data-placement="top" title="Delete" class="fa fa-trash" style="color:red"></i></a></td>




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
            $('#dataTable').DataTable({
                dom: 'Bfrtip'
                , buttons: [{
                        extend: 'copy'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                        }
                    }
                    , {
                        extend: 'csv'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]


                        }
                    }
                    , {
                        extend: 'excel'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]

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

    <script>
        function del(id, table) {
            var chs = confirm('Are you sure you want to delete this Parts?');
            if (chs) {
                document.location.href = "{{url('dalete_spareparts_category')}}/" + id + "/" + table;
            }

        }

    </script>


    @include('logics.include.datatable')



    <!--=========================*
            Scripts
*===========================-->


</body>
</html>
