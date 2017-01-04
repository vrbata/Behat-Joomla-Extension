<?php

namespace Symla\Behat\JoomlaExtension\Context;

trait DatabaseTransactions
{
    /**
     * @BeforeScenario
     */
    public function beforeScenario()
    {
        $db = \JFactory::getDbo();
        $db->transactionStart(true);
    }

    /**
     * @AfterScenario
     */
    public function afterScenario()
    {
        $db = \JFactory::getDbo();
        $db->transactionRollback(true);
    }
}