<?php

namespace Drupal\highfive\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'highfiveblock' Block.
 *
 * @Block(
 *   id = "high_five_block",
 *   admin_label = @Translation("High Five block"),
 *   category = @Translation("High Five"),
 * )
 */
class HighFiveBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    return array(
      '#markup' => $this->t('High Five!'),
    );
  }

}
