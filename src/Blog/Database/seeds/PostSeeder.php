<?php


use Phinx\Seed\AbstractSeed;

class PostSeeder extends AbstractSeed
{

    public function run()
    {
        $data = [];
        $faker = \Faker\Factory::create("fr_FR");
        for ($i = 1; $i < 101; $i++) {
            $date = $faker->unixTime('now');
            $data [] = [
                'name' => $faker->catchPhrase,
                'slug' => $faker->slug,
                'content' => $faker->text(3000),
                'created_at' => date('Y-m-d H:i:s', $date),
                'updated_at' => date('Y-m-d H:i:s', $date),
            ];
        }
        $this->table('posts')
            ->insert($data)
            ->save();
    }
}
