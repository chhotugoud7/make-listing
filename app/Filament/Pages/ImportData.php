<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Http\Request;
use Spatie\SimpleExcel\SimpleExcelReader;
use App\Models\Post;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Location;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Filament\Notifications\Notification;

class ImportData extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.pages.import-data';
    protected static ?string $navigationLabel = 'Import Excel Data';
    protected static ?string $title = 'Import Excel Data';

    public static function canAccess(): bool
    {
        return true;
    }

    public function mount(): void
    {
        session()->forget(['success', 'error']);
    }

    public function submitCategories(Request $request)
    {
        $request->validate([
            'categories_file' => 'required|file|mimes:xlsx,csv',
        ]);

        try {
            $file = $request->file('categories_file');
            $uniqueName = 'categories_' . time() . '.' . $file->getClientOriginalExtension();
            $destinationPath = storage_path('app/imports');
            $file->move($destinationPath, $uniqueName);

            $fullPath = $destinationPath . '/' . $uniqueName;

            if (!file_exists($fullPath)) {
                Log::error("File not found: " . $fullPath);
                Notification::make()->title('❌ File not found after saving.')->danger()->send();
                return redirect()->route('filament.admin.pages.import-data');
            }

            SimpleExcelReader::create($fullPath)->getRows()->each(function (array $row) {
                $name = trim($row['name'] ?? '');
                if ($name === '') return;

                $slug = trim($row['slug'] ?? Str::slug($name));

                Category::firstOrCreate(
                    ['name' => $name],
                    ['slug' => $slug]
                );
            });

            Notification::make()->title('✅ Categories imported successfully.')->success()->send();
        } catch (\Throwable $e) {
            Log::error('Category import failed: ' . $e->getMessage());
            Notification::make()->title('❌ Failed to import categories.')->danger()->send();
        }

        return redirect()->route('filament.admin.pages.import-data');
    }

    public function submitSubcategories(Request $request)
    {
        $request->validate([
            'subcategories_file' => 'required|file|mimes:xlsx,csv',
        ]);

        try {
            $file = $request->file('subcategories_file');
            $uniqueName = 'subcategories_' . time() . '.' . $file->getClientOriginalExtension();
            $destinationPath = storage_path('app/imports');
            $file->move($destinationPath, $uniqueName);

            $fullPath = $destinationPath . '/' . $uniqueName;

            if (!file_exists($fullPath)) {
                Log::error("File not found: " . $fullPath);
                Notification::make()->title('❌ File not found after saving.')->danger()->send();
                return redirect()->route('filament.admin.pages.import-data');
            }

            SimpleExcelReader::create($fullPath)->getRows()->each(function (array $row) {
                $categoryName = trim($row['category_name'] ?? '');
                $subcategoryName = trim($row['name'] ?? '');

                if ($categoryName === '' || $subcategoryName === '') return;

                $category = Category::where('name', $categoryName)->first();
                if (!$category) return;

                $subcategorySlug = trim($row['slug'] ?? Str::slug($subcategoryName));

                Subcategory::firstOrCreate(
                    [
                        'name' => $subcategoryName,
                        'category_id' => $category->id,
                    ],
                    [
                        'slug' => $subcategorySlug,
                    ]
                );
            });

            Notification::make()->title('✅ Subcategories imported successfully.')->success()->send();
        } catch (\Throwable $e) {
            Log::error('Subcategory import failed: ' . $e->getMessage());
            Notification::make()->title('❌ Failed to import subcategories.')->danger()->send();
        }

        return redirect()->route('filament.admin.pages.import-data');
    }

 
    
    public function submitPosts(Request $request)
{
    $request->validate([
        'posts_file' => 'required|file|mimes:xlsx,csv',
    ]);

    try {
        $file = $request->file('posts_file');
        $uniqueName = 'posts_' . time() . '.' . $file->getClientOriginalExtension();
        $path = $file->move(storage_path('app/imports'), $uniqueName);
        $fullPath = $path->getPathname();

        SimpleExcelReader::create($fullPath)->getRows()->each(function (array $row) {
            $title = trim($row['title'] ?? '');
            $description = trim($row['description'] ?? '');
            $categoryName = trim($row['category'] ?? '');
            $locationName = trim($row['location'] ?? '');
            // $contactName = trim($row['contact_name'] ?? '');
            // $email = trim($row['email'] ?? '');
            $phone = trim($row['phone'] ?? '');

            if (
                $title === '' || $description === '' || $categoryName === '' ||
                $locationName === '' || $phone === ''
                // Removed contact_name and email from required check
            ) {
                return;
            }

            $category = Category::where('name', $categoryName)->first();
            if (!$category) return;

            $subcategory = null;
            $subcategoryName = trim($row['subcategory'] ?? '');
            if ($subcategoryName !== '') {
                $subcategory = Subcategory::where('name', $subcategoryName)->first();
            }

            $location = null;
            if ($locationName !== '') {
                $location = Location::firstOrCreate(['name' => $locationName]);
            }

            Post::create([
                'title' => $title,
                'description' => $description,
                'category_id' => $category->id,
                'subcategory_id' => $subcategory?->id,
                'location_id' => $location?->id,
                'location' => trim($row['location_text'] ?? $locationName),
                'latitude' => is_numeric($row['latitude'] ?? null) ? $row['latitude'] : null,
                'longitude' => is_numeric($row['longitude'] ?? null) ? $row['longitude'] : null,
                // 'contact_name' => $contactName,  // commented out
                // 'email' => $email,              // commented out
                'phone' => $phone,
                'tags' => $row['tags'] ?? null,
                'is_featured' => (int) ($row['is_featured'] ?? 0),
                'admin_status' => $row['admin_status'] ?? 'pending',
            ]);
        });

        Notification::make()->title('✅ Posts imported successfully!')->success()->send();
    } catch (\Throwable $e) {
        Log::error('Post import failed: ' . $e->getMessage());
        Notification::make()->title('❌ Failed to import posts.')->danger()->send();
    }

    return redirect()->route('filament.admin.pages.import-data');
}





}
