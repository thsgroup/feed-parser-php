<?php

namespace Thsgroup\FeedParser;


class DataRetriever
{
    private $directory;

    public function __construct($directory)
    {
        $this->directory = $directory;
    }

    public function __destruct()
    {
        $this->removeDirectory($this->directory);
    }

    /**
     * @return bool
     * @throws \RuntimeException
     */
    public function prepareDirectory()
    {
        if (file_exists($this->directory) && !mkdir($newDirectory = $this->directory, 0777, true) && !is_dir($newDirectory)) {
            throw new \RuntimeException('Directory: ' . $newDirectory . ' could not be created');
        }

        return true;
    }

    /**
     * @param string $path
     */
    private function removeDirectory($path)
    {
        $files = glob($path . '/*');
        foreach ($files as $file) {
            is_dir($file) ? $this->removeDirectory($file) : unlink($file);
        }
        if (file_exists($path)) {
            rmdir($path);
        }
    }
}