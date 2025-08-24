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

    <script src="{{asset('user/new_js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('user/new_js/jquery.js')}}"></script>
    <link rel="stylesheet" href="{{asset('user/new_css/choices.min.css')}}">
    <link rel="stylesheet" href="{{asset('user/new_css/bootstrap.min.css')}}">
    <script src="{{asset('user/vendors/sweetalert2/js/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('user/vendors/sweetalert2/js/sweetalert2.all.min.js')}}"></script>

    <script src="{{asset('user/new_js/choices.min.js')}}"></script>

    <script src="{{asset('user/new_js/bootstrap.bundle.min.js')}}"></script>

    <!--=========================*
        Page Title
    *===========================-->
    <title>ERP</title>

    <style>
            .extra {
                font-size: 20px;

                background-color: #ffffff;
                padding-top: 10px;
                padding-bottom: 10px;
                border-radius: 5px;

            }


            .mt-4 {
                margin-top: 0 rem !important;
            }

            .choices__inner {
                min-height: 0px !important;
                background-color: white !important;
            }

            .choices__input {
                background-color: white !important;
                padding: 0px;
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
                        <h4 class="header-title">Daily Plan
                            <!-- <a href="{{ route('contact.import') }}"class="btn btn-primary btns "><i class="fa fa-pencil"></i> Bulk Import</a> -->
                            <button data-toggle="modal" data-target="#addDailyPlan" class="btn btn-primary btns mr-2"><i class="fa fa-plus-circle"></i> Add Plan</button>
                        </h4>
                        
                        <br>

                        <div class="table-responsive datatable-primary">
                            <table id="dataTable" style="width: 100%;text-align:center;">
                                <thead>
                                    <tr style="text-align:center;">
                                        <th style="text-align:center;">S.No.</th>
                                        <th style="text-align:center;">Date</th>
                                        <th style="text-align:center;">Model Code</th>
                                        <th style="text-align:center;">Description</th>
                                        <th style="text-align:center;">Qty</th>
                                        <th style="text-align:center;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($daily_plans as $key => $vl)
                                        @php
                                            $p_model = DB::table('p_models')->where('model_code',$vl->model_code)->first();
                                        @endphp
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{date('d-m-Y',strtotime($vl->plan_date))}}</td>
                                            <td>{{ $vl->model_code }}</td>
                                            <td>{{ $p_model->model_desc }}</td>
                                            <td>{{ $vl->qty }}</td>
                                            <td class="editc">
                                                <a href="#" data-toggle="modal" data-target="#editDailyPlan{{ $vl->id }}" ><i data-placement="top" title="Edit" class="fa fa-edit" style="color:#056c91"></i></a>
                                                &nbsp;&nbsp;
                                                <a onclick="return del('{{ $vl->id }}');"><i data-placement="top" title="Delete" class="fa fa-trash" style="color:red"></i></a>
                                            </td>
                                        </tr>
                                    
                                        <!-- Edit Daily Plan Modal -->
                                        <div class="modal fade" id="editDailyPlan{{$vl->id}}" tabindex="-1" role="dialog" aria-labelledby="editDailyPlanLabel{{$vl->id}}" aria-hidden="true">
                                            <form method="post" enctype="multipart/form-data" action="{{ route('update.daily.plan') }}">
                                                @csrf

                                                <input type="hidden" name="plan_id" value="{{ $vl->id }}">
                                                
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Update New Plan</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body" style="text-align:left;padding:1rem;">
                                                            <div class="row">
                                                                <div class="col-md-12 mb-2">
                                                                    <div class="form-group">
                                                                        <label for="eplanDate">Plan Date:</label>
                                                                        <input type="date" name="eplanDate" id="eplanDate" class="form-control" value="{{ date('Y-m-d', strtotime($vl->plan_date)) }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12 mb-2">
                                                                    <div class="form-group">
                                                                        <label for="emodel_code">Model Code</label>
                                                                        <select id="emodel_code" required="" name="emodel_code" class="form-control model_code selectsearch">
                                                                            @php
                                                                                $prod_models = DB::table('p_models')->where('status', 'Enable')->orderby('order', 'asc')->get();
                                                                            @endphp
                                                                            <option value="">Select Model Code</option>
                                                                            @foreach ($prod_models as $key => $val)
                                                                                <option value="{{ $val->model_code }}" {{ $vl->model_code == $val->model_code ? 'selected' : '' }}>
                                                                                    {{ $val->model_code }} - {{ $val->model_desc }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12 mb-2">
                                                                    <div class="form-group">
                                                                        <label for="eqty">Qty:</label>
                                                                        <input type="text" name="eqty" id="eqty" class="form-control" value="{{$vl->qty}}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-success">Submit</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
                
        </div>
    </div>
    
    <!-- Add Daily Plan Modal -->
    <div class="modal fade" id="addDailyPlan" tabindex="-1" role="dialog" aria-labelledby="addDailyPlanLabel" aria-hidden="true">
        <form method="post" enctype="multipart/form-data" action="{{ route('add.daily.plan') }}">
            @csrf
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add New Plan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="text-align:left;padding:1rem;">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label for="planDate">Plan Date:</label>
                                    <input type="date" name="planDate" id="planDate" class="form-control" value="{{ today()->toDateString() }}">

                                </div>
                            </div>
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label for="model_code">Model Code</label>
                                    <select id="model_code" required="" name="model_code" class="form-control model_code selectsearch">
                                        @php
                                            $p_models = DB::table('p_models')->where('status', 'Enable')->orderby('order', 'asc')->get();
                                        @endphp
                                        <option value="">Select Model Code</option>
                                        @foreach ($p_models as $key => $vl)
                                            <option value="{{ $vl->model_code }}"> {{ $vl->model_code }} - {{ $vl->model_desc }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label for="qty">Qty:</label>
                                    <input type="text" name="qty" id="qty" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    
    <!--==================================*
        End Main Section
    *====================================-->


    <!--=================================*
        Footer Section
    *===================================-->
    
    <!--=================================*
        End Footer Section
    *===================================-->

    <!--=========================*
        End Page Container
    *===========================-->
    <script>
        function del(id) {
            var chs = confirm('Are you sure you want to delete this plan?');
            if (chs) {
                document.location.href = "{{ url('delete_daily_plan') }}/" + id;
            }

        }

        $(document).ready(function() {
            $('#dataTable').DataTable({
                dom: 'Bfrtip'
            });
        });
    </script>
    @include('logics.include.datatable')

    <footer>
        @include('logics.include.footer_select')
    </footer>
    <!--=========================*
        Scripts
    *===========================-->


</body>

</html>
