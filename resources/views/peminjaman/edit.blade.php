@extends('layouts.main',['title' => 'Form Pengajuan Izin'])
@section('content')
<!-- <div class="container">
    <div class="d-flex justify-content-end">
        
        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModal">
            <i class="fas fa-trash-alt"></i>
        </button>
    </div>

    
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Yakin ingin menghapus data ini ?</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                </div>
            </div>
        </div>
    </div>

</div> -->
<div class="card card-info col-sm-12">
    <div class="card-header">
        <h3 class="card-title">Persetujuan Peminjaman Karyawan</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">

       
        <div class="row">
            <table class="table table-bordered">
                <tr>
                    <td style="width:20em"> <b>Nama Lengkap</b></td>
                    <td> {{$pinjam->user->name}}
                    </td>
                </tr>
                <tr>
                    <td> <b>Nomor Induk Karyawan</b></td>
                    <td> {{$pinjam->user->nik}}</td>
                </tr>
                <tr>
                    <td><b>Jabatan</b></td>
                    <td> {{$pinjam->user->role->nama}}</td>
                </tr>
                <tr>
                    <td><b>Divisi</b></td>
                    <td> {{$pinjam->user->divisi->nama}}</td>
                </tr>
                <tr>
                    <td><b>Jenis Kelamin</b></td>
                    <td> {{$pinjam->user->gender}}</td>
                </tr>
                <tr>
                    <td><b>Nomor Telepon</b></td>
                    <td> {{ $pinjam->no_telp }} 
                        <a href="https://wa.me/{{ $pinjam->no_telp }}">
                            <i class="fab fa-whatsapp" style="font-size:16px; color:green; margin-left:8px;"></i>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td><b>Alamat Email</b></td>
                    <td> {{ $pinjam->email }}</td>
                </tr>
            </table>
        </div>
        <form action="/pinjam/{{$pinjam->slug}}/edit" method="post">
            @method('patch')
            @csrf
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Waktu pinjam</label> <br>
                        <bold><h4>{{ $pinjam->created_at }}</h4 ></bold> <i>{{ $pinjam->created_at->diffForHumans() }}</i>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Tanggal Mulai</label>
                        <input type="date" class="form-control" id="wkt_pinjam" name="wkt_pinjam" value="{{old('wkt_pinjam') ?? $pinjam->wkt_pinjam}}">
                        <div class="text-danger">
                            @error('wkt_pinjam')
                            {{$message}}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Tanggal Selesai</label>
                        <input type="date" class="form-control" id="wkt_selesai" name="wkt_selesai" value="{{old('wkt_selesai') ?? $pinjam->wkt_selesai}}">
                        <div class="text-danger">
                            @error('wkt_selesai')
                            {{$message}}
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Nominal Peminjaman</label> <br>
                        <bold><h4>{{ "Rp".number_format($pinjam->nominal, 2, ',', '.') }}</h4 ></bold>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <!-- textarea -->
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea class="form-control" rows="3" id="keterangan" name="keterangan">{{old('keterangan') ?? $pinjam->keterangan}}</textarea>
                        <div class="text-danger">
                            @error('keterangan')
                            {{$message}}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <label>Lampiran</label><br>
                    @if($pinjam->lampiran)
                    <a href="/pinjam/lampiran/{{$pinjam->slug}}" target="_blank">
                        <img class="img-fluid" src="{{asset($pinjam->takeImageIzin)}}" width="10" height="20">
                    </a>
                    @else -
                    @endif
                </div>
            </div>
            <div class="row">

                <div class="col-sm-3" >
                    <div class="form-group">
                        <label for="exampleSelectRounded0">Acc HRD</label>
                        <select class="custom-select rounded-0" id="acc_hrd" name="acc_hrd">
                        @foreach($acc_hrds as $acc_hrd)
                                @if($acc_hrd->id !== 4)
                                <option {{$acc_hrd->id == $pinjam->acc_hrd_id ? 'selected' : ''}} value="{{$acc_hrd->id}}">{{$acc_hrd->nama}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#createModal">
                <i class="fas fa-save"></i>
                    Simpan
                </button>
                <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">PERHATIAN!!</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Pastikan data konfirmasi sudah benar.</p>
                            <p>Perubahan data pengajuan harap hubungi karyawan yang bersangkutan </p>
                                <div class="d-flex justify-content-between">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button class="btn btn-sm btn-success" type="submit">Simpan</button>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
    <!-- /.card-body -->
</div>

@endsection