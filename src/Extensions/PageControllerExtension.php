<?php

namespace ContactPerson\Extensions;

use SilverStripe\Core\Convert;
use SilverStripe\Dev\Debug;
use SilverStripe\ORM\DataExtension;
use Team\DataObjects\TeamMember;

class PageControllerExtension extends DataExtension{
    private static $allowed_actions = [
        'getAutoCompleteTeamMembers' => true,
        'getTeamMemberData' => true
    ];

    public function getAutoCompleteTeamMembers()
    {
        if(array_key_exists("value",$_GET))
        {
            $value = Convert::raw2sql($_GET["value"]);
            $members = TeamMember::get()->filter(["Title:PartialMatch" => $value]);
            $html = $this->owner->customise(["Members" => $members])->renderWith("AutoCompleteContactPersons");
            return $html;
        }
        return "";
    }

    public function getTeamMemberData()
    {
        if(array_key_exists("id",$_GET))
        {
            $id = Convert::raw2sql($_GET["id"]);
            $member = TeamMember::get_by_id($id);
            $html = $this->owner->customise(["Member" => $member])->renderWith("ContactPersonAjax");
            $image = $member->Image()->FocusFill(80,80)->Link();
            $data = [
                "html"  =>  $html->RAW(),
                "imageurl"  =>  $image,
                "alt" => $member->Image()->AltText ? $member->Image()->AltText : $member->Title
            ];
            return json_encode($data);
        }
        return json_encode(["response" =>  false]);
    }
}