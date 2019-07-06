<header class="topbar">
    <nav class="navbar top-navbar navbar-toggleable-sm navbar-light">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.html">
                <span style="color: white">Penjualan Admin</span> </a>
        </div>
        <div class="navbar-collapse">
            <ul class="navbar-nav mr-auto mt-md-0">
                <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
            </ul>
            <ul class="navbar-nav my-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Hai <?= $nama; ?></a><a href="<?php echo base_url() ?>index.php/login/log_out" class="link" data-toggle="tooltip" title="Logout" style="color: white;font-size: 18px"><i class="mdi mdi-power"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>

<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li> <a class="waves-effect waves-dark" href="<?php echo base_url() ?>admin" aria-expanded="false"><i class="mdi mdi-gauge"></i><span class="hide-menu">Dashboard</span></a>
                </li>
                <li> <a class="waves-effect waves-dark" href="<?php echo base_url() ?>admin/showProduk" aria-expanded="false"><i class="mdi mdi-book-open-variant"></i><span class="hide-menu">Daftar Produk</span></a>
                </li>
                <li> <a class="waves-effect waves-dark" href="<?php echo base_url() ?>admin/showUser" aria-expanded="false"><i class="mdi mdi-account-check"></i><span class="hide-menu">Daftar Pengguna</span></a>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>