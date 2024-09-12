<?php

namespace Database\Seeders;

use App\v1\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionsTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $manageUser = new Permission();
        $manageUser->name = 'Manage users';
        $manageUser->slug = 'manage-users';
        $manageUser->save();
        $createTasks = new Permission();
        $createTasks->name = 'Create Tasks';
        $createTasks->slug = 'create-tasks';
        $createTasks->save();
    }
}
