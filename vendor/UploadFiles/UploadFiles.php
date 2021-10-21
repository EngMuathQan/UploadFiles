<?php

namespace UploadFiles;

use Exception;

class UploadFiles
{

    protected $ext = ["jpg", "jpeg", "png", "gif", "JPG", "JPEG", "PNG", "GIF"];
    protected $path = __DIR__ . "/../../images/";
    protected $name;
    protected $tmp_name;
    protected $ext_name;
    protected $count_name = 32;

    public function __construct()
    {
        //throw new Exception('Division by zero');
    }

    public function name($value)
    {
        $this->name = $value;
        return $this;
    }

    public function count_name($value)
    {
        $this->count_name = $value;
        return $this;
    }

    public function path($path)
    {
        $this->path = __DIR__ . "/../../" . $path;
        return $this;
    }

    public function ext($ext)
    {
        if (!is_array($ext)) {
            throw new Exception("The Ext Is Not Array");
        }

        $new_ext = [];

        foreach($ext as $val) {
            $new_ext[] = strtolower($val);
        }

        $this->ext = $new_ext;
        return $this;
    }

    public function get_ext()
    {
        return implode(", ", $this->ext);
    }

    public function get_path()
    {
        return $this->path;
    }

    public function get_name()
    {
        return $this->name;
    }

    public function get_ext_name()
    {
        return $this->ext_name;
    }

    public function get_tmp_name()
    {
        return $this->tmp_name;
    }

    public function create_folder()
    {
        if (!file_exists($this->path)) {
            mkdir($this->path);
        }
    }

    public function file($file)
    {

        if (empty($file) or !is_array($file) or empty($file['name']) or empty($file['tmp_name'])) {
            throw new Exception('Please Select A Valid File.');
        }

        if (!empty($file) and is_array($file) and !empty($file['name']) and !empty($file['tmp_name'])) {
            $this->name = $file['name'];
            $ext = explode(".", $file['name']);
            $this->ext_name = strtolower(end($ext));
            $this->tmp_name = $file['tmp_name'];
        }
        return $this;
    }

    public function pdf()
    {
        $this->ext = ['pdf'];
        self::get();
    }

    public function docx()
    {
        $this->ext = ['docx'];
        self::get();
    }

    public function xlsx()
    {
        $this->ext = ['xlsx'];
        self::get();
    }

    public function image()
    {
        $this->ext = ["jpg", "jpeg", "png", "gif"];
        self::get();
    }

    public function get()
    {
        if (!in_array($this->ext_name, $this->ext)) {
            throw new Exception('The File Ext Is Not Valid. The Ext Have To Be "' . implode(", ", $this->ext) . '"');
        }

        $new_name = self::random($this->count_name) . '.' . $this->ext_name;
        $sourcePath = $this->tmp_name;
        $targetPath = $this->path . $new_name;

        self::create_folder();

        if (move_uploaded_file($sourcePath, $targetPath)) {
            return $new_name;
        }
    }

    public function random($value = 32)
    {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $alphaLength = strlen($alphabet) - 1;
        $random = "";
        for ($i = 0; $i < $value; $i++) {
            $n = rand(0, $alphaLength);
            $random .= $alphabet[$n];
        }
        return $random;
    }
}
