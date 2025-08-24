<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>

    <!--=========================*
                Met Data
    *===========================-->
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
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

        button.dt-button,
        div.dt-button,
        a.dt-button,
        input.dt-button {
            padding: 6px;
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
                            <h4 class="header-title">Admin Details
                                <!-- <a href="{{ url('add_warranty_logics') }}"class="btn btn-primary btns" >  <i class="fa fa-plus-circle" ></i> Add New Logics </a></h4> -->
                                <br>


                                <div class="table-responsive datatable-primary">
                                    <table id="dataTable2" class="display" style="width:100%">
                                        <thead class="text-capitalize">
                                            <tr>
                                                <th>S.NO </th>
                                                <th>Partner Id</th>
                                                <th>Partner Type</th>
                                                <th>Name</th>
                                                <th>Phone</th>
                                                <th>Email</th>
                                                <th>GstIn No</th>
                                                <th>location Id</th>
                                                <th>Address</th>
                                                <th>City</th>
                                                <th>District</th>
                                                <th>Pincode</th>
                                                <th>Latitude</th>
                                                <th>Longtitude</th>
                                                <th>State</th>
                                                <th>Country</th>
                                                <th>Status</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($admin_list as $key=>$vl)
                                            @php





                                            $color= $vl->status=="Enable" ? 'label label-success' : 'label label-danger';


                                            @endphp


                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{$vl->partner_id}}</td>
                                                <td>{{$vl->partner_type}}</td>
                                                <td>{{$vl->name}}</td>
                                                <td>{{$vl->phone}}</td>
                                                <td>{{$vl->email}}</td>
                                                <td>{{$vl->gstin_no}}</td>
                                                <td>{{$vl->location_id}}</td>
                                                <td>{{$vl->address}}</td>
                                                <td>{{$vl->city}}</td>
                                                <td>{{$vl->district}}</td>
                                                <td>{{$vl->pincode}}</td>
                                                <td>{{$vl->lat}}</td>
                                                <td>{{$vl->lang}}</td>
                                                <td>{{$vl->state}}</td>
                                                <td>{{$vl->country}}</td>
                                                <td><span class="{{$color}}">{{$vl->status}}</span></td>

                                                <td><a data-toggle="modal" data-target="#exampleModal{{$vl->id}}" data-whatever="@mdo"><i  data-placement="top" title="Edit" class="fa fa-edit" style="color:#056c91"></i></a>

                                                    &nbsp;&nbsp;
                                                    <form onsubmit="return confirm('Are you sure you want to login?');" action="{{ route('login.by.admin')}}" method="POST">
                                                        <input type="hidden" name="_method" value="POST">
                                                        <input type="hidden" name="phone" value="{{$vl->phone}}">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <button><i  data-placement="top" title="Login" class="fa fa-sign-in" style="color:red"></i></button>
                                                    </form>
                                                </td>


                                                <div class="modal fade" id="exampleModal{{$vl->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Edit Details</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form method="post" action="{{url('update_admins')}}">
                                                                @csrf
                                                                <div class="modal-body">

                                                                    <div class="form-group">
                                                                        <label for="recipient-name" class="col-form-label">Partner Id :</label>




                                                                        <input type="text" readonly class="form-control" id="recipient-name" value="{{$vl->partner_id}}" name="partner_id">



                                                                        <input type="hidden" class="form-control" value="{{$vl->id}}" name="id">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="recipient-name" class="col-form-label">Partner Type :</label>

                                                                        <input type="text" readonly class="form-control" id="recipient-name" value="{{$vl->partner_type}}" name="partner_type">

                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="recipient-name" class="col-form-label">Name:</label>

                                                                        <input type="text" class="form-control" id="recipient-name" value="{{$vl->name}}" name="name">


                                                                    </div>


                                                                    <div class="form-group">
                                                                        <label for="recipient-name" class="col-form-label">Phone:</label>

                                                                        <input type="text" class="form-control" id="recipient-name" value="{{$vl->phone}}" name="phone">

                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="recipient-name" class="col-form-label">Email:</label>

                                                                        <input type="text" class="form-control" id="recipient-name" value="{{$vl->email}}" name="email">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="recipient-name" class="col-form-label">Gst In No</label>

                                                                        <input type="text" class="form-control" id="recipient-name" value="{{$vl->gstin_no}}" name="gstin_no">

                                                                    </div>


                                                                    <div class="form-group">
                                                                        <label for="recipient-name" class="col-form-label">Location Id</label>

                                                                        <input type="text" readonly class="form-control" id="recipient-name" value="{{$vl->location_id}}" name="location_id">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="recipient-name" class="col-form-label">Address</label>

                                                                        <input type="text" class="form-control" id="recipient-name" value="{{$vl->address}}" name="address">

                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="recipient-name" class="col-form-label">Pincode</label>

                                                                        <input type="text" oninput="new_location(this.value)" class="form-control" id="recipient-name" value="{{$vl->pincode}}" name="pincode">


                                                                    </div>


                                                                    <div class="form-group">
                                                                        <label for="recipient-name" class="col-form-label">City</label>

                                                                        <input type="text" value="{{$vl->city}}" readonly required="" placeholder="City" name="city" class="form-control new_city">


                                                                    </div>


                                                                    <div class="form-group">
                                                                        <label for="recipient-name" class="col-form-label">District</label>

                                                                        <input type="text" value="{{$vl->district}}" readonly required="" name="district" class="form-control new_district" placeholder="District">



                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="recipient-name" class="col-form-label">Latitude</label>

                                                                        <input type="text" class="form-control" id="recipient-name" value="{{$vl->lat}}" name="latitude">

                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="recipient-name" class="col-form-label">Longtitude</label>

                                                                        <input type="text" class="form-control" id="recipient-name" value="{{$vl->lang}}" name="longtitude">

                                                                    </div>



                                                                    <div class="form-group">
                                                                        <label for="recipient-name" class="col-form-label">State</label>

                                                                        <input type="text" value="{{$vl->state}}" readonly required="" name="state" class="form-control new_state" placeholder="State">



                                                                    </div>


                                                                    <div class="form-group">
                                                                        <label for="recipient-name" class="col-form-label">Country</label>
                                                                         <input required="" value="{{$vl->country}}" readonly type="text" name="country" class="form-control new_country" placeholder="Country">

                                                                    </div>


                                                                    <div class="form-group">
                                                                        <label for="recipient-name" class="col-form-label">Status</label>

                                                                        <select class="form-control" name="status">


                                                                            <option value="{{$vl->status}}" selected hidden>{{$vl->status}}</option>
                                                                            <option value="Enable">Enable</option>
                                                                            <option value="Disable">Disable</option>
                                                                        </select>

                                                                    </div>



                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Save Change</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>


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



                ],

            });
        });

    </script>



    <!--=================================*
           End Main Content Section
    *===================================-->

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
        function del(id, table) {
            var chs = confirm('Are you sure you want to delete this Parts?');
            if (chs) {
                document.location.href = "{{url('dalete_spareparts_category')}}/" + id + "/" + table;
            }

        }

    </script>
    <script>
        function callmyfun(val) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST'
                , url: "{{ url('check_category')}}"
                , data: {
                    id: val,

                }
                , success: function(data) {

                    if (data === "Type C") {
                        $("#assign").empty()
                        var op = "<option value='Goods'>Goods</option>";

                        document.getElementById("assign").innerHTML = op;
                    } else {
                        $("#assign").empty()
                        var op = "<option value='Goods'>Goods</option><option value='Defective'>Defective</option>";



                        document.getElementById("assign").innerHTML = op;
                    }

                }
            });
        }

    </script>


    @include('logics.include.datatable')

    <!--=========================*
            Scripts
*===========================-->


</body>
</html>
