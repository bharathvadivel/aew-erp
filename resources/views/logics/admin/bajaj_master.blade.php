<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>

    <!--=========================*
        Met Data
        *===========================-->
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
                            <h4 class="header-title" style="display:flex;justify-content: space-between;align-content: space-around;">Manage Bajaj/TVS Finance Serial Number List

                                <a href="{{ url('bajaj') }}" class="btn btn-primary btns"> <i class="fa fa-plus-circle"></i> Add Bajaj/TVS Finance Serial Number List</a>

                            </h4>
                            <form method="GET" action="{{route('bajaj.master')}}">
                                <div class="form-row">

                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Search</label>

                                            <input type="text" value="{{$search}}" name="search" class="form-control" id="search" placeholder="Search Category / Product Name / Model No / Serial No ...">

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


                                    <div class="col-md-1 mb-1">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Filter</label>
                                            <input style="cursor: pointer;background-color:#585858;color:white" type="submit" value="Search" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-1 mb-1">
                                        <label for="disabledTextInput">Download</label>
                                        <a onclick="excelDownload()"  class="btn btn-success">
                                            CSV
                                        </a>
                                    </div>

                                </div>
                            </form>




                            <div class="single-table">
                                <div class="table-responsive">
                                    <table class="table table-striped text-center">
                                        <thead class="text-uppercase">
                                            <tr>
                                                <th>S.NO </th>
                                                <th>Category</th>
                                                <th>Product name</th>
                                                <th>Model NO</th>
                                                <th>Serial NO</th>
                                                <th>Status</th>
                                                <th>Sold by</th>
                                                <th>Created Date</th>
                                                <th>Updated Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($bajaj) > 0)

                                            @foreach ($bajaj as $key=>$vl)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{$vl->gategory ? $vl->gategory->gategory_name:''}}</td>
                                                <td>{{$vl->product ? $vl->product->description:''}}</td>
                                                <td>{{$vl->model_no}}</td>
                                                <td>{{$vl->serial_no}}</td>
                                                <td>{{$vl->status=='unused' ? 'Unsold':'Sold' }}</td>
                                                <td>{{$vl->status=='unused' ? '': ($vl->sold_by==1 ? 'Cash':'Bajaj/TVS') }}</td>
                                                <td>{{basicDateFormat($vl->created_at)}}</td>
                                                <td>{{basicDateFormat($vl->updated_at)}}</td>
                                                <td>
                                                    <form onsubmit="return confirm('Are you sure you want to delete?');" action="{{ route('bajaj.delete',$vl->id)}}">
                                                        <input type="hidden" name="_method" value="GET">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <button><i data-placement="top" title="Delete" class="fa fa-trash" style="color:red"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach @else
                                            <tr>
                                                <td colspan="9">No result found</td>
                                            </tr>
                                            @endif



                                        </tbody>
                                    </table>
                                    {{$bajaj->appends(request()->except('page'))->links('pagination::bootstrap-5')}}
                                </div>
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
        function excelDownload() {
            var from_date = document.getElementById('from_date').value;
            var to_date = document.getElementById('to_date').value;
            var search = document.getElementById('search').value;

            var url = "{{ route('bajaj.export')}}?" + 'from_date=' + from_date + '&to_date=' + to_date + '&search=' + search;




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




</body>

</html>
