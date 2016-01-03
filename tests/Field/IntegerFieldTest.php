<?php
/**
 * @file
 */
namespace DataDefinition\Tests\Data\Field;

use DataDefinition\Data\Field\IntegerField;
use ReflectionProperty as ReflectionProperty;

/**
 * Class IntegerFieldTest
 * @package DataDefinition\Tests\Data\Field
 */
class IntegerFieldTest extends \PHPUnit_Framework_TestCase {
  public function testInitialize() {
    $field = new IntegerField('test');

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
    $this->assertEquals('DataDefinition\Data\Value\IntegerValue', get_class($value));
  }
}
