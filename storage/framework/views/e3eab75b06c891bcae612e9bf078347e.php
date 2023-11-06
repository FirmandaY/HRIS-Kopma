
<?php $__env->startSection('content'); ?>
<div class="card card-info col-sm-12">
    <div class="card-header justify-content-between">
        <h3 class="card-title">Formulir realisasi Realisasi</h3>


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
                        <td> <?php echo e(\Carbon\Carbon::parse($realisasi->created_at)->format('d/m/Y')); ?></td>
                    </tr>
                    <tr>
                        <td><b>Email</b></td>
                        <td> <?php echo e($realisasi->email); ?></td>
                    </tr>
                    <tr>
                        <td><b>Nama Lengkap</b></td>
                        <td> <?php echo e($realisasi->nama_user); ?></td>
                    </tr>
                    <tr>
                        <td><b>Bidang</b></td>
                        <td> <?php echo e($realisasi->bidang); ?></td>
                    </tr>
                    <tr>
                        <td><b>No. WA</b></td>
                        <td> <?php echo e($realisasi->no_tlp); ?></td>
                    </tr>
                    <tr>
                        <td><b>Foto SPJ</b></td>
                        <td>
                            <img src="<?php echo e(asset('files/foto_spj/'.$realisasi->foto_spj)); ?>" alt="" height="200px">
                        </td>
                    </tr>
                    <tr>
                        <td><b>File Form Realisasi Anggaran</b></td>
                        <td>
                            <?php echo e($realisasi->file_realisasi); ?>

                            <p style="margin-top: 8px;">
                                <a class="btn btn-primary" href="<?php echo e(asset('files/realisasi_anggaran/'.$realisasi->file_realisasi)); ?>" target="_blank">
                                    <i class="fas fa-file-pdf" style="margin-right: 5px;"></i>
                                    Open PDF file
                                </a>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td><b>File Bukti Transaksi</b></td>
                        <td>
                            <?php echo e($realisasi->file_bukti_transaksi); ?>

                            <p style="margin-top: 8px;">
                                <a class="btn btn-primary" href="<?php echo e(asset('files/bukti_transaksi/'.$realisasi->file_bukti_transaksi)); ?>" target="_blank">
                                    <i class="fas fa-file-pdf" style="margin-right: 5px;"></i>
                                    Open PDF file
                                </a>
                            </p>
                        </td>
                    </tr>
                    <tr>
                </table>
                <!-- /.card-body -->
    
            </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main',['title' => 'Detail realisasi'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ASUS\OneDrive\Documents\GitHub\Laravel\HRIS-Kopma\resources\views/realisasi/show.blade.php ENDPATH**/ ?>