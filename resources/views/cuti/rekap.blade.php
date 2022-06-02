@extends('layouts.main',['title' => 'Rekap Data Cuti'])
@section('content')
<div class="card card-info col-sm-12 p-0">
    <div class="card-header">
        <h1 class="card-title">Rekap Pengajuan Cuti Karyawan</h1>
    </div>
</div>
<section class="container">

    <div class="container-fluid">
        @can('isAdmin')
        <div class="d-flex">
            <a href="{{ route('cuti.export') }}" class="btn btn-success">
                <i class="fas fa-print"></i>
                Print</a>
        </div>
        @endcan
        <div class="row">
            <div class="card">
                <div class="card-header ">
                    <h3 class="card-title"><strong>Rekap Permohonan Cuti Karyawan</strong></h3>
                    <div class="d-flex justify-content-end">
                        @foreach($years as $year)
                        <a href={{route('rekap.cuti', ['year' => $year])}}> {{$year}}</a>&nbsp;
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
                                <th>Jenis Cuti</th>
                                <th>Mengajukan</th>
                                <th>Mulai</th>
                                <th>Selesai</th>
                                <th>Acc Mandiv</th>
                                <th>Acc HRD</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cutis as $cuti)
                            <tr>
                                <!-- ?? 'None' update 2 Juni Untuk mengatasi Akses Null di Environment Hosting -->
                                <td>{{$cuti->user->name ?? 'None'}}</td>
                                <td>{{$cuti->user->nik ?? 'None'}}</td>
                                <td>{{$cuti->user->role->nama ?? 'None'}}</td>
                                <td>{{$cuti->user->divisi->nama ?? 'None'}}</td>
                                <td>{{$cuti->kategori->nama ?? 'None'}}</td>
                                <td>{{$cuti->created_at->format('d/m/Y')}}</td>
                                <td>{{\Carbon\Carbon::parse($cuti->tgl_mulai)->format('d/m/Y')}}</td>
                                <td>{{\Carbon\Carbon::parse($cuti->tgl_selesai)->format('d/m/Y')}}</td>
                                <td>{{$cuti->acc_mandiv->nama ?? 'None'}}</td>
                                <td>{{$cuti->acc_hrd->nama ?? 'None'}}</td>
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
</section>
<script>
    $('.toastsDefaultSuccess').click(function() {
        $(document).Toasts('create', {
            class: 'bg-success',
            title: 'Toast Title',
            subtitle: 'Subtitle',
            body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
    });
</script>
@endsection