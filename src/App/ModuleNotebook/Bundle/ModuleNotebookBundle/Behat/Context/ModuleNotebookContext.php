<?php

namespace App\ModuleNotebook\Bundle\ModuleNotebookBundle\Behat\Context;

use Behat\Gherkin\Node\TableNode;

use AppBundle\Behat\Context\DefaultContext;

/**
 * 
 * @author Athlan
 *
 */
class ModuleNotebookContext extends DefaultContext
{
    private $users = array();
    
    /**
     * @Given /^there are following users:$/
     */
    public function thereAreFollowingUsers(TableNode $table) {
        foreach ($table->getHash() as $row) {
            $this->users[$row['username']] = $row;
        }
    }
    
    /**
     * @Given /^I am authenticated as "([^"]+)"$/
     */
    public function iAmAuthenticatedAs($username) {
        if (!isset($this->users[$username]['password'])) {
            throw new \OutOfBoundsException('Invalid user ' . $username);
        }
        
        $this->visitPath('/login');
        $this->fillField('_username', $username);
        $this->fillField('_password', $this->users[$username]['password']);
        $this->pressButton('_submit');
    }
    
    /**
     * @Given /^I am not logged in$/
     */
    public function iAmNotLoggedIn()
    {
        $this->getSession()->visit($this->generateUrl('fos_user_security_logout'));
    }
}
