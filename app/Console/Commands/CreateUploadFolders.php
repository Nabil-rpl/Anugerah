<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CreateUploadFolders extends Command
{
    protected $signature = 'storage:create-folders';
    protected $description = 'Create upload folders for the application';

    public function handle()
    {
        $folders = [
            public_path('uploads/berita'),
            public_path('uploads/pengunjung'),
            public_path('uploads/users'),
            public_path('uploads/layanan-client'), // Tambahkan ini
        ];

        foreach ($folders as $folder) {
            if (!File::exists($folder)) {
                File::makeDirectory($folder, 0755, true);
                $this->info("✓ Created: {$folder}");
            } else {
                $this->comment("Already exists: {$folder}");
            }
        }

        $this->info('All upload folders have been created successfully!');
    }
}