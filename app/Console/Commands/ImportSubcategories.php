<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Imports\CategorySubcategoryImport;

class ImportSubcategories extends Command
{
    protected $signature = 'import:subcategories {file}';
    protected $description = 'Import subcategories from Excel file';

    public function handle()
    {
        $filePath = $this->argument('file');

        if (!file_exists($filePath)) {
            $this->error("File does not exist: $filePath");
            return 1;
        }

        (new CategorySubcategoryImport())->importSubcategories($filePath);

        $this->info('✅ Subcategories imported successfully.');
        return 0;
    }
}
