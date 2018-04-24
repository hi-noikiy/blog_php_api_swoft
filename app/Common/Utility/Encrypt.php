<?php

namespace App\Common\Utility;

use App\Common\Code\Code;
use Exception;

class Encrypt
{
    private $key = 'XjSTEpgHAjCfLb7jFquJASKe4Wl4af1B';

    public function setKey($key)
    {
        $this->key = $key;
    }

    public function getKey()
    {
        var_dump($this->key);
        return $this->key;
    }

    protected static function sign(array $data, string $key): string
    {
        unset($data['sign']);

        ksort($data);

        $query = urldecode(http_build_query($data));
        $query .= "&key={$key}";

        return strtoupper(md5($query));
    }

    /**
     *
     * 检测签名
     * @param array $data
     * @return bool
     * @throws Exception
     */
    public function checkSign(array $data): bool
    {
        if (!isset($data['nonce'])) {
            throw new Exception('签名错误！1', Code::INVALID_PARAMETER);
        }


        if (!isset($data['sign'])) {
            throw new Exception("签名错误！2", Code::INVALID_PARAMETER);
        }

        $sign = self::sign($data, $this->getKey());
        if ($data['sign'] == $sign) {
            return true;
        } else {
            throw new Exception("签名错误！3", Code::INVALID_SIGN);
        }
    }

    /**
     *
     * 数据加密
     */
    static public function encrypt($str)
    {
        if (extension_loaded('SnakeBrother')) {
            return snakebrother_encrypt($str);
        }
        $key = 0x2b;
        $len = strlen($str);
        for ($i = 0; $i < $len; $i++) {
            $v = ord($str[$i]) & 0xff;
            $v ^= $key;
            $v = $key = (($v << 3) | ($v >> 5)) & 0xff;
            $str[$i] = chr($v);
        }

        return $str;
    }

    /**
     *
     * 数据解密
     */
    static public function decrypt($buf)
    {
        if (extension_loaded('SnakeBrother')) {
            return snakebrother_decrypt($buf);
        }
        $c = 0x2b;
        $len = strlen($buf);
        for ($i = 0; $i < $len; $i++) {
            $ch = ord($buf[$i]) & 0xFF;
            $buf[$i] = chr(((($ch << 5) | ($ch >> 3)) & 0xFF) ^ $c);
            $c = $ch;
        }

        return $buf;
    }

    /* void encrypt(char* buf, size_t len) {
       int c = 0x2b;
       size_t i;
       for (i = 0; i < len; i++) {
         int ch = buf[i] & 0xff;
         ch ^= c;
         ch = ((ch << 3) | (ch >> 5)) & 0xff;
         buf[i] = c = ch;
       }
     }*/

    /*void decrypt(char* buf, int len) {
      int c = 0x2b;
      size_t i;
      for (i = 0; i < len; i++) {
        int ch = buf[i] & 0xff;
        buf[i] = (((ch << 5) | (ch >> 3)) & 0xff) ^ c;
        c = ch;
      }
    }*/

}