<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>

    <!--=========================*
                Met Data
    *===========================-->
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

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

<body onload="paymentmode('{{old('payment_mode')}}')">

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
                <!-- Disabled forms start -->
                <div class="col-12 mt-4" style="margin-top:0!important;">
                    <div class="card">
                        <div class="card-body">
                            <center>
                                <h5 class="card_title " style="color:#50aaca"> Collection Amount
                                    <a href="{{ route('amount.collect.group.master') }}" class="btn btn-primary btns"> <i class="fa fa-plus-circle"></i>Manage Collection Amount</a>
                                </h5>
                            </center>
                            <hr>
                            <form method="post" action="{{route('store.collection.amount')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-row">
                                         <div class="col-md-6 mb-6">
                                             <div class="form-group">
                                                 <label for="disabledTextInput">Partner Store Name <span style="color:red">&#9733;</span></label>
                                                 <select onchange="getinvoice(this.value)" name="partner_id" required="" class="form-control  @error('partner_id') is-invalid @enderror">
                                                     <option value="">Select</option>
                                                     @foreach ($partner as $key)
                                                     <option {{$key->partner_id==old('partner_id') ? 'selected':''}} value="{{ $key->partner_id }}">{{ $key->store_name }}</option>
                                                     @endforeach
                                                 </select>
                                                 @error('partner_id')
                                                 <span class="text-danger">{{ $message }}</span>
                                                 @enderror

                                             </div>
                                         </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Invoice no <span style="color:red">&#9733;</span></label>
                                            <select required=""  name="invoice_no" class="form-control invoice_no selectsearch">
                                                <option value="">Select</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Payment Mode <span style="color:red">&#9733;</span></label>
                                            <select onchange="paymentmode(this.value)" id="payment-mode" required="" name="payment_mode" class="form-control  @error('payment_mode') is-invalid @enderror">
                                                <option value="">Select Payment Mode</option>
                                                <option {{'NEFT/RTGS'==old('payment_mode') ? 'selected':''}} value="NEFT/RTGS">NEFT/RTGS</option>
                                                <option {{'CHEQUE'==old('payment_mode') ? 'selected':''}} value="CHEQUE">CHEQUE</option>
                                                <option {{'CASH'==old('payment_mode') ? 'selected':''}} value="CASH">CASH</option>
                                                <option {{'CREDIT NOTE'==old('payment_mode') ? 'selected':''}} value="CREDIT NOTE">CREDIT NOTE</option>
                                            </select>
                                            @error('payment_mode')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                    </div>





                                </div>


                                <div class="form-row">

                                    <div class="col-md-4 mb-4">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Reference No. <span style="color:red">&#9733;</span></label>
                                            <input type="text" value="{{old('reference_no')}}" required="" name="reference_no" class="form-control @error('reference_no') is-invalid @enderror" placeholder="Reference No">
                                            @error('gategory_id')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-4">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Amount<span style="color:red">&#9733;</span></label>
                                            <input type="text" required="" value="{{old('amount')}}" name="amount" class="form-control @error('amount') is-invalid @enderror" placeholder="amount">
                                            @error('amount')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-md-4 mb-4">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Payment Status <span style="color:red">&#9733;</span></label>
                                            <input type="text" readonly value="Pending" required="" name="payment_status" class="form-control @error('payment_status') is-invalid @enderror">
                                            @error('payment_status')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div style="display:none;" id="file-proof" class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Proof</label>
                                            <input type="file" name="proof" class="form-control @error('proof') is-invalid @enderror">
                                            @error('proof')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>


                                <div class="form-row">
                                    <div class="col-md-12 mb-12">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Remarks</label>
                                            <textarea name="remarks" class="form-control">{{old('remarks')}}</textarea>
                                        </div>
                                    </div>

                                </div>


                                <center><button id="yarabtnsubmit" type="button" class="btn btn-primary mt-4 pl-4 pr-4">Submit</button>
                                </center>
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
    <script>
        function getinvoice(partner_id) {


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            event.preventDefault();

            $.ajax({
                type: 'POST'
                , url: "{{ route('partner.invoice.no')}}"
                , data: {
                    partner_id: partner_id

                }
                , success: function(data) {
                    var val = JSON.parse(data);
                    $('.invoice_no').html(val.output);
                }

            });


        }

    </script>

    <script>
        function paymentmode(val) {
            val == 'CHEQUE' ? $('#file-proof').css("display", "block") : $('#file-proof').css("display", "none");
        }

    </script>


</body>

</html>
