<?php
/**
 * Created by jopes
 * Date: 2015-10-27
 * Time: 08:19
 */

namespace view;


class UsersView extends View
{
    // Init values
    /*
    private static $SUBMIT_INPUT_NAME = 'submit';
    private static $USERNAME_INPUT_NAME = 'username';
    private static $PASSWORD_INPUT_NAME = 'password';
    */

    // Constructor
    public function __construct()
    {
        //$this->LoadUsersTemplate();
    }

    // Private methods


    // Public methods

    public function LoadUsersTemplate($users)
    {

        foreach($users as $user)
        {
            $usersArray[] = [
                'userId' => $user->GetUserId(),
                'username' => $user->GetUsername()
            ];
        }

        $this->output .= $this->LoadTemplate('UsersTpl', $usersArray);
    }

} 