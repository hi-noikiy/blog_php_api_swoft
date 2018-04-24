<?php
/**
 * This file is part of Swoft.
 *
 * @link https://swoft.org
 * @document https://doc.swoft.org
 * @contact group@swoft.org
 * @license https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */

namespace App\Models\Entity;

use Swoft\Db\Bean\Annotation\Id;
use Swoft\Db\Bean\Annotation\Required;
use Swoft\Db\Bean\Annotation\Table;
use Swoft\Db\Bean\Annotation\Column;
use Swoft\Db\Bean\Annotation\Entity;
use Swoft\Db\Model;
use Swoft\Db\Types;

/**
 * 用户实体
 *
 * @Entity()
 * @Table(name="bo_users")
 * @uses      User
 */
class User extends Model
{
    /**
     * 主键ID
     *
     * @Id()
     * @Column(name="user_id", type=Types::INT)
     * @var null|int
     */
    private $user_id;

    /**
     * 昵称
     *
     * @Column(name="nick", type=Types::STRING, length=50)
     * @Required()
     * @var null|string
     */
    private $nick;

    /**
     * 年龄
     *
     * @Column(name="age", type=Types::INT)
     * @var int
     */
    private $age = 0;

    /**
     * 性别
     *
     * @Column(name="sex", type="int")
     * @var int
     */
    private $sex = 0;

    /**
     * 描述
     *
     * @Column(name="description", type="string")
     * @var string
     */
    private $desc = '';

    /**
     * 非数据库字段，未定义映射关系
     *
     * @var mixed
     */
    private $otherProperty;

    /**
     * @return int|null
     */
    public function getId()
    {
        return $this->user_id;
    }

    /**
     * @param int|null $user_id
     */
    public function setId($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * @return null|string
     */
    public function getNick()
    {
        return $this->nick;
    }

    /**
     * @param null|string $nick
     */
    public function setNick($nick)
    {
        $this->nick = $nick;
    }

    /**
     * @return int
     */
    public function getAge(): int
    {
        return $this->age;
    }

    /**
     * @param int $age
     */
    public function setAge(int $age)
    {
        $this->age = $age;
    }

    /**
     * @return int
     */
    public function getSex(): int
    {
        return $this->sex;
    }

    /**
     * @param int $sex
     */
    public function setSex(int $sex)
    {
        $this->sex = $sex;
    }

    /**
     * @return string
     */
    public function getDesc(): string
    {
        return $this->desc;
    }

    /**
     * @param string $desc
     */
    public function setDesc(string $desc)
    {
        $this->desc = $desc;
    }

    /**
     * @return mixed
     */
    public function getOtherProperty()
    {
        return $this->otherProperty;
    }

    /**
     * @param mixed $otherProperty
     */
    public function setOtherProperty($otherProperty)
    {
        $this->otherProperty = $otherProperty;
    }
}
