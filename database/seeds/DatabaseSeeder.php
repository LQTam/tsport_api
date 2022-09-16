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
        $this->call(RolesTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(UserDetailsTableSeeder::class);
        $this->call(SuppliersTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(ColorsTableSeeder::class);
        $this->call(ColorProductsTableSeeder::class);
        $this->call(ColorProductPicturesTableSeeder::class);
        $this->call(ColorSizesTableSeeder::class);
        $this->call(CustomersTableSeeder::class);
        $this->call(EmployeesTableSeeder::class);
        $this->call(FailedJobsTableSeeder::class);
        $this->call(JobsTableSeeder::class);
        $this->call(ModelHasPermissionsTableSeeder::class);
        $this->call(ModelHasRolesTableSeeder::class);
        $this->call(NotificationsTableSeeder::class);
        $this->call(OrdersTableSeeder::class);
        $this->call(OrderDetailsTableSeeder::class);
        $this->call(PasswordResetsTableSeeder::class);
        $this->call(PaymentsTableSeeder::class);
        $this->call(SubCategoriesTableSeeder::class);
        $this->call(ProductCategoryTableSeeder::class);
        $this->call(ProductColorSizeQuantityTableSeeder::class);
        $this->call(ProductDetailsTableSeeder::class);
        $this->call(ProductSizeTableSeeder::class);
        $this->call(RoleHasPermissionsTableSeeder::class);
        $this->call(ShippingsTableSeeder::class);
        $this->call(SizesTableSeeder::class);
    }
}
