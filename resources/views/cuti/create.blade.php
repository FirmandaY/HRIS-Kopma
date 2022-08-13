@extends('layouts.main',['title' => 'Form Pengajuan Cuti'])
@section('content')
@include('layouts.alert')
<div class="card card-info col-sm-12">
    <div class="card-header">
        <h3 class="card-title">Formulir Pengajuan Cuti</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="callout callout-info col-sm-12 mb-4">
            <h6><b>Informasi</b></h6>
            <p>Sisa Cuti Tahunan : {{$sisaCutis}} Hari</p>
        </div>



        <form action="{{ route('cuti.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="exampleSelectRounded0">Jenis Cuti</label>
                        <select class="custom-select rounded-0" id="kategori" name="kategori">
                            <option disabled selected>-Pilih Cuti-</option>
                            @if($role_id == 4)
                            @foreach($kategoris as $kategori)
                            <option value="{{$kategori->id}}">{{ $kategori->nama }}</option>
                            @endforeach
                            @else
                            @foreach($kategoris as $kategori)
                            <option value="{{$kategori->id}}">{{$kategori->nama}}</option>
                            @endforeach
                            @endif
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
                        <label>Tanggal Mulai</label>
                        <input type="date" class="form-control tgl_mulai" id="tgl_mulai" name="tgl_mulai">
                        <div class="text-danger">
                            @error('tgl_mulai')
                            {{$message}}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Tanggal Selesai</label>
                        <input type="date" class="form-control" id="tgl_selesai" name="tgl_selesai">
                        <div class="text-danger">
                            @error('tgl_selesai')
                            {{$message}}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <!-- textarea -->
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea class="form-control" rows="3" id="keterangan" name="keterangan" placeholder="Enter ..."></textarea>
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
                        <small><i>*hanya menerima file dengan format gambar.</i></small>
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
                            <p>Data yang diajukan tidak dapat diubah</p>
                            @if($role_id == 4)
                                <p style="color: red;">
                                    <i>PERHATIAN !</i>
                                </p>
                                <p>
                                    <i>
                                        Mohon pastikan untuk menghubungi Ketua Bidang Terlebih dahulu, sebelum mengajukan pengajuan Cuti ya.
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