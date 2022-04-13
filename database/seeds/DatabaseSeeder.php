<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(RoleHasPermissionsTableSeeder::class);
        $this->call(ModelHasRolesTableSeeder::class);
        // $this->call(UsersTableSeeder::class);
        $this->call(TeamsTableSeeder::class);
        $this->call(SprintCalendarsTableSeeder::class);
        $this->call(ProductNamesTableSeeder::class);
        $this->call(ReleaseNumbersTableSeeder::class);
        $this->call(ReleaseMilestonesTableSeeder::class);
        $this->call(IntellicusVersionsTableSeeder::class);
        $this->call(AmbariDetailsTableSeeder::class);
        $this->call(DbaDetailsTableSeeder::class);
    }
}
