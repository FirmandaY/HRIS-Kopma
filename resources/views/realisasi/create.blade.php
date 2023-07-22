@extends('layouts.main',['title' => 'Form Pengajuan Cuti'])
@section('content')
@include('layouts.alert')
<div class="card card-info col-sm-12">
    <div class="card-header">
        <h3 class="card-title">Formulir Pengajuan Realisasi</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <form action="{{ route('cuti.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="exampleSelectRounded0">Email</label>
                        <input type="email" class="form-control tgl_mulai" id="tgl_mulai" name="tgl_mulai">
                        <div class="text-danger">
                            @error('kategori')
                            {{$message}}
                            @enderror
                        </div>

                        <input value="{{$sisaCutis}}" id="sisa_cuti" name="sisa_cuti" hidden>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="exampleSelectRounded0">Nama Lengkap</label>
                        <input type="text" class="form-control tgl_mulai" id="tgl_mulai" name="tgl_mulai">
                        <div class="text-danger">
                            @error('kategori')
                            {{$message}}
                            @enderror
                        </div>

                        <input value="{{$sisaCutis}}" id="sisa_cuti" name="sisa_cuti" hidden>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="exampleSelectRounded0">Bidang</label>
                        <select class="custom-select rounded-0" id="kategori" name="kategori">
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
                            @error('kategori')
                            {{$message}}
                            @enderror
                        </div>

                        <input value="{{$sisaCutis}}" id="sisa_cuti" name="sisa_cuti" hidden>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="exampleSelectRounded0">No. WA</label>
                        <input type="number" class="form-control tgl_mulai" id="tgl_mulai" name="tgl_mulai">
                        <div class="text-danger">
                            @error('kategori')
                            {{$message}}
                            @enderror
                        </div>

                        <input value="{{$sisaCutis}}" id="sisa_cuti" name="sisa_cuti" hidden>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="exampleSelectRounded0">No. SPJ</label>
                        <input type="number" class="form-control tgl_mulai" id="tgl_mulai" name="tgl_mulai">
                        <div class="text-danger">
                            @error('kategori')
                            {{$message}}
                            @enderror
                        </div>

                        <input value="{{$sisaCutis}}" id="sisa_cuti" name="sisa_cuti" hidden>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="lampiran">Unggah SPJ (jpg)</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" id="lampiran" name="lampiran">
                            </div>
                        </div>
                        @error('lampiran')
                            {{$message}}
                            @enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="lampiran">Bukti Transaksi</label>
                        <small><i>*bukti transaksi disusun rapi menjadi satu file pdf, termasuk bukti transfer uang sisa jika ada</i></small>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" id="lampiran" name="lampiran">
                            </div>
                        </div>
                        @error('lampiran')
                            {{$message}}
                            @enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="lampiran">Form Realisasi (excel)</label>
                        <small><i>*format form realisasi dapat diakses melalui <a href="linktr.ee/KeuanganKopma">linktr.ee/KeuanganKopma</a></i></small>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" id="lampiran" name="lampiran">
                            </div>
                        </div>
                        @error('lampiran')
                            {{$message}}
                            @enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="exampleSelectRounded0">Sisa Uang</label>
                        <input type="text" class="form-control tgl_mulai" id="tgl_mulai" name="tgl_mulai">
                        <div class="text-danger">
                            @error('kategori')
                            {{$message}}
                            @enderror
                        </div>

                        <input value="{{$sisaCutis}}" id="sisa_cuti" name="sisa_cuti" hidden>
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
                            @if($role_id == 4)
                                <p style="color: red;">
                                    <i>PERHATIAN !</i>
                                </p>
                                <p>
                                    <i>
                                        Mohon pastikan untuk menghubungi Ketua Bidang Terlebih dahulu, sebelum mengajukan pengajuan realisasi ya.
                                        Jika sudah, silahkan lanjutkan pengajuan, dan konfirmasi ke SDM. 
                                    </i>
                                </p>
                            @endif
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