@extends('layouts.app')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Arsip Surat >> Lihat</h3>
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
            <div class="row" id="table-hover-row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-content m-4 mb-1">
                            <p class="fw-4">
                                Nomor Surat: {{ $arsip->nomor_surat }} <br>
                                Kategori: {{ $arsip->kategori }} <br>
                                Judul: {{ $arsip->judul }} <br>
                                Waktu Unggah: {{ $arsip->created_at }}
                            </p>
                        </div>

                        <object data="{{ asset('arsip') }}/{{ $arsip->nama_file }}" type="application/pdf" width="100%" height="500px"></object>

                        <div class="d-sm-flex align-item-center justify-content-start mb-3 mt-3">
                            <a href="{{ route('arsips.index') }}" class="btn border-dark m-1"><< Kembali</a>
                            <a href="{{ asset('arsip') }}/{{ $arsip->nama_file }}" download="{{ $arsip->nomor_surat }}"
                                class="btn border-dark m-1">Unduh</a>
                            <a href="{{ route('arsips.edit', $arsip->id) }}" class="btn border-dark m-1">Edit/Ganti File</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Hoverable rows end -->

    </div>
@endsection
