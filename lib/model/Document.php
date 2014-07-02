<?php

/**
 * Subclass for representing a row from the 'document' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Document extends BaseDocument
{
    public function getProjectDcoumentByDocument(){
        $projectDocuments = Document::getProjectDocumentsJoinProject();
        foreach ($projectDocuments as $projectDocument){
            return $projectDocument;
        }
    }
}
