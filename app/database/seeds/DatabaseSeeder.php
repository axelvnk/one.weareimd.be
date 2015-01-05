<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

        DB::statement('SET foreign_key_checks = 0');
        DB::statement('SET UNIQUE_CHECKS=0');

		$this->call('TeaserTableSeeder');
        $this->call('UserTableSeeder');
        $this->call('ProjectTableSeeder');
        $this->call('JobTableSeeder');
        $this->call('EventTableSeeder');


        DB::statement('SET foreign_key_checks = 1');
        DB::statement('SET UNIQUE_CHECKS=1');
	}

}


class TeaserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('teasers')->delete();
    }

}


class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();
        User::create(array('firstname' => 'Ive', 'name' =>'De Maeseneer', 'email'=>'ivedm91@gmail.com', 'admin' => 1, 'password' => '$2y$10$GAyR81Z7r7Gjg4ikQ88oTO7bvaKG1DLrq6C2btxHh26bg4yC.9dGW'));
        User::create(array('firstname' => 'Kim', 'name' =>'Janssens', 'email'=>'KimJanssens@gmail.com', 'admin' => 1, 'password' => '$2y$10$GAyR81Z7r7Gjg4ikQ88oTO7bvaKG1DLrq6C2btxHh26bg4yC.9dGW'));
        User::create(array('firstname' => 'Thomas', 'name' =>'De Bock', 'email'=>'ThomasDeBock@gmail.com', 'admin' => 1, 'password' => '$2y$10$GAyR81Z7r7Gjg4ikQ88oTO7bvaKG1DLrq6C2btxHh26bg4yC.9dGW'));
        User::create(array('firstname' => 'Joris', 'name' =>'Hens', 'email'=>'joris.hens@thomasmore.be', 'admin' => 1, 'password' => '$2y$10$NapQwcNwOmPFuR1kC/J5P.F5bGplJtzdA5PybYbJhiZXcv/zRGGMe'));
    }


}

class ProjectTableSeeder extends Seeder {

    public function run()
    {
        DB::table('projects')->delete();
        Project::create(array('name' =>'Logo', 'description'=>'Logo', 'user_id'=>1));
        Project::create(array('name' =>'Project 1', 'description'=>'site project 2', 'user_id'=>2));
        Project::create(array('name' =>'Weather app', 'description'=>'Weer app voor vak photoshop', 'user_id'=>3));
    }


}

class JobTableSeeder extends Seeder {

    public function run()
    {
        DB::table('jobs')->delete();
        Job::create(array('functie' =>'Front-end developer', 'beschrijving'=>'Als Front-end developer eisen we een uitgebreide kennis van HTML5, CSS en javascript', 'adres'=>'Kerkplein 2', 'gemeente'=>'Mechelen','postcode'=>'2800','werkgever'=>'360-Media','email'=>'360@mail.be','telefoon'=>'0497552266'));
        Job::create(array('functie' =>'Drupal expert', 'beschrijving'=>'Als Drupal expert zal je meewerken aan de ontwikkeling van het bedrijfssysteem', 'adres'=>'fosneylaan 41', 'gemeente'=>'Brussel','postcode'=>'1000','werkgever'=>'Smals','email'=>'Hr@smalls.be','telefoon'=>'0495891592'));
        Job::create(array('functie' =>'Grafisch ontwerper', 'beschrijving'=>'Wij zijn op zoek naar een grafisch ontwerper, voor het ontwerp van onze websites.', 'adres'=>'dorpstraat 22', 'gemeente'=>'Brussel','postcode'=>'1000','werkgever'=>'Yools','email'=>'Yools@mail.be','telefoon'=>'0495234578'));
    }


}

class EventTableSeeder extends Seeder {

    public function run()
    {
        DB::table('calendars')->delete();
        Calendar::create(array('name' =>'I-minds workshop','description' =>'workshop over marketing bij startups', 'startdate'=>'2014-11-20 00:00:00','gemeente'=>'Mechelen','postcode'=>'2800','url'=>'http://www.I-minds.be'));
        Calendar::create(array('name' =>'Workshop PHP','description' =>'competitie PHP',  'startdate'=>'2014-11-4 00:00:00','gemeente'=>'Mechelen','postcode'=>'2800','url'=>'http://www.weareimd.be'));
        Calendar::create(array('name' =>'Kerst TD','description' =>'Op 18 september sluiten we het eerste semester af met een KerstTd',  'startdate'=>'2014-12-18 00:00:00','gemeente'=>'Mechelen','postcode'=>'2800','url'=>'http://www.KerstTd.be'));
    }


}
