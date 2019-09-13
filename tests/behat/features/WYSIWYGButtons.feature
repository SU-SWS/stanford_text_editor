@api
Feature: WYSIWYG Buttons
  In order to verify that wysiwyg works
  As a user
  I should see specific buttons

  @javascript
  Scenario: Create a simple basic page.
    Given I am logged in as a user with the "administrator" role
    Then I am on "/node/add/page"
    And I select "HTML" from "Text format"
    And I wait 1 seconds
    Then I should see 21 "a.cke_button" elements
    And I fill in "Title" with "Test autocomplete"
    And I press "Save"
    Then I am on "/node/add/page"
    And I select "HTML" from "Text format"
    And I wait 1 seconds
    And I click the "a[title='Link (Ctrl+L)']" element
    And I wait 1 seconds
    Then I fill in element "input.form-linkit-autocomplete" with "test"
    And I click the "input.form-linkit-autocomplete" element
    And I wait for AJAX to finish
    And I wait 1 seconds
    Then I should see "Test autocomplete"
