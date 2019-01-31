<?php

namespace App\Controllers\Dashboard;

use App\Common\Controller\ApiController;
use App\Models\Dao\Log;
use Swoft\Http\Server\Bean\Annotation\Controller;
use Swoft\Http\Server\Bean\Annotation\RequestMapping;
use Swoft\Http\Server\Bean\Annotation\RequestMethod;
use Swoft\Bean\Annotation\Inject;
use Swoft\Http\Message\Bean\Annotation\Middleware;
use App\Middlewares\JwtMiddleware;

/**
 * @Controller(prefix="/dashboard/log")
 * @Middleware(JwtMiddleware::class)
 */
class LogController extends ApiController
{
    /**
     *
     * @Inject()
     * @var Log
     */
    private $log;

    /**
     *
     * @RequestMapping(route="/dashboard/log", method={RequestMethod::GET})
     *
     * @return string
     */
    public function list()
    {
        $page = \request()->input('page', 1);
        $limit = \request()->input('limit', 15);

        $lists = $this->log->list();

        return $this->respondWithArray($lists);
    }

    /**
     * 查询trace
     * @RequestMapping(route="{id}", method={RequestMethod::GET})
     *
     * @param int $id
     * @return string
     */
    public function trace(int $id)
    {

        $trane_info = $this->log->trace($id);
        return $this->respondWithArray($trane_info);
    }
}