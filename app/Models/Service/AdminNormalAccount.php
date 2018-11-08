<?php

namespace App\Models\Service;


use App\Models\Dao\AdminUserDao;
use Swoft\Auth\Bean\AuthResult;
use Swoft\Auth\Mapping\AccountTypeInterface;
use Swoft\Bean\Annotation\Inject;
use Swoft\Bean\Annotation\Bean;

/**
 * @Bean()
 */
class AdminNormalAccount implements AccountTypeInterface
{

    const ROLE = 'role';

    public function login(array $data): AuthResult
    {
        $identity = 'youke';
        $credential = '123456';;
        $result = new AuthResult();

        $result->setExtendedData([self::ROLE => 'test']);
        $result->setIdentity(1);

        return $result;
    }

    public function authenticate(string $identity): bool
    {
        return __CLASS__;
    }
}