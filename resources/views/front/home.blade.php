@extends('front.layouts.app')

@section('main')
{{-- <section class="section-0 lazy d-flex bg-image-style dark align-items-center "   class="" data-bg="{{ asset('assets/images/banner5.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-12 col-xl-8">
                <h1>Search Properties Around The Word</h1>
                <p>Thounsands of properties available.</p>
                <div class="banner-btn mt-5"><a href="/search" class="btn btn-primary mb-4 mb-sm-0">Search Me</a></div>
            </div>
        </div>
    </div>
</section> --}}
<section class="section-3 py-5 bg-light">
    <div class="container">
        <div class="search-summary text-center my-4">
    <h3 class="headline">
        Search across
        <span class="animated-count">
            <span class="count-number">4.7 Crore+</span>
            <span class="highlight">Businesses</span>
        </span>
        &
        <span class="animated-count">
            <span class="count-number">5.9 Crore+</span>
            <span class="highlight">Products & Services</span>
        </span>
    </h3>
</div>

        <form method="GET" action="{{ route('search') }}">
            <div class="row justify-content-center align-items-center">
                <!-- Location -->
                <div class="col-md-3 mb-3">
                    <input type="text" 
                           name="location" 
                           class="form-control form-control-lg" 
                           placeholder="📍 Enter City (e.g. Mumbai)" 
                           value="{{ request('location') }}">
                </div>

                <!-- Keyword Search -->
                <div class="col-md-6 mb-3">
                    <input type="text" 
                           name="search_text" 
                           class="form-control form-control-lg" 
                           placeholder="Search for Products or Services" 
                           value="{{ request('search_text') }}">
                </div>

                <!-- Submit -->
                <div class="col-md-2 mb-3">
                    <button type="submit" class="btn btn-warning btn-lg w-100">
                        <i class="fas fa-search"></i> Search
                    </button>
                </div>
            </div>
        </form>
    </div>
</section>





{{-- latest post section 
 --}}


 {{-- Latest Posts Section --}}
@if ($latestPosts->isNotEmpty())
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
@endif
{{-- end latest post section --}}
   
{{-- @if ($latestPosts->isNotEmpty())
    <section class="section-3 bg-2 py-5">
        <div class="container">
            <h2 class="mb-4">Latest Posts</h2>

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

                    @foreach ($latestPosts as $post)
                        <div class="scroll-card">
                      
                            <div class="card border-0 p-3 shadow mb-4">
                                <div class="card-body">
                                    <h3 class="fs-5 pb-2 mb-0">{{ $post->title }}</h3>
                                    <p>{{ Str::words($post->description, 10, '...') }}</p>
                                
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endif --}}






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
                                {{-- @if($post->price)
                                    <p class="mb-0">
                                        <strong>Price:</strong> ₹{{ number_format($post->price, 2) }}
                                    </p>
                                @endif --}}
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
 
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.querySelector('input[name="search_text"]');
        const suggestionBox = document.createElement('div');
        suggestionBox.classList.add('autocomplete-suggestions');
        searchInput.parentNode.appendChild(suggestionBox);

        let timeout = null;
        searchInput.addEventListener('input', function () {
            clearTimeout(timeout);
            let query = this.value.trim();
            if (query.length < 2) {
                suggestionBox.innerHTML = '';
                return;
            }

            timeout = setTimeout(() => {
                fetch(`/autocomplete?query=${encodeURIComponent(query)}`)
                    .then(response => response.json())
                    .then(data => {
                        suggestionBox.innerHTML = '';
                        if (data.length === 0) {
                            suggestionBox.innerHTML = '<div class="p-2">No suggestions found</div>';
                            return;
                        }
                        data.forEach(item => {
                            const div = document.createElement('div');
                            div.textContent = item;
                            div.classList.add('p-2', 'border-bottom', 'bg-white', 'cursor-pointer');
                            div.style.cursor = 'pointer';
                            div.addEventListener('click', function () {
                                searchInput.value = item;
                                suggestionBox.innerHTML = '';
                            });
                            suggestionBox.appendChild(div);
                        });
                    });
            }, 300);
        });
    });
</script>

<style>
.autocomplete-suggestions {
    position: absolute;
    z-index: 9999;
    background: #fff;
    border: 1px solid #ddd;
    max-height: 200px;
    overflow-y: auto;
    width: 100%;
}
</style>



@endsection