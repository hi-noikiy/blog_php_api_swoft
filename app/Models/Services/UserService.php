<?php
/**
 *
 * @author cpj
 * @date 2018/12/6
 */

namespace App\Models\Services;

use App\Models\Dao\UserDao;
use App\Models\Entity\Users;
use Swoft\Bean\Annotation\Bean;
use Swoft\Bean\Annotation\Inject;

/**
 * @Bean()
 */
class UserService
{
    /**
     *
     * @Inject()
     * @var UserDao
     */
    public $userDao;

    public function getInfo(int $user_id)
    {
        $users = $this->userDao->getUserInfoById($user_id);
        return $this->desensitization($users);
    }

    /**
     *
     * 用户数据脱敏
     * @access public
     * @param Users $users
     * @return array
     *
     */
    public function desensitization(Users $users): array
    {
        return [
            'user_id' => $users->getUserId(),
            'mobile' => $users->getMobile(),
            'github_id' => $users->getGithubId(),
            'wechat_unionId' => $users->getWechatUnionId(),
            'nick' => $users->getNick(),
            'avatar' => $users->getAvatar(),
            'age' => $users->getAge(),
            'sex' => $users->getSex(),
            'mail' => $users->getMail(),
        ];
    }

}