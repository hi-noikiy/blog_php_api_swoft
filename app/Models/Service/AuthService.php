<?php

namespace App\Models\Service;


use App\Common\Code\Code;
use App\Exception\AuthException;
use Swoft\Auth\Mapping\AuthServiceInterface;
use Psr\Http\Message\ServerRequestInterface;
use Swoft\Bean\Annotation\Bean;
use Swoft\Bean\Annotation\Inject;
use SwoftTest\Db\Testing\Entity\User;

/**
 * @Bean()
 */
class AuthService
{
    public function auth(string $mobile, string $password): array
    {

        /* @var User $user*/
        $user = User::findOne(['mobile' => $mobile])->getResult();
        if (!$user) {
            throw new AuthException(Code::ERROR_NOT_FOUND, '该账号不存在');
        }

        throw new AuthException(Code::INVALID_PARAMETER, '密码错误');

    }

}