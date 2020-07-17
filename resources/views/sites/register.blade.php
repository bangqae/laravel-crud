@extends('layouts.frontend')

@section('header')

@endsection

@section('content')
<!-- start banner Area -->
<section class="banner-area relative about-banner" id="home" style="
    background: url('{{ config('sekolah.top_banner_url') }}'); 
    background-size: cover;
    background-position-x: center;
    background-position-y: center;">
    <div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                <h1 class="text-white">
                    Pendaftaran
                </h1>
                <p class="text-white link-nav"><a href="/">Home </a> <span class="lnr lnr-arrow-right"></span>
                    <a href="/register"> Pendaftaran</a></p>
            </div>
        </div>
    </div>
</section>
<!-- End banner Area -->

<!-- Start search-course Area -->
<section class="search-course-area relative" style="background: unset">
    <div class="overlay-bg"></div>
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-lg-4 col-md-6 search-course-left">
                <h1 class="">
                    Pendaftaran Online <br>
                    tahun ajaran baru!
                </h1>
                <p>
                    Kurikulum terupdate mengikuti aturan dari kemdikbud.
                </p>
                <div class="row details-content">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 search-course-right section-gap">

                {!! Form::open(['url' => '/postregister', 'class' => 'form-wrap' ]) !!}
                <h4 class="pb-20 text-center mb-30">Formulir Pendaftaran</h4>
                {!! Form::text('nama_depan','', ['class' => 'form-control', 'placeholder' => 'Nama Depan']) !!}
                {!! Form::text('nama_belakang','', ['class' => 'form-control', 'placeholder' => 'Nama Belakang']) !!}
                {!! Form::text('agama','', ['class' => 'form-control', 'placeholder' => 'Agama']) !!}
                {!! Form::email('email','', ['class' => 'form-control', 'placeholder' => 'Email']) !!}
                {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) !!}
                <div class="form-select" id="service-select" style="margin-bottom: 5px;">
                    {!! Form::select('jenis_kelamin',
                    ['' => 'Pilih jenis kelamin','L' => 'Laki-laki', 'P' => 'Perempuan'])
                    !!}
                </div>
                {!! Form::textarea('alamat','', ['class' => 'form-control', 'placeholder' => 'Alamat']) !!}
                {{-- <button class="primary-btn text-uppercase">Submit</button> --}}
                {!! Form::submit('Kirim', ['class' => 'primary-btn text-uppercase']); !!}
                {{-- <input type="submit" class="primary-btn text-uppercase" value="Kirim"> --}}
                {!! Form::close() !!}

            </div>
        </div>
    </div>
</section>
<!-- End search-course Area -->
@endsection

@section('footer')

@endsection
