@extends('layouts.main',['title' => 'Kelola Karyawan'])
@section('content')
<div class="card card-info col-sm-12 p-0">
    <div class="card-header">
        <h3 class="card-title">Kelola Data Karyawan Terhapus</h3>
    </div>
</div>
@include('layouts.alert')
<section class="container">
    <div class="container-fluid">
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
                                        <a href="" class="btn btn-sm btn-success">restore</a>
                                        <a href="" class="btn btn-sm btn-danger">hapus</a>
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