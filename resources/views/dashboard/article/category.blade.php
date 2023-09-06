@extends('layouts.dashboard')

@section('content')
<section class="p-0">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-12 col-md-12 col-lg-8 mt-8 mb-8 mb-lg-0">
                <div class="mb-8 text-center">
                    <h2 class="mt-3 font-w-6">{{ $web->article_title ?? ''}} - {{$category->title}}</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($news as $each_news)
                @include('dashboard.article.single-item')
            @endforeach
        </div>
    </div>
</section>
@endsection
