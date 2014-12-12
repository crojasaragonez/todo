<?php

class TaskTableSeeder extends Seeder {

    public function run()
    {
        DB::table('tasks')->delete();

        $faker = Faker\Factory::create();

        for ($i=0; $i < 20; $i++) {
            Task::create(
                array(
                    'title' => $faker->numerify('Task ##'),
                    'description' => $faker->text,
                    'status' => $faker->randomElement(array ('Open','In Progress','Fixed','Verified'))
                )
            );
        }
    }

}