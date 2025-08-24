<li class="menu-title">MAIN</li>


<li>
    <a href="{{route('warehouse.dashboard')}}">

        <i class="feather feather-grid"></i>
        <span> Dashboard</span>
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
            <a href="{{route('stock')}}">
                <i class="feather feather-check-square"></i>
                <span>Stock</span>
            </a>
        </li>
          <li>
              <a href="{{route('stockreport')}}">
                  <i class="feather feather-check-square"></i>
                  <span>Stock Report</span>
              </a>
          </li>

        <li>
            <a href="{{route('serial.no.master')}}">
                <i class="feather feather-check-square"></i>
                <span>Purchase</span>
            </a>
        </li>


        <li>
            <a href="{{route('transfer.serial.no.master')}}">
                <i class="feather feather-check-square"></i>
                <span>Transfer</span>
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
            <a href="{{route('disinvoice')}}">
                <i class="feather feather-check-square"></i>
                <span>Direct partner invoice</span>
            </a>
        </li>
        <li>
            <a href="{{route('disinvoice.master')}}">
                <i class="feather feather-check-square"></i>
                <span>Manage Invoice</span>
            </a>
        </li>

        <li>
            <a href="{{route('warehouse.invoice')}}">
                <i class="feather feather-check-square"></i>
                <span>Warehouse invoice</span>
            </a>
        </li>

        <li>
            <a href="{{route('delivery.note')}}">
                <i class="feather feather-check-square"></i>
                <span>Warehouse Delivery Note</span>
            </a>
        </li>

    </ul>
</li>
<li>
    <a href="{{route('order')}}">
        <i class="fa fa-shopping-cart"></i>
        <span>Orders</span>
    </a>
</li>
