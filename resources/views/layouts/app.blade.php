<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard Sarpras</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    :root {
      --primary-bg: #1b1a27;
      --hover-bg: #2a283a;
      --content-bg: #f8f9fa;
      --text-light: #f0f0f0;
      --text-dark: #333333;
      --accent: #ffc107;
      --border-radius: 12px;
      --transition: all 0.3s ease;
    }

    body {
      background-color: var(--primary-bg);
      font-family: 'Inter', 'Segoe UI', sans-serif;
      margin: 0;
      color: var(--text-dark);
      min-height: 100vh;
    }

    .sidebar {
      background-color: var(--primary-bg);
      color: var(--text-light);
      height: 100vh;
      padding: 1.5rem;
      position: fixed;
      box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
      transition: var(--transition);
      overflow-y: auto;
    }

    .sidebar-brand {
      padding: 0.5rem 1rem;
      margin-bottom: 2rem;
    }

    .sidebar h5 {
      color: var(--accent);
      font-weight: 600;
      font-size: 1.25rem;
      letter-spacing: 0.5px;
      margin-bottom: 1.5rem;
    }

    .sidebar .nav-link {
      color: var(--text-light);
      padding: 0.8rem 1rem;
      border-radius: var(--border-radius);
      transition: var(--transition);
      font-size: 0.95rem;
      margin-bottom: 0.5rem;
      display: flex;
      align-items: center;
    }

    .sidebar .nav-link:hover,
    .sidebar .nav-link.active {
      background-color: var(--hover-bg);
      color: var(--accent);
      transform: translateX(5px);
    }

    .nav-icon {
      margin-right: 12px;
      font-size: 1.1rem;
    }

    .submenu {
      padding-left: 2.5rem;
      display: none;
    }

    .submenu.show {
      display: block;
    }

    .submenu .nav-link {
      font-size: 0.9rem;
      padding: 0.6rem 1rem;
    }

    .nav-item.has-submenu > .nav-link::after {
      content: '\F282';
      font-family: 'bootstrap-icons';
      margin-left: auto;
      transition: transform 0.3s;
    }

    .nav-item.has-submenu.open > .nav-link::after {
      transform: rotate(90deg);
    }

    .topbar {
      background-color: var(--primary-bg);
      color: var(--text-light);
      padding: 1rem 2rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-bottom: 1px solid var(--hover-bg);
    }

    .search-box {
      position: relative;
      max-width: 300px;
    }

    .search-box input {
      width: 100%;
      background-color: var(--hover-bg);
      border: 1px solid transparent;
      padding: 0.6rem 1rem 0.6rem 2.5rem;
      border-radius: var(--border-radius);
      color: var(--text-light);
      transition: var(--transition);
    }

    .search-box input:focus {
      border-color: var(--accent);
      outline: none;
    }

    .search-box i {
      position: absolute;
      left: 0.8rem;
      top: 50%;
      transform: translateY(-50%);
      color: var(--text-light);
    }

    .user-menu .btn {
      background-color: var(--hover-bg);
      border: none;
      padding: 0.6rem 1.2rem;
      border-radius: var(--border-radius);
      color: var(--text-light);
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .user-menu .btn:hover {
      background-color: #383657;
    }

    .dropdown-menu {
      background-color: var(--hover-bg);
      border: none;
      border-radius: var(--border-radius);
      padding: 0.5rem;
      min-width: 200px;
      margin-top: 0.5rem;
    }

    .dropdown-item {
      color: var(--text-light);
      padding: 0.7rem 1rem;
      border-radius: 6px;
      transition: var(--transition);
    }

    .dropdown-item:hover {
      background-color: #383657;
      color: var(--accent);
    }

    .content-area {
      background-color: var(--content-bg);
      padding: 2rem;
      border-radius: var(--border-radius);
      min-height: calc(100vh - 100px);
      margin: 1.5rem;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
    }

    .content-area h3 {
      color: var(--text-dark);
      font-weight: 600;
      margin-bottom: 1.5rem;
    }

    .content-area p {
      color: #666;
      line-height: 1.6;
    }

    @media (max-width: 768px) {
      .sidebar {
        display: none;
      }

      .content-area {
        margin: 1rem;
        padding: 1.5rem;
      }

      .topbar {
        padding: 1rem;
      }

      .search-box {
        max-width: 200px;
      }
    }
  </style>
</head>
<body>
  <div class="container-fluid">
    <div class="row">
      <nav class="col-md-2 d-none d-md-block sidebar">
        <div class="sidebar-brand text-center">
          <img src="{{ asset('images/LogoTB.png') }}" alt="Logo" width="40">
          <h5>Sarpras</h5>
        </div>
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link {{ request()->is('home') ? 'active' : '' }}" href="{{ route('home') }}">
              <i class="bi bi-house-door nav-icon"></i> <span>Dashboard</span>
            </a>
          </li>

          <li class="nav-item has-submenu {{ request()->is('data_barang*') || request()->is('kategori_barang*') ? 'open' : '' }}">
            <a class="nav-link" href="#">
              <i class="bi bi-database nav-icon"></i> <span>Barang</span>
            </a>
            <ul class="submenu {{ request()->is('data_barang*') || request()->is('kategori_barang*') ? 'show' : '' }}">
              <li class="nav-item">
                <a class="nav-link {{ request()->is('data_barang') ? 'active' : '' }}" href="{{ route('data_barang.index') }}">
                  <i class="bi bi-box nav-icon"></i> <span>Data Barang</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ request()->is('kategori_barang') ? 'active' : '' }}" href="{{ route('kategori_barang.index') }}">
                  <i class="bi bi-tags nav-icon"></i> <span>Kategori Barang</span>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-submenu {{ request()->is('peminjaman*') || request()->is('pengembalian*') ? 'open' : '' }}">
            <a class="nav-link" href="#">
              <i class="bi bi-arrow-left-right nav-icon"></i> <span>Transaksi</span>
            </a>
            <ul class="submenu {{ request()->is('peminjaman*') || request()->is('pengembalian*') ? 'show' : '' }}">
              <li class="nav-item">
                <a class="nav-link {{ request()->is('peminjaman') ? 'active' : '' }}" href="{{ route('peminjaman.index') }}">
                  <i class="bi bi-journal-plus nav-icon"></i> <span>Peminjaman</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ request()->is('pengembalian') ? 'active' : '' }}" href="{{ route('pengembalian.index') }}">
                  <i class="bi bi-journal-arrow-down nav-icon"></i> <span>Pengembalian</span>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-submenu {{ request()->is('laporan-barang') || request()->is('laporan-peminjaman') || request()->is('laporan-pengembalian') ? 'open' : '' }}">
            <a class="nav-link" href="#">
              <i class="bi bi-file-earmark-text nav-icon"></i> <span>Laporan</span>
            </a>
            <ul class="submenu {{ request()->is('laporan-barang') || request()->is('laporan-peminjaman') || request()->is('laporan-pengembalian') ? 'show' : '' }}">
              <li class="nav-item">
                <a class="nav-link {{ request()->is('laporan-barang') ? 'active' : '' }}" href="{{ route('laporan.barang') }}">
                  <i class="bi bi-file-earmark-bar-graph nav-icon"></i> <span>Laporan Barang</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ request()->is('laporan-peminjaman') ? 'active' : '' }}" href="{{ route('laporan.peminjaman') }}">
                  <i class="bi bi-file-arrow-up nav-icon"></i> <span>Laporan Peminjaman</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ request()->is('laporan-pengembalian') ? 'active' : '' }}" href="{{ route('laporan.pengembalian') }}">
                  <i class="bi bi-file-arrow-down nav-icon"></i> <span>Laporan Pengembalian</span>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a class="nav-link {{ request()->is('pengguna') ? 'active' : '' }}" href="{{ route('pengguna.index') }}">
              <i class="bi bi-people nav-icon"></i> <span>Pengguna</span>
            </a>
          </li>
        </ul>
      </nav>

      <main class="col-md-10 ms-sm-auto px-md-4">
        <div class="topbar">
          <div class="search-box">
            <i class="bi bi-search"></i>
            <input type="text" placeholder="Telusuri..." class="form-control">
          </div>
          <div class="user-menu dropdown">
            <button class="btn dropdown-toggle" data-bs-toggle="dropdown">
              <i class="bi bi-person-circle"></i> <span>{{ Auth::user()->name }}</span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
              <li>
                <a class="dropdown-item" href="#">
                  <i class="bi bi-person me-2"></i> Profil <span class="me-2">{{ Auth::user()->name }}</span>
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="#">
                  <i class="bi bi-gear me-2"></i> Pengaturan
                </a>
              </li>
              <li><hr class="dropdown-divider"></li>
              <li>
                <form action="{{ route('logout') }}" method="POST">
                  @csrf
                  <button class="dropdown-item text-danger" type="submit">
                    <i class="bi bi-box-arrow-right me-2"></i> Logout <span class="me-2">{{ Auth::user()->name }}</span>
                  </button>
                </form>
              </li>
            </ul>
          </div>
        </div>

        <div class="content-area">
          @yield('content')
        </div>
      </main>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.querySelectorAll('.has-submenu > .nav-link').forEach(item => {
      item.addEventListener('click', event => {
        event.preventDefault();
        const parent = item.parentElement;
        parent.classList.toggle('open');
        const submenu = parent.querySelector('.submenu');
        submenu.classList.toggle('show');
      });
    });
  </script>
</body>
</html>
