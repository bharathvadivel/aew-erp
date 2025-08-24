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
    <link href="{{asset('user/new_npm_css/bootstrap.min.css')}}" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="{{asset('user/new_npm_js/popper.min.js')}}" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="{{asset('user/new_npm_js/bootstrap.min.js')}}" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="{{asset('user/new_npm_js/bootstrap.bundle.min.js')}}" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


    {{-- <link href="{{asset('user/new_npm_css/bootstrap.min.css')}}" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="{{asset('user/new_npm_js/popper.min.js')}}" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="{{asset('user/new_npm_js/bootstrap.min.js')}}" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="{{asset('user/new_npm_js/bootstrap.bundle.min.js')}}" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> --}}



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
            @include('login.flashsearch')
            <div class="row">
                <!-- Disabled forms start -->
                <div class="col-12 mt-4" style="margin-top:0!important;">
                    <div class="card">
                        <div class="card-body">
                            <center>
                                <h5 class="card_title " style="color:#50aaca"> Add Service Enquiry
                                    @if (session()->get('partner_type')=='service_admin' || session()->get('partner_type')=='admin')

                                    <a href="{{ route('enquiry.master') }}" class="btn btn-primary btns"> <i class="fa fa-plus-circle"></i>Manage Service Enquiry</a>

                                    @else
                                    <a href="{{ route('enquiry.manage') }}" class="btn btn-primary btns"> <i class="fa fa-plus-circle"></i>Manage Service Enquiry</a>

                                    @endif
                                </h5>
                            </center>
                            <img src="{{asset('user/images/note.png')}}">

                            <hr>
                            <form method="post" action="{{route('enquiry.store')}}">
                                @csrf
                                <div class="form-row">
                                    <input type="hidden" value="desktop" name="platform">
                                    <div class="col-md-2 mb-2">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Installation</label>
                                            <input style="height:35px; width:35px; vertical-align: middle;" {{ old('service_type')=='Installation' ? 'checked':'' }} value="Installation" type="radio" name="service_type" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-2 mb-2">
                                        <div class="form-group">
                                            <label for="disabledTextInput" style="white-space:nowrap">Technical Assistance</label>
                                            <input style="height:35px; width:35px; vertical-align: middle;" {{ old('service_type')=='Technical Assistance' ? 'checked':'' }} value="Technical Assistance" type="radio" name="service_type" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-2 mb-2">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Repair</label>
                                            <input style="height:35px; width:35px; vertical-align: middle;" {{ old('service_type')=='Repair' ? 'checked':'' }} value="Repair" type="radio" name="service_type" class="form-control">
                                        </div>
                                    </div>



                                    <!-- <div class="col-md-2 mb-4">
                                        <div class="form-group">
                                            <label for="disabledSelect">Brand Name <span style="color:red">&#9733;</span></label>
                                            <select required="" name="brand_id" class="form-control">
                                                @foreach ($brand as $key)
                                                <option {{old('brand_id')==$key->id ? 'selected':'' }} value="{{ $key->id }}">{{ $key->brand_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div> -->

                                    <div class="col-md-2 mb-4">
                                        <div class="form-group">
                                            <label for="disabledSelect">Brand Name <span style="color:red">&#9733;</span></label>
                                            <select required="" name="brand_id" id="brandSelect" class="form-control">
                                                @foreach ($brand as $key)
                                                    @if ($key->brand_type === 'PRODUCTS')
                                                        <option {{old('brand_id')==$key->id ? 'selected':'' }} value="{{ $key->id }}">{{ $key->brand_name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!-- <div class="col-md-4 mb-4">
                                        <div class="form-group">
                                            <label for="disabledSelect">Product Category<span style="color:red">&#9733;</span></label>
                                            <select onchange="cat(this.value)" required="" name="gategory_id" class="form-control">
                                                <option value="">Select</option>
                                                @foreach ($gategory as $key)
                                                <option {{old('gategory_id')==$key->id ? 'selected':'' }} value="{{ $key->id }}">{{ $key->gategory_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div> -->

                                    <div class="col-md-4 mb-4">
                                        <div class="form-group">
                                            <label for="disabledSelect">Product Category<span style="color:red">&#9733;</span></label>
                                            <select onchange="cat(this.value)" required="" name="gategory_id" id="categorySelect" class="form-control">
                                                <option value="">Select</option>
                                            </select>
                                        </div>
                                    </div>


                                </div>

                                <div class="form-row">

                                    <div class="col-md-4 mb-4">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Model No. <span style="color:red">&#9733;</span></label>
                                            <select onchange="cod(this.value),serial_details()" id="model_no" required="" name="model_no" class="form-control model_no selectsearch">

                                                @if(old('model_no')!='')
                                                <option selected value="{{old('model_no')}}">{{old('model_no')}}</option>
                                                @else
                                                <option value="">Select</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-4">
                                        <div class="form-group">
                                            <label for="disabledSelect">Product Description <span style="color:red">&#9733;</span></label>
                                            <select required="" id="description" name="description" class="form-control description">
                                                @if(old('description')!='')
                                                <option selected value="{{old('description')}}">{{old('description')}}</option>
                                                @else
                                                <option value="">Select</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>





                                    <div class="col-md-4 mb-4">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Serial No.</label>
                                            <input value="{{ old('serial_no') }}" type="text" id="serial_no" onfocusout="serial_details()" name="serial_no" class="form-control" placeholder="Serial No.">


                                        </div>
                                    </div>


                                </div>
                                <div class="form-row">
                                    <div class="col-md-4 mb-4">
                                        <div class="form-group">
                                            <label for="disabledSelect">Warranty Type</label>
                                            <select name="warranty_type" class="form-control warranty_type">
                                                @if(old('warranty_type')!='')
                                                <option selected value="{{old('warranty_type')}}">{{old('warranty_type')}}</option>
                                                @else
                                                <option value="">Select Warranty Type</option>

                                                @endif

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-8 mb-8">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Customer Remarks <span style="color:red">&#9733;</span> </label>
                                            <textarea required="" name="customer_remarks" class="form-control" placeholder="Customer Remarks">{{old('customer_remarks')}}</textarea>

                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">

                                    <div class="col-md-4 mb-4">
                                        <div class="form-group">
                                            <label for="disabledSelect">Dealer Name</label>
                                            <select onchange="dis(this.value)" id="partner_name" name="partner_id" class="form-control dealer_name selectsearch">
                                                <option value="">Select</option>

                                                @foreach ($partner as $key)
                                                <option {{old('partner_id')==$key->partner_id ? 'selected':'' }} value="{{ $key->partner_id }}" data-id="{{ $key->name }}">{{ $key->store_name }}({{$key->partner_id}})</option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                    <input type="hidden" value="{{old('partner_name')}}" id="txt" name="partner_name">
                                    <input type="hidden" value="{{old('invoice_no')}}" class="invoice_no" name="invoice_no">



                                    <div class="col-md-4 mb-4">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Dealer Phone No </label>
                                            <input value="{{old('partner_phone')}}" type="text" name="partner_phone" class="form-control phone dealer_phone" placeholder="Phone">
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-4">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Date Of Purchase <span style="color:red">&#9733;</span></label>
                                            <input type="date" value="{{old('date_of_purchase')}}" required="" name="date_of_purchase" class="form-control purchase_date" placeholder="Date of purchase">
                                        </div>
                                    </div>

                                </div>

                                <div class="form-row">
                                    <div class="col-md-4 mb-4">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Customer Name <span style="color:red">&#9733;</span></label>
                                            <input required="" value="{{old('customer_name')}}" type="text" name="customer_name" class="form-control customer_name" placeholder="Customer Name">
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-4">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Customer Phone No. <span style="color:red">&#9733;</span></label>
                                            <input type="text" value="{{old('customer_phone')}}" onkeypress="return isNumberKey(event)" minlength="10" maxlength="10" required="" name="customer_phone" class="form-control customer_phone" placeholder="Customer Phone No">


                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-4">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Alternative Phone No.</label>
                                            <input type="text" value="{{old('alter_phone')}}" onkeypress="return isNumberKey(event)" minlength="10" maxlength="10" name="alter_phone" class="form-control" placeholder="Alternative Phone No">
                                        </div>
                                    </div>

                                </div>


                                <div class="form-row">


                                    <div class="col-md-12 mb-12">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Customer Address <span style="color:red">&#9733;</span></label>
                                            <input id="map-search" value="{{old('customer_address')}}" required="" type="text" name="customer_address" class="form-control address" placeholder="Address">
                                        </div>
                                    </div>


                                </div>

                                <div class="form-row">

                                    <div style="width:100%;height:400px;" id="map-canvas"></div>

                                </div>
                                <div class="form-row">

                                    <input name="lat" type="hidden" id="c_lat" class="latitude vl">
                                    <input name="lang" type="hidden" id="c_lang" class="longitude vl">

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Customer Pincode <span style="color:red">&#9733;</span></label>
                                            <input required="" value="{{old('customer_pincode')}}" oninput="new_location(this.value)" minlength="6" maxlength="6" onkeypress="return isNumberKey(event)" type="text" name="customer_pincode" class="form-control pincode" placeholder="Pincode">
                                        </div>
                                    </div>
                                    <input type="hidden" class="reg-input-city">
                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledSelect">Customer Area <span style="color:red">&#9733;</span></label>
                                            <select required="" name="customer_area" class="form-control area new_area">
                                                @if(old('customer_area')!='')
                                                <option selected value="{{old('customer_area')}}">{{old('customer_area')}}</option>
                                                @else
                                                <option value="">Select Area</option>
                                                @endif

                                            </select>

                                        </div>
                                    </div>


                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledSelect">Customer City <span style="color:red">&#9733;</span></label>
                                            <input readonly value="{{old('customer_city')}}" required="" type="text" name="customer_city" class="form-control city new_city" placeholder="Customer City">




                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledSelect">Customer District <span style="color:red">&#9733;</span></label>
                                            <input readonly value="{{old('customer_district')}}" required="" name="customer_district" class="form-control district new_district" placeholder="Customer District">





                                        </div>
                                    </div>



                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledSelect">Customer State <span style="color:red">&#9733;</span></label>
                                            <input readonly value="{{old('customer_state')}}" required="" name="customer_state" class="form-control state new_state" placeholder="Customer State">





                                        </div>
                                    </div>


                                </div>

                                <center><button id="mapyarabtnsubmit" type="submit" class="btn btn-primary mt-4 pl-4 pr-4">
                                        submit

                                    </button>
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
    <div class="warranty">

    </div>
    <!--=================================*
                  Footer Section
    *===================================-->
    <footer>
        @include('logics.include.footer_select')

    </footer>
    <!--=================================*
                End Footer Section
    *===================================-->


    <script>
        function serial_details() {
            var model_no = document.getElementById('model_no').value;
            var serial_no = document.getElementById('serial_no').value;

            if (description == '') {
                alert('Please choose product details');
                return false;
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            event.preventDefault();

            $.ajax({
                type: 'POST'
                , url: "{{ route('serial.details')}}"
                , data: {
                    serial_no: serial_no
                    , model_no: model_no
                }
                , success: function(data) {
                    var val = JSON.parse(data);
                    if (val.popup_type == 'yes') {
                        $('#txt').val(val.txt);
                        $('.dealer_name').html(val.dealer_name);
                        $('.dealer_phone').val(val.dealer_phone);
                        $('.purchase_date').val(val.purchase_date);
                        $('.invoice_no').val(val.invoice_no);
                        $('.customer_name').val(val.customer_details.customer_name);
                        $('.customer_phone').val(val.customer_details.customer_phone);
                        $('.pincode').val(val.customer_details.pincode);
                        $('.city').val(val.customer_details.city);
                        $('.area').html(val.customer_area);
                        $('.state').val(val.customer_details.state);
                        $('.district').val(val.customer_details.district);
                        $('.address').val(val.customer_details.address);
                    }
                    $('.warranty').html(val.warranty);
                    $('.warranty_type').html(val.warranty_type);
                    $('.purchase_date').val(val.purchase_date);
                    $('#warrantshow').click();


                }
            });


        }

    </script>


    <script>
        $(function() {
            $("#partner_name").on("change", function() {
                var option_attribute = $('option:selected', this).attr('data-id');
                $("#txt").val(option_attribute);
            });
        });

    </script>

    <script>
        function cat(gategory_id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            event.preventDefault();

            $.ajax({
                type: 'POST',
                url: "{{ route('eq.model.select')}}",
                data: {
                    gategory_id: gategory_id
                },
                success: function(data) {
                    $('.model_no').html(data);

                }
            });
        }
    </script>

    <script>
        // Get references to the select elements
        const brandSelect = document.getElementById('brandSelect');
        const categorySelect = document.getElementById('categorySelect');

        // Function to filter categories based on the selected brand using Ajax
        function filterCategoriesByBrand() {
            const selectedBrandId = brandSelect.value;

            // Clear previous options in the category dropdown
            categorySelect.innerHTML = '<option value="">Select</option>';

            // Make an Ajax request to fetch categories based on the selected brand
            $.ajax({
                type: 'POST',
                url: "{{ route('categories.by.brand') }}",
                data: {
                    brand_id: selectedBrandId,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    // Populate the category dropdown with the fetched categories
                    data.forEach(gategory => {
                        const option = document.createElement('option');
                        option.value = gategory.id;
                        option.textContent = gategory.gategory_name;
                        categorySelect.appendChild(option);
                    });
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });
        }

        // Attach event listener to the brand dropdown
        brandSelect.addEventListener('change', filterCategoriesByBrand);

        // Initially, call the function to populate categories based on the initial brand selection
        filterCategoriesByBrand();
    </script>




    <script>
        function cod(model_no) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            event.preventDefault();

            $.ajax({
                type: 'POST'
                , url: "{{ route('product.select.description.new') }}"
                , data: {
                    model_no: model_no
                }
                , success: function(data) {
                    $('.description').html(data);

                }
            });


        }

    </script>




    <script>
        function dis(dis_id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // event.preventDefault();
            var dis_id = dis_id;
            $.ajax({
                type: 'POST'
                , url: "{{ route('partner.details')}}"
                , data: {
                    dis_id: dis_id
                }
                , success: function(data) {
                    var val = JSON.parse(data);
                    $('.phone').val(val.phone);

                }
            });


        }

    </script>

    </div>

    <!--=========================*
        End Page Container
*===========================-->

    <script>
        function initialize() {

            var mapOptions, map, marker, searchBox, city
                , infoWindow = ''
                , addressEl = document.querySelector('#map-search')
                , latEl = document.querySelector('.latitude')
                , longEl = document.querySelector('.longitude')
                , element = document.getElementById('map-canvas');
            city = document.querySelector('.reg-input-city');

            mapOptions = {
                // How far the maps zooms in.
                zoom: 8,
                // Current Lat and Long position of the pin/
                center: new google.maps.LatLng(11.0168445, 76.9558321),
                // center : {
                // 	lat: -34.397,
                // 	lng: 150.644
                // },
                disableDefaultUI: false, // Disables the controls like zoom control on the map if set to true
                scrollWheel: true, // If set to false disables the scrolling on the map.
                draggable: true, // If set to false , you cannot move the map around.
                // mapTypeId: google.maps.MapTypeId.HYBRID, // If set to HYBRID its between sat and ROADMAP, Can be set to SATELLITE as well.
                // maxZoom: 11, // Wont allow you to zoom more than this
                // minZoom: 9  // Wont allow you to go more up.

            };

            /**
             * Creates the map using google function google.maps.Map() by passing the id of canvas and
             * mapOptions object that we just created above as its parameters.
             *
             */
            // Create an object map with the constructor function Map()
            map = new google.maps.Map(element, mapOptions); // Till this like of code it loads up the map.

            /**
             * Creates the marker on the map
             *
             */
            marker = new google.maps.Marker({
                position: mapOptions.center
                , map: map,
                // icon: 'http://pngimages.net/sites/default/files/google-maps-png-image-70164.png',
                draggable: true
            });

            /**
             * Creates a search box
             */
            searchBox = new google.maps.places.SearchBox(addressEl);

            /**
             * When the place is changed on search box, it takes the marker to the searched location.
             */
            google.maps.event.addListener(searchBox, 'places_changed', function() {
                var places = searchBox.getPlaces()
                    , bounds = new google.maps.LatLngBounds()
                    , i, place, lat, long, resultArray
                    , addresss = places[0].formatted_address;

                for (i = 0; place = places[i]; i++) {
                    bounds.extend(place.geometry.location);
                    marker.setPosition(place.geometry.location); // Set marker position new.
                }

                map.fitBounds(bounds); // Fit to the bound
                map.setZoom(15); // This function sets the zoom to 15, meaning zooms to level 15.
                // console.log( map.getZoom() );

                lat = marker.getPosition().lat();
                long = marker.getPosition().lng();
                latEl.value = lat;
                longEl.value = long;

                resultArray = places[0].address_components;

                // Get the city and set the city input value to the one selected
                for (var i = 0; i < resultArray.length; i++) {
                    if (resultArray[i].types[0] && 'administrative_area_level_2' === resultArray[i].types[0]) {
                        citi = resultArray[i].long_name;
                        city.value = citi;
                    }
                }

                // Closes the previous info window if it already exists
                // if (infoWindow) {
                //     infoWindow.close();
                // }
                /**
                 * Creates the info Window at the top of the marker
                 */
                //     infoWindow = new google.maps.InfoWindow({
                //         content: addresss
                //     });

                //     infoWindow.open(map, marker);
            });


            /**
             * Finds the new position of the marker when the marker is dragged.
             */
            google.maps.event.addListener(marker, "dragend", function(event) {
                var lat, long, address, resultArray, citi;

                console.log('i am dragged');
                lat = marker.getPosition().lat();
                long = marker.getPosition().lng();

                var geocoder = new google.maps.Geocoder();
                geocoder.geocode({
                    latLng: marker.getPosition()
                }, function(result, status) {
                    if ('OK' === status) { // This line can also be written like if ( status == google.maps.GeocoderStatus.OK ) {
                        address = result[0].formatted_address;
                        resultArray = result[0].address_components;

                        // Get the city and set the city input value to the one selected
                        for (var i = 0; i < resultArray.length; i++) {
                            if (resultArray[i].types[0] && 'administrative_area_level_2' === resultArray[i].types[0]) {
                                citi = resultArray[i].long_name;
                                console.log(citi);
                                city.value = citi;
                            }
                        }
                        // addressEl.value = address;
                        latEl.value = lat;
                        longEl.value = long;

                    } else {
                        console.log('Geocode was not successful for the following reason: ' + status);
                    }

                    // Closes the previous info window if it already exists
                    // if (infoWindow) {
                    //     infoWindow.close();
                    // }

                    /**
                     * Creates the info Window at the top of the marker
                     */
                    // infoWindow = new google.maps.InfoWindow({
                    //     content: address
                    // });

                    // infoWindow.open(map, marker);
                });
            });


        }

    </script>


    @php
    $settings_data = DB::table('settings')->where('status', 'Enable')->first();
    @endphp


    @if ($settings_data)
    @php
    $map_id = $settings_data->map_id;
    @endphp
    @else
    @php
    $map_id='';
    @endphp
    @endif

    <script async defer src="https://maps.googleapis.com/maps/api/js?key={{$map_id}}&libraries=places&callback=initialize"></script>






    <!--=========================*
        General Scripts
*===========================-->


</body>

</html>
