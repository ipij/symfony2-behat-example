<?php

namespace AppCommon\CommonModelBundle\Doctrine\ORM\Query\AST\Functions;

/**
 * "CEIL" "(" ArithmeticPrimary ")"
 *
 * @author Athlan
 *
 */
class CeilFunction extends AbstractMathFunction
{
    /**
     * @return string
     */
    public function getMathFunctionName() {
        return 'CEIL';
    }
}
