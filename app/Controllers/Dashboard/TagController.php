<?php

namespace App\Controllers\Dashboard;

use App\Common\Controller\ApiController;
use App\Models\Dao\Log;
use App\Models\Services\TagService;
use Swoft\Http\Server\Bean\Annotation\Controller;
use Swoft\Http\Server\Bean\Annotation\RequestMapping;
use Swoft\Http\Server\Bean\Annotation\RequestMethod;
use Swoft\Bean\Annotation\Inject;
use Swoft\Http\Message\Bean\Annotation\Middleware;
use App\Middlewares\JwtMiddleware;

/**
 * @Controller(prefix="/dashboard/tag")
 * @Middleware(JwtMiddleware::class)
 */
class TagController extends ApiController
{
    /**
     *
     * @Inject()
     * @var TagService
     */
    private $tagService;

    /**
     *
     * @RequestMapping(route="/dashboard/tag", method={RequestMethod::GET})
     *
     * @return string
     */
    public function list()
    {
        $data = $this->tagService->getList();
        return $this->respondWithArray($data);
    }
}