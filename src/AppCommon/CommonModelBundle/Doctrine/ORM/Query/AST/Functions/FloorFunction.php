<?php

namespace AppCommon\CommonModelBundle\Doctrine\ORM\Query\AST\Functions;

/**
 * "FLOOR" "(" ArithmeticPrimary ")"
 *
 * @author Athlan
 *
 */
class FloorFunction extends AbstractMathFunction
{
    /**
     * @return string
     */
    public function getMathFunctionName() {
        return 'FLOOR';
    }
}
