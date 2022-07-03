
<?php $__env->startSection('content'); ?>
<div class="card card-info col-sm-12 p-0">
    <div class="card-header">
        <h1 class="card-title">Rekap Pengajuan Izin Karyawan</h1>
    </div>
</div>
<section class="container">
    <div class="container-fluid">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('isAdmin')): ?>
        <div class="d-flex">
            <a href="<?php echo e(route('izin.export')); ?>" class="btn btn-success">
                <i class="fas fa-print"></i>
                Print</a>
        </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><strong>Rekap Permohonan Izin Karyawan</strong></h3>
                        <div class="d-flex justify-content-end">
                            <?php $__currentLoopData = $years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href=<?php echo e(route('rekap.izin', ['year' => $year])); ?>> <?php echo e($year); ?></a>&nbsp;
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
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
                                    <th>Waktu Pengajuan</th>
                                    <th>Bulan Pinjam</th>
                                    <th>Acc Mandiv</th>
                                    <th>Acc HRD</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $pinjams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pinjam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <!-- ?? 'None' update 2 Juni Untuk mengatasi Akses Null di Environment Hosting -->
                                    <td><?php echo e($pinjam->user->name ?? 'None'); ?></td>
                                    <td><?php echo e($pinjam->user->nik ?? 'None'); ?></td>
                                    <td><?php echo e($pinjam->user->role->nama ?? 'None'); ?></td>
                                    <td><?php echo e($pinjam->user->divisi->nama ?? 'None'); ?></td>
                                    <td><?php echo e($pinjam->created_at->format('d/m/Y')); ?></td>
                                    <td><?php echo e(\Carbon\Carbon::parse($pinjam->bln_pinjam)->format('m/Y')); ?></td>
                                    <td><?php echo e($pinjam->acc_mandiv->nama ?? 'None'); ?></td>
                                    <td><?php echo e($pinjam->acc_hrd->nama ?? 'None'); ?></td>

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
<?php echo $__env->make('layouts.main',['title' => 'Rekap Data Izin'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ASUS\OneDrive\Documents\GitHub\Laravel\HRIS-Kopma\resources\views/peminjaman/rekap.blade.php ENDPATH**/ ?>