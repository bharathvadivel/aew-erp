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
            @include('login.flash')
            <div class="row">
                <!-- Disabled forms start -->
                <div class="col-12 mt-4" style="margin-top:0!important;">
                    <div class="card">
                        <div class="card-body">
                            <center>
                                <h5 class="card_title " style="color:#50aaca"> Add Service Center Executive
                                    <a href="{{ route('executive.master') }}" class="btn btn-primary btns"> <i class="fa fa-plus-circle"></i>Manage Service Executive</a>
                                </h5>
                            </center>
                            <hr>
                            <form method="post" enctype="multipart/form-data" action="{{route('executive.store')}}">
                                @csrf
                                <div class="form-row">
                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledSelect">Service Center <span style="color:red">&#9733;</span></label>
                                            <select required="" name="service_id" class="form-control @error('service_id') is-invalid @enderror">
                                                <option value="">Select</option>
                                                @foreach ($service as $key)
                                                <option {{ $key->service_id==session()->get('partner_id') ? 'selected':($key->service_id==old('service_id') ? 'selected':'') }} value="{{ $key->service_id }}">{{ $key->service_center_name }}</option>


                                                @endforeach
                                            </select>
                                            @error('service_id')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Service center executive-ID <span style="color:red">&#9733;</span></label>
                                            <input required="" value="{{$executive_id}}" readonly type="text" name="executive_id" class="form-control @error('executive_id') is-invalid @enderror" placeholder="Executive ID">
                                            @error('executive_id')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Name (Service Executive) <span style="color:red">&#9733;</span></label>
                                            <input required="" type="text" value="{{old('name')}}" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Name">
                                            @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Email (Service Executive) <span style="color:red">&#9733;</span></label>
                                            <input type="email" required="" value="{{old('email')}}" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email">
                                            @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                <div class="form-row">
                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">DOB (Service Executive) <span style="color:red">&#9733;</span></label>
                                            <input type="date" required="" value="{{old('dob')}}" name="dob" class="form-control @error('dob') is-invalid @enderror" placeholder="DOB">
                                            @error('dob')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Id-proof(Driving License/Aadhaar Card) <span style="color:red">&#9733;</span></label>
                                            <input required="" type="file" name="proof" class="form-control @error('proof') is-invalid @enderror" placeholder="ID-Proof">
                                            @error('proof')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Address (Service Executive) <span style="color:red">&#9733;</span></label>
                                            <input required="" type="text" value="{{old('address')}}" name="address" class="form-control @error('address') is-invalid @enderror" placeholder="Address">
                                            @error('address')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Pincode (Service Executive) <span style="color:red">&#9733;</span></label>
                                            <input required="" value="{{old('pin_code')}}" oninput="new_location(this.value)" onkeypress="return /[0-9]/i.test(event.key)" minlength="6" maxlength="6" type="text" name="pin_code" class="form-control @error('pin_code') is-invalid @enderror" placeholder="Pincode">
                                            @error('pin_code')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Phone (Service Executive) <span style="color:red">&#9733;</span></label>
                                            <input required="" type="text" value="{{old('phone')}}" onkeypress="return /[0-9]/i.test(event.key)" minlength="10" maxlength="10" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Phone">
                                            @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-2 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Password <span style="color:red">&#9733;</span></label>
                                            <input type="text" value="{{old('password')}}" minlength="8" id="token_refresh" required="" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                                            @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                    </div>


                                    <div class="col-md-1 mb-1">
                                        <div class="form-group">
                                            <label for="disabledTextInput"></label>
                                            <button type="button" onclick="gfg_Run()" class="token_ref"><i class="fa fa-refresh"></i></button>
                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledSelect">City (Service Executive) <span style="color:red">&#9733;</span></label>
                                            <input type="text" readonly value="{{old('city')}}" required="" placeholder="City" name="city" class="form-control new_city @error('city') is-invalid @enderror">
                                            @error('city')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="disabledSelect">District (Service Executive) <span style="color:red">&#9733;</span></label>
                                            <input type="text" readonly value="{{old('district')}}" required="" name="district" class="form-control new_district @error('district') is-invalid @enderror" placeholder="District">
                                            @error('district')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="disabledSelect">State (Service Executive) <span style="color:red">&#9733;</span></label>
                                            <input type="text" readonly value="{{old('state')}}" required="" name="state" class="form-control new_state @error('state') is-invalid @enderror" placeholder="State">
                                            @error('state')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Country (Service Executive) <span style="color:red">&#9733;</span></label>
                                            <input required="" readonly value="{{old('country')}}" type="text" name="country" class="form-control new_country @error('country') is-invalid @enderror" placeholder="Country">
                                            @error('country')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <center><button id="yarabtnsubmit" type="submit" class="btn btn-primary mt-4 pl-4 pr-4">Submit</button>
                                </center>

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

    <script>
        function sc(sid) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            event.preventDefault();

            $.ajax({
                type: 'POST'
                , url: "{{ route('executive.id')}}"
                , data: {
                    sid: sid
                }
                , success: function(data) {
                    $('#exeid').val(data);
                }
            });


        }

    </script>

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
