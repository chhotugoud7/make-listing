@extends('front.layouts.app')

@section('main')

<section class="section-3 py-5 bg-2">
  <div class="container">
    <div class="row mb-4 align-items-center">
      <div class="col-md-8">
        <h3 style="color:#ff8c00">Search here</h3>
      </div>
      <div class="col-md-4">
        <form method="GET" action="{{ route('search') }}">
          {{-- <select name="sort" id="sort" class="form-control" onchange="this.form.submit()">
            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest</option>
            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest</option>
            <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
            <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
          </select> --}}
          <!-- Hidden inputs to preserve filters on sort -->
          @foreach(request()->except('sort', 'page') as $key => $value)
            @if(is_array($value))
              @foreach($value as $val)
                <input type="hidden" name="{{ $key }}[]" value="{{ $val }}">
              @endforeach
            @else
              <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endif
          @endforeach
        </form>
      </div>
    </div>

    <div class="row">
      <!-- Sidebar Filters -->
      <div class="col-md-4 col-lg-3 mb-4">
        <div class="card border-0 shadow p-4">
          <form method="GET" action="{{ route('search') }}">
            {{-- Category --}}
            <div class="mb-4">
              <label for="category_id" class="form-label">Category</label>
              <select name="category_id" id="category_id" class="form-control">
                <option value="">Select Category</option>
                @foreach($categories as $category)
                  <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                  </option>
                @endforeach
              </select>
            </div>

            {{-- Subcategory --}}
            <div class="mb-4">
              <label for="subcategory_id" class="form-label">Subcategory</label>
              <select name="subcategory_id" id="subcategory_id" class="form-control">
                <option value="">Select Subcategory</option>
                @foreach($subcategories as $subcategory)
                  <option value="{{ $subcategory->id }}" {{ request('subcategory_id') == $subcategory->id ? 'selected' : '' }}>
                    {{ $subcategory->name }}
                  </option>
                @endforeach
              </select>
            </div>

            {{-- Location --}}
            <div class="mb-4">
              <label for="location" class="form-label">Location</label>
              <input type="text" name="location" id="location" class="form-control" placeholder="Enter location" value="{{ request('location') }}">
            </div>

            {{-- Price Range --}}
            {{-- <div class="mb-4 row">
              <div class="col">
                <label for="min_price" class="form-label">Min Price</label>
                <input type="number" name="min_price" id="min_price" class="form-control" min="0" placeholder="Min price" value="{{ request('min_price') }}">
              </div>
              <div class="col">
                <label for="max_price" class="form-label">Max Price</label>
                <input type="number" name="max_price" id="max_price" class="form-control" min="0" placeholder="Max price" value="{{ request('max_price') }}">
              </div>
            </div> --}}

            {{-- Tags --}}
            <div class="mb-4">
              <label for="tags" class="form-label">Tags (comma separated)</label>
              <input type="text" name="tags" id="tags" class="form-control" placeholder="tag1, tag2, tag3" value="{{ request('tags') }}">
            </div>

            {{-- Search Text --}}
            <div class="mb-4">
              <label for="search_text" class="form-label">Search Text</label>
              <input type="text" name="search_text" id="search_text" class="form-control" placeholder="Title or description" value="{{ request('search_text') }}">
            </div>

            {{-- Submit --}}
            <div class="d-grid gap-2">
              <button type="submit" class="btn btn-primary btn-lg">Search</button>
              <a href="{{ route('search') }}" class="btn btn-secondary btn-lg">Reset Filters</a>
            </div>
          </form>
        </div>
      </div>

      <!-- Search Results -->
        <!-- Search Results -->
<div class="col-md-8 col-lg-9">
    @if($posts->count())
        <div class="row g-4">
            @foreach($posts as $post)
                <div class="col-md-6 col-lg-4">
                    <div class="modern-card border-0 shadow-sm rounded h-100">
                        @if($post->images->first())
                            <img src="{{ asset('storage/' . $post->images->first()->image_path) }}" 
                                class="card-img-top" 
                                alt="{{ $post->title }}">
                        
                        @endif
                        <div class="modern-card-body d-flex flex-column">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="card-text text-truncate">{{ Str::limit($post->description, 100) }}</p>

                            <div class="mb-2">
                                <span class="badge bg-info me-1">{{ $post->category->name ?? 'Uncategorized' }}</span>
                                @if($post->subcategory)
                                    <span class="badge bg-secondary">{{ $post->subcategory->name }}</span>
                                @endif
                            </div>

                            <p class="mb-1 text-muted small">
                                {{-- <strong>Price:</strong> Rs. {{ number_format($post->price) }} <br> --}}
                                <strong>Location:</strong> {{ $post->location ?? 'N/A' }}
                            </p>

                            <div class="mt-auto">
                                <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary btn-sm w-100">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $posts->links() }}
        </div>
    @else
        <p class="text-danger fs-5">🚫 No results found. Please try different filters!</p>
    @endif
</div>



    </div>
  </div>
</section>

{{-- Optional: JS to update subcategory dropdown based on selected category --}}
<script>
    document.getElementById('category_id').addEventListener('change', function () {
        let categoryId = this.value;
        fetch('/api/subcategories/' + categoryId)
            .then(response => response.json())
            .then(data => {
                let subcategorySelect = document.getElementById('subcategory_id');
                subcategorySelect.innerHTML = '<option value="">Select Subcategory</option>';
                data.forEach(function (subcat) {
                    subcategorySelect.innerHTML += `<option value="${subcat.id}">${subcat.name}</option>`;
                });
            });
    });
</script>

@endsection
