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

            <p>
                Silahkan Konfirmasi Pinjaman Anda ke nomor WhatsApp di bawah ini. <br>
                Faisal : 0856-0733-8372 <br>
                Ade : 0896-5298-8826
            </p>
        </div>
        <div class="row">
            <div class="col-sm-10">
                <a href="{{ route('pinjam.create') }}" class="btn btn-success">
                    <i class="fas fa-plus-square"></i>
                    Ajukan Permohonan Peminjaman</a>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><strong>Riwayat Pengajuan Peminjaman Anda</strong></h3>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">

                            <thead>
                                <tr>
                                    <th>Waktu Mengajukan</th>
                                    <th>Bulan Pengajuan</th>
                                    <th>Nominal</th>
                                    <th>Konfirmasi HRD</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pinjams as $pinjam)
                                @if($pinjam->acc_hrd_id == 1)
                                <tr style="color:tomato;">
                                    @else
                                <tr>
                                    @endif

                                    <td>{{ \Carbon\Carbon::parse($pinjam->created_at)->format('d/m/Y') }}</td>
                                    <td>{{ $pinjam->bln_pinjam }}</td>
                                    <td> {{ "Rp".number_format($pinjam->nominal, 2, ',', '.') }}</td>
                                    <td>{{ $pinjam->acc_hrd->nama }}</td>
                                    <td>
                                        <!-- PERHATIAN! Saat hosting semua tombol harus di dalam tag <form> dan memiliki @csrf-->
                                        <!-- PERHATIAN! Jika tidak maka, halaman akan 404 not found!-->

                                        <form action="{{ route('pinjam.show', $pinjam->slug) }}" method="get">
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
            {{ $pinjams->links() }}
        </div>
    </div>
</section>
@endsection
