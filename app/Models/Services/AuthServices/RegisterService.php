<?php

namespace App\Models\Services\AuthServices;


use App\Common\Code\Code;
use App\Exception\AuthException;
use App\Models\Data\UserData;
use App\Models\Entity\Users;
use PhpAmqpLib\Exception\AMQPOutOfBoundsException;
use Swoft\App;
use Swoft\Bean\Annotation\Bean;

/**
 * @Bean()
 */
class RegisterService extends BaseAuthService
{
    public function register(array $data): array
    {
        // TODO: Implement auth() method.
        /* @var Users $user */
        $user = Users::findOne(['mobile' => $data['mobile']])->getResult();
        if (!$user) {
            throw new AuthException(Code::INVALID_PARAMETER, '该账号已被注册');
        }


        $this->update_user_info($user);

        return $this->generateToken($user);
    }

    public function check()
    {
        /* @var UserData $userData */
        $userData = App::getBean(UserData::class);
        $userData->createUser($data);
    }
}