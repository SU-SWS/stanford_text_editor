@api
Feature: WYSIWYG Buttons
  In order to verify that wysiwyg works
  As a user
  I should see specific buttons.

  @javascript
  Scenario: Test linkit support.
    Given I am logged in as a user with the "administrator" role
    Then I am on "/node/add/page"
    And I select "HTML" from "Text format"
    And I wait 1 seconds
    Then I should see 21 "a.cke_button" elements

    Then I should see 1 "a.cke_button[title='Bold (Ctrl+B)']" elements
    Then I should see 1 "a.cke_button[title='Italic (Ctrl+I)']" elements
    Then I should see 1 "a.cke_button[title='Align Left']" elements
    Then I should see 1 "a.cke_button[title='Center']" elements
    Then I should see 1 "a.cke_button[title='Align Right']" elements
    Then I should see 1 "a.cke_button[title='Insert Horizontal Line']" elements
    Then I should see 1 "a.cke_button__drupallink" elements
    Then I should see 1 "a.cke_button__drupalunlink" elements
    Then I should see 1 "a.cke_button[title='Anchor']" elements
    Then I should see 1 "a.cke_button[title='Insert/Remove Bulleted List']" elements
    Then I should see 1 "a.cke_button[title='Insert/Remove Numbered List']" elements
    Then I should see 1 "a.cke_button[title='Decrease Indent']" elements
    Then I should see 1 "a.cke_button[title='Increase Indent']" elements
    Then I should see 1 "a.cke_button[title='Table']" elements
    Then I should see 1 "a.cke_button[title='Block Quote']" elements
    Then I should see 1 "a.cke_button[title='Insert from Media Library']" elements
    Then I should see 1 "a.cke_button[title='Superscript']" elements
    Then I should see 1 "a.cke_button[title='Subscript']" elements
    Then I should see 1 "a.cke_button[title='Remove Format']" elements
    Then I should see 1 "a.cke_button[title='Source']" elements
    Then I should see 1 "a.cke_button[title='Paste from Word']" elements

    And I fill in "Title" with "Test autocomplete"
    And I press "Save"
    Then I am on "/node/add/page"
    And I select "HTML" from "Text format"
    And I wait 1 seconds
    And I click the "a.cke_button__drupallink" element
    And I wait 1 seconds
    Then I fill in element "input.form-linkit-autocomplete" with "test"
    And I click the "input.form-linkit-autocomplete" element
    And I wait for AJAX to finish
    And I wait 1 seconds
    Then I should see "Test autocomplete"
