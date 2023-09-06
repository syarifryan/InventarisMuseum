@extends('layouts.dashboard')

@section('title', 'Dashboard | SIM - KU')

@section('content')
<div class="col-12">

    <div class="col-lg-12 mb-8 order-0">
        <div class="card">
            <div class="d-flex align-items-end row">
                <div class="col-sm-12">
                    <div class="card-body">
                        <h4 class="card-title text-primary">Selamat Datang, di Website Inventaris Koleksi Museum Nasional Indonesia 
                        </h4>
                        <p class="mb-8">
                            Website ini berisikan koleksi-koleksi dan input inventaris koleksi Museum Nasional Indoensia
                        </p>
                        <a href="{{route('dashboard.article.index')}}" class="btn btn-sm btn-outline-primary">Lihat Koleksi</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12 mb-8 order-0">
        <div class="card">
            <div class="d-flex align-items-end row">
                <div class="col-sm-12">
                    <div class="card-body">
                        {{-- <h5 class="card-title text-primary">Selamat Datang, di Website Inventaris Koleksi Museum Nasional Indonesia  --}}
                        {{-- </h5> --}}
                        <p class="mb-8">
                            Pilih Input Inventaris untuk menambahkan inventaris koleksi museum
                        </p>
                        <a href="{{route('dashboard.article.index')}}" class="btn btn-sm btn-outline-secondary">Input Inventaris</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    
</div>
@endsection

@section('js')
<script src="{{ asset('assets/js/chartsloader.js') }}"></script>
    <script type="text/javascript">
       
    </script>

@endsection

