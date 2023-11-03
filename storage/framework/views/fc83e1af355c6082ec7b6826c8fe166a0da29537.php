
<?php $__env->startSection('content'); ?>
<div class="card card-info col-sm-12 p-0">
    <div class="card-header">
        <h1 class="card-title">Rekap Pengajuan Anggaran Bidang</h1>
    </div>
</div>
<section class="container">

    <div class="container-fluid">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('isAdminkeu')): ?>
        <div class="d-flex">
            <a href="<?php echo e(route('pengajuan.export')); ?>" class="btn btn-success">
                <i class="fas fa-print"></i>
                Print</a>
        </div>
        <?php endif; ?>
        <div class="row">
            <div class="card">
                <div class="card-header ">
                    <h3 class="card-title"><strong>Rekap Pengajuan Anggaran Bidang</strong></h3>
                    <div class="d-flex justify-content-end">
                        <?php $__currentLoopData = $years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href=<?php echo e(route('rekap.pengajuanAnggaran', ['year' => $year])); ?>> <?php echo e($year); ?></a>&nbsp;
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">

                        <thead>
                            <tr>
                                <th>Nama Pemohon</th>
                                <th>Divisi</th>
                                <th>Tanggal Pengajuan</th>
                                <th>File Anggaran</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $pengajuans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pengajuan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($pengajuan->acc_hrd_id == 1): ?>
                            <tr style="color:tomato;">
                                <?php else: ?>
                            <tr>
                                <?php endif; ?>
                                <td><?php echo e($pengajuan->nama_user ?? 'None'); ?></td>
                                <td><?php echo e($pengajuan->user->divisi->nama ?? 'None'); ?></td>
                                <td><?php echo e(\Carbon\Carbon::parse($pengajuan->created_at)->format('d/m/Y')); ?></td>
                                <td>
                                    <?php echo e($pengajuan->file_anggaran); ?>

                                </td>
                                <td>
                                    <?php echo e($pengajuan->acc_adminkeu->nama ?? 'None'); ?>

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
<?php echo $__env->make('layouts.main',['title' => 'Rekap Data Cuti'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ASUS\OneDrive\Documents\GitHub\Laravel\HRIS-Kopma\resources\views/pengajuan/rekap.blade.php ENDPATH**/ ?>