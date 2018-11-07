<?php
namespace App\Models\Service;


use Swoft\Auth\AuthManager;
use Swoft\Auth\Mapping\AuthManagerInterface;
use Swoft\Bean\Annotation\Bean;
use Swoft\Auth\Bean\AuthSession;
/**
 * @Bean()
 */
class AuthManagerService extends AuthManager implements AuthManagerInterface
{
    /**
     * @var string
     */
    protected $cacheClass = \Swoft\Redis\Redis::class;

    /**
     * @var bool 开启缓存
     */
    protected $cacheEnable = true;

    public function adminBasicLogin(string $identity, string $credential) : AuthSession
    {
        return $this->login(AdminNormalAccount::class, [
            'identity' => $identity,
            'credential' => $credential
        ]);
    }
}