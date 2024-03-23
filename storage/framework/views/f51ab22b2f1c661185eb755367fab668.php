
<?php $__env->startSection('content'); ?>
<div class="card card-info col-sm-12 p-0">
    <div class="card-header">
        <h1 class="card-title">Daftar Pengajuan Realisasi Anggaran Bidang</h1>
    </div>
</div>
<?php echo $__env->make('layouts.alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="container">

    <div class="container-fluid">
        <div class="callout callout-info col-sm-12 mb-4">
            <h6><b>Informasi</b></h6>

            <p>
                Halaman ini berisi riwayat pengajuan realisasi anda. Semua realisasi yang pernah anda ajukan akan tercatat di sini. <br>
                Silahkan Konfirmasi Pengajuan realisasi Anda ke nomor WhatsApp di bawah ini. <br>
                Efina : 0853-2741-0870 <br><br>

                <p style="color: red;"><i> PERHATIAN ! </i></p>
                <p><i> Agar tidak terjadi kesalahpahaman, mohon pastikan anda berkoordinasi dengan Ketua Bidang terlebih dahulu sebelum mengajukan anggaran ya! </i></p>
            </p>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <a href="<?php echo e(route('realisasi.create')); ?>" class="btn btn-success">
                    <i class="fas fa-plus-square"></i>
                    Buat Realisasi</a>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><strong>Riwayat Pengajuan Realisasi Anggaran Anda</strong></h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">

                            <thead>
                                <tr>
                                    <th>Nama Staff</th>
                                    <th>Nomor SPJ Anggaran</th>
                                    <th>File Realisasi</th>
                                    <th>Tanggal Mengajukan</th>
                                    <th>Konfirmasi Adminkeu</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody align="center">
                                <?php $__currentLoopData = $realisasis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $realisasi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td> <?php echo e($realisasi->nama_user); ?> </td>
                                    <td> <?php echo e($realisasi->no_spj); ?> </td>
                                    <td> <?php echo e($realisasi->file_realisasi); ?> </td>
                                    <td><?php echo e(\Carbon\Carbon::parse($realisasi->created_at)->format('d/m/Y')); ?></td>

                                    <td>
                                        <?php if($realisasi->acc_adminkeu_id == 4): ?>
                                            <i style="background-color: rgb(245, 255, 104); border-radius: 10px; padding: 5px 15px;">
                                                <?php echo e($realisasi->acc_adminkeu->nama); ?>

                                            </i>
                                        <?php elseif($realisasi->acc_adminkeu_id == 3): ?>
                                            <i style="background-color: rgb(104, 255, 104); border-radius: 10px; padding: 5px 15px;">
                                                <?php echo e($realisasi->acc_adminkeu->nama); ?>

                                            </i>
                                        <?php elseif($realisasi->acc_adminkeu_id == 2): ?>
                                            <i style="background-color: rgb(255, 104, 104); border-radius: 10px; padding: 5px 20px;">
                                                <?php echo e($realisasi->acc_adminkeu->nama); ?>

                                            </i>
                                        <?php else: ?>
                                            <i style="background-color: rgb(201, 201, 201); border-radius: 10px; padding: 5px 15px;">
                                                <?php echo e($realisasi->acc_adminkeu->nama); ?>

                                            </i>
                                        <?php endif; ?>
                                    </td>

                                    <td>
                                        <!-- PERHATIAN! Saat hosting semua tombol harus di dalam tag <form> dan memiliki <?php echo csrf_field(); ?>-->
                                        <!-- PERHATIAN! Jika tidak maka, halaman akan 404 not found!-->
                                        <?php if($realisasi->acc_adminkeu_id == 4): ?>
                                            <form action="<?php echo e(route('realisasi.revisi', $realisasi->slug)); ?>" method="get">
                                                <?php echo csrf_field(); ?>
                                                <button class="btn btn-warning" style="padding-right:20px; padding-left:20px; margin-top:5px;">
                                                    <i class="fas fa-edit"></i>Revisi
                                                </button>
                                            </form>
                                        <?php else: ?>
                                            <form action="<?php echo e(route('realisasi.show', $realisasi->slug)); ?>" method="get">
                                                <?php echo csrf_field(); ?>
                                                <button class="btn btn-info" style="padding-right:20px; padding-left:20px; margin-top:5px;">
                                                    <i style="margin-right: 5px;" class="fas fa-eye"></i>Detail
                                                </button>
                                            </form>
                                        <?php endif; ?>
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
            <?php echo e($realisasis->links()); ?>

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
<?php echo $__env->make('layouts.main',['title' => 'Daftar Realisasi Anggaran'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ASUS\OneDrive\Documents\GitHub\Laravel\HRIS-Kopma\resources\views/realisasi/index.blade.php ENDPATH**/ ?>