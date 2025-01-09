<?php

namespace Database\Seeders;

use App\Models\Product;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Kiểm tra và thêm sản phẩm nếu chưa tồn tại
        Product::firstOrCreate(
            ['name' => 'Hyundai Santa Fe'],
            [
                'description' => 'Xe ô tô tiết kiệm nhiên liệu',
                'price' => 1365000000,
                'image' => 'img/img-hyundai/hyundai1.png',
            ]
        );

        Product::firstOrCreate(
            ['name' => 'Hyundai Creta'],
            [
                'description' => 'Xe ô tô thể thao',
                'price' => 699000000,
                'image' => 'img/img-hyundai/hyundai2.png',
            ]
        );

        Product::firstOrCreate(
            ['name' => 'Toyota Camry'],
            [
                'description' => 'Xe ô tô thể thao',
                'price' => 1220000000,
                'image' => 'img/img-toyota/toyota3.png',
            ]
        );

        Product::firstOrCreate(
            ['name' => 'Toyota Corolla Altis'],
            [
                'description' => 'Xe ô tô thể thao',
                'price' => 725000000,
                'image' => 'img/img-toyota/toyota2.png',
            ]
        );

        Product::firstOrCreate(
            ['name' => 'Toyota Raize'],
            [
                'description' => 'Xe ô tô thể thao',
                'price' => 498000000,
                'image' => 'img/img-toyota/toyota6.png',
            ]
        );

        Product::firstOrCreate(
            ['name' => 'Honda Civic Type R'],
            [
                'description' => 'Xe ô tô thể thao',
                'price' => 2399000000,
                'image' => 'img/img-honda/honda5.png',
            ]
        );


        Product::firstOrCreate(
            ['name' => 'Honda Civic'],
            [
                'description' => 'Xe ô tô thể thao',
                'price' => 789000000,
                'image' => 'img/img-honda/honda6.png',
            ]
        );

        Product::firstOrCreate(
            ['name' => 'Honda City'],
            [
                'description' => 'Xe ô tô thể thao',
                'price' => 1029000000,
                'image' => 'img/img-honda/honda7.png',
            ]
        );

        $this->call(ProductSeeder::class);
    }
}
