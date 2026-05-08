<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuItemsSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('menu_items')->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $items = [
            // ── BURGERS ──────────────────────────────────────────────
            [
                'name'         => 'La Clásica',
                'price'        => 18000,
                'description'  => 'Hamburguesa de res a la plancha, doble queso cheddar, lechuga fresca, tomate y cebolla. Viene con papas fritas y kétchup.',
                'image_path'   => 'direct:/images/menu/burger-clasica-papas.png',
                'category'     => 'Burgers',
                'is_available' => true,
            ],
            [
                'name'         => 'BBQ Onion Ring',
                'price'        => 22000,
                'description'  => 'Carne de res jugosa, anillos de cebolla crujientes, salsa BBQ y mayonesa especial. Explosión de sabor en cada mordida.',
                'image_path'   => 'direct:/images/menu/burger-bbq-onion.jpg',
                'category'     => 'Burgers',
                'is_available' => true,
            ],
            [
                'name'         => 'Cheddar & Lechuga',
                'price'        => 20000,
                'description'  => 'Hamburguesa artesanal con carne de res, doble cheddar derretido, lechuga crespa y cebolla caramelizada.',
                'image_path'   => 'direct:/images/menu/burger-cheddar-lechuga.jpg',
                'category'     => 'Burgers',
                'is_available' => true,
            ],
            [
                'name'         => 'Doble Bacon',
                'price'        => 28000,
                'description'  => 'Doble carne, doble cheddar, tiras de bacon crujiente y salsa especial Mr. Sabor. Para los más hambrientos.',
                'image_path'   => 'direct:/images/menu/burger-doble-bacon.jpg',
                'category'     => 'Burgers',
                'is_available' => true,
            ],
            [
                'name'         => 'Doble Mushroom',
                'price'        => 26000,
                'description'  => 'Doble carne de res con cheddar, hongos salteados, cebolla caramelizada y salsa de champiñones. Una burger gourmet.',
                'image_path'   => 'direct:/images/menu/burger-doble-mushroom.jpg',
                'category'     => 'Burgers',
                'is_available' => true,
            ],

            // ── HOT DOGS ─────────────────────────────────────────────
            [
                'name'         => 'Perro con Queso',
                'price'        => 12000,
                'description'  => 'Salchicha premium en pan suave con queso cheddar derretido, kétchup y mostaza. El clásico irresistible.',
                'image_path'   => 'direct:/images/menu/hotdog-queso.png',
                'category'     => 'Hot Dogs',
                'is_available' => true,
            ],
            [
                'name'         => 'Perro Americano',
                'price'        => 14000,
                'description'  => 'Salchicha en pan artesanal con lechuga, tomate, pepinillos, cebolla morada, mostaza y kétchup estilo USA.',
                'image_path'   => 'direct:/images/menu/hotdog-americano.png',
                'category'     => 'Hot Dogs',
                'is_available' => true,
            ],
            [
                'name'         => 'Perro Caliente Especial',
                'price'        => 13000,
                'description'  => 'Salchicha jumbo con mostaza amarilla y kétchup especial. Simple, rápido y delicioso.',
                'image_path'   => 'direct:/images/menu/perro-caliente-mostaza.png',
                'category'     => 'Hot Dogs',
                'is_available' => true,
            ],

            // ── SALCHIPAPAS ──────────────────────────────────────────
            [
                'name'         => 'Salchipapas Tradicional',
                'price'        => 14000,
                'description'  => 'Papas fritas doradas con rodajas de salchicha, kétchup, mayonesa y mostaza. El acompañante perfecto.',
                'image_path'   => 'direct:/images/menu/salchipapas-tradicional.png',
                'category'     => 'Salchipapas',
                'is_available' => true,
            ],
            [
                'name'         => 'Salchipapas Especial',
                'price'        => 19000,
                'description'  => 'Papas fritas con carne molida, frijoles, pimentón, maíz y queso fundido. Un plato completo y contundente.',
                'image_path'   => 'direct:/images/menu/salchipapas-especiales.png',
                'category'     => 'Salchipapas',
                'is_available' => true,
            ],
            [
                'name'         => 'Papas Fritas Solas',
                'price'        => 8000,
                'description'  => 'Papas crujientes al estilo Mr. Sabor. Ideales para acompañar cualquier plato. Sal y a disfrutar.',
                'image_path'   => 'direct:/images/menu/papas-fritas.png',
                'category'     => 'Salchipapas',
                'is_available' => true,
            ],

            // ── BEBIDAS ──────────────────────────────────────────────
            [
                'name'         => 'Cóctel Tropical',
                'price'        => 9000,
                'description'  => 'Bebida tropical con frutas naturales, hielo y un toque de canela. Refrescante y colorida.',
                'image_path'   => 'direct:/images/menu/coctel-tropical.png',
                'category'     => 'Bebidas',
                'is_available' => true,
            ],
            [
                'name'         => 'Limonada de Fresa',
                'price'        => 8000,
                'description'  => 'Limonada natural con fresas frescas, hielo y una ramita de menta. El favorito de la casa.',
                'image_path'   => 'direct:/images/menu/limonada-fresa.png',
                'category'     => 'Bebidas',
                'is_available' => true,
            ],

            // ── PLATOS ───────────────────────────────────────────────
            [
                'name'         => 'Tabla Mr. Sabor',
                'price'        => 45000,
                'description'  => 'Tabla de embutidos surtidos: salami, chorizo, jamón, queso, galletas y aceitunas. Para compartir en grupo.',
                'image_path'   => 'direct:/images/menu/tabla-embutidos.png',
                'category'     => 'Platos',
                'is_available' => true,
            ],
        ];

        foreach ($items as $item) {
            DB::table('menu_items')->insert(array_merge($item, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
