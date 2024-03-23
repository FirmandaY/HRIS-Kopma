@extends('layouts.main',['title' => 'Daftar Realisasi Anggaran'])
@section('content')
<div class="card card-info col-sm-12 p-0">
    <div class="card-header">
        <h1 class="card-title">Daftar Pengajuan Realisasi Anggaran Bidang</h1>
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
                Anggun : 0857-5112-7247 <br><br>

                <p style="color: red;"><i> PERHATIAN ! </i></p>
                <p><i> Agar tidak terjadi kesalahpahaman, mohon pastikan anda berkoordinasi dengan Ketua Bidang terlebih dahulu sebelum mengajukan anggaran ya! </i></p>
            </p>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <a href="{{ route('realisasi.create') }}" class="btn btn-success">
                    <i class="fas fa-plus-square"></i>
                    Buat Realisasi</a>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><strong>Riwayat Pengajuan Realisasi Anggaran Anda</strong></h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">

                            <thead>
                                <tr>
                                    <th>Nama Staff</th>
                                    <th>Nomor SPJ Anggaran</th>
                                    <th>File Realisasi</th>
                                    <th>Tanggal Mengajukan</th>
                                    <th>Konfirmasi Adminkeu</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody align="center">
                                @foreach($realisasis as $realisasi)
                                <tr>
                                    <td> {{$realisasi->nama_user}} </td>
                                    <td> {{ $realisasi->no_spj }} </td>
                                    <td> {{ $realisasi->file_realisasi }} </td>
                                    <td>{{\Carbon\Carbon::parse($realisasi->created_at)->format('d/m/Y')}}</td>

                                    <td>
                                        @if ($realisasi->acc_adminkeu_id == 4)
                                            <i style="background-color: rgb(245, 255, 104); border-radius: 10px; padding: 5px 15px;">
                                                {{$realisasi->acc_adminkeu->nama}}
                                            </i>
                                        @elseif ($realisasi->acc_adminkeu_id == 3)
                                            <i style="background-color: rgb(104, 255, 104); border-radius: 10px; padding: 5px 15px;">
                                                {{$realisasi->acc_adminkeu->nama}}
                                            </i>
                                        @elseif ($realisasi->acc_adminkeu_id == 2)
                                            <i style="background-color: rgb(255, 104, 104); border-radius: 10px; padding: 5px 20px;">
                                                {{$realisasi->acc_adminkeu->nama}}
                                            </i>
                                        @else
                                            <i style="background-color: rgb(201, 201, 201); border-radius: 10px; padding: 5px 15px;">
                                                {{$realisasi->acc_adminkeu->nama}}
                                            </i>
                                        @endif
                                    </td>

                                    <td>
                                        <!-- PERHATIAN! Saat hosting semua tombol harus di dalam tag <form> dan memiliki @csrf-->
                                        <!-- PERHATIAN! Jika tidak maka, halaman akan 404 not found!-->
                                        @if($realisasi->acc_adminkeu_id == 4)
                                            <form action="{{ route('realisasi.revisi', $realisasi->slug) }}" method="get">
                                                @csrf
                                                <button class="btn btn-warning" style="padding-right:20px; padding-left:20px; margin-top:5px;">
                                                    <i class="fas fa-edit"></i>Revisi
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('realisasi.show', $realisasi->slug) }}" method="get">
                                                @csrf
                                                <button class="btn btn-info" style="padding-right:20px; padding-left:20px; margin-top:5px;">
                                                    <i style="margin-right: 5px;" class="fas fa-eye"></i>Detail
                                                </button>
                                            </form>
                                        @endif
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
            {{$realisasis->links()}}
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