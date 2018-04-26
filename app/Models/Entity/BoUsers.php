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
 * @Table(name="bo_users")
 * @uses      BoUsers
 * @version   2018年04月25日
 */
class BoUsers extends Model
{
    /**
     * @var int $user_id 
     * @Id()
     * @Column(name="user_id", type=Types::INT)
     */
    private $user_id = '';

    /**
     * @var string $nick 昵称
     * @Column(name="nick", type=Types::STRING, length=50)
     * @Required()
     */
    private $nick = '';

    /**
     * @var string $avatar 头像
     * @Column(name="avatar", type=Types::STRING, length=65535)
     * @Required()
     */
    private $avatar = '';

    /**
     * @var string $mobile 手机号 唯一标识符
     * @Column(name="mobile", type=Types::STRING, length=20)
     * @Required()
     */
    private $mobile = '';

    /**
     * @var int $age 
     * @Column(name="age", type=Types::INT)
     * @Required()
     */
    private $age = '0';

    /**
     * @var int $sex 
     * @Column(name="sex", type=Types::INT)
     * @Required()
     */
    private $sex = '0';

    /**
     * @var string $salt 盐值
     * @Column(name="salt", type=Types::STRING, length=10)
     * @Required()
     */
    private $salt = '';

    /**
     * @var string $password 密码
     * @Column(name="password", type=Types::STRING, length=50)
     * @Required()
     */
    private $password = '';

    /**
     * @var mixed $reg_time 注册时间
     * @Column(name="reg_time", type="string")
     * @Required()
     */
    private $reg_time = '';

    /**
     * @var mixed $login_time 登陆时间
     * @Column(name="login_time", type="string")
     * @Required()
     */
    private $login_time = '';

    /**
     * @var string $last_ip 
     * @Column(name="last_ip", type=Types::STRING, length=20)
     * @Required()
     */
    private $last_ip = '0';

    /**
     * @var int $visit_count 登陆次数
     * @Column(name="visit_count", type=Types::INT)
     * @Required()
     */
    private $visit_count = '0';

    /**
     * @var int $is_delete 是否禁用
     * @Column(name="is_delete", type=Types::INT)
     * @Required()
     */
    private $is_delete = '0';

    /**
     * @var int $is_admin 
     * @Column(name="is_admin", type=Types::INT)
     * @Required()
     */
    private $is_admin = '0';

 
    /**
     * 
     * @param int $value
     * @return $this
     */
    public function setUser_Id(int $value)
    {
        $this->user_id = $value;

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
     * 
     * @param int $value
     * @return $this
     */
    public function setAge(int $value): self
    {
        $this->age = $value;

        return $this;
    }

    /**
     * 
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
        $this->reg_time = $value;

        return $this;
    }

    /**
     * 登陆时间
     * @param $value
     * @return $this
     */
    public function setLoginTime($value): self
    {
        $this->login_time = $value;

        return $this;
    }

    /**
     * 
     * @param string $value
     * @return $this
     */
    public function setLastIp(string $value): self
    {
        $this->last_ip = $value;

        return $this;
    }

    /**
     * 登陆次数
     * @param int $value
     * @return $this
     */
    public function setVisitCount(int $value): self
    {
        $this->visit_count = $value;

        return $this;
    }

    /**
     * 是否禁用
     * @param int $value
     * @return $this
     */
    public function setIsDelete(int $value): self
    {
        $this->is_delete = $value;

        return $this;
    }

    /**
     * 
     * @param int $value
     * @return $this
     */
    public function setIsAdmin(int $value): self
    {
        $this->is_admin = $value;

        return $this;
    }

 
    /**
     * 
     * @return int
     */
    public function getUser_Id()
    {
        return $this->user_id;
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
     * 
     * @return int
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * 
     * @return int
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * 盐值
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
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
     * 注册时间
     * @return mixed
     */
    public function getRegTime()
    {
        return $this->reg_time;
    }

    /**
     * 登陆时间
     * @return mixed
     */
    public function getLoginTime()
    {
        return $this->login_time;
    }

    /**
     * 
     * @return string
     */
    public function getLastIp()
    {
        return $this->last_ip;
    }

    /**
     * 登陆次数
     * @return int
     */
    public function getVisitCount()
    {
        return $this->visit_count;
    }

    /**
     * 是否禁用
     * @return int
     */
    public function getIsDelete()
    {
        return $this->is_delete;
    }

    /**
     * 
     * @return int
     */
    public function getIsAdmin()
    {
        return $this->is_admin;
    }

}
