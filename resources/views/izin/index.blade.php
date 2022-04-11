@extends('layouts.main',['title' => 'Daftar Pengajuan'])
@section('content')
<div class="card card-info col-sm-12 p-0">
    <div class="card-header">
        <h1 class="card-title">Daftar Pengajuan Izin</h1>
    </div>
</div>
@include('layouts.alert')

<section class="container">

    <div class="container-fluid">
        <div class="callout callout-info col-sm-12 mb-4">
            <h6><b>Informasi</b></h6>

            <p>Halaman ini berisi riwayat pengajuan izin anda. Semua izin yang pernah anda ajukan akan tercatat di sini.</p>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <a href="{{ route('izin.create') }}" class="btn btn-success">
                    <i class="fas fa-plus-square"></i>
                    Ajukan Permohonan Izin</a>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><strong>Riwayat Pengajuan Izin Anda</strong></h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">

                            <thead>
                                <tr>
                                    <th>Tanggal Mengajukan</th>
                                    <th>Konfirmasi Mandiv</th>
                                    <th>Konfirmasi HRD</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($izins as $izin)
                                <tr>
                                    <td>{{\Carbon\Carbon::parse($izin->created_at)->format('d/m/Y')}}</td>
                                    <td>{{$izin->acc_mandiv->nama}}</td>
                                    <td>{{$izin->acc_hrd->nama}}</td>
                                    <td>
                                        <a href="/izin/{{$izin->slug}}" class="btn btn-sm btn-info">detail</a>
                                    </td>
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
        <div class="d-flex justify-content-end">
            {{$izins->links()}}
        </div>
    </div>
</section>

@endsection