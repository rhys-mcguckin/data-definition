<?php
/**
 * @file
 */
namespace DataDefinition\Tests\Data\Value;

use DataDefinition\Data\Value\BooleanValue;

/**
 * Class BooleanValueTest
 * @package DataDefinition\Tests\Data\Value
 */
class BooleanValueTest extends \PHPUnit_Framework_TestCase {
  /**
   * @var \DataDefinition\Data\Value\BooleanValue
   */
  protected $field_value;

  /**
   *
   */
  public function setUp() {
    $this->field_value = new BooleanValue();
  }

  /**
   * Test the validation function.
   */
  public function testValidation() {
    $value = $this->field_value;

    $this->assertTrue($value->isValidValue('true'));
    $this->assertTrue($value->isValidValue('yes'));
    $this->assertTrue($value->isValidValue('false'));
    $this->assertTrue($value->isValidValue('no'));
    $this->assertTrue($value->isValidValue(0));
    $this->assertTrue($value->isValidValue(1));
    $this->assertTrue($value->isValidValue(NULL));

    $this->assertFalse($value->isValidValue(2));
    $this->assertFalse($value->isValidValue('2'));
    $this->assertFalse($value->isValidValue(array()));
    $this->assertFalse($value->isValidValue(new \stdClass));
  }

  /**
   * Test the basic set behaviour of the value.
   */
  public function testSet() {
    $value = $this->field_value;

    $checks = array(
      'true' => TRUE,
      'false' => FALSE,
      'yes' => TRUE,
      'no' => FALSE,
      0 => FALSE,
      1 => TRUE,
    );

    // Check the appropriate values are set by setting to the opposite value.
    foreach ($checks as $key => $expected) {
      $this->assertEquals($expected, $value->setValue(!$expected)->setValue($key)->getValue());
    }

    // Independently check that setting value to NULL changes the value accordingly.
    $this->assertFalse($value->setValue(TRUE)->setValue(NULL)->getValue());
  }
}