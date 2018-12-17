<?php
/**
 *
 * @author cpj
 * @date 2018/12/13
 */

namespace App\Common\Enums;


class DbEnum
{
    const DELETE = 1; //软删除 0 1
    const NOT_DELETE = 0;

    const LEVEL_NONE = 1;
    const LEVEL_INNER = 2;
    const LEVEL_STRICT = 3;
}