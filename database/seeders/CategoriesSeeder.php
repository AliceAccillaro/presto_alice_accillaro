<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\Category;


class CategoriesSeeder extends Seeder
{
    public $categories =[
        'Elettronica',
        'Abbigliamento',
        'Casa e Arredamento',
        'Libri',
        'Giocattoli',
        'Sport e Tempo Libero',
        'Salute e Bellezza',
        'Automobili e Moto',
        'Cibo e Bevande',
        'Musica e Film'
    ];
    public function run(): void
    {
        foreach ($this->categories as $category) {
            Category::create(['name' => $category]);
        }
    }
}
