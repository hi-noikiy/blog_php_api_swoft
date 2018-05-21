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
 */
class UserStar extends Model
{
    /**
     * @var int $usId 
     * @Id()
     * @Column(name="us_id", type="integer")
     */
    private $usId;

    /**
     * @var int $userId 
     * @Column(name="user_id", type="integer")
     * @Required()
     */
    private $userId;

    /**
     * @var int $articleId 
     * @Column(name="article_id", type="integer")
     * @Required()
     */
    private $articleId;

    /**
     * @var string $addTime 
     * @Column(name="add_time", type="timestamp")
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
     * @param string $value
     * @return $this
     */
    public function setAddTime(string $value): self
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
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @return int
     */
    public function getArticleId()
    {
        return $this->articleId;
    }

    /**
     * @return string
     */
    public function getAddTime()
    {
        return $this->addTime;
    }

}
