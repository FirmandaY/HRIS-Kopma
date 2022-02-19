
<?php $__env->startSection('content'); ?>
<div class="card card-info col-sm-12">
    <div class="card-header">
        <h3 class="card-title">Formulir Pengajuan Peminjaman</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">

        <form action="<?php echo e(route('pinjam.store')); ?>" method="post" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Tanggal Peminjaman</label>
                        <input type="date" class="form-control" id="wkt_pinjam" name="wkt_pinjam">
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
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Tanggal Pengembalian</label>
                        <input type="date" class="form-control" id="wkt_selesai" name="wkt_selesai">
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
                        <textarea class="form-control" rows="3" id="keterangan" name="keterangan" placeholder="Tambahkan keterangan ..."></textarea>
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
                    <div class="form-group">
                        <label for="lampiran">Lampiran(optional)</label>
                        <small><i>*file format gambar maks 2000kb.</i></small>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" id="lampiran" name="lampiran">
                            </div>
                        </div>
                        <?php $__errorArgs = ['lampiran'];
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
            <div class="row justify-content-center">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#createModal">
                    <i class="fas fa-plus-square"></i>
                    Ajukan  
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
                            <p>Pastikan data yang anda ajukan sudah benar.</p>
                            <p>Data yang diajukan tidak dapat diubah.</p>
                                <div class="d-flex justify-content-between">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button class="btn btn-sm btn-success" type="submit">Ajukan</button>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
    <!-- /.card-body -->
</div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main',['title' => 'Form Pengajuan Peminjaman'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ASUS\OneDrive\Documents\GitHub\Laravel\HRIS-Kopma\resources\views/peminjaman/create.blade.php ENDPATH**/ ?>