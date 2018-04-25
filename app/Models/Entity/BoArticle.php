<?php

namespace App\Models\Entity;

use Swoft\Db\Model;
use Swoft\Db\Bean\Annotation\Column;
use Swoft\Db\Bean\Annotation\Entity;
use Swoft\Db\Bean\Annotation\Id;
use Swoft\Db\Bean\Annotation\Required;
use Swoft\Db\Bean\Annotation\Table;
use Swoft\Db\Types;

/**
 * 
 *
 * @Entity()
 * @Table(name="bo_article")
 * @uses      BoArticle
 * @version   2018年04月25日
 */
class BoArticle extends Model
{
    /**
     * @var int $article_id 
     * @Id()
     * @Column(name="article_id", type=Types::INT)
     */
    private $article_id = '';

    /**
     * @var string $title 标题
     * @Column(name="title", type=Types::STRING, length=20)
     * @Required()
     */
    private $title = '';

    /**
     * @var string $subheading 副标题
     * @Column(name="subheading", type=Types::STRING, length=20)
     */
    private $subheading = '';

    /**
     * @var string $tags 标签
     * @Column(name="tags", type=Types::STRING, length=255)
     */
    private $tags = '';

    /**
     * @var int $category 
     * @Column(name="category", type=Types::INT)
     * @Required()
     */
    private $category = '0';

    /**
     * @var mixed $content 内容
     * @Column(name="content", type="string", length=16777215)
     * @Required()
     */
    private $content = '';

    /**
     * @var string $author 作者
     * @Column(name="author", type=Types::STRING, length=20)
     * @Required()
     */
    private $author = 'blogger';

    /**
     * @var mixed $add_time 
     * @Column(name="add_time", type="string")
     * @Required()
     */
    private $add_time = '';

    /**
     * @var int $stars 星星
     * @Column(name="stars", type=Types::INT)
     * @Required()
     */
    private $stars = '0';

    /**
     * @var mixed $edit_time 
     * @Column(name="edit_time", type="string")
     * @Required()
     */
    private $edit_time = '';

 
    /**
     * 
     * @param int $value
     * @return $this
     */
    public function setArticleId(int $value)
    {
        $this->article_id = $value;

        return $this;
    }

    /**
     * 标题
     * @param string $value
     * @return $this
     */
    public function setTitle(string $value): self
    {
        $this->title = $value;

        return $this;
    }

    /**
     * 副标题
     * @param string $value
     * @return $this
     */
    public function setSubheading(string $value): self
    {
        $this->subheading = $value;

        return $this;
    }

    /**
     * 标签
     * @param string $value
     * @return $this
     */
    public function setTags(string $value): self
    {
        $this->tags = $value;

        return $this;
    }

    /**
     * 
     * @param int $value
     * @return $this
     */
    public function setCategory(int $value): self
    {
        $this->category = $value;

        return $this;
    }

    /**
     * 内容
     * @param $value
     * @return $this
     */
    public function setContent($value): self
    {
        $this->content = $value;

        return $this;
    }

    /**
     * 作者
     * @param string $value
     * @return $this
     */
    public function setAuthor(string $value): self
    {
        $this->author = $value;

        return $this;
    }

    /**
     * 
     * @param $value
     * @return $this
     */
    public function setAddTime($value): self
    {
        $this->add_time = $value;

        return $this;
    }

    /**
     * 星星
     * @param int $value
     * @return $this
     */
    public function setStars(int $value): self
    {
        $this->stars = $value;

        return $this;
    }

    /**
     * 
     * @param $value
     * @return $this
     */
    public function setEditTime($value): self
    {
        $this->edit_time = $value;

        return $this;
    }

 
    /**
     * 
     * @return int
     */
    public function getArticleId()
    {
        return $this->article_id;
    }

    /**
     * 标题
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * 副标题
     * @return string
     */
    public function getSubheading()
    {
        return $this->subheading;
    }

    /**
     * 标签
     * @return string
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * 
     * @return int
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * 内容
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * 作者
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->author;
    }

    /**
     * 
     * @return mixed
     */
    public function getAddTime()
    {
        return $this->add_time;
    }

    /**
     * 星星
     * @return int
     */
    public function getStars()
    {
        return $this->stars;
    }

    /**
     * 
     * @return mixed
     */
    public function getEditTime()
    {
        return $this->edit_time;
    }

}
