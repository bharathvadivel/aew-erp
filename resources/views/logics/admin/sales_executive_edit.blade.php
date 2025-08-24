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
            <div class="row">
                <!-- Disabled forms start -->
                <div class="col-12 mt-4" style="margin-top:0!important;">
                    <div class="card">
                        <div class="card-body">
                            <center>
                                <h5 class="card_title " style="color:#50aaca"> Sales Executive Edit
                                    <a href="{{ route('sales_executive.master') }}" class="btn btn-primary btns"> <i class="fa fa-plus-circle"></i>Manage Sales Executive</a>
                                </h5>
                            </center>
                            <hr>
                            <form method="post" action="{{route('sales_executive.update',$row->id)}}">
                                @csrf
                                <div class="form-row">
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Sales Executive Head-ID</label>
                                            <input readonly value="{{$row->sales_executive_id}}" type="text" name="sales_executive_id" class="form-control" placeholder="Sales Executive ID">
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Name</label>
                                            <input required="" value="{{$row->name}}" type="text" name="name" class="form-control" placeholder="Name">
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Email</label>
                                            <input type="email" value="{{$row->email}}"  name="email" class="form-control" placeholder="Email">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">

                              
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Address</label>
                                            <input required="" value="{{$row->address}}"  type="text" name="address" class="form-control" placeholder="Address">
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Pincode</label>
                                            <input required="" value="{{$row->pin_code}}"  type="text" name="pin_code" class="form-control" placeholder="Pincode">
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Phone</label>
                                            <input type="text" onkeypress="return /[0-9]/i.test(event.key)" minlength="10" maxlength="10" value="{{$row->phone}}"  name="phone" class="form-control" placeholder="Phone">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">

                                   
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="disabledSelect">City</label>
                                            <select  required="" name="city" class="form-control">
                                                <option value="">Select</option>
                                                @foreach ($city as $key)
                                                <option {{$row->city==$key->city ? 'selected':''}}  value="{{ $key->city }}">{{ $key->city }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="disabledSelect">District</label>
                                            <select required="" name="district" class="form-control">
                                                <option value="">Select</option>
                                                @foreach ($district as $key)
                                                <option {{$row->district==$key->district ? 'selected':''}}  value="{{ $key->district }}">{{ $key->district }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="disabledSelect">State</label>
                                            <select required="" name="state" class="form-control">
                                                <option value="">Select</option>
                                                @foreach ($state as $key)
                                                <option {{$row->state==$key->state ? 'selected':''}}  value="{{ $key->state }}">{{ $key->state }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Country</label>
                                            <input required="" value="India" type="text" name="country" class="form-control" placeholder="Country">
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label for="disabledSelect">Status</label>
                                        <select  name="status" class="form-control">
                                            <option {{$row->status=='Enable' ? 'selected':''}}  value="Enable" >Enable</option>
                                             <option {{$row->status=='Disable' ? 'selected':''}}   value="Disable">Disable</option>
                                        </select>
                                    </div>
                                    </div>
                                   
                                  

                                  

                                    

                                    
                                </div>
                               <button type="submit" class="btn btn-primary mt-4 pl-4 pr-4">Submit</button>
                             
                            </form>
                        </div>
                    </div>
                </div>
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
</body>

</html>