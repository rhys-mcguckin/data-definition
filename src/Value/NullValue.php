<?php
/**
 * @file
 */
namespace DataDefinition\Data\Value;

use DataDefinition\Data\ValueInterface;

/**
 * Class NullValue
 * @package DataDefinition\Value
 */
class NullValue implements ValueInterface {
  /**
   * {@inheritdoc}
   */
  public function getValue() {
    return NULL;
  }

  /**
   * {@inheritdoc}
   */
  public function setValue($value) {
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function isValidValue($value) {
    return FALSE;
  }

  /**
   * {@inheritdoc}
   */
  public function castValue($value) {
    return NULL;
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
