<?php

namespace App\Controllers\Dashboard;

use App\Common\Controller\ApiController;
use App\Common\Utility\Qiniu;
use App\Models\Dao\Log;
use Swoft\Http\Server\Bean\Annotation\Controller;
use Swoft\Http\Server\Bean\Annotation\RequestMapping;
use Swoft\Http\Server\Bean\Annotation\RequestMethod;
use Swoft\Http\Message\Server\Request;
use Swoft\Bean\Annotation\Inject;

/**
 * @Controller(prefix="/dashboard/log")
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
     * @RequestMapping(route="/dashboard/log/{$page}", method={RequestMethod::GET})
     *
     * @param Request $request
     * @param int $page
     * @param int $limit
     */
    public function list(Request $request,int $page,int $limit)
    {
        return $this->respondWithArray($this->log->list(request()->input('page', 1), request()->input('limit', 10)));
    }

/**
 * 查询trace
 * @RequestMapping(route="/dashboard/log/x", method={RequestMethod::GET})
 * @param int $id
 */
public
function trace(int $id)
{
    return $this->respondWithArray($id);
}
}