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

        .dataTables_length {
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
                            <h4 class="header-title">Model Image
                                <a href="{{ url('add_product_image') }}" class="btn btn-primary btns"> <i class="fa fa-plus-circle"></i> Add Product Model Details </a></h4>
                            <br>


                            <div class="table-responsive datatable-primary">

                                <table id="dataTable2" class="display" style="width:100%">


                                    <thead class="text-capitalize">
                                        <tr>
                                            <th>S.NO </th>
                                            <th>Model No.</th>
                                            <th>Image</th>
                                            <th>Features</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $key=>$row)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$row->model_no}}</td>
                                            <td><a target="_blank" href="{{$row::ModelImage($row->model_image)}}"><img style="width:70px;height:70px" src="{{$row::ModelImage($row->model_image)}}"></a></td>
                                            <td>
                                                <button><i class="fa fa-eye" data-placement="top" title="Features" data-toggle="modal" data-target="#exampleModalLong{{$row->id}}" style="color:#1e7e34"></i></button>


                                            </td>
                                            <td>
                                                <a href="{{route('product.image.edit',$row->id)}}"><i  data-placement="top" title="Edit" class="fa fa-edit" style="color:blue"></i></a>


                                                <a onclick="return del({{$row->id}})"><i  data-placement="top" title="Delete" class="fa fa-trash" style="color:red"></i></a></td>

                                        </tr>


                                        <div class="modal fade " id="exampleModalLong{{ $row->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Features</h5>
                                                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">

                                                        @php
                                                        $features = DB::table('features')->where('model_no',$row->model_no)->get();

                                                        @endphp
                                                        @if(count($features) > 0)


                                                        <div class="row">
                                                            @foreach ($features as $col=>$ab)
                                                            <div class="col-3"></div>
                                                            <div class="col-3">{{$ab->title}}</div>
                                                            <div class="col-3">{{$ab->value}}</div>
                                                            @endforeach



                                                        </div>
                                                        @else
                                                        <div class="row">
                                                            <div class="col-3">No features found</div>
                                                        </div>
                                                        @endif




                                                    </div>
                                                </div>
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
            $('#dataTable2').DataTable({


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
        function del(id) {
            var chs = confirm('Are you sure you want to delete this image?');
            if (chs) {
                document.location.href = "{{url('product_image_delete')}}/" + id;

            }

        }

    </script>




    @include('logics.include.datatable')

    <!--=========================*
                                                Scripts
                                                *===========================-->


</body>
</html>
