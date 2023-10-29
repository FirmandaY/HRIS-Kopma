@extends('layouts.main',['title' => 'Form Pengajuan Cuti'])
@section('content')
@include('layouts.alert')
<div class="card card-info col-sm-12">
    <div class="card-header">
        <h3 class="card-title">Formulir Pengajuan Anggaran Bidang</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <form action="{{ route('pengajuan.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="exampleSelectRounded0">Nama Lengkap Anda</label>
                        <input type="text" class="form-control" id="nama_user" name="nama_user" required>
                        <div class="text-danger">
                            @error('nama_user')
                            {{$message}}
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="exampleSelectRounded0">Nomor Telepon / WhatsApp</label>
                        <input type="number" class="form-control" id="no_tlp" name="no_tlp" required>
                        <div class="text-danger">
                            @error('no_tlp')
                            {{$message}}
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="exampleSelectRounded0">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                        <div class="text-danger">
                            @error('email')
                            {{$message}}
                            @enderror
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
                            @error('bidang')
                            {{$message}}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="file_anggaran">Lampiran Form Anggaran</label>
                        <p>
                            <small><i>*format form anggaran dapat diakses melalui <a href="linktr.ee/KeuanganKopma">linktr.ee/KeuanganKopma</a></i></small>
                        </p>
                        <p>
                            <small><i>*format file: .pdf .xslx | ukuran maksimal file 2MB</i></small>
                        </p>
                        
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" id="file_anggaran" name="file_anggaran" required>
                            </div>
                        </div>
                        <div class="text-danger">
                            @error('file_anggaran')
                            {{$message}}
                            @enderror
                        </div>
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

@endsection