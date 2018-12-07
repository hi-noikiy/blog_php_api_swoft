<?php

namespace App\Controllers\Dashboard;

use App\Common\Controller\ApiController;
use App\Common\Lang\Lang;
use App\Models\Services\TagService;
use Swoft\Bean\Annotation\Number;
use Swoft\Bean\Annotation\Strings;
use Swoft\Http\Server\Bean\Annotation\Controller;
use Swoft\Http\Server\Bean\Annotation\RequestMapping;
use Swoft\Http\Server\Bean\Annotation\RequestMethod;
use Swoft\Bean\Annotation\Inject;
use Swoft\Http\Message\Bean\Annotation\Middleware;
use App\Middlewares\JwtMiddleware;
use Swoft\Bean\Annotation\ValidatorFrom;
use \Swoft;

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

    /**
     *
     * @RequestMapping(route="/dashboard/tag/{id}", method={RequestMethod::GET})
     * @Number(from=ValidatorFrom::PATH, name="id", min=1, template="请输入id")
     *
     * @param int $id
     * @return string
     */
    public function info(int $id)
    {
        $data = $this->tagService->getInfo($id);
        return $this->respondWithArray($data);
    }


    /**
     *
     * @RequestMapping(route="/dashboard/tag", method={RequestMethod::POST})
     * @Strings(from=ValidatorFrom::QUERY, name="tag_name",  template="请输入标签名称")
     *
     * @return string
     */
    public function create()
    {
        $this->tagService->create(Swoft::param());
        return $this->setMessage(Lang::CREATE_SUCCESS)->respondWithArray();
    }


    /**
     *
     * @RequestMapping(route="/dashboard/tag/{id}", method={RequestMethod::DELETE})
     * @Strings(from=ValidatorFrom::PATH, name="id",  template="请输入id")
     *
     * @param int $id
     * @return string
     */
    public function delete(int $id)
    {
        $this->tagService->delete($id);
        return $this->setMessage(Lang::DELETE_SUCCESS)->respondWithArray();
    }
}