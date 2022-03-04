
<?php $__env->startSection('content'); ?>
    <div class="card card-info col-sm-12 p-0">
        <div class="card-header">
            <h1 class="card-title">Daftar Pengajuan Peminjaman</h1>
        </div>
    </div>
    <?php echo $__env->make('layouts.alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <section class="container">

        <div class="container-fluid">
            <div class="callout callout-info col-sm-12 mb-4">
                <h6><b>Informasi</b></h6>

                <p>
                    Silahkan Konfirmasi Pinjaman Anda ke nomor WhatsApp di bawah ini. <br>
                    Amanda : 0812-8690-0347 <br>
                    Fishio : 0896-7357-5487
                </p>
            </div>
            <div class="row">
                <div class="col-sm-10">
                    <a href="<?php echo e(route('pinjam.create')); ?>" class="btn btn-success">
                        <i class="fas fa-plus-square"></i>
                        Ajukan Permohonan Peminjaman</a>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><strong>Riwayat Pengajuan Peminjaman Anda</strong></h3>
                            
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">

                                <thead>
                                    <tr>
                                        <th>Waktu Mengajukan</th>
                                        <th>Waktu Pengembalian</th>
                                        <th>Nominal</th>
                                        <th>Konfirmasi HRD</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $pinjams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pinjam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($pinjam->acc_hrd_id == 1): ?>
                                        <tr style="color:tomato;">
                                            <?php else: ?>
                                        <tr>
                                            <?php endif; ?>
                                            
                                            <td><?php echo e(\Carbon\Carbon::parse($pinjam->created_at)->format('d/m/Y')); ?></td>
                                            <td><?php echo e(\Carbon\Carbon::parse($pinjam->wkt_selesai)->format('d/m/Y')); ?></td>
                                            <td> <?php echo e("Rp".number_format($pinjam->nominal, 2, ',', '.')); ?></td>
                                            <td><?php echo e($pinjam->acc_hrd->nama); ?></td>
                                            <td>
                                                <a href="/pinjam/<?php echo e($pinjam->slug); ?>" class="btn btn-sm btn-info">detail</a>
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
                <?php echo e($pinjams->links()); ?>

            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main',['title' => 'Daftar Pengajuan'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ASUS\OneDrive\Documents\GitHub\Laravel\HRIS-Kopma\resources\views/peminjaman/index.blade.php ENDPATH**/ ?>