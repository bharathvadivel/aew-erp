<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>

    <!--=========================*
                Met Data
    *===========================-->
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('user/new_css/choices.min.css')}}">
    <link rel="stylesheet" href="{{asset('user/new_css/bootstrap.min.css')}}">
    <script src="{{asset('user/new_js/choices.min.js')}}"></script>

    <script src="{{asset('user/new_js/bootstrap.bundle.min.js')}}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{asset('user/vendors/sweetalert2/js/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('user/vendors/sweetalert2/js/sweetalert2.all.min.js')}}"></script>

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
                                <h5 class="card_title " style="color:#50aaca"> Add Service Center
                                    <a href="{{ route('service.master') }}" class="btn btn-primary btns"> <i class="fa fa-plus-circle"></i>Manage Service Center</a>
                                </h5>


                            </center>


                            <hr>
                            <form method="post">

                                <div class="form-row">

                                    <div class="col-md-4 mb-4">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Service Center-ID <span style="color:red">&#9733;</span></label>
                                            <input readonly value="{{$service_id}}" type="text" name="service_id" class="form-control" placeholder="Service ID">
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-4">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Service center name <span style="color:red">&#9733;</span></label>
                                            <input required="" type="text" name="service_center_name" class="form-control" placeholder="Service center name">
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-4">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Owner name <span style="color:red">&#9733;</span></label>
                                            <input required="" type="text" name="name" class="form-control" placeholder="Owner name">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Email <span style="color:red">&#9733;</span></label>
                                            <input type="email" required="" name="email" class="form-control" placeholder="Email">
                                        </div>
                                    </div>

                                    <div class="col-md-2 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Phone <span style="color:red">&#9733;</span></label>
                                            <input required="" type="text" onkeypress="return /[0-9]/i.test(event.key)" minlength="10" maxlength="10" name="phone" class="form-control" placeholder="Phone">
                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Password <span style="color:red">&#9733;</span></label>
                                            <input type="text" id="token_refresh" required="" name="password" class="form-control" placeholder="Password">
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
                                            <label for="disabledTextInput">GSTIN-NO </label>
                                            <input type="text" minlength="15" maxlength="15" name="gstin_no" class="form-control" placeholder="GSTIN-NO">
                                        </div>
                                    </div>

                                </div>
                                <div class="form-row">
                                    <div class="col-md-12 mb-12">
                                        <div class="form-group">

                                            <label for="disabledSelect">Product Category <span style="color:red">&#9733;</span></label>
                                            <select id="choices-multiple-remove-button" placeholder="Select category" multiple required="" name="gategory_id[]" class="form-control gategory_id">
                                                @foreach ($service_type as $key => $vl)

                                                <option value="@php echo $vl->id @endphp">@php echo $vl->gategory_name @endphp </option>;
                                                @endforeach


                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <script>
                                    $(document).ready(function() {

                                        var multipleCancelButton = new Choices("#choices-multiple-remove-button", {
                                            removeItemButton: true
                                            , shouldSort: false
                                            , fuseOptions: {
                                                threshold: 0
                                            }

                                        , });


                                    });

                                </script>

                                <div class="form-row">
                                    <div class="col-md-12 mb-12">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Multiple Service Pincode <span style="color:red">&#9733;</span></label>
                                            <input required="" pattern="[^a-zA-Z]+" type="text" name="service_pincode" class="form-control" placeholder="Pincode">
                                            <p><span style="font-size:12px;color:red">Sample pincode format 641004,641013,641002,641017</span></p>

                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">


                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Address <span style="color:red">&#9733;</span></label>
                                            <input id="map-search" required="" type="text" name="address" class="form-control" placeholder="Address">
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Pincode <span style="color:red">&#9733;</span></label>
                                            <input required="" oninput="new_location(this.value)" onkeypress="return /[0-9]/i.test(event.key)" minlength="6" maxlength="6" type="text" name="pincode" class="form-control" placeholder="Pincode">

                                        </div>
                                    </div>
                                    <input type="hidden" class="reg-input-city">

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledSelect">City <span style="color:red">&#9733;</span></label>
                                            <input type="text" readonly required="" placeholder="City" name="city" class="form-control new_city">

                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledSelect">District <span style="color:red">&#9733;</span></label>
                                            <input type="text" readonly required="" name="district" class="form-control new_district" placeholder="District">

                                        </div>
                                    </div>


                                </div>

                                <div class="form-row">

                                    <div style="width:100%;height:400px;" id="map-canvas"></div>

                                </div>
                                <div class="form-row">

                                    <input name="lat" type="hidden" id="c_lat" class="latitude vl">
                                    <input name="lang" type="hidden" id="c_lang" class="longitude vl">
                                    <input name="location_id" type="hidden" value="{{$location_id}}">

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledSelect">State <span style="color:red">&#9733;</span></label>
                                            <input type="text" readonly required="" name="state" class="form-control new_state" placeholder="State">

                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Country <span style="color:red">&#9733;</span></label>
                                            <input required="" readonly type="text" name="country" class="form-control new_country" placeholder="Country">
                                        </div>
                                    </div>
                                </div>

                                <center><input type="submit" class="btn btn-primary mt-4 pl-4 pr-4 btn-submit">
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




    <script type="text/javascript">
        $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

        });

        $(".btn-submit").click(function(e) {
            this.disabled = true;



            e.preventDefault();

            var lat = document.getElementById('c_lat').value;
            if (lat == '') {

                swal({
                    type: "error"
                    , title: "Error!"
                    , text: "Please pin by your location in google map"
                    , confirmButtonText: "Dismiss"
                    , buttonsStyling: !1
                    , confirmButtonClass: "btn btn-danger"
                });
                $(".btn-submit").attr('disabled', false);


                return false;

            }


            var gategory_id = [];
            $(".gategory_id :selected").each(function() {
                gategory_id.push(this.value);
            });

            var service_id = $("input[name=service_id]").val();
            var service_center_name = $("input[name=service_center_name]").val();
            var name = $("input[name=name]").val();
            var email = $("input[name=email]").val();
            var phone = $("input[name=phone]").val();
            var password = $("input[name=password]").val();
            var gstin_no = $("input[name=gstin_no]").val();
            var service_pincode = $("input[name=service_pincode]").val();
            var address = $("input[name=address]").val();
            var pincode = $("input[name=pincode]").val();
            var city = $("input[name=city]").val();
            var district = $("input[name=district]").val();
            var lat = $("input[name=lat]").val();
            var lang = $("input[name=lang]").val();
            var location_id = $("input[name=location_id]").val();
            var state = $("input[name=state]").val();
            var country = $("input[name=country]").val();

            if (service_id == '' || service_center_name == '' || name == '' || email == '' || phone == '' || password == '' || gategory_id.length === 0 || service_pincode == '' || address == '' || pincode == '' || city == '' || district == '' || country == '') {


                swal({
                    type: "error"
                    , title: "Error!"
                    , text: "Please check required fields"
                    , confirmButtonText: "Dismiss"
                    , buttonsStyling: !1
                    , confirmButtonClass: "btn btn-danger"
                });
                $(".btn-submit").attr('disabled', false);


                return false;
            }


            $.ajax({

                type: 'POST',

                url: "{{ route('service.store') }}",

                data: {
                    service_id: service_id
                    , service_center_name: service_center_name
                    , gategory_id: gategory_id
                    , name: name
                    , email: email
                    , phone: phone
                    , password: password
                    , gstin_no: gstin_no
                    , service_pincode: service_pincode
                    , address: address
                    , pincode: pincode
                    , city: city
                    , district: district
                    , lat: lat
                    , lang: lang
                    , location_id: location_id
                    , state: state
                    , country: country
                , }
                , success: function(data) {
                    var res = JSON.parse(data);


                    if (res.status == true) {
                        swal({
                            type: "success"
                            , title: "Success"
                            , text: res.message
                            , buttonsStyling: !1
                            , confirmButtonClass: "btn btn-success"
                        }).then(function() {
                            location.reload();
                        });

                    } else {
                        swal({
                            type: "error"
                            , title: "Error!"
                            , text: res.message
                            , confirmButtonText: "Dismiss"
                            , buttonsStyling: !1
                            , confirmButtonClass: "btn btn-danger"
                        })
                    }
                    $(".btn-submit").attr('disabled', false);




                }
                , error: function(data) {
                    swal({
                        type: "error"
                        , title: "Error!"
                        , text: "Something went wrong please fill required fileds!"
                        , confirmButtonText: "Dismiss"
                        , buttonsStyling: !1
                        , confirmButtonClass: "btn btn-danger"
                    })
                    $(".btn-submit").attr('disabled', false);



                },

            });



        });

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
