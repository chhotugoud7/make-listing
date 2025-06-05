<x-filament::page>




    <form method="POST" action="{{ route('filament.pages.import-data.submitCategories') }}" enctype="multipart/form-data" class="mb-6">
        @csrf

                    {{-- Categories Import --}}
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif





        <x-filament::card>
            <h2 class="text-xl font-bold mb-4">📂 Import Categories</h2>

            <x-filament::input
                name="categories_file"
                type="file"
                label="Select Categories Excel (.xlsx or .csv)"
                required
                accept=".csv,.xlsx"
            />

            <x-filament::button type="submit" class="mt-4">Import Categories</x-filament::button>
        </x-filament::card>
    </form>

    {{-- Subcategories Import --}}
    <form method="POST" action="{{ route('filament.pages.import-data.submitSubcategories') }}" enctype="multipart/form-data" class="mb-6">
        @csrf
        <x-filament::card>
            <h2 class="text-xl font-bold mb-4">📂 Import Subcategories</h2>

            <x-filament::input
                name="subcategories_file"
                type="file"
                label="Select Subcategories Excel (.xlsx or .csv)"
                required
                accept=".csv,.xlsx"
            />

            <x-filament::button type="submit" class="mt-4">Import Subcategories</x-filament::button>
        </x-filament::card>
    </form>

    {{-- Posts Import --}}
    <form method="POST" action="{{ route('filament.pages.import-data.submitPosts') }}" enctype="multipart/form-data">
        @csrf
        <x-filament::card>
            <h2 class="text-xl font-bold mb-4">📂 Import Posts</h2>

            <x-filament::input
                name="posts_file"
                type="file"
                label="Select Posts Excel (.xlsx or .csv)"
                required
                accept=".csv,.xlsx"
            />

            <x-filament::button type="submit" class="mt-4">Import Posts</x-filament::button>
        </x-filament::card>
    </form>

    {{-- Flash messages
    @if (session('success'))
        <div class="mt-4 p-4 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="mt-4 p-4 bg-red-100 text-red-800 rounded">{{ session('error') }}</div>
    @endif --}}
</x-filament::page>
