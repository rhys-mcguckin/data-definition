<?php
/**
 * @file
 */
namespace DataDefinition\Data\Value;

/**
 * Class BinaryValue
 * @package DataDefinition\Value
 */
class BinaryValue extends AbstractValue {
  /**
   * {@inheritdoc}
   */
  public function isValidValue($value) {
    // TODO: $value could be a file, stream resource, or anything else that could be opened by file_get_open.
    // TODO: It could also be the actual contents of the binary value.

    // TODO: This should check that the contents
    return TRUE;
  }

  /**
   * {@inheritdoc}
   */
  public function castValue($value) {
    return $value;
  }
}
