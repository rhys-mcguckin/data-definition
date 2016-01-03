<?php
/**
 * @file
 */
namespace DataDefinition\Data\Value;

use DataDefinition\Data\ValueInterface;

/**
 * Class AbstractValue
 * @package DataDefinition\Data\Value
 */
abstract class AbstractValue implements ValueInterface {
  /**
   * @var mixed
   */
  protected $value;

  /**
   * {@inheritdoc}
   */
  public function getValue() {
    return $this->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setValue($value) {
    if ($this->isValidValue($value)) {
      $this->value = $this->castValue($value);
    }
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getConfig() {
    return array();
  }

  /**
   * {@inheritdoc}
   */
  public function setConfig($config) {
    return $this;
  }
}
