@extends('layouts.main',['title' => 'Dashboard'])
@section('title','Dashboard')

@section('content')
<div class="card card-info col-sm-12 p-0">
    <div class="card-header">
        <h3 class="card-title">Dashboard</h3>
    </div>
</div>

<div class="container">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{$cuti}}</h3>
                        <p>Rekap Data Cuti</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-book"></i>
                    </div>
                    <a href="{{route('rekap.cuti', ['year' => now()->year])}}" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col">
                <!-- small box -->
                <div class="small-box bg-teal">
                    <div class="inner">
                        <h3>{{$izin}}</h3>
                        <p>Rekap Data Izin</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <a href="{{route('rekap.izin', ['year' => now()->year])}}" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            @can('isAdmin')
            <div class="col">
                <!-- small box -->
                <div class="small-box bg-teal">
                    <div class="inner">
                        <h3>{{$pinjam}}</h3>
                        <p>Rekap Data Peminjaman</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-hand-holding-usd"></i>
                    </div>
                    <a href="{{route('rekap.pinjam', ['year' => now()->year])}}" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            @endcan
            
        </div>
        <div class="row">
            @can('isAdmin')
                <div class="col">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ count($usersKaryawan) }}</h3>
                            <p>Kelola Data Karyawan</p>
                        </div>
                        <div class="icon">
                            <i class="far fa-id-card"></i>
                        </div>
                        <a href="{{route('kelola.index')}}" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
                    </div>

                </div>

                <div class="col">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ count($usersPengurus) }}</h3>
                            <p>Kelola Data Pengurus</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-id-card"></i>
                        </div>
                        <a href="{{route('kelola.indexPengurus')}}" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
                    </div>

                </div>
            @endcan
                
            @can('isAdminkeu')
                <div class="col">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>
                                + {{ count($new_pengajuan) }}
                                @if( count($new_pengajuan) > 0)
                                    <a href="{{route('pengajuan.adminkeu')}}">
                                        <i style='
                                            font-size:16px; 
                                            margin-left: 5px;
                                            padding: 0px 12px; 
                                            border-radius:8px; 
                                            background-color:rgb(0, 87, 128); 
                                            color:rgb(255, 255, 255);
                                        '>Baru</i>
                                    </a>
                                    
                                @endif
                            </h3>
                            <p>Pengajuan Anggaran Bidang</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-file-invoice-dollar"></i>
                        </div>
                        <a href="{{route('rekap.pengajuanAnggaran', ['year' => now()->year])}}" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
                    </div>

                </div>

                <div class="col">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>
                                + {{ count($new_pengajuan) }}
                                @if( count($new_pengajuan) > 0)
                                    <i style='
                                        font-size:16px; 
                                        margin-left: 5px;
                                        padding: 0px 12px; 
                                        border-radius:8px; 
                                        background-color:rgb(0, 87, 128); 
                                        color:white;
                                    '>Baru</i>
                                @endif
                            </h3>
                            <p>Realisasi Anggaran Bidang</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-file-invoice"></i>
                        </div>
                        <a href="{{route('kelola.indexPengurus')}}" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
                    </div>

                </div>
            @endcan

        </div>
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><strong>Daftar Staff dan Karyawan Cuti Hari ini</strong></h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            @if(count($isCuti))
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Divisi</th>
                                    <th>Tanggal Selesai</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($isCuti as $iscuti)
                                <tr>
                                    <td>{{$iscuti->name}}</td>
                                    <td>{{$iscuti->nama}}</td>
                                    <td>{{\Carbon\Carbon::parse($iscuti->tgl_selesai)->format('d/m/Y')}}</td>

                                </tr>
                                @endforeach
                            </tbody>
                            @else
                            <tr>
                                <td>Tidak ada</td>
                            </tr>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><strong>Daftar Karyawan Izin Hari ini</strong></h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            @if(count($isIzin))
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>NIK</th>
                                    <th>Divisi</th>
                                    <th>Waktu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($isIzin as $isizin)
                                <tr>
                                    <td>{{$isizin->name}}</td>
                                    <td>{{$isizin->nik}}</td>
                                    <td>{{$isizin->nama}}</td>
                                    <td>{{$isizin->wkt_mulai}}.00 - {{$isizin->wkt_selesai}}.00</td>
                                </tr>
                                @endforeach
                            </tbody>
                            @else
                            <tr>
                                <td>Tidak ada</td>
                            </tr>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection