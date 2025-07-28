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
                'name'              => 'Business Website development',
                'description'       => 'Business Website description',
                'price'             => '3000',
                'status'            => 1,
            ],
            [
                'name'              => 'Ecommerce development',
                'description'       => 'Ecommerce development description',
                'price'             => '4000',
                'status'            => 1,
            ],
            [
                'name'              => 'ERP development',
                'description'       => 'ERP development description',
                'price'             => '6000',
                'status'            => 1,
            ],
            [
                'name'              => 'Custom ERP development',
                'description'       => 'Custom ERP development description',
                'price'             => '10000',
                'status'            => 1,
            ],
            [
                'name'              => 'IOT product development',
                'description'       => 'IOT product development description',
                'price'             => '5000',
                'status'            => 1,
            ],
            [
                'name'              => 'SQA and documentation',
                'description'       => 'SQA and documentation description',
                'price'             => '1500',
                'status'            => 1,
            ],
        ];

        Service::insert($services);
    }
}