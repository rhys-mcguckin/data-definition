<?php
/**
 * @file
 */
namespace DataDefinition\Data;

/**
 * Interface ValueInterface
 * @package DataDefinition
 */
interface ValueInterface {
  /**
   * @return mixed
   */
  public function getValue();

  /**
   * @param mixed $value
   *
   * @return self
   */
  public function setValue($value);

  /**
   * @param mixed $value
   *
   * @return bool
   */
  public function isValidValue($value);

  /**
   * Converts the value into the internal form of the value.
   *
   * @param mixed $value
   *
   * @return mixed
   */
  public function castValue($value);

  /**
   * Get the config for the current value.
   *
   * @return array
   */
  public function getConfig();

  /**
   * Sets the configuration for the value.
   *
   * @param array $config
   *
   * @return self
   */
  public function setConfig($config);
}
