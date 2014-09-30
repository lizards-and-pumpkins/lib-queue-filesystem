<?php

namespace Brera\Lib\Queue\Backend\File\Filesystem;

use Brera\Lib\Queue\Backend\File\Exception\RuntimeException;

class File
{
    public function getNewBaseFilename()
    {
        return microtime(true);
    }

    public function getUniqueFilename($globPattern, $fileName)
    {
        $uniqueName = $fileName;
        $increment = 0;
        while (count(glob($globPattern . DIRECTORY_SEPARATOR . $uniqueName))) {
            $uniqueName = $fileName . '_' . (++$increment);
        }

        return $uniqueName;
    }

    public function moveFile($currentPath, $newPath)
    {
        if (!is_writable($currentPath) || !is_dir($newPath) || !is_writable($newPath)) {
            throw new RuntimeException('Can not move the file.');
        }

        $newPath = rtrim($newPath, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
        $fileName = basename($currentPath);

        rename($currentPath, $newPath . $fileName);
    }

    public function writeFile($filePath, $data)
    {
        if (false === file_put_contents($filePath, $data, LOCK_EX)) {
           throw new RuntimeException('Failed writing a file.');
        }
    }

    public function readFile($filePath)
    {
        $result = file_get_contents($filePath);

        return $result;
    }

    public function getNewFileHandle($filePath, $mode)
    {
        $handle = fopen($filePath, $mode);

        return $handle;
    }

    public function lock($filePath)
    {
        flock($filePath, LOCK_EX);
    }

    public function unlock($filePath)
    {
        flock($filePath, LOCK_UN);
    }
}
