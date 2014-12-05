<?php

namespace AppCommon\CommonModelBundle\Doctrine\ORM\Query\AST\Functions;

use \Doctrine\ORM\Query\AST\Functions\FunctionNode;
use \Doctrine\ORM\Query\Lexer;

/**
 * "AbstractMathFunction" "(" ArithmeticPrimary ")"
 * 
 * @author Athlan
 *
 */
abstract class AbstractMathFunction extends FunctionNode
{
    /**
     * @return string
     */
    abstract public function getMathFunctionName();
    
    public $simpleArithmeticExpression;
    
    final public function getSql(\Doctrine\ORM\Query\SqlWalker $sqlWalker)
    {
        return strtoupper($this->getMathFunctionName()) . '(' . $sqlWalker->walkSimpleArithmeticExpression(
                $this->simpleArithmeticExpression
        ) . ')';
    }
    
    final public function parse(\Doctrine\ORM\Query\Parser $parser)
    {
        $lexer = $parser->getLexer();
    
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);
    
        $this->simpleArithmeticExpression = $parser->SimpleArithmeticExpression();
    
        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }
}
