<?php

namespace App\Controllers\Dashboard;

use App\Common\Controller\ApiController;
use App\Common\Lang\Lang;
use App\Common\Validate\Dashboard\ArticleValidate;
use App\Models\Services\ArticleService;
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
 * @Controller(prefix="/dashboard/article")
 * @Middleware(JwtMiddleware::class)
 */
class ArticleController extends ApiController
{
    /**
     *
     * @Inject()
     * @var ArticleService
     */
    private $articleService;

    /**
     *
     * @RequestMapping(route="/dashboard/article", method={RequestMethod::GET})
     *
     * @return string
     */
    public function list()
    {
        $data = $this->articleService->getList();
        return $this->respondWithArray($data);
    }

    /**
     *
     * @RequestMapping(route="/dashboard/article/{id}", method={RequestMethod::GET})
     * @Number(from=ValidatorFrom::PATH, name="id", min=1, template="请输入id")
     *
     * @param int $id
     * @return string
     */
    public function info(int $id)
    {
        $data = $this->articleService->getInfo($id);
        return $this->respondWithArray($data);
    }


    /**
     *
     * @RequestMapping(route="/dashboard/article", method={RequestMethod::POST})
     * @Strings(from=ValidatorFrom::QUERY, name="article_name",  template="请输入标签名称")
     *
     * @return string
     */
    public function create()
    {
        $this->articleService->create(Swoft::param());
        return $this->setMessage(Lang::CREATE_SUCCESS)->respondWithArray();
    }


    /**
     *
     * @RequestMapping(route="/dashboard/article/{id}", method={RequestMethod::PUT})
     *
     *
     * @param int $id
     * @return string
     */
    public function update(int $id)
    {
        $this->articleService->update($id, Swoft::param());
        return $this->setMessage(Lang::UPDATE_SUCCESS)->respondWithArray();
    }

    /**
     *
     * @RequestMapping(route="/dashboard/article/{id}", method={RequestMethod::DELETE})
     *
     * @param int $id
     * @return string
     */
    public function delete(int $id)
    {
        $this->articleService->delete($id);
        return $this->setMessage(Lang::DELETE_SUCCESS)->respondWithArray();
    }
}