<?php
/**
 * @file
 */
namespace DataDefinition\Tests\Data\Value;

use DataDefinition\Data\Value\IntegerValue;

/**
 * Class IntegerValueTest
 * @package DataDefinition\Tests\Data\Value
 */
class IntegerValueTest extends \PHPUnit_Framework_TestCase {
  /**
   * @var \DataDefinition\Data\Value\IntegerValue
   */
  protected $field_value;

  /**
   *
   */
  public function setUp() {
    $this->field_value = new IntegerValue();
  }

  /**
   * Test the validation function.
   */
  public function testValidation() {
    $value = $this->field_value;

    $this->assertTrue($value->isValidValue('0'));
    $this->assertTrue($value->isValidValue('1'));
    $this->assertTrue($value->isValidValue('2'));
    $this->assertTrue($value->isValidValue(0));
    $this->assertTrue($value->isValidValue(1));
    $this->assertTrue($value->isValidValue(2));

    $this->assertFalse($value->isValidValue('1.1'));
    $this->assertFalse($value->isValidValue(0.1));
    $this->assertFalse($value->isValidValue(NULL));
    $this->assertFalse($value->isValidValue(array()));
    $this->assertFalse($value->isValidValue(new \stdClass));
  }

  /**
   * Test the basic set behaviour of the value.
   */
  public function testSet() {
    $value = $this->field_value;

    $checks = array(
      0 => 0,
      1 => 1,
      2 => 2,
      '0' => 0,
      '1' => 1,
      '2' => 2,
    );

    // Check the appropriate values are set by setting to the opposite value.
    foreach ($checks as $key => $expected) {
      $this->assertSame($expected, $value->setValue(!$expected)->setValue($key)->getValue());
    }
  }

}
