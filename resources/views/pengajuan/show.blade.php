@extends('layouts.main',['title' => 'Detail Pengajuan'])
@section('content')
<div class="card card-info col-sm-12">
    <div class="card-header justify-content-between">
        <h3 class="card-title">Formulir Pengajuan Anggaran</h3>


    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="row">
            <table class="table table-bordered">
                <tr>
                    <td style="width: 14rem;"><b>Tanggal Mengajukan</b></td>
                    <td> {{\Carbon\Carbon::parse($pengajuan->created_at)->format('d/m/Y')}}</td>
                </tr>
                <tr>
                    <td><b>Email</b></td>
                    <td> {{$pengajuan->email}}</td>
                </tr>
                <tr>
                    <td><b>Nama Lengkap</b></td>
                    <td> {{ $pengajuan->nama_user }}</td>
                </tr>
                <tr>
                    <td><b>Bidang</b></td>
                    <td> {{ $pengajuan->bidang }}</td>
                </tr>
                <tr>
                    <td><b>No. WA</b></td>
                    <td> {{ $pengajuan->no_tlp }}</td>
                </tr>
                <tr>
                    <td><b>File Anggaran</b></td>
                    <td>
                        {{$pengajuan->file_anggaran}}
                        <p style="margin-top: 8px;">
                            <a class="btn btn-primary" href="{{ asset('files/pengajuan_anggaran/'.$pengajuan->file_anggaran) }}" target="_blank">
                                <i class="fas fa-file-excel"></i>
                                Open Excel file
                            </a>
                        </p>
                    </td>
                </tr>
                <tr>
            </table>
            <!-- /.card-body -->

        </div>
    </div>
</div>
@endsection