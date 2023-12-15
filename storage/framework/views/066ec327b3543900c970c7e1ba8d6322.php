
<?php $__env->startSection('content'); ?>


<div class="card card-info col-sm-12">
    <?php if($role_id == 5): ?>
        <div class="card-header">
            <h3 class="card-title">Persetujuan Pengajuan Realisasi Anggaran Bidang</h3>
        </div>
    <?php else: ?>
    <div class="card-header">
        <h3 class="card-title">Revisi Pengajuan Realisasi Anggaran Bidang</h3>
    </div>
    <?php endif; ?>
    
    <!-- /.card-header -->
    <div class="card-body">
        <div class="row">
            <table class="table table-bordered">
                <tr>
                    <td style="width:20em"> <b>Nama Pemohon</b></td>
                    <td> <?php echo e($realisasi->nama_user ?? 'None'); ?>

                    </td>
                </tr>
                <tr>
                    <td> <b>Asal Bidang</b></td>
                    <td> <?php echo e($realisasi->bidang ?? 'None'); ?></td>
                </tr>
                <tr>
                    <td><b>Alamat Email Bidang</b></td>
                    <td> <?php echo e($realisasi->user->email ?? 'None'); ?></td>
                </tr>
                <tr>
                    <td><b>Divisi</b></td>
                    <td> <?php echo e($realisasi->user->divisi->nama ?? 'None'); ?></td>
                </tr>
                <tr>
                    <td><b>Nomor Telepon Pemohon</b></td>
                    <td> <?php echo e($realisasi->no_tlp); ?> 
                        <a href="https://wa.me/<?php echo e($realisasi->no_tlp); ?>">
                            <i class="fab fa-whatsapp" style="font-size:16px; color:green; margin-left:8px;"></i>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td><b>Alamat Email Pemohon</b></td>
                    <td> <?php echo e($realisasi->email); ?></td>
                </tr>
                <tr>
                    <td><b>Waktu Pengajuan</b></td>
                    <td>
                        <p><?php echo e(\Carbon\Carbon::parse($realisasi->created_at)->format('d M Y')); ?></p>
                        <p>
                            Pukul <?php echo e(\Carbon\Carbon::parse($realisasi->created_at)->format('H:i')); ?>

                            <i style="background-color: rgb(104, 255, 104); border-radius: 10px; padding: 5px 15px;">
                                <?php echo e($realisasi->created_at->diffForHumans()); ?>

                            </i>
                        </p>
                    </td>
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
            </table>
        </div>

        
        <form action="<?php echo e(route('realisasi.update',$realisasi->slug)); ?>" method="post">
            <?php echo method_field('patch'); ?>
            <?php echo csrf_field(); ?>
            <div class="row">
                <div class="col-sm-3" >
                    <div class="form-group">
                        <label for="exampleSelectRounded0">Acc Adminkeu Kopma UGM (Status)</label>
                        <select class="custom-select rounded-0" id="acc_adminkeu" name="acc_adminkeu" onchange="note()">
                            <?php $__currentLoopData = $acc_adminkeus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $acc_adminkeu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option <?php echo e($acc_adminkeu->id == $realisasi->acc_adminkeu_id ? 'selected' : ''); ?> value="<?php echo e($acc_adminkeu->id); ?>"><?php echo e($acc_adminkeu->nama); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-1"></div>
                <div id="catatan-form" class="col-sm-4" style="display: none;">
                    <div class="form-group">
                        <label for="exampleSelectRounded0">Catatan</label> <br>
                        <textarea class="form-control" name="catatan"></textarea>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <a href="<?php echo e(route('realisasi.adminkeu')); ?>" class="btn btn-warning" style="margin-right: 15px;">Batal</a>
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
                            <p>Pastikan data konfirmasi anda sudah benar.</p>
                            <p>Perubahan data realisasi harap hubungi bidang yang bersangkutan </p>
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


<script>
    
    function note() {
        var accAdminkeu = document.getElementById("acc_adminkeu");
        if ( accAdminkeu.value == "4") {
            // alert("check");
            document.getElementById("catatan-form").style.display = "block";
        } else {
            document.getElementById("catatan-form").style.display = "none";
        }
    }

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main',['title' => 'Form Realisasi Anggaran Bidang'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ASUS\OneDrive\Documents\GitHub\Laravel\HRIS-Kopma\resources\views/realisasi/edit.blade.php ENDPATH**/ ?>