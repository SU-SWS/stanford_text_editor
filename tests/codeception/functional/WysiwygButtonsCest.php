<?php

/**
 * Class WysiwygButtonsCest.
 *
 * @group stanford_text_editor
 */
class WysiwygButtonsCest {

  /**
   * Wysiwyg buttons and the link should work correctly.
   */
  public function testWysiwygButtons(FunctionalTester $I) {
    $I->logInWithRole('administrator');
    $I->amOnPage('/node/add/page');
    $I->selectOption('Text format', 'HTML');
    $I->wait(2);
    $I->canSeeNumberOfElements('a.cke_button', 22);


    $I->canSeeNumberOfElements("a.cke_button[title='Bold (Ctrl+B)']", 1);
    $I->canSeeNumberOfElements("a.cke_button[title='Italic (Ctrl+I)']", 1);
    $I->canSeeNumberOfElements("a.cke_button[title='Align Left']", 1);
    $I->canSeeNumberOfElements("a.cke_button[title='Center']", 1);
    $I->canSeeNumberOfElements("a.cke_button[title='Align Right']", 1);
    $I->canSeeNumberOfElements("a.cke_button[title='Insert Horizontal Line']", 1);
    $I->canSeeNumberOfElements("a.cke_button__drupallink", 1);
    $I->canSeeNumberOfElements("a.cke_button__drupalunlink", 1);
    $I->canSeeNumberOfElements("a.cke_button[title='Anchor']", 1);
    $I->canSeeNumberOfElements("a.cke_button[title='Insert/Remove Bulleted List']", 1);
    $I->canSeeNumberOfElements("a.cke_button[title='Insert/Remove Numbered List']", 1);
    $I->canSeeNumberOfElements("a.cke_button[title='Decrease Indent']", 1);
    $I->canSeeNumberOfElements("a.cke_button[title='Increase Indent']", 1);
    $I->canSeeNumberOfElements("a.cke_button[title='Table']", 1);
    $I->canSeeNumberOfElements("a.cke_button[title='Block Quote']", 1);
    $I->canSeeNumberOfElements("a.cke_button[title='Insert from Media Library']", 1);
    $I->canSeeNumberOfElements("a.cke_button[title='Superscript']", 1);
    $I->canSeeNumberOfElements("a.cke_button[title='Subscript']", 1);
    $I->canSeeNumberOfElements("a.cke_button[title='Remove Format']", 1);
    $I->canSeeNumberOfElements("a.cke_button[title='Source']", 1);
    $I->canSeeNumberOfElements("a.cke_button[title='Paste from Word']", 1);
    $I->canSeeNumberOfElements("a.cke_button__a11ychecker", 1);

    $I->fillField('Title', 'Test Autocomplete');
    $I->click('Save');
    $I->amOnPage('/node/add/page');
    $I->selectOption('Text format', 'HTML');
    $I->wait(2);
    $I->click('a.cke_button__drupallink');
    $I->waitForElementVisible('input.form-linkit-autocomplete');
    $I->fillField('input.form-linkit-autocomplete', 'test');
    $I->waitForAjaxToFinish();
    $I->wait(1);
    $I->canSee('Test Autocomplete');
  }

}
