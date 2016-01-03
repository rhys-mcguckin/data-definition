<?php
/**
 * @file
 */
namespace DataDefinition\Tests\Data\Field;

use DataDefinition\Data\Field\ArrayField;
use ReflectionProperty as ReflectionProperty;
use DataDefinition\Data\Field\BooleanField;

/**
 * Class ArrayFieldTest
 * @package DataDefinition\Tests\Data\Field
 */
class ArrayFieldTest extends \PHPUnit_Framework_TestCase {
  /**
   * @var \DataDefinition\Data\Field\BooleanField
   */
  protected $field;

  /**
   * Setup the test requirements.
   */
  public function setUp() {
    $this->field = new BooleanField('example');
  }

  /**
   * Check that no field instance will throw an exception.
   */
  public function testInitializeWithoutFieldInstance() {
    $this->setExpectedException('InvalidArgumentException');
    $field = new ArrayField('test');
  }

  /**
   * Check that an invalid field instance will throw an exception.
   */
  public function testInitializeWithInvalidFieldInstance() {
    $this->setExpectedException('InvalidArgumentException');
    $field = new ArrayField('test', array('field_instance' => 'DataDefinition\Data\Field\BooleanField'));
  }

  /**
   * Check that a valid field instance contains the appropriate values.
   */
  public function testInitializeWithFieldInstance() {
    $field = new ArrayField('test', array('field_instance' => $this->field));

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
    $this->assertEquals('DataDefinition\Data\Value\ArrayValue', get_class($value));
  }

  // TODO: Add test for when restrictions or configuration is put into place.
}
