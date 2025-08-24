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
                                            <h4 class="header-title">Spare Parts Details
                                                @if(session()->get('partner_type')!='Accounts')

                                                <a href="{{ route('add.part.code') }}" class="btn btn-primary btns"> <i class="fa fa-plus-circle"></i> Add New Parts Details </a></h4>
                                                @endif
                                                <div class="table-responsive datatable-primary">
                                                    <table id="dataTable" class="text-center boh">
                                                        <thead class="text-capitalize">
                                                            <tr>
                                                                <th>S.NO </th>
                                                                <th>Part Code</th>
                                                                <th>Part Name</th>
                                                                <th>HSN Code</th>
                                                                <th>Part Category</th>
                                                                <th>Part price</th>
                                                                <th>Part Gst Percentage</th>
                                                                <th>Date</th>
                                                                @if(session()->get('partner_type')!='Accounts')
                                                                <th>Action</th>
                                                                @endif
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($parts_list as $key=>$vl)

                                                            @php

                                                            $cat_id=$vl->category_id;
                                                            $from= DB::table('spareparts_models')->where('id',$cat_id)->first();

                                                            @endphp
                                                            @if ($from)
                                                            @php
                                                            $c_name=$from->category_name
                                                            @endphp
                                                            @else
                                                            @php
                                                            $c_name='';
                                                            @endphp
                                                            @endif


                                                            <tr>
                                                                <td>{{$key+1}}</td>
                                                                <td>{{$vl->part_code}}</td>
                                                                <td>{{ucfirst($vl->part_name)}}</td>
                                                                <td>{{ucfirst($vl->hsn_code)}}</td>
                                                                <td>{{$c_name}}</td>
                                                                <td>{{$vl->price}}</td>
                                                                <td>{{$vl->gst_percentage}}</td>
                                                                <td>{{basicDateFormat($vl->created_at)}}</td>


                                                                @if(session()->get('partner_type')!='Accounts')


                                                                <td class="editc"><a href="{{route('part.code.edit',$vl->id)}}"><i  data-placement="top" title="Edit" class="fa fa-edit" style="color:#056c91"></i></a>
                                                                    &nbsp;&nbsp;
                                                                    <form onclick="return check_submit()" action="{{route("part.code.delete",$vl->id)}}" method="GET">
                                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                        <button><i  data-placement="top" title="Delete" class="fa fa-trash" style="color:red"></i></button>
                                                                    </form>
                                                                </td>
                                                                @endif






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
                                            function check_submit() {
                                                var tod = confirm("Are you sure you want to delete?");
                                                if (tod) {
                                                    return true;
                                                } else {

                                                    return false;
                                                }

                                            }

                                        </script>



                                        @include('logics.include.datatable')



                                        <!--=========================*
                                            Scripts
                                            *===========================-->


                                        </body>
                                        </html>
