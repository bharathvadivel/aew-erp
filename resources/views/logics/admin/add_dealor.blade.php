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
                @if (count($errors) < 1 ) @if (!Session::get('warning')) @php $array=session()->forget('location');
                    @endphp
                    @endif
                    @endif

                    <!-- Disabled forms start -->
                    <div class="col-12 mt-4" style="margin-top:0!important;">
                        <div class="card">
                            <div class="card-body">
                                <center>
                                    <h5 class="card_title " style="color:#50aaca"> Add Dealer
                                        <a href="{{ route('dealor.master') }}" class="btn btn-primary btns"> <i class="fa fa-plus-circle"></i>Manage Dealer</a>
                                    </h5>


                                </center>


                                <hr>
                                <form method="post" action="{{route('dealor.store')}}">
                                    @csrf
                                    <div class="form-row">

                                        <div class="col-md-4 mb-4">
                                            <div class="form-group">
                                                <label for="disabledSelect">Direct Partner <span style="color:red">&#9733;</span></label>
                                                <select required="" name="created_id" class="form-control @error('created_id') is-invalid @enderror">
                                                    <option value="">Select</option>

                                                    @foreach ($partner as $key)

                                                    <option {{$key->partner_id==session()->get('partner_id') ? 'selected' : ($key->partner_id==old('created_id') ? 'selected':'') }} value="{{ $key->partner_id }}">{{ $key->store_name }}({{$key->partner_id}})</option>


                                                    @endforeach


                                                </select>
                                                @error('created_id')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror


                                            </div>
                                        </div>

                                        <div class="col-md-4 mb-4">
                                            <div class="form-group">
                                                <label for="disabledTextInput">Dealer-ID <span style="color:red">&#9733;</span></label>
                                                <input readonly value="{{$dealor_id}}" type="text" name="partner_id" class="form-control @error('partner_id') is-invalid @enderror" placeholder="Dealer ID">
                                                @error('partner_id')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-4">
                                            <div class="form-group">
                                                <label for="disabledTextInput">Store Name <span style="color:red">&#9733;</span></label>
                                                <input type="text" required="" value="{{old('store_name')}}" name="store_name" class="form-control @error('store_name') is-invalid @enderror" placeholder="Store Name">
                                                @error('store_name')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                            </div>
                                        </div>




                                    </div>


                                    <div class="form-row">
                                        <div class="col-md-4 mb-4">
                                            <div class="form-group">
                                                <label for="disabledTextInput">Owner Name <span style="color:red">&#9733;</span></label>
                                                <input required="" type="text" value="{{old('name')}}" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Owner Name">
                                                @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                            </div>
                                        </div>

                                        <div class="col-md-4 mb-4">
                                            <div class="form-group">
                                                <label for="disabledTextInput">Email <span style="color:red">&#9733;</span></label>
                                                <input type="email" required="" value="{{old('email')}}" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email">
                                                @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                            </div>
                                        </div>

                                        <div class="col-md-4 mb-4">
                                            <div class="form-group">
                                                <label for="disabledTextInput">DOB <span style="color:red">&#9733;</span></label>
                                                <input required="" type="date" value="{{old('dob')}}" name="dob" class="form-control @error('dob') is-invalid @enderror" placeholder="Dob">
                                                @error('dob')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                            </div>
                                        </div>


                                    </div>
                                    <div class="form-row">

                                        <div class="col-md-4 mb-4">
                                            <div class="form-group">
                                                <label for="disabledTextInput">GSTIN-NO </label>
                                                <input type="text" minlength="15" value="{{old('gstin_no')}}" maxlength="15" name="gstin_no" class="form-control @error('gstin_no') is-invalid @enderror" placeholder="GSTIN-NO">
                                                @error('gstin_no')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                            </div>
                                        </div>

                                        <div class="col-md-4 mb-4">
                                            <div class="form-group">
                                                <label for="disabledTextInput">Phone <span style="color:red">&#9733;</span></label>
                                                <input required="" type="text" value="{{old('phone')}}" onkeypress="return /[0-9]/i.test(event.key)" minlength="10" maxlength="10" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Phone">
                                                @error('phone')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <div class="form-group">
                                                <label for="disabledTextInput">Password <span style="color:red">&#9733;</span></label>
                                                <input type="text" id="token_refresh" value="{{old('password')}}" required="" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
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


                                    </div>

                                    <input value="sub_dealer" type="hidden" name="partner_type" class="form-control">

                                    <center>
                                        <button onclick="clear_data()" type="button" style="display:flex" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@getbootstrap">Add location</button>
                                    </center>
                                    <br>


                                    <div class="loca">

                                        @php
                                        $set_local =session()->get('location');


                                        @endphp
                                        @if($set_local)

                                        @foreach ($set_local as $keys => $key)
                                        @php
                                        $ids = $keys;

                                        @endphp
                                        <div id="{{$ids}}" class="form-row">
                                            <div class="col-md-4 mb-4">
                                                <div class="form-group">
                                                    <label for="disabledTextInput">Address <span style="color:red">&#9733;</span></label>
                                                    <input type="text" value="{{$key['address']}}" readonly="" name="address[]" class="form-control {{$ids}}" placeholder="address">
                                                </div>
                                            </div>
                                            <div class="col-md-2 mb-2">
                                                <div class="form-group">
                                                    <label for="disabledTextInput">Pincode <span style="color:red">&#9733;</span></label>
                                                    <input type="text" value="{{$key['pincode']}}" readonly="" name="pincode[]" class="form-control {{$ids}}" placeholder="pincode">
                                                </div>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <div class="form-group">
                                                    <label for="disabledTextInput">City <span style="color:red">&#9733;</span></label>
                                                    <input type="text" value="{{$key['city']}}" readonly="" name="city[]" class="form-control {{$ids}}" placeholder="city">
                                                </div>
                                            </div>

                                            <div class="col-md-2 mb-2">
                                                <div class="form-group">
                                                    <label for="disabledTextInput">District <span style="color:red">&#9733;</span></label>
                                                    <input type="text" value="{{$key['district']}}" readonly="" name="district[]" class="form-control {{$ids}}" placeholder="district">
                                                </div>
                                            </div>
                                            <div class="col-md-1 mb-1">
                                                <div class="form-group">
                                                    <label for="disabledTextInput"></label>

                                                    <button type="button" onclick="remove({{$ids}})" style="padding:10px;width:0px;border:none;color:red" class="form-control"><i class="fa fa-trash"></i></button>
                                                </div>
                                            </div>
                                            <input type="hidden" value="{{$key['lat']}}" name="lat[]" class="form-control '.$ids.'">
                                            <input type="hidden" value="{{$key['lang']}}" name="lang[]" class="form-control '.$ids.'">
                                            <input type="hidden" value="{{$key['location_id']}}" name="location_id[]" class="form-control {{$ids}}">


                                        </div>
                                        @endforeach
                                        @endif


                                    </div>


                                    <div class="form-row">
                                        <div class="col-md-3 mb-3">
                                            <div class="form-group">
                                                <label for="disabledSelect">State <span style="color:red">&#9733;</span></label>
                                                <input type="text" readonly value="{{old('state')}}" required="" name="state" class="form-control new_state @error('state') is-invalid @enderror" placeholder="State">
                                                @error('state')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                            </div>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <div class="form-group">
                                                <label for="disabledTextInput">Country <span style="color:red">&#9733;</span></label>
                                                <input readonly required="" value="{{old('country')}}" type="text" name="country" class="form-control new_country @error('country') is-invalid @enderror" placeholder="Country">
                                                @error('country')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <div class="form-group">
                                                <label for="disabledTextInput">Credit limit <span style="color:red">&#9733;</span></label>
                                                <input required="" type="text" value="{{old('credit_limit')}}" name="credit_limit" class="form-control @error('credit_limit') is-invalid @enderror" placeholder="Credit Limit">
                                                @error('credit_limit')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                            </div>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <div class="form-group">
                                                <label for="disabledTextInput">Credit days <span style="color:red">&#9733;</span></label>
                                                <input required="" type="text" value="{{old('credit_days')}}" name="credit_days" class="form-control @error('credit_days') is-invalid @enderror" placeholder="Credit Days">
                                                @error('credit_days')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                            </div>
                                        </div>
                                    </div>



                                    <center><button id="newmapyarabtnsubmit" type="submit" class="btn btn-primary mt-4 pl-4 pr-4">Submit</button>
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

     <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">Set Location</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                 </div>
                 <div class="modal-body">
                     <form>

                         <div class="row">
                             <div class="col-md-6"> <label for="recipient-name" class="col-form-label">Address: <span style="color:red">&#9733;</span></label>
                                 <input type="text" placeholder="" id="map-search" name="address_map" class="form-control vl">
                             </div>
                             <div class="col-md-6"> <label for="recipient-name" class="col-form-label">Pincode: <span style="color:red">&#9733;</span></label>
                                 <input type="text" oninput="new_location(this.value)" onkeypress="return /[0-9]/i.test(event.key)" minlength="6" maxlength="6" name="pincode_map" class="form-control vl" id="pincode">

                             </div>
                         </div>

                         <div class="row">
                             <div class="col-md-6"> <label for="recipient-name" class="col-form-label  reg-input-city">City: <span style="color:red">&#9733;</span></label>
                                 <input type="text" readonly placeholder="City" id="city" name="city_map" class="form-control new_city vl">


                             </div>
                             <div class="col-md-6"> <label for="recipient-name" class="col-form-label">District: <span style="color:red">&#9733;</span></label>
                                 <input type="text" readonly name="district_map" id="district" class="form-control new_district vl" placeholder="District">

                             </div>
                         </div>
                     </form>
                 </div>
                 <div style="width:100%;height:400px;" id="map-canvas"></div>
                 <input name="lat_map" type="hidden" id="c_lat" class="latitude vl">
                 <input name="lang_map" type="hidden" id="c_lang" class="longitude vl">
                 <input name="form_type" type="hidden" value="add" id="form_type">
                 <input name="index_value" type="hidden" value="0" id="index_value">
                 <input name="location_id" type="hidden" value="0" id="location_id">


                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                     <div id="save_form">
                         <button type="button" onclick="distributor_location()" id="add_location" class="btn btn-primary">submit</button>

                     </div>
                 </div>





             </div>
         </div>
     </div>

     <script>
         function initialize() {

             var mapOptions, map, marker, searchBox, city
                 , infoWindow = ''
                 , addressEl = document.querySelector('#map-search')
                 , latEl = document.querySelector('.latitude')
                 , longEl = document.querySelector('.longitude')
                 , element = document.getElementById('map-canvas');
             city = document.querySelector('.reg-input-city');
             lat = $('#c_lat').val() != '' ? $('#c_lat').val() : 11.0168445;
             lang = $('#c_lang').val() != '' ? $('#c_lang').val() : 76.9558321;


             mapOptions = {
                 // How far the maps zooms in.
                 zoom: 8,
                 // Current Lat and Long position of the pin/
                 center: new google.maps.LatLng(lat, lang),
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
                 // infoWindow = new google.maps.InfoWindow({
                 //     content: addresss
                 // });

                 // infoWindow.open(map, marker);
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
         function clear_data() {
             $('#map-search').val('');
             $('#pincode').val('');
             $('#city').val('');
             $('#district').val('');
             $('#c_lat').val('');
             $('#c_lang').val('');
             $('#form_type').val('add');
            $('#add_location').html('submit');

             initialize();
         }

     </script>

     <script>
         function distributor_location() {

             var address = $("input[name=address_map]").val();
             var pincode = $("input[name=pincode_map]").val();
             var city = $("input[name=city_map]").val();
             var district = $("input[name=district_map]").val();
             var lang = $("input[name=lang_map]").val();
             var lat = $("input[name=lat_map]").val();
             var form_type = $("input[name=form_type]").val();
             var index_value = $("input[name=index_value]").val();
             var location_id = $("input[name=location_id]").val();


             if (address == '' || pincode == '' || city == '' || district == '' || form_type == '' || location_id == '') {
                 alert('Please fill all fields');
                 return false;
             }

             if (lat == '') {
                 alert('Please pin your exact location in this google map');
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
                 , url: "{{ route('distributor.location')}}"
                 , data: {
                     address: address
                     , pincode: pincode
                     , city: city
                     , district: district
                     , lang: lang
                     , lat: lat
                     , index_value: index_value
                     , form_type: form_type
                     , location_id: location_id

                 }
                 , success: function(data) {
                     $('.loca').html(data);
                     $('.vl').val('');
                     $('#exampleModal').modal('hide');
                 }
                 , error: function(data) {
                     alert('Please fill all fields');
                 }
             , });


         }

     </script>

    <script>
        function remove(id) {


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            event.preventDefault();
            $.ajax({
                type: 'POST'
                , url: "{{ route('distributor.remove')}}"
                , data: {
                    id: id,

                }
                , success: function(data) {
                    document.getElementById(id).hidden = true;
                    $("." + id).prop("disabled", true);




                }
                , error: function(data) {
                    swal({
                        type: "error"
                        , title: "Error!"
                        , text: "please try again !"
                        , confirmButtonText: "Dismiss"
                        , buttonsStyling: !1
                        , confirmButtonClass: "btn btn-danger"
                    })
                }
            , });




        }

    </script>

     <script>
         function location_edit(id) {
             $.ajaxSetup({
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 }
             });
             event.preventDefault();
             $.ajax({
                 type: 'POST'
                 , url: "{{ route('distributor.location.edit')}}"
                 , data: {
                     id: id,

                 }
                 , success: function(res) {
                     const data = JSON.parse(res);
                     $('#map-search').val(data.address);
                     $('#pincode').val(data.pincode);
                     $('#city').val(data.city);
                     $('#district').val(data.district);
                     $('#c_lat').val(data.lat);
                     $('#c_lang').val(data.lang);
                     $('#form_type').val('edit');
                     $('#index_value').val(id);
                     $('#location_id').val(data.location_id);



                     $('#add_location').html('update');
                     initialize();
                     $('#exampleModal').modal('show');


                 }
                 , error: function(data) {
                     swal({
                         type: "error"
                         , title: "Error!"
                         , text: "please try again !"
                         , confirmButtonText: "Dismiss"
                         , buttonsStyling: !1
                         , confirmButtonClass: "btn btn-danger"
                     })
                 }
             , });


         }

     </script>


    <!--=========================*
                                                            General Scripts
                                                            *===========================-->


</body>

</html>
