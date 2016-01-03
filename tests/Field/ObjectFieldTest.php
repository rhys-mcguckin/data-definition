<?php
/**
 * @file
 */
namespace DataDefinition\Tests\Data\Field;

use DataDefinition\Data\Field\ObjectField;
use ReflectionProperty as ReflectionProperty;

/**
 * Class ObjectFieldTest
 * @package DataDefinition\Tests\Data\Field
 */
class ObjectFieldTest extends \PHPUnit_Framework_TestCase {
  public function testInitialize() {
    $field = new ObjectField('test');

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
    $this->assertEquals('DataDefinition\Data\Value\ObjectValue', get_class($value));
  }
}
