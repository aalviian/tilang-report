<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class Postings extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=Faker::create("en_En");
        $jk=["Motor","Mobil"];
        $counter=0;
        for($i=1; $i<=10; $i++){
        	$post = new App\Posting;
        	$post->jenis_kendaraan = $jk[rand(0,1)];
        	$post->plat_nomor = $faker->bothify('? #### ??');
        	$post->pelanggaran = $faker->sentence($nbWords = 6, $variableNbWords = true);
        	$post->lastImage="notfound.png";
        	$post->save();

        	$counter+=1;
        }
        $this->command->info("Berhasil menambahkan ".$counter." pelanggaran");
    }
}
