<?php


namespace App\Common\Utility;

use Qiniu\Storage\BucketManager;
use Qiniu\Storage\UploadManager;
use Qiniu\Auth;
use Exception;

class Qiniu
{
    protected $uploadManager;
    protected $BucketManager;
    protected $auth;
    private $token;
    protected $QiNiu_config = [
        'accesskey' => 'ktvVle4hNOk_qJSTYHC5FI5Ed7au9_bKnmc2Wnwc',
        'secretkey' => 'eR0PGcIXsXB9tmMENJWT9colY2jnaZaO6UB-s8QE',
        'bucket' => 'wxcs',
    ];

    public function __construct()
    {
        $this->uploadManager = new UploadManager();

        $this->auth = new Auth($this->QiNiu_config['accesskey'], $this->QiNiu_config['secretkey']);
        $this->token = $this->auth->uploadToken($this->QiNiu_config['bucket']);

        $this->BucketManager = new BucketManager($this->auth);
    }


    public function single_upload($img, $prefix)
    {
        if (!$img) {
            throw  new Exception('图片不能为空', 404);
        }

        $ext = pathinfo($img['name'], PATHINFO_EXTENSION);
        $this->isImage($ext);
        $key = $this->file_path($ext, $prefix);
        list($ret, $err) = $this->uploadManager->putFile($this->token, $key, $img['tmp_file']);
        if ($err !== null) {
            return $err;
        } else {
            return $ret['key'];
        }

    }

    public function single_upload_stream($stream, $prefix = 'stream')
    {

        if (!$stream) {
            throw  new Exception('图片不能为空', 404);
        }

//        $ext = pathinfo($img['name'], PATHINFO_EXTENSION);
//        $this->isImage($ext);
        $key = $this->file_path('png', $prefix);
        list($ret, $err) = $this->uploadManager->put($this->token, $key, $stream);
        if ($err !== null) {
            return $err;
        } else {
            return $ret['key'];
        }

    }

    public function multi_arrange($img)
    {

        $i = 0;
        foreach ($img as $key => $file) {

            //因为这时$_FILES是个三维数组，并且上传单文件或多文件时，数组的第一维的类型不同，这样就可以拿来判断上传的是单文件还是多文件
            if (is_string($file['name'])) {
                //如果是单文件
                $files[$i] = $file;
                $i++;
            } elseif (is_array($file['name'])) {
                //如果是多文件
                foreach ($file['name'] as $key => $val) {
                    $files[$i]['name'] = $file['name'][$key];
                    $files[$i]['type'] = $file['type'][$key];
                    $files[$i]['tmp_file'] = $file['tmp_file'][$key];
                    $files[$i]['error'] = $file['error'][$key];
                    $files[$i]['size'] = $file['size'][$key];
                    $i++;
                }
            }
        }
        return $files;
    }

    public function delete($key)
    {

        $res = $this->BucketManager->delete($this->QiNiu_config['bucket'], $key);
        if ($res !== null) {
            throw  new Exception('该文件不存在或已被删除', 400);
        }
        return true;
    }

    private function file_path($ext, $prefix = 'default')
    {
        return sprintf('%s/%s/%s.%s', $prefix, date('Y-m-d'), md5(uniqid(rand())), $ext);
    }

    private function isImage($ext)
    {

        $filetype = ['jpg', 'jpeg', 'gif', 'bmp', 'png', 'mp4'];
        if (!in_array($ext, $filetype)) {
            throw  new Exception('图片格式错误', 400);
        }
        return true;
    }


}