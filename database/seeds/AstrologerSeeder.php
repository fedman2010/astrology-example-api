<?php

use Illuminate\Database\Seeder;

class AstrologerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Astrologer::class, 6)->create();
    }
}
