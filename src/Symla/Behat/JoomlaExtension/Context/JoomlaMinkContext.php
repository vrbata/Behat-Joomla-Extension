<?php

namespace Symla\Behat\JoomlaExtension\Context;

use Behat\MinkExtension\Context\MinkContext;

class JoomlaMinkContext extends MinkContext implements JoomlaAwareContext
{
    use JoomlaTrait;

    public function logInToAdministrator($username, $password)
    {
        $this->visit('/administrator/');
        $this->fillField('mod-login-username', $username);
        $this->fillField('mod-login-password', $password);

        $this->pressButton(\JText::_('JLOGIN'));
    }
}