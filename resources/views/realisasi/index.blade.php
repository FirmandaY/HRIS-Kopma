@extends('layouts.main',['title' => 'Daftar Pengajuan'])
@section('content')
<div class="card card-info col-sm-12 p-0">
    <div class="card-header">
        <h1 class="card-title">Daftar Pengajuan Realisasi</h1>
    </div>
</div>
@include('layouts.alert')

<section class="container">

    <div class="container-fluid">
        <div class="callout callout-info col-sm-12 mb-4">
            <h6><b>Informasi</b></h6>

            <p>
                Halaman ini berisi riwayat pengajuan realisasi anda. Semua realisasi yang pernah anda ajukan akan tercatat di sini. <br>
                Silahkan Konfirmasi Pengajuan realisasi Anda ke nomor WhatsApp di bawah ini. <br>
                Efina : 0853-2741-0870 <br>

                @if($role == 4)
                <br>
            <p style="color: red;"><i> PERHATIAN ! </i></p>
            <p><i> Mohon Pastikan Anda Menghubungi Ketua Bidang Terlebih dahulu sebelum mengajukan realisasi ya! </i></p>
            @endif
            </p>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <a href="{{ route('cuti.create') }}" class="btn btn-success">
                    <i class="fas fa-plus-square"></i>
                    Ajukan Realisasi</a>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><strong>Riwayat Pengajuan Realisasi Anda</strong></h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">

                            <thead>
                                <tr>
                                    <th>File Realisasi</th>
                                    <th>Tanggal Mengajukan</th>

                                    @if($role != 4)
                                    <th>Konfirmasi Mandiv</th>
                                    @endif

                                    <th>Konfirmasi HRD</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cutis as $cuti)
                                <tr>
                                    <td>{{$cuti->kategori->nama}}</td>
                                    <td>{{\Carbon\Carbon::parse($cuti->created_at)->format('d/m/Y')}}</td>

                                    @if($role != 4)
                                    <td>{{$cuti->acc_mandiv->nama}}</td>
                                    @endif

                                    <td>{{$cuti->acc_hrd->nama}}</td>
                                    <td>
                                        <!-- PERHATIAN! Saat hosting semua tombol harus di dalam tag <form> dan memiliki @csrf-->
                                        <!-- PERHATIAN! Jika tidak maka, halaman akan 404 not found!-->

                                        <form action="{{ route('cuti.show', $cuti->slug) }}" method="get">
                                            @csrf
                                            <button class="btn btn-info" onClick="return confirm ('Yakin mau diubah?')" style="padding-right:20px; padding-left:20px; margin-top:5px;">
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
            {{$cutis->links()}}
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