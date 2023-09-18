<?php

namespace ContactPerson\Extensions;

use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\FieldList;
use SilverStripe\ORM\DataExtension;
use Team\DataObjects\TeamMember;

class SiteConfigExtension extends DataExtension{
    private static $has_one = [
        'ContactTeamMember' => TeamMember::class,
    ];

    public function updateCMSFields(FieldList $fields)
    {
        parent::updateCMSFields($fields);

        $fields->removeByName([
            'ContactTeamMemberID',
        ]);

        $fields->addFieldsToTab('Root.' . _t('ContactPerson.CONTACTPERSON', 'Ansprechpartner'), [
            DropdownField::create('ContactTeamMemberID', _t('ContactPerson.DEFAULTCONTACTPERSON', 'Standard-Ansprechpartner'), TeamMember::get()->map())
                ->setEmptyString(
                    _t('ContactPerson.SELECTDEFAULTCONTACTPERSON', 'Standard-Ansprechpartner auswählen')
                )
        ]);
    }
}