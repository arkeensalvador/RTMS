<?php
/*
 * Copyright 2014 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not
 * use this file except in compliance with the License. You may obtain a copy of
 * the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations under
 * the License.
 */

namespace Google\Service\BinaryAuthorization;

class ValidateAttestationOccurrenceRequest extends \Google\Model
{
  protected $attestationType = AttestationOccurrence::class;
  protected $attestationDataType = '';
  /**
   * @var string
   */
  public $occurrenceNote;
  /**
   * @var string
   */
  public $occurrenceResourceUri;

  /**
   * @param AttestationOccurrence
   */
  public function setAttestation(AttestationOccurrence $attestation)
  {
    $this->attestation = $attestation;
  }
  /**
   * @return AttestationOccurrence
   */
  public function getAttestation()
  {
    return $this->attestation;
  }
  /**
   * @param string
   */
  public function setOccurrenceNote($occurrenceNote)
  {
    $this->occurrenceNote = $occurrenceNote;
  }
  /**
   * @return string
   */
  public function getOccurrenceNote()
  {
    return $this->occurrenceNote;
  }
  /**
   * @param string
   */
  public function setOccurrenceResourceUri($occurrenceResourceUri)
  {
    $this->occurrenceResourceUri = $occurrenceResourceUri;
  }
  /**
   * @return string
   */
  public function getOccurrenceResourceUri()
  {
    return $this->occurrenceResourceUri;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(ValidateAttestationOccurrenceRequest::class, 'Google_Service_BinaryAuthorization_ValidateAttestationOccurrenceRequest');
