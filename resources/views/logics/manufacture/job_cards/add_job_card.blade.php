<!DOCTYPE html>
<html class="no-js" lang="zxx">

    <head>
        <script src="{{asset('user/new_js/jquery.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('user/new_js/jquery.js')}}"></script>
        <link rel="stylesheet" href="{{asset('user/new_css/choices.min.css')}}">
        <link rel="stylesheet" href="{{asset('user/new_css/bootstrap.min.css')}}">
        <script src="{{asset('user/vendors/sweetalert2/js/sweetalert2.all.min.js')}}"></script>
        <script src="{{asset('user/vendors/sweetalert2/js/sweetalert2.all.min.js')}}"></script>

        <script src="{{asset('user/new_js/choices.min.js')}}"></script>

        <script src="{{asset('user/new_js/bootstrap.bundle.min.js')}}"></script>

        <!--=========================*
                    Met Data
        *===========================-->
        <meta charset="UTF-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

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
            <!-- 
            <div class="row">
                <div class="col-12 mt-4">
                    <center><h4 class="card_title extra" > Create Project </h4></center>
                </div>
            </div>
            -->
            @include('login.flashsearch')

            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="row">
                <!-- Disabled forms start -->
                <div class="col-12 mt-4" style="margin-top:0!important;">
                    <div class="card">
                        <div class="card-body">
                            <form method="post" action="{{route('job.card.store')}}">
                                @csrf

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div class="card" style="box-shadow:none;border:1px solid rgba(0, 0, 0, 0.125);">
                                            <h5 class="card-header">Employee Details</h5>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="employee_id">Employee:</label>
                                                    <select id="employee_id" required="" name="employee_id" class="form-control employee_id selectsearch">
                                                        <option value="">Select Employee</option>
                                                        @foreach ($employees as $key => $vl)
                                                            <option value="{{ $vl->id }}"> {{ $vl->employee_no }} - {{ $vl->employee_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card mt-4" style="box-shadow:none;border:1px solid rgba(0, 0, 0, 0.125);">
                                            <h5 class="card-header">Job Status</h5>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="approved_qty">Approved Qty</label>
                                                    <input type="text" id="approved_qty" name="approved_qty" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="defective_qty">Defective Qty</label>
                                                    <input type="text" id="defective_qty" name="defective_qty" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card mt-4" style="box-shadow:none;border:1px solid rgba(0, 0, 0, 0.125);">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="remarks">Remarks</label>
                                                    <textarea type="text" id="remarks" name="remarks" class="form-control"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <div class="card" style="box-shadow:none;border:1px solid rgba(0, 0, 0, 0.125);">
                                            <h5 class="card-header">Job Details</h5>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="job_date">Job Date</label>
                                                    <input type="date" id="job_date" name="job_date" class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label for="department">Worked Department</label>
                                                    <select id="department" required="" name="department" class="form-control department selectsearch">
                                                        <option value="">Select Department</option>
                                                        <option value="Design">Design</option>
                                                        <option value="Development">Development</option>
                                                        <option value="Quality">Quality</option>
                                                        <option value="Winding">Winding</option>
                                                        <option value="Purchase">Purchase</option>
                                                        <option value="Store">Store</option>
                                                        <option value="Assembly">Assembly</option>
                                                        <option value="Testing">Testing</option>
                                                        <option value="Painting">Painting</option>
                                                        <option value="Packing">Packing</option>
                                                        <option value="Dispatch">Dispatch</option>
                                                        <option value="Accounts">Accounts</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="nature_of_work">Nature of Work</label>
                                                    <input type="text" id="nature_of_work" name="nature_of_work" class="form-control">
                                                </div>

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

                                                <div class="form-group">
                                                    <label for="assigned_qty">Assigned Qty</label>
                                                    <input type="number" id="assigned_qty" name="assigned_qty" class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label for="start_time">Start Time</label>
                                                    <input type="time" id="start_time" name="start_time" class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label for="end_time">End Time</label>
                                                    <input type="time" id="end_time" name="end_time" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <button id="yarabtnsubmit" type="submit" class="btn btn-primary mt-4 pl-4 pr-4">Submit</button>
                                
                                <div class="form-row">
                                    <span style="color:red">&#9733;</span>
                                    <p>- Mandatory field</p>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

                <!-- Disabled forms end -->
                <!-- Server side start -->

                <!-- Server side end -->
            </div>
        </div>
        <!--==================================*
            End Main Section
        *====================================-->
    </div>
    <!--=================================*
        End Main Content Section
    *===================================-->

    <!--=================================*
        Footer Section
    *===================================-->
    <footer>
        @include('logics.include.footer_select')

    </footer>
    <!--=================================*
        End Footer Section
    *===================================-->
    <script  type="text/javascript">
        

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
</div>
<!--=========================*
    End Page Container
*===========================-->


<!--=========================*
    General Scripts
*===========================-->


</body>
</html>
