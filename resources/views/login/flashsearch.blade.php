<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- CSS for searching -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<!-- JS for searching -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{asset('user/new_js/popper.min.js')}}"></script>
<script src="{{asset('user/new_js/bootstrap.min.js')}}"></script>
<script>
    // .js-example-basic-single declare this class into your select box
    $(document).ready(function() {
        $('.selectsearch').select2();

    });

</script>
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

    .select2-container .select2-selection--single {
        height: 37px;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 35px;
    }

</style>

@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
</div>
@endif

@if ($message = Session::get('error'))
<div class="alert alert-danger alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
</div>
@endif

@if ($message = Session::get('warning'))
<div class="alert alert-warning alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
</div>
@endif

@if ($message = Session::get('info'))
<div class="alert alert-info alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert">×</button>
    Please check the form below for errors
</div>
@endif



{{-- <script>
    // success message popup notification
    @if(Session::has('success'))
    toastr.success("{{ Session::get('success') }}");
@endif

// info message popup notification
@if(Session::has('info'))
toastr.info("{{ Session::get('info') }}");
@endif

// warning message popup notification
@if(Session::has('warning'))
toastr.warning("{{ Session::get('warning') }}");
@endif

// error message popup notification
@if(Session::has('error'))
toastr.error("{{ Session::get('error') }}");
@endif

</script> --}}
