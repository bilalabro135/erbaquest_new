<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Bouncer;
class DefaultRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bouncer::allow('Vendor')->to('editItself');
        Bouncer::allow('Organizer')->to('editItself');
    }
}
