<?php

use Illuminate\Database\Seeder;
use App\RequestType;

class RequestTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['id' => 1, 'name' => 'make'],
            ['id' => 2, 'name' => 'provide'],
        ];

        foreach($items as $item) {
            RequestType::updateOrCreate(
                ['id' => $item['id']], $item
            );
        }
    }
}
