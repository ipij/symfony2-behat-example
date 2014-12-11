@notebook
Feature: Homepage
    In order to keep my notes organized
    As an authenticated user
    I need to be able to edit notebooks list
	
    Background:
        Given there are following users:
            | username | password |
            | Greg     | a        |
            | Katie    | a        |
	
    Scenario: User should can update notebook
              and be redirected to notebook tasks
        Given I am authenticated as "Greg"
          And I go to "/notebooks/"
          And I follow "Edit Todo list"
          And I fill in "notebook_name" with "Shopping list edited"
          And I press "Submit"
         Then I should see success message "The notebook has been updated successfully"
          And should be redirected to "/notebooks/(.+)"

#    Scenario: Notebook update form should fail when leave notebook name empty
#
