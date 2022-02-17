
<?php $__env->startSection('content'); ?>
<div class="card card-info col-sm-12">
    <div class="card-header justify-content-between">
        <h3 class="card-title">Formulir Pengajuan Cuti</h3>


    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <!-- <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" value="Nama" disabled>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>NIP</label>
                        <input type="text" class="form-control" value="1234" disabled>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Jabatan</label>
                        <input type="text" class="form-control" value="Jabatan" disabled>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Divisi</label>
                        <input type="text" class="form-control" value="Divisi" disabled>
                    </div>
                </div>
            </div> -->

        <div class="row">
            <table class="table table-bordered">
                <tr>
                    <td style="width: 14rem;"><b>Tanggal Mengajukan</b></td>
                    <td> <?php echo e(\Carbon\Carbon::parse($cuti->created_at)->format('d/m/Y')); ?></td>
                </tr>
                <tr>
                    <td><b>Jenis Cuti</b></td>
                    <td> <?php echo e($cuti->kategori->nama); ?></td>
                </tr>
                <tr>
                    <td><b>Tanggal Mulai Cuti</b></td>
                    <td> <?php echo e(\Carbon\Carbon::parse($cuti->tgl_mulai)->format('d/m/Y')); ?></td>
                </tr>
                <tr>
                    <td><b>Tanggal Selesai Cuti</b></td>
                    <td> <?php echo e(\Carbon\Carbon::parse($cuti->tgl_selesai)->format('d/m/Y')); ?></td>
                </tr>
                <tr>
                    <td><b>Keterangan</b></td>
                    <td> <?php echo nl2br($cuti->keterangan); ?></td>
                </tr>
                <tr>
                    <td><b>Lampiran</b></td>
                    <td>
                        <?php if($cuti->lampiran): ?>
                        <a href="/cuti/lampiran/<?php echo e($cuti->slug); ?>" target="_blank">
                            <img class="img-fluid" src="<?php echo e(asset($cuti->takeImageCuti)); ?>" width="100" height="120">
                        </a>
                        <?php else: ?> -
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <td><b>Konfirmasi Mandiv</b></td>
                    <td> <?php echo e($cuti->acc_mandiv->nama); ?></td>
                </tr>
                <tr>
                    <td><b>Konfirmasi HRD</b></td>
                    <td> <?php echo e($cuti->acc_hrd->nama); ?></td>
                </tr>
                <tr>
                    <td><b>Tanggal Konfirmasi</b></td>
                    <td> <?php echo e(\Carbon\Carbon::parse($cuti->updated_at)->format('d/m/Y')); ?></td>
                </tr>
            </table>
            <!-- /.card-body -->

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main',['title' => 'Detail Pengajuan'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\hris\resources\views/cuti/show.blade.php ENDPATH**/ ?>