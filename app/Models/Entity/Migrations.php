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
 * @Table(name="migrations")
 * @uses      Migrations
 */
class Migrations extends Model
{
    /**
     * @var int $id 
     * @Id()
     * @Column(name="id", type="integer")
     */
    private $id;

    /**
     * @var string $migration 
     * @Column(name="migration", type="string", length=255)
     * @Required()
     */
    private $migration;

    /**
     * @var int $batch 
     * @Column(name="batch", type="integer")
     * @Required()
     */
    private $batch;

    /**
     * @param int $value
     * @return $this
     */
    public function setId(int $value)
    {
        $this->id = $value;

        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setMigration(string $value): self
    {
        $this->migration = $value;

        return $this;
    }

    /**
     * @param int $value
     * @return $this
     */
    public function setBatch(int $value): self
    {
        $this->batch = $value;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getMigration()
    {
        return $this->migration;
    }

    /**
     * @return int
     */
    public function getBatch()
    {
        return $this->batch;
    }

}
