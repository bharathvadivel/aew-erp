<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>

    <!--=========================*
        Met Data
        *===========================-->
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="{{asset('user/vendors/sweetalert2/js/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('user/vendors/sweetalert2/js/sweetalert2.all.min.js')}}"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">

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

        h4 {
            font-size: 15px !important;
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
                            <form method="POST" action="{{route('attendance.day.report')}}">
                                @csrf
                                <div class="form-row">
                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">From Date <span style="color:red">&#9733;</span></label>
                                            <input type="date" value="{{$from_date}}" required="" name="from_date" class="form-control">

                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">To Date <span style="color:red">&#9733;</span></label>
                                            <input type="date" value="{{$to_date}}" required="" name="to_date" class="form-control">

                                        </div>
                                    </div>




                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Employee</label>
                                            <select name="partner_id" class="form-control">



                                                <option value="all">All</option>

                                                @foreach ($users as $key)
                                                <option {{$key->partner_id==$partner_id ? 'selected':''}} value="{{$key->partner_id}}">{{$key->name}} ({{$key->partner_id}})</option>



                                                @endforeach

                                            </select>

                                        </div>
                                    </div>

                                    <div class="col-md-1 mb-1">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Filter<span style="color:red">&#9733;</span></label>
                                            <input style="cursor: pointer;background-color:#585858;color:white" type="submit" value="Search" class="form-control">




                                        </div>
                                    </div>


                                </div>
                            </form>


                            <h4 class="header-title">Date Wise Attendance Report</h4>
                            <br>


                            <div class="table-responsive datatable-primary update_data ">


                                <table id="dataTable2" class="display " style="width:100%">

                                    <thead class="text-capitalize ">

                                        <tr>
                                            <th>S.NO </th>
                                            <th>Employee ID</th>
                                            <th>Employee Type</th>
                                            <th>Name </th>
                                            <th>Date</th>
                                            <th>Place</th>
                                            <th>Punch In</th>
                                            <th>Punch Out</th>
                                            <th>Working Time</th>
                                            <th>Remarks</th>
                                            <th>Attendance</th>
                                            <th>Check All <br>

                                                <input id="checkAll" type="checkbox" name="alls" onchange="ch()">



                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($data as $key=>$vl)
                                        @php
                                        $color= ($vl->status=='A' || $vl->status=='L' ) ? 'red' : 'green';


                                        $color="color:".$color;

                                        @endphp

                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$vl->partner_id}}</td>
                                            <td>{{$vl->partner_type}}</td>
                                            <td>{{$vl->name}}</td>
                                            <td>{{$vl->date}}</td>
                                            <td>{{$vl->place}}</td>
                                            <td>{{$vl->in_time}}</td>
                                            <td>{{$vl->out_time}}</td>
                                            <td>{{$vl->working_time}}</td>
                                            <td>{{$vl->remarks}}</td>
                                            <td style="{{ $color }}">{{$vl->status}}</td>
                                            <td><input type="checkbox" class="ids" value="{{$vl->id}}" name="id"></td>


                                        </tr>
                                        @endforeach


                                    </tbody>
                                    @if($data->isNotEmpty())

                                    <tfoot>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><input id="datepicker" class="form-control" type="date" name="up_date"></td>



                                        <td><select class="form-control" name="status">
                                                <option value="">Select Attendance</option>
                                                <option value="P">P</option>
                                                <option value="A">A</option>
                                                <option value="H">H</option>
                                                <option value="L">L</option>
                                                <option value="HP">HP</option>
                                                <option value="PL">PL</option>
                                            </select></td>

                                        <td colspan="2"><textarea class="form-control" id="remarks" name="remarks" placeholder="Remarks"></textarea></td>

                                        <td><button onclick="update_data()" class="btn btn-success">Update</button></td>
                                    </tfoot>
                                    @endif


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
        function update_data() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // event.preventDefault();
            var from_date = $("input[name=from_date]").val();
            var to_date = $("input[name=to_date]").val();
            var partner_id = $("select[name=partner_id]").val();
            var up_date = $('#datepicker').val()



            var remarks = $("textarea[name=remarks]").val();
            if (remarks == '') {
                swal({
                    type: "error"
                    , title: "Error!"
                    , text: "Please typa a remarks!"
                    , confirmButtonText: "Dismiss"
                    , buttonsStyling: !1
                    , confirmButtonClass: "btn btn-danger"
                });

                return false;
            }
            var status = $("select[name=status]").val();
            if (status == '') {
                swal({
                    type: "error"
                    , title: "Error!"
                    , text: "Please choose a attendance status!"
                    , confirmButtonText: "Dismiss"
                    , buttonsStyling: !1
                    , confirmButtonClass: "btn btn-danger"
                });

                return false;
            }


            var id = [];
            $.each($("input[name='id']:checked"), function() {
                id.push($(this).val());
            });

            if (id.length === 0) {
                swal({
                    type: "error"
                    , title: "Error!"
                    , text: "Please choose a employee!"
                    , confirmButtonText: "Dismiss"
                    , buttonsStyling: !1
                    , confirmButtonClass: "btn btn-danger"
                });

                return false;

            }

            $.ajax({
                type: 'POST'
                , url: "{{ route('attendance.update')}}"
                , data: {
                    id: id
                    , remarks: remarks
                    , status: status
                    , from_date: from_date
                    , to_date: to_date
                    , up_date: up_date
                    , partner_id: partner_id

                , }
                , success: function(data) {

                    var res = JSON.parse(data);
                    if (res.status == true) {
                        swal({
                            type: "success"
                            , title: "Success"
                            , text: "Attendance updated successfully"
                            , buttonsStyling: !1
                            , confirmButtonClass: "btn btn-success"
                        });
                        $('.update_data').html(res.output);
                    } else {
                        swal({
                            type: "error"
                            , title: "Error!"
                            , text: "Update failed!"
                            , confirmButtonText: "Dismiss"
                            , buttonsStyling: !1
                            , confirmButtonClass: "btn btn-danger"
                        });

                    }
                    $("#checkAll").prop("checked", false);


                }
                , error: function(data) {
                    swal({
                        type: "error"
                        , title: "Error!"
                        , text: "Update failed!"
                        , confirmButtonText: "Dismiss"
                        , buttonsStyling: !1
                        , confirmButtonClass: "btn btn-danger"
                    });

                },

            });

        }

    </script>
    <script>
        function ch() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // event.preventDefault();
            var from_date = $("input[name=from_date]").val();
            var to_date = $("input[name=to_date]").val();
            var partner_id = $("select[name=partner_id]").val();
            var ischecked = $('#checkAll').prop('checked');

            if (ischecked == true) {
                var ch_data = 'yes';

            } else {
                var ch_data = 'no';

            }

            $.ajax({
                type: 'POST'
                , url: "{{ route('attendance.select')}}"
                , data: {
                    from_date: from_date
                    , to_date: to_date
                    , partner_id: partner_id
                    , ch_data: ch_data


                }
                , success: function(data) {
                    var res = JSON.parse(data);
                    $('.update_data').html(res.output);


                }
            });


        };

    </script>


    <script>
        $(document).ready(function() {
            $('#dataTable2').DataTable({
                dom: 'Bfrtip'
                , buttons: [{
                        extend: 'copy'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
                        }
                    }
                    , {
                        extend: 'csv'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]

                        }
                    }
                    , {
                        extend: 'excel'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]

                        }
                    }
                    , {
                        extend: 'pdf'
                        , orientation: 'landscape'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]

                        }
                    }
                    , {
                        extend: 'print'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]

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

    <script>
        function del(id) {
            var chs = confirm('Are you sure you want to delete this Category?');
            if (chs) {
                document.location.href = "{{url('gategory_delete')}}/" + id;
            }

        }

    </script>

    @include('logics.include.datatable')


    <!--=========================*
                                                Scripts
                                                *===========================-->


</body>
</html>
