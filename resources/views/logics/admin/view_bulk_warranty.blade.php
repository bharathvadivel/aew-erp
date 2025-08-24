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
                  <h4 class="header-title">Warranty List
                      @if (session()->get('partner_type') == 'admin' || session()->get('partner_type') == 'service_admin')
                  <a href="{{ url('add_warranty_list') }}" class="btn btn-primary btns"> <i class="fa fa-plus-circle"></i> Add single warranty </a></h4><br>

                    </h4><br>
                                       <a href="{{ url('add_bulk') }}" class="btn btn-primary btns"> <i class="fa fa-plus-circle"></i> Add multiple warranty (CSV) </a>

                  @endif
                  <br>

  <form method="POST" action="{{route('view.warraanty')}}">
      @csrf
                                <div class="form-row">


          <div class="col-md-3 mb-3">
              <div class="form-group">
                  <label for="disabledTextInput">Search<span style="color:red">&#9733;</span></label>
                  <input type="text" value="{{$search}}" required="" id="search" name="search" class="form-control">

              </div>
          </div>


          <div class="col-md-1 mb-1">
              <div class="form-group">
                  <label for="disabledTextInput">Filter<span style="color:red">&#9733;</span></label>
                  <input style="cursor: pointer;background-color:#585858;color:white" type="submit" value="Search" class="form-control">


              </div>
          </div>

@if (session()->get('partner_type') == 'admin' || session()->get('partner_type') == 'service_admin')
<div class="col-md-1 mb-1">
    <label for="disabledTextInput">Download<span style="color:red">&#9733;</span></label>
    <a  onclick="excelDownload()" class="btn btn-success">
        CSV
    </a>
</div>
@endif

      </div>
  </form>




                            <div class="table-responsive datatable-primary">

                                <table id="dataTable2" class="text-center boh">
                                    <thead class="text-capitalize">
                                        <tr>
                                            <th>S.NO </th>
                                            <th>Customer Name</th>
                                            <th>Customer Phone</th>
                                            <th>Serial No</th>
                                            <th>Category</th>
                                            <th>Model No</th>
                                            <th>Dom </th>
                                            <th>Date Of Purchase </th>
                                            <th>Standard Warranty</th>
                                            <th>Extended Warranty</th>
                                            <th>Part 1</th>
                                            <th>Part 1 Warranty</th>
                                            <th>Part 2</th>
                                            <th>Part 2 Warranty</th>
                                            <th>Standard Warranty Exp Date</th>
                                            <th>Extended Warranty Exp Date</th>
                                            <th>Part 1 Warranty Exp Date</th>
                                            <th>Part 2 Warranty Exp Date</th>
                                            <th>Proof</th>
                                            <th>Remarks</th>
                                            <th>Action</th>


                                        </tr>
                                    </thead>
                                    <tbody>
@foreach ($logics_list as $key=>$vl)
<tr>
<td>{{$key+1}}</td>
<td>{{$vl->customer_name}}</td>
<td>{{$vl->customer_phone}}</td>
<td>{{$vl->serial_no}}</td>
<td>{{$vl->product && $vl->product->gategory ? $vl->product->gategory->gategory_name:''}}</td>
<td>{{$vl->model_no}}</td>
<td>{{$vl->dom!='' ? basicDateFormat($vl->dom):''}}</td>
<td>{{$vl->date_of_purchase!='' ? basicDateFormat($vl->date_of_purchase):''}}</td>
<td>{{$vl->standard_warranty}}</td>
<td>{{$vl->extended_warranty}}</td>
<td>{{$vl->part1}}</td>
<td>{{$vl->part1_warranty}}</td>
<td>{{$vl->part2}}</td>
<td>{{$vl->part2_warranty}}</td>
<td>{{$vl->standard_warranty_exp_date!='' ? basicDateFormat($vl->standard_warranty_exp_date):''}}</td>
<td>{{$vl->extended_warranty_exp_date!='' ? basicDateFormat($vl->extended_warranty_exp_date):''}}</td>
<td>{{$vl->part1_warranty_exp_date!='' ? basicDateFormat($vl->part1_warranty_exp_date):''}}</td>
<td>{{$vl->part2_warranty_exp_date!='' ? basicDateFormat($vl->part2_warranty_exp_date):''}}</td>
@if ($vl->proof!='')
<td><a href="{{ $vl::Proof($vl->proof) }}" target="_blank"><img style="width: 34px;" src="{{asset('user/images/file.png')}}"></a></td>

@else
<td></td>

@endif

<td>{{$vl->remarks}}</td>
@if (session()->get('partner_type')=='admin' || session()->get('partner_type')=='service_admin')

<td><button><i  data-placement="top" title="Edit" class="fa fa-edit" onclick="warranty_popup('{{$vl->id}}')" style="color:#f24734"></i></button></td>
@else
<td></td>
@endif

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

    <div class="modal fade" id="warranty_popup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Warranty</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" enctype="multipart/form-data" action="{{route('update.warranty')}}">
                        @csrf
                        <input type="hidden" class="n_id" name="id">
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Model No:</label>
                            <input type="text" required="" readonly name="model_no" class="form-control n_model_no">


                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Serial No:</label>
                            <input type="text" required="" readonly name="serial_no" class="form-control n_serial_no">

                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Date of purchaes:</label>
                            <input type="date" required="" name="date_of_purchase" class="form-control" id="recipient-name">


                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Proof:</label>
                            <input type="file" required="" name="proof" class="form-control" id="recipient-name">

                        </div>




                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Remarks:</label>
                            <textarea required="" class="form-control" required="" name="remarks" id="message-text"></textarea>

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
          });
      });

  </script>



    <script>
        function warranty_popup(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            event.preventDefault();

            $.ajax({
                type: 'POST'
                , url: "{{ route('warranty.popup')}}"
                , data: {
                    id: id
                }
                , success: function(data) {
                    var val = JSON.parse(data);
                    $('.n_model_no').val(val.model_no);
                    $('.n_serial_no').val(val.serial_no);
                    $('.n_id').val(val.id);
                    $("#warranty_popup").modal('show');

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
    <script>
        function excelDownload() {
            var search = document.getElementById('search').value;

            var url = "{{ route('warranty.export')}}?" + 'search=' + search;

            window.open(url, '_blank');
        }

    </script>


</body>
</html>

