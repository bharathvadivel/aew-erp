<script>
    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

        return true;
    }

</script>
<div class="footer-area">
    <p>&copy; Lucabooks. All right reserved.</p>
</div>

<!-- bootstrap 4 js -->
<script src="{{asset('user/js/popper.min.js')}}"></script>
<script src="{{asset('user/js/bootstrap.min.js')}}"></script>
<!-- Owl Carousel Js -->
<script src="{{asset('user/js/owl.carousel.min.js')}}"></script>
<!-- Metis Menu Js -->
<script src="{{asset('user/js/metisMenu.min.js')}}"></script>
<!-- SlimScroll Js -->
<script src="{{asset('user/js/jquery.slimscroll.min.js')}}"></script>
<!-- Slick Nav -->
<script src="{{asset('user/js/jquery.slicknav.min.js')}}"></script>
<!-- ========== This Page js ========== -->

<!-- Dropzone Js -->
<script src="{{asset('user/vendors/dropzone/js/dropzone.js')}}"></script>

<!-- Dropzone init Js -->
<script src="{{asset('user/js/init/dropzone.js')}}"></script>
<!--Chart Js-->
<script src="{{asset('user/vendors/charts/charts-bundle/Chart.bundle.js')}}"></script>

<!-- Flot Chart -->
<script src="{{asset('user/vendors/charts/flot/jquery.flot.js')}}"></script>
<script src="{{asset('user/vendors/charts/flot/jquery.flot.resize.js')}}"></script>
<!-- <script src="{{asset('user/vendors/charts/flot/jquery.flot.categories.js')}}"></script> -->
<script src="{{asset('user/vendors/charts/flot/jquery.flot.fillbetween.js')}}"></script>
<script src="{{asset('user/vendors/charts/flot/jquery.flot.stack.js')}}"></script>
<script src="{{asset('user/vendors/charts/float-bundle/jquery.flot.pie.js')}}"></script>

<!--Home Script-->
<script src="{{asset('user/js/home.js')}}"></script>

<!-- ========== This Page js ========== -->

<!-- Main Js -->
<script src="{{asset('user/js/main.js')}}"></script>
