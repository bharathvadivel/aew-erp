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
                            <h4 class="header-title">Employee
                                <a href="{{ route('add.employee') }}" class="btn btn-primary btns"> <i class="fa fa-plus-circle"></i> Add Employee</a>
                            </h4>
                            <br>


                            <div class="table-responsive datatable-primary">
                                <table id="dataTable2" class="display" style="width:100%">
                                    <thead class="text-capitalize">
                                        <tr>
                                            <th>S.NO </th>
                                            <th>Employee-ID</th>
                                            <th>Name (Employee)</th>
                                            <th>Father/Guardian/Spouse Name </th>
                                            <th>Father/Guardian/Spouse Mobile No.</th>
                                            <th>Address (Employee)</th>
                                            <th>DOB (Employee)</th>
                                            <th>Personal Mobile No. (Employee)</th>
                                            <th>E-mail ID (Employee)</th>
                                            <th>Emergency Conatct No. (Employee)</th>
                                            <th>Bank Name (Employee)</th>
                                            <th>Bank Account No (Employee)</th>
                                            <th>IFSC Code (Employee)</th>
                                            <th>Branch Name (Employee)</th>
                                            <th>Passport No. (Employee)</th>
                                            <th>Date of joining (Employee)</th>
                                            <th>Blood Group (Employee)</th>
                                            <th>Aadhar No. (Employee) </th>
                                            <th>Passport Size Photo</th>
                                            <th>Aadhar Proof</th>
                                            <th>Driving License </th>
                                            <th>Certificate Of Education</th>
                                            <th>Employee Type</th>
                                            <th>Status</th>
                                            <th>Print</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($employee as $key=>$vl)
                                        @php
                                        $color= $vl->status=='Enable'? 'green' : 'red';
                                        $color="color:".$color;
                                        @endphp
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$vl->emp_id}}</td>
                                            <td>{{$vl->name}}</td>
                                            <td>{{$vl->a_name}}</td>
                                            <td>{{$vl->a_phone}}</td>
                                            <td>{{$vl->address}}</td>
                                            <td>{{$vl->phone}}</td>
                                            <td>{{$vl->dob}}</td>
                                            <td>{{$vl->email}}</td>
                                            <td>{{$vl->e_phone}}</td>
                                            <td>{{$vl->bank}}</td>
                                            <td>{{$vl->account_no}}</td>
                                            <td>{{$vl->ifsc_code}}</td>
                                            <td>{{$vl->branch}}</td>
                                            <td>{{$vl->passport_no}}</td>
                                            <td>{{$vl->doj}}</td>
                                            <td>{{$vl->blood_group}}</td>
                                            <td>{{$vl->aadhar_no}}</td>

                                            <td><a href="{{ $vl::proof($vl->photo) }}" target="_blank"><img style="width: 34px;"  src="{{ asset('file.png') }}"></a></td>
                                            <td><a href="{{ $vl::proof($vl->aadhar) }}" target="_blank"><img  style="width: 34px;" src="{{ asset('file.png') }}"></a></td>
                                            <td><a href="{{  $vl::proof($vl->license) }}" target="_blank"><img style="width: 34px;"  src="{{ asset('file.png') }}"></a></td>
                                            <td><a href="{{  $vl::proof($vl->education) }}" target="_blank"><img  style="width: 34px;" src="{{ asset('file.png') }}"></a></td>

                                            <td>{{$vl->employee_type}}</td>

                                            <td style="{{ $color }}">{{$vl->status}}</td>

                                            <td><a target="_blank" href="{{route('employee.print',$vl->id)}}"><i  data-placement="top" title="Employee Details" class="fa fa-print" style="color:green"></i></a>

                                            <td><a href="{{route('employee.edit',$vl->id)}}"><i  data-placement="top" title="Edit" class="fa fa-edit" style="color:#056c91"></i></a>


                                                <form onsubmit="return confirm('Are you sure you want to delete?');" action="{{ route('employee.delete',$vl->id)}}" method="POST">
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
                                $(document).ready(function() {
                                    $('#dataTable2').DataTable( {
                                        dom: 'Bfrtip',
                                        buttons: [
                                        {
                                            extend: 'copy',
                                            exportOptions: {
                                                columns: [ 0,2,3,4,5,7,9,10,11,12,13,14,15,16,22,23]
                                            }
                                        },
                                        {
                                            extend: 'csv',
                                            exportOptions: {
                                                columns: [ 0, 2,3,4,5,7,9,10,11,12,13,14,15,16,22,23]
                                            }
                                        },
                                        {
                                            extend: 'excel',
                                            exportOptions: {
                                              columns: [ 0,2,3,4,5,7,9,10,11,12,13,14,15,16,22,23]
                                            }
                                        },

                                        {
                                            extend: 'print',
                                            exportOptions: {
                                                columns: [ 0,2,3,4,5,7,9,10,11,12,13,14,15,16,22,23]
                                            }
                                        }


                                        ],

                                    } );
                                } );
                            </script>
                                    @include('logics.include.datatable')



    <!--=========================*
            Scripts
*===========================-->


</body>

</html>
