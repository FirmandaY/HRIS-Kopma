
<?php $__env->startSection('content'); ?>
<div class="card card-info col-sm-12">
    <div class="card-header">
        <h3 class="card-title">Formulir Pengajuan Izin</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="row">
            <table class="table table-bordered">
                <tr>
                    <td style="width: 14rem;"><b>Tanggal Mengajukan</b></td>
                    <td> <?php echo e(\Carbon\Carbon::parse($izin->created_at)->format('d/m/Y')); ?></td>
                </tr>
                <tr>
                    <td><b>Tanggal Izin</b></td>
                    <td> <?php echo e(\Carbon\Carbon::parse($izin->tgl_izin)->format('d/m/Y')); ?></td>
                </tr>
                <tr>
                    <td><b>Waktu Mulai Izin</b></td>
                    <td> <?php echo e($izin->wkt_mulai); ?>.00</td>
                </tr>
                <tr>
                    <td><b>Waktu Selesai Izin</b></td>
                    <td> <?php echo e($izin->wkt_selesai); ?>.00</td>
                </tr>
                <tr>
                    <td><b>Keterangan</b></td>
                    <td> <?php echo nl2br($izin->keterangan); ?></td>
                </tr>
                <tr>
                    <td><b>Lampiran</b></td>
                    <td>
                        <?php if($izin->lampiran): ?>
                        <a href="/izin/lampiran/<?php echo e($izin->slug); ?>" target="_blank">
                            <img class="img-fluid" src="<?php echo e(asset($izin->takeImageIzin)); ?>" width="100" height="120">
                        </a>
                        <?php else: ?> -
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <td><b>Konfirmasi Mandiv</b></td>
                    <td> <?php echo e($izin->acc_mandiv->nama); ?></td>
                </tr>
                <tr>
                    <td><b>Konfirmasi HRD</b></td>
                    <td> <?php echo e($izin->acc_hrd->nama); ?></td>
                </tr>
                <tr>
                    <td style="width: 14rem;"><b>Tanggal Konfirmasi</b></td>
                    <td> <?php echo e(\Carbon\Carbon::parse($izin->updated_at)->format('d/m/Y')); ?></td>
                </tr>
            </table>
            <!-- /.card-body -->

        </div>


    </div>
    <!-- /.card-body -->
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main',['title' => 'Form Pengajuan Cuti'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\hris\resources\views/izin/show.blade.php ENDPATH**/ ?>