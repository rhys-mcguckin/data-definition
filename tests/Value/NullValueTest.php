<?php
/**
 * @file
 */
namespace DataDefinition\Tests\Data\Value;

use DataDefinition\Data\Value\NullValue;

/**
 * Class NullValueTest
 * @package DataDefinition\Tests\Data\Value
 */
class NullValueTest extends \PHPUnit_Framework_TestCase {
  /**
   * @var \DataDefinition\Data\Value\NullValue
   */
  protected $field_value;

  /**
   *
   */
  public function setUp() {
    $this->field_value = new NullValue();
  }

  /**
   * Test the validation function.
   */
  public function testValidation() {
    $value = $this->field_value;

    $this->assertFalse($value->isValidValue('true'));
    $this->assertFalse($value->isValidValue('yes'));
    $this->assertFalse($value->isValidValue('false'));
    $this->assertFalse($value->isValidValue('no'));
    $this->assertFalse($value->isValidValue(0));
    $this->assertFalse($value->isValidValue(1));
    $this->assertFalse($value->isValidValue(NULL));
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
      'true' => FALSE,
      'false' => FALSE,
      'yes' => FALSE,
      'no' => FALSE,
      0 => FALSE,
      1 => FALSE,
    );

    // Check the appropriate values are set by setting to the opposite value.
    foreach ($checks as $key => $expected) {
      $this->assertEquals($expected, $value->setValue(!$expected)->setValue($key)->getValue());
    }
  }
}
