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
                            <h4 class="header-title">Cities
                            <a href="{{ route('add_city') }}"class="btn btn-primary btns" >  <i class="fa fa-plus-circle" ></i>  Add city</a></h4>
                            <br>


                            <div class="table-responsive datatable-primary">
                                <table id="dataTable2" class="text-center boh">
                                    <thead class="text-capitalize">
                                    <tr>
                                        <th>S.NO </th>
                                        <th>City name</th>

                                        <th>State name</th>
                                        <th>country</th>
                                        <th>status</th>
                                        <th>date</th>
                                        <th>action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($city as $key=>$vl)
                                        @php
                                           $color= $vl->status=='Enable'? 'green' : 'red';
                                           $color="color:".$color;
                                           
                                        @endphp
                                           
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$vl->city}}</td>

                                        <td>{{$vl->state}}</td>
                                        <td>{{$vl->country}}</td>
                                        <td style="{{ $color }}" >{{$vl->status}}</td>
                                        <td>{{$vl->date}}</td>
                                        <td class="editc"><a href="{{url('city_edit/'.$vl->id)}}"><i class="fa fa-edit" style="color:#056c91"></i></a>
                                        &nbsp;&nbsp;
                                       <a onclick="return del('{{$vl->id}}');"><i class="fa fa-trash" style="color:red"></i></a></td>
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
    .editc{
        display: flex;justify-content: space-around;

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

<script>
    function del(id)
    {
      var  chs=confirm('Are you sure you want to delete this state?');
        if(chs)
        {
          document.location.href="{{url('city_delete')}}/"+id;
        }

    }
</script>


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
