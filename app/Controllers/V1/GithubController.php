<?php

namespace App\Controllers\V1;

use League\OAuth2\Client\Token\AccessToken;
use Swoft\Http\Server\Bean\Annotation\Controller;
use Swoft\Http\Server\Bean\Annotation\RequestMapping;
use Swoft\Http\Server\Bean\Annotation\RequestMethod;
use Swoft\Http\Message\Bean\Annotation\Middleware;
use App\Middlewares\SignMiddleware;
use App\Common\Controller\ApiController;
use Exception;


/**
 * @Controller(prefix="/v1/github")
 * @Middleware(SignMiddleware::class)
 */
class GithubController extends ApiController
{
    /**
     * @RequestMapping(route="auth", method=RequestMethod::GET)
     * @return string
     * @throws Exception
     */
    public function auth()
    {
        $redirect_uri = \Swoft::param('redirect_uri');

        return $this->respondWithArray(['url' => \Swoft::github($redirect_uri)->getAuthorizationUrl()]);
    }

    /**
     * @RequestMapping(route="callback", method={RequestMethod::GET,RequestMethod::POST})
     * @return string
     * @throws Exception
     */
    public function callback()
    {
        $github = \Swoft::github();

        /* @var AccessToken $token */
        $token = $github->getAccessToken('authorization_code', [
            'code' => \Swoft::param('code')
        ]);
        $user = $github->getResourceOwner($token);

        return $this->respondWithArray($user->toArray());
    }
}