
<?php $__env->startSection('content'); ?>


<div class="card card-info col-sm-12">
    <div class="card-header">
        <h3 class="card-title">Persetujuan Cuti Karyawan</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <?php if($role == 2 && $cuti->acc_mandiv_id == 3 && $cuti->acc_hrd_id >= 2): ?>
        <div class="row">
            <table class="table table-bordered">
                <tr>
                    <td> <b>Nama Lengkap</b></td>
                    <td> <?php echo e($cuti->user->name); ?></td>
                </tr>
                <tr>
                    <td> <b>Nomor Induk Karyawan</b></td>
                    <td> <?php echo e($cuti->user->nik); ?></td>
                </tr>
                <tr>
                    <td><b>Jabatan</b></td>
                    <td> <?php echo e($cuti->user->role->nama); ?></td>
                </tr>
                <tr>
                    <td><b>Divisi</b></td>
                    <td> <?php echo e($cuti->user->divisi->nama); ?></td>
                </tr>
                <tr>
                    <td><b>Jenis Kelamin</b></td>
                    <td> <?php echo e($cuti->user->gender); ?></td>
                </tr>
                <tr>
                    <td><b>Jenis Cuti</b></td>
                    <td> <?php echo e($cuti->kategori->nama); ?></td>
                </tr>
                <tr>
                    <td><b>Tanggal Mulai</b></td>
                    <td> <?php echo e(\Carbon\Carbon::parse($cuti->tgl_mulai)->format('d/m/Y')); ?></td>
                </tr>
                <tr>
                    <td><b>Tanggal Selesai</b></td>
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
                    <td><b>Acc Mandiv</b></td>
                    <td> <?php echo e($cuti->acc_mandiv->nama); ?></td>
                </tr>
                <tr>
                    <td><b>Acc HRD</b></td>
                    <td> <?php echo e($cuti->acc_hrd->nama); ?></td>
                </tr>
            </table>
        </div>
        <!-- /.card-header -->
        <?php else: ?>
        <div class="row">
            <div class="callout callout-info col-sm-12 mb-4">
                <h6><b>Informasi</b></h6>
                <p>Sisa Cuti Tahunan <?php echo e($cuti->user->name); ?>: <?php echo e($sisaCutis); ?> Hari</p>
            </div>
            <table class="table table-bordered">
                <tr>
                    <td> <b>Nama Lengkap</b></td>
                    <td> <?php echo e($cuti->user->name); ?></td>
                </tr>
                <tr>
                    <td> <b>Nomor Induk Karyawan</b></td>
                    <td> <?php echo e($cuti->user->nik); ?></td>
                </tr>
                <tr>
                    <td><b>Jabatan</b></td>
                    <td> <?php echo e($cuti->user->role->nama); ?></td>
                </tr>
                <tr>
                    <td><b>Divisi</b></td>
                    <td> <?php echo e($cuti->user->divisi->nama); ?></td>
                </tr>
                <tr>
                    <td><b>Jenis Kelamin</b></td>
                    <td> <?php echo e($cuti->user->gender); ?></td>
                </tr>
            </table>
        </div>

        <form action="/cuti/<?php echo e($cuti->slug); ?>/edit" method="post">
            <?php echo method_field('patch'); ?>
            <?php echo csrf_field(); ?>

            <input value="<?php echo e($sisaCutis); ?>" id="sisa_cuti" name="sisa_cuti" hidden>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="exampleSelectRounded0">Jenis Cuti</label>
                        <select class="custom-select rounded-0" id="kategori" name="kategori">
                            <option value="<?php echo e($cuti->kategori->id); ?>"><?php echo e($cuti->kategori->nama); ?></option>
                        </select>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Tanggal Mulai</label>
                        <input type="date" class="form-control" id="tgl_mulai" name="tgl_mulai" value="<?php echo e(old('tgl_mulai') ?? $cuti->tgl_mulai); ?>">
                        <div class="text-danger">
                            <?php $__errorArgs = ['tgl_mulai'];
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
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Tanggal Selesai</label>
                        <input type="date" class="form-control" id="tgl_selesai" name="tgl_selesai" value="<?php echo e(old('tgl_selesai') ?? $cuti->tgl_selesai); ?>">
                        <div class="text-danger">
                            <?php $__errorArgs = ['tgl_selesai'];
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
                </div>
                <div class="col-sm-7">
                    <!-- textarea -->
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea class="form-control" rows="3" id="keterangan" name="keterangan" placeholder="Enter ..."><?php echo e(old('keterangan') ?? $cuti->keterangan); ?></textarea>
                        <div class="text-danger">
                            <?php $__errorArgs = ['keterangan'];
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
                </div>
                <div class="col-sm-5">
                    <label>Lampiran</label><br>
                    <?php if($cuti->lampiran): ?>
                    <a href="/cuti/lampiran/<?php echo e($cuti->slug); ?>" target="_blank">
                        <img class="img-fluid" src="<?php echo e(asset($cuti->takeImageCuti)); ?>" width="100" height="120">
                    </a>
                    <?php else: ?> -
                    <?php endif; ?>
                </div>

            </div>
            <div class="row">
                <div class="col-sm-3" <?php echo e($role == 2  ?  '' : 'hidden'); ?>>
                    <div class="form-group">
                        <label for="exampleSelectRounded0">Acc Mandiv</label>
                        <select class="custom-select rounded-0" id="acc_mandiv" name="acc_mandiv">
                            <?php $__currentLoopData = $acc_mandivs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $acc_mandiv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option <?php echo e($acc_mandiv->id == $cuti->acc_mandiv_id ? 'selected' : ''); ?> value="<?php echo e($acc_mandiv->id); ?>"><?php echo e($acc_mandiv->nama); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-3" <?php echo e($cuti->acc_mandiv_id == 3 && $role == 1 ? '' :'hidden'); ?>>
                    <div class="form-group">
                        <label for="exampleSelectRounded0">Acc HRD</label>
                        <select class="custom-select rounded-0" id="acc_hrd" name="acc_hrd">
                            <?php $__currentLoopData = $acc_hrds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $acc_hrd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($acc_hrd->id !== 4): ?>
                                <option <?php echo e($acc_hrd->id == $cuti->acc_hrd_id ? 'selected' : ''); ?> value="<?php echo e($acc_hrd->id); ?>"><?php echo e($acc_hrd->nama); ?></option>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
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
                            <p>Pastikan data konfirmasi sudah benar.</p>
                            <p>Perubahan data pengajuan harap hubungi karyawan yang bersangkutan </p>
                                <div class="d-flex justify-content-between">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button class="btn btn-sm btn-success" type="submit">Simpan</button>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <?php endif; ?>
    </div>
    <!-- /.card-body -->
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main',['title' => 'Form Pengajuan Cuti'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hris\resources\views/cuti/edit.blade.php ENDPATH**/ ?>