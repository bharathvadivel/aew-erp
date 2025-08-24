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
                            <h4 class="header-title">Settings
                                <br>


                                <div class="table-responsive datatable-primary">
                                    <table id="dataTable2" class="display" style="width:100%">
                                        <thead class="text-capitalize">
                                            <tr>
                                                <th>S.NO </th>
                                                <th>Assign Template ID</th>
                                                <th>Complete Template ID</th>
                                                <th>SMS Auth Key</th>
                                                <th>Resent OTP Retry</th>
                                                <th>TCS</th>
                                                <th>TCS Range</th>
                                                <th>Map Key</th>
                                                <th>App Version</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>



                                            <tr>
                                                <td>1</td>
                                                <td>{{$row->assign_template_id}}</td>
                                                <td>{{$row->complete_template_id}}</td>
                                                <td>{{$row->sms_auth_key}}</td>
                                                <td>{{$row->retry}}</td>
                                                <td>{{$row->tcs }}</td>
                                                <td>{{$row->tcs_range}}</td>
                                                <td>{{$row->map_id}}</td>
                                                <td>{{$row->app_version}}</td>

                                                <td><a data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo"><i  data-placement="top" title="Edit" class="fa fa-edit" style="color:#056c91"></i></a>

                                                </td>


                                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Edit Settings</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form method="post" action="{{route('update.settings')}}">
                                                                @csrf
                                                                <div class="modal-body">

                                                                    <div class="form-group">
                                                                        <label for="recipient-name" class="col-form-label">Assign Template ID :</label>

                                                                        <input type="text"  class="form-control" id="recipient-name" value="{{$row->assign_template_id}}" name="assign_template_id">
                                                                        <input type="hidden" class="form-control" value="{{$row->id}}" name="id">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="recipient-name" class="col-form-label">Complete Template ID :</label>


                                                                        <input type="text"  class="form-control" id="recipient-name" value="{{$row->complete_template_id}}" name="complete_template_id">



                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="recipient-name" class="col-form-label">SMS Auth Key :</label>
                                                                        <input type="text" class="form-control" id="recipient-name" value="{{$row->sms_auth_key}}" name="sms_auth_key">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="recipient-name" class="col-form-label">Resent OTP Retry :</label>
                                                                        <input type="text" class="form-control" id="recipient-name" value="{{$row->retry}}" name="retry">

                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="recipient-name" class="col-form-label">TCS Value :</label>
                                                                        <input type="text" class="form-control" id="recipient-name" value="{{$row->tcs}}" name="tcs">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="recipient-name" class="col-form-label">TCS Range :</label>
                                                                        <input type="text" class="form-control" id="recipient-name" value="{{$row->tcs_range}}" name="tcs_range">
                                                                    </div>


                                                                    <div class="form-group">
                                                                        <label for="recipient-name" class="col-form-label">Map Key</label>


                                                                        <input type="text"  class="form-control" id="recipient-name" value="{{$row->map_id}}" name="map_id">


                                                                    </div>
                                                                                                                        <div class="form-group">
                                                                        <label for="recipient-name" class="col-form-label">App Version</label>


                                                                        <input type="text" class="form-control" id="recipient-name" value="{{$row->app_version}}" name="app_version">



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
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        }
                    }
                    , {
                        extend: 'csv'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        }
                    }
                    , {
                        extend: 'excel'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]
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



    @include('logics.include.datatable')

    <!--=========================*
            Scripts
*===========================-->


</body>
</html>

