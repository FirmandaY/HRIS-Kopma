
<?php $__env->startSection('content'); ?>
<!-- <div class="container">
    <div class="d-flex justify-content-end">
        
        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModal">
            <i class="fas fa-trash-alt"></i>
        </button>
    </div>

    
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Yakin ingin menghapus data ini ?</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/izin/<?php echo e($izin->slug); ?>/delete" method="post">
                        <?php echo method_field('delete'); ?>
                        <?php echo csrf_field(); ?>
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button class="btn btn-sm btn-danger" type="submit">Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div> -->
<div class="card card-info col-sm-12">
    <div class="card-header">
        <h3 class="card-title">Persetujuan Izin Karyawan</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <?php if($role == 2 && $izin->acc_mandiv_id == 3 && $izin->acc_hrd_id >= 2): ?>
        <div class="row">
            <table class="table table-bordered">
                <tr>
                    <td style="width:20em"> <b>Nama Lengkap</b></td>
                    <td> <?php echo e($izin->user->name); ?></td>
                </tr>
                <tr>
                    <td> <b>Nomor Induk Karyawan</b></td>
                    <td> <?php echo e($izin->user->nik); ?></td>
                </tr>
                <tr>
                    <td><b>Jabatan</b></td>
                    <td> <?php echo e($izin->user->role->nama); ?></td>
                </tr>
                <tr>
                    <td><b>Divisi</b></td>
                    <td> <?php echo e($izin->user->divisi->nama); ?></td>
                </tr>
                <tr>
                    <td><b>Jenis Kelamin</b></td>
                    <td> <?php echo e($izin->user->gender); ?></td>
                </tr>
            </table>
        </div>
        <br>
        <div class="row">
            <table class="table table-bordered">
                <tr>
                    <td style="width:20em"><b>Tanggal Izin</b></td>
                    <td> <?php echo e(\Carbon\Carbon::parse($izin->tgl_izin)->format('d/m/Y')); ?></td>
                </tr>
                <tr>
                    <td><b>Waktu Mulai</b></td>
                    <td> <?php echo e($izin->wkt_mulai); ?>.00</td>
                </tr>
                <tr>
                    <td><b>Waktu Selesai</b></td>
                    <td><?php echo e($izin->wkt_selesai); ?>.00</td>
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
                            <img class="img-fluid" src="<?php echo e(asset($izin->takeImageCuti)); ?>" width="100" height="120">
                        </a>
                        <?php else: ?> -
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <td><b>Acc Mandiv</b></td>
                    <td> <?php echo e($izin->acc_mandiv->nama); ?></td>
                </tr>
                <tr>
                    <td><b>Acc HRD</b></td>
                    <td> <?php echo e($izin->acc_hrd->nama); ?></td>
                </tr>
            </table>
        </div>

        <?php else: ?>
        <div class="row">
            <table class="table table-bordered">
                <tr>
                    <td style="width:20em"> <b>Nama Lengkap</b></td>
                    <td> <?php echo e($izin->user->name); ?></td>
                </tr>
                <tr>
                    <td> <b>Nomor Induk Karyawan</b></td>
                    <td> <?php echo e($izin->user->nik); ?></td>
                </tr>
                <tr>
                    <td><b>Jabatan</b></td>
                    <td> <?php echo e($izin->user->role->nama); ?></td>
                </tr>
                <tr>
                    <td><b>Divisi</b></td>
                    <td> <?php echo e($izin->user->divisi->nama); ?></td>
                </tr>
                <tr>
                    <td><b>Jenis Kelamin</b></td>
                    <td> <?php echo e($izin->user->gender); ?></td>
                </tr>
            </table>
        </div>
        <form action="/izin/<?php echo e($izin->slug); ?>/edit" method="post">
            <?php echo method_field('patch'); ?>
            <?php echo csrf_field(); ?>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Tanggal Izin</label>
                        <input type="date" class="form-control" id="tgl_izin" name="tgl_izin" value="<?php echo e(old('tgl_izin') ?? $izin->tgl_izin); ?>">
                        <div class="text-danger">
                            <?php $__errorArgs = ['tgl_izin'];
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
                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="exampleSelectRounded0">Waktu Mulai</label>
                        <select class="custom-select rounded-0" id="wkt_mulai" name="wkt_mulai">
                            <option value="<?php echo e(old('wkt_mulai') ?? $izin->wkt_mulai); ?>"><?php echo e($izin->wkt_mulai); ?>.00</option>
                            <?php for($i = 7; $i < 22; $i++): ?> <option value="<?php echo e($i); ?>"><?php echo e($i); ?>.00</option>
                                <?php endfor; ?>
                        </select>
                        <div class="text-danger">
                            <?php $__errorArgs = ['wkt_mulai'];
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
                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="exampleSelectRounded0">Waktu Selesai</label>
                        <select class="custom-select rounded-0" id="wkt_selesai" name="wkt_selesai">
                            <option value="<?php echo e(old('wkt_selesai') ?? $izin->wkt_selesai); ?>"><?php echo e($izin->wkt_selesai); ?>.00</option>
                            <?php for($i = 7; $i < 22; $i++): ?> <option value="<?php echo e($i); ?>"><?php echo e($i); ?>.00</option>
                                <?php endfor; ?>
                        </select>
                        <div class="text-danger">
                            <?php $__errorArgs = ['wkt_mulai'];
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
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <!-- textarea -->
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea class="form-control" rows="3" id="keterangan" name="keterangan"><?php echo e(old('keterangan') ?? $izin->keterangan); ?></textarea>
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
                <div class="col-sm-6">
                    <label>Lampiran</label><br>
                    <?php if($izin->lampiran): ?>
                    <a href="/izin/lampiran/<?php echo e($izin->slug); ?>" target="_blank">
                        <img class="img-fluid" src="<?php echo e(asset($izin->takeImageIzin)); ?>" width="10" height="20">
                    </a>
                    <?php else: ?> -
                    <?php endif; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3" <?php echo e($role == 2 ? '' :'hidden'); ?>>
                    <div class="form-group">
                        <label for="exampleSelectRounded0">Acc Mandiv</label>
                        <select class="custom-select rounded-0" id="acc_mandiv" name="acc_mandiv">
                            <?php $__currentLoopData = $acc_mandivs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $acc_mandiv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option <?php echo e($acc_mandiv->id == $izin->acc_mandiv_id ? 'selected' : ''); ?> value="<?php echo e($acc_mandiv->id); ?>"><?php echo e($acc_mandiv->nama); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>

                <div class="col-sm-3" <?php echo e($izin->acc_mandiv_id == 3 && $role == 1 ? '' :'hidden'); ?>>
                    <div class="form-group">
                        <label for="exampleSelectRounded0">Acc HRD</label>
                        <select class="custom-select rounded-0" id="acc_hrd" name="acc_hrd">
                        <?php $__currentLoopData = $acc_hrds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $acc_hrd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($acc_hrd->id !== 4): ?>
                                <option <?php echo e($acc_hrd->id == $izin->acc_hrd_id ? 'selected' : ''); ?> value="<?php echo e($acc_hrd->id); ?>"><?php echo e($acc_hrd->nama); ?></option>
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
<?php echo $__env->make('layouts.main',['title' => 'Form Pengajuan Izin'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hris\resources\views/izin/edit.blade.php ENDPATH**/ ?>