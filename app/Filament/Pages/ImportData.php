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
use Illuminate\Support\Facades\Storage;


class ImportData extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.pages.import-data';
    protected static ?string $navigationLabel = 'Import Excel Data';
    protected static ?string $title = 'Import Excel Data';

    public static function canAccess(): bool
    {
       
        // return auth()->Auth::check();
        return true; // Allow access to all authenticated users
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

                // Manually move the file to ensure correct path
                $destinationPath = storage_path('app/imports');
                $file->move($destinationPath, $uniqueName);

                $fullPath = $destinationPath . '/' . $uniqueName;

                Log::info("Uploaded file saved as: " . $fullPath);

                if (!file_exists($fullPath)) {
                    Log::error("File not found at path: " . $fullPath);
                    return back()->with('error', '❌ File not found after saving.');
                }

                SimpleExcelReader::create($fullPath)->getRows()->each(function (array $row) {
                    $name = trim($row['name'] ?? '');
                    if ($name === '') return;

                    $slug = trim($row['slug'] ?? \Illuminate\Support\Str::slug($name));

                    \App\Models\Category::firstOrCreate(
                        ['name' => $name],
                        ['slug' => $slug]
                    );
                });

            
                // dd(session()->all());
                // return redirect()->route('filament.admin.pages.import-data')->with('success', '✅ Categories imported successfully.');

                return redirect()->route('filament.admin.pages.import-data')
                    ->with('success', '✅ Categories imported successfully.');


            } catch (\Throwable $e) {
                Log::error('Category import failed: ' . $e->getMessage());
                // return back()->with('error', '❌ Failed to import categories.');
                return redirect()->route('filament.admin.pages.import-data')
                    ->with('error', '❌ Failed to import categories.');
            }
        }

  public function submitSubcategories(Request $request)
{
    $request->validate([
        'subcategories_file' => 'required|file|mimes:xlsx,csv',
    ]);

    try {
        $file = $request->file('subcategories_file');
        $uniqueName = 'subcategories_' . time() . '.' . $file->getClientOriginalExtension();

        // Match the working logic from submitCategories
        $destinationPath = storage_path('app/imports');
        $file->move($destinationPath, $uniqueName);

        $fullPath = $destinationPath . '/' . $uniqueName;

        Log::info("Uploaded subcategories file saved as: " . $fullPath);

        if (!file_exists($fullPath)) {
            Log::error("Subcategories file not found at path: " . $fullPath);
            return redirect()->route('filament.admin.pages.import-data')
                ->with('error', '❌ File not found after saving.');
        }

        SimpleExcelReader::create($fullPath)->getRows()->each(function (array $row) {
            $categoryName = trim($row['category_name'] ?? '');
            $subcategoryName = trim($row['name'] ?? '');

            if ($categoryName === '' || $subcategoryName === '') return;

            $category = \App\Models\Category::where('name', $categoryName)->first();
            if (!$category) return;

            $subcategorySlug = trim($row['slug'] ?? \Illuminate\Support\Str::slug($subcategoryName));

            \App\Models\Subcategory::firstOrCreate(
                [
                    'name' => $subcategoryName,
                    'category_id' => $category->id,
                ],
                [
                    'slug' => $subcategorySlug,
                ]
            );
        });

        return redirect()->route('filament.admin.pages.import-data')
            ->with('success', '✅ Subcategories imported successfully.');
    } catch (\Throwable $e) {
        Log::error('Subcategory import failed: ' . $e->getMessage());
        return redirect()->route('filament.admin.pages.import-data')
            ->with('error', '❌ Failed to import subcategories.');
    }
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
            // Required fields
            $title = trim($row['title'] ?? '');
            $description = trim($row['description'] ?? '');
            $categoryName = trim($row['category'] ?? '');
            $locationText = trim($row['location'] ?? '');
            $contactName = trim($row['contact_name'] ?? '');
            $email = trim($row['email'] ?? '');
            $phone = trim($row['phone'] ?? '');
            $tags = $row['tags'] ?? null;

            // Skip incomplete rows
            if (
                $title === '' || $description === '' || $categoryName === '' ||
                $locationText === '' || $contactName === '' || $email === '' || $phone === ''
            ) {
                return; // skip invalid row
            }

            // Lookup category
            $category = Category::where('name', $categoryName)->first();
            if (!$category) return;

            // Optional subcategory
            $subcategory = null;
            $subcategoryName = trim($row['subcategory'] ?? '');
            if ($subcategoryName !== '') {
                $subcategory = Subcategory::where('name', $subcategoryName)->first();
            }

            // Optional location_id
            $locationModel = null;
            if ($locationText !== '') {
                $locationModel = Location::firstOrCreate(['name' => $locationText]);
            }

            Post::create([
                'title' => $title,
                'description' => $description,
                'category_id' => $category->id,
                'subcategory_id' => $subcategory?->id,
                'location_id' => $locationModel?->id,
                'location' => $row['location_text'] ?? $locationText,
                'latitude' => is_numeric($row['latitude'] ?? null) ? $row['latitude'] : null,
                'longitude' => is_numeric($row['longitude'] ?? null) ? $row['longitude'] : null,
                'contact_name' => $contactName,
                'email' => $email,
                'phone' => $phone,
                'tags' => $tags,
                'is_featured' => (int) ($row['is_featured'] ?? 0),
                'admin_status' => $row['admin_status'] ?? 'pending',
            ]);
        });

        return redirect()
            ->route('filament.admin.pages.import-data')
            ->with('success', '✅ Posts imported successfully!');
    } catch (\Throwable $e) {
        Log::error('Post import failed: ' . $e->getMessage());

        return redirect()
            ->route('filament.admin.pages.import-data')
            ->with('error', '❌ Failed to import posts.');
    }
}

}
