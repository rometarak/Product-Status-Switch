<?php

/**
 * @file
 * Contains product_status_switch\product_status_switch.views.inc..
 * Provide a custom views field data that isn't tied to any other module. */

use Drupal\Component\Utility\NestedArray;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Entity\Sql\SqlContentEntityStorage;
use Drupal\Core\Render\Markup;
use Drupal\field\FieldConfigInterface;
use Drupal\field\FieldStorageConfigInterface;
use Drupal\system\ActionConfigEntityInterface;

/**
* Implements hook_views_data().
*/
function product_status_switch_views_data() {
/**
    $data['views']['table']['group'] = t('Custom Global');
    $data['views']['table']['join'] = [
      // #global is a special flag which allows a table to appear all the time.
      '#global' => [],
    ];
 */


    $data['commerce_product']['switch_views_field'] = [
        'title' => t('Product Status Switcher'),
        'help' => t('Switches status for the product'),
        'field' => [
            'id' => 'switch_views_field',
        ],
    ];

    return $data;
}
