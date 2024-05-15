@extends('layout')

@section('content')
<main class="login-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Add Fasilitas</div>
                    <div class="card-body">

                        <form action="{{ route('facilities.store') }}" method="POST">
                            @csrf
                            <div class="form-group row mt-3">
                                <label for="nama_fasilitas" class="col-md-4 col-form-label text-right">Nama Fasilitas</label>
                                <div class="col-md-6">
                                    <input type="text" id="nama_fasilitas" class="form-control" name="nama_fasilitas" required autofocus>
                                    @if ($errors->has('nama_fasilitas'))
                                    <span class="text-danger">{{ $errors->first('nama_fasilitas') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mt-3">
                                <label for="alamat" class="col-md-4 col-form-label text-right">Alamat Fasilitas</label>
                                <div class="col-md-6">
                                    <input type="text" id="alamat" class="form-control" name="alamat" required autofocus>
                                    @if ($errors->has('alamat'))
                                    <span class="text-danger">{{ $errors->first('alamat') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row mt-3">
                                <label for="pj_fasilitas" class="col-md-4 col-form-label text-right">PJ Fasilitas</label>
                                <div class="col-md-6">
                                    <input type="text" id="pj_fasilitas" class="form-control" name="pj_fasilitas" required autofocus>
                                    @if ($errors->has('pj_fasilitas'))
                                    <span class="text-danger">{{ $errors->first('pj_fasilitas') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row mt-3">
                                <label for="harga_sewa" class="col-md-4 col-form-label text-right">Harga Sewa</label>
                                <div class="col-md-6">
                                    <input type="number" id="harga_sewa" class="form-control" name="harga_sewa" required>
                                    @if ($errors->has('harga_sewa'))
                                    <span class="text-danger">{{ $errors->first('harga_sewa') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mt-3">
                                <label for="harga_kelola" class="col-md-4 col-form-label text-right">Harga Kelola</label>
                                <div class="col-md-6">
                                    <input type="number" id="harga_kelola" class="form-control" name="harga_kelola" required>
                                    @if ($errors->has('harga_kelola'))
                                    <span class="text-danger">{{ $errors->first('harga_kelola') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 offset-md-4 mt-3 p-2 d-grid">
                                <button type="submit" class="btn btn-primary">
                                    Save
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection