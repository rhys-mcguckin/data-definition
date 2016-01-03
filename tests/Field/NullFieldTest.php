<?php
/**
 * @file
 */
namespace DataDefinition\Tests\Data\Field;

use DataDefinition\Data\Field\NullField;
use ReflectionProperty as ReflectionProperty;

/**
 * Class NullFieldTest
 * @package DataDefinition\Tests\Data\Field
 */
class NullFieldTest extends \PHPUnit_Framework_TestCase {
  public function testInitialize() {
    $field = new NullField('test');

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
    $this->assertNull($value);
  }
}
