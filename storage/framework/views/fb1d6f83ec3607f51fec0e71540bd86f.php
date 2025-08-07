<?php if(session()->has('success')): ?>
<div class="col-md-12">
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h6><i class="icon fas fa-check fa-xs"></i> Berhasil !</h6>
        <?php echo e(session()->get('success')); ?>

    </div>
</div>
<?php elseif(session()->has('error')): ?>
<div class="col-md-12">
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h6><i class="icon fas fa-ban fa-xs"></i> Gagal !</h6>
        <?php echo e(session()->get('error')); ?>

    </div>
</div>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\HRIS-Kopma\resources\views/layouts/alert.blade.php ENDPATH**/ ?>