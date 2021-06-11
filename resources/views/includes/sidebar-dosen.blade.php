<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="{{ route('dashboard-dosen') }}">
                    Dashboard
                </a> 
                <a class="nav-link" href="{{ route('matkulDosen.index') }}">
                    Manage Matakuliah
                </a>
                <a class="nav-link" href="{{ route('absensi.index') }}">
                    Manage Absensi
                </a>
                <a class="nav-link" href="{{ route('account') }}">
                    Setting Account
                </a>
                <a class="nav-link" href="{{ route('password') }}">
                    Setting Password
                </a>
               
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            {{ Auth::guard('dosen')->user()->name }}
        </div>
    </nav>
    </div>