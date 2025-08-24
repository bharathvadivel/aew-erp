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
            .extra
            {
                font-size: 20px;
                background-color: #ffffff;
                padding-top: 10px;
                padding-bottom: 10px;
                border-radius: 5px;
            }

            .mt-4 {
                margin-top: 0 rem!important;
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
            <!-- 
            <div class="row">
                <div class="col-12 mt-4">
                    <center><h4 class="card_title extra" > Create Project </h4></center>
                </div>
            </div>
            -->
            @include('login.flash')
            <div class="row">
                <!-- Disabled forms start -->
                <div class="col-12 mt-4" style="margin-top:0!important;">
                    <div class="card">
                        <div class="card-body">
                            <form method="post" action="{{route('employee.store')}}">
                                @csrf

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div class="card" style="box-shadow:none;border:1px solid rgba(0, 0, 0, 0.125);">
                                            <h5 class="card-header">Employee Details</h5>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="empNo">Employee No</label>
                                                    <input type="text" id="empNo" name="empNo" class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label for="empName">Employee Name</label>
                                                    <input type="text" id="empName" name="empName" class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label for="department">Department</label>
                                                    <select id="department" required="" name="department" class="form-control department selectsearch">
                                                        <option value="">Select Department</option>
                                                        <option value="Design">Design</option>
                                                        <option value="Development">Development</option>
                                                        <option value="Quality">Quality</option>
                                                        <option value="Winding">Winding</option>
                                                        <option value="Purchase">Purchase</option>
                                                        <option value="Store">Store</option>
                                                        <option value="Assembly">Assembly</option>
                                                        <option value="Testing">Testing</option>
                                                        <option value="Painting">Painting</option>
                                                        <option value="Dispatch">Dispatch</option>
                                                        <option value="Accounts">Accounts</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="designation">Designation</label>
                                                    <input type="text" id="designation" name="designation" class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label for="doj">Date of Joining</label>
                                                    <input type="date" id="doj" name="doj" class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label for="qualification">Qualification</label>
                                                    <input type="text" id="qualification" name="qualification" class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label for="workingPeriod">Working Period</label>
                                                    <input type="text" id="workingPeriod" name="workingPeriod" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <div class="card" style="box-shadow:none;border:1px solid rgba(0, 0, 0, 0.125);">
                                            <h5 class="card-header">Personal Details</h5>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="address">Address</label>
                                                    <textarea type="text" id="address" name="address" class="form-control"></textarea>
                                                </div>

                                                <div class="form-group">
                                                    <label for="email">Email ID</label>
                                                    <input type="email" id="email" name="email" class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label for="contactNo">Contact No</label>
                                                    <input type="number" id="contactNo" name="contactNo" class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label for="emcontactNo">Emergency Contact No</label>
                                                    <input type="number" id="emcontactNo" name="emcontactNo" class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label for="dob">Date of Birth</label>
                                                    <input type="date" id="dob" name="dob" class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label for="bloodGroup">Blood Group</label>
                                                    <input type="text" id="bloodGroup" name="bloodGroup" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div class="card" style="box-shadow:none;border:1px solid rgba(0, 0, 0, 0.125);">
                                            <h5 class="card-header">Legal Informations</h5>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="aadhaar">Aadhaar Number</label>
                                                    <input type="text" id="aadhaar" name="aadhaar" class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label for="pan">PAN Number</label>
                                                    <input type="text" id="pan" name="pan" class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label for="esi">ESI Number</label>
                                                    <input type="text" id="esi" name="esi" class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label for="pfUan">PF UAN Number</label>
                                                    <input type="text" id="pfUan" name="pfUan" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
 
                                    <div class="col-md-6 mb-4">
                                        <div class="card" style="box-shadow:none;border:1px solid rgba(0, 0, 0, 0.125);">
                                            <h5 class="card-header">Bank Details</h5>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="bankName">Bank Name</label>
                                                    <input type="text" id="bankName" name="bankName" class="form-control"/>
                                                </div>

                                                <div class="form-group">
                                                    <label for="bankBranch">Branch</label>
                                                    <input type="text" id="bankBranch" name="bankBranch" class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label for="accNo">Bank Account Number</label>
                                                    <input type="number" id="accNo" name="accNo" class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label for="ifsc">IFSC Code </label>
                                                    <input type="text" id="ifsc" name="ifsc" class="form-control">
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

                <!-- Disabled forms end -->
                <!-- Server side start -->

                <!-- Server side end -->
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
