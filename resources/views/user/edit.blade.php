@extends('layouts.main',['title' => 'Edit Profil Pengurus | Karyawan'])
@section('content')
<div class="card card-info col-sm-12">
    <div class="card-header">
        <h3 class="card-title">Profil</h3>
    </div>
    @include('layouts.alert')
    <div class="d-flex justify-content-end">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModal">
            <i class="fas fa-trash-alt"> Hapus </i>
        </button>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalLabel">Yakin ingin menghapus data akun {{$user->name}} ?</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="/anggota/{{$user->nik}}/delete" method="post">
                            @method('delete')
                            @csrf
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button class="btn btn-sm btn-danger" type="submit">Hapus</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <form action="/anggota/{{$user->nik}}/edit" method="post">
            @method('patch')
            @csrf
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{old('name') ?? $user->name}}" autocomplete="off">
                        <div class="text-danger">
                            @error('name')
                            {{$message}}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>NIK</label>
                        <input type="text" class="form-control" id="nik" name="nik" value="{{old('nik') ?? $user->nik}}" autocomplete="off">
                        <div class="text-danger">
                            @error('nik')
                            {{$message}}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" value="{{old('tgl_lahir') ?? $user->tgl_lahir}}">
                        <div class="text-danger">
                            @error('tgl_lahir')
                            {{$message}}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="exampleSelectRounded0">Jenis Kelamin</label>
                        <select class="custom-select rounded-0" id="gender" name="gender">
                            <option disabled selected>-Pilih Gender-</option>
                            <option {{ $user->gender ? 'selected' : ''}} value="{{$user->gender}}">{{$user->gender}}</option>
                            <option value="Pria">Pria</option>
                            <option value="Wanita">Wanita</option>
                        </select>
                        <div class="text-danger">
                            @error('gender')
                            {{$message}}
                            @enderror
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="exampleSelectRounded0">Jabatan</label>
                        <select class="custom-select rounded-0" id="role" name="role">
                            @foreach($roles as $role)
                            @if($role->id !==1)
                            <option {{$role->id == $user->role_id ? 'selected' : ''}} value="{{$role->id}}">{{$role->nama}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="exampleSelectRounded0">Divisi</label>
                        <select class="custom-select rounded-0" id="divisi" name="divisi">
                            @foreach($divisis as $divisi)
                            @if($divisi->id !== 1)
                            <option {{$divisi->id == $user->divisi_id ? 'selected' : ''}} value="{{$divisi->id}}">{{$divisi->nama}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>No Handphone</label>
                        <input type="text" class="form-control" id="no_hp" name="no_hp" value="{{old('no_hp') ?? $user->no_hp}}" autocomplete="off">
                        <div class="text-danger">
                            @error('no_hp')
                            {{$message}}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" id="email" name="email" value="{{old('email') ?? $user->email}}" autocomplete="off">
                        <div class="text-danger">
                            @error('email')
                            {{$message}}
                            @enderror
                        </div>
                    </div>
                </div>
             
            </div>


            <div class="row justify-content-center">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i>
                    Simpan
                </button>
            </div>
        </form>
        <div class="row">
            <div class="col-sm-12">
                <label>Jumlah Cuti Karyawan</label>
                <table class="table table-bordered">
                    <tr>
                        <td>Cuti Tahunan</td>
                        <td align="center">{{$cuti1}} Hari</td>
                    </tr>
                    <tr>
                        <td>Cuti Haid</td>
                        <td align="center">{{$cuti2}} Hari</td>
                    </tr>
                    <tr>
                        <td>Cuti Melahirkan</td>
                        <td align="center">{{$cuti3}} Hari</td>
                    </tr>
                    <tr>
                        <td>Izin</td>
                        <td align="center">{{$izin}}</td>
                    </tr>
                </table>
            </div>
        </div>

    </div>
    <!-- /.card-body -->
</div>

@endsection