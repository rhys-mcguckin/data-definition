<?php
/**
 * @file
 */
namespace DataDefinition\Data\Value;

use DataDefinition\Data\ValueInterface;

/**
 * Class ArrayValue
 * @package DataDefinition\Data\Value
 */
class ArrayValue implements ValueInterface, \ArrayAccess, \IteratorAggregate {
  /**
   * @var string
   */
  protected $class;

  /**
   * @var callable
   */
  protected $constructor;

  /**
   * @var \DataDefinition\Data\ValueInterface[]
   */
  protected $values = array();

  /**
   * @var array
   */
  protected $config = array();

  /**
   * Construct the array value, providing the class type, and an optional
   * constructor.
   *
   * @param \DataDefinition\Data\ValueInterface $child
   * @param callable $constructor
   *
   * @return self
   */
  public function __construct(ValueInterface $child, $constructor = NULL) {
    $this->class = get_class($child);

    // Establish the class constructor for the array.
    $this->constructor = array($this, 'getNewClass');
    if (is_callable($constructor)) {
      $this->constructor = $constructor;
    }
  }

  /**
   * {@inheritdoc}
   */
  public function getValue() {
    $list = array();
    foreach ($this->values as $key => $value) {
      $list[$key] = $value->getValue();
    }
    return $list;
  }

  /**
   * {@inheritdoc}
   */
  public function setValue($value) {
    if ($this->isValidValue($value)) {
      $this->values = $this->castValue($value);
    }
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function isValidValue($value) {
    if (!is_array($value)) {
      return FALSE;
    }
    $object = $this->getObject();
    foreach ($value as $key => $item) {
      // Already defined value.
      if ($item instanceof ValueInterface) {
        if (!is_a($item, $this->class)) {
          return FALSE;
        }
      }
      // Scalar type value.
      elseif (!$object->isValidValue($item)) {
        return FALSE;
      }
    }
    return TRUE;
  }

  /**
   * {@inheritdoc}
   */
  public function castValue($value) {
    // Cycle through and convert everything to ValueInterface unless it already is.
    foreach ($value as $key => $item) {
      if (!($item instanceof ValueInterface)) {
        $object = $this->getObject();
        $value[$key] = $object->setValue($item);
      }
    }
    return $value;
  }

  /**
   * {@inheritdoc}
   */
  public function getConfig() {
    return $this->config;
  }

  /**
   * {@inheritdoc}
   */
  public function setConfig($config) {
    // Establish the correct config from the child object.
    $this->config = $this->getObject()->setConfig($config)->getConfig();

    // Ensure each existing value has the same config, and is valid against this config.
    foreach ($this->values as $key => &$value) {
      $value->setConfig($this->config);

      // Remove any value which is invalidated by the new config.
      if (!$value->isValidValue($value->getValue())) {
        unset($this->values[$key]);
      }
    }
    return $this;
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
    // TODO: Safety checks for cardinality restrictions.

    // Check if it is a valid ValueInterface.
    if ($value instanceof ValueInterface) {
      if (is_a($value, $this->class)) {
        $this->values[$offset] = $value;
      }
      return;
    }

    // Convert to the appropriate class.
    $object = $this->getObject();
    if ($object->isValidValue($value)) {
      $this->values[$offset] = $object->setValue($value);
    }
  }

  /**
   * {@inheritdoc}
   */
  public function offsetUnset($offset) {
    // TODO: Safety checks for cardinality restrictions
    unset($this->values[$offset]);
  }

  /**
   * {@inheritdoc}
   */
  public function getIterator() {
    return new \ArrayIterator($this->values);
  }

  /**
   * Create a new instance of the class.
   *
   * @return \DataDefinition\Data\ValueInterface
   */
  protected function getNewClass() {
    return new $this->class();
  }

  /**
   * Get an instance of the class.
   *
   * @return \DataDefinition\Data\ValueInterface
   */
  protected function getObject() {
    $object = call_user_func($this->constructor);

    // Default to standard behaviour of the constructor returns an invalid type.
    if (!is_a($object, $this->class)) {
      $object = $this->getNewClass();
    }
    return $object->setConfig($this->config);
  }
}
