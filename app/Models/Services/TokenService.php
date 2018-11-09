<?php

namespace App\Models\Services;

use App\Common\Utility\Token;
use Swoft\Bean\Annotation\Bean;

/**
 * @Bean()
 */
class TokenService
{
    public function refresh(string $refresh_token): array
    {

        Token::getRefreshTokenKey($refresh_token);

//        $this->getRefreshTokenKey($refresh_token)
    }

}