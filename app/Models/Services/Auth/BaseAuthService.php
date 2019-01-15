<?php

namespace App\Models\Services\Auth;

use App\Models\Dao\UserDao;
use App\Models\Entity\Users;
use App\Common\Utility\Token;
use App\Models\Services\TokenService;
use Swoft\App;
use Swoft\Bean\Annotation\Bean;
use Swoft\Helper\ArrayHelper;

class BaseAuthService
{

    public function update_user_info(Users $user): void
    {
        $user->setLastIp(\Swoft::ip());
        $user->visitCount++;
        $user->update();
    }

    public function generateToken(Users $users): array
    {
        /* @var TokenService $tokenService */
        $tokenService = App::getBean(TokenService::class);
        return $tokenService->generateToken($users);
    }


    protected function generatePassword(string $password = '123456'): array
    {
        $salt = rand(1000, 9999);
        $password = password_encrypt($password, $salt);
        return compact('password', 'salt');
    }

}