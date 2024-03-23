
<?php $__env->startSection('content'); ?>



<div class="card card-info col-sm-12">
    <div class="card-header">
        <h3 class="card-title">Profil</h3>
    </div>
    <br>
    <div class="container">
    <!-- /.card-header -->
    <div class="justify-content-center">
        <div class="col-md-5"></div>
        <div class="row">
            <div class="card-body box-profile">
                <div class="text-center">
                    <img src="<?php echo e(asset('layout/dist/img/user.png')); ?>" class="img-circle elevation-1" style="height: 5em;" alt="User Image">
                </div>

                <h3 class="profile-username text-center"><?php echo e($user->name); ?></h3>

                <!-- <p class="text-muted text-center">Software Engineer</p> -->

                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>Nama Lengkap</b>
                        <ul class="float-right"><?php echo e($user->name); ?></ul>
                    </li>
                    <li class="list-group-item">
                        <b>Nomor Induk Karyawan</b>
                        <ul class="float-right"><?php echo e($user->nik); ?></ul>
                    </li>
                    <li class="list-group-item">
                        <b>Divisi</b>
                        <ul class="float-right"><?php echo e($user->divisi->nama); ?></ul>
                    </li>
                    <li class="list-group-item">
                        <b>Jabatan</b>
                        <ul class="float-right"><?php echo e($user->role->nama); ?></ul>
                    </li>
                    <li class="list-group-item">
                        <b>Tanggal Lahir</b>
                        <ul class="float-right"><?php echo e(\Carbon\Carbon::parse($user->tgl_lahir)->format('d/m/Y')); ?></ul>
                    </li>
                    <li class="list-group-item">
                        <b>Jenis Kelamin</b>
                        <ul class="float-right"> <?php echo e($user->gender); ?></ul>
                    </li>
                    <li class="list-group-item">
                        <b>No Handphone</b>
                        <ul class="float-right"> <?php echo e($user->no_hp); ?></ul>
                    </li>
                    <li class="list-group-item">
                        <b>Email</b>
                        <ul class="float-right"> <?php echo e($user->email); ?></ul>
                    </li>
                </ul>
            </div>
        </div>
        <hr>
        <!-- /.card-body -->
        <div class="col-md-12">
            <table class="table table-bordered">
                <tr>
                    <td><b>Cuti Tahunan</b></td>
                    <td style="text-align: right;"><?php echo e($totalCuti1); ?> Hari</td>
                </tr>
                <tr>
                    <td><b>Cuti Haid</b></td>
                    <td style="text-align: right;"><?php echo e($totalCuti2); ?> Hari</td>
                </tr>
                <tr>
                    <td><b>Cuti Melahirkan</b></td>
                    <td style="text-align: right;"><?php echo e($totalCuti3); ?> Hari</td>
                </tr>
                <tr>
                    <td><b>Izin</b></td>
                    <td style="text-align: right;"><?php echo e($izin); ?></td>
                </tr>
            </table>
        </div>
    </div>
    </div>

    <!-- /.card-body -->
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main',['title' => 'Profil'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ASUS\OneDrive\Documents\GitHub\Laravel\HRIS-Kopma\resources\views/user/profil.blade.php ENDPATH**/ ?>