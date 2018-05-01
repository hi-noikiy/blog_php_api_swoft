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
 * @Entity()
 * @Table(name="user_star")
 * @uses      UserStar
 * @version   2018年04月29日
 */
class UserStar extends Model
{
    /**
     * @var int $usId 
     * @Id()
     * @Column(name="us_id", type=Types::INT)
     */
    private $usId;

    /**
     * @var int $userId 
     * @Column(name="user_id", type=Types::INT)
     * @Required()
     */
    private $userId = 0;

    /**
     * @var int $articleId 
     * @Column(name="article_id", type=Types::INT)
     * @Required()
     */
    private $articleId = 0;

    /**
     * @var mixed $addTime 
     * @Column(name="add_time", type="string")
     * @Required()
     */
    private $addTime;

    /**
     * @param int $value
     * @return $this
     */
    public function setUsId(int $value)
    {
        $this->usId = $value;

        return $this;
    }

    /**
     * @param int $value
     * @return $this
     */
    public function setUserId(int $value): self
    {
        $this->userId = $value;

        return $this;
    }

    /**
     * @param int $value
     * @return $this
     */
    public function setArticleId(int $value): self
    {
        $this->articleId = $value;

        return $this;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setAddTime($value): self
    {
        $this->addTime = $value;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUsId()
    {
        return $this->usId;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @return mixed
     */
    public function getArticleId()
    {
        return $this->articleId;
    }

    /**
     * @return mixed
     */
    public function getAddTime()
    {
        return $this->addTime;
    }

}
