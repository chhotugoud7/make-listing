@extends('front.layouts.app')

@section('main')
<section class="section-0 lazy d-flex bg-image-style dark align-items-center "   class="" data-bg="{{ asset('assets/images/banner5.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-12 col-xl-8">
                <h1>Search Properties Around The Word</h1>
                <p>Thounsands of properties available.</p>
                <div class="banner-btn mt-5"><a href="/search" class="btn btn-primary mb-4 mb-sm-0">Search Me</a></div>
            </div>
        </div>
    </div>
</section>





{{-- latest post section 
 --}}


 {{-- Latest Posts Section --}}
{{-- @if ($latestPosts->isNotEmpty())
    <section class="section-3 bg-2 py-5">
        <div class="container">
            <h2>Latest Posts</h2>
            <div class="row pt-5">
                <div class="job_listing_area">                    
                    <div class="job_lists">
                        <div class="row">
                            @foreach ($latestPosts as $post)
                                <div class="col-md-4">
                                    <div class="card border-0 p-3 shadow mb-4">
                                        <div class="card-body">
                                            <h3 class="fs-5 pb-2 mb-0">{{ $post->title }}</h3>
                                            <p>{{ Str::words($post->description, 10, '...') }}</p>
                                            
                                           
                                            <span class="badge bg-info me-1">
                                                {{ ucfirst($post->category->name ?? 'Uncategorized') }}
                                            </span>

                                            @if ($post->subcategory)
                                                <span class="badge bg-secondary">
                                                    {{ ucfirst($post->subcategory->name) }}
                                                </span>
                                            @endif


                                            <div class="bg-light p-3 border mt-2">
                                                <p class="mb-0">
                                                    <span class="fw-bolder"><i class="fa fa-calendar"></i></span>
                                                    <span class="ps-1">Published on {{ $post->created_at->format('d M, Y') }}</span>
                                                </p>

                                                @if ($post->author)
                                                    <p class="mb-0">
                                                        <span class="fw-bolder"><i class="fa fa-user"></i></span>
                                                        <span class="ps-1">By {{ $post->author->name }}</span>
                                                    </p>
                                                @endif
                                            </div>

                                            <div class="d-grid mt-3">
                                                <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary btn-lg">Read More</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif --}}
{{-- end latest post section --}}
   
@if ($latestPosts->isNotEmpty())
    <section class="section-3 bg-2 py-5">
        <div class="container">
            <h2 class="mb-4">Latest Posts</h2>

            {{-- Scroll container --}}
            <div class="scroll-wrapper">
                <div class="scroll-content">
                    @foreach ($latestPosts as $post)
                        <div class="scroll-card">
                            <div class="card border-0 p-3 shadow mb-4">
                                <div class="card-body">
                                    <h3 class="fs-5 pb-2 mb-0">{{ $post->title }}</h3>
                                    <p>{{ Str::words($post->description, 10, '...') }}</p>

                                    <span class="badge bg-info me-1">
                                        {{ ucfirst($post->category->name ?? 'Uncategorized') }}
                                    </span>

                                    @if ($post->subcategory)
                                        <span class="badge bg-secondary">
                                            {{ ucfirst($post->subcategory->name) }}
                                        </span>
                                    @endif

                                    <div class="bg-light p-3 border mt-2">
                                        <p class="mb-0">
                                            <span class="fw-bolder"><i class="fa fa-calendar"></i></span>
                                            <span class="ps-1">Published on {{ $post->created_at->format('d M, Y') }}</span>
                                        </p>

                                        @if ($post->author)
                                            <p class="mb-0">
                                                <span class="fw-bolder"><i class="fa fa-user"></i></span>
                                                <span class="ps-1">By {{ $post->author->name }}</span>
                                            </p>
                                        @endif
                                    </div>

                                    <div class="d-grid mt-3">
                                        <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary btn-lg">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    {{-- Clone the posts again for loop effect --}}
                    @foreach ($latestPosts as $post)
                        <div class="scroll-card">
                            {{-- Repeat the same content as above --}}
                            <div class="card border-0 p-3 shadow mb-4">
                                <div class="card-body">
                                    <h3 class="fs-5 pb-2 mb-0">{{ $post->title }}</h3>
                                    <p>{{ Str::words($post->description, 10, '...') }}</p>
                                    <!-- repeat the rest... -->
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endif






 {{-- featured section  --}}
@if ($featuredPosts->isNotEmpty())
<section class="section-3 py-5">
    <div class="container">
        <h2>Featured Listings</h2>
        <div class="row pt-3">
            @foreach ($featuredPosts as $post)
                <div class="col-md-4">
                    <div class="card border-0 p-3 shadow mb-4">
                        @if($post->images->first())
                            <img src="{{ asset('storage/' . $post->images->first()->image_path) }}" class="card-img-top" alt="{{ $post->title }}">
                        @endif
                        <div class="card-body">
                            <h3 class="fs-5 pb-2 mb-0">{{ $post->title }}</h3>
                            <p>{{ Str::words($post->description, 10, '...') }}</p>
                            <div class="bg-light p-3 border">
                                <p class="mb-0">
                                    <strong>Location:</strong>
                                    {{ $post->location ?? $post->locationRelation->name ?? 'N/A' }}
                                </p>
                                @if($post->price)
                                    <p class="mb-0">
                                        <strong>Price:</strong> ₹{{ number_format($post->price, 2) }}
                                    </p>
                                @endif
                            </div>
                            <div class="d-grid mt-3">
                                <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary btn-lg">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif



@endsection

@section('customjs')
 
@endsection