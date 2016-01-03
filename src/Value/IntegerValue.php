<?php
/**
 * @file
 */
namespace DataDefinition\Data\Value;

/**
 * Class IntegerValue
 * @package DataDefinition\Value
 */
class IntegerValue extends AbstractValue {
  /**
   * {@inheritdoc}
   */
  public function isValidValue($value) {
    // TODO: This should pass appropriate options through.
    return filter_var($value, FILTER_VALIDATE_INT) !== FALSE;
  }

  /**
   * {@inheritdoc}
   */
  public function castValue($value) {
    return filter_var($value, FILTER_VALIDATE_INT);
  }
}