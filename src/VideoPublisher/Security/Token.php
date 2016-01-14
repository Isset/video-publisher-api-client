<?php

namespace VideoPublisher\Security;

/**
 * Class Token.
 *
 * @author Bart Malestein <bart@isset.nl>
 */
class Token
{
    /**
     * @var string
     */
    private $value;

    /**
     * @var string
     */
    private $name;


    /**
     * Token constructor.
     * @param string $value
     * @param string $name
     */
    public function __construct($value, $name = 'xauth-token')
    {
        $this->value = $value;
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}