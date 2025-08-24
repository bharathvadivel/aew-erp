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
                            <h4 class="header-title">Service Center Executives
                                @if(session()->get('partner_type')!='Accounts')

                                @if (session()->get('partner_type')=='admin')
                                <a href="{{ route('executive') }}" class="btn btn-primary btns"> <i class="fa fa-plus-circle"></i> Add Service Center Executive</a>
                                @else
                                <a href="{{ route('executive.service.center') }}" class="btn btn-primary btns"> <i class="fa fa-plus-circle"></i> Add Service Center Executive</a>
                                @endif
                                @endif
                            </h4>
                            <br>


                            <div class="table-responsive datatable-primary">
                                <table id="dataTable2" class="display" style="width:100%">
                                    <thead class="text-capitalize">
                                        <tr>
                                            <th>S.NO </th>
                                            <th>Service Center Executive-ID</th>
                                            <th>Name (Executive)</th>
                                            <th>Email (Executive)</th>
                                            <th>DOB (Executive)</th>
                                            <th>ID-Proof</th>
                                            <th>Service center</th>
                                            <th>Address (Executive)</th>
                                            <th>Pincode (Executive)</th>
                                            <th>Phone (Executive)</th>
                                            <th>City (Executive)</th>
                                            <th>District (Executive)</th>
                                            <th>State (Executive)</th>
                                            <th>Country (Executive)</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                            @if(session()->get('partner_type')!='Accounts')

                                            <th>Action</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($executive as $key=>$vl)
                                        @php
                                        $color= $vl->status=='Enable'? 'green' : 'red';
                                        $color="color:".$color;
                                        $data = DB::table('services')->where('service_id',$vl->service_id)->get();
                                        @endphp
                                        @if ($data->isEmpty())
                                        @php
                                        $sname='';
                                        @endphp

                                        @else
                                        @php
                                        $sname=$data[0]->service_center_name;
                                        @endphp

                                        @endif
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$vl->executive_id}}</td>
                                            <td>{{$vl->name}}</td>
                                            <td>{{$vl->email}}</td>
                                            <td>{{$vl->dob}}</td>
                                            <td><a href="{{ $vl::Proof($vl->proof)}}" target="_blank"><img src="{{ asset('file.png') }}"></a></td>
                                            <td>{{$sname}}</td>
                                            <td>{{$vl->address}}</td>
                                            <td>{{$vl->pin_code}}</td>
                                            <td>{{$vl->phone}}</td>
                                            <td>{{$vl->city}}</td>
                                            <td>{{$vl->district}}</td>
                                            <td>{{$vl->state}}</td>
                                            <td>{{$vl->country}}</td>
                                            <td style="{{ $color }}">{{$vl->status}}</td>
                                            <td>{{basicDateFormat($vl->created_at)}}</td>
                                            @if(session()->get('partner_type')!='Accounts')

                                            <td class="editc"><a href="{{route('executive.edit',$vl->id)}}"><i  data-placement="top" title="Edit" class="fa fa-edit" style="color:#056c91"></i></a>

                                                {{-- <form onsubmit="return confirm('Are you sure you want to delete?');" action="{{ route('executive.delete',$vl->id)}}" method="POST">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <button><i  data-placement="top" title="Delete" class="fa fa-trash" style="color:red"></i></button>
                                                </form> --}}
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
            margin-top: 21px;

        }

    </style>

    <script>
        $(document).ready(function() {
            $('#dataTable2').DataTable({
                dom: 'Bfrtip'
                , buttons: [{
                        extend: 'copy'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15]
                        }
                    }
                    , {
                        extend: 'csv'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15]
                        }
                    }
                    , {
                        extend: 'excel'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15]
                        }
                    }
                    , {
                        extend: 'pdf'
                        , orientation: 'landscape'
                        , exportOptions: {
                            columns: [0, 1, 2, 4, 6, 7, 8, 9, 14]
                        }
                    }
                    , {
                        extend: 'print'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15]
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
