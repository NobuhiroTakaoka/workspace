<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Prefectures;  // 追記

use Goodby\CSV\Import\Standard\Lexer;  // 追記
use Goodby\CSV\Import\Standard\Interpreter;  // 追記
use Goodby\CSV\Import\Standard\LexerConfig;  // 追記

class PrefectureSeeder extends Seeder
{
    const CSV_FILENAME = '/../database/seeders/prefectures_utf8.csv';  // appからの相対パス

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('[Start] import data.');

        $config = new LexerConfig();

        // セパレータをカンマに指定
        $config->setDelimiter(',');

        // 1行目をスキップ
        $config->setIgnoreHeaderLine(true);

        $lexer = new Lexer($config);
        
        $interpreter = new Interpreter();

        $interpreter->addObserver(function(array $row) {
            // 登録処理
            $prefectures = Prefectures::create([
                'pref_code' => $row[0],  // 都道府県コード
                'pref_name' => $row[1],  // 都道府県名
            ]);
        });
        
        $lexer->parse(app_path() . self::CSV_FILENAME, $interpreter);

        $this->command->info('[Edn] import data.');
    }
}
