
<?php $__env->startSection('content'); ?>
<div class="card card-info col-sm-12 p-0">
    <div class="card-header">
        <h3 class="card-title">Kelola Data Karyawan</h3>
    </div>
</div>
<?php echo $__env->make('layouts.alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section class="container">
    <div class="container-fluid">
        <div class="row justify-content-between">

            <a href="<?php echo e(route('kelola.daftar')); ?>" class="btn btn-success">
                <i class="fas fa-plus-square"></i>
                Tambah Karyawan Baru</a>

            <!-- <a href="<?php echo e(route('kelola.trashed')); ?>" class="btn btn-danger">
                <i class="fas fa-file"></i>
                Data Karyawan Terhapus</a> -->

        </div>
        <hr>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><strong>Daftar Karyawan</strong></h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">

                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>NIK</th>
                                    <th>Jabatan</th>
                                    <th>Divisi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($user['name']); ?></td>
                                    <td><?php echo e($user['nik']); ?></td>
                                    <td><?php echo e($user['role']['nama']); ?></td>
                                    <td><?php echo e($user['divisi']['nama']); ?></td>
                                    <td>
                                        <a href="/anggota/<?php echo e($user['nik']); ?>/edit" class="btn btn-sm btn-info">ubah</a>
                                    </td>


                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main',['title' => 'Kelola Karyawan'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ASUS\OneDrive\Documents\GitHub\Laravel\HRIS-Kopma\resources\views/user/indexpengurus.blade.php ENDPATH**/ ?>