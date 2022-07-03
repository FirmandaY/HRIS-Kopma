
<?php $__env->startSection('content'); ?>
<div class="card card-info col-sm-12 p-0">
    <div class="card-header">
        <h1 class="card-title">Rekap Pengajuan Cuti Karyawan</h1>
    </div>
</div>
<section class="container">

    <div class="container-fluid">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('isAdmin')): ?>
        <div class="d-flex">
            <a href="<?php echo e(route('cuti.export')); ?>" class="btn btn-success">
                <i class="fas fa-print"></i>
                Print</a>
        </div>
        <?php endif; ?>
        <div class="row">
            <div class="card">
                <div class="card-header ">
                    <h3 class="card-title"><strong>Rekap Permohonan Cuti Karyawan</strong></h3>
                    <div class="d-flex justify-content-end">
                        <?php $__currentLoopData = $years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href=<?php echo e(route('rekap.cuti', ['year' => $year])); ?>> <?php echo e($year); ?></a>&nbsp;
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
                                <th>Jenis Cuti</th>
                                <th>Mengajukan</th>
                                <th>Mulai</th>
                                <th>Selesai</th>
                                <th>Acc Mandiv</th>
                                <th>Acc HRD</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $cutis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cuti): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <!-- ?? 'None' update 2 Juni Untuk mengatasi Akses Null di Environment Hosting -->
                                <td><?php echo e($cuti->user->name ?? 'None'); ?></td>
                                <td><?php echo e($cuti->user->nik ?? 'None'); ?></td>
                                <td><?php echo e($cuti->user->role->nama ?? 'None'); ?></td>
                                <td><?php echo e($cuti->user->divisi->nama ?? 'None'); ?></td>
                                <td><?php echo e($cuti->kategori->nama ?? 'None'); ?></td>
                                <td><?php echo e($cuti->created_at->format('d/m/Y')); ?></td>
                                <td><?php echo e(\Carbon\Carbon::parse($cuti->tgl_mulai)->format('d/m/Y')); ?></td>
                                <td><?php echo e(\Carbon\Carbon::parse($cuti->tgl_selesai)->format('d/m/Y')); ?></td>
                                <td><?php echo e($cuti->acc_mandiv->nama ?? 'None'); ?></td>
                                <td><?php echo e($cuti->acc_hrd->nama ?? 'None'); ?></td>
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
</section>
<script>
    $('.toastsDefaultSuccess').click(function() {
        $(document).Toasts('create', {
            class: 'bg-success',
            title: 'Toast Title',
            subtitle: 'Subtitle',
            body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main',['title' => 'Rekap Data Cuti'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ASUS\OneDrive\Documents\GitHub\Laravel\HRIS-Kopma\resources\views/cuti/rekap.blade.php ENDPATH**/ ?>