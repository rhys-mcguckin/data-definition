<?php
/**
 * @file
 */
namespace DataDefinition\Data\Field;
use DataDefinition\Data\Value\ObjectValue;

/**
 * Class ObjectField
 * @package DataDefinition\Field
 */
class ObjectField extends AbstractField {
  /**
   * {@inheritdoc}
   */
  public function getValue() {
    return new ObjectValue();
  }
}
