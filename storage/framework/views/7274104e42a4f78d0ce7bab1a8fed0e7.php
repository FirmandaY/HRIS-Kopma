
<?php $__env->startSection('content'); ?>
<div class="card card-info col-sm-12 p-0">
    <div class="card-header">
        <h1 class="card-title">Daftar Realisasi Anggaran Bidang</h1>
    </div>
</div>
<?php echo $__env->make('layouts.alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="container">

    <div class="container-fluid">
        <div class="callout callout-info col-sm-12 mb-4">
            <h6><b>Informasi</b></h6>

            <p>Seluruh realisasi anggaran dari bidang akan ditampilkan di sini.</p>
        </div>
        <!-- <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('isAdmin')): ?>
        <div class="row">
            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModal">
                <i class="fas fa-trash-alt">
                </i> Hapus Semua Data Cuti
            </button>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title" id="exampleModalLabel">Apakah anda yakin akan menjalankan fungsi ini?</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Fungsi ini memungkinkan anda menghapus semua data realisasi cuti karyawan</p>
                            <p>Biasanya hanya digunakan saat pergantian tahun / kepengurusan.</p>
                            <form action="/cuti/delete-all" method="post">
                                <?php echo method_field('delete'); ?>
                                <?php echo csrf_field(); ?>
                                <div class="d-flex justify-content-between">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button class="btn btn-sm btn-danger" type="submit">Hapus</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <hr> -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><strong>Daftar realisasi Anggaran</strong></h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <?php if($role_id == 5): ?>
                                <thead>
                                    <tr>
                                        <th>Nama Pemohon</th>
                                        <th>Divisi</th>
                                        <th>Tanggal realisasi</th>
                                        <th>File Anggaran</th>
                                        <th>Status</th>
                                        <th>Catatan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $realisasis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $realisasi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($realisasi->nama_user ?? 'None'); ?></td>
                                        <td><?php echo e($realisasi->user->divisi->nama ?? 'None'); ?></td>
                                        <td><?php echo e(\Carbon\Carbon::parse($realisasi->created_at)->format('d/m/Y')); ?></td>
                                        <td>
                                            <?php echo e($realisasi->file_realisasi); ?>

                                        </td>
                                        <td>
                                            <?php if($realisasi->acc_adminkeu_id == 3): ?>
                                                <i style="background-color: rgb(104, 255, 104); border-radius: 10px; padding: 5px 10px;">
                                                    <?php echo e($realisasi->acc_adminkeu->nama ?? 'None'); ?>

                                                </i>
                                            <?php elseif($realisasi->acc_adminkeu_id == 2): ?>
                                                <i style="background-color: rgb(255, 104, 104); border-radius: 10px; padding: 5px 15px;">
                                                    <?php echo e($realisasi->acc_adminkeu->nama ?? 'None'); ?>

                                                </i>
                                            <?php elseif($realisasi->acc_adminkeu_id == 4): ?>
                                                <i style="background-color: rgb(255, 252, 104); border-radius: 10px; padding: 5px 15px;">
                                                    <?php echo e($realisasi->acc_adminkeu->nama ?? 'None'); ?>

                                                </i>
                                            <?php else: ?>
                                                <i style="background-color: rgb(201, 201, 201); border-radius: 10px; padding: 5px 10px;">
                                                    <?php echo e($realisasi->acc_adminkeu->nama ?? 'None'); ?>

                                                </i>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($realisasi->catatan): ?> 
                                                <?php echo e($realisasi->catatan); ?>

                                            <?php else: ?>
                                                <p align=center> - </p>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <!-- PERHATIAN! Saat hosting semua tombol harus di dalam tag <form> dan memiliki <?php echo csrf_field(); ?>-->
                                            <!-- PERHATIAN! Jika tidak maka, halaman akan 404 not found!-->

                                            <form action="<?php echo e(route('realisasi.edit', $realisasi->slug)); ?>" method="get">
                                                <?php echo csrf_field(); ?>
                                                <button class="btn btn-warning" onClick="return confirm ('Yakin mau diubah?')"
                                                style="padding-right:20px; padding-left:20px; margin-top:5px;"> 
                                                    <i class="fas fa-edit"></i>Edit 
                                                </button>
                                            </form>
                                            
                                        </td>
                                        
                                    </tr>
                                    
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            <?php endif; ?>

                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <div class="d-flex justify-content-end">
            <?php echo e($realisasis->links()); ?>

        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main',['title' => 'Daftar Persetujuan Realisasi Anggaran Bidang'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ASUS\OneDrive\Documents\GitHub\Laravel\HRIS-Kopma\resources\views/realisasi/admin.blade.php ENDPATH**/ ?>