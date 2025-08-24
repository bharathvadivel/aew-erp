@if (session()->get('partner_type')=='service_admin' || session()->get('partner_type')=='service_center' )

<li class="menu-title">MAIN</li>

<li>
    <a href="{{route('enquiry.dashboard')}}">
        <i class="feather feather-grid"></i>
        <span> Dashboard</span>
    </a>
</li>


@if (session()->get('partner_type')=='service_admin')
<li>
    <a href="{{route('service.master')}}">

        <i class="fa fa-wrench"></i>
        <span>Service center</span>
    </a>
</li>
@endif

<li>
    <a href="{{route('service.center.serials.stock')}}">

        <i class="fa fa-cubes"></i>
        <span>Stock</span>
    </a>
</li>
<li>
    <a href="{{route('scp.return.stock.master')}}">
        <i class="fa fa-reply"></i>
        <span>Return Stock</span>
    </a>
</li>

<li>
    <a href="{{route('executive.service.center')}}">

        <i class="fa fa-user"></i>
        <span>Service Executive</span>
    </a>
</li>

<li>
    <a href="javascript:void(0)" aria-expanded="true">
        <i class="fa fa-question-circle"></i>
        <span>Enquiry List</span>
        <span class="float-right arrow"><i class="ion ion-chevron-down"></i></span>
    </a>
    <ul class="submenu">
        @if (session()->get('partner_type')=='service_admin' )

        <li>
            <a href="{{route('add.enquiry')}}">
                <i class="feather feather-check-square"></i>
                <span>Add Service Enquiry</span>
            </a>
        </li>
        @endif
        <li>
            @if (session()->get('partner_type')=='service_admin' )
            <a href="{{route('enquiry.master')}}">
                @else
                <a href="{{route('enquiry.manage')}}">
                    @endif
                    <i class="feather feather-check-square"></i>
                    <span>Manage Enquiry</span>
                </a>
        </li>

        @if (session()->get('partner_type')=='service_admin' )
        <li>
            <a href="{{route('customer.support')}}">

                <i class="feather feather-check-square"></i>
                <span>Customer Support</span>
            </a>
        </li>
        @endif

    </ul>
</li>

<li>
    <a href="{{route('enquiry.reports')}}">
        <i class="fa fa-id-card"></i>
        <span>Enquiry Reports</span>
    </a>
</li>
@if (session()->get('partner_type')=='service_admin' )

<li>
    <a href="javascript:void(0)" aria-expanded="true">
        <i class="fa fa-cogs"></i>
        <span>Warranty Logics</span>
        <span class="float-right arrow"><i class="ion ion-chevron-down"></i></span>
    </a>
    <ul class="submenu">
        <li><a href="{{url('manage_warranty_logics')}}"><i class="ion-ios-folder-outline"></i><span>Warranty Logics</span></a>
        </li>
    </ul>
</li>




@endif


@endif
