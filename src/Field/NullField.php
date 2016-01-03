<?php
/**
 * @file
 */
namespace DataDefinition\Data\Field;

/**
 * Class NullField
 * @package DataDefinition\Field
 */
class NullField extends AbstractField {
  /**
   * {@inheritdoc}
   */
  public function getValue() {
    return NULL;
  }
}
