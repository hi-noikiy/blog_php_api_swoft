<?php

namespace App\Controllers\V1;


use App\Common\Controller\ApiController;
use App\Models\Services\BaseData\CategoryService;
use Swoft\Http\Server\Bean\Annotation\Controller;
use Swoft\Http\Server\Bean\Annotation\RequestMapping;
use Swoft\Http\Server\Bean\Annotation\RequestMethod;
use Swoft\Http\Message\Server\Request;
use Swoft\Bean\Annotation\Inject;

/**
 * @Controller(prefix="/v1/category")
 */
class CategoryController extends ApiController
{

    /**
     *
     * @Inject()
     * @var CategoryService $categoryService
     */
    private $categoryService;

    /**
     * @RequestMapping(route="/category", method={RequestMethod::GET})
     * @return string
     */
    public function index()
    {
        $category = $this->categoryService->getCollection(0);
        return $this->respondWithArray(compact('category'));
    }


    /**
     * @RequestMapping(route="{category_id}", method={RequestMethod::GET})
     * @param int $category_id
     * @return string
     */
    public function subset(int $category_id)
    {
        $category = $this->categoryService->getCollection($category_id);
        return $this->respondWithArray(compact('category'));
    }

}