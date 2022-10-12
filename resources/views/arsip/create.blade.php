@extends('layouts.app')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Arsip Surat</h3>
                    <p class="text-subtitle text-muted">Unggah surat yang telah terbit pada form ini untuk diarsipkan <br>
                        <span class="text-danger">Catatan: Gunakan File berformat PDF</span>
                    </p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            {{-- <li class="breadcrumb-item active">Arsip</li> --}}
                            {{-- <li class="breadcrumb-item active" aria-current="page">Table</li> --}}
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Hoverable rows start -->
        <section class="section">

            @if (session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{ session()->get('success') }}
                </div>
            @endif

            <div class="row" id="table-hover-row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>Add New Arsip</h3>
                        </div>
                        <div class="card-content m-4 mt-0">
                            <form action="{{ route('arsips.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-2">
                                        <label for="">Nomor Surat <span class="text-danger">*</span> </label>
                                    </div>
                                    <div class="col-4">
                                        <input type="text"
                                            class="form-control @error('nomor_surat') is-invalid @enderror"
                                            name="nomor_surat" id="nomor_surat" placeholder="Masukkan Nomor Surat"
                                            value="{{ old('nomor_surat') }}">
                                        @error('nomor_surat')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- end nomor surat --}}

                                <div class="row mt-3">
                                    <div class="col-2">
                                        <label for="">Kategori <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-4">
                                        <select name="kategori" id="kategori"
                                            class="form-control  @error('kategori') is-invalid @enderror">
                                            <option value="undangan">Undangan</option>
                                            <option value="pengumuman">Pengumuman</option>
                                            <option value="nota dinas">Nota Dinas</option>
                                            <option value="pemberitahuan">Pemberitahuan</option>
                                        </select>
                                        @error('kategori')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- end kategori --}}

                                <div class="row mt-3">
                                    <div class="col-2">
                                        <label for="">Judul <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-6">
                                        <input type="text" class="form-control @error('judul') is-invalid @enderror"
                                            name="judul" id="judul" placeholder="Masukkan Judul Surat"
                                            value="{{ old('judul') }}">
                                        @error('judul')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- end judul --}}

                                <div class="row mt-3">
                                    <div class="col-2">
                                        <label for="">File Surat (PDF) <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-4">
                                        <input type="file" class="form-control @error('file_arsip') is-invalid @enderror"
                                            name="file_arsip" id="file_arsip" accept=".pdf"
                                            placeholder="Masukkan File Surat">
                                        @error('file_arsip')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- end file surat --}}

                                <a href="{{ route('arsips.index') }}" class="btn btn-info mt-3">
                                    << Kembali</a>
                                        <button type="submit" class="btn btn-success mt-3">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Hoverable rows end -->

    </div>
@endsection
