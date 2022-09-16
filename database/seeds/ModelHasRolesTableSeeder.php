<?php


use Illuminate\Database\Seeder;

class ModelHasRolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('model_has_roles')->delete();

        \DB::table('model_has_roles')->insert(array (
            0 =>
            array (
                'role_id' => 1,
                'model_type' => 'App\\Models\\User',
                'model_id' => 1,
            ),
            1 =>
            array (
                'role_id' => 2,
                'model_type' => 'App\\Models\\User',
                'model_id' => 1,
            ),
            2 =>
            array (
                'role_id' => 2,
                'model_type' => 'App\\Models\\User',
                'model_id' => 135,
            ),
            3 =>
            array (
                'role_id' => 3,
                'model_type' => 'App\\Models\\User',
                'model_id' => 141,
            ),
            4 =>
            array (
                'role_id' => 4,
                'model_type' => 'App\\Models\\User',
                'model_id' => 2,
            ),
            5 =>
            array (
                'role_id' => 4,
                'model_type' => 'App\\Models\\User',
                'model_id' => 136,
            ),
            6 =>
            array (
                'role_id' => 5,
                'model_type' => 'App\\Models\\User',
                'model_id' => 1,
            ),
            7 =>
            array (
                'role_id' => 9,
                'model_type' => 'App\\Models\\User',
                'model_id' => 1,
            ),
            8 =>
            array (
                'role_id' => 9,
                'model_type' => 'App\\Models\\User',
                'model_id' => 149,
            ),
            9 =>
            array (
                'role_id' => 10,
                'model_type' => 'App\\Models\\User',
                'model_id' => 1,
            ),
            10 =>
            array (
                'role_id' => 10,
                'model_type' => 'App\\Models\\User',
                'model_id' => 146,
            ),
        ));


    }
}
