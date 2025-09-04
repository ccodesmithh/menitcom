<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Penulis</div>
                <li class="nav-item active">
                    <a class="nav-link" href="{{route('penulis.dashboard')}}">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('penulis.kategori.index')}}">
                        <i class="fas fa-fw fa-chart-area"></i>
                        <span>Kategori</span></a>
                </li>
                <li class="nav-item-active">
                    <a class="nav-link" href="{{route('penulis.berita.index')}}">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Berita</span></a>
                </li>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            {{ Auth::user()->name }}
        </div>
    </nav>
</div>