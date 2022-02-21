
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

            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam sed condimentum nunc, in porta sapien. Vestibulum lacinia est magna. Suspendisse at venenatis risus, nec laoreet eros. Donec ex diam, dapibus sed rhoncus sit amet, rhoncus sit amet nulla. Fusce commodo dapibus velit. Etiam dui sapien, sollicitudin vel quam eget, mollis tempor lacus.</p>
        </div>
        <!-- <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('isAdmin')): ?>
        <div class="row">

            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModal">
                <i class="fas fa-trash-alt">
                </i> Hapus Semua Data Peminjaman
            </button>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title" id="exampleModalLabel">Apakah anda yakin akan menjalankan fungsi ini?</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Fungsi ini memungkinkan anda menghapus semua data pengajuan cuti karyawan</p>
                            <p>Biasanya hanya digunakan saat pergantian tahun / kepengurusan.</p>
                            <form action="/pinjam/delete-all" method="post">
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
        </div>
        <?php endif; ?> -->
        <!-- <hr> -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><strong>Rekap Permohonan Peminjaman Karyawan</strong></h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <?php if($role_id == 1): ?>
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Tanggal Mengajukan</th>
                                    <th>Waktu</th>
                                    <th>Status</th>
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
                                    <td><?php echo e($pinjam->user->name); ?></td>
                                    <td><?php echo e(\Carbon\Carbon::parse($pinjam->created_at)->format('d/m/Y')); ?></td>
                                    <td></td>
                                    <td><?php echo e($pinjam->acc_hrd->nama); ?></td>
                                    <td>
                                        <a href="/pinjam/<?php echo e($pinjam->slug); ?>/edit" class="btn btn-sm btn-info">detail</a>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                            <?php elseif($role_id == 2): ?>
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Tanggal Mengajukan</th>
                                    <th>Waktu</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $pinjams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pinjam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($pinjam->acc_mandiv_id == 1): ?>
                                <tr style="color:tomato;">
                                    <?php else: ?>
                                <tr>
                                    <?php endif; ?>
                                    <td><?php echo e($pinjam->user->name); ?></td>
                                    <td><?php echo e(\Carbon\Carbon::parse($pinjam->created_at)->format('d/m/Y')); ?></td>
                                    <td></td>
                                    <td><?php echo e($pinjam->acc_mandiv->nama); ?></td>
                                    <td>
                                        <a href="/pinjam/<?php echo e($pinjam->slug); ?>/edit" class="btn btn-sm btn-info">detail</a>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                            <?php endif; ?>
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
<?php echo $__env->make('layouts.main',['title' => 'Daftar Pengajuan'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ASUS\OneDrive\Documents\GitHub\Laravel\HRIS-Kopma\resources\views/peminjaman/admin.blade.php ENDPATH**/ ?>