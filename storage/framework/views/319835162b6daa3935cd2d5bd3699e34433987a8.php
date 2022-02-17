
<?php $__env->startSection('content'); ?>
<div class="card card-info col-sm-12 p-0">
    <div class="card-header">
        <h1 class="card-title">Daftar Pengajuan Cuti</h1>
    </div>
</div>
<?php echo $__env->make('layouts.alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="container">

    <div class="container-fluid">
        <div class="callout callout-info col-sm-12 mb-4">
            <h6><b>Informasi</b></h6>

            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam sed condimentum nunc, in porta sapien. Vestibulum lacinia est magna. Suspendisse at venenatis risus, nec laoreet eros. Donec ex diam, dapibus sed rhoncus sit amet, rhoncus sit amet nulla. Fusce commodo dapibus velit. Etiam dui sapien, sollicitudin vel quam eget, mollis tempor lacus.</p>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <a href="<?php echo e(route('cuti.create')); ?>" class="btn btn-success">
                    <i class="fas fa-plus-square"></i>
                    Ajukan Permohonan Cuti</a>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><strong>Riwayat Pengajuan Cuti Anda</strong></h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">

                            <thead>
                                <tr>
                                    <th>Jenis Cuti</th>
                                    <th>Tanggal Mengajukan</th>
                                    <th>Konfirmasi Mandiv</th>
                                    <th>Konfirmasi HRD</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $cutis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cuti): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($cuti->kategori->nama); ?></td>
                                    <td><?php echo e(\Carbon\Carbon::parse($cuti->created_at)->format('d/m/Y')); ?></td>
                                    <td><?php echo e($cuti->acc_mandiv->nama); ?></td>
                                    <td><?php echo e($cuti->acc_hrd->nama); ?></td>
                                    <td>
                                        <a href="/cuti/<?php echo e($cuti->slug); ?>" class="btn btn-sm btn-info">detail</a>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <div class="d-flex justify-content-end">
            <?php echo e($cutis->links()); ?>

        </div>
    </div>
</section>
<script>
    $('.toastsDefaultSuccess').click(function() {
        $(document).Toasts('create', {
            class: 'bg-success',
            title: 'Toast Title',
            subtitle: 'Subtitle',
            body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main',['title' => 'Daftar Pengajuan'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\hris\resources\views/cuti/index.blade.php ENDPATH**/ ?>