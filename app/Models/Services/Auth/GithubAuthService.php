<?php
/**
 *
 * @author cpj
 * @date 2018/12/12
 */

namespace App\Models\Services\Auth;


use App\Common\Code\Code;
use App\Common\Mapping\AuthInterface;
use App\Exception\AuthException;
use App\Models\Dao\UserDao;
use App\Models\Entity\Users;
use League\OAuth2\Client\Provider\Exception\GithubIdentityProviderException;
use League\OAuth2\Client\Token\AccessToken;
use Swoft\Bean\Annotation\Inject;

class GithubAuthService extends BaseAuthService implements AuthInterface
{
    /**
     *
     * @Inject()
     * @var UserDao
     */
    private $userDao;

    public function auth(array $data)
    {
        // TODO: Implement auth() method.

        $github = \Swoft::github();

        try {
            /* @var AccessToken $token */
            $token = $github->getAccessToken('authorization_code', [
                'code' => $data['code']
            ]);
            $git_user = $github->getResourceOwner($token);
        } catch (GithubIdentityProviderException $githubIdentityProviderException) {
            throw new AuthException(Code::CODE_EXPIRE, '请重新授权登录');
        }

        //数据库中已存在直接登录 不存在则插入数据库注册
        if (!$user = $this->userDao->getInfoByGithubId($git_user->getId())) {
            $user = new Users();
            $user->setGithubId($git_user->getId());
            $user->setLastIp(\Swoft::ip());
            $user->setNick();
            $user->setSalt();
            $user->setPassword();
            $user->save();
        }
        return $this->generateToken($user);
    }

}