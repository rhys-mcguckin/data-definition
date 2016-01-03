<?php
/**
 * @file
 */
namespace DataDefinition\Data\Field;

use DataDefinition\Data\Value\BinaryValue;

/**
 * Class BinaryField
 * @package DataDefinition\Field
 */
class BinaryField extends AbstractField {
  /**
   * {@inheritdoc}
   */
  public function getValue() {
    return (new BinaryValue())->setConfig($this->getConfig());
  }
}
