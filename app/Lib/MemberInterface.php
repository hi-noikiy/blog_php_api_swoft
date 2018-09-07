<?php
namespace App\Lib;

use Swoft\Core\ResultInterface;

/**
 * Interface MemberInterface
 * @package App\Lib
 *
 * @method ResultInterface deferGetMemberByID(int $id)
 */
interface MemberInterface
{
    public function getMemberByID(int $id);
}