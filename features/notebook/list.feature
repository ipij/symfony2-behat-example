@notebook
Feature: Homepage
    In order to keep my notes organized
    As an authenticated user
    I need to be able to see my notebooks list
	
    Background:
        Given there are following users:
            | username | password |
            | Greg     | a        |
            | Katie    | a        |
	
    Scenario: User should see own notebooks on the list
        Given I am authenticated as "Katie"
          And I go to "/notebooks/"
         Then I should see "Todo list"
          And I should not see "Shopping list"

    Scenario: User should see own notebooks on the list
        Given I am authenticated as "Greg"
          And I go to "/notebooks/"
         Then I should see "Todo list"
          And I should see "Shopping list"
