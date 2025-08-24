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
                                <h5 class="card_title " style="color:#50aaca"> Edit Warehouse
                                    <a href="{{ route('warehouse') }}" class="btn btn-primary btns"> <i class="fa fa-plus-circle"></i>Manage Warehouse</a>
                                </h5>


                            </center>


                            <hr>
                            <form method="post" action="{{route('warehouse.update')}}">
                                @csrf
                                <input type="hidden" name="id" value="{{$row->id}}">
                                <div class="form-row">

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Warehouse-ID <span style="color:red">&#9733;</span></label>
                                            <input readonly value="{{$row->warehouse_id}}" type="text" name="warehouse_id" class="form-control @error('warehouse_id') is-invalid @enderror" placeholder="Warehouse ID">
                                            @error('warehouse_id')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Name <span style="color:red">&#9733;</span></label>
                                            <input required="" value="{{$row->name}}" type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Name">

                                            @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Email <span style="color:red">&#9733;</span></label>
                                            <input required="" value="{{$row->email}}" type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email">
                                            @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Phone <span style="color:red">&#9733;</span></label>
                                            <input required="" onkeypress="return /[0-9]/i.test(event.key)" minlength="10" maxlength="10" value="{{$row->phone}}" type="number" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Phone">
                                            @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                    </div>




                                </div>


                                <div class="form-row">

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Address <span style="color:red">&#9733;</span></label>
                                            <input id="map-search" required="" value="{{$row->address}}" type="text" name="address" class="form-control @error('address') is-invalid @enderror" placeholder="Address">
                                            @error('address')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Pincode <span style="color:red">&#9733;</span></label>
                                            <input required="" oninput="new_location(this.value)" onkeypress="return /[0-9]/i.test(event.key)" minlength="6" maxlength="6" value="{{$row->pin_code}}" type="text" name="pin_code" class="form-control @error('pin_code') is-invalid @enderror" placeholder="Pincode">
                                            @error('pin_code')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledSelect">City <span style="color:red">&#9733;</span></label>
                                            <input type="text" readonly required="" value="{{$row->city}}" placeholder="City" name="city" class="form-control new_city @error('city') is-invalid @enderror">
                                            @error('city')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledSelect">District <span style="color:red">&#9733;</span></label>
                                            <input type="text" readonly required="" value="{{$row->district}}" name="district" class="form-control new_district @error('district') is-invalid @enderror" placeholder="District">
                                            @error('district')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                    </div>




                                </div>

                                <div class="form-row">
                                    <div style="width:100%;height:400px;" id="map-canvas"></div>
                                </div>

                                <div class="form-row">
                                    <input name="lat" type="hidden" value="{{$row->lat}}" id="c_lat" class="latitude vl">
                                    <input name="lang" type="hidden" id="c_lang" value="{{$row->lang}}" class="longitude vl">
                                    <input type="hidden" class="reg-input-city">
                                    <input name="location_id" type="hidden" value="{{$row->location_id}}">


                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledSelect">State <span style="color:red">&#9733;</span></label>
                                            <input type="text" readonly required="" value="{{$row->state}}" name="state" class="form-control new_state @error('state') is-invalid @enderror" placeholder="State">
                                            @error('state')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Country <span style="color:red">&#9733;</span></label>
                                            <input readonly required="" value="{{$row->country}}" type="text" name="country" class="form-control new_country  @error('country') is-invalid @enderror"" placeholder=" Country">
                                            @error('country')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">GSTIN-NO</label>
                                            <input minlength="15" maxlength="15" value="{{$row->gstin_no}}" type="text" name="gstin_no" class="form-control  @error('gstin_no') is-invalid @enderror" placeholder="GSTIN-NO">
                                            @error('gstin_no')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledSelect">Status</label>
                                            <select name="status" class="form-control  @error('status') is-invalid @enderror">
                                                <option {{$row->status=='Enable' ? 'selected':''}} value="Enable">Enable</option>
                                                <option {{$row->status=='Disable' ? 'selected':''}} value="Disable">Disable</option>
                                            </select>
                                            @error('status')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-3 mb-4">
                                        <div class="form-group">
                                            <label for="disabledTextInput">TCS No. <span style="color:red">&#9733;</span> </label>
                                            <input required="" value="{{$row->tcs_no}}" type="text" name="tcs_no" class="form-control @error('tcs_no') is-invalid @enderror" placeholder="TCS No">
                                            @error('tcs_no')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-4">
                                        <div class="form-group">
                                            <label for="disabledTextInput">TCS Type <span style="color:red">&#9733;</span></label>
                                            <select required="" name="tcs_type" class="form-control @error('tcs_type') is-invalid @enderror">
                                                <option value="">Select TCS Type</option>
                                                <option {{$row->tcs_type=='Auto' ? 'selected':''}} value="Auto">Auto</option>
                                                <option {{$row->tcs_type=='Yes' ? 'selected':''}} value="Yes">Yes</option>
                                                <option {{$row->tcs_type=='No' ? 'selected':''}} value="No">No</option>
                                            </select>
                                            @error('tcs_type')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>



                                <center><button id="mapyarabtnsubmit" type="button" class="btn btn-primary mt-4 pl-4 pr-4">Submit</button>
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

    <script>
        function test() {
            var lat = document.getElementById('c_lat').value;
            if (lat != '') {
                return true;
            } else {
                alert('Please pin by your location in google map');
                return false;
            }

        }

    </script>
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
                center: new google.maps.LatLng({
                    {
                        $row - > lat
                    }
                }, {
                    {
                        $row - > lang
                    }
                }),

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
                //  if (infoWindow) {
                //      infoWindow.close();
                //  }
                /**
                 * Creates the info Window at the top of the marker
                 */
                //  infoWindow = new google.maps.InfoWindow({
                //      content: addresss
                //  });

                //  infoWindow.open(map, marker);
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
                        //  addressEl.value = address;
                        latEl.value = lat;
                        longEl.value = long;

                    } else {
                        console.log('Geocode was not successful for the following reason: ' + status);
                    }

                    // Closes the previous info window if it already exists
                    //  if (infoWindow) {
                    //      infoWindow.close();
                    //  }

                    /**
                     * Creates the info Window at the top of the marker
                     */
                    //  infoWindow = new google.maps.InfoWindow({
                    //      content: address
                    //  });

                    //  infoWindow.open(map, marker);
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
