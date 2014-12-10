@authorizationLogin
Feature: Login form
    Anonymous users should have a possibility to log in properly.
    As a anonymous user
    I need to be able to log in propetly when I fill proper credential

    Scenario: See login form
        Given I go to the website root
          And I click "Login" link
         Then I should be on "/login"
          And should see "Login" headline

    Scenario: Login properly from homepage and redirect to homepage
        Given I am on "/login"
          And I fill in "username" with "Greg"
          And I fill in "password" with "a"
          And I press "Login"
         Then I should be on the homepage

    Scenario: Login properly from secured and redirect to secured page
        Given I am on "/notebooks/"
          And I fill in "username" with "Greg"
          And I fill in "password" with "a"
          And I press "Login"
         Then I should be redirected to the "app_module_notebook.ui.notebook.list" page

    Scenario: Login incorrectly
        Given I am on "/login"
          And I fill in "username" with "Greg"
          And I fill in "password" with "INVALID_PASSWORD"
          And I press "Login"
         Then I should see error message "Invalid credentials"
