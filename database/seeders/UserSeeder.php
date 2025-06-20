<?php

namespace Database\Seeders;

use App\Models\User;
use App\Containers\Family\Models\FamilyGroup;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user and their family group
        $adminUser = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ]);

        $adminFamily = FamilyGroup::create([
            'family_name' => 'Admin Family',
            'created_date' => now(),
        ]);

        // Create owner role for admin
        $adminUser->familyRoles()->create([
            'family_group_id' => $adminFamily->id,
            'role' => 'owner',
        ]);

        // Create regular users with their family groups
        User::factory(9)->create()->each(function ($user) {
            $familyGroup = FamilyGroup::create([
                'family_name' => $user->name . "'s Family",
                'created_date' => now(),
            ]);

            // Create owner role for user
            $user->familyRoles()->create([
                'family_group_id' => $familyGroup->id,
                'role' => 'owner',
            ]);
        });
    }
} 