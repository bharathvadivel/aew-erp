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
        .dataTables_length
{
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

            <div class="row">
                <!-- Primary table -->
                <div class="col-12 mt-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Locations


                                <a href="{{ url('add_state') }}" class="btn btn-primary btns"> <i class="fa fa-plus-circle"></i> Add Location </a></h4>



                                <br>


                            <div class="table-responsive datatable-primary">

                            <a href="{{route('export-location')}}"><button class="dt-button buttons-excel buttons-html5" tabindex="0" aria-controls="dataTable2" type="button"><span>Excel</span></button></a>



                                <table id="dataTable2" class="display yajra-datatable" style="width:100%">


                                    <thead class="text-capitalize">
                                        <tr>
                                            <th>S.NO </th>
                                            <th>Pincode</th>
                                            <th>Citycode</th>
                                            <th>Area</th>
                                            <th>City name</th>
                                            <th>District name</th>
                                            <th>State name</th>
                                            <th>Country</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>



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

        }

    </style>
    <script type="text/javascript">
        $(function() {

            var table = $('.yajra-datatable').DataTable({
                processing: true
                , serverSide: false
                , ajax: "{{ route('state.master') }}"
                , columns: [{
                        data: 'DT_RowIndex'
                        , name: 'DT_RowIndex'

                    }
                    , {
                        data: 'pincode'
                        , name: 'pincode'

                    }
                    , {
                        data: 'city_code'
                        , name: 'city_code'


                    }
                    , {
                        data: 'area'
                        , name: 'area'


                    }
                    , {
                        data: 'city'
                        , name: 'city'


                    }
                    , {
                        data: 'district'
                        , name: 'district'


                    }
                    , {
                        data: 'state'
                        , name: 'state'


                    }
                    , {
                        data: 'country'
                        , name: 'country'



                    }

                    , {
                        data: 'status'
                        , name: 'status'



                    }


                    , {
                        data: 'action'
                        , name: 'action'
                        , orderable: false
                        , searchable: false

                    }
                , ],

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
            var chs = confirm('Are you sure you want to delete this location?');
            if (chs) {
                document.location.href = "{{url('state_delete')}}/" + id;
            }

        }

    </script>




    @include('logics.include.datatable')

    <!--=========================*
                                                Scripts
                                                *===========================-->


</body>
</html>

