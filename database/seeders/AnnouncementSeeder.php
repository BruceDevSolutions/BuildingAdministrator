<?php

namespace Database\Seeders;

use App\Models\Announcement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnnouncementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Announcement::create([
            'title' => 'Anuncio de prueba',
            'description' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Iure, deleniti! Quas maxime deleniti libero odio, adipisci consectetur repellat temporibus reprehenderit! Libero maxime modi eaque repudiandae ut praesentium earum nesciunt provident.'
        ]);

        Announcement::create([
            'title' => 'Segundo anuncio de prueba',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi architecto doloribus dolor doloremque in dicta. Eligendi, itaque maxime porro vitae repudiandae asperiores, eveniet nulla voluptas sed modi cupiditate quis odio? Quas maxime deleniti libero odio, adipisci consectetur repellat temporibus reprehenderit! Libero maxime modi eaque repudiandae ut praesentium earum nesciunt provident.'
        ]);

        Announcement::create([
            'title' => 'Tercer anuncio de prueba',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi architecto doloribus dolor doloremque in dicta. Eligendi, itaque maxime porro vitae repudiandae asperiores, eveniet nulla voluptas sed modi cupiditate quis odio? Quas maxime deleniti libero odio, adipisci consectetur repellat temporibus reprehenderit! Libero maxime modi eaque repudiandae ut praesentium earum nesciunt provident.',
            'status' => false
        ]);

        Announcement::create([
            'title' => 'Anuncio anclado de prueba',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi architecto doloribus dolor doloremque in dicta. Eligendi, itaque maxime porro vitae repudiandae asperiores, eveniet nulla voluptas sed modi cupiditate quis odio? Quas maxime deleniti libero odio, adipisci consectetur repellat temporibus reprehenderit! Libero maxime modi eaque repudiandae ut praesentium earum nesciunt provident.',
            'pinned' => true
        ]);
        
    }
}
