<?php

namespace App\Models\Services\Auth;


use App\Common\Code\Code;
use App\Common\Mapping\AuthInterface;
use App\Exception\AuthException;
use App\Models\Entity\Users;
use Swoft\Bean\Annotation\Bean;

/**
 * @Bean()
 */
class PasswordAuthService extends BaseAuthService implements AuthInterface
{
    public function auth(array $data): array
    {
        // TODO: Implement auth() method.
        /* @var Users $user */
        $user = Users::findOne(['mobile' => $data['mobile']])->getResult();
        if (!$user) {
            throw new AuthException(Code::ERROR_NOT_FOUND, '该账号不存在');
        }
        if ($user->getIsDelete() == 1) {
            throw new AuthException(Code::INVALID_PARAMETER, '该账号已经被禁用');
        }
        if (!password_check($data['password'], $user->getSalt(), $user->getPassword())) {
            throw new AuthException(Code::INVALID_PARAMETER, '密码错误');
        }
        $this->update_user_info($user);

        return $this->generateToken($user);
    }
}