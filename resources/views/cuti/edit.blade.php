@extends('layouts.main',['title' => 'Form Pengajuan Cuti'])
@section('content')


<div class="card card-info col-sm-12">
    <div class="card-header">
        <h3 class="card-title">Persetujuan Cuti Karyawan</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        @if($role == 2 && $cuti->acc_mandiv_id == 3 && $cuti->acc_hrd_id >= 2)
        <div class="row">
            <table class="table table-bordered">
                <tr>
                    <td> <b>Nama Lengkap</b></td>
                    <td> {{$cuti->user->name}}</td>
                </tr>
                <tr>
                    <td> <b>Nomor Induk Karyawan</b></td>
                    <td> {{$cuti->user->nik}}</td>
                </tr>
                <tr>
                    <td><b>Jabatan</b></td>
                    <td> {{$cuti->user->role->nama}}</td>
                </tr>
                <tr>
                    <td><b>Divisi</b></td>
                    <td> {{$cuti->user->divisi->nama}}</td>
                </tr>
                <tr>
                    <td><b>Jenis Kelamin</b></td>
                    <td> {{$cuti->user->gender}}</td>
                </tr>
                <tr>
                    <td><b>Jenis Cuti</b></td>
                    <td> {{$cuti->kategori->nama}}</td>
                </tr>
                <tr>
                    <td><b>Tanggal Mulai</b></td>
                    <td> {{\Carbon\Carbon::parse($cuti->tgl_mulai)->format('d/m/Y')}}</td>
                </tr>
                <tr>
                    <td><b>Tanggal Selesai</b></td>
                    <td> {{\Carbon\Carbon::parse($cuti->tgl_selesai)->format('d/m/Y')}}</td>
                </tr>
                <tr>
                    <td><b>Keterangan</b></td>
                    <td> {!! nl2br($cuti->keterangan) !!}</td>
                </tr>
                <tr>
                    <td><b>Lampiran</b></td>
                    <td>
                        @if($cuti->lampiran)
                        <a href="/cuti/lampiran/{{$cuti->slug}}" target="_blank">
                            <img class="img-fluid" src="{{asset($cuti->takeImageCuti)}}" width="100" height="120">
                        </a>
                        @else -
                        @endif
                    </td>
                </tr>
                <tr>
                    <td><b>Acc Mandiv</b></td>
                    <td> {{$cuti->acc_mandiv->nama}}</td>
                </tr>
                <tr>
                    <td><b>Acc HRD</b></td>
                    <td> {{$cuti->acc_hrd->nama}}</td>
                </tr>
            </table>
        </div>
        <!-- /.card-header -->
        @else
        <div class="row">
            <div class="callout callout-info col-sm-12 mb-4">
                <h6><b>Informasi</b></h6>
                <p>Sisa Cuti Tahunan {{$cuti->user->name}}: {{$sisaCutis}} Hari</p>
            </div>
            <table class="table table-bordered">
                <tr>
                    <td> <b>Nama Lengkap</b></td>
                    <td> {{$cuti->user->name}}</td>
                </tr>
                <tr>
                    <td> <b>Nomor Induk Karyawan</b></td>
                    <td> {{$cuti->user->nik}}</td>
                </tr>
                <tr>
                    <td><b>Jabatan</b></td>
                    <td> {{$cuti->user->role->nama}}</td>
                </tr>
                <tr>
                    <td><b>Divisi</b></td>
                    <td> {{$cuti->user->divisi->nama}}</td>
                </tr>
                <tr>
                    <td><b>Jenis Kelamin</b></td>
                    <td> {{$cuti->user->gender}}</td>
                </tr>
            </table>
        </div>

        <form action="{{ route('cuti.update', $cuti->slug) }}" method="post">
            @method('patch')
            @csrf

            <input value="{{$sisaCutis}}" id="sisa_cuti" name="sisa_cuti" hidden>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="exampleSelectRounded0">Jenis Cuti</label>
                        <select class="custom-select rounded-0" id="kategori" name="kategori">
                            <option value="{{$cuti->kategori->id}}">{{$cuti->kategori->nama}}</option>
                        </select>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Tanggal Mulai</label>
                        <input type="date" class="form-control" id="tgl_mulai" name="tgl_mulai" value="{{old('tgl_mulai') ?? $cuti->tgl_mulai}}">
                        <div class="text-danger">
                            @error('tgl_mulai')
                            {{$message}}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Tanggal Selesai</label>
                        <input type="date" class="form-control" id="tgl_selesai" name="tgl_selesai" value="{{old('tgl_selesai') ?? $cuti->tgl_selesai}}">
                        <div class="text-danger">
                            @error('tgl_selesai')
                            {{$message}}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-sm-7">
                    <!-- textarea -->
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea class="form-control" rows="3" id="keterangan" name="keterangan" placeholder="Enter ...">{{old('keterangan') ?? $cuti->keterangan}}</textarea>
                        <div class="text-danger">
                            @error('keterangan')
                            {{$message}}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-sm-5">
                    <label>Lampiran</label><br>
                    @if($cuti->lampiran)
                    <a href="/cuti/lampiran/{{$cuti->slug}}" target="_blank">
                        <img class="img-fluid" src="{{asset($cuti->takeImageCuti)}}" width="100" height="120">
                    </a>
                    @else -
                    @endif
                </div>

            </div>
            <div class="row">
                <div class="col-sm-3" {{$role == 2  ?  '' : 'hidden' }}>
                    <div class="form-group">
                        <label for="exampleSelectRounded0">Acc Mandiv</label>
                        <select class="custom-select rounded-0" id="acc_mandiv" name="acc_mandiv">
                            @foreach($acc_mandivs as $acc_mandiv)
                            <option {{$acc_mandiv->id == $cuti->acc_mandiv_id ? 'selected' : ''}} value="{{$acc_mandiv->id}}">{{$acc_mandiv->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-3" {{$cuti->acc_mandiv_id == 3 && $role == 1 ? '' :'hidden'}}>
                    <div class="form-group">
                        <label for="exampleSelectRounded0">Acc HRD</label>
                        <select class="custom-select rounded-0" id="acc_hrd" name="acc_hrd">
                            @foreach($acc_hrds as $acc_hrd)
                                @if($acc_hrd->id !== 4)
                                <option {{$acc_hrd->id == $cuti->acc_hrd_id ? 'selected' : ''}} value="{{$acc_hrd->id}}">{{$acc_hrd->nama}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#createModal">
                <i class="fas fa-save"></i>
                    Simpan
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
                            <p>Pastikan data konfirmasi sudah benar.</p>
                            <p>Perubahan data pengajuan harap hubungi karyawan yang bersangkutan </p>
                                <div class="d-flex justify-content-between">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button class="btn btn-sm btn-success" type="submit">Simpan</button>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        @endif
    </div>
    <!-- /.card-body -->
</div>

@endsection