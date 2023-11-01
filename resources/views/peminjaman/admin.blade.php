@extends('layouts.main',['title' => 'Daftar Pengajuan'])
@section('content')
<div class="card card-info col-sm-12 p-0">
    <div class="card-header">
        <h1 class="card-title">Daftar Pengajuan Peminjaman</h1>
    </div>
</div>

@include('layouts.alert')

<section class="container">

    <div class="container-fluid">
        <div class="callout callout-info col-sm-12 mb-4">
            <h6><b>Informasi</b></h6>

            <p>Seluruh pengajuan peminjaman dari karyawan akan ditampilkan di sini.</p>
        </div>
        <!-- @can('isAdmin')
        <div class="row">

            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModal">
                <i class="fas fa-trash-alt">
                </i> Hapus Semua Data Peminjaman
            </button>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title" id="exampleModalLabel">Apakah anda yakin akan menjalankan fungsi ini?</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Fungsi ini memungkinkan anda menghapus semua data pengajuan cuti karyawan</p>
                            <p>Biasanya hanya digunakan saat pergantian tahun / kepengurusan.</p>
                            <form action="/pinjam/delete-all" method="post">
                                @method('delete')
                                @csrf
                                <div class="d-flex justify-content-between">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button class="btn btn-sm btn-danger" type="submit">Hapus</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endcan -->
        <!-- <hr> -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><strong>Rekap Permohonan Peminjaman Karyawan</strong></h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            @if($role_id == 1)
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Tanggal Mengajukan</th>
                                    <th>Waktu</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pinjams as $pinjam)
                                @if($pinjam->acc_hrd_id == 1)
                                <tr style="color:tomato;">
                                    @else
                                <tr>
                                    @endif
                                    <td>{{$pinjam->user->name ?? 'None'}}</td>
                                    <td>{{\Carbon\Carbon::parse($pinjam->created_at)->format('d/m/Y')}}</td>
                                    <td>{{ $pinjam->created_at->diffForHumans() }}</td>
                                    <td>{{$pinjam->acc_hrd->nama ?? 'None'}}</td>
                                    <td>
                                        <!-- PERHATIAN! Saat hosting semua tombol harus di dalam tag <form> dan memiliki @csrf-->
                                        <!-- PERHATIAN! Jika tidak maka, halaman akan 404 not found!-->

                                        <form action="{{ route('pinjam.edit', $pinjam->slug) }}" method="get">
                                            @csrf
                                            <button class="btn btn-warning" onClick="return confirm ('Yakin mau diubah?')"
                                            style="padding-right:20px; padding-left:20px; margin-top:5px;"> 
                                                <i class="fas fa-edit"></i>Edit
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            @endif
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <div class="d-flex justify-content-end">
            {{$pinjams->links()}}
        </div>
    </div>
</section>
@endsection