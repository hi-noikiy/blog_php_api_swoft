<?php

namespace App\Models\Data;

use App\Models\Dao\AdminUserDao;
use App\Models\Dao\UserDao;
use App\Models\Entity\AdminUsers;
use Swoft\Bean\Annotation\Bean;
use Swoft\Bean\Annotation\Inject;

/**
 *
 * @Bean()
 * @uses      AdminUserData
 */
class AdminUserData
{
    /**
     *
     * @Inject()
     * @var AdminUserDao
     */
    private $adminUserDao;

    public function getUserBaseInfo(int $user_id)
    {
        /* @var AdminUsers $info */
        return $this->adminUserDao->getUserInfoById($user_id);

    }
}
