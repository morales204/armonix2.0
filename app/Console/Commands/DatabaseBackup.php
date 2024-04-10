<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use ZipArchive;


class DatabaseBackup extends Command
{
    protected $signature = 'backup:database';
    protected $description = 'Backup the database';
    

    public function handle()
    {
        $filename = "unilab-" . date('YmdHis') . ".sql";
        $backupFilePath = storage_path('app/UNILAB/' . $filename);
        
        $process = new Process([
            'mysqldump',
            '--user=root',
            '--password=' . env('DB_PASSWORD'),
            '--host=127.0.0.1',
            'unilab2',
            '--result-file=' . $backupFilePath
        ]);
    
        try {
            $process->mustRun();
            
            // Comprimir el archivo de respaldo a un archivo zip
            $zipFileName = "unilab-" . date('YmdHis') . '.zip';
            $zip = new ZipArchive();
            if ($zip->open(storage_path('app/UNILAB/' . $zipFileName), ZipArchive::CREATE) === TRUE) {
                $zip->addFile($backupFilePath, $filename);
                $zip->close();
                unlink($backupFilePath); // Elimina el archivo de respaldo sin comprimir
            } else {
                $this->error('Failed to create zip file.');
            }
        } catch (ProcessFailedException $exception) {
            $this->error('The backup process has failed: ' . $exception->getMessage());
        }
    }
}

