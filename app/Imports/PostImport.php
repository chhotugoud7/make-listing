<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\SimpleExcel\SimpleExcelReader;
use App\Models\Post;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Location;

class ImportPosts extends Command
{
    protected $signature = 'import:posts';
    protected $description = 'Import posts from a CSV file';

    public function handle()
    {
        $filePath = storage_path('app/posts.csv'); // Make sure the file exists here

        SimpleExcelReader::create($filePath)->getRows()->each(function (array $row) {
            $category = Category::where('name', $row['category'])->first();
            $subcategory = Subcategory::where('name', $row['subcategory'])->first();
            $location = Location::where('name', $row['location'])->first();

            if (!$category || !$location) {
                $this->warn("Skipping row with missing category or location: " . json_encode($row));
                return;
            }

            Post::create([
                'title' => $row['title'],
                'description' => $row['description'],
                'category_id' => $category->id,
                'subcategory_id' => $subcategory?->id,
                'location_id' => $location->id,
                'price' => $row['price'] ?? null,
                'status' => $row['status'] ?? 'active',
                'location' => $row['location_text'] ?? $row['location'],
                'latitude' => $row['latitude'] ?? null,
                'longitude' => $row['longitude'] ?? null,
                'contact_name' => $row['contact_name'],
                'email' => $row['email'],
                'phone' => $row['phone'],
                'tags' => $row['tags'] ?? null,
                'is_featured' => $row['is_featured'] ?? 0,
                'admin_status' => $row['admin_status'] ?? 'pending',
            ]);
        });

        $this->info('✅ Posts imported successfully!');
    }
}
