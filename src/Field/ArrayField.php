<?php
/**
 * @file
 */
namespace DataDefinition\Data\Field;

use DataDefinition\Data\FieldInterface;
use DataDefinition\Data\Value\ArrayValue;

/**
 * Class ArrayField
 * @package DataDefinition\Data\Field
 */
class ArrayField extends AbstractField {
  /**
   * @var \DataDefinition\Data\FieldInterface
   */
  protected $field;

  /**
   * @var callable
   */
  protected $constructor = NULL;

  /**
   * {@inheritdoc}
   */
  public function __construct($name, $config = array(), $structure = NULL, $parent = NULL) {
    parent::__construct($name, $config, $structure, $parent);

    // Ensure the field instance exists.
    if (empty($config['field_instance']) || !($config['field_instance'] instanceof FieldInterface)) {
      throw new \InvalidArgumentException();
    }
    $this->field = $config['field_instance'];

    // Allow for a constructor.
    if (!empty($config['field_constructor']) && is_callable($config['field_constructor'])) {
      $this->constructor = $config['field_constructor'];
    }

    // Now get the sanitized config.
    $this->config = (new ArrayValue($this->field->getValue(), $this->constructor))
      ->setConfig($config)
      ->getConfig();
  }

  /**
   * {@inheritdoc}
   */
  public function getValue() {
    return (new ArrayValue($this->field->getValue(), $this->constructor))
      ->setConfig($this->getConfig());
  }
}
