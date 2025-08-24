<li>
    <a href="{{route('admin.dashboard')}}">
        <i class="feather feather-grid"></i>
        <span> Dashboard</span>
    </a>
</li>

<li>
    <a href="{{route('contact.master')}}">
        <i class="fa fa-users"></i>
        <span>Contacts</span>
    </a>
</li>
<li>
    <a href="javascript:void(0)" aria-expanded="true">
        <i class="fa fa-database"></i>
        <span>Master</span>
        <span class="float-right arrow"><i class="ion ion-chevron-down"></i></span>
    </a>
    <ul class="submenu">
        <li>
            <a href="{{url('employee_master')}}"><i class="ion-ios-folder-outline"></i><span>Employees</span></a>
        </li>
        <li>
            <a href="{{url('model_master')}}"><i class="ion-ios-folder-outline"></i><span>Models</span></a>
        </li>
        <li>
            <a href="{{route('item.type.master')}}"><i class="ion-ios-folder-outline"></i><span>Item Types</span></a>
        </li>
        <li>
            <a href="{{route('item.group.master')}}"><i class="feather feather-check-square"></i><span>Item Groups</span></a>
        </li>
        <li>
            <a href="{{route('unit.master')}}"><i class="ion-ios-folder-outline"></i><span>Units</span></a>
        </li>
    </ul>
</li>

<li>
    <a href="javascript:void(0)" aria-expanded="true">
        <i class="fa fa-store-alt"></i>
        <span>Inventory</span>
        <span class="float-right arrow"><i class="ion ion-chevron-down"></i></span>
    </a>
    <ul class="submenu">
        <li>
            <a href="{{route('material.master')}}">
                <i class="feather feather-check-square"></i>
                <span>Bill of Materials</span>
            </a>
        </li>

        <li>
            <a href="{{route('product.master')}}">
                <i class="feather feather-check-square"></i>
                <span>Products</span>
            </a>
        </li>

        <li>
            <a href="{{route('routing.master')}}">
                <i class="feather feather-check-square"></i>
                <span>Routings</span>
            </a>
        </li>

        <li>
            <a href="{{route('la.master')}}">
                <i class="feather feather-check-square"></i>
                <span>Loss & Adjustments</span>
            </a>
        </li>

        <li>
            <a href="{{route('ab.master')}}">
                <i class="feather feather-check-square"></i>
                <span>Assembly Bills</span>
            </a>
        </li>

        <li>
            <a href="{{route('mb.master')}}">
                <i class="feather feather-check-square"></i>
                <span>Machine Bills</span>
            </a>
        </li>

        <li>
            <a href="{{route('inwd.invoice.master')}}">
                <i class="feather feather-check-square"></i>
                <span>Inward Invoice</span>
            </a>
        </li>

        <li>
            <a href="{{route('inwd.dc.master')}}">
                <i class="feather feather-check-square"></i>
                <span>Inward DC</span>
            </a>
        </li>
    </ul>
</li>

<li>
    <a href="javascript:void(0)" aria-expanded="true">
        <i class="fa fa-cogs"></i>
        <span>Production</span>
        <span class="float-right arrow"><i class="ion ion-chevron-down"></i></span>
    </a>
    <ul class="submenu">
        <li>
            <a href="{{route('order.master')}}">
                <i class="feather feather-check-square"></i>
                <span>Order Master</span>
            </a>
        </li>
        <li>
            <a href="{{route('dispatch.master')}}">
                <i class="feather feather-check-square"></i>
                <span>Dispatch Master</span>
            </a>
        </li>
        <li>
            <a href="{{route('order.dispatch.report')}}">
                <i class="feather feather-check-square"></i>
                <span>Order & Dispatch Report</span>
            </a>
        </li>
        <li>
            <a href="{{route('production.report')}}">
                <i class="feather feather-check-square"></i>
                <span>Production Report</span>
            </a>
        </li>
        <li>
            <a href="{{route('daily.plan')}}">
                <i class="feather feather-check-square"></i>
                <span>Daily Plan</span>
            </a>
        </li>
        <li>
            <a href="{{route('production.requirement.report')}}">
                <i class="feather feather-check-square"></i>
                <span>Production Requirement</span>
            </a>
        </li>
        <li>
            <a href="{{route('job.card.master')}}">
                <i class="feather feather-check-square"></i>
                <span>Job Cards</span>
            </a>
        </li>

        <li>
            <a href="{{route('department.wise.master')}}">
                <i class="feather feather-check-square"></i>
                <span>Department Data</span>
            </a>
        </li>
    </ul>
</li>

<li>
    <a href="javascript:void(0)" aria-expanded="true">
        <i class="fa fa-file"></i>
        <span>Sales</span>
        <span class="float-right arrow"><i class="ion ion-chevron-down"></i></span>
    </a>
    <ul class="submenu">
        <li>
            <a href="{{route('invoice.master')}}">
                <i class="feather feather-check-square"></i>
                <span>Invoices</span>
            </a>
        </li>
        <li>
            <a href="{{route('dc.master')}}">
                <i class="feather feather-check-square"></i>
                <span>Delivery Challans</span>
            </a>
        </li>
    </ul>
</li>
@php
$partner_type = session()->get('partner_type');
@endphp
@if($partner_type=='admin')
<li>
    <a href="{{route('costing')}}" aria-expanded="true">
        <i class="fa fa-inr"></i>
        <span>Costing</span>
        <span class="float-right"><i class="fa fa-lock"></i></span>
    </a>
</li>
@endif

<li>
    <a href="javascript:void(0)" aria-expanded="true">
        <i class="fa fa-file-text"></i>
        <span>Reports</span>
        <span class="float-right arrow"><i class="ion ion-chevron-down"></i></span>
    </a>
    <ul class="submenu">
        <li>
            <a href="{{route('stock.report')}}">
                <i class="feather feather-check-square"></i>
                <span>Required To Build</span>
            </a>
        </li>
    </ul>
</li>