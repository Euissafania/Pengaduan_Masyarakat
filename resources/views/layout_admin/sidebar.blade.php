<!--sidebar wrapper -->
<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('assets/images/logo-icon.png')}}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Civic Pulse</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
       
        <li class="menu-label"> Menu Admin </li>
        <li>
            <a href="{{ url('/dashboard_admin') }}">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        <li>
            <a href="{{ url('/data_pengaduan') }}">
                <div class="parent-icon"><i class="bi bi-list-task"></i>
                </div>
                <div class="menu-title">Data Pengaduan</div>
            </a>
        </li>
        <li>
            <a href="{{ url('/data_user') }}">
                <div class="parent-icon"><i class="bi bi-person-lines-fill"></i>
                </div>
                <div class="menu-title">Data User</div>
            </a>
        </li>      
        <li class="mt-5">
            <a href="{{ url('/logout') }}">
                <div class="parent-icon"><i class="bi bi-box-arrow-left"></i>
                </div>
                <div class="menu-title">Logout</div>
            </a>
        </li>
    </ul>
    
</div>
<!--end sidebar wrapper -->