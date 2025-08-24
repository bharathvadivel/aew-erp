        <li class="menu-title">MAIN</li>


        <li>
            <a href="{{route('accounts.dashboard')}}">
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
                <i class="fa fa-line-chart"></i>
                <span>Sales</span>
                <span class="float-right arrow"><i class="ion ion-chevron-down"></i></span>
            </a>
            <ul class="submenu">

                <li>
                    <a href="{{route('disinvoice.master')}}">
                        <i class="feather feather-check-square"></i>
                        <span>Manage Invoice</span>
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
                    <a href="{{route('add.collection.amount')}}">
                        <i class="feather feather-check-square"></i>
                        <span>Add collection</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('amount.collect.group.master')}}">
                        <i class="feather feather-check-square"></i>
                        <span>Collection List</span>
                    </a>
                </li>

            </ul>
        </li>



        <li>
            <a href="javascript:void(0)" aria-expanded="true">
                <i class="fa fa-store-alt"></i>
                <span>Spare Inventory</span>
                <span class="float-right arrow"><i class="ion ion-chevron-down"></i></span>
            </a>
            <ul class="submenu">
                <li><a href="{{route('view.spareparts.category')}}"><i class="ion-ios-folder-outline"></i><span>Spare Parts Category</span></a>
                </li>
                <li><a href="{{route('part.code.master')}}"><i class="ion-ios-folder-outline"></i><span>Spare Parts Master</span></a>
                </li>
                <li><a href="{{route('view.spareparts')}}"><i class="ion-ios-folder-outline"></i><span>Spare Parts Inventory</span></a>
                </li>
                <li><a href="{{route('enquiry.master.return')}}"><i class="ion-ios-folder-outline"></i><span>Spare Parts Return</span></a>
                </li>

            </ul>
        </li>

