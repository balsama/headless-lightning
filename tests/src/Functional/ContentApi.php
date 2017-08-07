<?php

namespace Drupal\Tests\headless_lightning\Functional;

use Drupal\Tests\BrowserTestBase;

/**
 * @group headless
 * @group content_api
 */
class ContentApi extends BrowserTestBase {
  /**
   * {@inheritdoc}
   */
  protected $profile = 'lightning_headless';

  public function test() {
    $assert = $this->assertSession();
    $page_collection_json_uri = '/jsonapi/node/page';

    // Basic Page collection get works with no content.
    $this->drupalGet($page_collection_json_uri);
    $assert->statusCodeEquals(200);

    // Basic Page collection get works with content.
    $this->createNode(['title' => t('Flutes of Chi'), 'type' => 'page',]);
    $this->drupalGet($page_collection_json_uri);
    $assert->statusCodeEquals(200);
  }

}