<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\DataType;

class DataTypesTableSeederCustom extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        $dataType = $this->dataType('slug', 'products');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'products',
                'display_name_singular' => 'Produkt',
                'display_name_plural'   => 'Produkty',
                'icon'                  => 'voyager-bag',
                'model_name'            => 'App\Product',
                'policy_name'           => null,
                'controller'            => '\App\Http\Controllers\Voyager\ProductsController',
                'generate_permissions'  => 1,
                'description'           => '',
                'server_side'           => 1,
            ])->save();
        }

        $dataType = $this->dataType('slug', 'orders');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'orders',
                'display_name_singular' => 'Objednávk',
                'display_name_plural'   => 'Objednávky',
                'icon'                  => 'voyager-receipt',
                'model_name'            => 'App\Order',
                'policy_name'           => null,
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
                'server_side'           => 1,
            ])->save();
        }

        $dataType = $this->dataType('slug', 'coupons');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'coupons',
                'display_name_singular' => 'Kupón',
                'display_name_plural'   => 'Kupóny',
                'icon'                  => 'voyager-dollar',
                'model_name'            => 'App\Coupon',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'category');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'category',
                'display_name_singular' => 'Kategoria',
                'display_name_plural'   => 'Kategorie',
                'icon'                  => 'voyager-tag',
                'model_name'            => 'App\Category',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'companies');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'companies',
                'display_name_singular' => 'Company',
                'display_name_plural'   => 'Companies',
                'icon'                  => 'voyager-company',
                'model_name'            => 'App\Company',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        // $dataType = $this->dataType('name', 'category-product');
        // if (!$dataType->exists) {
        //     $dataType->fill([
        //         'slug'                  => 'category-product',
        //         'display_name_singular' => 'Category Product',
        //         'display_name_plural'   => 'Category Products',
        //         'icon'                  => 'voyager-categories',
        //         'model_name'            => 'App\CategoryProduct',
        //         'controller'            => '',
        //         'generate_permissions'  => 1,
        //         'description'           => '',
        //     ])->save();
        // }
    }

    /**
     * [dataType description].
     *
     * @param [type] $field [description]
     * @param [type] $for   [description]
     *
     * @return [type] [description]
     */
    protected function dataType($field, $for)
    {
        return DataType::firstOrNew([$field => $for]);
    }
}
