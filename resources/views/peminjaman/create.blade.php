@extends('layouts.main',['title' => 'Form Pengajuan Peminjaman'])
@section('content')
<div class="card card-info col-sm-12">
    <div class="card-header">
        <h3 class="card-title">Formulir Pengajuan Peminjaman</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">

        <form action="{{ route('pinjam.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="exampleSelectRounded0">Bulan Pengajuan</label>
                        <select class="custom-select rounded-0" id="bln_pinjam" name="bln_pinjam">
                            <option value="">Januari</option>
                            <option value="">Februari</option>
                            <option value="">Maret</option>
                            <option value="">April</option>
                            <option value="">Mei</option>
                            <option value="">Juni</option>
                            <option value="">Juli</option>
                            <option value="">Agustus</option>
                            <option value="">September</option>
                            <option value="">Oktober</option>
                            <option value="">November</option>
                            <option value="">Desember</option>
                        </select>
                        <div class="text-danger">
                            @error('bln_pinjam')
                            {{$message}}
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Nominal Peminjaman</label><br>
                        
                        <input type="text" class="form-control" id="nominal" name="nominal" value="{{ old('nominal') }}">
                        <div class="text-danger">
                            @error('nominal')
                            {{$message}}
                            @enderror
                        </div>
                        <small><i>*Peminjaman Minimal Rp.500.000,00 Maksimal Rp.800.000,00</i></small>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="exampleSelectRounded0">Angsuran Perbulan</label>
                        <select class="custom-select rounded-0" id="angsuran" name="angsuran">
                            @for ($i = 2; $i < 5; $i++) <option value="{{$i}}">{{$i}} x angsur</option>
                                @endfor
                        </select>
                        <div class="text-danger">
                            @error('angsuran')
                            {{$message}}
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Alamat Email</label>
                        <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}">
                        <div class="text-danger">
                            @error('email')
                            {{$message}}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>No.Telp Aktif (WA)</label>
                        <input type="text" class="form-control" id="no_telp" name="no_telp" value="{{ old('no_telp') }}">
                        <div class="text-danger">
                            @error('no_telp')
                            {{$message}}
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <!-- textarea -->
                    <div class="form-group">
                        <label>Alasan Peminjaman</label>
                        <textarea class="form-control" rows="3" id="keterangan" name="keterangan" placeholder="Tambahkan keterangan ...">{{ old('keterangan') }}</textarea>
                        <div class="text-danger">
                            @error('keterangan')
                            {{$message}}
                            @enderror
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
                        @error('lampiran')
                            {{$message}}
                        @enderror
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

@endsection