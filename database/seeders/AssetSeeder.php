<?php

namespace Database\Seeders;

use App\Containers\Finance\Models\Asset;
use App\Models\User;
use App\Containers\Family\Models\UserFamilyRole;
use Illuminate\Database\Seeder;

class AssetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userRoles = UserFamilyRole::all();
        
        $commonAssets = [
            [
                'name' => 'Primary Residence',
                'type' => 'real_estate',
                'value' => 500000,
            ],
            [
                'name' => 'Vehicle',
                'type' => 'vehicle',
                'value' => 25000,
            ],
            [
                'name' => 'Investment Portfolio',
                'type' => 'investment',
                'value' => 100000,
            ],
            [
                'name' => 'Retirement Account',
                'type' => 'retirement',
                'value' => 200000,
            ],
            [
                'name' => 'Cryptocurrency',
                'type' => 'crypto',
                'value' => 10000,
            ],
        ];

        foreach ($userRoles as $userRole) {
            // Create common assets for each user's family
            foreach ($commonAssets as $asset) {
                Asset::factory()->create([
                    'user_id' => $userRole->user_id,
                    'family_group_id' => $userRole->family_group_id,
                    'name' => $asset['name'],
                    'type' => $asset['type'],
                    'value' => $asset['value'],
                    'purchase_date' => now()->subYears(rand(1, 5)),
                ]);
            }

            // Create additional random assets
            Asset::factory(5)->create([
                'user_id' => $userRole->user_id,
                'family_group_id' => $userRole->family_group_id,
            ]);
        }
    }
} 