<?php
/**
 * @file
 */
namespace DataDefinition\Tests\Data\Value;


use DataDefinition\Data\Value\TextValue;

/**
 * Class TextValueTest
 * @package DataDefinition\Tests\Data\Value
 */
class TextValueTest extends \PHPUnit_Framework_TestCase {
  /**
   * @var \DataDefinition\Data\Value\TextValue
   */
  protected $field_value;

  /**
   *
   */
  public function setUp() {
    $this->field_value = new TextValue();
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

    $this->assertTrue($value->isValidValue(2));
    $this->assertTrue($value->isValidValue('2'));
    $this->assertFalse($value->isValidValue(array()));
    $this->assertFalse($value->isValidValue(new \stdClass));
    $this->assertFalse($value->isValidValue(NULL));
  }

  /**
   * Test the basic set behaviour of the value.
   */
  public function testSet() {
    $value = $this->field_value;

    $checks = array(
      'true' => 'true',
      'false' => 'false',
      'yes' => 'yes',
      'no' => 'no',
      '0' => 0,
      '1' => 1,
    );

    // Check the appropriate values are set by setting to the opposite value.
    foreach ($checks as $expected => $key) {
      $this->assertEquals($expected, $value->setValue(!$expected)->setValue($key)->getValue());
    }

    // Independently check that setting value to NULL changes the value accordingly.
    $this->assertSame('unchanged', $value->setValue('unchanged')->setValue(NULL)->getValue());
  }
}
