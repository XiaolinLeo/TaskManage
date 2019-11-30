<?php

use Illuminate\Database\Seeder;

use App\Step;

class StepsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('steps')->truncate();
        factory(Step::class, 20)->create();
    }
}
