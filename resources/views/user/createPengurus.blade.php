@extends('layouts.main',['title' => 'Tambah Karyawan|Pengurus'])
@section('content')
<div class="card card-info col-sm-12">
    <div class="card-header">
        <h3 class="card-title">Isikan data Pengurus pada formulir berikut</h3>
    </div>
    @include('layouts.alert')
    <!-- /.card-header -->
    <div class="card-body">

        <form action="{{ route('kelola.store') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-sm-9">
                    <div class="form-group">
                        <label for="exampleSelectRounded0">Jabatan</label>
                        <select class="custom-select rounded-0" id="role" name="role">
                            <option disabled selected>-Pilih Jabatan-</option>
                            @foreach($roles as $role)
                            @if($role->id !==1)
                            <option value="{{$role->id}}">{{$role->nama}}</option>
                            @endif
                            @endforeach
                        </select>
                        <div class="text-danger">
                            @error('role')
                            {{$message}}
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="col-sm-9">
                    <div class="form-group">
                        <label for="exampleSelectRounded0">Divisi</label>
                        <select class="custom-select rounded-0" id="divisi" name="divisi">
                            <option disabled selected>-Pilih Divisi-</option>
                            @foreach($divisis as $divisi)
                            @if($divisi->id !== 1)
                            <option value="{{$divisi->id}}">{{$divisi->nama}}</option>
                            @endif
                            @endforeach
                        </select>
                        <div class="text-danger">
                            @error('divisi')
                            {{$message}}
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-9">
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" class="form-control" id="name" name="name" autocomplete="off">
                        <div class="text-danger">
                            @error('name')
                            {{$message}}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-sm-9">
                    <div class="form-group">
                        <label>NIK</label>
                        <input type="text" class="form-control" id="nik" name="nik" autocomplete="off">
                        <div class="text-danger">
                            @error('nik')
                            {{$message}}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-sm-9">
                    <div class="form-group">
                        <label for="exampleSelectRounded0">Jenis Kelamin</label>
                        <select class="custom-select rounded-0" id="gender" name="gender">
                            <option disabled selected>-Pilih Gender-</option>
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
                <div class="col-sm-9">
                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir">
                        <div class="text-danger">
                            @error('tgl_lahir')
                            {{$message}}
                            @enderror
                        </div>
                    </div>
                </div>

                
            </div>
            <div class="row">
                <div class="col-sm-9">
                    <div class="form-group">
                        <label>No Handphone</label>
                        <input type="text" class="form-control" id="no_hp" name="no_hp" autocomplete="off">
                        <div class="text-danger">
                            @error('no_hp')
                            {{$message}}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-sm-9">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" id="email" name="email" autocomplete="off">
                        <div class="text-danger">
                            @error('email')
                            {{$message}}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-sm-9">
                    <div class="form-group">
                        <label>Kata Sandi</label> <i class="fas fa-eye" style="float: right;" onclick="myfunction()"></i>
                        <input type="password" class="form-control" id="password" name="password">
                        <!-- <input type="checkbox" onclick="myfunction()"> tampilkan -->

                        <div class="text-danger">
                            @error('password')
                            {{$message}}
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-plus-square"></i>
                    Daftar
                </button>
            </div>
        </form>

    </div>
    <!-- /.card-body -->
</div>

<script>
    function myfunction() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>
@endsection