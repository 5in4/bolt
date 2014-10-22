<?php
namespace Bolt\Configuration;

use Symfony\Component\HttpFoundation\Request;

class Composer extends Standard
{

    /**
     * Constructor initialises on the app root path.
     *
     * @param string $path
     */
    public function __construct($loader)
    {
        parent::__construct($loader);
        $this->setPath('composer', realpath(dirname(__DIR__) . '/../'));
        $this->setPath('app', realpath(dirname(__DIR__) . '/../app/'));
        $this->setUrl('app', '/bolt-public/');
    }

    public function compat()
    {
        if (! defined("BOLT_COMPOSER_INSTALLED")) {
            define('BOLT_COMPOSER_INSTALLED', true);
        }
        parent::compat();
    }

    public function getVerifier()
    {
        if (! $this->verifier) {
            $this->verifier = new ComposerChecks($this);
        }

        return $this->verifier;
    }
}
