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
                            <h4 class="header-title">Direct Partners
                                @if (session()->get('partner_type')!='Accounts')

                                <a href="{{ route('distributor') }}" class="btn btn-primary btns"> <i class="fa fa-plus-circle"></i>Add Direct Partners</a>
                                @endif
                            </h4>
                            <br>


                            <div class="table-responsive datatable-primary">
                                <table id="dataTable2" class="display" style="width:100%">
                                    <thead class="text-capitalize">
                                        <tr>
                                            <th>S.NO </th>
                                            <th>Direct Partners Type</th>
                                            <th>Direct Partners-ID</th>
                                            <th>Company/Store Name</th>
                                            <th>Owner Name</th>
                                            <th>Email</th>
                                            <th>DOB</th>
                                            <th>GSTIN-NO</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <th>Pincode</th>
                                            <th>City</th>
                                            <th>District</th>
                                            <th>State</th>
                                            <th>Country</th>
                                            <th>Credit limit</th>
                                            <th>Credit days</th>
                                            <th>TCS No</th>
                                            <th>TCS Type</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                            @if (session()->get('partner_type')!='Accounts')

                                            <th>Action</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($partner as $key=>$vl)
                                        @php
                                        $color= $vl->status=='Enable'? 'green' : 'red';
                                        $color="color:".$color;
                                        $places = DB::table('userlocations')->where('partner_id',$vl->partner_id)->get();


                                        @endphp
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$vl->partner_type}}</td>
                                            <td>{{$vl->partner_id}}</td>
                                            <td>{{$vl->store_name}}</td>
                                            <td>{{$vl->name}}</td>
                                            <td>{{$vl->email}}</td>
                                            <td>{{$vl->dob}}</td>
                                            <td>{{$vl->gstin_no}}</td>
                                            <td>{{$vl->phone}}</td>
                                            <td>
                                                <select>

                                                    @foreach ($places as $set=>$jk)
                                                    <option>{{$jk->address}}</option>
                                                    @endforeach
                                                </select>


                                            </td>
                                            <td>
                                                <select>

                                                    @foreach ($places as $set)
                                                    <option>{{$set->pincode}}</option>
                                                    @endforeach
                                                </select>


                                            </td>
                                            <td>
                                                <select>

                                                    @foreach ($places as $set)
                                                    <option>{{$set->city}}</option>
                                                    @endforeach
                                                </select>


                                            </td>
                                            <td>
                                                <select>

                                                    @foreach ($places as $set)
                                                    <option>{{$set->district}}</option>
                                                    @endforeach
                                                </select>


                                            </td>

                                            <td>{{$vl->state}}</td>
                                            <td>{{$vl->country}}</td>
                                            <td>{{$vl->credit_limit}}</td>
                                            <td>{{$vl->credit_days}}</td>
                                            <td>{{$vl->tcs_no}}</td>
                                            <td>{{$vl->tcs_type}}</td>
                                            <td style="{{ $color }}">{{$vl->status}}</td>
                                            <td>{{basicDateFormat($vl->created_at)}}</td>
                                            @if (session()->get('partner_type')!='Accounts')

                                            <td><a href="{{route('distributor.edit',$vl->id)}}"><i  data-placement="top" title="Edit" class="fa fa-edit" style="color:#056c91"></i></a>

                                                <form onsubmit="return confirm('Are you sure you want to delete?');"  action="{{ route('distributor.delete',$vl->id)}}" method="POST">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <button><i  data-placement="top" title="Delete" class="fa fa-trash" style="color:red"></i></button>
                                                </form>
                                                <form onsubmit="return confirm('Are you sure you want to login?');" action="{{ route('login.by.admin')}}" method="POST">
                                                    <input type="hidden" name="_method" value="POST">
                                                    <input type="hidden" name="phone" value="{{$vl->phone}}">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <button><i  data-placement="top" title="Login" class="fa fa-sign-in" style="color:red"></i></button>
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
            $('#dataTable2').DataTable({
                dom: 'Bfrtip'
                , buttons: [{
                        extend: 'copy'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18]
                        }
                    }
                    , {
                        extend: 'csv'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18]
                        }
                    }
                    , {
                        extend: 'excel'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18]
                        }
                    }
                    , {
                        extend: 'pdf'
                        , orientation: 'landscape'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 6, 8, 9, 10, 15, 16, 17]
                        }
                    }
                    , {
                        extend: 'print'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 17]
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
