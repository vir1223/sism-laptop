<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="@if (Auth::check() && Auth::user()->role == 'admin') 
                {{route('admin.dashboard')}}
        @elseif (Auth::check() && Auth::user()->role == 'guru') 
            {{route('guru.dashboard');}}    
        @elseif (Auth::check() && Auth::user()->role == 'murid') 
            {{route('murid.dashboard');}}
        @else 
            {{route('login');}}
        @endif">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SISM Laptop</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="
        @if (Auth::check() && Auth::user()->role == 'admin') 
                {{route('admin.dashboard')}}
        @elseif (Auth::check() && Auth::user()->role == 'guru') 
            {{route('guru.dashboard');}}    
        @elseif (Auth::check() && Auth::user()->role == 'murid') 
            {{route('murid.dashboard');}}
        @else 
            {{route('login');}}
        @endif
        ">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

     <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Crud
    </div>

    <!-- Nav Item - Akun -->
     <li class="nav-item">
        <a class="nav-link" href="{{route('account.index')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Akun</span></a>
    </li>

    <!-- Nav Item - Izin -->
     <li class="nav-item">
        <a class="nav-link" href="{{ route('perizinan.create') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Izin</span></a>
    </li>
    


    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Data
    </div>

    <!-- Nav Item - Data Guru -->
     <li class="nav-item">
        <a class="nav-link" href="{{ route('guru.index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Guru</span></a>
    </li>

    <!-- Nav Item - Data Murid -->
     <li class="nav-item">
        <a class="nav-link" href="{{ route('murid.index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Murid</span></a>
    </li>

    
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Report
    </div>

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Report</span></a>
    </li>

    <!-- Nav Item - History -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('history.index') }}">
            <i class="fas fa-fw fa-history"></i>
            <span>History</span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link"
        @if (Auth::check() && Auth::user()->role == 'guru' || Auth::user()->role == 'admin')
        href="{{ route('perizinan.index') }}"

        @else
        href="{{ route('perizinan.all')}}"
        @endif
         >
            <i class="fas fa-fw fa-table"></i>
            <span>Perizinan</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>