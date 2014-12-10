@homepage
Feature: Homepage
    In order to make me sure that Behat is configured properly with Symfony2
    As a anonymous user
    I need to be able to see Homepage text somewhere

    Scenario:
        Given I go to the website root
         Then I should see "Notes app"
