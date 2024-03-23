@extends('layouts.main',['title' => 'Rekap Data Cuti'])
@section('content')
<div class="card card-info col-sm-12 p-0">
    <div class="card-header">
        <h1 class="card-title">Rekap Pengajuan Anggaran Bidang</h1>
    </div>
</div>
<section class="container">

    <div class="container-fluid">
        @can('isAdminkeu')
        <div class="d-flex">
            <a href="{{ route('pengajuan.export') }}" class="btn btn-success">
                <i class="fas fa-print"></i>
                Print</a>
        </div>
        @endcan
        <div class="row">
            <div class="card">
                <div class="card-header ">
                    <h3 class="card-title"><strong>Rekap Pengajuan Anggaran Bidang</strong></h3>
                    <div class="d-flex justify-content-end">
                        @foreach($years as $year)
                        <a href={{route('rekap.pengajuanAnggaran', ['year' => $year])}}> {{$year}}</a>&nbsp;
                        @endforeach
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">

                        <thead>
                            <tr>
                                <th>Nama Pemohon</th>
                                <th>Divisi</th>
                                <th>Tanggal Pengajuan</th>
                                <th>File Anggaran</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pengajuans as $pengajuan)
                            @if($pengajuan->acc_hrd_id == 1)
                            <tr style="color:tomato;">
                                @else
                            <tr>
                                @endif
                                <td>{{$pengajuan->nama_user ?? 'None'}}</td>
                                <td>{{$pengajuan->user->divisi->nama ?? 'None'}}</td>
                                <td>{{\Carbon\Carbon::parse($pengajuan->created_at)->format('d/m/Y')}}</td>
                                <td>
                                    {{ $pengajuan->file_anggaran }}
                                </td>
                                <td>
                                    {{$pengajuan->acc_adminkeu->nama ?? 'None'}}
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