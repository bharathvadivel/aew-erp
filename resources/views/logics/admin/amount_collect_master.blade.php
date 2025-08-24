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

        @media (min-width: 576px) {
            .modal-dialog {
                max-width: 500px !important;
                margin: 1.75rem auto;
            }

            .row {
                justify-content: flex-end;
            }
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
                            <h4 class="header-title" style="display:flex;justify-content: space-between;align-content: space-around;">
                                Collection List

                                <a href="{{ route('amount.collect.group.master') }}" class="btn btn-primary btns"> <i class="fa fa-plus-circle"></i>Collection</a>
                            </h4>
                            <br>

                            <br>


                            <div class="table-responsive datatable-primary">
                                <table id="dataTable" class="text-center boh">
                                    <thead class="text-capitalize">
                                        <tr>
                                            <th>S.NO </th>
                                            <th>Partner Name</th>
                                            <th>Partner Type</th>
                                            <th>Payment Mode</th>
                                            <th>Reference No</th>
                                            <th>Credit Limit</th>
                                            <th>Available Limit</th>
                                            <th>Value (Amount)</th>
                                            <th>Collected By</th>
                                            <th>Collected Role</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($row as $key => $vl)
                                        @php
                                        $color= $vl->payment_status!='Cancel' ? $vl->payment_status!='Pending' ? 'green' : 'red': 'red';

                                        $color="color:".$color;

                                        @endphp
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{$vl->partner_store_name}}-({{ $vl->partner_id }})</td>
                                            <td>{{ $vl->partner_type }}</td>
                                            <td>{{ $vl->payment_mode }}</td>
                                            <td>{{ $vl->reference_no }}</td>
                                            <td>{{ $vl->credit_limit }}</td>
                                            <td>{{ $vl->available_limit }}</td>
                                            <td>{{ $vl->amount }}</td>
                                            <td>{{ $vl->login_name }}({{$vl->login_id}})</td>
                                            <td>{{ $vl->login_type }}</td>
                                            <td style="{{$color}}">{{ $vl->payment_status }}</td>
                                            <td>{{basicDateFormat($vl->created_at)}}</td>
                                            <td>
                                                @if($vl->payment_status=='Pending')


                                                @if ($vl->payment_status!='Success')

                                                @if ($vl->payment_status=='Cancel')
                                                <button style="margin: 6px;"><i  data-placement="top" title="Cancel" class="fa fa-close" onclick="alert('Already Cancelled')" style="color:red"></i></button>

                                                @else

                                                <form onsubmit="return confirm('Are you sure you want to cancel?');" action="{{ route('amount.collect.cancel', $vl->id) }}" method="POST">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="hidden" name="payment_status" value="Cancel">
                                                    <input type="hidden" name="amount" value="{{$vl->amount}}">
                                                    <input type="hidden" name="partner_id" value="{{$vl->partner_id}}">

                                                    <button style="margin: 6px;"><i  data-placement="top" title="Cancel"  class="fa fa-close" style="color:red"></i></button>


                                                </form>
                                                @endif
                                                @endif

                                                @if ($vl->payment_status=='Success')
                                                <button><i class="fa fa-check"  data-placement="top" title="Update" onclick="alert('Already Updated')" style="color:green"></i></button>

                                                @else

                                                <form onsubmit="return confirm('Are you sure you want to success?');" action="{{ route('amount.collect.update.web', $vl->id) }}" method="POST">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="hidden" name="payment_status" value="Success">
                                                    <input type="hidden" name="amount" value="{{$vl->amount}}">
                                                    <input type="hidden" name="partner_id" value="{{$vl->partner_id}}">

                                                    <button><i  data-placement="top" title="Update" class="fa fa-check" style="color:green"></i></button>

                                                </form>

                                                @endif
                                                @endif

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
             $('#dataTable').DataTable({
                 dom: 'Bfrtip'
                 , buttons: [{
                         extend: 'copy'
                         , exportOptions: {
                             columns: [0, 1, 2, 3, 4, 5, 6, 7, 8,9,10,11]
                         }
                     }
                     , {
                         extend: 'csv'
                         , exportOptions: {
                             columns: [0, 1, 2, 3, 4, 5, 6, 7, 8,9,10,11]


                         }
                     }
                     , {
                         extend: 'excel'
                         , exportOptions: {
                             columns: [0, 1, 2, 3, 4, 5, 6, 7, 8,9,10,11]


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



 @include('logics.include.datatable')



    <!--=========================*
                                    Scripts
                                    *===========================-->


</body>

</html>
