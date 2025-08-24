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
                            <h4 class="header-title">Regional Head
                                @if (session()->get('partner_type')!='HR' && session()->get('partner_type')!='Accounts')


                                <a href="{{ route('regional') }}" class="btn btn-primary btns"> <i class="fa fa-plus-circle"></i> Add Regional Head</a>
                          @endif
                            </h4>
                            <br>


                            <div class="table-responsive datatable-primary">
                                <table id="dataTable2" class="display" style="width:100%">
                                    <thead class="text-capitalize">
                                        <tr>
                                            <th>S.NO </th>
                                            <th>Regional Head-ID</th>
                                            <th>Name (Regional head)</th>
                                            <th>Email (Regional head)</th>
                                            <th>DOB (Regional head)</th>
                                            <th>Address (Regional head)</th>
                                            <th>Pincode (Regional head)</th>
                                            <th>Phone (Regional head)</th>
                                            <th>City (Regional head)</th>
                                            <th>District (Regional head)</th>
                                            <th>State (Regional head)</th>
                                            <th>Country (Regional head)</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                             @if (session()->get('partner_type')!='HR' && session()->get('partner_type')!='Accounts')


                                            <th>Action</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($regional as $key=>$vl)
                                        @php
                                        $color= $vl->status=='Enable'? 'green' : 'red';
                                        $color="color:".$color;
                                       $dis = DB::table('listasmids')->where('regional_id',$vl->regional_id)->get();

                                        @endphp
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$vl->regional_id}}</td>
                                            <td>{{$vl->name}}</td>
                                            <td>{{$vl->email}}</td>
                                            <td>{{$vl->dob}}</td>


                                            <td>{{$vl->address}}</td>
                                            <td>{{$vl->pin_code}}</td>
                                            <td>{{$vl->phone}}</td>
                                            <td>{{$vl->city}}</td>
                                            <td>{{$vl->district}}</td>
                                            <td>{{$vl->state}}</td>
                                            <td>{{$vl->country}}</td>
                                            <td style="{{ $color }}">{{$vl->status}}</td>
                                            <td>{{basicDateFormat($vl->created_at)}}</td>
                                             @if (session()->get('partner_type')!='HR' && session()->get('partner_type')!='Accounts')

                                            <td><a href="{{route('regional.edit',$vl->id)}}"><i  data-placement="top" title="Edit" class="fa fa-edit" style="color:#056c91"></i></a>

                                                <!-- <form onsubmit="return confirm('Are you sure you want to delete?');" action="{{ route('regional.delete',$vl->id)}}" method="POST">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <button><i  data-placement="top" title="Delete" class="fa fa-trash" style="color:red"></i></button>
                                                </form> -->
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
        <script>
                                $(document).ready(function() {
                                    $('#dataTable2').DataTable( {
                                        dom: 'Bfrtip',
                                        buttons: [
                                        {
                                            extend: 'copy',
                                            exportOptions: {
                                                columns: [ 0, 1, 2,3,4,5,6,7,8,9,10,11,12,13,14]
                                            }
                                        },
                                        {
                                            extend: 'csv',
                                            exportOptions: {
                                                columns: [ 0, 1, 2,3,4,5,6,7,8,9,10,11,12,13,14]
                                            }
                                        },
                                        {
                                            extend: 'excel',
                                            exportOptions: {
                                              columns: [ 0, 1, 2,3,4,5,6,7,8,9,10,11,12,13,14]
                                            }
                                        },
                                        {
                                            extend: 'pdf',
                                            orientation:'landscape',
                                            exportOptions: {
                                                columns: [ 0, 1, 2,4,5,6,7,8,13]
                                            }
                                        },
                                        {
                                            extend: 'print',
                                            exportOptions: {
                                                columns: [ 0, 1, 2,3,4,5,6,7,8,9,10,11,12,13,14]
                                            }
                                        }


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
