@extends('layouts.main',['title' => 'Kelola Pengurus'])
@section('content')
<div class="card card-info col-sm-12 p-0">
    <div class="card-header">
        <h3 class="card-title">Kelola Data Pengurus</h3>
    </div>
</div>
@include('layouts.alert')
<section class="container">
    <div class="container-fluid">
        <div class="row justify-content-between">

            <a href="{{ route('kelola.daftarPengurus') }}" class="btn btn-success">
                <i class="fas fa-plus-square"></i>
                Tambah Pengurus Baru</a>

            <!-- <a href="{{ route('kelola.trashed') }}" class="btn btn-danger">
                <i class="fas fa-file"></i>
                Data Pengurus Terhapus</a> -->

        </div>
        <hr>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><strong>Daftar Pengurus</strong></h3>
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
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td>{{$user['name']}}</td>
                                    <td>{{$user['nik']}}</td>
                                    <td>{{$user['role']['nama']}}</td>
                                    <td>{{$user['divisi']['nama']}}</td>
                                    <td>
                                        <a href="/anggota/{{$user['nik']}}/edit" class="btn btn-sm btn-info">ubah</a>
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
    </div>
</section>

@endsection