<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class EntriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $filePath = __DIR__ . '/entries.csv';
        $table = config('laravel-grammar.table', 'entries');
        if (!File::exists($filePath) && !$this->unzip()) {
            echo "Failed to unzip csv. Check if [entries.csv.zip] exists in /database/seeds\n";
            return;
        }
        $rows = file($filePath);
        DB::table($table)->truncate();

        foreach ($rows as $row) {
            $array = explode(";", $row);
            DB::table($table)->insert([
                'word' => str_replace('"', '', $array[0]),
                'wordtype' => str_replace('"', '', $array[1])
            ]);
        }

        echo "\e[0;31;42mYou can delete [entries.csv.zip] from /database/seeds\e[0m\n";
    }

    public function unzip()
    {
        $zip = new ZipArchive;
        $res = $zip->open(__DIR__ . '/entries.csv.zip');
        if ($res === TRUE) {
            $zip->extractTo(__DIR__);
            $zip->close();
            return true;
        } else {
            return false;
        }
    }
}
