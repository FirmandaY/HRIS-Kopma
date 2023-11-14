<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
        <img src="<?php echo e(asset('layout/dist/img/kopma-logo.png')); ?>" alt="KOPMA Logo" style="width: 9em;">
        <!-- <span style="color: #00933E;"><b>Kopma<b></span>
        <span style="color: #00A3EF; margin:0em;">UGM</span> -->
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?php echo e(asset('layout/dist/img/user.png')); ?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"> <?php echo e(Auth::user()->name); ?></a>
                <a href="#" class="d-block"> <?php echo e(Auth::user()->nik); ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item nav-item
                <?php echo e(request()->is('dashboard') || request()->is('rekap/cuti') ||request()->is('rekap/izin') ?
                     ' menu-is-opening menu-open' : ''); ?>">
                    <a href="<?php echo e(route ('dashboard')); ?>" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>

                </li>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('pengajuan')): ?>
                <li class="nav-item
                <?php echo e(request()->is('cuti') || request()->is('cuti/create') || request()->is('izin') || request()->is('izin/create')  ? 
                ' menu-open' : ''); ?>">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-plus-square"></i>
                        <p>
                            Pengajuan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo e(route('cuti.index')); ?>" class="nav-link
                            <?php echo e(request()->is('cuti') || request()->is('cuti/create') ?
                             ' active' : ''); ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pengajuan Cuti</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(route('izin.index')); ?>" class="nav-link<?php echo e(request()->is('izin') || request()->is('izin/create')||request()->is('izin') ? ' active' : ''); ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pengajuan Izin</p>
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Inactive Page</p>
                            </a>
                        </li> -->
                    </ul>
                </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('persetujuan')): ?>
                <li class="nav-item<?php echo e(request()->is('cuti/admin') ||  request()->is('izin/admin')   ? ' menu-open' : ''); ?>">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-check-square"></i>
                        <p>
                            Persetujuan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo e(route('cuti.admin')); ?>" class="nav-link<?php echo e(request()->is('cuti/admin') ? ' active' : ''); ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Persetujuan Cuti</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(route('izin.admin')); ?>" class="nav-link<?php echo e(request()->is('izin/admin') ? ' active' : ''); ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Persetujuan Izin</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php endif; ?>
                <li class="nav-item <?php echo e(request()->is('profil') ? ' menu-open':''); ?>">
                    <a href="<?php echo e(route('profil.show')); ?>" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Profil
                        </p>
                    </a>
                </li>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('isAdmin')): ?>
                <li class="nav-item<?php echo e(request()->is('anggota') || request()->is('anggota/*') ? ' menu-open':''); ?>">
                    <a href="<?php echo e(route('kelola.index')); ?>" class="nav-link">
                        <i class="nav-icon fas fa-user-friends"></i>
                        <p>
                            Kelola Karyawan
                        </p>
                    </a>
                </li>
                <?php endif; ?>
                <!-- <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Simple Link
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li> -->

                <li class="nav-item">
                    <a href="<?php echo e(route('logout')); ?>" class="nav-link " onclick="event.preventDefault();
                         document.getElementById('formLogout').submit()">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            Keluar
                            <i class="right fas fa-angle"></i>
                        </p>
                    </a>
                    <form id="formLogout" action="<?php echo e(route('logout')); ?>" method="post"><?php echo csrf_field(); ?></form>

                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside><?php /**PATH C:\xampp\htdocs\hris\resources\views/layouts/sidebar.blade.php ENDPATH**/ ?>