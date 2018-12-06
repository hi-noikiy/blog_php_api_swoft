<?php
/**
 *
 * @author cpj
 * @date 2018/12/6
 */

namespace App\Models\Services;


use App\Models\Entity\Tags;
use Swoft\Bean\Annotation\Bean;

/**
 * @Bean()
 */
class TagService
{
    public function getList()
    {
        return Tags::getPageList();
    }

}