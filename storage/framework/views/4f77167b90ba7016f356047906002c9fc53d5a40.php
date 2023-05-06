
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
                    <form action="/pinjam/<?php echo e($peminjaman->slug); ?>/delete" method="post">
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
        <h3 class="card-title">Persetujuan Peminjaman Oleh Karyawan</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <?php if($role == 2 && $peminjaman->acc_mandiv_id == 3 && $peminjaman->acc_hrd_id >= 2): ?> <!--Mandiv setuju tapi HRD tidak setuju-->
        <div class="row">
            <table class="table table-bordered">
                <tr>
                    <td style="width:20em"> <b>Nama Lengkap</b></td>
                    <td> <?php echo e($peminjaman->user->name); ?></td>
                </tr>
                <tr>
                    <td> <b>Nomor Induk Karyawan</b></td>
                    <td> <?php echo e($peminjaman->user->nik); ?></td>
                </tr>
                <tr>
                    <td><b>Jabatan</b></td>
                    <td> <?php echo e($peminjaman->user->role->nama); ?></td>
                </tr>
                <tr>
                    <td><b>Divisi</b></td>
                    <td> <?php echo e($peminjaman->user->divisi->nama); ?></td>
                </tr>
                <tr>
                    <td><b>Jenis Kelamin</b></td>
                    <td> <?php echo e($peminjaman->user->gender); ?></td>
                </tr>
            </table>
        </div>
        <br>
        <div class="row">
            <table class="table table-bordered">
                <tr>
                    <td style="width:20em"><b>Tanggal Peminjaman</b></td>
                    <td> <?php echo e(\Carbon\Carbon::parse($peminjaman->created_at)->format('d/m/Y')); ?></td>
                </tr>
                <tr>
                    <td><b>Waktu Mulai</b></td>
                    <td> <?php echo e($peminjaman->wkt_mulai); ?></td>
                </tr>
                <tr>
                    <td><b>Waktu Kembali</b></td>
                    <td><?php echo e($peminjaman->wkt_selesai); ?></td>
                </tr>
                <tr>
                    <td><b>Keterangan</b></td>
                    <td> <?php echo nl2br($peminjaman->keterangan); ?></td>
                </tr>
                <tr>
                    <td><b>Lampiran</b></td>
                    <td>
                        <?php if($peminjaman->lampiran): ?>
                        <a href="/izin/lampiran/<?php echo e($peminjaman->slug); ?>" target="_blank">
                            <img class="img-fluid" src="<?php echo e(asset($peminjaman->takeImageCuti)); ?>" width="100" height="120">
                        </a>
                        <?php else: ?> -
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <td><b>Acc Mandiv</b></td>
                    <td> <?php echo e($peminjaman->acc_mandiv->nama); ?></td>
                </tr>
                <tr>
                    <td><b>Acc HRD</b></td>
                    <td> <?php echo e($peminjaman->acc_hrd->nama); ?></td>
                </tr>
            </table>
        </div>

        <?php else: ?>
        <div class="row">
            <table class="table table-bordered">
                <tr>
                    <td style="width:20em"> <b>Nama Lengkap</b></td>
                    <td> <?php echo e($peminjaman->user['name']); ?></td>
                </tr>
                <tr>
                    <td> <b>Nomor Induk Karyawan</b></td>
                    <td> <?php echo e($peminjaman->user->nik); ?></td>
                </tr>
                <tr>
                    <td><b>Jabatan</b></td>
                    <td> <?php echo e($peminjaman->user->role->nama); ?></td>
                </tr>
                <tr>
                    <td><b>Divisi</b></td>
                    <td> <?php echo e($peminjaman->user->divisi->nama); ?></td>
                </tr>
                <tr>
                    <td><b>Jenis Kelamin</b></td>
                    <td> <?php echo e($peminjaman->user->gender); ?></td>
                </tr>
            </table>
        </div>
        <form action="/pinjam/<?php echo e($peminjaman->slug); ?>/edit" method="post">
            <?php echo method_field('patch'); ?>
            <?php echo csrf_field(); ?>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Tanggal Peminjaman</label>
                        
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Tanggal Mulai</label>
                        <input type="date" class="form-control" id="wkt_pinjam" name="wkt_pinjam" value="<?php echo e(old('wkt_pinjam') ?? $cuti->wkt_pinjam); ?>">
                        <div class="text-danger">
                            <?php $__errorArgs = ['wkt_pinjam'];
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
                        <label>Tanggal Selesai</label>
                        <input type="date" class="form-control" id="wkt_selesai" name="wkt_selesai" value="<?php echo e(old('wkt_selesai') ?? $cuti->wkt_selesai); ?>">
                        <div class="text-danger">
                            <?php $__errorArgs = ['wkt_selesai'];
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
                        <textarea class="form-control" rows="3" id="keterangan" name="keterangan"><?php echo e(old('keterangan') ?? $peminjaman->keterangan); ?></textarea>
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
                    <?php if($peminjaman->lampiran): ?>
                    <a href="/pinjam/lampiran/<?php echo e($peminjaman->slug); ?>" target="_blank">
                        <img class="img-fluid" src="<?php echo e(asset($peminjaman->takeImageIzin)); ?>" width="10" height="20">
                    </a>
                    <?php else: ?> -
                    <?php endif; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3" <?php echo e($role == 2 ? "" :'hidden'); ?>>
                    <div class="form-group">
                        <label for="exampleSelectRounded0">Acc Mandiv</label>
                        <select class="custom-select rounded-0" id="acc_mandiv" name="acc_mandiv">
                            <?php $__currentLoopData = $acc_mandivs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $acc_mandiv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option <?php echo e($acc_mandiv->id == $peminjaman->acc_mandiv_id ? 'selected' : ''); ?> value="<?php echo e($acc_mandiv->id); ?>"><?php echo e($acc_mandiv->nama); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>

                <div class="col-sm-3" <?php echo e($peminjaman->acc_mandiv_id == 3 && $role == 1 ? '' :'hidden'); ?>>
                    <div class="form-group">
                        <label for="exampleSelectRounded0">Acc HRD</label>
                        <select class="custom-select rounded-0" id="acc_hrd" name="acc_hrd">
                        <?php $__currentLoopData = $acc_hrds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $acc_hrd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($acc_hrd->id !== 4): ?>
                                <option <?php echo e($acc_hrd->id == $peminjaman->acc_hrd_id ? 'selected' : ''); ?> value="<?php echo e($acc_hrd->id); ?>"><?php echo e($acc_hrd->nama); ?></option>
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
<?php echo $__env->make('layouts.main',['title' => 'Form Pengajuan Izin'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ASUS\OneDrive\Documents\GitHub\Laravel\HRIS-Kopma\resources\views/peminjaman/edit.blade.php ENDPATH**/ ?>