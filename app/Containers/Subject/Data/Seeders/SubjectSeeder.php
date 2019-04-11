<?php

namespace App\Containers\Subject\Data\Seeders;

use App\Ship\Helpers\ArabicToPersianStringConverter;
use App\Ship\Parents\Seeders\Seeder;
use Carbon\Carbon;
use DB;

class SubjectSeeder extends Seeder
{
    public function run()
    {
        // automatically add subject from subject-container config file
        $subjectArray = [];
        $iterator = 0;
        foreach (config('subject-container.subjects') as $key => $value) {
            array_push($subjectArray, [
                'id' => $iterator + 1,
                'name' => json_encode([
                    'en' => ArabicToPersianStringConverter::Convert($value),
                ]),
                'order_column' => $iterator + 1,
                'slug' => json_encode([
                    'en' => $key,
                ]),
                'type' => 'subject',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            $iterator++;
        }

        DB::table('tags')->insert($subjectArray);
    }
}
