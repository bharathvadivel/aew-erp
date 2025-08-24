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
                          <form method="POST" action="{{route('order')}}">
                              @csrf
                              <div class="form-row">



                                  <div class="col-md-3 mb-3">
                                      <div class="form-group">
                                          <label for="disabledTextInput">Year<span style="color:red">&#9733;</span></label>
                                          <select required="" class="form-control" name="year">

                                              @for ($year = date('Y'); $year > date('Y') - 10; $year--)
                                              <option {{$year==$year_ch ? 'selected' : ''}} value="{{$year}}">
                                                  {{$year}}
                                              </option>
                                              @endfor

                                          </select>



                                      </div>
                                  </div>
                                  <div class="col-md-3 mb-3">
                                      <div class="form-group">
                                          <label for="disabledTextInput">Month<span style="color:red">&#9733;</span></label>
                                          <select required="" class="form-control" name="month" id="month">


                                              <option {{$month=='01' ? 'selected' : ''}} value="01">January</option>
                                              <option {{$month=='02' ? 'selected' : ''}} value="02">February</option>
                                              <option {{$month=='03' ? 'selected' : ''}} value="03">March</option>
                                              <option {{$month=='04' ? 'selected' : ''}} value="04">April</option>
                                              <option {{$month=='05' ? 'selected' : ''}} value="05">May</option>
                                              <option {{$month=='06' ? 'selected' : ''}} value="06">June</option>
                                              <option {{$month=='07' ? 'selected' : ''}} value="07">July</option>
                                              <option {{$month=='08' ? 'selected' : ''}} value="08">August</option>
                                              <option {{$month=='09' ? 'selected' : ''}} value="09">September</option>
                                              <option {{$month=='10' ? 'selected' : ''}} value="10">October</option>
                                              <option {{$month=='11' ? 'selected' : ''}} value="11">November</option>
                                              <option {{$month=='12' ? 'selected' : ''}} value="12">December</option>

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



                            <div class="table-responsive datatable-primary">
                                <table id="dataTable" class="text-center boh">
                                    <thead class="text-capitalize">
                                        <tr>
                                            <th>S.NO </th>
                                            <th>Order ID</th>
                                            @if ($partner_type!='distributor')

                                            <th>Warehouse</th>
                                            @else
                                            <th>Distributor ID</th>

                                            @endif
                                            <th>Company/Store name</th>
                                            <th>Partner id</th>
                                            <th>Partner type</th>
                                            <th>Address</th>
                                            <th>Order by</th>
                                            <th>Grand total</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                            <th>Order Details</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        use App\Http\Controllers\LoginController;
                                        @endphp
                                        @foreach ($order as $key=>$vl)
                                        @php
                                        $color= $vl->status=='Pending'? '#ffbb44' : 'green';
                                        $color="color:".$color;

                                        $check=new LoginController;
                                        $order_name=$check->partner_details($vl->order_by);
                                        $partner_name=$check->partner_details($vl->partner_id);
                                        @endphp

                                        @if ($vl->partner_type!='sub_dealer')
                                        @php
                                        $let = DB::table('warehouses')->where('warehouse_id',$vl->to_id)->first();
                                        @endphp

                                        @else
                                        @php
                                        $let = DB::table('distributors')->where('partner_id',$vl->to_id)->first();
                                        @endphp

                                        @endif
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$vl->order_id}}</td>
                                            <td>{{$vl->to_id}} ({{$let->name}})</td>
                                            <td>{{$vl->store_name}}</td>
                                            <td>{{$vl->partner_id}} ({{ $partner_name }})</td>
                                            <td>{{$vl->partner_type}}</td>
                                            <td>{{$vl->address}}</td>
                                            <td>{{$vl->order_by}} ({{ $order_name }})</td>
                                            <td>{{$vl->grand_total}}</td>
                                            <td style="@php echo $color @endphp">{{$vl->status}}</td>
                                            <td>{{basicDateFormat($vl->created_at)}}</td>
                                            <td><a href="{{route('single.order',$vl->order_id)}}"><i class="fa fa-check" style="color:#056c91"></i>
                                                    @if ($vl->status!='Success')

                                                    <form onsubmit="return confirm('Are you sure you want to delete?');" action="{{ route('order.delete',$vl->id)}}" method="POST">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <button><i class="fa fa-trash" style="color:red"></i></button>
                                                    </form>

                                                    @endif

                                                </a>

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
