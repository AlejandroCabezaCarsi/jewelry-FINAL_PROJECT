<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('products') -> insert([
            [
                'name'=>'Anillo de oro',
                'material_ID'=>1,
                'type_ID' =>1,
                'diamonds' =>false,
                'reference'=>1,
                'price'=>199.95,
                'description' => 'Hermoso anillo de oro para ocasiones especiales. Un elegante diseño que resalta la belleza del oro puro. Perfecto para regalar a esa persona especial.',
                'image' => 'https://proyectofinalalejandrocabezacarsi.s3.eu-north-1.amazonaws.com/anilloOro.jpg'

            ],
            [
                'name'=>'Anillo de plata',
                'material_ID'=>4,
                'type_ID' =>1,
                'diamonds' =>false,
                'reference'=>2,
                'price'=>34.99,
                'description' => 'Este anillo de plata ofrece un estilo moderno y versátil. Ideal para lucir en cualquier ocasión y combinar con diferentes atuendos.',
                'image'=>'https://proyectofinalalejandrocabezacarsi.s3.eu-north-1.amazonaws.com/anilloDePlata.jpg'
            ],
            [
                'name'=>'Anillo de oro rosa',
                'material_ID'=>3,
                'type_ID' =>1,
                'diamonds' =>false,
                'reference'=>3,
                'price'=>170,
                'description' => 'Este anillo de oro rosa tiene un encanto único y romántico. Su color suave y femenino lo convierte en una elección perfecta para simbolizar el amor eterno.',
                'image'=>'https://proyectofinalalejandrocabezacarsi.s3.eu-north-1.amazonaws.com/anilloOroRosa.jpg'
            ],
            [
                'name'=>'Anillo de oro y diamantes',
                'material_ID'=>1,
                'type_ID' =>1,
                'diamonds' =>true,
                'reference'=>4,
                'price'=>700,
                'description' => 'Este impresionante anillo combina el lujo del oro con el brillo de los diamantes. Es una joya excepcional que captura la atención de todos en cualquier evento.',
                'image'=> 'https://proyectofinalalejandrocabezacarsi.s3.eu-north-1.amazonaws.com/anilloOroDiamantes.jpg'
            ],
            [
                'name'=>'Collar de oro',
                'material_ID'=>1,
                'type_ID' =>2,
                'diamonds' =>false,
                'reference'=>5,
                'price'=>180,
                'description' => 'Un collar elegante y sofisticado que resalta la belleza del oro en su diseño. Perfecto para realzar cualquier atuendo y destacar en eventos especiales.',
                'image'=> 'https://proyectofinalalejandrocabezacarsi.s3.eu-north-1.amazonaws.com/collarOro.jpg'
            ],
            [
                'name'=>'Collar de plata',
                'material_ID'=>4,
                'type_ID' =>2,
                'diamonds' =>false,
                'reference'=>6,
                'price'=>40,
                'description' => 'Un collar versátil y atractivo, hecho de plata de alta calidad. Ideal para uso diario y complementar diferentes estilos de moda.',
                'image'=> 'https://proyectofinalalejandrocabezacarsi.s3.eu-north-1.amazonaws.com/collarPlata.jpg'
            ],
            [
                'name'=>'Collar de perlas',
                'material_ID'=>5,
                'type_ID' =>2,
                'diamonds' =>false,
                'reference'=>7,
                'price'=>60,
                'description' => 'Un collar clásico y elegante con perlas naturales. Su diseño atemporal lo convierte en una joya ideal para ocasiones especiales y eventos formales.',
                'image'=>'https://proyectofinalalejandrocabezacarsi.s3.eu-north-1.amazonaws.com/collarPerlas.jpg'
            ],
            [
                'name'=>'Colgante de oro',
                'material_ID'=>1,
                'type_ID' =>3,
                'diamonds' =>false,
                'reference'=>8,
                'price'=>90,
                'description' => 'Un colgante de oro que refleja la belleza y el brillo del sol. Su diseño delicado lo hace perfecto para uso diario y resaltar tu estilo personal.',
                'image'=> 'https://proyectofinalalejandrocabezacarsi.s3.eu-north-1.amazonaws.com/colganteOro.jpg'
            ],
            [
                'name'=>'Colgante de plata',
                'material_ID'=>4,
                'type_ID' =>3,
                'diamonds' =>false,
                'reference'=> 9,
                'price'=>19.90,
                'description' => 'Un colgante de plata con un diseño minimalista y moderno. Es perfecto para agregar un toque de elegancia sutil a cualquier atuendo.',
                'image'=> 'https://proyectofinalalejandrocabezacarsi.s3.eu-north-1.amazonaws.com/colgantePlata.jpg'
            ],
            [
                'name'=>'Pulsera de oro',
                'material_ID'=>1,
                'type_ID' =>5,
                'diamonds' =>false,
                'reference'=>10,
                'price'=>300,
                'description' => 'Una pulsera de oro que combina lujo y elegancia. Su diseño único y brillante lo convierte en una elección perfecta para regalar',
                'image'=> 'https://proyectofinalalejandrocabezacarsi.s3.eu-north-1.amazonaws.com/pulseraOro.jpg'
            ],
            [
                'name'=>'Pulsera de plata',
                'material_ID'=>4,
                'type_ID' =>5,
                'diamonds' =>false,
                'reference'=>11,
                'price'=>40,
                'description' => 'Una pulsera de plata fina y delicada que se adapta a cualquier muñeca. Su diseño sencillo y elegante la hace perfecta para lucir en el día a día y complementar cualquier look.',
                'image' => 'https://proyectofinalalejandrocabezacarsi.s3.eu-north-1.amazonaws.com/pulseraPlata.jpg'
            ],
            [
                'name'=>'Pulsera de piel',
                'material_ID'=>8,
                'type_ID' =>5,
                'diamonds' =>false,
                'reference'=>12,
                'price'=>25,
                'description' => 'Una pulsera de piel genuina con detalles artesanales. Aporta un toque rústico y auténtico a tu estilo. Perfecta para aquellos que aprecian el diseño artesanal.',
                'image'=>'https://proyectofinalalejandrocabezacarsi.s3.eu-north-1.amazonaws.com/pulseraCuero.jpg'
            ],
            [
                'name'=>'Tobillera de oro',
                'material_ID'=>1,
                'type_ID' =>6,
                'diamonds' =>false,
                'reference'=>13,
                'price'=>150,
                'description' => 'Una tobillera elegante y sofisticada de oro puro. Perfecta para resaltar tu estilo en ocasiones especiales o para añadir un toque de lujo a tu look diario.',
                'image'=>'https://proyectofinalalejandrocabezacarsi.s3.eu-north-1.amazonaws.com/tobilleraOro.jpg'
            ],
            [
                'name'=>'Tobillera de plata',
                'material_ID'=>4,
                'type_ID' =>6,
                'diamonds' =>false,
                'reference'=>14,
                'price'=>30,
                'description' => 'Una tobillera de plata sencilla pero encantadora. Ideal para combinar con cualquier estilo y añadir un toque de brillo a tus pies.',
                'image'=> 'https://proyectofinalalejandrocabezacarsi.s3.eu-north-1.amazonaws.com/tobilleraPlata.jpg'             
            ],
            [
                'name'=>'Tobillera de piel',
                'material_ID'=>8,
                'type_ID' =>6,
                'diamonds' =>false,
                'reference'=>15,
                'price'=>15,
                'description' => 'Una tobillera de piel auténtica, diseñada para aquellos que buscan comodidad y estilo. Perfecta para llevar en cualquier época del año.',
                'image'=> 'https://proyectofinalalejandrocabezacarsi.s3.eu-north-1.amazonaws.com/tobilleraCuero.jpg'             
            ],
            [
                'name'=>'Reloj de oro',
                'material_ID'=>1,
                'type_ID' =>8,
                'diamonds' =>false,
                'reference'=>16,
                'price'=>4000,
                'description' => 'Un reloj de lujo hecho de oro puro, con un diseño exquisito que combina elegancia y funcionalidad. El complemento perfecto para lucir en eventos especiales.',
                'image'=> 'https://proyectofinalalejandrocabezacarsi.s3.eu-north-1.amazonaws.com/relojOro.jpg'             
            ],
            [
                'name'=>'Reloj con correa de acero',
                'material_ID'=>6,
                'type_ID' =>8,
                'diamonds' =>false,
                'reference'=>17,
                'price'=>200,
                'description' => 'Un reloj moderno y resistente con correa de acero inoxidable. Ideal para quienes buscan un reloj duradero y versátil para el uso diario.',
                'image'=> 'https://proyectofinalalejandrocabezacarsi.s3.eu-north-1.amazonaws.com/relojAcero.jpg'             
            ],
            [
                'name'=>'Reloj con correa de piel',
                'material_ID'=>8,
                'type_ID' =>8,
                'diamonds' =>false,
                'reference'=>18,
                'price'=>120,
                'description' => 'Un reloj clásico con correa de piel genuina, diseñado para aquellos que aprecian el estilo atemporal. Ideal para llevar en ocasiones formales e informales.',
                'image'=> 'https://proyectofinalalejandrocabezacarsi.s3.eu-north-1.amazonaws.com/relojCuero.jpg'             
            ],
            [
                'name'=>'Reloj con correa de silicona',
                'material_ID'=>7,
                'type_ID' =>8,
                'diamonds' =>false,
                'reference'=>19,
                'price'=>150,
                'description' => 'Un reloj deportivo con correa de silicona, ideal para actividades al aire libre y deportes. Resistente al agua y diseñado para personas activas.',
                'image'=> 'https://proyectofinalalejandrocabezacarsi.s3.eu-north-1.amazonaws.com/relojSilicona.jpg'             
            ],
            [
                'name'=>'Reloj de oro y diamantes',
                'material_ID'=>1,
                'type_ID' =>8,
                'diamonds' =>true,
                'reference'=>20,
                'price'=>4000,
                'description' => 'Un reloj lujoso y deslumbrante con incrustaciones de diamantes. Este reloj de oro es una obra maestra que combina la elegancia y el brillo para aquellos que buscan el máximo lujo.',
                'image'=> 'https://proyectofinalalejandrocabezacarsi.s3.eu-north-1.amazonaws.com/relojDiamantes.jpg'             
            ],
            [
                'name'=>'Alianzas de oro',
                'material_ID'=>1,
                'type_ID' =>9,
                'diamonds' =>false,
                'reference'=>21,
                'price'=>400,
                'description' => 'Estas alianzas de oro son un símbolo de amor y compromiso eterno. Un elegante diseño que representa la unión y el vínculo entre dos personas.',
                'image'=> 'https://proyectofinalalejandrocabezacarsi.s3.eu-north-1.amazonaws.com/alianzaOro.jpg'
            ],
            [
                'name'=>'Alianzas de oro rosa',
                'material_ID'=>3,
                'type_ID' =>9,
                'diamonds' =>false,
                'reference'=>22,
                'price'=>380,
                'description' => 'Estas alianzas de oro rosa simbolizan el amor y la ternura. Su suave tono rosa las hace únicas y perfectas para celebrar momentos especiales.',
                'image'=>'https://proyectofinalalejandrocabezacarsi.s3.eu-north-1.amazonaws.com/alianzaOroRosa.jpg'
            ],
            
            
        ]);

    }
}
