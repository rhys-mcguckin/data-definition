<?php
/**
 * @file
 */
namespace DataDefinition\Data\Object;

use DataDefinition\Data\ObjectInterface;
use DataDefinition\Data\StructureInterface;

/**
 * Class GenericObject
 * @package DataDefinition\Object
 */
class GenericObject implements ObjectInterface {
  /**
   * @var \DataDefinition\Data\StructureInterface
   */
  protected $structure;

  /**
   * @var string
   */
  protected $identifier;

  /**
   * @var \DataDefinition\Data\ValueInterface[]
   */
  protected $values;

  /**
   * {@inheritdoc}
   */
  public function __construct(StructureInterface $structure, $identifier, $options = NULL) {
    $this->structure = $structure;
    $this->identifier = $identifier;

    // Generate the values for the object.
    $this->values = array();
    foreach ($structure as $field) {
      $this->values[$field->getName()] = $field->getValue();
    }
  }

  /**
   * Safely clone object.
   *
   * @return void
   */
  public function __clone() {
    foreach ($this->values as $key => $value) {
      $this->values[$key] = clone($value);
    }
  }

  /**
   * {@inheritdoc}
   */
  public function getIdentifier() {
    return $this->identifier;
  }

  /**
   * {@inheritdoc}
   */
  public function getStructure() {
    return $this->structure;
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
  public function getValues() {
    $list = array();
    foreach ($this->values as $key => $value) {
      $list[$key] = $value->getValue();
    }
    return $list;
  }

  /**
   * {@inheritdoc}
   */
  public function offsetExists($offset) {
    return array_key_exists($offset, $this->values);
  }

  /**
   * {@inheritdoc}
   */
  public function offsetGet($offset) {
    if (array_key_exists($offset, $this->values)) {
      return $this->values[$offset]->getValue();
    }
    return NULL;
  }

  /**
   * {@inheritdoc}
   */
  public function offsetSet($offset, $value) {
    if (array_key_exists($offset, $this->values)) {
      $this->values[$offset]->setValue($value);
    }
  }

  /**
   * {@inheritdoc}
   */
  public function offsetUnset($offset) {
    $this->offsetSet($offset, NULL);
  }

  /**
   * {@inheritdoc}
   */
  public function getIterator() {
    return new \ArrayIterator($this->values);
  }
}
