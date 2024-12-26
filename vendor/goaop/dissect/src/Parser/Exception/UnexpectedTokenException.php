<?php

declare(strict_types=1);

namespace Dissect\Parser\Exception;

use Dissect\Lexer\Token;
use RuntimeException;

/**
 * Thrown when a parser encounters an unexpected token.
 *
 * @author Jakub Lédl <jakubledl@gmail.com>
 */
class UnexpectedTokenException extends RuntimeException
{
    public const MESSAGE = <<<EOT
    Unexpected %s at line %d.

    Expected one of %s.
    EOT;

    protected Token $token;

    /**
     * @var string[]
     */
    protected array $expected;

    /**
     * Constructor.
     *
     * @param Token $token The unexpected token.
     * @param string[] $expected The expected token types.
     */
    public function __construct(Token $token, array $expected)
    {
        $this->token = $token;
        $this->expected = $expected;

        if ($token->getValue() !== $token->getType()) {
            $info = $token->getValue() . ' (' . $token->getType() . ')';
        } else {
            $info = $token->getType();
        }

        parent::__construct(sprintf(
            self::MESSAGE,
            $info,
            $token->getLine(),
            implode(', ', $expected)
        ));
    }

    /**
     * Returns the unexpected token.
     */
    public function getToken(): Token
    {
        return $this->token;
    }

    /**
     * Returns the expected token types.
     *
     * @return string[] The expected token types.
     */
    public function getExpected(): array
    {
        return $this->expected;
    }
}
