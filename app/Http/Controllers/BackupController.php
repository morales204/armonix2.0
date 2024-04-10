<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Backup\BackupDestination\Backup;
use Spatie\Backup\BackupDestination\BackupDestination;
use Illuminate\Support\Facades\Storage;     
use Spatie\Backup\Tasks\Backup\BackupJobFactory;
use App\Console\Commands\DatabaseBackup;

class BackupController extends Controller
{
    public function index(){
        $disk = Storage::disk('local');
        $pathToBackups = 'UNILAB'; // Esto asume que tus copias de seguridad están en la carpeta 'UNILAB' dentro del disco 'local'
    
        $backupDestination = new BackupDestination($disk, $pathToBackups, 'local');
        $backups = $backupDestination->backups()->reverse();
        

        return view('backup.respaldo', compact('backups'));
    }

    public function create()
    {
            try {
                // Instancia del comando DatabaseBackup
                $command = new DatabaseBackup();

                // Ejecutar el método handle directamente
                $command->handle();

                // Redirigir de vuelta con un mensaje de éxito
                return back()->with('success', '¡Respaldo generado correctamente!');
            } catch (\Exception $exception) {     // Redirigir de vuelta con un mensaje de error
                return back()->with('error', '¡Error al generar el respaldo!'.$exception);
            }
    }

    public function download($filename)
    {
        $filePath = 'UNILAB/' . $filename; // Ruta al archivo de respaldo
        return Storage::download($filePath);
    }

    public function destroy($filename)
    {
        $filePath = 'UNILAB/' . $filename; // Ruta al archivo de respaldo

        // Eliminar el archivo de respaldo
        Storage::delete($filePath);

        // Redirigir de vuelta a la página de respaldos con un mensaje de éxito
        return redirect()->route('respaldo.index')->with('success', '¡El respaldo ha sido eliminado correctamente!');
    }
}