
<?php $__env->startSection('content'); ?>

<?php echo $__env->make('layouts.alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="card card-info col-sm-12">
    <div class="card-header">
        <h3 class="card-title">Revisi Pengajuan Anggaran Bidang</h3>
    </div>
    <div style="background-color: yellow; padding: 10px 20px 2px 20px; border-radius: 5px; margin-top:8px;">
        <h6>
            <i class='fas fa-exclamation-circle' style="margin-right: 1vh;"></i>
            <?php echo e($pengajuan->catatan); ?> 
        </h6>
    </div>
    
    <!-- /.card-header -->
    <div class="card-body">
        <form action="<?php echo e(route('pengajuan.update.revisi',$pengajuan->slug)); ?>" method="post" enctype="multipart/form-data">
            <?php echo method_field('patch'); ?>
            <?php echo csrf_field(); ?>
            <div class="row">
                <table class="table table-bordered">
                    <tr>
                        <td style="width:20em"> <b>Nama Pemohon</b></td>
                        <td> <?php echo e($pengajuan->nama_user ?? 'None'); ?>

                        </td>
                    </tr>
                    <tr>
                        <td> <b>Asal Bidang</b></td>
                        <td> <?php echo e($pengajuan->bidang ?? 'None'); ?></td>
                    </tr>
                    <tr>
                        <td><b>Alamat Email Bidang</b></td>
                        <td> <?php echo e($pengajuan->user->email ?? 'None'); ?></td>
                    </tr>
                    <tr>
                        <td><b>Divisi</b></td>
                        <td> <?php echo e($pengajuan->user->divisi->nama ?? 'None'); ?></td>
                    </tr>
                    <tr>
                        <td><b>Nomor Telepon Pemohon</b></td>
                        <td> <?php echo e($pengajuan->no_tlp); ?> </td>
                    </tr>
                    <tr>
                        <td><b>Alamat Email Pemohon</b></td>
                        <td> <?php echo e($pengajuan->email); ?></td>
                    </tr>
                    <tr>
                        <td><b>Waktu Pengajuan</b></td>
                        <td>
                            <p><?php echo e(\Carbon\Carbon::parse($pengajuan->created_at)->format('d M Y')); ?></p>
                            <p>
                                Pukul <?php echo e(\Carbon\Carbon::parse($pengajuan->created_at)->format('H:i')); ?>

                                <i style="background-color: rgb(104, 255, 104); border-radius: 10px; padding: 5px 15px;">
                                    <?php echo e($pengajuan->created_at->diffForHumans()); ?>

                                </i>
                            </p>
                        </td>
                    </tr>
                    

                    
                    <tr>
                        <td><b>File Formulir Pengajuan Anggaran Bidang</b></td>
                        <td>
                            <?php echo e($pengajuan->file_anggaran); ?>

                            <p style="margin-top: 8px;">
                                <a class="btn btn-primary" href="<?php echo e(asset('files/pengajuan_anggaran/'.$pengajuan->file_anggaran)); ?>" target="_blank">
                                    <i class="fas fa-file-excel" style="margin-right: 5px;"></i>
                                    Open Excel file
                                </a>
                            </p>
                        </td>

                        <td>
                            <div class="form-group">
                                <label for="file_anggaran">Ubah Lampiran Form Pengajuan Anggaran</label>
                                <p>
                                    <small><i>*format form pengajuan anggaran dapat diakses melalui <a href="linktr.ee/KeuanganKopma">linktr.ee/KeuanganKopma</a></i></small>
                                </p>
                                <p>
                                    <small><i>*format file: .xslx | ukuran maksimal file 1MB</i></small>
                                </p>
                                
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" id="file_anggaran" name="file_anggaran">
                                    </div>
                                </div>
                                <div class="text-danger">
                                    <?php $__errorArgs = ['file_anggaran'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <?php echo e($message); ?>

                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                        </td>
                    </tr>

                </table>
            </div>

            <div class="row justify-content-center">
                <a href="<?php echo e(route('pengajuan.index')); ?>" class="btn btn-warning" style="margin-right: 15px;">Kembali</a>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#createModal">
                <i class="fas fa-save"></i>
                    Simpan
                </button>
                <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">PERHATIAN!!</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Pastikan data revisi anda sudah benar dan tepat.</p>
                            <p>Perubahan data pengajuan harap dicermati kembali!</p>
                            <p><em>Setelah disimpan data akan diajukan ke Adminkeu dan tidak dapat diubah lagi.</em></p>
                                <div class="d-flex justify-content-between">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button class="btn btn-sm btn-success" type="submit">Simpan</button>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- /.card-body -->
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main',['title' => 'Form Revisi Realisasi Anggaran Bidang'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ASUS\OneDrive\Documents\GitHub\Laravel\HRIS-Kopma\resources\views/pengajuan/revisi.blade.php ENDPATH**/ ?>