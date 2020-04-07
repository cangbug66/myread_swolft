<?php
namespace App\Rpc\Annotations;

use Doctrine\Common\Annotations\Annotation\Target;

/**
 * Class CheckParams
 * @package App\Rpc\Annotations
 * @Annotation
 * @Target({"METHOD"})
 */
class CheckParams{
    public $validator='';
}