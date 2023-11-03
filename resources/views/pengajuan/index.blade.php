@extends('layouts.main',['title' => 'Daftar Pengajuan'])
@section('content')
<div class="card card-info col-sm-12 p-0">
    <div class="card-header">
        <h1 class="card-title">Daftar Pengajuan Anggaran</h1>
    </div>
</div>
@include('layouts.alert')

<section class="container">

    <div class="container-fluid">
        <div class="callout callout-info col-sm-12 mb-4">
            <h6><b>Informasi</b></h6>

            <p>
                Halaman ini berisi riwayat pengajuan anggaran anda. Semua anggaran yang pernah bidang anda ajukan akan tercatat di sini. <br>
                Silahkan Konfirmasi Pengajuan anggaran Anda ke nomor WhatsApp di bawah ini. <br>
                Efina : 0853-2741-0870 <br>

                <br>
            <p style="color: red;"><i> PERHATIAN ! </i></p>
            <p><i> Mohon pastikan anda berkoordinasi dengan Ketua Bidang terlebih dahulu sebelum mengajukan anggaran ya! </i></p>
            </p>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <a href="{{ route('pengajuan.create') }}" class="btn btn-success">
                    <i class="fas fa-plus-square"></i>
                    Ajukan Anggaran</a>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><strong>Riwayat Pengajuan Anggaran Anda</strong></h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">

                            <thead align="center">
                                <tr>
                                    <th>Nama Staff</th>
                                    <th>File Anggaran</th>
                                    <th>Tanggal Mengajukan</th>

                                    <th>Konfirmasi Adminkeu Kopma UGM</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody align="center">
                                @foreach($pengajuans as $pengajuan)
                                <tr>
                                    <td>{{$pengajuan->nama_user}}</td>
                                    <td>
                                        {{$pengajuan->file_anggaran}}
                                    </td>
                                    <td>{{\Carbon\Carbon::parse($pengajuan->created_at)->format('d/m/Y')}}</td>

                                    <td>
                                        @if ($pengajuan->acc_adminkeu_id == 3)
                                            <i style="background-color: rgb(104, 255, 104); border-radius: 10px; padding: 5px 15px;">
                                                {{$pengajuan->acc_adminkeu->nama}}
                                            </i>
                                        @elseif ($pengajuan->acc_adminkeu_id == 2)
                                            <i style="background-color: rgb(255, 104, 104); border-radius: 10px; padding: 5px 20px;">
                                                {{$pengajuan->acc_adminkeu->nama}}
                                            </i>
                                        @else
                                            <i style="background-color: rgb(201, 201, 201); border-radius: 10px; padding: 5px 15px;">
                                                {{$pengajuan->acc_adminkeu->nama}}
                                            </i>
                                        @endif
                                    </td>

                                    <td>
                                        <!-- PERHATIAN! Saat hosting semua tombol harus di dalam tag <form> dan memiliki @csrf-->
                                        <!-- PERHATIAN! Jika tidak maka, halaman akan 404 not found!-->

                                        <form action="{{ route('pengajuan.show', $pengajuan->slug) }}" method="get">
                                            @csrf
                                            <button class="btn btn-info" style="padding-right:20px; padding-left:20px; margin-top:5px;">
                                                <i class="fa fa-pencil"></i>Detail
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
        <div class="d-flex justify-content-end">
            {{$pengajuans->links()}}
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