@dashboard
Feature: Homepage
    In order to have Behat is configured properly with Symfony2
    As a anonymous user
    I need to be able to see Homepage

    Scenario:
        Given I go to the website root
         Then I should see "Homepage"
