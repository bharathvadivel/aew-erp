<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
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
                                <h5 class="card_title " style="color:#50aaca"> Regional Head Edit
                                    <a href="{{ route('regional.master') }}" class="btn btn-primary btns"> <i class="fa fa-plus-circle"></i>Manage ASM</a>
                                </h5>
                            </center>
                            <hr>
                            <form method="post" action="{{route('regional.update',$row->id)}}">
                                @csrf
                                <div class="form-row">
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Regional Head-ID <span style="color:red">&#9733;</span></label>
                                            <input readonly value="{{$row->regional_id}}" type="text" name="regional_id" class="form-control @error('regional_id') is-invalid @enderror" placeholder="Regional Head ID">
                                            @error('regional_id')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Name (Regional head) <span style="color:red">&#9733;</span></label>
                                            <input required="" value="{{$row->name}}" type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Name">
                                            @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Email (Regional head) <span style="color:red">&#9733;</span></label>
                                            <input required="" type="email" value="{{$row->email}}" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email">
                                            @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">DOB (Regional head) <span style="color:red">&#9733;</span></label>
                                            <input type="date" value="{{ $row->dob }}" required="" name="dob" class="form-control @error('dob') is-invalid @enderror" placeholder="Dob">
                                            @error('dob')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Address (Regional head) <span style="color:red">&#9733;</span></label>
                                            <input required="" value="{{$row->address}}" type="text" name="address" class="form-control @error('address') is-invalid @enderror" placeholder="Address">
                                            @error('address')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Pincode (Regional head) <span style="color:red">&#9733;</span></label>
                                            <input required="" oninput="new_location(this.value)" onkeypress="return isNumberKey(event)" minlength="6" maxlength="6" value="{{$row->pin_code}}" type="text" name="pin_code" class="form-control @error('pin_code') is-invalid @enderror" placeholder="Pincode">
                                            @error('pin_code')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Phone (Regional head) <span style="color:red">&#9733;</span></label>
                                            <input type="text" onkeypress="return isNumberKey(event)" minlength="10" maxlength="10" required="" value="{{$row->phone}}" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Phone">
                                            @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">


                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="disabledSelect">City (Regional head) <span style="color:red">&#9733;</span></label>
                                            <input type="text" value="{{$row->city}}" readonly required="" placeholder="City" name="city" class="form-control new_city  @error('city') is-invalid @enderror">
                                            @error('city')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="disabledSelect">District (Regional head) <span style="color:red">&#9733;</span></label>
                                            <input type="text" value="{{$row->district}}" readonly required="" name="district" class="form-control new_district @error('district') is-invalid @enderror" placeholder="District">
                                            @error('district')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="disabledSelect">State (Regional head) <span style="color:red">&#9733;</span></label>
                                            <input type="text" value="{{$row->state}}" readonly required="" name="state" class="form-control new_state @error('state') is-invalid @enderror" placeholder="State">
                                            @error('state')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">

                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Country (Regional head) <span style="color:red">&#9733;</span></label>
                                            <input required="" value="{{$row->country}}" readonly type="text" name="country" class="form-control new_country @error('country') is-invalid @enderror" placeholder="Country">
                                            @error('country')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="disabledSelect">Status</label>
                                            <select name="status" class="form-control @error('status') is-invalid @enderror">
                                                <option {{$row->status=='Enable' ? 'selected':''}} value="Enable">Enable</option>
                                                <option {{$row->status=='Disable' ? 'selected':''}} value="Disable">Disable</option>
                                            </select>
                                            @error('status')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>




                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="disabledSelect">ASM</label>
                                            <button class="form-control" type="button" data-toggle="modal" data-target="#exampleModal">Choose Direct Partners</button>
                                            @error('asm_id')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    @php
                                    $dis=$asmlist;

                                    @endphp


                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Select ASM</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>


                                                <div class="modal-body">
                                                    @foreach ($asm as $key)
                                                    <div class="form-group">

                                                        @php
                                                        $did=$key->asm_id
                                                        @endphp

                                                        <input id="discheck" {{in_array($did,$dis) ? 'checked':''}} name="asm_id[]" type="checkbox" value="{{$key->asm_id}}">

                                                        <label for="recipient-name" class="col-form-label">{{ $key->name }}({{ $key->asm_id }})</label>


                                                    </div>
                                                    @endforeach





                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" data-dismiss="modal" class="btn btn-primary">OK</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>



                                </div>
                                <button id="yarabtnsubmit" type="submit" class="btn btn-primary mt-4 pl-4 pr-4">Submit</button>
                                <div class="form-row">
                                    <span style="color:red">&#9733;</span>
                                    <p>- Mandatory field</p>
                                </div>
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
