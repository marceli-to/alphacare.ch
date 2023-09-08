<?php
namespace App\Console\Commands;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class BackupContent extends Command
{
  protected $signature = 'backup:content';
  
  protected $description = 'Backup the content folder';
  
  public function handle()
  {
    $source_path = base_path('content');

    $backup_path = storage_path('app/backups/' . date('Y-m-d'));

    if (!File::exists($source_path))
    {
      $this->error('The content folder does not exist.');
      return;
    }

    // Create the backup folder if it doesn't exist
    if (!File::exists($backup_path))
    {
      File::makeDirectory($backup_path);
    }

    // Generate a unique backup filename
    $backup_filename = date('Y-m-d_H-i') . '_content.zip';
    $backup_file = $backup_path . '/' . $backup_filename;

    // Zip the content folder
    $zip = new \ZipArchive();
    if ($zip->open($backup_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE))
    {
      $files = new \RecursiveIteratorIterator(
        new \RecursiveDirectoryIterator($source_path),
        \RecursiveIteratorIterator::LEAVES_ONLY
      );

      foreach ($files as $name => $file)
      {
        if (!$file->isDir())
        {
          $filePath = $file->getRealPath();
          $relativePath = substr($filePath, strlen($source_path) + 1);
          $zip->addFile($filePath, $relativePath);
        }
      }

      $zip->close();
    } 
    else
    {
      // Log error
      $this->error('Failed to create the backup zip file.');
      return;
    }
    $this->info('Content folder has been successfully backed up to: ' . $backup_file);
  }
}
