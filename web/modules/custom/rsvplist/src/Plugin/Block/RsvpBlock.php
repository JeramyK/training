<?php

/**
  * @file
  * contains \Drupal\rsvplist\Plugin\Block\RsvpBlock
  */

namespace Drupal\rsvplist\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
  * Provides an RSVP List Block
  * @Block(
  *   id = "rsvp_block",
  *   admin_label = @Translation("RSVP Block"),
  * )
  */

class RsvpBlock extends BlockBase {
  /**
  * {@inheritdoc}
  */

  public function build() {
    return array('#markup' => $this->t('My RSVP List Block'));
  }
}
