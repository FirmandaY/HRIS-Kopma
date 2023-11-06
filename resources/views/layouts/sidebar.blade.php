<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
        <img src="{{ asset('layout/dist/img/kopma-logo.png') }}" alt="KOPMA Logo" style="width: 9em;">
        <!-- <span style="color: #00933E;"><b>Kopma<b></span>
        <span style="color: #00A3EF; margin:0em;">UGM</span> -->
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('layout/dist/img/user.png') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"> {{ Auth::user()->name }}</a>
                <a href="#" class="d-block"> {{ Auth::user()->nik }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item nav-item
                {{request()->is('dashboard') || request()->is('rekap/cuti') ||request()->is('rekap/izin') ?
                     ' menu-is-opening menu-open' : ''}}">
                    <a href="{{route ('dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>

                </li>
                
                <li class="nav-item{{request()->is('cuti') || request()->is('cuti/create') || request()->is('izin') || request()->is('izin/create')  ? ' menu-open' : ''}}">
                    @can('pengajuanMenu')
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-plus-square"></i>
                        <p>
                            Pengajuan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    @endcan
                    
                    <ul class="nav nav-treeview">
                        
                        @can('pengajuanUniversal')
                            <li class="nav-item">
                                <a href="{{route('cuti.index')}}" class="nav-link
                                {{request()->is('cuti') || request()->is('cuti/create') ?
                                ' active' : ''}}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Pengajuan Cuti</p>
                                </a>
                            </li>
                            
                            @can('pengajuan')
                                <li class="nav-item">
                                    <a href="{{ route('izin.index') }}" class="nav-link{{request()->is('izin') || request()->is('izin/create')||request()->is('izin') ? ' active' : ''}}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Pengajuan Izin</p>
                                    </a>
                                </li>
                            @endcan
                            @can('peminjaman')
                                <li class="nav-item">
                                    <a href="{{ route('pinjam.index') }}" class="nav-link{{request()->is('pinjam') || request()->is('pinjam/create')||request()->is('pinjam') ? ' active' : ''}}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Pengajuan Peminjaman</p>
                                    </a>
                                </li>
                            @endcan
                        @endcan

                        @can('pengajuanAnggaran')
                            <li class="nav-item">
                                <a href="{{ route('pengajuan.index') }}" class="nav-link{{request()->is('pengajuan') || request()->is('pengajuan/create')||request()->is('pengajuan') ? ' active' : ''}}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Pengajuan Anggaran</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('realisasi.index') }}" class="nav-link{{request()->is('realisasi') || request()->is('realisasi/create')||request()->is('realisasi') ? ' active' : ''}}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Realisasi Anggaran</p>
                                </a>
                            </li>
                        @endcan
                        <!-- <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Inactive Page</p>
                            </a>
                        </li> -->
                    </ul>
                    
                </li>
               

                
                <li class="nav-item{{request()->is('cuti/admin') ||  request()->is('izin/admin')   ? ' menu-open' : ''}}">
                    @can('persetujuanMenu')
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-check-square"></i>
                            <p>
                                Persetujuan
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                    @endcan
                    <ul class="nav nav-treeview">
                        @can('persetujuan')
                            <li class="nav-item">
                                <a href="{{route('cuti.admin')}}" class="nav-link{{request()->is('cuti/admin') ? ' active' : ''}}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Persetujuan Cuti</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('izin.admin') }}" class="nav-link{{request()->is('izin/admin') ? ' active' : ''}}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Persetujuan Izin</p>
                                </a>
                            </li>
                        @endcan
                        @can('persetujuanPinjam')
                            <li class="nav-item">
                                <a href="{{ route('pinjam.admin') }}" class="nav-link{{request()->is('pinjam/admin') ? ' active' : ''}}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Persetujuan Peminjaman</p>
                                </a>
                            </li>
                        @endcan

                        @can('persetujuanAnggaran')
                            <li class="nav-item">
                                <a href="{{ route('pengajuan.adminkeu') }}" class="nav-link{{request()->is('pengajuan/admin') ? ' active' : ''}}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Pengajuan Anggaran</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('pengajuan.adminkeu') }}" class="nav-link{{request()->is('realisasi/admin') ? ' active' : ''}}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Realisasi Anggaran</p>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
                
                <li class="nav-item {{request()->is('profil') ? ' menu-open':''}}">
                    <a href="{{route('profil.show')}}" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Profil
                        </p>
                    </a>
                </li>

                @can('isAdmin')
                    <li class="nav-item{{request()->is('angota') || request()->is('anggota/*') ? ' menu-open':''}}">
                        <a href="{{route('kelola.indexPengurus')}}" class="nav-link">
                            <i class="nav-icon fas fa-user-friends"></i>
                            <p>
                                Kelola Pengurus
                            </p>
                        </a>
                    </li>
                    <li class="nav-item{{request()->is('anggota') || request()->is('anggota/*') ? ' menu-open':''}}">
                        <a href="{{route('kelola.index')}}" class="nav-link">
                            <i class="nav-icon fas fa-user-friends"></i>
                            <p>
                                Kelola Karyawan
                            </p>
                        </a>
                    </li>
                @endcan
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
                    <a href="{{route('logout') }}" class="nav-link " onclick="event.preventDefault();
                         document.getElementById('formLogout').submit()">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            Keluar
                            <i class="right fas fa-angle"></i>
                        </p>
                    </a>
                    <form id="formLogout" action="{{route('logout') }}" method="post">@csrf</form>

                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>