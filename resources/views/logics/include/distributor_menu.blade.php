@if (session()->get('partner_type')=='distributor')
<li class="menu-title">MENU</li>
<li>
    <a href="{{route('distributor.dashboard')}}">
        <i class="feather feather-grid"></i>
        <span> Dashboard</span>
    </a>
</li>
<li>
    <a href="javascript:void(0)" aria-expanded="true">
        <i class="fa fa-users"></i>
        <span>Users</span>
        <span class="float-right arrow"><i class="ion ion-chevron-down"></i></span>
    </a>
    <ul class="submenu">


        <li>
            <a href="{{route('dealor.master')}}">
                <i class="feather feather-check-square"></i>
                <span> Dealers </span>
            </a>
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

            <a href="{{route('partner.serial.list')}}">
                <i class="feather feather-check-square"></i>
                <span>Purchase</span>
            </a>
        </li>

    </ul>
</li>




<li>
    <a href="javascript:void(0)" aria-expanded="true">
        <i class="fa fa-chart-line"></i>
        <span>Sales</span>
        <span class="float-right arrow"><i class="ion ion-chevron-down"></i></span>
    </a>
    <ul class="submenu">



        <li>
            <a href="{{route('distributorinvoice')}}">
                <i class="feather feather-check-square"></i>
                <span>Invoice</span>
            </a>
        </li>

    </ul>
</li>
<li>
    <a href="javascript:void(0)" aria-expanded="true">
        <i class="fa feather-refresh-ccw"></i>
        <span>Sales Return </span>
        <span class="float-right arrow"><i class="ion ion-chevron-down"></i></span>
    </a>
    <ul class="submenu">



        <li>
            <a href="{{route('direct.salereturn.master')}}">
                <i class="feather feather-check-square"></i>
                <span>Sales Return Invoice</span>
            </a>
        </li>
        <li>
            <a href="{{route('dealer.salereturn.master')}}">
                <i class="feather feather-check-square"></i>
                <span>Dealer Sales Return Invoice Request</span>
            </a>
        </li>

    </ul>
</li>


<li>
    <a href="javascript:void(0)" aria-expanded="true">
        <i class="fa fa-shopping-cart"></i>
        <span>Order details</span>


        <span class="float-right arrow"><i class="ion ion-chevron-down"></i></span>
    </a>
    <ul class="submenu">



        <li>
            <a href="{{route('order')}}">

                <i class="feather feather-check-square"></i>
                <span>Dealer Order details</span>

            </a>
        </li>
        <li>
            <a href="{{route('my.order')}}">

                <i class="feather feather-check-square"></i>
                <span>My Order deatils</span>
            </a>
        </li>

    </ul>
</li>


<li>
    <a href="javascript:void(0)" aria-expanded="true">
        <i class="fa fa-rupee"></i>
        <span>Collection </span>

        <span class="float-right arrow"><i class="ion ion-chevron-down"></i></span>
    </a>
    <ul class="submenu">



        <li>
            <a href="{{route('amount.collect.group.master')}}">

                <i class="feather feather-check-square"></i>
                <span>Dealer Collection</span>
            </a>
        </li>
        <li>
            <a href="{{route('my.amount.collect.group.master')}}">

                <i class="feather feather-check-square"></i>
                <span>Paid</span>
            </a>
        </li>

    </ul>
</li>



@endif
