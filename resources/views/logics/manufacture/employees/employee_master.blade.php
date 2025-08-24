<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>

    <!--=========================*
        Met Data
    *===========================-->
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{asset('user/new_npm_css/bootstrap.min.css')}}" rel="stylesheet" crossorigin="anonymous">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('logics.include.datatabledesign')

    <!--=========================*
        Page Title
    *===========================-->
    <title>ERP</title>

    <style>
        .dts {
            display: flex;
            flex-direction: row;
            justify-content: start;
            top: 0px;
            left: 0;
            margin-bottom: 15px;
            flex-wrap: wrap;
            width: 25% !important;
        }

        .dte {
            display: flex;
            flex-direction: row;
            justify-content: end;
            margin-bottom: 15px;
            flex-wrap: wrap;
            width: 100% !important;
        }

        .dtslable {
            color: #eb7b18;
        }

        label {
            cursor: pointer;
            font-size: 20px;
        }

        .boh {

            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            padding-bottom: 50px;
            padding-top: 50px;
        }

        i.fa {
            display: inline-block;
            border-radius: 60px;
            padding: 0.5em 0.6em;
            

        }

        .status_color {
            border: 3px solid #000000;
            padding: 5px;
        }

        .btn {
            background-color: silver;
        }

        #tab1Content {
            display: block;
        }

        #tab2Content {
            display: none;
        }

        @media only screen and (min-width: 576px) {

            .modal-dialog {
                max-width: 500px !important;
                margin: 1.75rem auto;
            }
        }

        .arrow_icon {
            background: transparent !important;
        }

        .thdis {
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

            <div class="col-xl-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h4 class="header-title">Employees
                            <!-- <a href="{{ route('contact.import') }}"class="btn btn-primary btns "><i class="fa fa-pencil"></i> Bulk Import</a> -->
                            <a href="{{ route('add.employee') }}"class="btn btn-primary btns mr-2"><i class="fa fa-plus-circle"></i> Add Employee</a>
                        </h4>
                        
                        <br>

                        <div class="table-responsive datatable-primary">
                            <table id="dataTable" style="width: 100%;text-align:center;">
                                <thead>
                                    <tr style="text-align:center;">
                                        <th style="text-align:center;">S.No.</th>
                                        <th style="text-align:center;">Employee No</th>
                                        <th style="text-align:center;">Employee Name</th>
                                        <th style="text-align:center;">Department</th>
                                        <th style="text-align:center;">Designation</th>
                                        <th style="text-align:center;">Date of Joining</th>
                                        <th style="text-align:center;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($employees as $key => $vl)
                                        
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $vl->employee_no }}</td>
                                            <td>{{ $vl->employee_name }}</td>
                                            <td>{{ $vl->department }}</td>
                                            <td>{{ $vl->designation }}</td>
                                            <td>{{ $vl->date_of_joining }}</td>
                                            <td class="editc">
                                                <a href="{{ url('employee_edit/' . $vl->id) }}"><i data-placement="top" title="Edit" class="fa fa-edit" style="color:#056c91"></i></a>
                                                &nbsp;&nbsp;
                                                <a onclick="return del('{{ $vl->id }}');"><i data-placement="top" title="Delete" class="fa fa-trash" style="color:red"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
                
        </div>
    </div>

    <!--==================================*
        End Main Section
    *====================================-->


    <!--=================================*
        Footer Section
    *===================================-->
    <footer>
        @include('logics.include.footer')
    </footer>
    <!--=================================*
        End Footer Section
    *===================================-->

    <!--=========================*
        End Page Container
    *===========================-->
    <script>
        function del(id) {
            var chs = confirm('Are you sure you want to delete this Employee?');
            if (chs) {
                document.location.href = "{{ url('employee_delete') }}/" + id;
            }

        }

        $(document).ready(function() {
            $('#dataTable').DataTable({
                dom: 'Bfrtip'
                , buttons: [{
                        extend: 'copy'
                        , exportOptions: {
                            columns: [1, 2, 3, 4, 5]
                        }
                    }
                    , {
                        extend: 'csv'
                        , exportOptions: {
                            columns: [1, 2, 3, 4, 5]

                        }
                    }
                    , {
                        extend: 'excel'
                        , exportOptions: {
                            columns: [1, 2, 3, 4, 5]
                        }
                    }
                    , {
                        extend: 'pdf'
                        , orientation: 'landscape'
                        , exportOptions: {
                            columns: [1, 2, 3, 4, 5]
                        }
                    }
                    , {
                        extend: 'print',
                        orientation: 'landscape',
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5]
                        }
                    }


                ],

            });
        });
    </script>
    @include('logics.include.datatable')


    <!--=========================*
        Scripts
    *===========================-->


</body>

</html>
