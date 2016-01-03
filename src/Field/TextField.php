<?php
/**
 * @file
 */
namespace DataDefinition\Data\Field;

use DataDefinition\Data\Value\TextValue;

/**
 * Class TextField
 * @package DataDefinition\Field
 */
class TextField extends AbstractField {
  /**
   * {@inheritdoc}
   */
  public function __construct($name, $config = array(), $structure = NULL, $parent = NULL) {
    parent::__construct($name, $config, $structure, $parent);
    $this->config = (new TextValue())->setConfig($config)->getConfig();
  }

  /**
   * {@inheritdoc}
   */
  public function getValue() {
    return (new TextValue())->setConfig($this->getConfig());
  }
}
