@extends('layouts.dashboard')

@section('title', 'Article | HI-Tech ')

@section('content')
<div class="row mb-32 gy-32">
    <div class="col-12">
        <div class="row justify-content-between gy-32">
            <div class="col-12 col-md-4">
                <h4 class="h4">Article</h4>
            </div>
            <div class="col-12 col-md-7">
                <div class="row g-16 align-items-center justify-content-end">
                    <div class="col-12 col-md-6 col-xl-4">
                        <form action="{{route('dashboard.news.index')}}" method="get">

                        <div class="input-group align-items-center">
                            <span class="input-group-text bg-white hp-bg-dark-100 border-end-0 pe-0">
                                <i class="iconly-Light-Search text-black-80" style="font-size: 16px;"></i>
                            </span>
                            <input type="text" class="form-control border-start-0 ps-8" name="search" value="{{request('search')??''}}" placeholder="Search">
                        </div>
                    </form>

                    </div>
                    @can('news-add')
                    <div class="col hp-flex-none w-auto">
                        <button onclick="location.href='{{route('dashboard.news.create')}}';" type="button" class="btn btn-primary w-100">
                            <i class="ri-add-line remix-icon"></i>
                            <span>Add Article</span>
                        </button>
                    </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card hp-contact-card mb-32">
            <div class="card-body px-0">
                <div class="table-responsive">
                    <table class="table align-middle table-hover table-borderless">
                        <thead>
                            <tr>
                                <th>Thumbnail</th>
                                <th>Jenis Koleksi</th>
                                <th>Nama Benda</th>
                                <th>Publish Date</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($data as $item) 

                            <tr>
                                <td>
                                    <div class="avatar-item avatar-lg d-flex align-items-center justify-content-center bg-primary-4 hp-bg-dark-primary text-primary hp-text-color-dark-0">
                                        <img src="{{$item->picture != null ? "/storage/image_uploaded/".$item->picture : asset('app-assets/images/blog.png')}}"
                                            alt="Thumbnail">
                                    </div>
                                </td>
                                <td>
                                    {{$item->jenis_koleksi}}
                                </td>
                                <td>
                                    {{$item->jenis_koleksi}}
                                </td>
                                <td>
                                    {{$item->created_at}}
                                </td>
                                
                                {{-- <td class="text-end"> --}}
                                <td >
                                    @can('news-update')
                                    <a href="{{route('dashboard.news.edit', $item->id)}}" class="btn btn-text text-primary btn-sm"
                                        title="Detail">
                                        <i class="iconly-Light-Show"></i>
                                    </a>
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div>
                    {{$data->links("pagination::bootstrap-4")}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
