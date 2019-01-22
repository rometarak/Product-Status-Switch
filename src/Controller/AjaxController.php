<?php

namespace Drupal\product_status_switch\Controller;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\ReplaceCommand;
use Drupal\Core\Url;
use Symfony\Component\HttpFoundation\Response;
use Drupal\Core\Controller\ControllerBase;
use Drupal\commerce_product\Entity\Product;
/**
 * Class AjaxController.
 */
class AjaxController extends ControllerBase {

  /**
   * Hello.
   *
   * @return string
   *   Return Hello string.
   */
  public function update($nojs = 'ajax') {


    $product_id = \Drupal::request()->get('commerce_product');
    $product = Product::load($product_id);
    $status = $product->isPublished();
    if($status){
      $product->setUnpublished();
    }
    else{
      $product->setPublished();
    }
    $product->save();
    $args = [
      'nojs' => 'ajax',
      'commerce_product' => $product->id(),
    ];
    $title = $status == 1 ? $this->t('Publish') : $this->t('Unpublish');
  //  ksm($status);
    $build = [
      '#type' => 'link',
      '#title' => $title,
      // We have to ensure that Drupal's Ajax system is loaded.
      '#attached' => ['library' => ['core/drupal.ajax']],
      // We add the 'use-ajax' class so that Drupal's AJAX system can spring
      // into action.
      '#attributes' => ['class' => ['use-ajax'],'id' => ['product-status-' . $product->id()]],
      '#url' => Url::fromRoute('product_status_switch.ajax_update', $args),
    ];
    if ($nojs == 'ajax') {
      $output = $build;
      $response = new AjaxResponse();
      $response->addCommand(new ReplaceCommand('#product-status-' . $product->id(), $output));

      return $response;
    }
    $response = new Response($this->t("This is some content delivered via a page load."));
    return $response;
  }
}
