<script src="{{asset('user/new_js/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('user/new_js/popper.min.js')}}"></script>
<script src="{{asset('user/new_js/bootstrap.min.js')}}"></script>
<script src="{{asset('user/new_js/toastr.js')}}"></script>

{{--
<script>
    $(document).ready(function() {
        toastr.options.timeOut = 10000;
        @if(Session::has('error'))
        toastr.error('{{ Session::get('
            error ') }}');
@elseif(Session::has('success'))
toastr.success('{{ Session::get('
            success ') }}');
@elseif(Session::has('info'))
toastr.info('{{ Session::get('
            info ') }}');
@elseif(Session::has('warning'))
toastr.warning('{{ Session::get('
            warning ') }}');
@endif

});

</script> --}}

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
