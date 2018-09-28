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
 * @Table(name="users")
 * @uses      Users
 */
class Users extends Model
{
    /**
     * @var int $userId 
     * @Id()
     * @Column(name="user_id", type="integer")
     */
    private $userId;

    /**
     * @var string $nick 昵称
     * @Column(name="nick", type="string", length=50, default="")
     */
    private $nick;

    /**
     * @var string $avatar 头像
     * @Column(name="avatar", type="text", length=65535)
     * @Required()
     */
    private $avatar;

    /**
     * @var string $mobile 手机号 唯一标识符
     * @Column(name="mobile", type="string", length=20)
     * @Required()
     */
    private $mobile;

    /**
     * @var int $age 
     * @Column(name="age", type="integer", default=0)
     */
    private $age;

    /**
     * @var int $sex 
     * @Column(name="sex", type="tinyint", default=0)
     */
    private $sex;

    /**
     * @var string $password 密码
     * @Column(name="password", type="string", length=50)
     * @Required()
     */
    private $password;

    /**
     * @var int $salt 盐值
     * @Column(name="salt", type="string", length=4)
     * @Required()
     */
    private $salt;

    /**
     * @var string $regTime 注册时间
     * @Column(name="reg_time", type="timestamp")
     * @Required()
     */
    private $regTime;

    /**
     * @var string $loginTime 登陆时间
     * @Column(name="login_time", type="timestamp")
     * @Required()
     */
    private $loginTime;

    /**
     * @var string $lastIp 
     * @Column(name="last_ip", type="string", length=20, default="0")
     */
    private $lastIp;

    /**
     * @var int $visitCount 登陆次数
     * @Column(name="visit_count", type="integer", default=0)
     */
    private $visitCount;

    /**
     * @var int $isDelete 是否禁用
     * @Column(name="is_delete", type="tinyint", default=0)
     */
    private $isDelete;

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
     * 盐值
     * @param int $value
     * @return $this
     */
    public function setSalt(int $value): self
    {
        $this->salt = $value;

        return $this;
    }

    /**
     * 注册时间
     * @param string $value
     * @return $this
     */
    public function setRegTime(string $value): self
    {
        $this->regTime = $value;

        return $this;
    }

    /**
     * 登陆时间
     * @param string $value
     * @return $this
     */
    public function setLoginTime(string $value): self
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
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * 昵称
     * @return string
     */
    public function getNick()
    {
        return $this->nick;
    }

    /**
     * 头像
     * @return string
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * 手机号 唯一标识符
     * @return string
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * @return int
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @return int
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * 密码
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * 盐值
     * @return int
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * 注册时间
     * @return string
     */
    public function getRegTime()
    {
        return $this->regTime;
    }

    /**
     * 登陆时间
     * @return string
     */
    public function getLoginTime()
    {
        return $this->loginTime;
    }

    /**
     * @return string
     */
    public function getLastIp()
    {
        return $this->lastIp;
    }

    /**
     * 登陆次数
     * @return int
     */
    public function getVisitCount()
    {
        return $this->visitCount;
    }

    /**
     * 是否禁用
     * @return int
     */
    public function getIsDelete()
    {
        return $this->isDelete;
    }

}
