<?php
/**
 * @file
 */
namespace DataDefinition\Data;

/**
 * Interface StructureInterface
 * @package DataDefinition
 */
interface StructureInterface extends \ArrayAccess, \IteratorAggregate {
  /**
   * Constructs the structure.
   *
   * @param string $name
   * @param \DataDefinition\Data\FieldInterface[] $fields
   * @param int $version
   * @param mixed $options
   *
   * @return self
   */
  public function __construct($name, $fields, $version = 0, $options = NULL);

  /**
   * Get the name of the structure.
   *
   * @return string
   */
  public function getName();

  /**
   * Get the version of the structure.
   *
   * @return int
   */
  public function getVersion();

  /**
   * Get the list of fields defined by the structure.
   *
   * @return \DataDefinition\Data\FieldInterface[]
   */
  public function getFields();

  /**
   * Get the options that were passed through when constructing this structure.
   *
   * @return mixed
   */
  public function getOptions();
}
