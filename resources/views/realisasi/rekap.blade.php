@extends('layouts.main',['title' => 'Rekap Data Cuti'])
@section('content')
<div class="card card-info col-sm-12 p-0">
    <div class="card-header">
        <h1 class="card-title">Rekap Pengajuan Realisasi</h1>
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
                    <h3 class="card-title"><strong>Rekap Pengajuan Realisasi</strong></h3>
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
                                <th>Email</th>
                                <th>Nama Pemohon</th>
                                <th>Bidang</th>
                                <th>No.Telepon/WA</th>
                                <th>No.SPJ</th>
                                <th>Bukti Transaksi</th>
                                <th>File SPJ</th>
                                <th>File Realisasi</th>
                                <th>Waktu Realisasi</th>
                                <th>Sisa Uang</th>
                                <th>Status</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($realisasis as $realisasi)
                            <tr>
                                <!-- ?? 'None' update 2 Juni Untuk mengatasi Akses Null di Environment Hosting -->
                                <td>{{$realisasi->email ?? 'None'}}</td>
                                <td>{{$realisasi->nama_user ?? 'None'}}</td>
                                <td>{{$realisasi->bidang ?? 'None'}}</td>
                                <td>{{$realisasi->no_tlp ?? 'None'}}</td>
                                <td>{{$realisasi->no_spj ?? 'None'}}</td>
                                <td>{{$realisasi->file_bukti_transaksi ?? 'None'}}</td>
                                <td>{{$realisasi->foto_spj ?? 'None'}}</td>
                                <td>{{$realisasi->file_realisasi ?? 'None'}}</td>
                                <td>{{$realisasi->created_at->format('d/m/Y')}}</td>
                                <td></td>
                                <td>{{$realisasi->status ?? 'None'}}</td>
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