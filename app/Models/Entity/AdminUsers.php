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
 * @Table(name="admin_users")
 * @uses      AdminUsers
 */
class AdminUsers extends BaseModel
{
    /**
     * @var int $userId 
     * @Id()
     * @Column(name="user_id", type="integer")
     */
    private $userId;

    /**
     * @var string $account 昵称
     * @Column(name="account", type="string", length=50, default="")
     */
    private $account;

    /**
     * @var string $avatar 头像
     * @Column(name="avatar", type="text", length=65535)
     * @Required()
     */
    private $avatar;

    /**
     * @var int $salt 盐值
     * @Column(name="salt", type="integer")
     * @Required()
     */
    private $salt;

    /**
     * @var string $password 密码
     * @Column(name="password", type="string", length=50)
     * @Required()
     */
    private $password;

    /**
     * @var string $role 权限集合
     * @Column(name="role", type="string", length=255, default="-1")
     */
    private $role;

    /**
     * @var string $lastIp 
     * @Column(name="last_ip", type="string", length=20, default="0")
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
     * 昵称
     * @param string $value
     * @return $this
     */
    public function setAccount(string $value): self
    {
        $this->account = $value;

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
     * 权限集合
     * @param string $value
     * @return $this
     */
    public function setRole(string $value): self
    {
        $this->role = $value;

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
     * 昵称
     * @return string
     */
    public function getAccount()
    {
        return $this->account;
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
     * 盐值
     * @return int
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
     * 权限集合
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
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
