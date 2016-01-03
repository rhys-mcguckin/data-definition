<?php
/**
 * @file
 */
namespace DataDefinition\Data\Value;

/**
 * Class ObjectValue
 * @package DataDefinition\Value
 */
class ObjectValue extends AbstractValue {
  /**
   * {@inheritdoc}
   */
  public function isValidValue($value) {
    // TODO: This should check object type, etc.
    return TRUE;
  }

  /**
   * {@inheritdoc}
   */
  public function castValue($value) {
    // TODO: this should convert the object into something we can store it as. probably the type of object and an identifier.
    return $value;
  }
}
