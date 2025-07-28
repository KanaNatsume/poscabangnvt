<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>PRENEUR OFFICIAL</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('header')
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('assets') }}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets') }}/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/summernote/summernote-bs4.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/toastr/toastr.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />

    <!-- jQuery -->
    <script src="{{ asset('assets') }}/plugins/jquery/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"
        integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <!-- Select2 -->
    <script src="{{ asset('assets') }}/plugins/select2/js/select2.full.min.js"></script>
</head>

<body class="hold-transition sidebar-mini layout-fixed text-sm sidebar-collapse">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        {{ auth()->user()->email }}
                        <i class="fas fa-angle-down right"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="/logout" class="dropdown-item">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </a>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar elevation-4 sidebar-light-primary">
            <!-- Brand Logo -->
            <a href="/dashboard" class="brand-link">
                <img src="{{ asset('assets') }}/dist/img/preneur.png" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">PRENEUR</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('photo/' . auth()->user()->photo) }}" class="img-circle elevation-2"
                            alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ auth()->user()->name }}</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="/dashboard"
                                class="nav-link {{ request()->segment(1) == 'dashboard' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        @if (auth()->user()->role == 'kasir')
                            <li class="nav-item">
                                <a href="/pelanggan"
                                    class="nav-link {{ request()->segment(1) == 'pelanggan' ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>Data Pelanggan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/penjualan/{{ no_invoice() }}"
                                    class="nav-link {{ request()->segment(1) == 'penjualan' ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-chart-bar"></i>
                                    <p>
                                        penjualan
                                    </p>
                                </a>
                            </li>
                            <li
                                class="nav-item has-treeview {{ request()->segment(2) == 'penjualan_harian' || request()->segment(2) == 'penjualan_minggu_atau_bulan' || request()->segment(2) == 'keuntungan_harian' || request()->segment(2) == 'keuntungan_minggu_atau_bulan' || request()->segment(2) == 'pembelian' || request()->segment(2) == 'retur' || request()->segment(2) == 'hutang' || request()->segment(2) == 'pengeluaran' || request()->segment(2) == 'keuangan' || request()->segment(2) == 'stok_barang' || request()->segment(2) == 'produk_terjual' ? 'menu-open' : '' }}">
                                <a href="#"
                                    class="nav-link {{ request()->segment(2) == 'penjualan_harian' || request()->segment(2) == 'penjualan_minggu_atau_bulan' || request()->segment(2) == 'keuntungan_harian' || request()->segment(2) == 'keuntungan_minggu_atau_bulan' || request()->segment(2) == 'pembelian' || request()->segment(2) == 'retur' || request()->segment(2) == 'hutang' || request()->segment(2) == 'pengeluaran' || request()->segment(2) == 'keuangan' || request()->segment(2) == 'stok_barang' || request()->segment(2) == 'produk_terjual' ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-chart-pie"></i>
                                    <p>
                                        Laporan
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview"
                                    style="display:{{ request()->segment(2) == 'penjualan_harian' || request()->segment(2) == 'penjualan_minggu_atau_bulan' || request()->segment(2) == 'keuntungan_harian' || request()->segment(2) == 'keuntungan_minggu_atau_bulan' || request()->segment(2) == 'pembelian' || request()->segment(2) == 'retur' || request()->segment(2) == 'hutang' || request()->segment(2) == 'pengeluaran' || request()->segment(2) == 'keuangan' || request()->segment(2) == 'stok_barang' || request()->segment(2) == 'produk_terjual' ? 'block' : 'none' }}">
                                    <li class="nav-item">
                                        <a href="/laporan/penjualan_harian"
                                            class="nav-link {{ request()->segment(2) == 'penjualan_harian' ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Penjualan Harian</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/laporan/penjualan_minggu_atau_bulan"
                                            class="nav-link {{ request()->segment(2) == 'penjualan_minggu_atau_bulan' ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Penjualan Minggu/Bulan</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/laporan/keuntungan_harian"
                                            class="nav-link {{ request()->segment(2) == 'keuntungan_harian' ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Keuntungan Harian</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/laporan/keuntungan_minggu_atau_bulan"
                                            class="nav-link {{ request()->segment(2) == 'keuntungan_minggu_atau_bulan' ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Keuntungan Minggu/Bulan</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/laporan/pembelian"
                                            class="nav-link {{ request()->segment(2) == 'pembelian' ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Pembelian</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/laporan/retur"
                                            class="nav-link {{ request()->segment(2) == 'retur' ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Retur Barang</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/laporan/hutang"
                                            class="nav-link {{ request()->segment(2) == 'hutang' ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Hutang</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/laporan/pengeluaran"
                                            class="nav-link {{ request()->segment(2) == 'pengeluaran' ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Pengeluaran</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/laporan/keuangan"
                                            class="nav-link {{ request()->segment(2) == 'keuangan' ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Keuangan</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/laporan/stok_barang"
                                            class="nav-link {{ request()->segment(2) == 'stok_barang' ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Stok Barang</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/laporan/produk_terjual"
                                            class="nav-link {{ request()->segment(2) == 'produk_terjual' ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Produk Terjual</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                        @if (auth()->user()->role == 'admin')
                            <li
                                class="nav-item has-treeview {{ request()->segment(1) == 'supplier' || request()->segment(1) == 'kategori' || request()->segment(1) == 'pelanggan' ? 'menu-open' : '' }}">
                                <a href="#"
                                    class="nav-link {{ request()->segment(1) == 'supplier' || request()->segment(1) == 'kategori' || request()->segment(1) == 'pelanggan' ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-list-alt"></i>
                                    <p>
                                        Data Master
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview"
                                    style="display:{{ request()->segment(1) == 'supplier' || request()->segment(1) == 'kategori' || request()->segment(1) == 'pelanggan' ? 'block' : 'none' }}">
                                    <li class="nav-item">
                                        <a href="/supplier"
                                            class="nav-link {{ request()->segment(1) == 'supplier' ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Supplier</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/kategori"
                                            class="nav-link {{ request()->segment(1) == 'kategori' ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Kategori</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/pelanggan"
                                            class="nav-link {{ request()->segment(1) == 'pelanggan' ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Pelanggan</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li
                                class="nav-item has-treeview {{ request()->segment(1) == 'barang' || request()->segment(1) == 'pembelian' || request()->segment(1) == 'keluar' ? 'menu-open' : '' }}">
                                <a href="#"
                                    class="nav-link {{ request()->segment(1) == 'barang' || request()->segment(1) == 'pembelian' || request()->segment(1) == 'keluar' ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-clipboard-list"></i>
                                    <p>
                                        Data Barang
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview"
                                    style="display:{{ request()->segment(1) == 'barang' || request()->segment(1) == 'pembelian' || request()->segment(1) == 'keluar' ? 'block' : 'none' }}">
                                    <li class="nav-item">
                                        <a href="/barang"
                                            class="nav-link {{ request()->segment(1) == 'barang' ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Barang</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/pembelian"
                                            class="nav-link {{ request()->segment(1) == 'pembelian' ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Masuk</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/keluar"
                                            class="nav-link {{ request()->segment(1) == 'keluar' ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Keluar</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="/user"
                                    class="nav-link {{ request()->segment(1) == 'user' ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>
                                        User
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/penjualan/{{ no_invoice() }}"
                                    class="nav-link {{ request()->segment(1) == 'penjualan' ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-chart-bar"></i>
                                    <p>
                                        penjualan
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/hutang"
                                    class="nav-link {{ request()->segment(1) == 'hutang' ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-credit-card"></i>
                                    <p>
                                        Hutang/Piutang
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/retur"
                                    class="nav-link {{ request()->segment(1) == 'retur' ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-exchange-alt"></i>
                                    <p>
                                        Retur Barang
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/pengeluaran"
                                    class="nav-link {{ request()->segment(1) == 'pengeluaran' ? 'active' : '' }}">
                                    <i class="nav-icon far fa-calendar-alt"></i>
                                    <p>
                                        Pengeluaran
                                    </p>
                                </a>
                            </li>
                            {{-- <li class="nav-item">
                            <a href="/transfer"
                                class="nav-link {{ request()->segment(1) == 'transfer' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-indent"></i>
                        <p>
                            Transfer
                        </p>
                        </a>
                        </li> --}}
                            <li
                                class="nav-item has-treeview {{ request()->segment(2) == 'penjualan_harian' || request()->segment(2) == 'penjualan_minggu_atau_bulan' || request()->segment(2) == 'keuntungan_harian' || request()->segment(2) == 'keuntungan_minggu_atau_bulan' || request()->segment(2) == 'pembelian' || request()->segment(2) == 'retur' || request()->segment(2) == 'hutang' || request()->segment(2) == 'pengeluaran' || request()->segment(2) == 'keuangan' || request()->segment(2) == 'stok_barang' || request()->segment(2) == 'produk_terjual' ? 'menu-open' : '' }}">
                                <a href="#"
                                    class="nav-link {{ request()->segment(2) == 'penjualan_harian' || request()->segment(2) == 'penjualan_minggu_atau_bulan' || request()->segment(2) == 'keuntungan_harian' || request()->segment(2) == 'keuntungan_minggu_atau_bulan' || request()->segment(2) == 'pembelian' || request()->segment(2) == 'retur' || request()->segment(2) == 'hutang' || request()->segment(2) == 'pengeluaran' || request()->segment(2) == 'keuangan' || request()->segment(2) == 'stok_barang' || request()->segment(2) == 'produk_terjual' ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-chart-pie"></i>
                                    <p>
                                        Laporan
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview"
                                    style="display:{{ request()->segment(2) == 'penjualan_harian' || request()->segment(2) == 'penjualan_minggu_atau_bulan' || request()->segment(2) == 'keuntungan_harian' || request()->segment(2) == 'keuntungan_minggu_atau_bulan' || request()->segment(2) == 'pembelian' || request()->segment(2) == 'retur' || request()->segment(2) == 'hutang' || request()->segment(2) == 'pengeluaran' || request()->segment(2) == 'keuangan' || request()->segment(2) == 'stok_barang' || request()->segment(2) == 'produk_terjual' ? 'block' : 'none' }}">
                                    <li class="nav-item">
                                        <a href="/laporan/penjualan_harian"
                                            class="nav-link {{ request()->segment(2) == 'penjualan_harian' ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Penjualan Harian</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/laporan/penjualan_minggu_atau_bulan"
                                            class="nav-link {{ request()->segment(2) == 'penjualan_minggu_atau_bulan' ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Penjualan Minggu/Bulan</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/laporan/keuntungan_harian"
                                            class="nav-link {{ request()->segment(2) == 'keuntungan_harian' ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Keuntungan Harian</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/laporan/keuntungan_minggu_atau_bulan"
                                            class="nav-link {{ request()->segment(2) == 'keuntungan_minggu_atau_bulan' ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Keuntungan Minggu/Bulan</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/laporan/pembelian"
                                            class="nav-link {{ request()->segment(2) == 'pembelian' ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Pembelian</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/laporan/retur"
                                            class="nav-link {{ request()->segment(2) == 'retur' ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Retur Barang</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/laporan/hutang"
                                            class="nav-link {{ request()->segment(2) == 'hutang' ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Hutang</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/laporan/pengeluaran"
                                            class="nav-link {{ request()->segment(2) == 'pengeluaran' ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Pengeluaran</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/laporan/keuangan"
                                            class="nav-link {{ request()->segment(2) == 'keuangan' ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Keuangan</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/laporan/stok_barang"
                                            class="nav-link {{ request()->segment(2) == 'stok_barang' ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Stok Barang</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/laporan/produk_terjual"
                                            class="nav-link {{ request()->segment(2) == 'produk_terjual' ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Produk Terjual</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a href="/profile"
                                class="nav-link {{ request()->segment(1) == 'profile' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-image"></i>
                                <p>
                                    Profile
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/logout" class="nav-link">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>
                                    Logout
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        @yield('konten')
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>PRENEUR &copy; <span id="copyright-year"></span></strong>
        </footer>
    </div>

    <script>
        document.getElementById("copyright-year").textContent = new Date().getFullYear();
    </script>
    <!-- ./wrapper -->


    <!-- jQuery UI 1.11.4 -->
    {{-- <script src="{{ asset('assets') }}/plugins/jquery-ui/jquery-ui.min.js"></script> --}}
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    {{-- <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script> --}}
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="{{ asset('assets') }}/plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="{{ asset('assets') }}/plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="{{ asset('assets') }}/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('assets') }}/plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('assets') }}/plugins/moment/moment.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('assets') }}/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="{{ asset('assets') }}/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('assets') }}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets') }}/dist/js/adminlte.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('assets') }}/dist/js/pages/dashboard.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('assets') }}/dist/js/demo.js"></script>
    <!-- DataTables -->
    <script src="{{ asset('assets') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('assets') }}/plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- Toastr -->
    <script src="{{ asset('assets') }}/plugins/toastr/toastr.min.js"></script>
    <!-- page script -->
    @yield('footer')
    <script>
        $(function() {
            $("#datatable").DataTable({
                "responsive": true,
                "autoWidth": false,
            });
        });
    </script>


</body>

</html>
