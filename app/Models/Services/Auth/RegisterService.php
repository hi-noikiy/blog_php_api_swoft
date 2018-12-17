<?php

namespace App\Models\Services\Auth;


use App\Common\Code\Code;
use App\Common\Enums\DbEnum;
use App\Exception\AuthException;
use App\Exception\SystemException;
use App\Models\Dao\UserDao;
use App\Models\Data\UserData;
use App\Models\Entity\Users;
use App\Models\Services\SmsService;
use PhpAmqpLib\Exception\AMQPOutOfBoundsException;
use Swoft\App;
use Swoft\Bean\Annotation\Bean;
use Swoft\Bean\Annotation\Inject;

/**
 * @Bean()
 */
class RegisterService extends BaseAuthService
{

    /**
     *
     * @Inject()
     * @var UserDao
     *
     */
    public $userDao;

    /**
     * @Inject()
     * @var SmsService
     */
    public $SmsService;

    public function register(string $mobile, int $sms_code, int $type): array
    {
        /* @var Users $user */
        $user = $this->userDao->getInfoByMobile($mobile);
        if ($user) {
            throw new AuthException(Code::INVALID_PARAMETER, '该账号已被注册');
        }

        $this->SmsService->check($mobile, $sms_code, $type);

//        $this->userDao->create()
//        $this->createUser()

        $this->update_user_info($user);

        return $this->generateToken($user);
    }

    public function forget(string $mobile, int $sms_code, string $new_password)
    {
        /* @var Users $user */
        $user = $this->userDao->getInfoByMobile($mobile);
        if (!$user) {
            throw new AuthException(Code::INVALID_PARAMETER, '该账号已被注册');
        }
        if ($user->getIsDelete() == DbEnum::DELETE) {
            throw new SystemException('该账号已被禁用', Code::ACCOUNT_BAD);
        }
    }

}