<?php
/**
 * @file
 */
namespace DataDefinition\Data\Field;

use DataDefinition\Data\Value\BooleanValue;

/**
 * Class BooleanField
 * @package DataDefinition\Field
 */
class BooleanField extends AbstractField {
  /**
   * {@inheritdoc}
   */
  public function getValue() {
    return new BooleanValue();
  }
}
