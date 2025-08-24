<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <script src="{{asset('user/new_js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('user/new_js/jquery.js')}}"></script>
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
                            <h5 class="card_title " style="color:#50aaca"> Update Routing
                                <a href="{{ route('routing.master') }}" class="btn btn-primary btns"> <i class="fa fa-plus-circle"></i>Manage Routing</a>
                            </h5>
                            <hr>
                            <form method="post" enctype="multipart/form-data" action="{{route('routing.update')}}">
                                @csrf

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="row">
                                            
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="material_code">Item Code<span style="color:red">&#9733;</span></label>
                                                    <input readonly id="material_code" value="{{$material_code}}" type="text" name="material_code" class="form-control" style="background: #efefef;">
                                                </div>
                                            </div>
                                            <div class="col-md-6"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="material_desc">Item Description<span style="color:red">&#9733;</span></label>
                                                    <input id="material_desc" type="text" name="material_desc" class="form-control" value="{{$material->material_desc}}" required="">
                                                </div>
                                            </div>
                                            <div class="col-md-6"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="forNote">Note :</label>
                                                    @if($routing != null && $routing->note != null)
                                                    <textarea class="form-control" id="forNote" name="forNote" rows="3">
                                                        {{$routing->note}}
                                                    </textarea>
                                                    @else
                                                    <textarea class="form-control" id="forNote" name="forNote" rows="3"></textarea>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <div class="row">
                                            
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="converted_item_code">Converted To Item Code</label>
                                                    @if($routing != null && $routing->converted_to_item_code != null)
                                                    <input id="converted_item_code" value="{{$routing->converted_to_item_code}}" type="text" name="converted_item_code" class="form-control">
                                                    @else
                                                    <input id="converted_item_code" value="" type="text" name="converted_item_code" class="form-control">
                                                    @endif
                                                    
                                                </div>
                                            </div>
                                            <div class="col-md-6"></div>
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <div class="table-responsive datatable-primary">
                                    <table id="dataTable" class="table text-center table-striped table-bordered" style="width: 100%;">
                                        <thead class="text-capitalize">
                                            <tr>
                                                <th>Process Code</th>
                                                <th>Process Description</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><input class="opt_name form-control" type="text" name="opt_name" id="opt_name"></td>
                                                <td><input class="opt_desc form-control" type="text" name="opt_desc" id="opt_desc"></td>
                                                <td class="editc">
                                                    <a class="insert-row" onclick="insertRow()"><i data-placement="top" title="Insert" class="fa fa-plus" style="color:white; background: blue; box-shadow: none; border-radius: 3px; padding: 10px;"></i></a>
                                                </td>
                                            </tr>
                                            @foreach($routing_details as $key=>$vl)
                                                <tr>
                                                    <td>
                                                        <input hidden class="id1" type="text" name="id1" id="id1" value="{{$vl->id}}" readonly>
                                                        <input style="background: #e0e0e0;" class="opt_name2 form-control" type="text" name="opt_name2" id="opt_name2" value="{{$vl->operation_name}}" readonly>
                                                    </td>
                                                    <td><input style="background: #e0e0e0;" class="opt_desc2 form-control" type="text" name="opt_desc2" id="opt_desc2" value="{{$vl->operation_desc}}" readonly></td>
                                                    <td class="editc">
                                                        <a class="delete-row"><i data-placement="top" title="Delete" class="fa fa-trash" style="color:white; background: red; box-shadow: none; border-radius: 3px; padding: 10px;"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                
                                <hr>

                                <div>
                                    <input type="submit" name="submit" class="btn btn-primary mt-4 pl-4 pr-4">
                                </div>

                                <div class="form-row">
                                    <span style="color:red">&#9733;</span>
                                    <p>- Mandatory field</p>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

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

    <!--=========================*
        End Page Container
    *===========================-->


    <!--=========================*
        General Scripts
    *===========================-->
    <script>
        function insertRow() {
            // Get input values
            var material_code = document.getElementById('material_code').value;
            var opt_name = document.getElementById('opt_name').value;
            var opt_desc = document.getElementById('opt_desc').value;
            
            // Perform database insertion here using Ajax or another method
            // After successful insertion, append a new row to the table
            // For demonstration purposes, let's assume a successful insertion

            $.ajax({
                type: 'POST',
                url: "{{ route('routing.item.insert')}}",
                data: {
                    material_code: material_code,
                    opt_name: opt_name,
                    opt_desc: opt_desc
                },
                
                success: function(data) {
                    var val = JSON.parse(data);
                    $('#dataTable').append(val.output);
                },
                error: function(data) {
                    swal({
                        type: "error",
                        title: "Error!",
                        text: "Something went wrong, Try again later!",
                        confirmButtonText: "Dismiss",
                        buttonsStyling: !1,
                        confirmButtonClass: "btn btn-danger"
                    });
                    clearlist();
                }
            });
            clearlist();
        }

        // Event delegation for dynamically added elements
        $('#dataTable').on('click', '.delete-row', function() {

            var confs = confirm('Are you sure you want to Delete?');
            if (confs == false) {
                return false;
            }

            var material_code = document.getElementById('material_code').value;
            var id = $(this).closest('tr').find('.id1').val();

            var rowToRemove = $(this).closest('tr'); // Store the reference

            $.ajax({
                type: 'POST',
                url: "{{ route('routing.item.remove')}}",
                data: {
                    material_code: material_code,
                    id: id
                },
                
                success: function(data) {
                    var val = JSON.parse(data);
                    rowToRemove.remove(); // Use the stored reference to remove the row
                    swal({
                        type: "error",
                        title: "Deleted Successfully!",
                        text: val.message,
                        confirmButtonText: "Ok",
                        buttonsStyling: !1,
                        confirmButtonClass: "btn btn-danger"
                    });
                },
                error: function(data) {
                    swal({
                        type: "error",
                        title: "Error!",
                        text: "Something went wrong, Try again later!",
                        confirmButtonText: "Dismiss",
                        buttonsStyling: !1,
                        confirmButtonClass: "btn btn-danger"
                    });
                    clearlist();
                }
            });
            clearlist();
        });
    
        function clearlist() {
            $('.opt_name').val('');
            $('.opt_desc').val('');
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
</body>

</html>
