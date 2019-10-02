<?php

namespace Drupal\Tests\stanford_text_editor\Kernel;

use Drupal\KernelTests\KernelTestBase;

class StanfordTextEditorTest extends KernelTestBase {

  /**
   * {@inheritdoc}
   */
  protected static $modules = [
    'ckeditor',
    'editor',
    'entity_embed',
    'filter',
    'linkit',
    'stanford_text_editor',
    'system',
  ];

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();
    $this->installConfig('stanford_text_editor');
  }

  /**
   * Test the editor were installed with correct settings.
   *
   * @throws \Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException
   * @throws \Drupal\Component\Plugin\Exception\PluginNotFoundException
   */
  public function testEditors() {
    /** @var \Drupal\editor\Entity\Editor[] $editors */
    $editors = \Drupal::entityTypeManager()
      ->getStorage('editor')
      ->loadMultiple();
    $this->assertCount(2, $editors);
    $this->assertArrayHasKey('stanford_html', $editors);
    $this->assertArrayHasKey('stanford_minimal_html', $editors);

    $settings = $editors['stanford_html']->getSettings();
    $this->assertCount(1, $settings['toolbar']['rows']);
    $this->assertCount(5, $settings['toolbar']['rows'][0]);

    $this->assertArrayHasKey('drupallink', $settings['plugins']);
    $this->assertArraySubset([
      'linkit_enabled' => TRUE,
      'linkit_profile' => 'default',
    ], $settings['plugins']['drupallink']);
    $styles = [
      'a.su-button|Button',
      'a.su-button--big|Big Button',
      'a.su-button--secondary|Secondary Button',
      'p.su-intro-text|Intro Text',
      'p.su-font-splash|Splash Font',
      'p.su-quote-text|Quote Text',
      'p.su-drop-cap|Drop Cap First Letter',
      'p.su-related-text|Related Text',
      'p.su-callout-text|Callout Text',
    ];
    $this->assertArraySubset(['styles' => implode("\r\n", $styles)], $settings['plugins']['stylescombo']);
    $settings = $editors['stanford_minimal_html']->getSettings();
    $this->assertCount(1, $settings['toolbar']['rows']);
    $this->assertCount(3, $settings['toolbar']['rows'][0]);

    $this->assertArrayHasKey('drupallink', $settings['plugins']);
    $this->assertArraySubset([
      'linkit_enabled' => TRUE,
      'linkit_profile' => 'default',
    ], $settings['plugins']['drupallink']);
    $this->assertArraySubset(['styles' => "a.su-button|Button\r\na.su-button--big|Big Button\r\na.su-button--secondary|Secondary Button"], $settings['plugins']['stylescombo']);

  }

  /**
   * Test the format filters were installed with correct settings.
   *
   * @throws \Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException
   * @throws \Drupal\Component\Plugin\Exception\PluginNotFoundException
   */
  public function testFilterFormats() {
    /** @var \Drupal\filter\Entity\FilterFormat[] $filters */
    $filters = \Drupal::entityTypeManager()
      ->getStorage('filter_format')
      ->loadMultiple();
    $this->assertCount(2, $filters);

    $this->assertCount(11, $filters['stanford_html']->get('filters'));
    $html_filters = [
      'editor_file_reference',
      'entity_embed',
      'filter_align',
      'filter_autop',
      'filter_caption',
      'filter_html',
      'filter_html_escape',
      'filter_html_image_secure',
      'filter_htmlcorrector',
      'filter_url',
      'linkit',
    ];
    foreach ($html_filters as $filter_id) {
      $this->assertNotNull($filters['stanford_html']->filters()
        ->get($filter_id));
    }

    $this->assertCount(3, $filters['stanford_minimal_html']->get('filters'));

    $html_filters = [
      'filter_html',
      'filter_htmlcorrector',
      'linkit',
    ];
    foreach ($html_filters as $filter_id) {
      $this->assertNotNull($filters['stanford_html']->filters()
        ->get($filter_id));
    }
  }

}
