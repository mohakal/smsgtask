<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $query = "INSERT INTO users (id, name, email, email_verified_at, password, remember_token, created_at, updated_at)
            VALUES
            (13, 'admin', 'admin@gmail.com', NULL, '', NULL, '2023-05-22 14:00:26', '2023-05-22 14:00:26'),
            (14, 'basic', 'basic@gmail.com', NULL, '', NULL, '2023-05-22 14:01:38', '2023-05-22 14:01:38'),
            (15, 'premium', 'premium@gmail.com', NULL, '', NULL, '2023-05-22 14:02:27', '2023-05-22 14:02:27')";
        DB::statement($query);

        DB::statement("insert  into user_types(id,name,created_at,updated_at) values
(1,'admin',NULL,NULL),
(2,'subscriber',NULL,NULL)");
        DB::statement("insert  into subscription_types(id,name,created_at,updated_at) values
(1,'basic',NULL,NULL),
(2,'premium',NULL,NULL)");
        DB::statement("insert  into user_types_users(id,user_id,user_type_id,created_at,updated_at) values
(1,13,1,NULL,NULL),
(2,14,2,NULL,NULL),
(3,15,2,NULL,NULL)");
        DB::statement("insert  into user_subscriptions(id,subsciption_type_id,user_types_user_id,created_at,updated_at) values
(1,1,2,NULL,NULL),
(2,2,3,NULL,NULL)");
        DB::statement("insert  into tags(id,name,created_at,updated_at) values
(1,'Action','2023-05-22 14:04:57','2023-05-22 14:04:57'),
(2,'Adventure','2023-05-22 14:04:57','2023-05-22 14:04:57'),
(3,'Comedy','2023-05-22 14:04:57','2023-05-22 14:04:57')");
        DB::statement("insert  into movies(id,title,release_year,poster_link,subsciption_type_id,rent_period,rent_price,license_start,license_end,created_at,updated_at) values
(1,'Test','Test','Test',2,30,10,NULL,NULL,NULL,NULL),
(2,'Guardians of the Galaxy Vol. 2','2017','https://m.media-amazon.com/images/M/MV5BNjM0NTc0NzItM2FlYS00YzEwLWE0YmUtNTA2ZWIzODc2OTgxXkEyXkFqcGdeQXVyNTgwNzIyNzg@._V1_SX300.jpg',1,10,10,'2023-05-01 00:00:00','2023-05-31 00:00:00','2023-05-22 14:04:57','2023-05-22 14:05:36'),
(3,'Guardians of the Galaxy Vol. 2','2017','https://m.media-amazon.com/images/M/MV5BNjM0NTc0NzItM2FlYS00YzEwLWE0YmUtNTA2ZWIzODc2OTgxXkEyXkFqcGdeQXVyNTgwNzIyNzg@._V1_SX300.jpg',2,10,10,'2023-05-08 00:00:00','2023-05-31 00:00:00','2023-05-22 14:05:30','2023-05-22 14:05:30')");
        DB::statement("insert  into movie_tags(id,movie_id,tag_id,created_at,updated_at) values
(1,2,1,'2023-05-22 14:04:57','2023-05-22 14:04:57'),
(2,2,2,'2023-05-22 14:04:57','2023-05-22 14:04:57'),
(3,2,3,'2023-05-22 14:04:57','2023-05-22 14:04:57'),
(4,3,1,'2023-05-22 14:05:30','2023-05-22 14:05:30'),
(5,3,2,'2023-05-22 14:05:30','2023-05-22 14:05:30'),
(6,3,3,'2023-05-22 14:05:30','2023-05-22 14:05:30')");
        DB::statement("insert  into casts(id,name,created_at,updated_at) values
(1,'Chris Pratt','2023-05-22 14:04:57','2023-05-22 14:04:57'),
(2,'Zoe Saldana','2023-05-22 14:04:57','2023-05-22 14:04:57'),
(3,'Dave Bautista','2023-05-22 14:04:57','2023-05-22 14:04:57')");
        DB::statement("insert  into movie_casts(id,movie_id,cast_id,created_at,updated_at) values
(1,2,1,'2023-05-22 14:04:57','2023-05-22 14:04:57'),
(2,2,3,'2023-05-22 14:04:57','2023-05-22 14:04:57'),
(3,2,2,'2023-05-22 14:04:57','2023-05-22 14:04:57'),
(4,3,1,'2023-05-22 14:05:30','2023-05-22 14:05:30'),
(5,3,3,'2023-05-22 14:05:30','2023-05-22 14:05:30'),
(6,3,2,'2023-05-22 14:05:30','2023-05-22 14:05:30')");

    }
}
