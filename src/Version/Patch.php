<?php
/**
 * @file
 */
namespace DataDefinition\Data\Version;

use DataDefinition\Data\FieldInterface;
use DataDefinition\Data\ObjectInterface;
use DataDefinition\Data\StructureInterface;

/**
 * Class Patch
 * @package DataDefinition\Data\Version
 */
class Patch {
  /**
   * @var string
   */
  protected $type;

  /**
   * @var \DataDefinition\Data\FieldInterface
   */
  protected $field;

  /**
   * @var \DataDefinition\Data\FieldInterface
   */
  protected $original;

  /**
   * Construct the patch.
   *
   * @param $change
   *
   * @param \DataDefinition\Data\FieldInterface $field
   *
   * @param \DataDefinition\Data\FieldInterface $original
   *   Although optional for all types of change except copy and move, this
   *   should be specified so a reversible series of patches can also be applied.
   *
   * @return self
   */
  public function __construct($change, FieldInterface $field, FieldInterface $original = NULL) {
    // Validate the type of change.
    if (!in_array($change, array('add', 'remove', 'replace', 'copy', 'move'))) {
      throw new \InvalidArgumentException();
    }

    // There must always be an original when performing a copy or move.
    if (in_array($change, array('copy', 'move')) && !$original) {
      throw new \InvalidArgumentException();
    }

    $this->type = $change;
    $this->field = $field;
    $this->original = $original;
  }

  /**
   * @return \DataDefinition\Data\FieldInterface
   */
  public function getField() {
    return $this->field;
  }

  /**
   * @return \DataDefinition\Data\FieldInterface
   */
  public function getOriginalField() {
    return $this->original;
  }

  /**
   * Get the change type.
   *
   * @return string
   *   Returns one of 'add', 'remove', 'replace', 'copy', or 'move'.
   */
  public function getChange() {
    return $this->type;
  }

  /**
   * Apply this patch to the structure.
   *
   * @param \DataDefinition\Data\StructureInterface $structure
   *
   * @return \DataDefinition\Data\StructureInterface
   */
  public function applyStructure(StructureInterface $structure) {
    // Get information critical to patching.
    $name = $this->field->getName();
    $fields = $structure->getFields();

    // Apply the patching.
    switch ($this->type) {
      case 'add':
        if (!array_key_exists($name, $fields)) {
          $fields[$name] = clone($this->field);
        }
        break;

      case 'remove':
        if (array_key_exists($name, $fields)) {
          unset($fields[$name]);
        }
        break;

      case 'replace':
        if (array_key_exists($name, $fields)) {
          $fields[$name] = clone($this->field);
        }
        break;

      case 'copy':
        $original = $this->original->getName();
        if (array_key_exists($original, $fields) && !array_key_exists($name, $fields)) {
          $fields[$name] = clone($fields[$original]);
        }
        break;

      case 'move':
        $original = $this->original->getName();
        if (array_key_exists($original, $fields) && !array_key_exists($name, $fields)) {
          $fields[$name] = clone($fields[$original]);
          unset($fields[$original]);
        }
        break;
    }

    // Generate a new structure that includes the changes to the fields.
    $class = get_class($structure);
    return new $class($structure->getName(), $fields, $structure->getVersion(), $structure->getOptions());
  }

  /**
   * Apply this patch to an object.
   *
   * @param \DataDefinition\Data\ObjectInterface $object
   *
   * @return \DataDefinition\Data\ObjectInterface
   */
  public function applyObject(ObjectInterface $object) {
    // Get the newly modified structure.
    $structure = $this->applyStructure($object->getStructure());

    // Get the original values from the object.
    $values = array();
    foreach ($object as $key => $value) {
      $values[$key] = $value->getValue();
    }

    // Get the name and the default value for the field.
    $name = $this->field->getName();
    $value = $this->field->getValue()->getValue();

    // Apply the patching.
    switch ($this->type) {
      case 'add':
        if (!array_key_exists($name, $values)) {
          $values[$name] = $value;
        }
        break;

      case 'remove':
        if (array_key_exists($name, $values)) {
          unset($values[$name]);
        }
        break;

      case 'replace':
        if (array_key_exists($name, $values)) {
          $values[$name] = $value;
        }
        break;

      case 'copy':
        $original = $this->original->getName();
        if (array_key_exists($original, $values) && !array_key_exists($name, $values)) {
          $values[$name] = $values[$original];
        }
        break;

      case 'move':
        $original = $this->original->getName();
        if (array_key_exists($original, $values) && !array_key_exists($name, $values)) {
          $values[$name] = $values[$original];
          unset($values[$original]);
        }
        break;
    }

    // Create a new object.
    $class = get_class($object);
    $patched = new $class($structure, $object->getIdentifier(), $object->getOptions());

    // Apply new values to the patched object.
    foreach ($values as $key => $value) {
      $patched[$key] = $value;
    }

    // Return the newly patched object.
    return $patched;
  }
}
