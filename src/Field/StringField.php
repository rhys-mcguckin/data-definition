<?php
/**
 * @file
 */
namespace DataDefinition\Data\Field;

use DataDefinition\Data\Value\StringValue;

/**
 * Class StringField
 * @package DataDefinition\Field
 */
class StringField extends AbstractField {
  /**
   * {@inheritdoc}
   */
  public function __construct($name, $config = array(), $structure = NULL, $parent = NULL) {
    parent::__construct($name, $config, $structure, $parent);
    $this->config = (new StringValue())->setConfig($config)->getConfig();
  }

  /**
   * {@inheritdoc}
   */
  public function getValue() {
    return (new StringValue())->setConfig($this->getConfig());
  }
}
