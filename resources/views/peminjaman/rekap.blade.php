@extends('layouts.main',['title' => 'Rekap Data Peminjaman'])
@section('content')
<div class="card card-info col-sm-12 p-0">
    <div class="card-header">
        <h1 class="card-title">Rekap Pengajuan Peminjaman Karyawan</h1>
    </div>
</div>
<section class="container">
    <div class="container-fluid">
        @can('isAdmin')
        <div class="d-flex">
            <a href="{{ route('izin.export') }}" class="btn btn-success">
                <i class="fas fa-print"></i>
                Print</a>
        </div>
        @endcan
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><strong>Rekap Permohonan Peminjaman Karyawan</strong></h3>
                        <div class="d-flex justify-content-end">
                            @foreach($years as $year)
                            <a href={{route('rekap.izin', ['year' => $year])}}> {{$year}}</a>&nbsp;
                            @endforeach
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">

                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>NIK</th>
                                    <th>Jabatan</th>
                                    <th>Divisi</th>
                                    <th>Waktu Pengajuan</th>
                                    <th>Bulan Pinjam</th>
                                    <th>Acc Mandiv</th>
                                    <th>Acc HRD</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pinjams as $pinjam)
                                <tr>
                                    <!-- ?? 'None' update 2 Juni Untuk mengatasi Akses Null di Environment Hosting -->
                                    <td>{{$pinjam->user->name ?? 'None'}}</td>
                                    <td>{{$pinjam->user->nik ?? 'None'}}</td>
                                    <td>{{$pinjam->user->role->nama ?? 'None'}}</td>
                                    <td>{{$pinjam->user->divisi->nama ?? 'None'}}</td>
                                    <td>{{$pinjam->created_at->format('d/m/Y')}}</td>
                                    <td>{{\Carbon\Carbon::parse($pinjam->bln_pinjam)->format('m/Y')}}</td>
                                    <td>{{$pinjam->acc_mandiv->nama ?? 'None'}}</td>
                                    <td>{{$pinjam->acc_hrd->nama ?? 'None'}}</td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</section>

@endsection