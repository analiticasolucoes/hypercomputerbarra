<?php

namespace App\Services;

class Backup {
    
    const BACKUP_DIR = "../app/backup/export";
    const RESTORE_DIR = "../app/backup/import";
    const SOURCE_DIR = "../app/uploads";
    
    private $db;
    
    public function __construct(Database $db) {
        $this->db = $db;
        if (!is_dir(self::BACKUP_DIR)) {
            mkdir(self::BACKUP_DIR, 0777, true);
        }
    }

    public function backupDatabase() {
        $backupDatabaseFile = $this->db->backup(self::BACKUP_DIR);
        
        return $backupDatabaseFile;
    }

    public function backupFiles() {
        $zipFile = $this->backupDir . '/files_backup_' . date('Y-m-d_H-i-s') . '.zip';

        $zip = new ZipArchive();
        if ($zip->open($zipFile, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
            throw new Exception("Não foi possível criar o arquivo ZIP: $zipFile");
        }

        $sourceDir = realpath($this->sourceDir);
        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($sourceDir),
            RecursiveIteratorIterator::LEAVES_ONLY
        );

        foreach ($files as $name => $file) {
            if (!$file->isDir()) {
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($sourceDir) + 1);
                $zip->addFile($filePath, $relativePath);
            }
        }

        $zip->close();

        return $zipFile;
    }

    public function estimateBackupSize() {
        $databaseSize = $this->getDatabaseSize();
        $filesSize = $this->getFilesSize();
        $totalSizeInBytes = $databaseSize + $filesSize;
        $totalSizeInMB = $totalSizeInBytes / (1024 * 1024);
        return $totalSizeInMB;
    }

    private function getDatabaseSize() {
        $query = "SELECT SUM(data_length + index_length) AS size FROM information_schema.tables WHERE table_schema = :table_schema";

        $parametros = ['table_schema' => $id];

        $result = $this->db->consultar($query, $parametros);

        $result = $connection->query("SELECT SUM(data_length + index_length) AS size FROM information_schema.tables WHERE table_schema = '{$this->dbName}'");

        if ($result === false) {
            throw new Exception("Erro ao calcular o tamanho do banco de dados: " . $connection->error);
        }

        $row = $result->fetch_assoc();
        $size = $row['size'];

        $connection->close();

        return $size;
    }

    private function getFilesSize() {
        $size = 0;
        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($this->sourceDir, RecursiveDirectoryIterator::SKIP_DOTS),
            RecursiveIteratorIterator::CHILD_FIRST
        );

        foreach ($files as $file) {
            if ($file->isFile()) {
                $size += $file->getSize();
            }
        }

        return $size;
    }

    public function backupSystem() {
        $dbBackup = $this->backupDatabase();
        $filesBackup = $this->backupFiles();

        return [
            'database_backup' => $dbBackup,
            'files_backup' => $filesBackup,
        ];
    }

    public function restoreDatabase($backupFile) {
        $command = "mysql --host={$this->dbHost} --user={$this->dbUser} --password={$this->dbPassword} {$this->dbName} < $backupFile";
        system($command, $output);

        if ($output !== 0) {
            throw new Exception("Erro ao restaurar o banco de dados: $output");
        }

        return true;
    }

    public function restoreFiles($zipFile) {
        $zip = new ZipArchive();
        if ($zip->open($zipFile) === true) {
            $zip->extractTo($this->restoreDir);
            $zip->close();
        } else {
            throw new Exception("Não foi possível abrir o arquivo ZIP: $zipFile");
        }

        return true;
    }

    public function restoreSystem($dbBackupFile, $filesBackupFile) {
        $this->restoreDatabase($dbBackupFile);
        $this->restoreFiles($filesBackupFile);
    }
}
?>
