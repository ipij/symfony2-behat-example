@notebook
Feature: Notebook
	In order to keep my notes organized
    As an authenticated user
    I need to be able to see my notebooks
	
    Background:
        Given there are following users:
            | username | password |
            | Greg     | a        |
            | Katie    | a        |
	
    Scenario: User should open own notebooks from the list
        Given I am authenticated as "Katie"
          And I go to "/notebooks/"
          And I follow "Todo list"
         Then I should be on "/notebooks/todo-list"
          And the response status code should be 200
	
    Scenario: User shouldn't open another user's notebooks giving prepared URL
        Given I am authenticated as "Katie"
          And I go to "/notebooks/shopping-list"
         Then the response status code should be 404
