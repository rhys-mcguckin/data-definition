<?php
/**
 * @file
 */
namespace DataDefinition\Data\Structure;

use DataDefinition\Data\StructureInterface;

/**
 * Class NullStructure
 * @package DataDefinition\Structure
 */
class NullStructure implements StructureInterface {
  /**
   * @var string
   */
  protected $name;

  /**
   * {@inheritdoc}
   */
  public function __construct($name, $fields, $version = 0, $options = NULL) {
    $this->name = (string)$name;
  }

  /**
   * {@inheritdoc}
   */
  public function getName() {
    return $this->name;
  }

  /**
   * {@inheritdoc}
   */
  public function getVersion() {
    return 0;
  }

  /**
   * {@inheritdoc}
   */
  public function getFields() {
    return array();
  }

  /**
   * {@inheritdoc}
   */
  public function getOptions() {
    return NULL;
  }

  /**
   * {@inheritdoc}
   */
  public function offsetExists($offset) {
    return FALSE;
  }

  /**
   * {@inheritdoc}
   */
  public function offsetGet($offset) {
    return NULL;
  }

  /**
   * {@inheritdoc}
   */
  public function offsetSet($offset, $value) {
  }

  /**
   * {@inheritdoc}
   */
  public function offsetUnset($offset) {
  }

  /**
   * {@inheritdoc}
   */
  public function getIterator() {
    return new \ArrayIterator();
  }
}
