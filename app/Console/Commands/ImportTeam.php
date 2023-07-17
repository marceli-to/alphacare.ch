<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use Statamic\Facades\Entry;
use Statamic\Fields\Value;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ImportTeam extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'import:team';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Import team members from an array';

  /**
   * The data to import
   */
  protected $data = [
    [
      'firstname' => 'Alma',
      'name' => 'Badic',
      'function' => 'Dipl. Expertin Anästhesiepflege NDS HF',
      'image' => 'https://www.alphacare.ch/wp-content/uploads/2022/04/Alma-Badic-1.1-1-scaled-uai-688x1032.jpg'
    ],
    [
      'firstname' => 'Leila',
      'name' => 'Basaran',
      'function' => 'Dipl. Expertin Anästhesiepflege',
      'image' => 'https://www.alphacare.ch/wp-content/uploads/2022/04/Leila-Basaran1-scaled-uai-688x1032.jpg'
    ],
    [
      'firstname' => 'Adriaan',
      'name' => 'Blahota',
      'function' => 'Dipl. Experte Anästhesiepflege',
      'image' => 'https://www.alphacare.ch/wp-content/uploads/2022/03/Passfoto-leer-1-uai-373x560.jpeg'
    ],
    [
      'firstname' => 'Andrea',
      'name' => 'Birrer',
      'function' => 'Dipl. Expertin Anästhesiepflege NDS HF',
      'image' => 'https://www.alphacare.ch/wp-content/uploads/2021/11/DSC3785-scaled-uai-688x1032.jpg'
    ],
    [
      'firstname' => 'Erika',
      'name' => 'Brändli',
      'function' => 'Leiterin Abrechnung',
      'image' => 'https://www.alphacare.ch/wp-content/uploads/2021/11/DSC3854-scaled-uai-688x1032.jpg'
    ],
    [
      'firstname' => 'Annette',
      'name' => 'Bühlmann',
      'function' => 'Fachärztin Anästhesiologie und Reanimation',
      'image' => 'https://www.alphacare.ch/wp-content/uploads/2022/01/DSC4433-scaled-uai-688x1032.jpg'
    ],
    [
      'job_title' => 'Dr. med.',
      'firstname' => 'Benita',
      'name' => 'Burkart',
      'function' => 'Fachärztin Anästhesiologie und Reanimation',
      'image' => 'https://www.alphacare.ch/wp-content/uploads/2021/11/DSC3748-scaled-uai-688x1032.jpg'
    ],
    [
      'firstname' => 'Miriam',
      'name' => 'Burkard',
      'function' => 'Dipl. Expertin Anästhesiepflege NDS HF',
      'image' => 'https://www.alphacare.ch/wp-content/uploads/2022/08/Passfoto_Platzhalter-w-uai-343x515.jpeg'
    ],
    [
      'firstname' => 'Melanie',
      'name' => 'Burike',
      'function' => 'Dipl. Expertin Anästhesiepflege NDS HF',
      'image' => 'https://www.alphacare.ch/wp-content/uploads/2021/11/DSC3837-scaled-uai-688x1032.jpg'
    ],
    [
      'firstname' => 'Sabine',
      'name' => 'Cappilli',
      'function' => 'Dipl. Expertin Anästhesiepflege NDS HF',
      'image' => 'https://www.alphacare.ch/wp-content/uploads/2022/04/Sabine-Cappilli1-scaled-uai-688x1032.jpg'
    ],
    [
      'job_title' => 'Dr. med.',
      'firstname' => 'Simone',
      'name' => 'Dennig',
      'function' => 'Fachärztin Anästhesiologie und Reanimation',
      'image' => 'https://www.alphacare.ch/wp-content/uploads/2022/09/DSC3425-scaled-uai-688x1032.jpg'
    ],
    [
      'firstname' => 'Guiseppe',
      'name' => 'Di Giorgio',
      'function' => 'Dipl. Experte Anästhesiepflege',
      'image' => 'https://www.alphacare.ch/wp-content/uploads/2021/11/DSC3083-1-scaled-uai-688x1032.jpg'
    ],
    [
      'job_title' => 'Dr. med.',
      'firstname' => 'Kathrin',
      'name' => 'Dreier',
      'function' => 'Gesamtleitung<br>Fachärztin Anästhesiologie und Reanimation<br>Mitglied FMH<br>MAS Health Service Management FHS St. Gallen',
      'image' => 'https://www.alphacare.ch/wp-content/uploads/2023/01/DSC6202-scaled-uai-688x1032.jpg'
    ],
    [
      'firstname' => 'Urs',
      'name' => 'Dreier',
      'function' => 'Geschäftsleiter',
      'image' => 'https://www.alphacare.ch/wp-content/uploads/2023/01/DSC6197-scaled-uai-688x1032.jpg'
    ],
    [
      'job_title' => 'Dr. med.',
      'firstname' => 'Pascale',
      'name' => 'Escher',
      'function' => 'Fachärztin Anästhesiologie und Reanimation',
      'image' => 'https://www.alphacare.ch/wp-content/uploads/2021/11/DSC3743-scaled-uai-688x1032.jpg'
    ],
    [
      'firstname' => 'Martina',
      'name' => 'Giallella',
      'function' => 'Dipl. Expertin Anästhesiepflege NDS HF',
      'image' => 'https://www.alphacare.ch/wp-content/uploads/2021/11/DSC3841-scaled-uai-688x1032.jpg'
    ],
    [
      'firstname' => 'Sonja',
      'name' => 'Götte-Wetzel',
      'function' => 'Dipl. Exptertin Anästhesiepflege',
      'image' => 'https://www.alphacare.ch/wp-content/uploads/2021/12/DSC4103-1-scaled-uai-688x1032.jpg'
    ],
    [
      'job_title' => 'Dr. med.',
      'firstname' => 'Carolin',
      'name' => 'Grathwohl',
      'function' => 'Fachärztin Anästhesiologie und Reanimation',
      'image' => 'https://www.alphacare.ch/wp-content/uploads/2021/11/DSC3707-scaled-uai-688x1032.jpg'
    ],
    [
      'job_title' => 'Dr.',
      'firstname' => 'Beat',
      'name' => 'Hardmeier',
      'function' => 'Leitung Anästhesie Bethanien<br>Facharzt Anästhesiologie und Reanimation',
      'image' => 'https://www.alphacare.ch/wp-content/uploads/2023/01/DSC3758-scaled-uai-688x1032.jpg'
    ],
    [
      'job_title' => 'Dr. med.',
      'firstname' => 'Andi',
      'name' => 'Hirlinger',
      'function' => 'Facharzt Anästhesie und Reanimation<br>Facharzt Intensivmedizin',
      'image' => 'https://www.alphacare.ch/wp-content/uploads/2022/01/DSC4429-2-scaled-uai-688x1032.jpg'
    ],
    [
      'firstname' => 'Kristina',
      'name' => 'Ivancev',
      'function' => 'Stv. Leitung Anästhesiepflege Lindberg<br>Dipl. Expertin Anästhesiepflege',
      'image' => 'https://www.alphacare.ch/wp-content/uploads/2021/11/DSC3090-1-scaled-uai-688x1032.jpg'
    ],
    [
      'firstname' => 'Petra',
      'name' => 'Koets-Patka',
      'function' => 'Dipl. Expertin Anästhesiepflege NDS HF',
      'image' => 'https://www.alphacare.ch/wp-content/uploads/2021/11/DSC3797-scaled-uai-688x1032.jpg'
    ],
    [
      'firstname' => 'Tobias',
      'name' => 'Kohlstetter',
      'function' => 'Dipl. Experte Anästhesiepflege',
      'image' => 'https://www.alphacare.ch/wp-content/uploads/2021/11/DSC3112-1-scaled-uai-688x1032.jpg'
    ],
    [
      'job_title' => 'Dr. med.',
      'firstname' => 'Karen',
      'name' => 'Leube',
      'function' => 'Fachärztin Anästhesiologie und Reanimation',
      'image' => 'https://www.alphacare.ch/wp-content/uploads/2022/04/Karen-Leube1-scaled-uai-688x1032.jpg'
    ],
    [
      'job_title' => 'PHD',
      'firstname' => 'Robert',
      'name' => 'Lachmann',
      'function' => 'Facharzt Anästhesiologie und Reanimation',
      'image' => 'https://www.alphacare.ch/wp-content/uploads/2021/11/DSC3780-scaled-uai-688x1032.jpg'
    ],
    [
      'job_title' => 'Dr. med.',
      'firstname' => 'Carlos',
      'name' => 'Love',
      'function' => 'Facharzt Anästhesiologie und Reanimation',
      'image' => 'https://www.alphacare.ch/wp-content/uploads/2022/09/DSC3410-scaled-uai-688x1032.jpg'
    ],
    [
      'firstname' => 'Tanja',
      'name' => 'Ludewig',
      'function' => 'Dipl. Expertin Anästhesiepflege NDS HF',
      'image' => 'https://www.alphacare.ch/wp-content/uploads/2022/04/Tanja-Ludewig1-scaled-uai-688x1032.jpg'
    ],
    [
      'job_title' => 'Dr. med.',
      'firstname' => 'Lilly',
      'name' => 'Madjdpour Berger',
      'function' => 'Fachärztin Anästhesiologie und Reanimation Fachärztin IntensivmedizinNotärztin SGNOR',
      'image' => 'https://www.alphacare.ch/wp-content/uploads/2021/11/DSC3126-1-scaled-uai-688x1032.jpg'
    ],
    [
      'job_title' => 'MBA',
      'firstname' => 'Salome',
      'name' => 'Meyer',
      'function' => 'Leitung IPS<br>Leitung Entwicklung<br>Fachärztin Anästhesie und Reanimation<br>Fachärztin Intensivmedizin',
      'image' => 'https://www.alphacare.ch/wp-content/uploads/2022/12/Salome-Meyer-scaled-uai-688x1032.jpg'
    ],
    [
      'firstname' => 'Caroline',
      'name' => 'Milano',
      'function' => 'Dipl. Expertin Anästhesiepflege NDS HF',
      'image' => 'https://www.alphacare.ch/wp-content/uploads/2022/12/Caroline-Milano-scaled-uai-688x1032.jpg'
    ],
    [
      'job_title' => 'Dr. med.',
      'firstname' => 'Fiona',
      'name' => 'Möhler',
      'function' => 'Stv. Leitung Anästhesie<br>Fachärztin Anästhesiologie und Reanimation',
      'image' => 'https://www.alphacare.ch/wp-content/uploads/2021/11/DSC3722-scaled-uai-688x1032.jpg'
    ],
    [
      'job_title' => 'Dr. medic RO',
      'firstname' => 'Valentin-Florin',
      'name' => 'Mocanu',
      'function' => 'Facharzt Anästhesiologie und Reanimation',
      'image' => 'https://www.alphacare.ch/wp-content/uploads/2022/04/Valentin-Mocanue1.2-scaled-uai-688x1032.jpg'
    ],
    [
      'job_title' => 'Dr. med.univ H',
      'firstname' => 'Istvan',
      'name' => 'Povik',
      'function' => 'Leitung Anästhesie Belair<br>Facharzt Anästhesiologie und Reanimation',
      'image' => 'https://www.alphacare.ch/wp-content/uploads/2021/12/DSC4114-1-scaled-uai-688x1032.jpg'
    ],
    [
      'firstname' => 'Hendrik',
      'name' => 'Rasch',
      'function' => 'Stv. Leitung Anästhesiepflege Belair<br>Dipl. Experte Anästhesiepflege NDS HF',
      'image' => 'https://www.alphacare.ch/wp-content/uploads/2021/11/DSC3855-scaled-uai-688x1032.jpg'
    ],
    [
      'firstname' => 'Marco',
      'name' => 'Rifino',
      'function' => 'Leitung Anästhesiepflege Belair<br>Dipl. Experte Anästhesiepflege NDS HF',
      'image' => 'https://www.alphacare.ch/wp-content/uploads/2021/12/DSC4121-1-scaled-uai-688x1032.jpg'
    ],
    [
      'job_title' => 'Dr. med.',
      'firstname' => 'Florian',
      'name' => 'Rossmanith',
      'function' => 'Stv. Leitung Anästhesie Lindberg<br>Facharzt Anästhesiologie und Reanimation',
      'image' => 'https://www.alphacare.ch/wp-content/uploads/2022/12/Florian-Rossmanith-scaled-uai-688x1032.jpg'
    ],
    [
      'job_title' => 'Dr. med.',
      'firstname' => 'Vera',
      'name' => 'Rogler',
      'function' => 'Fachärztin Anästhesiologie und Reanimation',
      'image' => 'https://www.alphacare.ch/wp-content/uploads/2022/04/Vera-Rogler-1-scaled-uai-688x1032.jpg'
    ],
    [
      'firstname' => 'Susan',
      'name' => 'Roelfs',
      'function' => 'Dipl. Expertin Anästhesiepflege',
      'image' => 'https://www.alphacare.ch/wp-content/uploads/2021/11/DSC3817-scaled-uai-688x1032.jpg'
    ],
    [
      'job_title' => 'Dr. med.',
      'firstname' => 'Christoph',
      'name' => 'Schubert',
      'function' => 'ärztliche Leitung<br>Facharzt Anästhesiologie und Reanimation<br>Facharzt Intensivmedizin',
      'image' => 'https://www.alphacare.ch/wp-content/uploads/2023/01/DSC6224-scaled-uai-688x1032.jpg'
    ],
    [
      'job_title' => 'Dr. med',
      'firstname' => 'Sebastian',
      'name' => 'Schulze-Bergmann',
      'function' => 'Facharzt Anästhesie und Reanimation',
      'image' => 'https://www.alphacare.ch/wp-content/uploads/2022/11/Passfoto-leer-uai-373x560.jpeg'
    ],
    [
      'firstname' => 'Minela',
      'name' => 'Seferagic',
      'function' => 'Dipl. Expertin Anästhesiepflege NDS HF',
      'image' => 'https://www.alphacare.ch/wp-content/uploads/2022/04/Minela-Kujovic1-scaled-uai-688x103'
    ],
    [
      'firstname' => 'Markus',
      'name' => 'Schnell',
      'function' => 'Dipl. Experte Anästhesiepflege',
      'image' => 'https://www.alphacare.ch/wp-content/uploads/2021/11/DSC3106-1.jpg'
    ],
    [
      'job_title' => 'Dr. med.',
      'firstname' => 'Philipp',
      'name' => 'Schürner',
      'function' => 'Facharzt Anästhesiologie und Reanimation',
      'image' => 'https://www.alphacare.ch/wp-content/uploads/2021/11/DSC3770-scaled.jpg'
    ],
    [
      'firstname' => 'Bernadette',
      'name' => 'Spring',
      'function' => 'Fachärztin Anästhesiologie und Reanimation',
      'image' => 'https://www.alphacare.ch/wp-content/uploads/2021/11/DSC3760-scaled.jpg'
    ],
    [
      'firstname' => 'Marita',
      'name' => 'Stoll',
      'function' => 'Dipl. Expertin Anästhesiepflege',
      'image' => 'https://www.alphacare.ch/wp-content/uploads/2021/11/DSC3093-1.jpg'
    ],
    [
      'job_title' => 'Dr. med.EC',
      'firstname' => 'Lorena',
      'name' => 'Witzig-Villegas',
      'function' => 'Fachärztin Anästhesiologie und Reanimation',
      'image' => 'https://www.alphacare.ch/wp-content/uploads/2022/01/DSC4420.jpg'
    ],
    [
      'job_title' => 'Dr. med.',
      'firstname' => 'Stefan',
      'name' => 'Zumstein',
      'function' => 'Leitung IPS Lindberg<br>Facharzt Anästhesie und Reanimation, Facharzt Intensivmedizin',
      'image' => 'https://www.alphacare.ch/wp-content/uploads/2022/01/DSC4414-Bearbeitet.jpg'
    ]
  ];

  /**
   * Create a new command instance.
   *
   * @return void
   */
  public function __construct()
  {
    parent::__construct();
  }

  /**
   * Execute the console command.
   *
   * @return mixed
   */
  public function handle()
  {
    // loop over the data array.
    // 1. fetch all images from the url provided in the array and store them in the storage folder

    foreach ($this->data as $key => $value)
    {

      // fetch the image from the url
      // wrap it in a try catch block to prevent the command from stopping if an image is not found
      // try
      // {
      //   $image = file_get_contents($value['image']);
      // }
      // catch (\Exception $e)
      // {
      //   $this->error('Image not found for ' . $value['firstname'] . ' ' . $value['name']);
      //   continue;
      // }

      $image = true;

      if ($image)
      {
        // if 'job_title' is set, add it to the name
        if (isset($value['job_title'])) 
        {
          $image_name = \Str::slug($value['job_title']) . '-' . \Str::slug($value['firstname']) . '-' .\Str::slug($value['firstname']) . '-' . \Str::slug($value['name']) . '.jpg';
        }
        else
        {
          $image_name = \Str::slug($value['firstname']) . '-' . \Str::slug($value['name']) . '.jpg';
        }
        Storage::disk('public')->put($image_name, $image);

        $title = $value['firstname'] . ' ' . $value['name'];
        $firstname = $value['firstname'];
        $name = $value['name'];

        // replace <br> with new line
        $function = str_replace('<br>', "\n", $value['function']);
        $image = $image_name;

        // create an entry as statamic markdown file
        $member = Entry::make()
        ->collection('team')
        ->slug($title)
        ->data(
          [
            'title' => $title,
            'image' => 'team/' . $image,
            'firstname' => $firstname,
            'name' => $name,
            'function' => $function,
          ], 
        );
  
        $member->published(true);
        $member->save();

      }
    }
  }
}
