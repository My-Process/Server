<?php

use App\Enums\Models\PermissionEnum;

return [

    /*
    |--------------------------------------------------------------------------
    | Default values ​​for Permissions
    |--------------------------------------------------------------------------
    */

    'permissions' => [
        /*********** Test One ***********/
        [
            'scope' => PermissionEnum::TestOne,
            'name'  => 'Search'
        ],
        [
            'scope' => PermissionEnum::TestOne,
            'name'  => 'View'
        ],
        [
            'scope' => PermissionEnum::TestOne,
            'name'  => 'Report'
        ],
        [
            'scope' => PermissionEnum::TestOne,
            'name'  => 'Report Export'
        ],
        [
            'scope' => PermissionEnum::TestOne,
            'name'  => 'Logs'
        ],
        /*********** Test Two ***********/
        [
            'scope' => PermissionEnum::TestTwo,
            'name'  => 'View'
        ],
        [
            'scope' => PermissionEnum::TestTwo,
            'name'  => 'Download'
        ],
        [
            'scope' => PermissionEnum::TestTwo,
            'name'  => 'Delete'
        ],
        /*********** Test Three ***********/
        [
            'scope' => PermissionEnum::TestThree,
            'name'  => 'View'
        ],
        [
            'scope' => PermissionEnum::TestThree,
            'name'  => 'Create'
        ],
        [
            'scope' => PermissionEnum::TestThree,
            'name'  => 'Questions Settings'
        ],
        [
            'scope' => PermissionEnum::TestThree,
            'name'  => 'Edit'
        ],
        [
            'scope' => PermissionEnum::TestThree,
            'name'  => 'Clone'
        ],
        [
            'scope' => PermissionEnum::TestThree,
            'name'  => 'Delete'
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Default values ​​for Roles
    |--------------------------------------------------------------------------
    */

    'roles' => [
        [
            'name'        => 'Administrator',
            'description' => 'The administrator will be responsible for visualizing the data flow in the system, will have access to the queue and requests panel for bus analysis.'
        ],
        [
            'name'        => 'Customer',
            'description' => 'The customer will have access to all processes linked on their behalf, notifications of updates and informative reports.'
        ],
        [
            'name'        => 'Lawyer',
            'description' => 'The lawyer will be able to see all the processes in which he works, in addition to the personal ones. You will have access to deadlines and informative reports.'
        ],
    ],
];
