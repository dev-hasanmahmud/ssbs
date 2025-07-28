<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{
    public function run()
    {
        $services = [
            [
                'name'              => 'Web development',
                'description'       => 'Web development description',
                'price'             => '3000',
                'status'            => 1,
            ],
            [
                'name'              => 'Mobile app development',
                'description'       => 'Mobile app development description',
                'price'             => '2000',
                'status'            => 1,
            ],
            [
                'name'              => 'SQA and documentation',
                'description'       => 'SQA and documentation description',
                'price'             => '1000',
                'status'            => 1,
            ],
        ];

        Service::insert($services);
    }
}