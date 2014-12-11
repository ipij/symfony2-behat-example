@notebook
Feature: Homepage
    In order to keep my notes organized
    As an authenticated user
    I need to be able to edit notes list
	
    Background:
        Given there are following users:
            | username | password |
            | Greg     | a        |
            | Katie    | a        |
	
    Scenario: User should can set note tags
              and be redirected back to notes list
              and see see this tags on the notes list
        Given I am authenticated as "Greg"
          And I go to "/notebooks/"
          And I follow "View Shopping list"
          And I follow "Edit Cheese"
          And I fill in "note_tags" with "at home, food, special meal"
          And I press "Submit"
         Then I should see success message "The note has been updated successfully"
          And should be redirected to "/notebooks/(.+)"
          And should see "special meal"

#    Scenario: User should can unset note tags
#              and be redirected back to notes list
#              and see see no longer this tags on the notes list
