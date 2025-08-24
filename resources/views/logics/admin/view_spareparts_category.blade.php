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
                            <h4 class="header-title">Spare Parts Category
                                 @if(session()->get('partner_type')!='Accounts')
                            <a href="{{ url('add_spareparts_category') }}"class="btn btn-primary btns" >  <i class="fa fa-plus-circle" ></i> Add Category </a></h4>
                          @endif
                            <br>


                            <div class="table-responsive datatable-primary">
                                <table id="dataTable" class="text-center">
                                    <thead class="text-capitalize">
                                    <tr>
                                        <th>S.NO </th>
                                        <th>Category name</th>
                                        <th>Status</th>
                                            @if(session()->get('partner_type')!='Accounts')

                                        <th>Action</th>
                                        @endif
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($category_list as $key=>$vl)
                                        @php

                                        $text= $vl->status==0 ? 'Enable' : 'Disable';



                                           $color= $vl->status==0? 'label label-success' : 'label label-danger';


                                        @endphp

                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{ucfirst($vl->category_name)}}</td>

                                        <td><span class="{{$color}}">{{$text}}</span></td>
@if(session()->get('partner_type')!='Accounts')

                                        <td class="editc"><a data-toggle="modal" data-target="#exampleModal{{$vl->id}}" data-whatever="@mdo"><i  data-placement="top" title="Edit"  class="fa fa-edit" style="color:#056c91"></i></a>

                                        &nbsp;&nbsp;
                                       <a onclick="return del('{{$vl->id}}','spareparts_models');"><i  data-placement="top" title="Delete" class="fa fa-trash" style="color:red"></i></a></td>


                                       <div class="modal fade" id="exampleModal{{$vl->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Spare Parts Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <form method="post" action="{{url('update_spareparts_category')}}">
         @csrf
      <div class="modal-body">

          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Category Name:</label>
            <input type="text" class="form-control" id="recipient-name" value="{{$vl->category_name}}" name="category_name">

             <input type="hidden" class="form-control" value="{{$vl->id}}" name="id">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Status:</label>
           <select class="form-control" name="status">
            @php


            $option=$vl->status==0 ? 'Enable':'disable';
            @endphp

             <option value="{{$vl->status}}" selected hidden>{{$option}}</option>
            <option value="0">Enable</option>
            <option value="1">Diable</option>
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






    <!--=================================*
           End Main Content Section
    *===================================-->

   <script>
       $(document).ready(function() {
           $('#dataTable').DataTable({


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

<script>
    function del(id,table)
    {
      var  chs=confirm('Are you sure you want to delete this Category?');
        if(chs)
        {
          document.location.href="{{url('dalete_spareparts_category')}}/"+id+"/"+table;
        }

    }
</script>


 @include('logics.include.datatable')



<!--=========================*
            Scripts
*===========================-->


</body>
</html>
