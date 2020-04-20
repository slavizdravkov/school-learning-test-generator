<?php

use App\Capability;
use App\Library\Helpers\Constants\CapabilitiesNames;
use App\Role;
use App\Subject;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = factory(User::class)->create();

        $role = factory(Role::class)->create();

        $baseCapabilities = [
            [
                'name' => CapabilitiesNames::CAPABILITY_NAME_EDIT_ADMIN_USERS,
                'label' => 'Edit Admin Users'
            ],
            [
                'name' => CapabilitiesNames::CAPABILITY_NAME_ADMIN_USERS_CHANGE_STATUS,
                'label' => 'Change Admin Users Statuses'
            ],
            [
                'name' => CapabilitiesNames::CAPABILITY_NAME_VIEW_CAPABILITIES,
                'label' => 'View Capabilities'
            ],
            [
                'name' => CapabilitiesNames::CAPABILITY_NAME_ADD_CAPABILITIES,
                'label' => 'Add Capability'
            ],
            [
                'name' => CapabilitiesNames::CAPABILITY_NAME_EDIT_CAPABILITIES,
                'label' => 'Edit Capability'
            ],
            [
                'name' => CapabilitiesNames::CAPABILITY_NAME_DELETE_CAPABILITIES,
                'label' => 'Delete Capability'
            ],
            [
                'name' => CapabilitiesNames::CAPABILITY_NAME_VIEW_ROLES,
                'label' => 'View Roles'
            ],
            [
                'name' => CapabilitiesNames::CAPABILITY_NAME_ADD_ROLES,
                'label' => 'Add Role'
            ],
            [
                'name' => CapabilitiesNames::CAPABILITY_NAME_EDIT_ROLES,
                'label' => 'Edit Role'
            ],
            [
                'name' => CapabilitiesNames::CAPABILITY_NAME_DELETE_ROLES,
                'label' => 'Delete Role'
            ],
            [
                'name' => CapabilitiesNames::CAPABILITY_NAME_VIEW_USERS,
                'label' => 'View Users'
            ],
            [
                'name' => CapabilitiesNames::CAPABILITY_NAME_ADD_USERS,
                'label' => 'Add User'
            ],
            [
                'name' => CapabilitiesNames::CAPABILITY_NAME_EDIT_USERS,
                'label' => 'Edit User'
            ],
            [
                'name' => CapabilitiesNames::CAPABILITY_NAME_CHANGE_USERS_STATUSES,
                'label' => 'Change Users Statuses'
            ],
        ];

        foreach ($baseCapabilities as $baseCapability) {
            $role->capabilities()->sync(factory(Capability::class)->create($baseCapability), false);
        }

        $user->roles()->sync($role, false);
    }
}
