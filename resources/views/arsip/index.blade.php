@extends('layouts.app')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Arsip Surat</h3>
                    <p class="text-subtitle text-muted">Berikut ini adalah surat-surat yang telah terbit dan diarsipkan <br>
                        Klik "Lihat" pada kolom aksi untuk menampilkan surat
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
                        <div class="card-content">
                            {{-- <div class="card-body">
                                <p>Add <code class="highlighter-rouge">.table-hover</code> to enable a hover
                                    state on table
                                    rows
                                    within a
                                    <code class="highlighter-rouge">&lt;tbody&gt;</code>.
                                </p>
                            </div> --}}
                            <!-- table hover -->
                            <div class="table-responsive">
                                <form action="{{ route('arsips.index') }}" method="get">
                                    <div class="row m-3">
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" name="search"
                                                placeholder="Masukkan Judul Surat">
                                        </div>
                                        <div class="col-md-1 p-0">

                                            <button type="submit" class="btn btn-primary">Cari</button>
                                        </div>
                                    </div>
                                </form>
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>Nomor Surat</th>
                                            <th>Kategori</th>
                                            <th>Judul</th>
                                            <th>Waktu Pengerjaan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($arsips as $arsip)
                                            <tr>
                                                <td>{{ $arsip->nomor_surat }}</td>
                                                <td>{{ $arsip->kategori }}</td>
                                                <td>{{ $arsip->judul }}</td>
                                                <td>{{ $arsip->created_at }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="{{ route('arsips.destroy', $arsip->id) }}" name="delete"
                                                            class="btn btn-danger"
                                                            onclick="return confirm('Lanjut hapus data arsip {{ $arsip->judul }}?')">Hapus</a>
                                                        <a href="{{ asset('arsip') }}/{{ $arsip->nama_file }}"
                                                            download="{{ $arsip->nomor_surat }}"
                                                            class="btn btn-warning">Unduh</a>
                                                        <a href="{{ route('arsips.show', $arsip->id) }}"
                                                            class="btn btn-info">Lihat >></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <td class="text-center" colspan="5">Data tidak ada</td>
                                        @endforelse
                                    </tbody>
                                </table>
                                <div class="d-sm-flex align-item-center justify-content-start mb-3 mt-3">
                                    <a href="{{ route('arsips.create') }}" class="btn btn-default border-dark">Arsipkan
                                        Surat</a>
                                </div>
                                <div class="d-sm-flex align-items-center justify-content-end mb-3">
                                    {!! $arsips->links('bootstrap-4') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Hoverable rows end -->

    </div>
@endsection

@push('js')
@endpush
