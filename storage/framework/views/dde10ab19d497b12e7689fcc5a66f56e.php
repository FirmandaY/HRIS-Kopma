
<?php $__env->startSection('content'); ?>
<div class="card card-info col-sm-12 p-0">
    <div class="card-header">
        <h1 class="card-title">Rekap Pengajuan Realisasi</h1>
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
                    <h3 class="card-title"><strong>Rekap Pengajuan Realisasi</strong></h3>
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
                                <th>Email</th>
                                <th>Nama Pemohon</th>
                                <th>Bidang</th>
                                <th>No.Telepon/WA</th>
                                <th>No.SPJ</th>
                                <th>Bukti Transaksi</th>
                                <th>File SPJ</th>
                                <th>File Realisasi</th>
                                <th>Waktu Realisasi</th>
                                <th>Sisa Uang</th>
                                <th>Status</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $realisasis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $realisasi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <!-- ?? 'None' update 2 Juni Untuk mengatasi Akses Null di Environment Hosting -->
                                <td><?php echo e($realisasi->email ?? 'None'); ?></td>
                                <td><?php echo e($realisasi->nama_user ?? 'None'); ?></td>
                                <td><?php echo e($realisasi->bidang ?? 'None'); ?></td>
                                <td><?php echo e($realisasi->no_tlp ?? 'None'); ?></td>
                                <td><?php echo e($realisasi->no_spj ?? 'None'); ?></td>
                                <td><?php echo e($realisasi->file_bukti_transaksi ?? 'None'); ?></td>
                                <td><?php echo e($realisasi->foto_spj ?? 'None'); ?></td>
                                <td><?php echo e($realisasi->file_realisasi ?? 'None'); ?></td>
                                <td><?php echo e($realisasi->created_at->format('d/m/Y')); ?></td>
                                <td></td>
                                <td><?php echo e($realisasi->status ?? 'None'); ?></td>
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
<?php echo $__env->make('layouts.main',['title' => 'Rekap Data Cuti'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ASUS\OneDrive\Documents\GitHub\Laravel\HRIS-Kopma\resources\views/realisasi/rekap.blade.php ENDPATH**/ ?>