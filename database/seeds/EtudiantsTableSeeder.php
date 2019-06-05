<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;


class EtudiantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */


    public function run(Faker $faker)
    {

		$auditoires = DB::table('auditoires')->get();
		foreach ($auditoires as $auditoire) {
			$nbr = random_int(25, 50);
			for ($i=0; $i < $nbr ; $i++) {
				DB::table('etudiants')->insert([
					'matricule' => $this->getUniqueMatricule(),
			        'nom'	=> $faker->lastName(),
			        'postnom' => $faker->lastName(),
			        'prenom' => $faker->firstName(),
			        'idauditoires' => $auditoire->idauditoires,
			       
				
				]);
			}

		}     
    }
    public function getUniqueMatricule(){
		$matricule = random_int(20150000, 20180000);
		if(DB::table('etudiants')->where('matricule',$matricule)->first()){
			return $this->getUniqueMatricule();
		}
		return $matricule;
	}
}
