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
                            <h4 class="header-title">Service Center
                                @if(session()->get('partner_type')!='Accounts')
                                <a href="{{ route('add.service') }}" class="btn btn-primary btns"> <i class="fa fa-plus-circle"></i> Add Service Center</a>
                                @endif

                            </h4>
                            <br>


                            <div class="table-responsive datatable-primary">
                                <table id="dataTable2" class="display" style="width:100%">
                                    <thead class="text-capitalize">
                                        <tr>
                                            <th>S.NO </th>
                                            <th>Service Center-ID</th>
                                            <th>Service Center Name</th>
                                            <th>Owner Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>GSTIN-NO</th>
                                            <th>Address</th>
                                            <th>Pincode</th>
                                            <th>City</th>
                                            <th>District</th>
                                            <th>State</th>
                                            <th>Country</th>
                                            <th>Service Category</th>
                                            <th>Service Pincode</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                            @if(session()->get('partner_type')!='Accounts')
                                            <th>Action</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($service as $key=>$vl)
                                        @php
                                        $color= $vl->status=='Enable'? 'green' : 'red';
                                        $color="color:".$color;
                                        $pincode = DB::table('servicepincodes')->where('service_id', $vl->service_id)->groupBy('service_pincode')->get();
                                        $category = DB::table('servicetypes')->where('service_id', $vl->service_id)->groupBy('service_type')->get();

                                        @endphp
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$vl->service_id}}</td>
                                            <td>{{$vl->service_center_name}}</td>
                                            <td>{{$vl->name}}</td>
                                            <td>{{$vl->email}}</td>
                                            <td>{{$vl->phone}}</td>
                                            <td>{{$vl->gstin_no}}</td>
                                            <td>{{$vl->address}}</td>
                                            <td>{{$vl->pincode}}</td>
                                            <td>{{$vl->city}}</td>
                                            <td>{{$vl->district}}</td>
                                            <td>{{$vl->state}}</td>
                                            <td>{{$vl->country}}</td>
                                            <td><select>
                                                    @foreach ($category as $set=>$ab)
                                                    <option>{{$ab->service_type}}</option>
                                                    @endforeach
                                                </select></td>
                                            <td><select>
                                                    @foreach ($pincode as $set=>$jk)
                                                    <option>{{$jk->service_pincode}}</option>
                                                    @endforeach
                                                </select></td>
                                            <td style="{{ $color }}">{{$vl->status}}</td>
                                            <td>{{basicDateFormat($vl->created_at)}}</td>
                                            @if(session()->get('partner_type')!='Accounts')

                                            <td><a href="{{route('service.edit',$vl->id)}}"><i  data-placement="top" title="Edit" class="fa fa-edit" style="color:#056c91;margin: 10px;"></i></a>
                                                {{-- <a style="padding: 11px;" href="{{route('enquiry.manage.admin',$vl->service_id)}}"><i class="fa fa-check" style="color:#056c91"></i></a> --}}


                                                <!-- <form onsubmit="return confirm('Are you sure you want to delete?');" action="{{ route('service.delete',$vl->id)}}" method="POST">
                                                                    <input type="hidden" name="_method" value="DELETE">
                                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                    <button><i  data-placement="top" title="Delete" class="fa fa-trash" style="color:red"></i></button>
                                                                </form> -->
                                                @if (session()->get('partner_type')=='admin')

                                                <form onsubmit="return confirm('Are you sure you want to login?');" action="{{ route('login.by.admin')}}" method="POST">
                                                    <input type="hidden" name="_method" value="POST">
                                                    <input type="hidden" name="phone" value="{{$vl->phone}}">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <button style="margin:12px"><i  data-placement="top" title="Login"  class="fa fa-sign-in" style="color:red"></i></button>

                                                </form>
                                                @endif

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
            $('#dataTable2').DataTable({
                dom: 'Bfrtip'
                , buttons: [{
                        extend: 'copy'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16]
                        }
                    }
                    , {
                        extend: 'csv'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16]
                        }
                    }
                    , {
                        extend: 'excel'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16]
                        }
                    }
                    , {
                        extend: 'pdf'
                        , orientation: 'landscape'
                        , exportOptions: {
                            columns: [0, 1, 2, 5, 7, 8, 13, 14, 15, 16]
                        }
                    }
                    , {
                        extend: 'print'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16]
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
