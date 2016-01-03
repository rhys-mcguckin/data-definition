<?php
/**
 * @file
 */
namespace DataDefinition\Data\Field;

use DataDefinition\Data\FieldInterface;

/**
 * Class AbstractField
 * @package DataDefinition\Data\Field
 */
abstract class AbstractField implements FieldInterface {
  /**
   * @var string
   */
  protected $name;

  /**
   * @var array
   */
  protected $config = array();

  /**
   * {@inheritdoc}
   */
  public function __construct($name, $config = array()) {
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
  public function getConfig() {
    return $this->config;
  }

  /**
   * {@inheritdoc}
   */
  abstract public function getValue();
}
