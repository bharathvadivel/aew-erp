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
                                <h5 class="card_title " style="color:#50aaca"> Edit Spare Parts
                                    <a href="{{ url('view_spareparts') }}" class="btn btn-primary btns"> <i class="fa fa-plus-circle"></i>Manage Parts</a>
                                </h5>
                            </center>
                            <hr>
                            <form method="post" action="{{url('update_spareparts')}}">
                                @csrf
                                <div class="modal-body">
                                    @if($vl->status=='Goods')
                                    <div class="form-group">
                                        <label for="disabledTextInput">Part Code Type </label>
                                        <select onchange="defect(this.value)" required="" name="part_code_check" class="form-control">
                                            <option value="0">Goods (New Part)</option>
                                            <option value="1">Goods (Refurbished Part)</option>
                                        </select>
                                    </div>
                                    @else
                                    <input type="hidden" name="part_code_check" value="0">
                                    @endif
                                    <div class="form-group">
                                        <label for="disabledTextInput">Qty Type </label>
                                        <select required="" name="qty_type" class="form-control">
                                            <option>Select Type</option>
                                            <option value="1">Add Qty</option>
                                            <option value="0">Reduce Qty</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Enter Qty:</label>
                                        <input type="number" value="0" placeholder="Enter quantity to update" class="form-control" id="recipient-name" name="add_qty">
                                    </div>

                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Part Code:</label>
                                        <input type="text" readonly class="form-control" id="recipient-name" value="{{$vl->part_code}}" name="part_code">

                                        <input type="hidden" class="form-control" value="{{$vl->id}}" name="id">
                                    </div>
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Part Name:</label>
                                        <input type="text" readonly class="form-control" id="recipient-name" value="{{$vl->part_name}}" name="part_name">



                                    </div>

                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Part Available Qty:</label>
                                        <input type="number" min="0" readonly class="form-control" id="part_qty{{$vl->id}}" value="{{$vl->qty}}" name="part_qty">


                                    </div>

                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Part Category:</label>
                                        <select required="" name="part_category" class="form-control" onchange="callmyfun(this.value)">

                                            <option value="{{ $vl->category_id }}">{{ $from->category_name }}</option>
                                            {{-- @foreach ($category_list as $key)

                                                                        <option value="{{ $key->id }}">{{ $key->category_name }}</option>
                                            @endforeach --}}


                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Part Price:</label>
                                        <input type="number" readonly min="1" class="form-control" id="recipient-name" value="{{$vl->price}}" name="part_price">


                                    </div>

                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Gst:</label>
                                        <input type="text" readonly class="form-control" id="recipient-name" value="{{$vl->gst_percentage}}" name="gst">



                                    </div>

                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Part Status:</label>
                                        <select required="" name="part_status" class="form-control" id="assign">
                                            <option value="{{$vl->status}}" selected hidden>{{$vl->status}}</option>
                                            {{-- <option disabled value="Goods">Goods</option>
                                                                        <option disabled value="Defective">Defective</option> --}}
                                        </select>


                                    </div>


                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save Change</button>
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


</body>

</html>
