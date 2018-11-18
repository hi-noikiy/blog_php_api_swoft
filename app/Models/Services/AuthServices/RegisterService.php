<?php

namespace App\Models\Services\AuthServices;


use App\Common\Code\Code;
use App\Exception\AuthException;
use App\Models\Data\UserData;
use App\Models\Entity\Users;
use App\Models\Services\SmsService;
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

        /* @var SmsService $SmsService */
        $SmsService = App::getBean(SmsService::class);
        $SmsService->check($data['mobile'], $data['sms_code'], $data['type']);

        $this->update_user_info($user);

        return $this->generateToken($user);
    }

}