<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <script src="{{asset('user/new_js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('user/new_js/jquery.js')}}"></script>
    <link rel="stylesheet" href="{{asset('user/new_css/choices.min.css')}}">
    <link rel="stylesheet" href="{{asset('user/new_css/bootstrap.min.css')}}">
    <script src="{{asset('user/vendors/sweetalert2/js/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('user/vendors/sweetalert2/js/sweetalert2.all.min.js')}}"></script>

    <script src="{{asset('user/new_js/choices.min.js')}}"></script>

    <script src="{{asset('user/new_js/bootstrap.bundle.min.js')}}"></script>

    <!--=========================*
        Met Data
        *===========================-->
        <meta charset="UTF-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!--=========================*
            Page Title
            *===========================-->
            <title>ERP</title>

            <style>
                .extra {
                    font-size: 20px;

                    background-color: #ffffff;
                    padding-top: 10px;
                    padding-bottom: 10px;
                    border-radius: 5px;

                }


                .mt-4 {
                    margin-top: 0 rem !important;
                }

                .choices__inner {
                    min-height: 0px !important;
                    background-color: white !important;
                }

                .choices__input {
                    background-color: white !important;
                    padding: 0px;
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
                            <!-- <div class="row">
                                <div class="col-12 mt-4">

                                    <center><h4 class="card_title extra" > Create Project </h4></center>


                                </div>
                            </div> -->
                            @include('login.flash')
                            @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            <div class="row">
                                <!-- Disabled forms start -->
                                <div class="col-12 mt-4" style="margin-top:0!important;">
                                    <div class="card">
                                        <div class="card-body">
                                            <center>
                                                <h5 class="card_title " style="color:#50aaca"> Add Invoice
                                                    <a href="{{ route('partorder.invoice.master') }}" class="btn btn-primary btns"> <i class="fa fa-plus-circle"></i>Manage invoice </a>
                                                </h5>


                                            </center>


                                            <hr>
                                            <form method="">
                                                @csrf
                                                <div class="form-row">

                                                    <div class="col-md-3 mb-3">
                                                        <div class="form-group">
                                                            <label for="disabledTextInput">invoice no <span style="color:red">&#9733;</span></label>
                                                            <input readonly value="{{$row[0]->invoice_no}}" type="text" name="invoice_no" class="form-control" placeholder="Invoice no">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3 mb-3">
                                                        <div class="form-group">
                                                            <label for="disabledTextInput">Service Center Mobile Number <span style="color:red">&#9733;</span></label>
                                                            <input  minlength="10" readonly maxlength="10" type="text" value="{{ $row[0]->service_center_phone }}" name="service_center_phone" class="form-control" placeholder="Mobile Number">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 mb-6">
                                                        <div class="form-group">
                                                            <label for="disabledTextInput">Service Center  Address <span style="color:red">&#9733;</span></label>
                                                            <input type="text" readonly value="{{ $row[0]->service_center_address }}" name="service_center_address" class="form-control" placeholder="Address">

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">




                                                    <div class="col-md-4 mb-4">
                                                        <div class="form-group">
                                                            <label for="disabledTextInput"> Service Center City<span style="color:red">&#9733;</span></label>
                                                            <input type="text" readonly value="{{ $row[0]->service_center_city }}"  name="service_center_city" class="form-control" placeholder="City"></input>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4 mb-4">
                                                        <div class="form-group">
                                                            <label for="disabledTextInput"> Service Center District<span style="color:red">&#9733;</span></label>
                                                            <input type="text" readonly value="{{ $row[0]->service_center_district }}" name="service_center_district" class="form-control" placeholder="District"></input>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4 mb-4">
                                                        <div class="form-group">
                                                            <label for="disabledTextInput"> Service Center State<span style="color:red">&#9733;</span></label>
                                                            <input type="text" readonly value="{{ $row[0]->service_center_state }}" name="service_center_state" class="form-control" placeholder="State"></input>
                                                        </div>
                                                    </div>

                                                </div>




                                                {{-- <div class="form-row">


                                                    <div class="col-md-4 mb-4">
                                                        <div class="form-group">
                                                            <label for="disabledSelect">Part name <span style="color:red">&#9733;</span></label>
                                                            <select onchange="cat(this.value)" name="part_code" class="form-control v1">
                                                                <option value="">Select</option>

                                                                @foreach ($part as $key)

                                                                <option value="{{ $key->part_code }}">{{ $key->part_code }}</option>
                                                                @endforeach


                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4 mb-4">
                                                        <div class="form-group">
                                                            <label for="disabledTextInput">Part Name <span style="color:red">&#9733;</span></label>
                                                            <input readonly type="text" name="part_name" class="form-control part_name" placeholder="Part Name">

                                                        </div>
                                                    </div>

                                                    <div class="col-md-4 mb-4">
                                                        <div class="form-group">
                                                            <label for="disabledSelect">Price<span style="color:red">&#9733;</span></label>
                                                            <input readonly type="text" name="price" class="form-control price" placeholder="Price">

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-row">

                                                    <div class="col-md-4 mb-4">
                                                        <div class="form-group">
                                                            <label for="disabledTextInput">Quantity <span style="color:red">&#9733;</span></label>
                                                            <input readonly type="number" min='1' value="1" name="quantity" class="form-control" placeholder="Quantity">

                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mb-4">
                                                        <div class="form-group">
                                                            <label for="disabledTextInput">GST%<span style="color:red">&#9733;</span></label>
                                                            <input readonly type="text" name="gst" class="form-control gst" placeholder="GST">

                                                        </div>
                                                    </div>

                                                </div> --}}


                                                <input type="hidden" value="{{$row[0]->created_by}}"  name="created_by">


                                                {{-- <div>
                                                    <center><button type="submit" name="submit" class="btn btn-primary mt-4 pl-4 pr-4 btn-submit">Add</button>
                                                    </center>
                                                </div> --}}

                                                <div class="form-row">
                                                    <span style="color:red">&#9733;</span>
                                                    <p>- Mandatory field</p>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>



                                <!-- Striped table start -->
                                <div class="col-lg-12 stretched_card mt-mob-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card_title"></h4>
                                            <div class="single-table">
                                                <div class="table-responsive">
                                                    <table class="table table-striped text-center invoice">
                                                        <thead class="text-uppercase">
                                                            <tr>
                                                                <th scope="col">S.no</th>
                                                                <th scope="col">Part Code</th>
                                                                <th scope="col">Part Name</th>
                                                                <th scope="col">Qty</th>
                                                                <th scope="col">Price</th>
                                                                <th scope="col">GST</th>
                                                                <th scope="col">Total</th>
                                                                <th scope="col">Action</th>

                                                            </tr>
                                                            <tbody>
                                                                @php
                                                                $grand_total=0;
                                                                @endphp
                                                                @foreach ($row as $key=>$da)
                                                                @php
                                                                $grand_total+=$da->total;
                                                                @endphp

                                                                <tr>
                                                                    <td scope="row">{{ $key+1 }}</td>
                                                                    <td>{{$da->part_code}}</td>
                                                                    <td>{{$da->part_name}}</td>
                                                                    <td>1</td>
                                                                    <td>{{$da->price}}</td>
                                                                    <td>{{$da->gst}}</td>
                                                                    <td>{{number_format($da->total,2)}}</td>
                                                                      <form onsubmit="return confirm('Are you sure you want to delete?');" action="{{ route('partorder.single.invoice.delete',$da->id)}}" method="POST">
                                                                    <input type="hidden" name="_method" value="DELETE">
                                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                    <td><button><i class="fa fa-trash" style="color:red"></i></button></td>
                                                                </form>
                                                                    {{-- <td>
                                                                        <button class="btn btn-danger"><i class="ti-trash"></i></button>
                                                                    </td> --}}
                                                                </tr>
                                                                @endforeach
                                                                <tfoot>
                                                                    <tr>

                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <form action="{{ route('partorder.invoice.update',$row[0]->partorder_id) }}" method="post">
                                                                            @csrf
                                                                            <td><textarea style="width:250px;border-style: dotted !important;border: 4px solid #e71e0e;" name="remarks" placeholder="Remarks">{{ $row[0]->remarks }}</textarea></td>
                                                                            <input type="hidden" name="invoice_no" value="{{ $row[0]->invoice_no }}">
                                                                            <td><button  type="submit" class="btn btn-danger">Update Invoice</button></td>
                                                                        </form>

                                                                        <td>Total</td>
                                                                        <td>{{number_format($grand_total,2)}}</td>


                                                                    </tr>
                                                                </tfoot>
                                                            </tbody>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Striped table end -->

                                <!-- Disabled forms end -->
                                <!-- Server side start -->

                                <!-- Server side end -->
                            </div>
                        </div>
                        <!--==================================*
                            End Main Section
                            *====================================-->

                        </div>


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


                                    <!--=========================*
                                        General Scripts
                                        *===========================-->














                                        <script>
                                            function cat(part_code) {
                                                $.ajaxSetup({
                                                    headers: {
                                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                    }
                                                });
                                                event.preventDefault();

                                                $.ajax({
                                                    type: 'POST',
                                                    url: "{{ route('part.code.select')}}",
                                                    data: {
                                                        part_code: part_code
                                                    },
                                                    success: function(response) {
                                                        var data=JSON.parse(response);
                                                        $('.part_name').val(data.part_name);
                                                        $('.price').val(data.price);
                                                        $('.gst').val(data.gst);



                                                    },
                                                    error: function(data) {
                                                        swal({
                                                            type: "error",
                                                            title: "Error!",
                                                            text: "Something went wrong please fill required fileds!",
                                                            confirmButtonText: "Dismiss",
                                                            buttonsStyling: !1,
                                                            confirmButtonClass: "btn btn-danger"
                                                        })
                                                    },
                                                });


                                            }
                                        </script>







                                    </body>

                                    </html>
