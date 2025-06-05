<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Imports\CategorySubcategoryImport;

class ImportCategorySubcategory extends Command
{
    protected $signature = 'import:category-subcategory {file}';
    protected $description = 'Import categories from Excel file';

    public function handle()
    {
        $filePath = $this->argument('file');

        if (!file_exists($filePath)) {
            $this->error("File does not exist: $filePath");
            return 1;
        }

        (new CategorySubcategoryImport())->import($filePath);

        $this->info('✅ Categories imported successfully.');
        return 0;
    }
}





