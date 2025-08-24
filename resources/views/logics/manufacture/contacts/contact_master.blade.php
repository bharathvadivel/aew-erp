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
                            <h4 class="header-title">Contacts
                                <a href="{{ route('contact.import') }}"class="btn btn-primary btns "><i class="fa fa-pencil"></i> Bulk Import</a>
                                <a href="{{ route('contact.update.import') }}"class="btn btn-primary btns mr-2"><i class="fa fa-download"></i> Bulk Update</a>
                                <a href="{{ route('add.contact') }}"class="btn btn-primary btns mr-2"><i class="fa fa-plus-circle"></i> Add Contacts</a>
                            </h4>
                            <br>


                            <div class="table-responsive datatable-primary">
                                <table id="dataTable2" class="display" style="width:100%">
                                    <thead class="text-capitalize">
                                        <tr>
                                            <th style="text-align: center;">s_no</th>
                                            <th style="text-align: center;">customer_type</th>
                                            <th style="text-align: center;">customer_name</th>
                                            <th style="text-align: center;">customer_billing_address</th>
                                            <th style="text-align: center;">customer_shipping_address</th>
                                            <th style="text-align: center;">customer_mobile_no</th>
                                            <th style="text-align: center;">customer_email</th>
                                            <th style="text-align: center;">customer_gst_no</th>
                                            <th style="text-align: center;">state_code</th>
                                            <th style="text-align: center;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($contacts as $key => $vl)
                                            <tr>
                                                <td style="text-align: center;">{{ $vl->id }}</td>
                                                <td style="text-align: center;">{{ $vl->customer_type }}</td>
                                                <td>{{ $vl->customer_name }}</td>
                                                <td>{{ $vl->customer_billing_address }}</td>
                                                <td>{{ $vl->customer_shipping_address }}</td>
                                                <td style="text-align: center;">{{ $vl->customer_mobile_no }}</td>
                                                <td style="text-align: center;">{{ $vl->customer_email }}</td>
                                                <td style="text-align: center;">{{ $vl->customer_gst_no }}</td>
                                                <td style="text-align: center;">{{ $vl->state_code }}</td>
                                                <td class="editc">
                                                    <a href="{{ url('contact_edit/' . $vl->id) }}"><i data-placement="top" title="Edit" class="fa fa-edit" style="color:#056c91"></i></a>
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
        $(document).ready(function() {
            $('#dataTable2').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'copy',
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5, 6, 7, 8]
                        }
                    },
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5, 6, 7, 8]
                        }
                    },
                    {
                        extend: 'pdf',
                        orientation: 'landscape',
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5, 6, 7, 8]
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5, 6, 7, 8]
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
            var chs = confirm('Are you sure you want to delete this Item Type?');
            if (chs) {
                document.location.href = "{{ url('contact_delete') }}/" + id;
            }

        }
    </script>

    @include('logics.include.datatable')


    <!--=========================*
        Scripts
    *===========================-->


</body>

</html>
