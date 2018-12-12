<?php
namespace App\Models\Entity;

use Swoft\Db\Bean\Annotation\Column;
use Swoft\Db\Bean\Annotation\Entity;
use Swoft\Db\Bean\Annotation\Id;
use Swoft\Db\Bean\Annotation\Required;
use Swoft\Db\Bean\Annotation\Table;

/**
 * @Entity()
 * @Table(name="users")
 * @uses      Users
 */
class Users extends BaseModel
{
    /**
     * @var int $userId 
     * @Id()
     * @Column(name="user_id", type="integer")
     */
    private $userId;

    /**
     * @var int $githubId github_id
     * @Column(name="github_id", type="integer")
     * @Required()
     */
    private $githubId;

    /**
     * @var string $mobile 手机号
     * @Column(name="mobile", type="string", length=50)
     */
    private $mobile;

    /**
     * @var string $mail 邮箱
     * @Column(name="mail", type="string", length=255)
     */
    private $mail;

    /**
     * @var string $nick 昵称
     * @Column(name="nick", type="string", length=255)
     */
    private $nick;

    /**
     * @var string $avatar 头像
     * @Column(name="avatar", type="string", length=255)
     */
    private $avatar;

    /**
     * @var int $age 年龄
     * @Column(name="age", type="integer", default=0)
     */
    private $age;

    /**
     * @var int $sex 性别
     * @Column(name="sex", type="tinyint", default=0)
     */
    private $sex;

    /**
     * @var string $password 密码
     * @Column(name="password", type="string", length=255)
     * @Required()
     */
    private $password;

    /**
     * @var string $salt 盐值
     * @Column(name="salt", type="char", length=4)
     * @Required()
     */
    private $salt;

    /**
     * @var string $lastIp 
     * @Column(name="last_ip", type="string", length=20, default="")
     */
    private $lastIp;

    /**
     * @var int $visitCount 登陆次数
     * @Column(name="visit_count", type="integer", default=0)
     */
    public $visitCount;

    /**
     * @var int $isDelete 是否禁用

     * @Column(name="is_delete", type="tinyint", default=0)
     */
    private $isDelete;

    /**
     * @var string $createdAt
     * @Column(name="created_at", type="timestamp")
     */
    private $createdAt;

    /**
     * @var string $updatedAt
     * @Column(name="updated_at", type="timestamp")
     */
    private $updatedAt;

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
     * github_id
     * @param int $value
     * @return $this
     */
    public function setGithubId(int $value): self
    {
        $this->githubId = $value;

        return $this;
    }

    /**
     * 手机号
     * @param string $value
     * @return $this
     */
    public function setMobile(string $value): self
    {
        $this->mobile = $value;

        return $this;
    }

    /**
     * 邮箱
     * @param string $value
     * @return $this
     */
    public function setMail(string $value): self
    {
        $this->mail = $value;

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
     * 年龄
     * @param int $value
     * @return $this
     */
    public function setAge(int $value): self
    {
        $this->age = $value;

        return $this;
    }

    /**
     * 性别
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
     * @param string $value
     * @return $this
     */
    public function setSalt(string $value): self
    {
        $this->salt = $value;

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
     * @param string $value
     * @return $this
     */
    public function setCreatedAt(string $value): self
    {
        $this->createdAt = $value;

        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setUpdatedAt(string $value): self
    {
        $this->updatedAt = $value;

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
     * github_id
     * @return int
     */
    public function getGithubId()
    {
        return $this->githubId;
    }

    /**
     * 手机号
     * @return string
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * 邮箱
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
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
     * 年龄
     * @return int
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * 性别
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
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
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

    /**
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return string
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

}
