<?php

namespace App\Rpc\Validators;

use Swoft\Validator\Annotation\Mapping\IsFloat;
use Swoft\Validator\Annotation\Mapping\IsInt;
use Swoft\Validator\Annotation\Mapping\IsString;
use Swoft\Validator\Annotation\Mapping\Length;
use Swoft\Validator\Annotation\Mapping\Max;
use Swoft\Validator\Annotation\Mapping\Min;
use Swoft\Validator\Annotation\Mapping\Validator;

/**
 * Class CourseUpdator
 *
 * @since 2.0
 *
 * @Validator(name="CourseUpdator")
 */
class CourseUpdator
{
    /**
     * @var
     * @IsInt()
     * @Min(value=1,message="id不正确")
     */
    protected $item_id;

    /**
     * @IsString()
     * @Length(min=2,max=200,message="标题不合法")
     */
    protected $course_title;
    /**
     * @var $course_price
     * @IsFloat(message="价格不合法")
     * @Min(value=0)
     * @Max(value=10000)
     */
    protected $course_price;
    /**
     * @IsString(message="course_intr 必须为字符串")
     */
    protected $course_intr;
}