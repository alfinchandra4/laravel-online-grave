<?php

use Illuminate\Database\Seeder;

use App\Package;
use App\PackageDetail;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminTableSeeder::class);
        $this->call(UserTableSeeder::class);
        factory(Package::class, 4)->create();
        factory(PackageDetail::class, 10)->create();
        $this->call(SectorTableSeeder::class);
    }
}
