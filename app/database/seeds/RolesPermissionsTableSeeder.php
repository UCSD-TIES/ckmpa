<?php

class RolesPermissionsTableSeeder extends Seeder
{

	public function run()
	{
		DB::table('roles')->truncate();
		DB::table('permissions')->truncate();
		DB::table('permission_role')->truncate();

		$admin = Role::create(array('name' => 'Admin'));
		$volunteer = Role::create(array('name' => 'Volunteer'));

		$can_patrol = Permission::create(array('name' => 'can_patrol', 'display_name' => 'Can patrol'));
		$can_manage = Permission::create(array('name' => 'can_manage', 'display_name' => 'Can manage'));

		$admin->perms()->sync(array($can_patrol->id, $can_manage->id));
		$volunteer->perms()->sync(array($can_patrol->id));
	}

}
