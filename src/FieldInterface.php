<?php
/**
 * @file
 */
namespace DataDefinition\Data;

/**
 * Interface FieldInterface
 * @package DataDefinition
 */
interface FieldInterface {
  /**
   * Construct the field.
   *
   * @param string $name
   * @param array $config
   *
   * @return self
   */
  public function __construct($name, $config = array());

  /**
   * The name of the field within the parent.
   *
   * @return string
   */
  public function getName();

  /**
   * Get a generic value object that represents this field.
   *
   * @return \DataDefinition\Data\ValueInterface
   */
  public function getValue();

  /**
   * Get the configuration for this field.
   *
   * @return array
   */
  public function getConfig();
}
