<?php

namespace App\Models\Token;

use App\Common\Utility\Token;
use Swoft\Core\RequestContext;

use Swoft\Bean\Annotation\Bean;
use Swoft\Bean\Annotation\Scope;

/**
 * @Bean(scope=Scope::SINGLETON)
 */
class AuthManager
{
    /**
     * @return AuthToken|mixed
     */
    public function getSession()
    {
        return RequestContext::getContextDataByKey(Token::ACCESS_TOKEN);
    }

    public function setSession(AuthToken $session)
    {
        RequestContext::setContextData([Token::ACCESS_TOKEN => $session]);
    }

    /**
     *
     * 判断用户是否登录 AuthToken存在 且userId不为0 则为登录态
     * @access public
     * @param
     * @return bool
     *
     */
    public function isLoggedIn(): bool
    {
        if($this->getSession() instanceof AuthToken){
            if($this->getSession()->getUserId() === 0){
                return false;
            }else{
                return true;
            }
        }
        return false;
    }

}
