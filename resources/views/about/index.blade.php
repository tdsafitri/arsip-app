@extends('layouts.app')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>About</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Hoverable rows start -->
        <section class="section">
            <div class="card">
                <div class="card-content">
                    <div class="row m-4">
                        <div class="col-2">
                            <img src="{{ asset('2.jpg') }}" alt="" width="100%" height="100%" class="rounded">
                        </div>
                        <div class="col-10">
                            <p class="fw-4">
                                Aplikasi ini dibuat oleh: Tifania Safitri<br>
                                Nama:  Tifania Dwi Safitri <br>
                                Kategori: Aplikasi Pengarsipan <br>
                                Tanggal: 12 Oktober 2022 <br>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Hoverable rows end -->

    </div>
@endsection
