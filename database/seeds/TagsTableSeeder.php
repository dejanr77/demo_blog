<?php

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = \App\User::find(1);

        $admin->tags()->create([
            'name' => 'demo',
            'ip_address' => '127.0.0.1'
        ]);

    }
}
