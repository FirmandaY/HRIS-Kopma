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
                        @if($pengajuan->file_anggaran)
                            <iframe src="{{ asset('files/pengajuan_anggaran/'.$pengajuan->file_anggaran) }}" 
                                            width="1200"
                                            height="500"> 
                            </iframe>
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