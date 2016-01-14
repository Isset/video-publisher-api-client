<?php
namespace VideoPublisher\Security;

use VideoPublisher\Exception\TokenCacheNotWritableException;
use VideoPublisher\Exception\TokenNotFoundException;


/**
 * Class TokenVault.
 *
 * @author Bart Malestein <bart@isset.nl>
 */
class TokenVault
{
    /**
     * @var string
     */
    private $tokenCacheLocation;

    /**
     * TokenVault constructor.
     * @param $tokenCacheLocation
     * @throws TokenCacheNotWritableException
     */
    public function __construct($tokenCacheLocation)
    {
        $this->tokenCacheLocation = rtrim($tokenCacheLocation, '/') . '/';
        if (false === is_writable($tokenCacheLocation)) {
            throw new TokenCacheNotWritableException('token cache location isn\'t writable: ' . $tokenCacheLocation);
        }
    }

    /**
     * @param string $consumerKey
     * @param Token $token
     */
    public function addToken($consumerKey, Token $token)
    {
        file_put_contents($this->getPathForToken($consumerKey), $token->getValue());
    }

    /**
     * @param string $consumerKey
     */
    public function removeToken($consumerKey)
    {
        $location = $this->getPathForToken($consumerKey);
        if (file_exists($location)) {
            unlink($location);
        }
    }

    /**
     * @param string $consumerKey
     * @return bool
     */
    public function hasToken($consumerKey)
    {
        $location = $this->getPathForToken($consumerKey);

        return file_exists($location);
    }

    /**
     * @param string $consumerKey
     * @return Token
     * @throws TokenNotFoundException
     */
    public function getToken($consumerKey)
    {
        $location = $this->getPathForToken($consumerKey);
        if (false === file_exists($location)) {
            throw new TokenNotFoundException();
        }
        return new Token(file_get_contents($location));
    }

    /**
     * @param string $consumerKey
     * @return string
     */
    public function getPathForToken($consumerKey)
    {
        return $this->tokenCacheLocation . sha1($consumerKey);
    }
}