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
                                <h5 class="card_title " style="color:#50aaca"> Edit Employee
                                    <a href="{{ route('employee.master') }}" class="btn btn-primary btns"> <i class="fa fa-plus-circle"></i>Manage Employee</a>
                                </h5>
                            </center>
                            <hr>
                            <form method="post" enctype="multipart/form-data" action="{{route('employee.update',$row->id)}}">
                                @csrf
                                <div class="form-row">

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Employee ID <span style="color:red">&#9733;</span></label>
                                            <input readonly value="{{$row->emp_id}}" type="text" name="emp_id" class="form-control @error('emp_id') is-invalid @enderror" placeholder="Employee ID">
                                            @error('emp_id')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Name (Employee) <span style="color:red">&#9733;</span></label>
                                            <input required="" value="{{$row->name}}" type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Name">
                                            @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Father/Guardian/Spouse Name</label>
                                            <input value="{{$row->a_name}}" type="text" name="a_name" class="form-control @error('a_name') is-invalid @enderror" placeholder="Father/Guardian/Spouse Name">
                                            @error('a_name')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Father/Guardian/Spouse Mobile No.</label>
                                            <input value="{{$row->a_phone}}" type="text" name="a_phone" onkeypress="return isNumberKey(event)" minlength="10" maxlength="10" class="form-control @error('a_phone') is-invalid @enderror" placeholder="Father/Guardian/Spouse Mobile No">
                                            @error('a_phone')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>


                                </div>
                                <div class="form-row">


                                    <div class="col-md-12 mb-12">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Address (Employee) <span style="color:red">&#9733;</span></label>
                                            <textarea required="" type="text" name="address" class="form-control @error('address') is-invalid @enderror" placeholder="Address">{{$row->address}}</textarea>
                                            @error('address')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">DOB (Employee) <span style="color:red">&#9733;</span></label>
                                            <input required="" value="{{$row->dob}}" type="date" name="dob" class="form-control @error('dob') is-invalid @enderror" placeholder="Date of birth">
                                            @error('dob')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Personal Mobile No. (Employee) <span style="color:red">&#9733;</span></label>
                                            <input required="" value="{{$row->phone}}" onkeypress="return isNumberKey(event)" minlength="10" maxlength="10" type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Personal Mobile No">
                                            @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">E-mail ID (Employee)</label>
                                            <input type="email" value="{{$row->email}}" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email">
                                            @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Emergency Conatct No. (Employee) </label>
                                            <input value="{{$row->e_phone}}" onkeypress="return isNumberKey(event)" minlength="10" maxlength="10" type="text" name="e_phone" class="form-control  @error('e_phone') is-invalid @enderror" placeholder="Emergency Conatct No">
                                            @error('e_phone')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>




                                </div>
                                <div class="form-row">

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Bank Name (Employee) <span style="color:red">&#9733;</span> </label>
                                            <input required="" value="{{$row->bank}}" type="text" name="bank" class="form-control @error('bank') is-invalid @enderror" placeholder="Bank Name">
                                            @error('bank')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Bank Account No (Employee) <span style="color:red">&#9733;</span> </label>
                                            <input required="" value="{{$row->account_no}}" type="text" name="account_no" class="form-control @error('account_no') is-invalid @enderror" placeholder="Bank Account No.">
                                            @error('account_no')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">IFSC Code (Employee) <span style="color:red">&#9733;</span> </label>
                                            <input required="" type="text" value="{{$row->ifsc_code}}" name="ifsc_code" class="form-control @error('ifsc_code') is-invalid @enderror" placeholder="IFSC Code">
                                            @error('ifsc_code')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Branch Name (Employee) <span style="color:red">&#9733;</span> </label>
                                            <input required="" value="{{$row->branch}}" type="text" name="branch" class="form-control @error('branch') is-invalid @enderror" placeholder="Branch Name ">
                                            @error('branch')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                    </div>




                                </div>

                                <div class="form-row">

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Passport No. (Employee) </label>
                                            <input type="text" value="{{$row->passport_no}}" name="passport_no" class="form-control @error('passport_no') is-invalid @enderror" placeholder="Passport No">
                                            @error('passport_no')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Date of joining (Employee) <span style="color:red">&#9733;</span></label>
                                            <input required="" value="{{$row->doj}}" type="date" name="doj" class="form-control @error('doj') is-invalid @enderror" placeholder="Date of joining ">
                                            @error('doj')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Blood Group (Employee) <span style="color:red">&#9733;</span></label>
                                            <input required="" value="{{$row->blood_group}}" type="text" name="blood_group" class="form-control @error('blood_group') is-invalid @enderror" placeholder="Blood Group">
                                            @error('blood_group')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Aadhar No. (Employee) <span style="color:red">&#9733;</span></label>
                                            <input required="" value="{{$row->aadhar_no}}" type="text" name="aadhar_no" class="form-control @error('aadhar_no') is-invalid @enderror" placeholder="Aadhar No">
                                            @error('aadhar_no')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>




                                </div>
                                <div class="form-row">

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label style="white-space:nowrap" for="disabledTextInput">Passport Size Photo (Employee)</label>
                                            <input accept="image/*" type="file" name="photo" class="form-control @error('photo') is-invalid @enderror">
                                            @error('photo')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label style="white-space:nowrap" for="disabledTextInput">Aadhar Proof (Employee) </label>
                                            <input accept="image/*" type="file" name="aadhar" class="form-control @error('aadhar') is-invalid @enderror">

                                            @error('aadhar')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label style="white-space:nowrap" for="disabledTextInput">Driving License (Employee) </label>
                                            <input accept="image/*" type="file" name="license" class="form-control @error('license') is-invalid @enderror">
                                            @error('license')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label style="white-space:nowrap" for="disabledTextInput">Certificate Of Education (Employee)</label>
                                            <input accept="image/*" type="file" name="education" class="form-control @error('education') is-invalid @enderror">
                                            @error('education')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label style="white-space:nowrap" for="disabledTextInput">Employee Type <span style="color:red">&#9733;</span></label>
                                            <input required="" value="{{$row->employee_type}}" list="type" type="text" name="employee_type" placeholder="Employee Type" class="form-control @error('employee_type') is-invalid @enderror">
                                            @error('employee_type')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <datalist id="type">
                                        <option value="Accounts">
                                        <option value="Demonstrator">
                                        <option value="Driver">
                                        <option value="GM">
                                        <option value="HR">
                                        <option value="Others">
                                        <option value="Sales Man">
                                        <option value="TL">
                                    </datalist>

                                    <div class="col-md-3 mb-3">

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
