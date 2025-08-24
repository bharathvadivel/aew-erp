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
                                            <h4 class="header-title">Brand
                                                <a href="{{ route('brand.index') }}" class="btn btn-primary btns"> <i class="fa fa-plus-circle"></i> Add brand</a>
                                            </h4>
                                            <br>


                                            <div class="table-responsive datatable-primary">
                                                <table id="dataTable2" class="display" style="width:100%">
                                                    <thead class="text-capitalize">
                                                        <tr>
                                                            <th>S.NO </th>
                                                            <th>Brand name</th>
                                                            <th>Brand code</th>
                                                            <th>Brand image</th>
                                                            <th>status</th>
                                                            <th>date</th>
                                                            <th>action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($brand as $key=>$vl)
                                                        @php
                                                        $color= $vl->status=='Enable'? 'green' : 'red';
                                                        $color="color:".$color;

                                                        @endphp
                                                        <tr>
                                                            <td>{{$key+1}}</td>
                                                            <td>{{$vl->brand_name}}</td>
                                                            <td>{{$vl->brand_code}}</td>
                                                            <td><img style="width:70px;height:70px" src="{{ $vl::BrandImage($vl->brand_image) }}"></td>
                                                            <td style="{{ $color }}">{{$vl->status}}</td>
                                                            <td>{{basicDateFormat($vl->created_at)}}</td>
                                                            <td ><a href="{{route('brand.edit',$vl->id)}}"><i  data-placement="top" title="Edit" class="fa fa-edit" style="color:#056c91"></i></a>

                                                                <form onsubmit="return confirm('Are you sure you want to delete?');" action="{{ route('brand.destroy',$vl->id)}}" method="POST">
                                                                    <input type="hidden" name="_method" value="DELETE">
                                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                    <button><i class="fa fa-trash"  data-placement="top" title="Delete" style="color:red"></i></button>
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
                                            $('#dataTable2').DataTable( {
                                                dom: 'Bfrtip',
                                                buttons: [
                                                {
                                                    extend: 'copy',
                                                    exportOptions: {
                                                        columns: [ 0, 1, 2,4]
                                                    }
                                                },
                                                {
                                                    extend: 'csv',
                                                    exportOptions: {
                                                        columns: [ 0, 1, 2,4]
                                                    }
                                                },
                                                {
                                                    extend: 'excel',
                                                    exportOptions: {
                                                        columns: [ 0, 1, 2,4]
                                                    }
                                                },
                                                {
                                                    extend: 'pdf',
                                             orientation:'landscape',
                                                    exportOptions: {
                                                        columns: [ 0, 1, 2,4]
                                                    }
                                                },
                                                 {
                                                    extend: 'print',
                                                    exportOptions: {
                                                        columns: [ 0, 1, 2,4]
                                                    }
                                                },


                                                ],

                                            } );
                                        } );
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
