<?php

namespace App\Console\Commands;

use App\Services\FService;
use Illuminate\Console\Command;

class AddTranslationsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:tr';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
//        if ($this->confirm('Вы уверены, что хотите продолжить?')) {
//            $this->info('Продолжаем...');
//        } else {
//            $this->error('Операция отменена');
//        }

//        $this->line('Простое сообщение'); // Стандартный вывод
//        $this->info('Информационное сообщение'); // Зеленый цвет
//        $this->comment('Комментарий'); // Желтый цвет
//        $this->question('Вопрос'); // Голубой цвет
//        $this->error('Ошибка!'); // Красный цвет
//        $this->warn('Предупреждение'); // Желтый фон
        $this->info('Starting...');
        (new FService())->addTranslations();
        $this->info('Done!');
    }
}
