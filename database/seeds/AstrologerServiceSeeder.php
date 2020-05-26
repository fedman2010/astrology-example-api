<?php

use Illuminate\Database\Seeder;

class AstrologerServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $astrologers = \App\Astrologer::pluck('id');
        $services = \App\Service::pluck('id');

        foreach ($astrologers as $astrologerId) {
            foreach ($services as $serviceId) {
                if (rand(0, 2) === 2) {
                    continue;
                }

                \App\AstrologerService::create([
                    'astrologer_id' => $astrologerId,
                    'service_id' => $serviceId,
                    'price' => rand(10, 100),
                ]);
            }
        }
    }
}
