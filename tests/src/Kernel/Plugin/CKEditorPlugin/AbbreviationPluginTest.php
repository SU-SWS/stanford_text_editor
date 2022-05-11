<?php

namespace Drupal\Tests\stanford_text_editor\Kernel\Plugin\CkeditorPlugin;

use Drupal\editor\Entity\Editor;
use Drupal\KernelTests\KernelTestBase;

/**
 * Class AbbreviationPluginTest
 *
 * @group stanford_text_editor
 */
class AbbreviationPluginTest extends KernelTestBase {

  /**
   * {@inheritdoc}
   */
  protected static $modules = ['system', 'ckeditor', 'stanford_text_editor'];

  /**
   * Fixed toolbar plugin exists.
   */
  public function testFixedToolbarPlugin() {
    /** @var \Drupal\ckeditor\CKEditorPluginManager $ckeditor_plugin_manager */
    $ckeditor_plugin_manager = \Drupal::service('plugin.manager.ckeditor.plugin');
    $this->assertArrayHasKey('abbr', $ckeditor_plugin_manager->getDefinitions());
    /** @var \Drupal\stanford_text_editor\Plugin\CKEditorPlugin\Abbreviation $plugin */
    $plugin = $ckeditor_plugin_manager->createInstance('abbr');
    $this->assertStringContainsString('plugin.js', $plugin->getFile());

    $editor = $this->createMock(Editor::class);

    $this->assertEmpty($plugin->getLibraries($editor));
    $this->assertEmpty($plugin->getConfig($editor));

    $buttons_array = $plugin->getButtons($editor);
    $this->assertArrayHasKey('Abbr', $buttons_array);
    $this->assertArrayHasKey('label', $buttons_array['Abbr']);
    $this->assertArrayHasKey('image', $buttons_array['Abbr']);

    $this->assertTrue($plugin->isEnabled($editor));
  }

}
