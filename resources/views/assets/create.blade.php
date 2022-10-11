@extends('layout.main')
@section('container')
<div class="card card-info">
    <form class="form-horizontal" action="/assets" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card-body">
        <div class="form-group row">
            <label for="nm_barang" class="col-sm-2 col-form-label">Nama Barang</label>
            <div class="col-sm-10">
                <input type="text" class="form-control @error('nama_barang') is-invalid @enderror" name="nama_barang" id="nm_barang" autofocus autocomplete="off">
                @error('nama_barang')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label">Nilai Perolehan</label>
            <div class="mt-2">
                Rp
            </div>
            <div class="col-sm-2">
                <input type="number" class="form-control @error('nilai_perolehan') is-invalid @enderror" name="nilai_perolehan" id="">
                @error('nilai_perolehan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label">Jumlah Barang</label>
            <div class="col-sm-1">
                <input type="number" class="form-control @error('jumlah_item') is-invalid @enderror" name="jumlah_item" id="">
                @error('jumlah_item')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div>
                <select class="form-control" name="ukuran_item">
                    <option value="Unit">Unit</option>
                    <option value="Set">set</option>
                    <option value="Pack">Pack</option>
                    <option value="Pcs">Pcs</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label">Tanggal Invoice</label>
            <div class="col-sm-10">
                <input type="date" class="form-control" name="tanggal_invoice">
                @error('')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label">Lokasi</label>
            <div class="col-sm-10">
                <select class="form-control @error('') is-invalid @enderror" name="lokasi_id">
                    <option value="">Pilih Lokasi</option>
                    <option value="Rektorat">Rektorat</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label">Sumber Perolehan</label>
            <div class="col-sm-10">
                <select class="form-control @error('') is-invalid @enderror" name="sumber_perolehan">
                    <option value="">Pilih Sumber Perolehan</option>
                    <option value="apbn">APBN</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label">Golongan Barang</label>
            <div class="col-sm-10">
                <select class="form-control @error('') is-invalid @enderror" name="golongan_barang">
                    <option value="">Pilih Golongan Barang</option>
                    <option value="bergerak">Bergerak</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label">Jenis Barang</label>
            <div class="col-sm-10">
                <select class="form-control @error('') is-invalid @enderror" name="jenis_barang">
                    <option value="">Pilih Jenis Barang</option>
                    <option value="mebeuler">Mebeuler</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label">Kelompok Barang</label>
            <div class="col-sm-10">
                <select class="form-control @error('') is-invalid @enderror" name="kelompok_barang">
                    <option value="">Pilih Kelompok Barang</option>
                    <option value="kursi">Kursi</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label">Pemasok</label>
            <div class="col-sm-10">
                <select class="form-control @error('') is-invalid @enderror" name="pemasok">
                    <option value="">Pilih Pemasok</option>
                    <option value="cv.atmajaya">CV. Atmajaya</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label">Brand</label>
            <div class="col-sm-10">
                <select class="form-control @error('') is-invalid @enderror" name="brand">
                    <option value="">Pilih Brand</option>
                    <option value="vivente">Vivente</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label">Keterangan</label>
            <div class="col-sm-10">
                <textarea class="form-control" rows="3" placeholder="Kursi rektoran..." name="keterangan">
                    
                </textarea>
            </div>
        </div>
        <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label">Umur Penyusutan Barang</label>
            <div class="col-sm-10">
                <textarea class="form-control" rows="3" placeholder="Example: 2 Tahun" name="umur_penyusutan"></textarea>
            </div>
        </div>
        <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label">Image Preview</label>
            <div class="col-sm-10">
                
            </div>
        </div>
        <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label">Upload Gambar</label>
            <div class="col-sm-10">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="exampleInputFile" name="image">
                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label">Stock Barang</label>
            <div class="col-sm-2">
                <select class="form-control @error('') is-invalid @enderror" name="stock">
                    <option value="">Pilih Status</option>
                    <option value="true">Stock</option>
                    <option value="false">Off Stock</option>
                </select>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Tambah</button>
        <a href="/assets" class="btn btn-danger">Kembali</a>
    </div>
    </form>
</div>
@endsection