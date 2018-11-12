<?php

namespace App\Models\Services;

use App\Common\Utility\Token;
use App\Models\Data\UserData;
use App\Models\Entity\Users;
use App\Models\Services\AuthServices\BaseAuthService;
use Swoft\Bean\Annotation\Bean;
use Swoft\Bean\Annotation\Inject;

/**
 * @Bean()
 */
class TokenService extends BaseAuthService
{
    /**
     *
     * @Inject()
     * @var UserData
     */
    private $UserData;

    public function refresh(array $hData): array
    {
        $user_id = $hData['user_id'];
        $user = $this->UserData->getUserInfo($user_id);
        return $this->generateToken($user);
    }

}