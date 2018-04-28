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
 * @Table(name="bo_users")
 * @uses      BoUsers
 * @version   2018年04月28日
 */
class BoUsers extends Model
{
    /**
     * @var int $userId 
     * @Id()
     * @Column(name="user_id", type=Types::INT)
     */
    private $userId;

    /**
     * @var string $nick 昵称
     * @Column(name="nick", type=Types::STRING, length=50)
     * @Required()
     */
    private $nick;

    /**
     * @var string $avatar 头像
     * @Column(name="avatar", type=Types::STRING, length=65535)
     * @Required()
     */
    private $avatar;

    /**
     * @var string $mobile 手机号 唯一标识符
     * @Column(name="mobile", type=Types::STRING, length=20)
     * @Required()
     */
    private $mobile;

    /**
     * @var int $age 
     * @Column(name="age", type=Types::INT)
     * @Required()
     */
    private $age = 0;

    /**
     * @var int $sex 
     * @Column(name="sex", type=Types::INT)
     * @Required()
     */
    private $sex = 0;

    /**
     * @var string $salt 盐值
     * @Column(name="salt", type=Types::STRING, length=10)
     * @Required()
     */
    private $salt;

    /**
     * @var string $password 密码
     * @Column(name="password", type=Types::STRING, length=50)
     * @Required()
     */
    private $password;

    /**
     * @var mixed $regTime 注册时间
     * @Column(name="reg_time", type="string")
     * @Required()
     */
    private $regTime;

    /**
     * @var mixed $loginTime 登陆时间
     * @Column(name="login_time", type="string")
     * @Required()
     */
    private $loginTime;

    /**
     * @var string $lastIp 
     * @Column(name="last_ip", type=Types::STRING, length=20)
     * @Required()
     */
    private $lastIp;

    /**
     * @var int $visitCount 登陆次数
     * @Column(name="visit_count", type=Types::INT)
     * @Required()
     */
    private $visitCount = 0;

    /**
     * @var int $isDelete 是否禁用
     * @Column(name="is_delete", type=Types::INT)
     * @Required()
     */
    private $isDelete = 0;

    /**
     * @var int $isAdmin 
     * @Column(name="is_admin", type=Types::INT)
     * @Required()
     */
    private $isAdmin = 0;

    /**
     * @param int $value
     * @return $this
     */
    public function setUserId(int $value)
    {
        $this->userId = $value;

        return $this;
    }

    /**
     * 昵称
     * @param string $value
     * @return $this
     */
    public function setNick(string $value): self
    {
        $this->nick = $value;

        return $this;
    }

    /**
     * 头像
     * @param string $value
     * @return $this
     */
    public function setAvatar(string $value): self
    {
        $this->avatar = $value;

        return $this;
    }

    /**
     * 手机号 唯一标识符
     * @param string $value
     * @return $this
     */
    public function setMobile(string $value): self
    {
        $this->mobile = $value;

        return $this;
    }

    /**
     * @param int $value
     * @return $this
     */
    public function setAge(int $value): self
    {
        $this->age = $value;

        return $this;
    }

    /**
     * @param int $value
     * @return $this
     */
    public function setSex(int $value): self
    {
        $this->sex = $value;

        return $this;
    }

    /**
     * 盐值
     * @param string $value
     * @return $this
     */
    public function setSalt(string $value): self
    {
        $this->salt = $value;

        return $this;
    }

    /**
     * 密码
     * @param string $value
     * @return $this
     */
    public function setPassword(string $value): self
    {
        $this->password = $value;

        return $this;
    }

    /**
     * 注册时间
     * @param $value
     * @return $this
     */
    public function setRegTime($value): self
    {
        $this->regTime = $value;

        return $this;
    }

    /**
     * 登陆时间
     * @param $value
     * @return $this
     */
    public function setLoginTime($value): self
    {
        $this->loginTime = $value;

        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setLastIp(string $value): self
    {
        $this->lastIp = $value;

        return $this;
    }

    /**
     * 登陆次数
     * @param int $value
     * @return $this
     */
    public function setVisitCount(int $value): self
    {
        $this->visitCount = $value;

        return $this;
    }

    /**
     * 是否禁用
     * @param int $value
     * @return $this
     */
    public function setIsDelete(int $value): self
    {
        $this->isDelete = $value;

        return $this;
    }

    /**
     * @param int $value
     * @return $this
     */
    public function setIsAdmin(int $value): self
    {
        $this->isAdmin = $value;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * 昵称
     * @return mixed
     */
    public function getNick()
    {
        return $this->nick;
    }

    /**
     * 头像
     * @return mixed
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * 手机号 唯一标识符
     * @return mixed
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * @return mixed
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @return mixed
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * 盐值
     * @return mixed
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * 密码
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * 注册时间
     * @return mixed
     */
    public function getRegTime()
    {
        return $this->regTime;
    }

    /**
     * 登陆时间
     * @return mixed
     */
    public function getLoginTime()
    {
        return $this->loginTime;
    }

    /**
     * @return mixed
     */
    public function getLastIp()
    {
        return $this->lastIp;
    }

    /**
     * 登陆次数
     * @return mixed
     */
    public function getVisitCount()
    {
        return $this->visitCount;
    }

    /**
     * 是否禁用
     * @return mixed
     */
    public function getIsDelete()
    {
        return $this->isDelete;
    }

    /**
     * @return mixed
     */
    public function getIsAdmin()
    {
        return $this->isAdmin;
    }

}
