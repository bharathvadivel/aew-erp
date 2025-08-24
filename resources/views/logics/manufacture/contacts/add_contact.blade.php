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
                            <h5 class="card_title " style="color:#50aaca"> Add Contact
                                <a href="{{ route('contact.master') }}" class="btn btn-primary btns" > <i class="fa fa-plus-circle"></i>Manage Contacts</a>
                            </h5>
                            <hr>
                            <form method="post" action="{{route('contact.store')}}">
                                @csrf
                                
                                <div class="form-group">
                                    <label class="form-check-label mr-3">Select Contact Type:</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="contact_type" id="forContactType1" value="Supplier">
                                        <label class="form-check-label" for="forContactType1">Supplier</label>
                                    </div> 

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="contact_type" id="forContactType2" value="Distributor">
                                        <label class="form-check-label" for="forContactType2">Distributor</label>
                                    </div>     
                                    
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="contact_type" id="forContactType3" value="Dealer">
                                        <label class="form-check-label" for="forContactType3">Dealer</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="contact_type" id="forContactType4" value="Sub Dealer">
                                        <label class="form-check-label" for="forContactType4">Sub Dealer</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="contactName">Contact Name</label>
                                    <input type="text" value="{{old('contacts')}}" id="contactName" name="contact_name" class="form-control" placeholder="Contact Name">
                                </div>

                                <div class="form-group">
                                    <label for="contactPhoneNo">Contact Phone No</label>
                                    <input type="text" value="{{old('contacts')}}" id="contactPhoneNo" name="contact_phone_no" class="form-control" placeholder="Contact Phone No">
                                </div>

                                <div class="form-group">
                                    <label for="contactEmail">Contact Email Id</label>
                                    <input type="text" value="{{old('contacts')}}" id="contactEmail" name="contact_email" class="form-control" placeholder="Contact Email ID">
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="forBillingAddress">Billing Address<span style="color:red">&#9733;</span></label>
                                            <textarea class="form-control" id="forBillingAddress" name="forBillingAddress" rows="6" required=""></textarea>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="forShippingAddress">Shipping Address</label>
                                            <textarea class="form-control" id="forShippingAddress" name="forShippingAddress" rows="6"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="contactGstin">GSTIN</label>
                                    <input type="text" value="{{old('contacts')}}" id="contactGstin" name="contact_gstin" class="form-control" placeholder="Contact GSTIN">
                                </div>

                                <div class="form-group">
                                    <label for="stateCode">State Code</label>
                                    <input type="text" value="{{old('contacts')}}" id="stateCode" name="state_code" class="form-control">
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
