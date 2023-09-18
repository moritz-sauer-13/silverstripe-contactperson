<?php

namespace ContactPerson\Extensions;

use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\FieldList;
use SilverStripe\ORM\DataExtension;
use SilverStripe\SiteConfig\SiteConfig;
use Team\DataObjects\TeamMember;

class PageExtension extends DataExtension{
    private static $db = [
        'ShowContactPerson' => 'Boolean(1)',
    ];

    private static $has_one = [
        'ContactTeamMember' => TeamMember::class,
    ];
    
    public function updateCMSFields(FieldList $fields)
    {
        parent::updateCMSFields($fields);
        
        $fields->removeByName([
            'ContactTeamMemberID',
            'ShowContactPerson',
        ]);
        
        $fields->addFieldsToTab('Root.' . _t('ContactPerson.CONTACTPERSON', 'Ansprechpartner'), [
            CheckboxField::create('ShowContactPerson', _t('ContactPerson.SHOWCONTACTPERSON', 'Ansprechpartner anzeigen?')),
            DropdownField::create('ContactTeamMemberID', _t('ContactPerson.CONTACTPERSON', 'Ansprechpartner'), TeamMember::get()->map())
                ->setEmptyString(
                    _t('ContactPerson.SELECTCONTACTPERSON', 'Ansprechpartner auswählen')
                )
        ]);
    }

    public function currentContactTeamMember(){
        if($this->owner->ContactTeamMemberID > 0){
            return $this->owner->ContactTeamMember();
        }
        $siteConfig = SiteConfig::current_site_config();
        if($siteConfig->ContactTeamMemberID > 0){
            return $siteConfig->ContactTeamMember();
        }
        return null;
    }

}