<?php
/**
 * @file
 */
namespace DataDefinition\Data\Field;

use DataDefinition\Data\Value\IntegerValue;

/**
 * Class IntegerField
 * @package DataDefinition\Field
 */
class IntegerField extends AbstractField {
  /**
   * {@inheritdoc}
   */
  public function __construct($name, $config = array(), $structure = NULL, $parent = NULL) {
    parent::__construct($name, $config, $structure, $parent);
    $this->config = (new IntegerValue())->setConfig($config)->getConfig();
  }

  /**
   * {@inheritdoc}
   */
  public function getValue() {
    return (new IntegerValue())->setConfig($this->getConfig());
  }
}
