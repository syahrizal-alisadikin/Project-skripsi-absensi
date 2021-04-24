<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link {{ (request()->is('admin/admin*')) ? 'active' : '' }}" href="{{ route('admin.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
               
                
                <div class="sb-sidenav-menu-heading">Addons</div>
                <a class="nav-link {{ (request()->is('admin/semester*')) ? 'active' : '' }}" href="{{ route('semester.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                    Semester
                </a>
                <a class="nav-link {{ (request()->is('admin/jurusan*')) ? 'active' : '' }}" href="{{ route('jurusan.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Jurusan
                </a>
                <a class="nav-link {{ (request()->is('admin/matkul*')) ? 'active' : '' }}" href="{{ route('matkul.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Matakuliah
                </a>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            Start Bootstrap
        </div>
    </nav>
    </div>