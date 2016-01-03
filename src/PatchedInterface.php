<?php
/**
 * @file
 */
namespace SharedData\Data;

/**
 * Interface PatchedInterface
 * @package SharedData\Data
 */
interface PatchedInterface {
  /**
   * Get the list of patches that have been applied.
   *
   * @return \DataDefinition\Data\Version\Patch[]
   */
  public function getPatches();
}
