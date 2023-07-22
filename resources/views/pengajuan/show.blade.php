@extends('layouts.main',['title' => 'Detail Pengajuan'])
@section('content')
<div class="card card-info col-sm-12">
    <div class="card-header justify-content-between">
        <h3 class="card-title">Formulir Pengajuan Anggaran</h3>


    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <!-- <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" value="Nama" disabled>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>NIP</label>
                        <input type="text" class="form-control" value="1234" disabled>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Jabatan</label>
                        <input type="text" class="form-control" value="Jabatan" disabled>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Divisi</label>
                        <input type="text" class="form-control" value="Divisi" disabled>
                    </div>
                </div>
            </div> -->

        <div class="row">
            <table class="table table-bordered">
                <tr>
                    <td style="width: 14rem;"><b>Tanggal Mengajukan</b></td>
                    <td> {{\Carbon\Carbon::parse($cuti->created_at)->format('d/m/Y')}}</td>
                </tr>
                <tr>
                    <td><b>Email</b></td>
                    <td> {{$cuti->kategori->nama}}</td>
                </tr>
                <tr>
                    <td><b>Nama Lengkap</b></td>
                    <td> {{\Carbon\Carbon::parse($cuti->tgl_mulai)->format('d/m/Y')}}</td>
                </tr>
                <tr>
                    <td><b>Bidang</b></td>
                    <td> {{\Carbon\Carbon::parse($cuti->tgl_selesai)->format('d/m/Y')}}</td>
                </tr>
                <tr>
                    <td><b>No. WA</b></td>
                    <td> {!! nl2br($cuti->keterangan) !!}</td>
                </tr>
                <tr>
                    <td><b>File Anggaran</b></td>
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
            </table>
            <!-- /.card-body -->

        </div>
    </div>
</div>
@endsection