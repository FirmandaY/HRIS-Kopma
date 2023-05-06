@extends('layouts.main',['title' => 'Kelola Karyawan'])
@section('content')
<div class="card card-info col-sm-12 p-0">
    <div class="card-header">
        <h3 class="card-title">Kelola Data Karyawan</h3>
    </div>
</div>
@include('layouts.alert')
<section class="container">
    <div class="container-fluid">
        <div class="row justify-content-between">

            <a href="{{ route('kelola.daftarKaryawan') }}" class="btn btn-success">
                <i class="fas fa-plus-square"></i>
                Tambah Karyawan Baru</a>

            <!-- <a href="{{ route('kelola.trashed') }}" class="btn btn-danger">
                <i class="fas fa-file"></i>
                Data Karyawan Terhapus</a> -->

        </div>
        <hr>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><strong>Daftar Karyawan</strong></h3>
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
                                        <!-- PERHATIAN! Saat hosting semua tombol harus di dalam tag <form> dan memiliki @csrf-->
                                        <!-- PERHATIAN! Jika tidak maka, halaman akan 404 not found!-->

                                        <form action="{{ route('kelola.edit', $user->nik) }}" method="get">
                                            @csrf
                                            <button class="btn btn-warning" onClick="return confirm ('Yakin mau diubah?')"
                                            style="padding-right:20px; padding-left:20px; margin-top:5px;"> 
                                                <i class="fa fa-pencil"></i>Ubah 
                                            </button>
                                        </form>
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