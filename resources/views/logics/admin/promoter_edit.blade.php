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
                                <h5 class="card_title " style="color:#50aaca"> Edit Brand Promoter
                                    <a href="{{ route('promoter.master') }}" class="btn btn-primary btns"> <i class="fa fa-plus-circle"></i>Manage Brand Promoter</a>
                                </h5>
                            </center>
                            <hr>
                            <form method="post" enctype="multipart/form-data" action="{{route('promoter.update',$row->id)}}">
                                @csrf
                                <div class="form-row">
                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Promoter-ID <span style="color:red">&#9733;</span></label>
                                            <input readonly value="{{$row->promoter_id}}" type="text" name="promoter_id" class="form-control @error('promoter_id') is-invalid @enderror" placeholder="Promoter ID">
                                            @error('promoter_id')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Name (Promoter) <span style="color:red">&#9733;</span></label>
                                            <input required="" value="{{$row->name}}" type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Name">
                                            @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Email (Promoter) <span style="color:red">&#9733;</span></label>
                                            <input type="email" required="" value="{{$row->email}}" name="email" class="form-control @error('email') is-invalid @enderror"" placeholder=" Email">
                                            @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label style="white-space:nowrap" for="disabledTextInput">Id-proof(Driving License/Aadhaar Card) <span style="color:red">&#9733;</span></label>
                                            <input type="file" name="proof" class="form-control">

                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label style="white-space:nowrap" for="disabledTextInput">DOB (Promoter)<span style="color:red">&#9733;</span></label>
                                            <input required="" value="{{ $row->dob }}" type="date" name="dob" class="form-control @error('dob') is-invalid @enderror" placeholder="Dob">
                                            @error('dob')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledSelect">Dealer <span style="color:red">&#9733;</span></label>
                                            <select required="" name="dealor_id" class="form-control @error('dealor_id') is-invalid @enderror">
                                                <option value="">Select</option>
                                                @foreach ($dealor as $key)
                                                <option {{$row->dealor_id==$key->partner_id ? 'selected':''}} value="{{ $key->partner_id }}">{{ $key->store_name }} ({{ $key->partner_id }})</option>

                                                @endforeach
                                            </select>
                                            @error('dealor_id')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Address (Promoter) <span style="color:red">&#9733;</span></label>
                                            <input required="" value="{{$row->address}}" type="text" name="address" class="form-control @error('address') is-invalid @enderror" placeholder="Address">
                                            @error('address')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Pincode (Promoter)<span style="color:red">&#9733;</span></label>
                                            <input required="" oninput="new_location(this.value)" value="{{$row->pin_code}}" type="text" onkeypress="return /[0-9]/i.test(event.key)" minlength="6" maxlength="6" name="pin_code" class="form-control @error('pin_code') is-invalid @enderror" placeholder="Pincode">
                                            @error('pin_code')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">

                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Phone (Promoter)<span style="color:red">&#9733;</span></label>
                                            <input required="" type="text" onkeypress="return /[0-9]/i.test(event.key)" minlength="10" maxlength="10" value="{{$row->phone}}" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Phone">
                                            @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="disabledSelect">City (Promoter) <span style="color:red">&#9733;</span></label>
                                            <input type="text" value="{{$row->city}}" readonly required="" placeholder="City" name="city" class="form-control new_city  @error('city') is-invalid @enderror">
                                            @error('city')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="disabledSelect">District (Promoter) <span style="color:red">&#9733;</span></label>
                                            <input type="text" value="{{$row->district}}" readonly required="" name="district" class="form-control new_district @error('district') is-invalid @enderror" placeholder="District">
                                            @error('district')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">

                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="disabledSelect">State (Promoter) <span style="color:red">&#9733;</span></label>
                                            <input type="text" value="{{$row->state}}" readonly required="" name="state" class="form-control new_state @error('state') is-invalid @enderror" placeholder="State">
                                            @error('state')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Country (Promoter) <span style="color:red">&#9733;</span></label>
                                            <input required="" value="{{$row->country}}" readonly type="text" name="country" class="form-control new_country  @error('country') is-invalid @enderror" placeholder="Country">
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
