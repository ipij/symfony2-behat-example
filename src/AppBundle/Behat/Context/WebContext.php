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
     * @When /^(?:|I )go to the "([^"]+)"  page?$/
     */
    public function iAmOnThePage($page)
    {
        $this->getSession()->visit($this->generateUrl($page));
    }
    
    /**
     * Checks, that current page PATH matches regular expression.
     *
     * @Then /^(?:|I )should be redirected to (?P<pattern>"(?:[^"]|\\")*")$/
     */
    public function iAmRedirectedToUrl($pattern)
    {
        $this->assertSession()->addressMatches($this->fixStepArgument($pattern));
    }
    
    /**
     * @Then /^(?:|I )should be on the "([^"]+)" (page)$/
     * @Then /^(?:|I )should be redirected to the "([^"]+)" (page)$/
     * @Then /^(?:|I )should still be on the "([^"]+)" (page)$/
     */
    public function iShouldBeOnThePage($page)
    {
        $this->assertSession()->addressEquals($this->generateUrl($page));
        try {
            $this->assertSession()->statusCodeEquals(200);
        } catch (UnsupportedDriverActionException $e) {
        }
    }

    /**
     * @When /^(?:|I )click into "([^"]+)" link?$/
     * @When /^(?:|I )click "([^"]+)" link?$/
     */
    public function iClickLink($link)
    {
        $this->clickLink($link);
    }

    /**
     * @When /^Print page content$/
     */
    public function printPageContent()
    {
        echo $this->getSession()->getPage()->getContent();
    }
    
    /**
     * @Then /^(?:|I )should see "([^"]+)" (heading|headline)$/
     */
    public function iShouldSeeHeading($heading)
    {
        $this->assertSession()->elementTextContains('xpath', '//h1 | //h2', $this->fixStepArgument($heading));
    }

    /**
     * @Then /^(?:|I )should see (?P<type>[(error|success|info|warning)]+) message "(?P<message>[^"]+)"$/
     */
    public function iShouldSeeMessage($type, $message)
    {
        $classesMap = [
            'success' => 'success',
            'error' => 'danger',
            'info' => 'info',
            'warning' => 'warning',
        ];
        $class = $classesMap[$type];
        
        $this->assertSession()->elementTextContains('xpath', '//div[@class="alert alert-' . $class . '"]', $this->fixStepArgument($message));
    }
}
