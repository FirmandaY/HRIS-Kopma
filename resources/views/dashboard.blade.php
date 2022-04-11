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
                        <i class="ion ion-bag"></i>
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
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="{{route('rekap.izin', ['year' => now()->year])}}" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            
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
                        <i class="ion ion-bag"></i>
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
                        <i class="ion ion-bag"></i>
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
                        <h3 class="card-title"><strong>Daftar Karyawan Cuti Hari ini</strong></h3>
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