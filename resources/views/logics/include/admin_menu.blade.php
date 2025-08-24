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

<li>
    <a href="javascript:void(0)" aria-expanded="true">
        <i class="fa fa-file-text"></i>
        <span>Reports</span>
    </a>
</li>