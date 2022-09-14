<?php

namespace LAReferencia\RecordDriver;

class SolrLAReferencia extends SolrDefault
{

   /**
   * Access Level
   **/
   public function getAccessLevel()
   {
     return $this->getFieldValue('eu_rights_str_mv');
   }

   /**
   * Status
   **/
  public function getStatus()
  {
    $value = null;
    $value = $this->fields["status_str"];
    return $value;
  }

  /**
   * Country
   **/
  public function getCountry()
  {
    return $this->getFieldValue("network_name_str");
  }

  /**
   * Institution
   **/
  public function getInstitution()
  {
    return $this->getFieldValue("instname_str");
  }

  /**
   * Repository   **/
  public function getRepository()
  {
    return $this->getFieldValue("reponame_str");
  }

  /**
   * OAI Identifier
   **/
  public function getIdentifierOAI()
  {
    return $this->getFieldValue("oai_identifier_str");
  }

  /**
   * Keywords
   **/
  public function getKeywords()
  {
    return array_unique($this->getFieldsValues(["topic"]));
  }

  
}

