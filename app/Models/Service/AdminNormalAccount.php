<?php

namespace App\Models\Service;


use App\Models\Dao\AdminUserDao;
use Swoft\Auth\Bean\AuthResult;
use Swoft\Auth\Mapping\AccountTypeInterface;
use Swoft\Bean\Annotation\Inject;

class AdminNormalAccount implements AccountTypeInterface
{
    /**
     * @Inject()
     * @var AdminUserDao
     */
    protected $dao;

    const ROLE = 'role';

    /**
     * @throws \Swoft\Db\Exception\DbException
     */
    public function login(array $data): AuthResult
    {
        $identity = $data['identity'];
        $credential = $data['credential'];
        $user = $this->dao::findOneByUsername($identity);
        $result = new AuthResult();
        if ($user instanceof AdminUserBean && $user->verify($credential)) {
            $result->setExtendedData([self::ROLE => $user->getIsAdministrator()]);
            $result->setIdentity($user->getId());
        }
        return $result;
    }

    /**
     * @throws \Swoft\Db\Exception\DbException
     */
    public function authenticate(string $identity): bool
    {
        return $this->dao::issetUserById($identity);
    }
}