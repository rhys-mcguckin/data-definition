<?php
/**
 * @file
 */
namespace DataDefinition\Tests\Data\Object;

use DataDefinition\Data\Field\BooleanField;
use DataDefinition\Data\Field\IntegerField;
use DataDefinition\Data\Object\GenericObject;
use DataDefinition\Data\Structure\GenericStructure;
use ReflectionProperty as ReflectionProperty;

/**
 * Class GenericObjectTest
 * @package DataDefinition\Tests\Data\Object
 */
class GenericObjectTest extends \PHPUnit_Framework_TestCase {
  /**
   * @var \DataDefinition\Data\Structure\GenericStructure
   */
  protected $structure;

  /**
   * @var \DataDefinition\Data\Object\GenericObject
   */
  protected $object;

  /**
   * @var \ReflectionProperty
   */
  protected $property;

  /**
   * Setup test.
   */
  public function setUp() {
    // Create a structure for the object to use for testing purposes.
    $fields[] = new BooleanField('foo');
    $fields[] = new IntegerField('bar');

    $this->structure = new GenericStructure('test', $fields);
    $this->object = new GenericObject($this->structure, 0);
    $this->property = new ReflectionProperty($this->object, 'values');
    $this->property->setAccessible(TRUE);
  }

  /**
   * Test offsetGet().
   */
  public function testOffsetGet() {
    $this->assertEquals($this->object['foo'], FALSE);
    $this->assertEquals($this->object['bar'], '');
  }

  /**
   * Test offsetSet().
   */
  public function testOffsetSet() {
    $this->object['foo'] = TRUE;
    $this->assertTrue($this->property->getValue($this->object)['foo']->getValue());
    $this->object['bar'] = '2';
    $this->assertSame(2, $this->property->getValue($this->object)['bar']->getValue());

  }

  /**
   * Test offsetExists().
   */
  public function testOffsetExists() {
    $this->assertTrue(isset($this->object['foo']));
    $this->assertFalse(isset($this->object['foo.bar']));
  }

  /**
   * Test offsetUnset().
   */
  public function testOffsetUnset() {
    unset($this->object['foo']);
    $this->assertArrayHasKey('foo', $this->property->getValue($this->object));
  }

  /**
   * Test getValue().
   */
  public function testGetValue() {
    $this->property->getValue($this->object)['foo']->setValue(TRUE);
    $this->property->getValue($this->object)['bar']->setValue(2);
    $this->assertEquals(array('foo' => TRUE, 'bar' => 2), $this->object->getValues());
  }

  /**
   * Test clone().
   */
  public function testClone() {
    $object = clone($this->object);
    $this->assertNotSame($this->property->getValue($object)['foo'], $this->property->getValue($this->object)['foo']);
    $this->assertNotSame($this->property->getValue($object)['bar'], $this->property->getValue($this->object)['bar']);
  }
}
