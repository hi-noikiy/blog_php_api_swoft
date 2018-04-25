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
 * @Table(name="bo_user_star")
 * @uses      BoUserStar
 * @version   2018年04月25日
 */
class BoUserStar extends Model
{
    /**
     * @var int $us_id 
     * @Id()
     * @Column(name="us_id", type=Types::INT)
     */
    private $us_id = '';

    /**
     * @var int $user_id 
     * @Column(name="user_id", type=Types::INT)
     * @Required()
     */
    private $user_id = '';

    /**
     * @var int $article_id 
     * @Column(name="article_id", type=Types::INT)
     * @Required()
     */
    private $article_id = '';

    /**
     * @var mixed $add_time 
     * @Column(name="add_time", type="string")
     * @Required()
     */
    private $add_time = '';

 
    /**
     * 
     * @param int $value
     * @return $this
     */
    public function setUsId(int $value)
    {
        $this->us_id = $value;

        return $this;
    }

    /**
     * 
     * @param int $value
     * @return $this
     */
    public function setUserId(int $value): self
    {
        $this->user_id = $value;

        return $this;
    }

    /**
     * 
     * @param int $value
     * @return $this
     */
    public function setArticleId(int $value): self
    {
        $this->article_id = $value;

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
     * 
     * @return int
     */
    public function getUsId()
    {
        return $this->us_id;
    }

    /**
     * 
     * @return int
     */
    public function getUserId()
    {
        return $this->user_id;
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
     * 
     * @return mixed
     */
    public function getAddTime()
    {
        return $this->add_time;
    }

}
