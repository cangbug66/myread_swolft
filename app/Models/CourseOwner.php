<?php declare(strict_types=1);


namespace App\Models;

use Swoft\Db\Annotation\Mapping\Column;
use Swoft\Db\Annotation\Mapping\Entity;
use Swoft\Db\Annotation\Mapping\Id;
use Swoft\Db\Eloquent\Model;


/**
 * 
 * Class CourseOwner
 *
 * @since 2.0
 *
 * @Entity(table="course_owner")
 */
class CourseOwner extends Model
{
    /**
     * 
     * @Id(incrementing=false)
     * @Column(name="course_id", prop="courseId")
     *
     * @var int
     */
    private $courseId;

    /**
     * 
     *
     * @Column(name="user_name", prop="userName")
     *
     * @var string
     */
    private $userName;

    /**
     * 
     *
     * @Column(name="is_main", prop="isMain")
     *
     * @var int|null
     */
    private $isMain;


    /**
     * @param int $courseId
     *
     * @return void
     */
    public function setCourseId(int $courseId): void
    {
        $this->courseId = $courseId;
    }

    /**
     * @param string $userName
     *
     * @return void
     */
    public function setUserName(string $userName): void
    {
        $this->userName = $userName;
    }

    /**
     * @param int|null $isMain
     *
     * @return void
     */
    public function setIsMain(?int $isMain): void
    {
        $this->isMain = $isMain;
    }

    /**
     * @return int
     */
    public function getCourseId(): ?int
    {
        return $this->courseId;
    }

    /**
     * @return string
     */
    public function getUserName(): ?string
    {
        return $this->userName;
    }

    /**
     * @return int|null
     */
    public function getIsMain(): ?int
    {
        return $this->isMain;
    }

}
