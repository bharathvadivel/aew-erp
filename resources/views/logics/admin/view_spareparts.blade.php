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
                            @include('login.flashsearch')

                            <div class="row">
                                <!-- Primary table -->
                                <div class="col-12 mt-4">
                                    <div class="card">
                                        <div class="card-body">


                                            <h4 class="header-title">Spare Parts List
                                                @if(session()->get('partner_type')!='Accounts')

                                                <a href="{{ url('add_spareparts') }}" class="btn btn-primary btns"> <i class="fa fa-plus-circle"></i> Add New Parts </a></h4>
                                                @endif
                                                <div class="table-responsive datatable-primary">
                                                    <table id="dataTable" class="text-center boh">
                                                        <thead class="text-capitalize">
                                                            <tr>
                                                                <th>S.NO </th>
                                                                <th>Part Code</th>
                                                                <th>Part Name</th>
                                                                <th>Part Qty</th>
                                                                <th>Part Category</th>
                                                                <th>Part price</th>
                                                                <th>Part Gst Percentage</th>
                                                                <th>Part Status</th>
                                                                @if(session()->get('partner_type')!='Accounts')
                                                                <th>Action</th>
                                                                @endif
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($parts_list as $key=>$vl)

                                                            @php

                                                            $cat_id=$vl->category_id;
                                                            $from= DB::table('spareparts_models')->where('id',$cat_id)->first();
                                                            @endphp

                                                            <tr>
                                                                <td>{{$key+1}}</td>
                                                                <td>{{$vl->part_code}}</td>
                                                                <td>{{ucfirst($vl->part_name)}}</td>
                                                                <td>{{$vl->qty}}</td>
                                                                <td>{{$from->category_name}}</td>
                                                                <td>{{$vl->price}}</td>
                                                                <td>{{$vl->gst_percentage}}</td>
                                                                <td>{{$vl->status}}</td>

                                                                @if(session()->get('partner_type')!='Accounts')
                                                                <td class="editc"><a href="{{route('spareparts.edit',$vl->id)}}"><i  data-placement="top" title="Edit" class="fa fa-edit" style="color:#056c91"></i></a>
                                                                    &nbsp;&nbsp;
                                                                    <a onclick="return del('{{$vl->id}}','parts');"><i  data-placement="top" title="Delete" class="fa fa-trash" style="color:red"></i></a></td>
                                                                    @endif




                                                                    <div class="modal fade" id="exampleModal{{$vl->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Parts</h5>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
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

                                                                                        @endif
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
                                                            columns: [0, 1, 2, 3, 4, 5, 6, 7]
                                                        }
                                                    }
                                                    , {
                                                        extend: 'csv'
                                                        , exportOptions: {
                                                            columns: [0, 1, 2, 3, 4, 5, 6, 7]


                                                        }
                                                    }
                                                    , {
                                                        extend: 'excel'
                                                        , exportOptions: {
                                                            columns: [0, 1, 2, 3, 4, 5, 6, 7]

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
                                                @include('logics.include.footer_select')
                                            </footer>
                                            <!--=================================*
                                                End Footer Section
                                                *===================================-->

                                            </div>
                                            <!--=========================*
                                                End Page Container
                                                *===========================-->



                                                <script>
                                                    function del(id, table) {
                                                        var chs = confirm('Are you sure you want to delete this Parts?');
                                                        if (chs) {
                                                            document.location.href = "{{url('dalete_spareparts_category')}}/" + id + "/" + table;
                                                        }

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

                                                                if (data == "Non Returnable (C)")

                                                                {
                                                                    $("#assign").empty()
                                                                    var op = "<option value='Goods'>Goods</option>";

                                                                    document.getElementById("assign").innerHTML = op;
                                                                } else {
                                                                    $("#assign").empty()
                                                                    var op = "<option value='Goods'>Goods</option><option value='Defective'>Defective</option>";



                                                                    document.getElementById("assign").innerHTML = op;
                                                                }

                                                            }
                                                        });
                                                    }

                                                </script>

                                                @include('logics.include.datatable')



                                                <!--=========================*
                                                    Scripts
                                                    *===========================-->


                                                </body>
                                                </html>
