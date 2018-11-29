<?php
/**
 *
 * @author cpj
 * @date 2018/11/29
 */

namespace App\Exception;


use Throwable;

class ExtendDataException extends \RuntimeException
{
    protected $data;

    public function __construct(array $data = [], string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->data = $data;
    }

    public function getData()
    {
        return $this->data;
    }
}