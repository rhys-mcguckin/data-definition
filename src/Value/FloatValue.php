<?php
/**
 * @file
 */
namespace DataDefinition\Data\Value;

/**
 * Class FloatValue
 * @package DataDefinition\Value
 */
class FloatValue extends AbstractValue {
  /**
   * {@inheritdoc}
   */
  public function isValidValue($value) {
    // TODO: This should pass appropriate options through.
    return filter_var($value, FILTER_VALIDATE_FLOAT) !== FALSE;
  }

  /**
   * {@inheritdoc}
   */
  public function castValue($value) {
    return filter_var($value, FILTER_VALIDATE_FLOAT);
  }
}
