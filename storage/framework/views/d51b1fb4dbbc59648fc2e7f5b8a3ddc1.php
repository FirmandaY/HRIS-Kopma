
<?php $__env->startSection('title','Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="card card-info col-sm-12 p-0">
    <div class="card-header">
        <h3 class="card-title">Dashboard</h3>
    </div>
</div>

<div class="container">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3><?php echo e($cuti); ?></h3>
                        <p>Rekap Data Cuti</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-book"></i>
                    </div>
                    <a href="<?php echo e(route('rekap.cuti', ['year' => now()->year])); ?>" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col">
                <!-- small box -->
                <div class="small-box bg-teal">
                    <div class="inner">
                        <h3><?php echo e($izin); ?></h3>
                        <p>Rekap Data Izin</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <a href="<?php echo e(route('rekap.izin', ['year' => now()->year])); ?>" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('isAdmin')): ?>
            <div class="col">
                <!-- small box -->
                <div class="small-box bg-teal">
                    <div class="inner">
                        <h3><?php echo e($pinjam); ?></h3>
                        <p>Rekap Data Peminjaman</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-hand-holding-usd"></i>
                    </div>
                    <a href="<?php echo e(route('rekap.pinjam', ['year' => now()->year])); ?>" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <?php endif; ?>
            
        </div>
        <div class="row">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('isAdmin')): ?>
                <div class="col">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?php echo e(count($usersKaryawan)); ?></h3>
                            <p>Kelola Data Karyawan</p>
                        </div>
                        <div class="icon">
                            <i class="far fa-id-card"></i>
                        </div>
                        <a href="<?php echo e(route('kelola.index')); ?>" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
                    </div>

                </div>

                <div class="col">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?php echo e(count($usersPengurus)); ?></h3>
                            <p>Kelola Data Pengurus</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-id-card"></i>
                        </div>
                        <a href="<?php echo e(route('kelola.indexPengurus')); ?>" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
                    </div>

                </div>
            <?php endif; ?>
                
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('isAdminkeu')): ?>
                <div class="col">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>
                                + <?php echo e(count($new_pengajuan)); ?>

                                <?php if( count($new_pengajuan) > 0): ?>
                                    <a href="<?php echo e(route('pengajuan.adminkeu')); ?>">
                                        <i style='
                                            font-size:16px; 
                                            margin-left: 5px;
                                            padding: 0px 12px; 
                                            border-radius:8px; 
                                            background-color:rgb(0, 87, 128); 
                                            color:rgb(255, 255, 255);
                                        '>Baru</i>
                                    </a>
                                    
                                <?php endif; ?>
                            </h3>
                            <p>Pengajuan Anggaran Bidang</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-file-invoice-dollar"></i>
                        </div>
                        <a href="<?php echo e(route('rekap.pengajuanAnggaran', ['year' => now()->year])); ?>" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
                    </div>

                </div>

                <div class="col">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>
                                + <?php echo e(count($new_realisasi)); ?>

                                <?php if( count($new_realisasi) > 0): ?>
                                    <i style='
                                        font-size:16px; 
                                        margin-left: 5px;
                                        padding: 0px 12px; 
                                        border-radius:8px; 
                                        background-color:rgb(0, 87, 128); 
                                        color:white;
                                    '>Baru</i>
                                <?php endif; ?>
                            </h3>
                            <p>Realisasi Anggaran Bidang</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-file-invoice"></i>
                        </div>
                        <a href="<?php echo e(route('rekap.realisasiAnggaran', ['year' => now()->year])); ?>" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
                    </div>

                </div>
            <?php endif; ?>

        </div>
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><strong>Daftar Staff dan Karyawan Cuti Hari ini</strong></h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <?php if(count($isCuti)): ?>
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Divisi</th>
                                    <th>Tanggal Selesai</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $isCuti; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $iscuti): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($iscuti->name); ?></td>
                                    <td><?php echo e($iscuti->nama); ?></td>
                                    <td><?php echo e(\Carbon\Carbon::parse($iscuti->tgl_selesai)->format('d/m/Y')); ?></td>

                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                            <?php else: ?>
                            <tr>
                                <td>Tidak ada</td>
                            </tr>
                            <?php endif; ?>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><strong>Daftar Karyawan Izin Hari ini</strong></h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <?php if(count($isIzin)): ?>
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>NIK</th>
                                    <th>Divisi</th>
                                    <th>Waktu</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $isIzin; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $isizin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($isizin->name); ?></td>
                                    <td><?php echo e($isizin->nik); ?></td>
                                    <td><?php echo e($isizin->nama); ?></td>
                                    <td><?php echo e($isizin->wkt_mulai); ?>.00 - <?php echo e($isizin->wkt_selesai); ?>.00</td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                            <?php else: ?>
                            <tr>
                                <td>Tidak ada</td>
                            </tr>
                            <?php endif; ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main',['title' => 'Dashboard'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ASUS\OneDrive\Documents\GitHub\HRIS-Kopma\resources\views/dashboard.blade.php ENDPATH**/ ?>