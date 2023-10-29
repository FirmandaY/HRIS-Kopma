
<?php $__env->startSection('content'); ?>
<div class="card card-info col-sm-12">
    <div class="card-header justify-content-between">
        <h3 class="card-title">Formulir Pengajuan Anggaran</h3>


    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="row">
            <table class="table table-bordered">
                <tr>
                    <td style="width: 14rem;"><b>Tanggal Mengajukan</b></td>
                    <td> <?php echo e(\Carbon\Carbon::parse($pengajuan->created_at)->format('d/m/Y')); ?></td>
                </tr>
                <tr>
                    <td><b>Email</b></td>
                    <td> <?php echo e($pengajuan->email); ?></td>
                </tr>
                <tr>
                    <td><b>Nama Lengkap</b></td>
                    <td> <?php echo e($pengajuan->nama_user); ?></td>
                </tr>
                <tr>
                    <td><b>Bidang</b></td>
                    <td> <?php echo e($pengajuan->bidang); ?></td>
                </tr>
                <tr>
                    <td><b>No. WA</b></td>
                    <td> <?php echo e($pengajuan->no_tlp); ?></td>
                </tr>
                <tr>
                    <td><b>File Anggaran</b></td>
                    <td>
                        <?php if($pengajuan->file_anggaran): ?>
                            <iframe src="<?php echo e(asset('files/pengajuan_anggaran/'.$pengajuan->file_anggaran)); ?>" 
                                            width="1200"
                                            height="500"> 
                            </iframe>
                        <?php else: ?> -
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
            </table>
            <!-- /.card-body -->

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main',['title' => 'Detail Pengajuan'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ASUS\OneDrive\Documents\GitHub\Laravel\HRIS-Kopma\resources\views/pengajuan/show.blade.php ENDPATH**/ ?>