<?php
/**
 * @file
 */
namespace DataDefinition\Tests\Data\Field;

use DataDefinition\Data\Field\StringField;
use ReflectionProperty as ReflectionProperty;

/**
 * Class StringFieldTest
 * @package DataDefinition\Tests\Data\Field
 */
class StringFieldTest extends \PHPUnit_Framework_TestCase {
  public function testInitialize() {
    $field = new StringField('test');

    $nameProperty = new ReflectionProperty($field, 'name');
    $nameProperty->setAccessible(TRUE);

    $configProperty = new ReflectionProperty($field, 'config');
    $configProperty->setAccessible(TRUE);

    // Check the appropriate values are set.
    $this->assertEquals('test', $nameProperty->getValue($field));
    $this->assertEquals('test', $field->getName());
    $this->assertEquals(array(), $configProperty->getValue($field));
    $this->assertEquals(array(), $field->getConfig());

    // Get the appropriate class is returned.
    $value = $field->getValue();
    $this->assertEquals('DataDefinition\Data\Value\StringValue', get_class($value));
  }
}
