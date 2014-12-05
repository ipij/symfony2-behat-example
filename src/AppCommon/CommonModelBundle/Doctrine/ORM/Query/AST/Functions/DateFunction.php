<?php

namespace AppCommon\CommonModelBundle\Doctrine\ORM\Query\AST\Functions;

use \Doctrine\ORM\Query\AST\Functions\FunctionNode;
use \Doctrine\ORM\Query\Lexer;

/**
 * "DATE" "(" ArithmeticPrimary ")"
 * 
 * @author Athlan
 *
 */
class DateFunction extends FunctionNode
{
    public $simpleArithmeticExpression;
    
    final public function getSql(\Doctrine\ORM\Query\SqlWalker $sqlWalker)
    {
        return 'DATE(' . $sqlWalker->walkSimpleArithmeticExpression(
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
