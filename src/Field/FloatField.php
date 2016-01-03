<?php
/**
 * @file
 */
namespace DataDefinition\Data\Field;

use DataDefinition\Data\Value\FloatValue;

/**
 * Class FloatField
 * @package DataDefinition\Field
 */
class FloatField extends AbstractField {
  /**
   * {@inheritdoc}
   */
  public function __construct($name, $config = array(), $structure = NULL, $parent = NULL) {
    parent::__construct($name, $config, $structure, $parent);
    $this->config = (new FloatValue())->setConfig($config)->getConfig();
  }

  /**
   * {@inheritdoc}
   */
  public function getValue() {
    return (new FloatValue())->setConfig($this->getConfig());
  }
}
