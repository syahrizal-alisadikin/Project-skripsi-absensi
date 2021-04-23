<!DOCTYPE html>
<html lang="en">
    {{-- style --}}
    @stack('prepend-style')
    @include('includes.styles')
    @stack('addon-style')
    <body class="sb-nav-fixed">
       {{-- Navbar --}}
       @include('includes.navbar')
        <div id="layoutSidenav">
            {{-- SideBar --}}
            @include('includes.sidebar-dosen')
            <div id="layoutSidenav_content">
                {{-- Content --}}
                @yield('content')

                {{-- Footer --}}
                @include('includes.footer')
            </div>
        </div>
      {{-- Script --}}
      @stack('prepend-script')
      @include('includes.script')
      @stack('addon-script')
    </body>
</html>