<?php
/**
 * @file
 */
namespace DataDefinition\Data\Value;

/**
 * Class StringValue
 * @package DataDefinition\Value
 */
class StringValue extends AbstractValue {
  /**
   * {@inheritdoc}
   */
  public function isValidValue($value) {
    // TODO: This should check length restrictions, etc.
    return is_scalar($value) || (is_object($value) && method_exists($value, '__toString'));
  }

  /**
   * {@inheritdoc}
   */
  public function castValue($value) {
    return (string)$value;
  }
}
