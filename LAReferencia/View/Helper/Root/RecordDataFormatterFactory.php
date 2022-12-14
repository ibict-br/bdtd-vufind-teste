<?php
 
 namespace LAReferencia\View\Helper\Root;
 
 use VuFind\View\Helper\Root\RecordDataFormatter\SpecBuilder;
 
 class RecordDataFormatterFactory extends \VuFind\View\Helper\Root\RecordDataFormatterFactory
 {
     public function getDefaultCoreSpecs()
     {
    
        $spec = new SpecBuilder();

        //Autores principales
        $spec->setTemplateLine(
            'Main Authors', 'getDeduplicatedAuthors', 'data-authors.phtml',
            [
                'useCache' => true,
                'labelFunction' => function ($data) {
                    return count($data['primary']) > 1
                        ? 'Main Authors' : 'Main Author';
                },
                'context' => [
                    'type' => 'primary',
                    'schemaLabel' => 'author',
                    'requiredDataFields' => [
                        ['name' => 'profile', 'prefix' => '']
                    ]
                ]
            ]
        );

        //Otros autores
        $spec->setTemplateLine(
            'Other Authors', 'getDeduplicatedAuthors', 'data-authors.phtml',
            [
                'useCache' => true,
                'context' => [
                    'type' => 'secondary',
                    'schemaLabel' => 'contributor',
                    'requiredDataFields' => [
                        ['name' => 'role', 'prefix' => 'CreatorRoles::']
                    ]
                ],
            ]
        );

         //Autores corporativos
         $spec->setTemplateLine(
            'Corporate Authors', 'getDeduplicatedAuthors', 'data-authors.phtml',
            [
                'useCache' => true,
                'labelFunction' => function ($data) {
                    return count($data['corporate']) > 1
                        ? 'Corporate Authors' : 'Corporate Author';
                },
                'context' => [
                    'type' => 'corporate',
                    'schemaLabel' => 'creator',
                    'requiredDataFields' => [
                        ['name' => 'role', 'prefix' => 'CreatorRoles::']
                    ]
                ]
            ]
        );
  
        //Colaboradores
        $spec->setTemplateLine(
            'Advisors', 'getContributors', 'data-authors.phtml',
            [
                'useCache' => true,
                'labelFunction' => function ($data) {
                    return 'Advisor';
                },
                'context' => [
                    'type' => 'advisor',
                    'schemaLabel' => 'contributor',
                    'requiredDataFields' => [
                        ['name' => 'profile', 'prefix' => '']
                    ]
                ]
            ]
        );
  
        $spec->setTemplateLine(
            'Co-advisors', 'getContributors', 'data-authors.phtml',
            [
                'useCache' => true,
                'labelFunction' => function ($data) {
                    return 'Co-advisor';
                },
                'context' => [
                    'type' => 'coadvisor',
                    'schemaLabel' => 'contributor',
                    'requiredDataFields' => [
                        ['name' => 'profile', 'prefix' => '']
                    ]
                ]
            ]
        );
  
        $spec->setTemplateLine(
            'Referees', 'getContributors', 'data-authors.phtml',
            [
                'useCache' => true,
                'labelFunction' => function ($data) {
                    return 'Referee';
                },
                'context' => [
                    'type' => 'referee',
                    'schemaLabel' => 'contributor',
                    'requiredDataFields' => [
                        ['name' => 'profile', 'prefix' => '']
                    ]
                ]
            ]
        );

        //Tipo
        $spec->setLine(
            'Format', 'getFormats', 'RecordHelper',
            ['helperMethod' => 'getFormatList']
        );

        //Estado (FALTA)
        $spec->setLine('Status', 'getStatus');

        //A??o de publicaci??n
        $spec->setLine('Publication Date', 'getPublicationDates');
  
        //Pa??s (FALTA)
        $spec->setLine('Country', 'getCountry');

        //Instituci??n (FALTA)
        $spec->setLine('Institution', 'getInstitution');

        //Repositorio (FALTA)
        $spec->setLine('Repository', 'getRepository');

        //Descripci??n (FALTA)

        //Idioma
        $spec->setLine('Language', 'getLanguages');

        //OAI Identifier (FALTA)
        $spec->setLine('OAI Identifier', 'getIdentifierOAI');

        //Enlace del recurso
        $spec->setTemplateLine('Online Access', true, 'data-onlineAccess.phtml');

        //Nivel de acceso
        $spec->setLine(
            'Access Level', 'getAccessLevel');

        //Publicado en
        $spec->setTemplateLine(
            'Published in', 'getContainerTitle', 'data-containerTitle.phtml'
        );

        //Nuevo t??tulo
        $spec->setLine(
            'New Title', 'getNewerTitles', null, ['recordLink' => 'title']
        );
  
        //T??tulo previo
        $spec->setLine(
            'Previous Title', 'getPreviousTitles', null, ['recordLink' => 'title']
        );     
        
        //Editorial
        $spec->setTemplateLine(
            'Published', 'getRootPublishers', 'data-publicationDetails.phtml'
        );
  
        //Programa
        $spec->setTemplateLine(
            'Program', 'getProgramPublishers', 'data-publicationDetails.phtml'
        );
  
        //Departamento
        $spec->setTemplateLine(
            'Department', 'getDepartmentPublishers', 'data-publicationDetails.phtml'
        );
  
        //Edici??n
        $spec->setLine(
            'Edition', 'getEdition', null,
            ['prefix' => '<span property="bookEdition">', 'suffix' => '</span>']
        );

        //Serie
        $spec->setTemplateLine('Series', 'getSeries', 'data-series.phtml');
  
        //Subjects 
        $spec->setTemplateLine(
            'Portuguese Subjects', 'getPorSubjects', 'data-allSubjectHeadings.phtml'
        );
  
        $spec->setTemplateLine(
            'English Subjects', 'getEngSubjects', 'data-allSubjectHeadings.phtml'
        );
  
        $spec->setTemplateLine(
            'Spanish Subjects', 'getSpaSubjects', 'data-allSubjectHeadings.phtml'
        );
  
        $spec->setTemplateLine(
            'CNPQ Subjects', 'getCNPQSubjects', 'data-allSubjectHeadings.phtml'
        );
  
        //Hijos
        $spec->setTemplateLine(
            'child_records', 'getChildRecordCount', 'data-childRecords.phtml',
            ['allowZero' => false]
        );
        
        //??tems relacionados
        $spec->setTemplateLine(
            'Related Items', 'getAllRecordLinks', 'data-allRecordLinks.phtml'
        );

        //Tags
        $spec->setTemplateLine('Tags', true, 'data-tags.phtml');

        //Keywords
        $spec->setLine('Keywords', 'getKeywords');

        return $spec->getArray();
     }
 }
