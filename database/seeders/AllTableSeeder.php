<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;

class AllTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $users = [
            [
                'id' => 1,
                'name' => 'Astudio Dev',
                'email' => 'astudio@admin.com',
                'password' => bcrypt('Astudio@123'),
                'remember_token' => null,
            ],
        ];

        User::insert($users);

        $projects = [
            [
                'name' => 'Project One',
                'status' => 'New',
            ],
            [
                'name' => 'Project Two',
                'status' => 'Active',
            ],

        ];

        Project::insert($projects);

        $attributes = [
            [
                'name' => 'Start Date',
                'type' => 'date',
            ],
            [
                'name' => 'Category',
                'type' => 'select',
            ],
            [
                'name' => 'Description',
                'type' => 'text',
            ],
        ];
        Attribute::insert($attributes);

        $attributes_values = [
            [
                'attribute_id' => 1,
                'project_id' => 1,
                'value' => '2025-06-01',
                'options' => null,
            ],
            [
                'attribute_id' => 2, // Category
                'project_id' => 1, // Project One
                'value' => null, // Select type uses options
                'options' => json_encode(['Web Development', 'Mobile App']), // Select options
            ],
            [
                'attribute_id' => 3,
                'project_id' => 2,
                'value' => 'This is a test project',
                'options' => null,
            ],
            [
                'attribute_id' => 4,
                'project_id' => 2,
                'value' => '50000',
                'options' => null,
            ],
        ];

        AttributeValue::insert($attributes_values);
    }
}
