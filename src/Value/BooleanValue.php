<?php
/**
 * @file
 */
namespace DataDefinition\Data\Value;

/**
 * Class BooleanValue
 * @package DataDefinition\Value
 */
class BooleanValue extends AbstractValue {
  /**
   * {@inheritdoc}
   */
  public function isValidValue($value) {
    return filter_var($value, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) !== NULL;

  }

  /**
   * {@inheritdoc}
   */
  public function castValue($value) {
    return filter_var($value, FILTER_VALIDATE_BOOLEAN);
  }
}
