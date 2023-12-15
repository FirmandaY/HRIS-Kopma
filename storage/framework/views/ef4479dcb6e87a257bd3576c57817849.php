
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('layouts.alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="card card-info col-sm-12">
    <div class="card-header">
        <h3 class="card-title">Formulir Pengajuan Realisasi Anggaran</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <form action="<?php echo e(route('realisasi.store')); ?>" method="post" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="exampleSelectRounded0">Nama Lengkap Anda</label>
                        <input type="text" class="form-control" id="nama_user" name="nama_user" required>
                        <div class="text-danger">
                            <?php $__errorArgs = ['nama_user'];
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

                    <div class="form-group">
                        <label for="exampleSelectRounded0">Nomor Telepon / WhatsApp Anda</label>
                        <input type="number" class="form-control" id="no_tlp" name="no_tlp" required>
                        <div class="text-danger">
                            <?php $__errorArgs = ['no_tlp'];
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

                    <div class="form-group">
                        <label for="exampleSelectRounded0">Email Anda</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                        <div class="text-danger">
                            <?php $__errorArgs = ['email'];
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

                    <div class="form-group">
                        <label for="exampleSelectRounded0">Bidang Asal</label>
                        <select class="custom-select rounded-0" id="bidang" name="bidang" required>
                            <option disabled selected>-Pilih Bidang-</option>
                            <option>Keanggotaan</option>
                            <option>Bisnis</option>
                            <option>Sumber Daya Manusia</option>
                            <option>Keuangan</option>
                            <option>Hubungan Masyarakat</option>
                            <option>Media Kreatif</option>
                            <option>Riset dan Teknologi</option>
                            <option>Administrasi Umum</option>
                            <option>Pengawas</option>
                        </select>
                        <div class="text-danger">
                            <?php $__errorArgs = ['bidang'];
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
                <div class="col-sm-1">
                    
                </div>
                <div class="col-sm-8">
                    <div class="row" style="margin-bottom: 30px;">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="exampleSelectRounded0">Nomor SPJ</label>
                                <input type="text" class="form-control" id="no_spj" name="no_spj" required>
                                <div class="text-danger">
                                    <?php $__errorArgs = ['no_spj'];
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

                            <div class="form-group">
                                <label for="foto_spj">Lampiran Gambar/Foto Lembar SPJ</label>
                                <p>
                                    <small><i>*format file: .jpg .jpeg .png | ukuran maksimal file 2MB</i></small>
                                </p>
                                
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" id="foto_spj" name="foto_spj" required>
                                    </div>
                                </div>
                                <div class="text-danger">
                                    <?php $__errorArgs = ['foto_spj'];
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

                        <div class="col-sm-1"></div>

                        <div class="col-sm-6">
                            <div class="preview-box" id="imagePreview" style=
                            "
                                width: 40vh;
                                min-height: 200px;
                                border: 2px solid #000;
                                margin-top: 15px;
                                margin-right: 5px;

                                display: flex;
                                align-items: center;
                                justify-content: center;
                                font-weight: bold;
                                color: #000;
                            ">
                                <img src="" class="preview-img" height="200px">
                                <span class="preview-text">Image Preview</span>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row" style="margin-bottom: 30px;">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="exampleSelectRounded0">Sisa Anggaran</label>   <small><i>*jika ada</i></small>
                                <p>
                                    <small><i>*jika ada</i></small>
                                </p>
                                <input type="text" class="form-control" id="sisa_anggaran" name="sisa_anggaran" required>
                                <div class="text-danger">
                                    <?php $__errorArgs = ['sisa_anggaran'];
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

                            <div class="form-group">
                                <label for="foto_spj">Lampiran Gambar/Foto Bukti Pengembalian</label>
                                <p>
                                    <small><i>*format file: .jpg .jpeg .png | ukuran maksimal file 2MB</i></small>
                                </p>
                                
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" id="foto_bukti_pengembalian" name="foto_bukti_pengembalian" required>
                                    </div>
                                </div>
                                <div class="text-danger">
                                    <?php $__errorArgs = ['foto_bukti_pengembalian'];
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

                        <div class="col-sm-1"></div>

                        <div class="col-sm-6">
                            <div class="preview-box" id="imagePreviewPengembalian" style=
                            "
                                width: 40vh;
                                min-height: 200px;
                                border: 2px solid #000;
                                margin-top: 15px;
                                margin-right: 5px;

                                display: flex;
                                align-items: center;
                                justify-content: center;
                                font-weight: bold;
                                color: #000;
                            ">
                                <img src="" class="preview-img-pengembalian" height="200px">
                                <span class="preview-text-pengembalian">Image Preview</span>
                            </div>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="file_realisasi">Lampiran Form Realisasi Anggaran</label>
                                <p>
                                    <small><i>*format form realisasi anggaran dapat diakses melalui <a href="linktr.ee/KeuanganKopma">linktr.ee/KeuanganKopma</a></i></small>
                                </p>
                                <p>
                                    <small><i>*format file: .pdf | ukuran maksimal file 1MB</i></small>
                                </p>
                                
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" id="file_realisasi" name="file_realisasi" required>
                                    </div>
                                </div>
                                <div class="text-danger">
                                    <?php $__errorArgs = ['file_realisasi'];
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
                                <label for="file_bukti_transaksi">Lampiran Bukti Transaksi</label>
                                <p>
                                    <small><i>*berisi bukti transfer maupun nota.</i></small>
                                </p>
                                <p>
                                    <small><i>*format file: .pdf | ukuran maksimal file 2MB</i></small>
                                </p>
                                
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" id="file_bukti_transaksi" name="file_bukti_transaksi" required>
                                    </div>
                                </div>
                                <div class="text-danger">
                                    <?php $__errorArgs = ['file_bukti_transaksi'];
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

                </div>
            </div> <br><br>

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
                            <p>Data yang diajukan tidak dapat diubah</p>
                                <p style="color: red;">
                                    <i>PERHATIAN !</i>
                                </p>
                                <p>
                                    <i>
                                        Mohon pastikan untuk menghubungi Ketua Bidang Terlebih dahulu, sebelum mengajukan pengajuan anggaran ya.
                                        Jika sudah, silahkan lanjutkan pengajuan, dan konfirmasi ke Adminkeu Kopma UGM Melaui kontak yang terlampir. 
                                    </i>
                                </p>
                                <div class="d-flex justify-content-between">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button class="btn btn-sm btn-success" type="submit">Ajukan</button>
                                </div>
                        </div>
                    </div>
                </div>
            </div>

            </div>
        </form>

    </div>
    <!-- /.card-body -->
</div>

<script>
    const inpFileSPJ = document.getElementById("foto_spj");
    const previewContainer = document.getElementById("imagePreview");
    const previewImage = previewContainer.querySelector(".preview-img");
    const previewDefaultText = previewContainer.querySelector(".preview-text");

    const inpFilePengembalian = document.getElementById("foto_bukti_pengembalian");
    const previewContainerPengembalian = document.getElementById("imagePreviewPengembalian");
    const previewImagePengembalian = previewContainerPengembalian.querySelector(".preview-img-pengembalian");
    const previewDefaultTextPengembalian = previewContainerPengembalian.querySelector(".preview-text-pengembalian");

    inpFileSPJ.addEventListener("change", function(){
        const file = this.files[0];

        if(file){
            const reader = new FileReader();
            previewDefaultText.style.display = "none";
            previewImage.style.display = "block"

            reader.addEventListener("load", function(){
                previewImage.setAttribute("src", this.result);
            });
            reader.readAsDataURL(file);
        }else{
            previewDefaultText.style.display = null;
            previewImage.style.display = null;
            previewImage.setAttribute("src", "")

        }
    });

    inpFilePengembalian.addEventListener("change", function(){
        const file = this.files[0];

        if(file){
            const reader = new FileReader();
            previewDefaultTextPengembalian.style.display = "none";
            previewImagePengembalian.style.display = "block"

            reader.addEventListener("load", function(){
                previewImagePengembalian.setAttribute("src", this.result);
            });
            reader.readAsDataURL(file);
        }else{
            previewDefaultTextPengembalian.style.display = null;
            previewImagePengembalian.style.display = null;
            previewImagePengembalian.setAttribute("src", "")

        }
    });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main',['title' => 'Form Realisasi Anggaran Bidang'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ASUS\OneDrive\Documents\GitHub\Laravel\HRIS-Kopma\resources\views/realisasi/create.blade.php ENDPATH**/ ?>