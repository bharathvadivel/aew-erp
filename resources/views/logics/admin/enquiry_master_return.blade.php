<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>

    <!--=========================*
        Met Data
        *===========================-->
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{asset('user/new_npm_css/bootstrap.min.css')}}" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="{{asset('user/new_npm_js/popper.min.js')}}" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="{{asset('user/new_npm_js/bootstrap.min.js')}}" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="{{asset('user/new_npm_js/bootstrap.bundle.min.js')}}" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
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

        i.fa {
            display: inline-block;
            border-radius: 60px;
            box-shadow: 0 0 4px #888;
            padding: 0.5em 0.6em;
            margin: 5px;

        }

        .status_color {
            border: 3px solid #000000;
            padding: 5px;
        }

        .model_color {
            border: 3px solid #ff0000 !important;

        }


        @media only screen and (min-width: 576px) {

            .modal-dialog {
                max-width: 1000px !important;
                margin: 1.75rem auto;
            }
        }

        .col-3 {
            padding-bottom: 30px;
        }

        .col-2 {
            padding-bottom: 20px;
            border: 1px solid #000000;
            text-align: center;
            padding: 6px;
            white-space: nowrap;
        }

        .modal-open .modal {
            overflow: scroll;
            /* overflow-x: hidden; */
            /* overflow-y: auto; */
        }

        select[multiple] option:checked {
            background: #C0C0C0;
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
                            @php
                            use App\Http\Controllers\EnquiryController;

                            @endphp

                            <h4 class="header-title">Manage Part Return
                            </h4>
                            <br>
 <form method="POST" action="{{route('enquiry.master.return')}}">
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
                                            <th>Call ID</th>
                                            <th>Product Description</th>
                                            <th>Model No.</th>
                                            <th>Customer Name</th>
                                            <th>Service Type</th>
                                            <th>Service Canter Name</th>
                                            <th>Customer Phone</th>
                                            <th>Customer Pincode</th>
                                            <th>Store Name</th>
                                            <th>Allocated Date</th>
                                            <th>End Date</th>
                                            <th>Finished Date</th>
                                            <th>Created By</th>
                                            <th>TAT (Days)</th>
                                            <th>Aging Time (Days)</th>
                                            <th>Part Code</th>
                                            <th>Part Name</th>
                                            <th>Status</th>
                                            @if(session()->get('partner_type')!='Accounts')

                                            <th>Action</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($enquiry as $key=>$vl)
                                         @if($vl->finish_date!='')
                                         @php
                                         $finish_date=basicDateFormat($vl->finish_date)
                                         @endphp
                                         @else
                                         @php
                                         $finish_date='00-00-0000'
                                         @endphp
                                         @endif


                                        @if($vl->status=='Completed part return pending' || $vl->status=='Completed part return processed')
                                        @php $color="color:#ff0000"; @endphp
                                        @else
                                        @php $color="color:#2fe65e"; @endphp
                                        @endif


                                        @if($vl->status=='Completed' || $vl->status=='Cancelled' || $vl->status=='Transfered' || $vl->status=='Completed part return pending' || $vl->status=='Completed part return processed' || $vl->status=='Completed part return success')
                                        @php
                                        $aging_time='----';
                                        @endphp
                                        @else
                                        @php
                                        $date1=date_create(date('Y-m-d',strtotime($vl->created_at)));
                                        $date2=date_create(date('Y-m-d'));
                                        $diff=date_diff($date1,$date2);
                                        $aging_time=$diff->format("%a");
                                        @endphp
                                        @endif

                                        @php
                                        $date3=date_create(date('Y-m-d',strtotime($vl->created_at)));
                                        $date4=($vl->status=='Completed' || $vl->status=='Cancelled' || $vl->status=='Transfered' || $vl->status=='Completed part return pending' || $vl->status=='Completed part return processed' || $vl->status=='Completed part return success') ? date_create(date('Y-m-d',strtotime($vl->updated_at))) :date_create(date('Y-m-d'));
                                        $diff_tata=date_diff($date3,$date4);
                                        $tat=$diff_tata->format("%a");
                                        @endphp

                                        @php
                                        $part_list = DB::table('partorders')->where('call_id',$vl->call_id)->first();
                                        @endphp
                                        @if ($part_list)
                                        @php
                                        $part_code_data=json_decode($part_list->part_code);
                                        $part_code=implode(', ', $part_code_data);
                                        $part_name_data=json_decode($part_list->part_name);
                                        $part_name=implode(', ', $part_name_data);

                                        @endphp

                                        @else
                                        @php
                                        $part_code_data='';
                                        $part_code='';
                                        $part_name_data='';
                                        $part_name='';

                                        @endphp



                                        @endif


                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$vl->call_id}}</td>
                                            <td>{{$vl->description}}</td>
                                            <td>{{$vl->model_no}}</td>
                                            <td>{{$vl->customer_name}}</td>
                                            <td>{{$vl->service_type}}</td>
                                            <td>{{$vl->service_center_name}}</td>
                                            <td>{{$vl->customer_phone}}</td>
                                            <td>{{$vl->customer_pincode}}</td>
                                            <td>{{$vl->store_name}}</td>
                                            <td>{{basicDateFormat($vl->created_at)}}</td>
                                            <td>{{basicDateFormat($vl->end_date)}}</td>
                                            <td>{{$finish_date}}</td>
                                            <td>{{$vl->created_by}}</td>
                                            <td>{{$tat}}</td>
                                            <td>{{$aging_time}}</td>

                                            <td>{{$part_code}}</td>
                                            <td>{{$part_name}}</td>
                                            <td style="@php echo $color @endphp">
                                                <p class="status_color">{{$vl->status}}</p>
                                            </td>

 @if(session()->get('partner_type')!='Accounts')
                                            <td>

                                                @if($vl->status=='Completed part return pending' || $vl->status=='Completed part return processed')
                                                <button><i class="fa fa-refresh" data-placement="top" title="Part return" data-bs-toggle="modal" data-bs-target="#partreturn{{$vl->id}}" style="color:#1e7e34"></i></button>
                                                @endif
                                            </td>
                                            @endif
                                        </tr>
                                        <div class="modal fade" id="partreturn{{ $vl->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Part return success</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post" action="{{route('enquiry.part.success',$vl->id)}}">
                                                            @csrf
                                                            <div class="mb-3">
                                                                <label for="recipient-name" class="col-form-label">Call ID:</label>
                                                                <input type="text" readonly name="call_id" value="{{$vl->call_id}}" class="form-control" id="recipient-name">
                                                            </div>


                                                            <div class="mb-3">
                                                                <label for="message-text" class="col-form-label">Remarks:</label>
                                                                <textarea class="form-control" required="" name="remarks" id="message-text"></textarea>
                                                            </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

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


      <script>
          $(document).ready(function() {
              $('#dataTable').DataTable({
                  dom: 'Bfrtip'
                  , buttons: [{
                          extend: 'copy'
                          , exportOptions: {
                              columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10,11, 12, 13, 14, 15, 16, 17, 18]
                          }
                      }
                      , {
                          extend: 'csv'
                          , exportOptions: {
                              columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10,11, 12, 13, 14, 15, 16, 17, 18]



                          }
                      }
                      , {
                          extend: 'excel'
                          , exportOptions: {
                             columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10,11, 12, 13, 14, 15, 16, 17, 18]


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
