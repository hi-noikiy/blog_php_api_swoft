<?php

namespace App\Controllers\V1;

use League\OAuth2\Client\Provider\Github;
use League\OAuth2\Client\Token\AccessToken;
use Swoft\Bean\Annotation\Value;
use Swoft\Http\Server\Bean\Annotation\Controller;
use Swoft\Http\Server\Bean\Annotation\RequestMapping;
use Swoft\Http\Server\Bean\Annotation\RequestMethod;
use Swoft\Http\Message\Bean\Annotation\Middleware;
use App\Middlewares\SignMiddleware;
use App\Common\Controller\ApiController;
use Swoft\Http\Message\Server\Request;
use Exception;


/**
 * @Controller(prefix="/v1/github")
 * @Middleware(SignMiddleware::class)
 */
class GithubController extends ApiController
{
    /**
     * @Value(name="${config.github.client_id}",env="${GITHUB_CLIENT_ID}")
     */
    private $clientId;

    /**
     * @Value(name="${config.github.client_secret}",env="${GITHUB_CLIENT_SECRET}")
     */
    private $clientSecret;

    /**
     * @Value(name="${config.github.redirectUri}",env="${GITHUB_REDIRECT_URI}")
     */
    private $redirectUri;

    /**
     * @RequestMapping(route="auth", method=RequestMethod::GET)
     * @param Request $request
     * @return string
     * @throws Exception
     */
    public function auth(Request $request)
    {
        $github = new Github([
            'clientId' => $this->clientId,
            'clientSecret' => $this->clientSecret,
            'redirectUri' => $this->redirectUri,
        ]);

        return $this->respondWithArray(['url' => $github->getAuthorizationUrl()]);
    }

    /**
     * @RequestMapping(route="callback", method={RequestMethod::GET,RequestMethod::POST})
     * @return string
     * @throws Exception
     */
    public function callback()
    {
        $github = new Github([
            'clientId' => $this->clientId,
            'clientSecret' => $this->clientSecret,
            'redirectUri' => $this->redirectUri,
        ]);


        /* @var AccessToken $token */
        $token = $github->getAccessToken('authorization_code', [
            'code' => \Swoft::param('code')
        ]);
        $user = $github->getResourceOwner($token);

        var_dump($user->toArray());
        return $this->respondWithArray($user->toArray());
    }
}