<?php
/**
 *
 * @author cpj
 * @date 2018/12/17
 */

namespace App\Models\Services\Auth;


use App\Common\Code\Code;
use App\Common\Enums\WechatMappingEnum;
use App\Common\Mapping\AuthInterface;
use App\Exception\SystemException;
use App\Models\Dao\UserDao;
use App\Models\Dao\UserWechatMappingDao;
use Swoft\Bean\Annotation\Inject;
use Swoft\Db\Db;
use Swoft\Bean\Annotation\Bean;

/**
 * @Bean()
 */
class WechatMiniProgramService extends BaseAuthService implements AuthInterface
{
    /**
     *
     * @Inject()
     * @var UserDao
     */
    private $userDao;

    /**
     *
     * @Inject()
     * @var UserWechatMappingDao
     */
    private $userWechatMappingDao;

    public function auth(array $data)
    {
        // TODO: Implement auth() method.
        $user = $this->userDao->getInfoByUnionId($data['unionId']);
        //不存在则注册
        if (!$user) {
            Db::beginTransaction();
            try {
                $wechat_info = [
                    'wechat_unionId' => $data['unionId'],
                    'nick' => $data['nickName'],
                    'avatar' => $data['avatarUrl'],
                    'sex' => $data['gender'],
                ];
                $password = $this->generatePassword();
                $wechat_info = array_merge($wechat_info, $password);
                $user_id = $this->userDao->create($wechat_info);
                $this->userWechatMappingDao->create([
                    'user_id' => $user_id,
                    'wechat_openId' => $data['openId'],
                    'scene' => WechatMappingEnum::MINIPROGRAM
                ]);

                Db::commit();
            } catch (\Exception $systemException) {
                Db::rollback();
                throw new SystemException($systemException->getMessage(), Code::SQL_ERROR);
            }
            $user = $this->userDao->getUserInfoById($user_id);
        }

        return $this->generateToken($user);
    }
}