@extends('front.layouts.app') {{-- Make sure this matches your layout file --}}

@section('main')


<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow border-0 overflow-hidden">

                {{-- Post Image --}}
               @if ($post->images->first())
                <img src="{{ asset('storage/' . $post->images->first()->image_path) }}" class="card-img-top" alt="{{ $post->title }}">
            @endif

                <div class="card-body p-5">
                    {{-- Title --}}
                    <h1 class="fw-bold mb-3 text-primary">{{ $post->title }}</h1>

                    {{-- Category / Subcategory --}}
                    <div class="mb-4">
                        <span class="badge bg-success fs-6 me-2">{{ $post->category->name ?? 'Uncategorized' }}</span>
                        @if ($post->subcategory)
                            <span class="badge bg-secondary fs-6">{{ $post->subcategory->name }}</span>
                        @endif
                    </div>

                    {{-- Description --}}
                    <p class="fs-5 text-dark">{{ $post->description }}</p>

                    <hr>

                    {{-- Post Details --}}
                    <div class="row g-3">
                        <div class="col-md-6">
                            <p><i class="fas fa-map-marker-alt text-danger me-2"></i><strong>Location:</strong> {{ $post->location }}</p>
                            @if ($post->latitude && $post->longitude)
                                <p>
                                    <a href="https://www.google.com/maps?q={{ $post->latitude }},{{ $post->longitude }}" target="_blank" class="text-decoration-none">
                                        <i class="fas fa-map text-info me-2"></i>View on Google Maps
                                    </a>
                                </p>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <p><i class="fas fa-money-bill-wave text-success me-2"></i><strong>Price:</strong> ₹{{ number_format($post->price, 2) }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><i class="fas fa-user text-primary me-2"></i><strong>Posted by:</strong> {{ $post->author->name ?? $post->contact_name }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><i class="fas fa-calendar-alt text-warning me-2"></i><strong>Posted on:</strong> {{ $post->created_at->format('d M Y') }}</p>
                        </div>
                    </div>

                    {{-- Tags --}}
                    @if ($post->tags)
                        <div class="mt-3">
                            <strong><i class="fas fa-tags me-2 text-secondary"></i>Tags:</strong>
                            @foreach (explode(',', $post->tags) as $tag)
                                <span class="badge bg-light border text-dark me-1">{{ trim($tag) }}</span>
                            @endforeach
                        </div>
                    @endif

                    {{-- Contact Info --}}
                    <div class="mt-5 p-4 bg-light rounded border">
                        <h5 class="text-dark mb-3"><i class="fas fa-phone me-2"></i>Contact Details</h5>
                        <p class="mb-1"><strong>Name:</strong> {{ $post->contact_name ?? 'N/A' }}</p>
                        <p class="mb-1"><strong>Email:</strong> <a href="mailto:{{ $post->email }}">{{ $post->email }}</a></p>
                        <p class="mb-0"><strong>Phone:</strong> <a href="tel:{{ $post->phone }}">{{ $post->phone }}</a></p>
                    </div>

                    {{-- Buttons --}}
                    <div class="mt-4 d-flex justify-content-between">
                        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">← Back</a>
                        <a href="tel:{{ $post->phone }}" class="btn btn-primary">📞 Call Now</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
