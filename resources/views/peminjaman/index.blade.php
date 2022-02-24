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

                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam sed condimentum nunc, in porta sapien.
                    Vestibulum lacinia est magna. Suspendisse at venenatis risus, nec laoreet eros. Donec ex diam, dapibus
                    sed rhoncus sit amet, rhoncus sit amet nulla. Fusce commodo dapibus velit. Etiam dui sapien,
                    sollicitudin vel quam eget, mollis tempor lacus.</p>
            </div>
            <div class="row">
                <div class="col-sm-12">
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
                                        <th>Waktu Pengembalian</th>
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
                                            <td>{{ \Carbon\Carbon::parse($pinjam->wkt_selesai)->format('d/m/Y') }}</td>
                                            <td> {{ "Rp".number_format($pinjam->nominal, 2, ',', '.') }}</td>
                                            <td>{{ $pinjam->acc_hrd->nama }}</td>
                                            <td>
                                                <a href="/pinjam/{{ $pinjam->slug }}" class="btn btn-sm btn-info">detail</a>
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
