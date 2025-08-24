        <li class="menu-title">MAIN</li>


        <li>
            <a href="{{route('hr.dashboard')}}">
                <i class="feather feather-grid"></i>
                <span> Dashboard</span>
            </a>
        </li>

        <li>
            <a href="{{route('employee.master')}}">
                <i class="fa fa-users"></i>
                <span> Employee Management</span>
            </a>
        </li>
         <li>
             <a href="{{route('regional.master')}}">
                 <i class="fa fa-users"></i>
                 <span>Regional Head</span>
             </a>
         </li>

          <li>
              <a href="{{route('asm.master')}}">
                  <i class="fa fa-users"></i>
                  <span> ASM</span>
              </a>
          </li>

           <li>
               <a href="{{route('promoter.master')}}">
                   <i class="fa fa-users"></i>
                   <span>Brand Promoter</span>
               </a>
           </li>


        <li>
            <a href="javascript:void(0)" aria-expanded="true">
                <i class="fa fa-store-alt"></i>
                <span>Attendance</span>
                <span class="float-right arrow"><i class="ion ion-chevron-down"></i></span>
            </a>
            <ul class="submenu">
                <li>
                    <a href="{{route('attendance.day.report')}}">
                        <i class="feather feather-check-square"></i>
                        <span>Day Wise Reports</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('attendance.month.report')}}">
                        <i class="feather feather-check-square"></i>
                        <span>Monthly Wise Reports</span>
                    </a>
                </li>

            </ul>
        </li>
