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
                            <h4 class="header-title">Marketing creatives
                                <a href="{{ route('add.marketing') }}" class="btn btn-primary btns"> <i class="fa fa-plus-circle"></i> Add marketing creatives</a>
                            </h4>
                            <br>


                            <div class="table-responsive datatable-primary">
                                <table id="dataTable2" class="text-center boh">
                                    <thead class="text-capitalize">
                                        <tr>
                                            <th>S.NO </th>
                                            <th>Title</th>
                                            <th>Post</th>
                                            <th>date</th>
                                            <th>action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($marketing as $key=>$vl)
                                        @php
                                        $value=json_decode($vl->posts,true);
                                        @endphp
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$vl->title}}</td>
                                            <td>
                                            @foreach($value as $img)
                                                <img style="width:70px;height:70px" src="{{ url('/').'/'.$img }}">
                                            @endforeach
                                            </td>
                                            <td>{{basicDateFormat($vl->created_at)}}</td>
                                            <td><a href="{{route('marketing.edit',$vl->id)}}"><i  data-placement="top" title="Edit" class="fa fa-edit" style="color:#056c91"></i></a>

                                                <form onsubmit="return confirm('Are you sure you want to delete?');" action="{{ route('marketing.delete',$vl->id)}}" method="POST">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <button><i  data-placement="top" title="Delete" class="fa fa-trash" style="color:red"></i></button>
                                                </form>
                                            </td>
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
            margin-top: 21px;

        }
    </style>
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




    <script src="{{asset('user/vendors/data-table/js/jquery.dataTables.js')}}"></script>
    <script src="{{asset('user/vendors/data-table/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('user/vendors/data-table/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('user/vendors/data-table/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('user/vendors/data-table/js/responsive.bootstrap.min.js')}}"></script>

    <!-- Data table Init -->
    <script src="{{asset('user/js/init/data-table.js')}}"></script>


    <!--=========================*
            Scripts
*===========================-->


</body>

</html>
