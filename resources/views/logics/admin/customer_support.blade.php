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
            white-space: normal;
        }

        .modal-open .modal {
            overflow: scroll;
            /* overflow-x: hidden; */
            /* overflow-y: auto; */
        }

        select[multiple] option:checked {
            background: #C0C0C0;
        }

        /*.form-row label {*/
        /*    margin-left: 30px*/
        /*}*/

        .d-sm-flex {
            width: 100% !important;
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
                            <form method="GET" action="{{route('customer.support')}}">
                                <div class="form-row">


                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Search</label>

                                            <input type="text" value="{{$search}}" name="search" id="search" class="form-control" placeholder="Search Serial No / Call ID / Customer Name / Mobile No / Alternative Mobile No  ...">

                                        </div>
                                    </div>
                                    <div class="col-md-2 mb-2">
                                        <div class="form-group">
                                            <label for="disabledTextInput">From Date</label>

                                            <input type="date" value="{{$from_date}}" name="from_date" id="from_date" class="form-control" placeholder="From date">

                                        </div>
                                    </div>

                                    <div class="col-md-2 mb-2">
                                        <div class="form-group">
                                            <label for="disabledTextInput">To Date</label>

                                            <input type="date" value="{{$to_date}}" name="to_date" id="to_date" class="form-control" placeholder="To date">

                                        </div>
                                    </div>
                                    
                                                                        <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Service status</label>
                                            <select name="service_status" id="service_status" class="form-control">
                                                <option value="all" {{$service_status=='all' ? 'selected':''}}>All</option>
                                                <option value="1" {{$service_status=='1' ? 'selected':''}}>Completed</option>
                                                <option value="0" {{$service_status=='0' ? 'selected':''}}>Closing Request</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Service update status</label>
                                            <select name="update_status" id="update_status" class="form-control">
                                                <option value="all" {{$update_status=='all' ? 'selected':''}}>All</option>
                                                <option value="1" {{$update_status=='1' ? 'selected':''}}>Updated</option>
                                                <option value="0" {{$update_status=='0' ? 'selected':''}}>Not updated</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-1 mb-1">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Filter</label>
                                            <input style="cursor: pointer;background-color:#585858;color:white" type="submit" value="Search" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-1 mb-1">
                                        <label for="disabledTextInput">Download</label>
                                        <a onclick="excelDownload()" class="btn btn-success">
                                            CSV
                                        </a>
                                    </div>


                                </div>
                            </form>


                            <br>


                            <div class="table-responsive datatable-primary">
                                <table class="text-center boh">
                                    <thead class="text-capitalize">
                                        <tr>
                                            <th>S.NO </th>
                                            <th>Call ID</th>
                                            <th>Service Canter Name</th>
                                            <th>Status</th>
                                            <th>Service Type</th>
                                            <th>Product Description</th>
                                            <th>Model No.</th>
                                            <th>Customer Name</th>
                                            <th>Customer Addess</th>
                                            <th>Customer Mobile</th>
                                            <th>Feed Back</th>
                                            <th>Product Rating</th>
                                            <th>Service Rating </th>
                                            <th>Remarks</th>
                                            <th>Opening Date</th>
                                            <th>Closing Date</th>
                                            <th>Days Taken</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($enquiry as $key=>$vl)
                                        @php
                                        $date1=date_create(date('Y-m-d',strtotime($vl->created_at)));
                                        $date2=date_create($vl->finish_date);
                                        $diff=date_diff($date1,$date2);
                                        $between=$diff->format("%a");
                                        @endphp

                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$vl->call_id}}</td>
                                            <td>{{$vl->service_center_name}}</td>
                                            <td style="color:#2fe65e">
                                                <p class="status_color">{{$vl->status}}</p>
                                            </td>
                                            <td>{{$vl->service_type}}</td>
                                            <td>{{$vl->description}}</td>
                                            <td>{{$vl->model_no}}</td>
                                            <td>{{$vl->customer_name}}</td>
                                            <td>{{$vl->customer_address}}</td>
                                            <td>{{$vl->customer_phone}}</td>
                                            <td>{{$vl->feed_back}}</td>
                                            <td>{{$vl->product_rating}}</td>
                                            <td>{{$vl->service_rating}}</td>
                                            <td>{{$vl->calling_remarks}}</td>
                                            <td>{{basicDateFormat($vl->created_at)}}</td>
                                            <td>{{basicDateFormat($vl->finish_date)}}</td>
                                            <td>{{$between}}</td>
                                            <td>

                                                <button><i data-placement="top" title="Edit" class="fa fa-edit" data-toggle="modal" data-target="#exampleModal{{$vl->id}}" style="color:#f24734"></i></button>



                                            </td>
                                        </tr>

                                        <div class="modal fade" id="exampleModal{{$vl->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content model_color">
                                                    <div class="modal-header">

                                                        <h5 class="modal-title" id="exampleModalLabel">Ratings & Remarks</h5>
                                                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post" action="{{route('ratings')}}">
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{$vl->id}}">



                                                            <div class="mb-3">
                                                                <label for="recipient-name" class="col-form-label">Call ID:</label>
                                                                <input type="text" readonly name="call_id" value="{{$vl->call_id}}" class="form-control" id="recipient-name">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="recipient-name" class="col-form-label">Feed Back:</label>
                                                                <input type="text" required="" value="{{$vl->feed_back}}" name="feed_back" class="form-control" id="recipient-name">


                                                            </div>
                                                            <label for="recipient-name" class="col-form-label">Product Ratings:</label>


                                                            <div class="form-row">
                                                                <div class="col-md-1 mb-1">
                                                                    <div class="form-group">
                                                                        <label for="disabledTextInput">1</label>
                                                                        <input required="" value="1" type="radio" {{$vl->product_rating=='1' ? 'checked' : '' }} name="product_rating" class="form-control">



                                                                    </div>
                                                                </div>
                                                                <div class="col-md-1 mb-1">
                                                                    <div class="form-group">
                                                                        <label for="disabledTextInput">2</label>
                                                                        <input value="2" type="radio" {{$vl->product_rating=='2' ? 'checked' : '' }} name="product_rating" class="form-control">


                                                                    </div>
                                                                </div>

                                                                <div class="col-md-1 mb-1">
                                                                    <div class="form-group">
                                                                        <label for="disabledTextInput">3</label>
                                                                        <input value="3" type="radio" {{$vl->product_rating=='3' ? 'checked' : '' }} name="product_rating" class="form-control">

                                                                    </div>
                                                                </div>

                                                                <div class="col-md-1 mb-1">
                                                                    <div class="form-group">
                                                                        <label for="disabledTextInput">4</label>
                                                                        <input value="4" type="radio" {{$vl->product_rating=='4' ? 'checked' : '' }} name="product_rating" class="form-control">

                                                                    </div>
                                                                </div>

                                                                <div class="col-md-1 mb-1">
                                                                    <div class="form-group">
                                                                        <label for="disabledTextInput">5</label>
                                                                        <input value="5" type="radio" {{$vl->product_rating=='5' ? 'checked' : '' }} name="product_rating" class="form-control">

                                                                    </div>
                                                                </div>

                                                                <div class="col-md-1 mb-1">
                                                                    <div class="form-group">
                                                                        <label for="disabledTextInput">6</label>
                                                                        <input value="6" type="radio" {{$vl->product_rating=='6' ? 'checked' : '' }} name="product_rating" class="form-control">

                                                                    </div>
                                                                </div>

                                                                <div class="col-md-1 mb-1">
                                                                    <div class="form-group">
                                                                        <label for="disabledTextInput">7</label>
                                                                        <input value="7" type="radio" {{$vl->product_rating=='7' ? 'checked' : '' }} name="product_rating" class="form-control">

                                                                    </div>
                                                                </div>

                                                                <div class="col-md-1 mb-1">
                                                                    <div class="form-group">
                                                                        <label for="disabledTextInput">8</label>
                                                                        <input value="8" type="radio" {{$vl->product_rating=='8' ? 'checked' : '' }} name="product_rating" class="form-control">

                                                                    </div>
                                                                </div>

                                                                <div class="col-md-1 mb-1">
                                                                    <div class="form-group">
                                                                        <label for="disabledTextInput">9</label>
                                                                        <input value="9" type="radio" {{$vl->product_rating=='9' ? 'checked' : '' }} name="product_rating" class="form-control">

                                                                    </div>
                                                                </div>
                                                                <div class="col-md-1 mb-1">
                                                                    <div class="form-group">
                                                                        <label for="disabledTextInput">10</label>
                                                                        <input value="10" type="radio" {{$vl->product_rating=='10' ? 'checked' : '' }} name="product_rating" class="form-control">

                                                                    </div>
                                                                </div>



                                                            </div>
                                                            <label for="recipient-name" class="col-form-label">Service Ratings:</label>


                                                            <div class="form-row">
                                                                <div class="col-md-1 mb-1">
                                                                    <div class="form-group">
                                                                        <label for="disabledTextInput">1</label>
                                                                        <input value="1" required="" {{$vl->service_rating=='1' ? 'checked' : '' }} type="radio" name="service_rating" class="form-control">


                                                                    </div>
                                                                </div>
                                                                <div class="col-md-1 mb-1">
                                                                    <div class="form-group">
                                                                        <label for="disabledTextInput">2</label>
                                                                        <input value="2" type="radio" {{$vl->service_rating=='2' ? 'checked' : '' }} name="service_rating" class="form-control">


                                                                    </div>
                                                                </div>

                                                                <div class="col-md-1 mb-1">
                                                                    <div class="form-group">
                                                                        <label for="disabledTextInput">3</label>
                                                                        <input value="3" type="radio" {{$vl->service_rating=='3' ? 'checked' : '' }} name="service_rating" class="form-control">


                                                                    </div>
                                                                </div>

                                                                <div class="col-md-1 mb-1">
                                                                    <div class="form-group">
                                                                        <label for="disabledTextInput">4</label>
                                                                        <input value="4" type="radio" {{$vl->service_rating=='4' ? 'checked' : '' }} name="service_rating" class="form-control">


                                                                    </div>
                                                                </div>

                                                                <div class="col-md-1 mb-1">
                                                                    <div class="form-group">
                                                                        <label for="disabledTextInput">5</label>
                                                                        <input value="5" type="radio" {{$vl->service_rating=='5' ? 'checked' : '' }} name="service_rating" class="form-control">


                                                                    </div>
                                                                </div>

                                                                <div class="col-md-1 mb-1">
                                                                    <div class="form-group">
                                                                        <label for="disabledTextInput">6</label>
                                                                        <input value="6" type="radio" {{$vl->service_rating=='6' ? 'checked' : '' }} name="service_rating" class="form-control">


                                                                    </div>
                                                                </div>

                                                                <div class="col-md-1 mb-1">
                                                                    <div class="form-group">
                                                                        <label for="disabledTextInput">7</label>
                                                                        <input value="7" type="radio" {{$vl->service_rating=='7' ? 'checked' : '' }} name="service_rating" class="form-control">


                                                                    </div>
                                                                </div>

                                                                <div class="col-md-1 mb-1">
                                                                    <div class="form-group">
                                                                        <label for="disabledTextInput">8</label>
                                                                        <input value="8" type="radio" {{$vl->service_rating=='8' ? 'checked' : '' }} name="service_rating" class="form-control">


                                                                    </div>
                                                                </div>

                                                                <div class="col-md-1 mb-1">
                                                                    <div class="form-group">
                                                                        <label for="disabledTextInput">9</label>
                                                                        <input value="9" type="radio" {{$vl->service_rating=='9' ? 'checked' : '' }} name="service_rating" class="form-control">


                                                                    </div>
                                                                </div>
                                                                <div class="col-md-1 mb-1">
                                                                    <div class="form-group">
                                                                        <label for="disabledTextInput">10</label>
                                                                        <input value="10" type="radio" {{$vl->service_rating=='10' ? 'checked' : '' }} name="service_rating" class="form-control">


                                                                    </div>
                                                                </div>



                                                            </div>


                                                            <div class="mb-3">
                                                                <label for="message-text" class="col-form-label">Remarks:</label>
                                                                <textarea class="form-control" required="" name="calling_remarks" id="message-text">{{$vl->calling_remarks}}</textarea>
                                                            </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
                                                        <button type="submit" name="complete" value="complete" class="btn btn-success">Complete</button>
                                                    </div>
                                                    </form>

                                                    <div class="modal-header">

                                                        <h5 class="modal-title" id="exampleModalLabel">Enquiry Images</h5>
                                                    </div>
                                                    @foreach ($vl->enquiryimage as $image)
                                                    <div class="form-row">
                                                        @if($image->invoice_copy!='')
                                                        <div class="col-md-2 mb-2">
                                                            <div class="form-group">
                                                                <label for="disabledTextInput">Invoice copy</label>
                                                                <img src="{{ $image::EnquiryImage($image->invoice_copy) }}" style="width:100px;height:100px">
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @if($image->symptoms_issue!='')
                                                        <div class="col-md-2 mb-2">
                                                            <div class="form-group">
                                                                <label for="disabledTextInput">Symptoms issue</label>
                                                                <img src="{{ $image::EnquiryImage($image->symptoms_issue) }}" style="width:100px;height:100px">
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @if($image->back_serial!='')
                                                        <div class="col-md-2 mb-2">
                                                            <div class="form-group">
                                                                <label for="disabledTextInput">Model & Serial</label>
                                                                <img src="{{ $image::EnquiryImage($image->back_serial) }}" style="width:100px;height:100px">
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @if($image->panel_serial!='')
                                                        <div class="col-md-2 mb-2">
                                                            <div class="form-group">
                                                                <label for="disabledTextInput">Part Serial</label>
                                                                <img src="{{ $image::EnquiryImage($image->panel_serial) }}" style="width:100px;height:100px">
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @if($image->product_fit!='')
                                                        <div class="col-md-2 mb-2">
                                                            <div class="form-group">
                                                                <label for="disabledTextInput">Product</label>
                                                                <img src="{{ $image::EnquiryImage($image->product_fit) }}" style="width:100px;height:100px">
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @if($image->warranty_card!='')
                                                        <div class="col-md-2 mb-2">
                                                            <div class="form-group">
                                                                <label for="disabledTextInput">Part</label>
                                                                <img src="{{ $image::EnquiryImage($image->warranty_card) }}" style="width:100px;height:100px">
                                                            </div>
                                                        </div>
                                                        @endif
                                                         @if($image->other!='')
                                                        @foreach (json_decode($image->other) as $other)
                                                        <div class="col-md-2 mb-2">
                                                            <div class="form-group">
                                                                <label for="disabledTextInput">Working Product</label>
                                                                <img src="{{ $image::EnquiryImage($other) }}" style="width:100px;height:100px">
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                        @endif

                                                    </div>
                                                    @endforeach


                                                </div>
                                            </div>
                                        </div>
                            </div>








                            @endforeach


                            </tbody>

                            </table>
                            {{$enquiry->appends(request()->except('page'))->links('pagination::bootstrap-5')}}


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
        $("button[data-bs-dismiss=modal]").click(function() {
            $(".modal").modal('hide');
        });

    </script>


    <script>
        function excelDownload() {
            var from_date = document.getElementById('from_date').value;
            var to_date = document.getElementById('to_date').value;
            var search = document.getElementById('search').value;
            var service_status = document.getElementById('service_status').value;
            var update_status = document.getElementById('update_status').value;


            var url = "{{ route('customer.support.export')}}?" + 'from_date=' + from_date + '&to_date=' + to_date + '&search=' + search + '&service_status=' + service_status + '&update_status=' + update_status;

            window.open(url, '_blank');
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
