            <!-- <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" value="{{Auth::user()->name}}" disabled>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>NIP</label>
                        <input type="text" class="form-control" value="1234" disabled>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Jabatan</label>
                        <input type="text" class="form-control" value="Jabatan" disabled>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Divisi</label>
                        <input type="text" class="form-control" value="Divisi" disabled>
                    </div>
                </div>
            </div> -->

            <!-- <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="exampleSelectRounded0">Jenis Cuti</label>
                        <select class="custom-select rounded-0" id="exampleSelectRounded0">
                            <option>Cuti Reguler</option>
                            <option>Cuti Haid</option>
                        </select>
                    </div>
                </div>
            </div> -->
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Tanggal Mulai</label>
                        <input type="date" class="form-control" id="tgl_mulai" name="tgl_mulai">
                        <div class="text-danger">
                            @error('tgl_mulai')
                            {{$message}}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Tanggal Selesai</label>
                        <input type="date" class="form-control" id="tgl_selesai" name="tgl_selesai">
                        <div class="text-danger">
                            @error('tgl_selesai')
                            {{$message}}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <!-- textarea -->
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea class="form-control" rows="3" id="keterangan" name="keterangan" placeholder="Enter ..."></textarea>
                        <div class="text-danger">
                            @error('keterangan')
                            {{$message}}
                            @enderror
                        </div>
                    </div>
                </div>
                <!-- <div class="col-sm-6">
                    <div class="form-group">
                        <label for="exampleInputFile">Lampiran(optional)</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
            <div class="row justify-content-center">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-plus-square"></i>
                    Ajukan
                </button>
            </div>