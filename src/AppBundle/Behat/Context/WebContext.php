<?php

namespace AppBundle\Behat\Context;

use Behat\Mink\Exception\UnsupportedDriverActionException;

/**
 * 
 * @author Athlan
 *
 */
class WebContext extends DefaultContext
{
    /**
     * @When /^I go to the website root$/
     */
    public function iGoToTheWebsiteRoot()
    {
        $this->getSession()->visit('/');
    }
    
    /**
     * @Given /^I am on the "([^"]+)"  page?$/
     * @When /^I go to the "([^"]+)"  page?$/
     */
    public function iAmOnThePage($page)
    {
        $this->getSession()->visit($this->generateUrl($page));
    }
    
    /**
     * @Then /^I should be on the "([^"]+)" (page)$/
     * @Then /^I should be redirected to the "([^"]+)"  (page)$/
     * @Then /^I should still be on the "([^"]+)"  (page)$/
     */
    public function iShouldBeOnThePage($page)
    {
        $this->assertSession()->addressEquals($this->generateUrl($page));
        try {
            $this->assertStatusCodeEquals(200);
        } catch (UnsupportedDriverActionException $e) {
        }
    }
}
