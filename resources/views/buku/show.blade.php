@extends('layouts.app')

@section('title', 'Detail Buku - Perpustakaan Kampus')

@section('content')

<div class="breadcrumb">

    <a href="{{ route('home') }}">
        Beranda
    </a>

    <span>/</span>

    <a href="{{ route('buku.index') }}">
        Koleksi Buku
    </a>

    <span>/</span>

    Detail Buku

</div>


@if ($dataBuku)

<section class="detail-section">

    <div class="detail-heading">

        <h2>
            Detail Buku
        </h2>

        <p>
            Informasi lengkap mengenai buku.
        </p>

    </div>


    <div class="book-detail">

        <div class="detail-main">

            <span class="detail-category">
                {{ $dataBuku['kategori'] }}
            </span>

            <h1>
                {{ $dataBuku['judul'] }}
            </h1>

            <p class="detail-author">
                {{ $dataBuku['penulis'] }}
            </p>

        </div>


        <div class="detail-information">

            <div class="detail-row">

                <span>ID Buku</span>

                <strong>
                    {{ $dataBuku['id'] }}
                </strong>

            </div>


            <div class="detail-row">

                <span>Judul Buku</span>

                <strong>
                    {{ $dataBuku['judul'] }}
                </strong>

            </div>


            <div class="detail-row">

                <span>Penulis</span>

                <strong>
                    {{ $dataBuku['penulis'] }}
                </strong>

            </div>


            <div class="detail-row">

                <span>Tahun Terbit</span>

                <strong>
                    {{ $dataBuku['tahun'] }}
                </strong>

            </div>


            <div class="detail-row">

                <span>Kategori</span>

                <strong>
                    {{ $dataBuku['kategori'] }}
                </strong>

            </div>

        </div>


        <div class="detail-actions">

            <a
                href="{{ route('buku.index') }}"
                class="secondary-button"
            >
                Kembali ke Koleksi
            </a>

        </div>

    </div>

</section>


@else

<section class="not-found-section">

    <h2>
        Buku Tidak Ditemukan
    </h2>

    <p>
        Data buku dengan ID tersebut tidak tersedia.
    </p>

    <a
        href="{{ route('buku.index') }}"
        class="primary-button"
    >
        Kembali ke Koleksi Buku
    </a>

</section>

@endif

@endsection