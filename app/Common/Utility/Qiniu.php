<?php


namespace App\Common\Utility;

use App\Common\Code\Code;
use phpDocumentor\Reflection\Types\Self_;
use Qiniu\Storage\BucketManager;
use Qiniu\Storage\UploadManager;
use Qiniu\Auth;
use Exception;

class Qiniu
{
    const HOST = 'https://img.losingbattle.site/';
    const BUCKET = 'losingbattle';
    const PREFIX = 'common';

    protected $uploadManager;
    protected $BucketManager;
    protected $auth;
    private $token;
    private $prefix;

    protected $QiNiu_config = [
        'accesskey' => 'ktvVle4hNOk_qJSTYHC5FI5Ed7au9_bKnmc2Wnwc',
        'secretkey' => 'eR0PGcIXsXB9tmMENJWT9colY2jnaZaO6UB-s8QE',
        'bucket' => 'losingbattle',
        'host' => 'https://img.losingbattle.site/'
    ];

    public function __construct()
    {
        $this->uploadManager = new UploadManager();

        $this->auth = new Auth($this->QiNiu_config['accesskey'], $this->QiNiu_config['secretkey']);
        $this->token = $this->auth->uploadToken($this->QiNiu_config['bucket']);

        $this->BucketManager = new BucketManager($this->auth);
    }


    public function single_upload($img)
    {
        if (!$img) {
            throw  new Exception('图片不能为空', 404);
        }

        $ext = pathinfo($img['name'], PATHINFO_EXTENSION);
        $this->isImage($ext);
        $key = $this->file_path($ext, $this->getPrefix());
        list($ret, $err) = $this->uploadManager->putFile($this->token, $key, $img['tmp_file']);
        if ($err !== null) {
            return $err;
        } else {
            return $this->QiNiu_config['host'] . $ret['key'];
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


    public function single_upload_url($url)
    {
        if (!$url) {
            throw  new Exception('图片不能为空', Code::INVALID_PARAMETER);
        }
        $pathinfo = pathinfo($url);
        $filename = $pathinfo['filename'];
        $ext = $pathinfo['extension'];
        $this->isImage($ext);
        $key = $this->file_path($ext, $this->getPrefix(), $filename);
        list($ret, $err) = $this->BucketManager->fetch($url, self::BUCKET, $key);
        if ($err != null) {
            throw new \Exception($err, Code::SYSTEM_ERROR);
        }
        return self::HOST . $key;
    }

    public function single_upload_base64($base64)
    {
//     $this->uploadManager->put()
    }

    //fpm模式下数组格式化
//    public function multi_arrange($img)
//    {
//
//        $i = 0;
//        foreach ($img as $key => $file) {
//
//            //因为这时$_FILES是个三维数组，并且上传单文件或多文件时，数组的第一维的类型不同，这样就可以拿来判断上传的是单文件还是多文件
//            if (is_string($file['name'])) {
//                //如果是单文件
//                $files[$i] = $file;
//                $i++;
//            } elseif (is_array($file['name'])) {
//                //如果是多文件
//                foreach ($file['name'] as $key => $val) {
//                    $files[$i]['name'] = $file['name'][$key];
//                    $files[$i]['type'] = $file['type'][$key];
//                    $files[$i]['tmp_file'] = $file['tmp_file'][$key];
//                    $files[$i]['error'] = $file['error'][$key];
//                    $files[$i]['size'] = $file['size'][$key];
//                    $i++;
//                }
//            }
//        }
//        return $files;
//    }


    public function delete($key)
    {

        $res = $this->BucketManager->delete($this->QiNiu_config['bucket'], $key);
        if ($res !== null) {
            throw  new Exception('该文件不存在或已被删除', Code::ERROR_NOT_FOUND);
        }
        return true;
    }

    /**
     *
     * 返回图片上传key
     * @access public
     * @param string $ext 文件后缀
     * @param string $prefix 文件前缀
     * @param string $filename 文件名称 为null时自动生成格式化时间
     * @return string
     *
     */
    private function file_path(string $ext, string $prefix = 'default', string $filename = null): string
    {
        if ($filename) {
            return sprintf('%s/%s.%s', $prefix, $filename, $ext);
        }
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


    private function getPrefix()
    {
        return $this->prefix ?? self::PREFIX;
    }

    public function setPrefix(?string $prefix)
    {
        $this->prefix = $prefix;
        return $this;
    }

}