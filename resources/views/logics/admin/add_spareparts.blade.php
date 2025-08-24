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
            @include('login.flashsearch')
            <div class="row">
                <!-- Disabled forms start -->
                <div class="col-12 mt-4" style="margin-top:0 !important;">
                    <div class="card">
                        <div class="card-body">
                            <center>
                                <h5 class="card_title " style="color:#50aaca"> Add Spare Parts
                                    <a href="{{ url('view_spareparts') }}" class="btn btn-primary btns"> <i class="fa fa-plus-circle"></i>Manage Parts</a>
                                </h5>
                            </center>
                            <hr>
                            <form method="post" action="{{url('store_spareparts')}}">
                                @csrf




                                <div class="form-group">
                                    <label for="disabledTextInput">Part Code <span style="color:red">&#9733;</span></label>

                                    <select required="" onchange="part_details(this.value)" name="part_code" class="form-control selectsearch">
                                        <option value="">Select</option>
                                        @foreach($p_list as $s_val)

                                        <option {{old('part_code')==$s_val->part_code ? 'selected':''}} value="{{$s_val->part_code}}">{{$s_val->part_code}} ({{$s_val->part_name}})</option>


                                        @endforeach

                                    </select>
                                </div>


                                <div class="form-group">
                                    <label for="disabledTextInput">Part Name <span style="color:red">&#9733;</span></label>
                                    <input type="text" readonly value="{{old('part_name')}}" required="" name="part_name" class="form-control part_name" placeholder="Spare Parts  Name">
                                </div>

                                <div class="form-group">
                                    <label for="disabledTextInput">Part Qty <span style="color:red">&#9733;</span></label>
                                    <input type="number" min="1" value="{{old('part_qty')}}" required="" name="part_qty" class="form-control" placeholder="Spare Parts Qty">
                                </div>

                                <div class="form-group">
                                    <label for="disabledTextInput">Part Category <span style="color:red">&#9733;</span></label>
                                    <select required="" name="part_category" class="form-control part_category" onchange="callmyfun(this.value)">
                                        <option value="">Select</option>

                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="disabledTextInput">Part Price <span style="color:red">&#9733;</span></label>
                                    <input type="number" value="{{old('part_price')}}" min="1" required="" name="part_price" class="form-control part_price" placeholder="Spare Parts Price">

                                </div>

                                <div class="form-group">
                                    <label for="disabledTextInput">Gst Percentage% <span style="color:red">&#9733;</span></label>
                                    <input type="text" value="{{old('gst')}}" required="" name="gst" class="form-control gst" placeholder="Gst Percentage">

                                </div>

                                <div class="form-group">
                                    <label for="disabledTextInput">Part Status <span style="color:red">&#9733;</span></label>
                                    <select required="" name="part_status" class="form-control" id="assign">
                                        <option value="" selected hidden disabled>Select Type</option>
                                        <option {{'Goods'==old('part_status') ? 'selected':''}} value="Goods">Goods</option>
                                        <option {{'Defective'==old('part_status') ? 'selected':''}} value="Defective">Defective</option>

                                    </select>
                                </div>






                                <center><button type="submit" class="btn btn-primary mt-4 pl-4 pr-4">Submit</button>
                                </center>
                                <div class="form-row">

                                    <span style="color:red">&#9733;</span>
                                    <p>- Mandatory field</p>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>






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
        @include('logics.include.footer_select')

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
        function part_details(part_code) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            event.preventDefault();
            $.ajax({
                type: 'POST'
                , url: "{{ route('part.code.details')}}"
                , data: {
                    part_code: part_code
                }
                , success: function(data) {
                    var val = JSON.parse(data);
                    $('.part_category').html(val.op);
                    $('.part_name').val(val.output.part_name);
                    $('.part_price').val(val.output.price);
                    $('.gst').val(val.output.gst_percentage);
                    callmyfun(val.output.category_id)
                }
                , error: function(data) {
                    swal({
                        type: "error"
                        , title: "Error!"
                        , text: "Invalid Part Code"
                        , confirmButtonText: "Dismiss"
                        , buttonsStyling: !1
                        , confirmButtonClass: "btn btn-danger"
                    });

                }
            , });


        }

    </script>


    <script>
        function callmyfun(val) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST'
                , url: "{{ url('check_category')}}"
                , data: {
                    id: val,

                }
                , success: function(data) {

                    if (data === "Non Returnable (C)") {

                        var op = "<option value='Goods'>Goods</option>";

                        document.getElementById("assign").innerHTML = op;
                    } else {
                        var op = "<option value='Goods'>Goods</option><option value='Defective'>Defective</option>";



                        document.getElementById("assign").innerHTML = op;
                    }

                }
            });
        }

    </script>

</body>

</html>
