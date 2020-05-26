<?php

use App\Astrologer;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    protected $tables = [
        'astrologers',
        'services',
        'astrologer_service',
    ];
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->cleanDatabase();
        $this->call(AstrologerSeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(AstrologerServiceSeeder::class);
    }

    protected function cleanDatabase()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        foreach ($this->tables as $table) {
            DB::table($table)->truncate();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
