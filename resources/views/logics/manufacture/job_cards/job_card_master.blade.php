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
                        <h4 class="header-title">Job Cards
                            <!-- <a href="{{ route('contact.import') }}"class="btn btn-primary btns "><i class="fa fa-pencil"></i> Bulk Import</a> -->
                            <a href="{{ route('add.job.card') }}"class="btn btn-primary btns mr-2"><i class="fa fa-plus-circle"></i> Add Job Card</a>
                        </h4>
                        
                        <br>

                        <div class="table-responsive datatable-primary">
                            <table id="dataTable" style="width: 100%;text-align:center;">
                                <thead>
                                    <tr style="text-align:center;">
                                        <th style="text-align:center;">S.No.</th>
                                        <th style="text-align:center;">Employee</th>
                                        <th style="text-align:center;">Date</th>
                                        <th style="text-align:center;">Department</th>
                                        <th style="text-align:center;">Model Code</th>
                                        <th style="text-align:center;">Assigned Qty</th>
                                        <th style="text-align:center;">Approved Qty</th>
                                        <th style="text-align:center;">Defective Qty</th>
                                        <th style="text-align:center;">Start Time</th>
                                        <th style="text-align:center;">End Time</th>
                                        <th style="text-align:center;">Remarks</th>
                                        <th style="text-align:center;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($job_cards as $key => $vl)
                                    
                                        @php
                                            $emp_detail = DB::table('employees')->where('id',$vl->employee_id)->first();
                                            $model_detail = DB::table('p_models')->where('model_code',$vl->model_code)->first();
                                        @endphp
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $emp_detail->employee_no }} - {{ $emp_detail->employee_name }}</td>
                                            <td>{{date('d-m-Y',strtotime($vl->job_date))}}</td>
                                            <td>{{ $vl->worked_dept }}</td>
                                            <td>{{ $vl->model_code }}</td>
                                            <td>{{ $vl->assigned_qty }}</td>
                                            <td>{{ $vl->approved_qty }}</td>
                                            <td>{{ $vl->defective_qty }}</td>
                                            <td>{{date('h:i A',strtotime($vl->start_time))}}</td>
                                            <td>{{date('h:i A',strtotime($vl->end_time))}}</td>
                                            <td>{{ $vl->remarks }}</td>
                                            <td class="editc">
                                                <a href="{{ url('job_card_edit/' . $vl->id) }}"><i data-placement="top" title="Edit" class="fa fa-edit" style="color:#056c91"></i></a>
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
            var chs = confirm('Are you sure you want to delete this Job Card?');
            if (chs) {
                document.location.href = "{{ url('job_card_delete') }}/" + id;
            }

        }

        $(document).ready(function() {
            $('#dataTable').DataTable({
                dom: 'Bfrtip'
            });
        });
    </script>
    @include('logics.include.datatable')


    <!--=========================*
        Scripts
    *===========================-->


</body>

</html>
