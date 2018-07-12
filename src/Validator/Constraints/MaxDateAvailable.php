<?php


namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class MaxDateAvailable extends Constraint
{
    public $message = 'Il n\'est pas possible de réserver plus d\'un an à l\'avance.';
}
