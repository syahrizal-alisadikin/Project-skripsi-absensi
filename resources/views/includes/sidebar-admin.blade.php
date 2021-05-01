<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link {{ (request()->is('admin/admin*')) ? 'active' : '' }}" href="{{ route('admin.index') }}">
                    Dashboard
                </a>
                 <a class="nav-link {{ (request()->is('admin/kelas*')) ? 'active' : '' }}" href="{{ route('kelas.index') }}">
                    Data Kelas
                </a>
                <a class="nav-link {{ (request()->is('admin/dosen*')) ? 'active' : '' }}" href="{{ route('dosen.index') }}">
                   Data Dosen
                </a>
                <a class="nav-link {{ (request()->is('admin/mahasiswa*')) ? 'active' : '' }}" href="{{ route('mahasiswa.index') }}">
                   Mahasiswa
                </a>
                <a class="nav-link {{ (request()->is('admin/semester*')) ? 'active' : '' }}" href="{{ route('semester.index') }}">
                    Semester
                </a>
                <a class="nav-link {{ (request()->is('admin/jurusan*')) ? 'active' : '' }}" href="{{ route('jurusan.index') }}">
                    Jurusan
                </a>
                <a class="nav-link {{ (request()->is('admin/matkul*')) ? 'active' : '' }}" href="{{ route('matkul.index') }}">
                    Matakuliah
                </a>
                <a class="nav-link {{ (request()->is('admin/absen*')) ? 'active' : '' }}" href="{{ route('absen.index') }}">
                    Laporan Absen
                </a>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            Start Bootstrap
        </div>
    </nav>
    </div>