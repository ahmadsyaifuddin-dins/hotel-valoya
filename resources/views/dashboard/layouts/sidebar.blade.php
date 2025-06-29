<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
  <div class="position-sticky pt-3 sidebar-sticky">
    @can('admin')
    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1">
      <span>Administrator</span>
    </h6>
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link {{ Request::is('admin') ? 'active' : '' }}" aria-current="page" href="/admin">
          <span data-feather="home" class="align-text-bottom"></span>
          Dashboard
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('admin/fasilitas-kamar*') ? 'active' : '' }}" href="/admin/fasilitas-kamar">
          <span data-feather="list" class="align-text-bottom"></span>
          Fasilitas Kamar
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('admin/tipe-kamar*') ? 'active' : '' }}" href="/admin/tipe-kamar">
          <span data-feather="list" class="align-text-bottom"></span>
          Tipe Kamar
        </a>
      </li>

    </ul>
    @endcan

    @can('resepsionis')
    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1">
      <span>Resepsionis</span>
    </h6>
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link {{ Request::is('resepsionis*') ? 'active' : '' }}" aria-current="page" href="/resepsionis">
          <span data-feather="grid" class="align-text-bottom"></span>
          Booking List
        </a>
      </li>
    </ul>
    @endcan

    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1">
      <span>Laporan</span>
    </h6>
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link {{ Request::is('laporan*') ? 'active' : '' }}" href="/laporan">
          <span data-feather="file-text" class="align-text-bottom"></span>
          Laporan Transaksi
        </a>
      </li>
    </ul>
  </div>
</nav>