<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Vanilo\Category\Models\Taxonomy;
use Illuminate\Support\Str;

class TaxonomySeeder extends Seeder
{
    public function run(): void
    {
        $taxonomies = ['Category', 'Brand', 'Season'];

        foreach ($taxonomies as $name) {
            Taxonomy::firstOrCreate(
                ['name' => $name],
                ['slug' => Str::slug($name)]
            );
        }
    }
}
