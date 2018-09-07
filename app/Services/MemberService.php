<?php

namespace App\Services;

use App\Lib\MemberInterface;
use Pb\Person;
use Pb\PhoneNumber;
use Swoft\Core\ResultInterface;
use Swoft\Rpc\Server\Bean\Annotation\Service;
/**
 * Class MemberService
 * @package App\Services
 *
 * @method ResultInterface deferGetMemberByID(int $id)
 * @Service()
 */
class MemberService implements MemberInterface
{
    public function getMemberByID(int $id)
    {
        // TODO: Implement getMemberByID() method.

        $x = new Person();
        $phone = new PhoneNumber();
        $x->setId(1);
        $x->setEmail("741696717@qq.com");
        $x->setName("123");
        return $x->serializeToString();
    }
}