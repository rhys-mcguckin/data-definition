<?php
/**
 * @file
 */
namespace DataDefinition\Data\Structure;

use DataDefinition\Data\FieldInterface;
use DataDefinition\Data\StructureInterface;

/**
 * Class GenericStructure
 * @package DataDefinition\Data\Structure
 */
class GenericStructure implements StructureInterface {
  /**
   * @var string
   */
  protected $name;

  /**
   * @var int
   */
  protected $version;

  /**
   * @var \DataDefinition\Data\FieldInterface[]
   */
  protected $fields;

  /**
   * @var mixed
   */
  protected $options;

  /**
   * {@inheritdoc}
   */
  public function __construct($name, $fields, $version = 0, $options = NULL) {
    $this->name = (string)$name;
    $this->version = $version;
    $this->options = $options;

    // Setup the fields
    $this->fields = array();
    if (is_array($fields)) {
      foreach ($fields as $field) {
        if ($field instanceof FieldInterface) {
          $this->fields[$field->getName()] = $field;
        }
      }
    }
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
    return $this->version;
  }

  /**
   * {@inheritdoc}
   */
  public function getFields() {
    return array_keys($fields);
  }

  /**
   * {@inheritdoc}
   */
  public function getOptions() {
    return $this->options;
  }

  /**
   * {@inheritdoc}
   */
  public function offsetExists($offset) {
    return array_key_exists($offset, $this->fields);
  }

  /**
   * {@inheritdoc}
   */
  public function offsetGet($offset) {
    if (array_key_exists($offset, $this->fields)) {
      return $this->fields[$offset]->getConfig();
    }
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
    $this->offsetSet($offset, NULL);
  }

  /**
   * {@inheritdoc}
   */
  public function getIterator() {
    $list = array();
    foreach ($this->fields as $key => $field) {
      $list[$key] = clone($field);
    }
    return new \ArrayIterator($list);
  }
}
