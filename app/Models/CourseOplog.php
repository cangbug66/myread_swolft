<?php declare(strict_types=1);


namespace App\Models;

use Swoft\Db\Annotation\Mapping\Column;
use Swoft\Db\Annotation\Mapping\Entity;
use Swoft\Db\Annotation\Mapping\Id;
use Swoft\Db\Eloquent\Model;


/**
 * 
 * Class CourseOplog
 *
 * @since 2.0
 *
 * @Entity(table="course_oplog")
 */
class CourseOplog extends Model
{
    /**
     * 
     * @Id()
     * @Column(name="item_id", prop="itemId")
     *
     * @var int
     */
    private $itemId;

    /**
     * 
     *
     * @Column(name="user_name", prop="userName")
     *
     * @var string|null
     */
    private $userName;

    /**
     * 操作类型
     *
     * @Column(name="op_type", prop="opType")
     *
     * @var int|null
     */
    private $opType;

    /**
     * 备注
     *
     * @Column(name="op_comment", prop="opComment")
     *
     * @var string|null
     */
    private $opComment;

    /**
     * 
     *
     * @Column()
     *
     * @var string|null
     */
    private $addtime;


    /**
     * @param int $itemId
     *
     * @return void
     */
    public function setItemId(int $itemId): void
    {
        $this->itemId = $itemId;
    }

    /**
     * @param string|null $userName
     *
     * @return void
     */
    public function setUserName(?string $userName): void
    {
        $this->userName = $userName;
    }

    /**
     * @param int|null $opType
     *
     * @return void
     */
    public function setOpType(?int $opType): void
    {
        $this->opType = $opType;
    }

    /**
     * @param string|null $opComment
     *
     * @return void
     */
    public function setOpComment(?string $opComment): void
    {
        $this->opComment = $opComment;
    }

    /**
     * @param string|null $addtime
     *
     * @return void
     */
    public function setAddtime(?string $addtime): void
    {
        $this->addtime = $addtime;
    }

    /**
     * @return int
     */
    public function getItemId(): ?int
    {
        return $this->itemId;
    }

    /**
     * @return string|null
     */
    public function getUserName(): ?string
    {
        return $this->userName;
    }

    /**
     * @return int|null
     */
    public function getOpType(): ?int
    {
        return $this->opType;
    }

    /**
     * @return string|null
     */
    public function getOpComment(): ?string
    {
        return $this->opComment;
    }

    /**
     * @return string|null
     */
    public function getAddtime(): ?string
    {
        return $this->addtime;
    }

}
