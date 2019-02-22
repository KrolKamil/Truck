<?php

/*
 * addColumn('source_address','string',
            ['limit' => 128])
            ->addColumn('destination_address', 'string',
                ['limit' => 128])
            ->addColumn('price', 'integer')
            ->addColumn('date', 'datetime')
 */

use Phinx\Seed\AbstractSeed;

class InitSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $data = [
            'source_address' => 'ul. Zakręt 8, Poznań',
            'destination_address' => 'Złota 44, Warszawa',
            'price' => 450,
            'distance' => 20.1,
            "date" => date('2018-03-15')
        ];

        $table = $this->table('transit');
        $table->insert($data)
            ->save();
    }
}
