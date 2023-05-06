
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
                                    <th>Tanggal Pengajuan</th>
                                    <th>Tanggal Izin</th>
                                    <th>Jam Mulai</th>
                                    <th>Jam Selesai</th>
                                    <th>Acc Mandiv</th>
                                    <th>Acc HRD</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $izins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $izin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <!-- ?? 'None' update 2 Juni Untuk mengatasi Akses Null di Environment Hosting -->
                                    <td><?php echo e($izin->user->name ?? 'None'); ?></td>
                                    <td><?php echo e($izin->user->nik ?? 'None'); ?></td>
                                    <td><?php echo e($izin->user->role->nama ?? 'None'); ?></td>
                                    <td><?php echo e($izin->user->divisi->nama ?? 'None'); ?></td>
                                    <td><?php echo e($izin->created_at->format('d/m/Y')); ?></td>
                                    <td><?php echo e(\Carbon\Carbon::parse($izin->tgl_izin)->format('d/m/Y')); ?></td>
                                    <td><?php echo e($izin->wkt_mulai); ?></td>
                                    <td><?php echo e($izin->wkt_selesai); ?></td>
                                    <td><?php echo e($izin->acc_mandiv->nama ?? 'None'); ?></td>
                                    <td><?php echo e($izin->acc_hrd->nama ?? 'None'); ?></td>

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
<?php echo $__env->make('layouts.main',['title' => 'Rekap Data Izin'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ASUS\OneDrive\Documents\GitHub\Laravel\HRIS-Kopma\resources\views/izin/rekap.blade.php ENDPATH**/ ?>