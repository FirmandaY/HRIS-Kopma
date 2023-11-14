@extends('layouts.main',['title' => 'Daftar Persetujuan Realisasi Anggaran Bidang'])
@section('content')
<div class="card card-info col-sm-12 p-0">
    <div class="card-header">
        <h1 class="card-title">Daftar Realisasi Anggaran Bidang</h1>
    </div>
</div>
@include('layouts.alert')

<section class="container">

    <div class="container-fluid">
        <div class="callout callout-info col-sm-12 mb-4">
            <h6><b>Informasi</b></h6>

            <p>Seluruh realisasi anggaran dari bidang akan ditampilkan di sini.</p>
        </div>
        <!-- @can('isAdmin')
        <div class="row">
            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModal">
                <i class="fas fa-trash-alt">
                </i> Hapus Semua Data Cuti
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
                            <p>Fungsi ini memungkinkan anda menghapus semua data realisasi cuti karyawan</p>
                            <p>Biasanya hanya digunakan saat pergantian tahun / kepengurusan.</p>
                            <form action="/cuti/delete-all" method="post">
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
        @endcan
        <hr> -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><strong>Daftar realisasi Anggaran</strong></h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            @if($role_id == 5)
                                <thead>
                                    <tr>
                                        <th>Nama Pemohon</th>
                                        <th>Divisi</th>
                                        <th>Tanggal realisasi</th>
                                        <th>File Anggaran</th>
                                        <th>Status</th>
                                        <th>Catatan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($realisasis as $realisasi)
                                    <tr>
                                        <td>{{$realisasi->nama_user ?? 'None'}}</td>
                                        <td>{{$realisasi->user->divisi->nama ?? 'None'}}</td>
                                        <td>{{\Carbon\Carbon::parse($realisasi->created_at)->format('d/m/Y')}}</td>
                                        <td>
                                            {{ $realisasi->file_realisasi }}
                                        </td>
                                        <td>
                                            @if ($realisasi->acc_adminkeu_id == 3)
                                                <i style="background-color: rgb(104, 255, 104); border-radius: 10px; padding: 5px 10px;">
                                                    {{$realisasi->acc_adminkeu->nama ?? 'None'}}
                                                </i>
                                            @elseif ($realisasi->acc_adminkeu_id == 2)
                                                <i style="background-color: rgb(255, 104, 104); border-radius: 10px; padding: 5px 15px;">
                                                    {{$realisasi->acc_adminkeu->nama ?? 'None'}}
                                                </i>
                                            @elseif ($realisasi->acc_adminkeu_id == 4)
                                                <i style="background-color: rgb(255, 252, 104); border-radius: 10px; padding: 5px 15px;">
                                                    {{$realisasi->acc_adminkeu->nama ?? 'None'}}
                                                </i>
                                            @else
                                                <i style="background-color: rgb(201, 201, 201); border-radius: 10px; padding: 5px 10px;">
                                                    {{$realisasi->acc_adminkeu->nama ?? 'None'}}
                                                </i>
                                            @endif
                                        </td>
                                        <td>
                                            @if($realisasi->catatan) 
                                                {{ $realisasi->catatan }}
                                            @else
                                                <p align=center> - </p>
                                            @endif
                                        </td>
                                        <td>
                                            <!-- PERHATIAN! Saat hosting semua tombol harus di dalam tag <form> dan memiliki @csrf-->
                                            <!-- PERHATIAN! Jika tidak maka, halaman akan 404 not found!-->

                                            <form action="{{ route('realisasi.edit', $realisasi->slug) }}" method="get">
                                                @csrf
                                                <button class="btn btn-warning" onClick="return confirm ('Yakin mau diubah?')"
                                                style="padding-right:20px; padding-left:20px; margin-top:5px;"> 
                                                    <i class="fas fa-edit"></i>Edit 
                                                </button>
                                            </form>
                                            
                                        </td>
                                        {{-- <tr>
                                            <td colspan="6">
                                                <b>Catatan</b>
                                            </td>
                                            
                                        </tr> --}}
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
            {{$realisasis->links()}}
        </div>
    </div>
</section>
@endsection