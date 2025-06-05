<?php

namespace App\Imports;

use App\Models\Category;
use App\Models\Subcategory;
use Spatie\SimpleExcel\SimpleExcelReader;
use Illuminate\Support\Str;

class CategorySubcategoryImport
{
    // For importing only categories
    public function import(string $filePath): void
    {
        SimpleExcelReader::create($filePath)
            ->getRows()
            ->each(function (array $row) {
                $name = trim($row['name'] ?? '');
                $slug = trim($row['slug'] ?? Str::slug($name));

                if (!$name) return;

                Category::firstOrCreate(['name' => $name], ['slug' => $slug]);
            });
    }

    // For importing subcategories
    public function importSubcategories(string $filePath): void
    {
        SimpleExcelReader::create($filePath)
            ->getRows()
            ->each(function (array $row) {
                $categoryName = trim($row['category_name'] ?? '');
                $subcategoryName = trim($row['name'] ?? '');
                $subcategorySlug = trim($row['slug'] ?? Str::slug($subcategoryName));

                if (!$categoryName || !$subcategoryName) return;

                $category = Category::where('name', $categoryName)->first();

                if (!$category) return; // discard if category not found

                Subcategory::firstOrCreate(
                    ['name' => $subcategoryName, 'category_id' => $category->id],
                    ['slug' => $subcategorySlug]
                );
            });
    }
}
