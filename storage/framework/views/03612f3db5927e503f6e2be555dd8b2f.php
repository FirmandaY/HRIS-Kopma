
<?php $__env->startSection('content'); ?>
<div class="card card-info col-sm-12 p-0">
    <div class="card-header">
        <h3 class="card-title">Kelola Data Pengurus / Staff</h3>
    </div>
</div>
<?php echo $__env->make('layouts.alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section class="container">
    <div class="container-fluid">
        <div class="row justify-content-between">

            <a href="<?php echo e(route('kelola.daftarPengurus')); ?>" class="btn btn-success">
                <i class="fas fa-plus-square"></i>
                Tambah Pengurus / Staff Baru</a>

            <!-- <a href="<?php echo e(route('kelola.trashed')); ?>" class="btn btn-danger">
                <i class="fas fa-file"></i>
                Data Pengurus Terhapus</a> -->

        </div>
        <hr>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><strong>Daftar Pengurus / Staff</strong></h3>
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
                                        <!-- PERHATIAN! Saat hosting semua tombol harus di dalam tag <form> dan memiliki <?php echo csrf_field(); ?>-->
                                        <!-- PERHATIAN! Jika tidak maka, halaman akan 404 not found!-->

                                        <form action="<?php echo e(route('kelola.edit', $user->nik)); ?>" method="get">
                                            <?php echo csrf_field(); ?>
                                            <button class="btn btn-warning" onClick="return confirm ('Yakin mau diubah?')"
                                            style="padding-right:20px; padding-left:20px; margin-top:5px;"> 
                                                <i class="fa fa-pencil"></i>Ubah 
                                            </button>
                                        </form>
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
<?php echo $__env->make('layouts.main',['title' => 'Kelola Pengurus'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ASUS\OneDrive\Documents\GitHub\Laravel\HRIS-Kopma\resources\views/user/indexPengurus.blade.php ENDPATH**/ ?>