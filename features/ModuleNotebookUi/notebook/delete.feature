@notebook
Feature: Homepage
    In order to keep my notes organized
    As an authenticated user
    I need to be able to delete notebooks list
	
    Background:
        Given there are following users:
            | username | password |
            | Greg     | a        |
            | Katie    | a        |
	
#    Scenario: User should can delete notebook
#              and see confirmation info mesage
#              and be redirected to notebook list
#              that does not contain deleted notebook.
#

#    Scenario: User should can cancel notebook deletion
#              and see confirmation info mesage
#              and be redirect back to notebook list
#              and notebook should still exists.
#

#    Scenario: User cannot delete non-existing notebook giving prepared URL
#

#    Scenario: User cannot delete other's notebook giving prepared URL
#
