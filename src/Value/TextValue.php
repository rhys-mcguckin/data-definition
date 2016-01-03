<?php
/**
 * @file
 */
namespace DataDefinition\Data\Value;

/**
 * Class TextValue
 * @package DataDefinition\Value
 */
class TextValue extends AbstractValue {
  /**
   * {@inheritdoc}
   */
  public function isValidValue($value) {
    // TODO: This should have some configuration options to determine size restrictions, etc.
    return is_scalar($value) || (is_object($value) && method_exists($value, '__toString'));
  }

  /**
   * {@inheritdoc}
   */
  public function castValue($value) {
    return (string)$value;
  }
}
