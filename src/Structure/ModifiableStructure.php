<?php
/**
 * @file
 */
namespace DataDefinition\Data\Structure;

use DataDefinition\Data\Field\NullField;
use DataDefinition\Data\FieldInterface;
use DataDefinition\Data\Version\Patch;
use SharedData\Data\PatchedInterface;

/**
 * Class Patched
 * @package DataDefinition\Data\Structure
 */
class Patched extends GenericStructure implements PatchedInterface {
  /**
   * @var \DataDefinition\Data\Version\Patch[]
   */
  protected $patches = array();

  /**
   * Get the list of patches that have been applied.
   *
   * @return \DataDefinition\Data\Version\Patch[]
   */
  public function getPatches() {
    return $this->patches;
  }

  /**
   * Replace the field.
   *
   * @param \DataDefinition\Data\FieldInterface $field
   *
   * @return void
   */
  protected function replaceField(FieldInterface $field) {
    // Generate the patch object.
    $this->patches[] = new Patch('replace', $field, $this->fields[$field->getName()]);

    // Save field to new location.
    $this->fields[$field->getName()] = $field;
  }

  /**
   * Moves a field from one name to another.
   *
   * @param string $from
   * @param string $to
   *
   * @return void
   */
  protected function renameField($from, $to) {
    // Generate a new field from the old.
    $field = $this->fields[$from];
    $class = get_class($field);
    $field = new $class($to, $field->getConfig(), $field->getStructure(), $field->getParent());

    // Generate the patch object.
    $this->patches[] = new Patch('move', $field, $this->fields[$from]);

    // Save field to new location.
    $this->fields[$to] = $field;
    unset($this->fields[$from]);
  }

  /**
   * Copies a field from one name to another.
   *
   * @param string $from
   * @param string $to
   *
   * @return void
   */
  protected function copyField($from, $to) {
    // Generate a new field from the old.
    $field = $this->fields[$from];
    $class = get_class($field);
    $field = new $class($to, $field->getConfig(), $field->getStructure(), $field->getParent());

    // Generate the patch object.
    $this->patches[] = new Patch('copy', $field, $this->fields[$from]);

    // Save field to new location.
    $this->fields[$to] = $field;
  }

  /**
   * Add
   *
*@param \DataDefinition\Data\FieldInterface $field
   *
   * @return void
   */
  protected function addField(FieldInterface $field) {
    $this->patches[] = new Patch('add', $field, new NullField($field->getName()));
    $this->fields[$field->getName()] = $field;
  }

  /**
   * Delete a field.
   *
   * @param string $name
   *
   * @return void
   */
  protected function deleteField($name) {
    $this->patches[] = new Patch('delete', new NullField($name), $this->fields[$name]);
    unset($this->fields[$name]);
  }

  /**
   * {@inheritdoc}
   */
  public function offsetSet($offset, $value) {
    // A field deletion.
    if (is_null($value)) {
      if (array_key_exists($offset, $this->fields)) {
        $this->deleteField($offset);
      }
      return;
    }

    // A field config change.
    if (is_array($value)) {
      if (array_key_exists($offset, $this->fields)) {
        $field = $this->fields[$offset];
        $class = get_class($field);
        $this->replaceField(new $class($offset, $value + $field->getConfig(), $field->getStructure(), $field->getParent()));
      }
      return;
    }

    // This is a field level change.
    if (!($value instanceof FieldInterface)) {
      return;
    }

    // The offset does not match the fields name.
    if ($offset !== $value->getName()) {
      $class = get_class($value);
      $value = new $class($offset, $value->getConfig(), $value->getStructure(), $value->getParent());
    }

    // Add/Replace
    if (array_key_exists($offset, $this->fields)) {
      $this->replaceField($value);
    }
    else {
      $this->addField($value);
    }
  }
}
