<?php

/**
 *
 * @author Jason Lee
 * @license MIT
 * @date 7/8/2015
 *
 * Simple Ajax File Browser
 */

class fileBrowser
{
    protected $directory;
    protected $files = [];

    const FB_DIRECTORY = "D";
    const FB_FILE = "F";

    /**
     *
     * @param string $currentDir
     */
    function __construct($currentDir)
    {
        $this->scanDir($currentDir);
    }

    /**
     *
     * @return string
     */
    public function getDirectory()
    {
        return $this->directory;
    }

    /**
     *
     * @return array
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     *
     * Need to modify later to take base64 encoded string for unicode
     * @param string $currentDir
     * @return boolean
     */
    public function scanDir($currentDir)
    {
        $this->directory = $currentDir;
        $this->files = [];
        return $this->_scanDir();
    }

    /**
     *
     * @return boolean
     */
    private function _scanDir()
    {
        if (is_dir($this->directory)) {
            // scan all files
            $handle = @opendir($this->directory);
            while (false !== ($filename = @readdir($handle))) {
                $this->files[] = $this->directory . '/' . $filename;
            }
            @closedir($handle);
        } else {
            if (is_file($this->directory)) {
                return false;
            }
        }
        sort($this->files);
        return true;
    }

    /**
     *
     *  check if it's a directory
     *  force sort directory to the top of array
     *  remove . and .. directory
     *
     * @return array
     *
     */
    public function getList()
    {
        $tempDirs = [];
        $tempFiles = [];

        $count = 0;
        foreach ($this->getFiles() as $file) {
            $basename = basename($file);
            if ($basename == '.' || $basename == '..') {
                continue;
            }

            if (is_dir($file)) {
                $tempDirs[$count] = ['type' => self::FB_DIRECTORY, 'base' => $basename, 'full' => $file];
            } else if (is_file($file)) {
                $tempFiles[$count] = ['type' => self::FB_FILE, 'base' => $basename, 'full' => $file];
            }
            $count++;
        }

        return array_merge($tempDirs, $tempFiles);
    }

    /**
     *
     * @return string
     */
    public function getListJson()
    {
        return json_encode($this->getList());
    }

}
?>