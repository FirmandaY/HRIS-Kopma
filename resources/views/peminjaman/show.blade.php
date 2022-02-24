@extends('layouts.main',['title' => 'Form Pengajuan Peminjaman'])
@section('content')
<div class="card card-info col-sm-12">
    <div class="card-header">
        <h3 class="card-title">Formulir Pengajuan Peminjaman</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="row">
            <table class="table table-bordered">
                <tr>
                    <td><b>Tanggal Pengajuan</b></td>
                    <td> {{\Carbon\Carbon::parse($pinjam->created_at)->format('d/m/Y')}}</td>
                </tr>
                <tr>
                    <td><b>Tanggal Pinjam</b></td>
                    <td> {{\Carbon\Carbon::parse($pinjam->wkt_pinjam)->format('d/m/Y')}}</td>
                </tr>
                <tr>
                    <td><b>Tanggal Kembali</b></td>
                    <td> {{\Carbon\Carbon::parse($pinjam->wkt_selesai)->format('d/m/Y')}}</td>
                </tr>
                <tr>
                    <td><b>Nominal Uang</b></td>
                    <td> {{ "Rp".number_format($pinjam->nominal, 2, ',', '.') }}</td>
                </tr>
                <tr>
                    <td><b>Nomor Telepon</b></td>
                    <td> {{ $pinjam->no_telp }}</td>
                </tr>
                <tr>
                    <td><b>Alamat Email</b></td>
                    <td> {{ $pinjam->email }}</td>
                </tr>
                <tr>
                    <td><b>Keterangan</b></td>
                    <td> {!! nl2br($pinjam->keterangan) !!}</td>
                </tr>
                <tr>
                    <td><b>Lampiran</b></td>
                    <td>
                        @if($pinjam->lampiran)
                        <a href="/pinjam/lampiran/{{$pinjam->slug}}" target="_blank">
                            <img class="img-fluid" src="{{asset($pinjam->takeImageIzin)}}" width="100" height="120">
                        </a>
                        @else -
                        @endif
                    </td>
                </tr>
                <tr>
                    <td><b>Konfirmasi HRD</b></td>
                    <td> {{ $pinjam->acc_hrd->nama }}</td>
                </tr>
                <tr>
                    <td style="width: 14rem;"><b>Tanggal Konfirmasi</b></td>
                    <td> {{\Carbon\Carbon::parse($pinjam->updated_at)->format('d/m/Y')}}</td>
                </tr>
            </table>
            <!-- /.card-body -->

        </div>


    </div>
    <!-- /.card-body -->
</div>

@endsection