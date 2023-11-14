@extends('layouts.main',['title' => 'Form Realisasi Anggaran Bidang'])
@section('content')


<div class="card card-info col-sm-12">
    @if($role_id == 5)
        <div class="card-header">
            <h3 class="card-title">Persetujuan Pengajuan Realisasi Anggaran Bidang</h3>
        </div>
    @else
    <div class="card-header">
        <h3 class="card-title">Revisi Pengajuan Realisasi Anggaran Bidang</h3>
    </div>
    @endif
    
    <!-- /.card-header -->
    <div class="card-body">
        <div class="row">
            <table class="table table-bordered">
                <tr>
                    <td style="width:20em"> <b>Nama Pemohon</b></td>
                    <td> {{$realisasi->nama_user ?? 'None'}}
                    </td>
                </tr>
                <tr>
                    <td> <b>Asal Bidang</b></td>
                    <td> {{$realisasi->bidang ?? 'None'}}</td>
                </tr>
                <tr>
                    <td><b>Alamat Email Bidang</b></td>
                    <td> {{$realisasi->user->email ?? 'None'}}</td>
                </tr>
                <tr>
                    <td><b>Divisi</b></td>
                    <td> {{$realisasi->user->divisi->nama ?? 'None'}}</td>
                </tr>
                <tr>
                    <td><b>Nomor Telepon Pemohon</b></td>
                    <td> {{ $realisasi->no_tlp }} 
                        <a href="https://wa.me/{{ $realisasi->no_tlp }}">
                            <i class="fab fa-whatsapp" style="font-size:16px; color:green; margin-left:8px;"></i>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td><b>Alamat Email Pemohon</b></td>
                    <td> {{ $realisasi->email }}</td>
                </tr>
                <tr>
                    <td><b>Waktu Pengajuan</b></td>
                    <td>
                        <p>{{\Carbon\Carbon::parse($realisasi->created_at)->format('d M Y')}}</p>
                        <p>
                            Pukul {{\Carbon\Carbon::parse($realisasi->created_at)->format('H:i')}}
                            <i style="background-color: rgb(104, 255, 104); border-radius: 10px; padding: 5px 15px;">
                                {{ $realisasi->created_at->diffForHumans() }}
                            </i>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td><b>Foto SPJ</b></td>
                    <td>
                        <img src="{{ asset('files/foto_spj/'.$realisasi->foto_spj) }}" alt="" height="200px">
                    </td>
                </tr>
                <tr>
                    <td><b>File Form Realisasi Anggaran</b></td>
                    <td>
                        {{$realisasi->file_realisasi}}
                        <p style="margin-top: 8px;">
                            <a class="btn btn-primary" href="{{ asset('files/realisasi_anggaran/'.$realisasi->file_realisasi) }}" target="_blank">
                                <i class="fas fa-file-pdf" style="margin-right: 5px;"></i>
                                Open PDF file
                            </a>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td><b>File Bukti Transaksi</b></td>
                    <td>
                        {{$realisasi->file_bukti_transaksi}}
                        <p style="margin-top: 8px;">
                            <a class="btn btn-primary" href="{{ asset('files/bukti_transaksi/'.$realisasi->file_bukti_transaksi) }}" target="_blank">
                                <i class="fas fa-file-pdf" style="margin-right: 5px;"></i>
                                Open PDF file
                            </a>
                        </p>
                    </td>
                </tr>
            </table>
        </div>

        {{-- Editor Admin --}}
        <form action="{{route('realisasi.update',$realisasi->slug)}}" method="post">
            @method('patch')
            @csrf
            <div class="row">
                <div class="col-sm-3" >
                    <div class="form-group">
                        <label for="exampleSelectRounded0">Acc Adminkeu Kopma UGM (Status)</label>
                        <select class="custom-select rounded-0" id="acc_adminkeu" name="acc_adminkeu" onchange="note()">
                            @foreach($acc_adminkeus as $acc_adminkeu)
                                <option {{$acc_adminkeu->id == $realisasi->acc_adminkeu_id ? 'selected' : ''}} value="{{$acc_adminkeu->id}}">{{$acc_adminkeu->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-1"></div>
                <div id="catatan-form" class="col-sm-4" style="display: none;">
                    <div class="form-group">
                        <label for="exampleSelectRounded0">Catatan</label> <br>
                        <textarea class="form-control" name="catatan"></textarea>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <a href="{{ route('realisasi.adminkeu') }}" class="btn btn-warning" style="margin-right: 15px;">Batal</a>
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
                            <p>Pastikan data konfirmasi anda sudah benar.</p>
                            <p>Perubahan data realisasi harap hubungi bidang yang bersangkutan </p>
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


<script>
    
    function note() {
        var accAdminkeu = document.getElementById("acc_adminkeu");
        if ( accAdminkeu.value == "4") {
            // alert("check");
            document.getElementById("catatan-form").style.display = "block";
        } else {
            document.getElementById("catatan-form").style.display = "none";
        }
    }

</script>

@endsection