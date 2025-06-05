<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\SimpleExcel\SimpleExcelReader;
use App\Models\Post;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\User;

class ImportPosts extends Command
{
    protected $signature = 'import:posts {--user=}';
    protected $description = 'Import posts from a CSV file (admin-only)';

    public function handle()
    {
        $userIdentifier = $this->option('user');

        // Validate user
        $user = User::where('email', $userIdentifier)->orWhere('id', $userIdentifier)->first();

        if (!$user || !$user->is_admin) {
            $this->error('❌ Only admin users can run this command.');
            return;
        }

        $filePath = storage_path('app/imports/posts.xlsx');

        if (!file_exists($filePath)) {
            $this->error("❌ CSV file not found at: {$filePath}");
            return;
        }

        SimpleExcelReader::create($filePath)->getRows()->each(function (array $row) {
            $category = Category::where('name', $row['category'])->first();
            $subcategory = Subcategory::where('name', $row['subcategory'])->first();

            if (!$category) {
                $this->warn("Skipping row due to missing category: " . json_encode($row));
                return;
            }

            // Handle lat/long safely
            $latitude = is_numeric($row['latitude']) ? $row['latitude'] : null;
            $longitude = is_numeric($row['longitude']) ? $row['longitude'] : null;

            Post::create([
                'title' => $row['title'],
                'description' => $row['description'],
                'category_id' => $category->id,
                'subcategory_id' => $subcategory?->id,
                'location' => $row['location_text'] ?? $row['location'],
                'latitude' => $latitude,
                'longitude' => $longitude,
                'price' => $row['price'] !== '' ? $row['price'] : null,
                'status' => $row['status'] ?? 'active',
                'contact_name' => $row['contact_name'],
                'email' => $row['email'],
                'phone' => $row['phone'],
                'tags' => $row['tags'] ?? null,
                'is_featured' => $row['is_featured'] ?? 0,
                'admin_status' => $row['admin_status'] ?? 'pending',
            ]);
        });

        $this->info('✅ Posts imported successfully by admin: ' . $user->email);
    }
}
