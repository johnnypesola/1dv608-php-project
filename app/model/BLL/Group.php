<?php
/**
 * Created by jopes
 * Date: 2015-10-25
 * Time: 13:18
 */

namespace model;


class Group extends ModelBLL
{

// Init variables
    private $groupId;
    private $groupName;
    private $permissionsArray = [];
    private $membersArray = [];

    private static $constraints = [
        'groupId' => ['minValue' => 0, 'allowNull' => true],
        'groupName' => ['maxLength' => 50],
    ];

// Constructor
    public function __construct(
        $groupId = null,
        $groupName
    )
    {
        $this->SetGroupId($groupId);
        $this->SetGroupName($groupName);
    }

// Getters and Setters

    # GroupId
    public function SetGroupId($value) {

        if($this->IsValidInt("groupId", $value, self::$constraints["groupId"]))

            // Set groupId
            $this->groupId = (int) $value;
    }

    public function GetGroupId()
    {
        return $this->groupId;
    }

    # GroupName
    public function SetGroupName($value)
    {
        // Check if groupName is valid
        if ($this->IsValidString("groupName", $value, self::$constraints["groupName"])) {

            // Set groupName
            $this->groupName = trim($value);
        }
    }

    public function GetGroupName()
    {
        return $this->groupName;
    }

// Private Methods

// Public Methods

    # Permissions
    public function AddPermission($permission)
    {
        $this->permissionsArray[] = $permission;
    }

    public function RemovePermission($permission)
    {
        // Find permissions and remove it (if it exists)
        if(($key = array_search($permission, $this->permissionsArray)) !== false) {
            unset($this->permissionsArray[$key]);
        }
    }

    public function HasPermissionsTo($permission)
    {
        // Search for permission
        return (array_search($permission, $this->permissionsArray) !== false);
    }

    # Members
    public function AddMember($member)
    {
        $this->membersArray[] = $member;
    }

    public function RemoveMember($member)
    {
        // Find member and remove it (if it exists)
        if(($key = array_search($member, $this->membersArray)) !== false) {
            unset($this->membersArray[$key]);
        }
    }

    public function HasMember($member)
    {
        // Search for member
        return (array_search($member, $this->membersArray) !== false);
    }
}