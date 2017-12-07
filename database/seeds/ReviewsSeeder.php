<?php


use Phinx\Seed\AbstractSeed;

class ReviewsSeeder extends AbstractSeed
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
        $faker = Faker\Factory::create('ru_RU');
        $data = [];
        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                'first_name'    => $faker->firstName,           // 'Maynard'
                'note'          => $faker->realText(),          // "And yet I wish you could manage it?) 'And...
                'likes'         => $faker->randomNumber(1, true),     // '+27113456789'
                'created_at'    => date('Y-m-d H:i:s'),
            ];
        }

        $this->insert('reviews', $data);
    }
}