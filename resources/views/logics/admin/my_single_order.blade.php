<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>

    <!--=========================*
        Met Data
        *===========================-->
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
                            <h4 class="header-title">Order list
                            </h4>
                            <br>


                            <div class="table-responsive datatable-primary">
                                <table id="dataTable" class="text-center boh">
                                    <thead class="text-capitalize">
                                        <tr>
                                            <th>S.NO </th>
                                            <th>Order ID</th>
                                            <th>Partner ID</th>
                                            <th>Store Name</th>
                                            <th>Credit Limit</th>
                                            <th>Available Limit</th>
                                            <th>Category name</th>
                                            <th>Description</th>
                                            <th>Model No.</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Total</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($order as $key=>$vl)
                                        @php
                                        $grand_total=$vl->grand_total;

                                        $var = DB::table('distributors')->where('partner_id',$let->partner_id)->first();

                                        @endphp
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$vl->order_id}}</td>
                                            <td>{{$let->partner_id}}</td>
                                            <td>{{$let->name}}</td>
                                            <td>{{$var->credit_limit}}</td>
                                            <td>{{$var->available_limit}}</td>
                                            <td>{{$vl->category_name}}</td>
                                            <td>{{$vl->description}}</td>
                                            <td>{{$vl->model_no}}</td>
                                            <td>{{$vl->qty}}</td>
                                            <td>{{$vl->price}}</td>
                                            <td>{{$vl->total}}</td>
                                            <td>{{basicDateFormat($vl->created_at)}}</td>
                                        </tr>
                                        @endforeach
                                    <tfoot>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>


                                        <td>Grand Total</td>
                                        <td>{{ $grand_total }}</td>

                                        <td></td>




                                    </tfoot>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Primary table -->
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
    <script>
        function check() {
            var ch = document.getElementById("from_address").value;
            if (ch == '') {
                alert('Please choose from address');
                return false;
            } else {
                return true;
            }
        }

    </script>

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
                              columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10,11,12]
                          }
                      }
                      , {
                          extend: 'csv'
                          , exportOptions: {
                              columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10,11,12]


                          }
                      }
                      , {
                          extend: 'excel'
                          , exportOptions: {
                              columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10,11,12]

                          }
                      }


                  ],

              });
          });

      </script>


    <script>
        function addr(address) {

            var dis_id = $("input[name=to_id]").val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // event.preventDefault();
            var address = address;
            $.ajax({
                type: 'POST'
                , url: "{{ route('address_select')}}"
                , data: {
                    dis_id: dis_id
                    , address: address
                }
                , success: function(data) {
                    var val = JSON.parse(data);

                    $('.citys').val(val.city);
                    $('.districts').val(val.district);
                    $('.pincode').val(val.pincode);
                    $('.location_id').val(val.location_id);

                }
            });


        }

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
