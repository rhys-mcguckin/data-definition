<?php
/**
 * @file
 */
namespace DataDefinition\Data;

/**
 * Interface ObjectInterface
 * @package DataDefinition
 */
interface ObjectInterface extends \ArrayAccess, \IteratorAggregate {
  /**
   * Constructs the object.
   *
   * @param \DataDefinition\Data\StructureInterface $structure
   *
   * @param string $identifier
   *
   * @param mixed $options
   *   Allow classes to pass in other options to be set for the object.
   *
   * @return self
   */
  public function __construct(StructureInterface $structure, $identifier, $options = NULL);

  /**
   * The identifier of the  object.
   *
   * @return string
   */
  public function getIdentifier();

  /**
   * Get the parent structure.
   *
   * @return \DataDefinition\Data\StructureInterface
   */
  public function getStructure();

  /**
   * Get the options used when constructing.
   *
   * @return mixed
   */
  public function getOptions();

  /**
   * Get all the values from the fields on this object.
   *
   * @return array
   */
  public function getValues();
}
