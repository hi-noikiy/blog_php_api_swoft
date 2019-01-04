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
     * Check if a user is currently logged in
     */
    public function isLoggedIn(): bool
    {
        return $this->getSession() instanceof AuthToken;
    }

}
