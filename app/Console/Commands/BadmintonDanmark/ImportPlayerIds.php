<?php

namespace App\Console\Commands\BadmintonDanmark;

use App\Helpers\BadmintonDanmark\PlayerParser;
use App\Helpers\BadmintonDanmark\Scraper;
use App\Helpers\Helpers;
use App\Helpers\UUID;
use App\Models\SystemJob;
use Illuminate\Console\Command;

class ImportPlayerIds extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:player-ids';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $arguments = $this->arguments();
        $job_id = UUID::v4();

        $time = Helpers::elapsedTime();
        $parser = new PlayerParser();
        $output = $parser->getPlayers();

        $errors = $output["errors"];
        $new = $output["new"];
        $old = $output["old"];
        $i = $output["i"];

        $runtime = $time->elapsed();
        $array = array('status'=> 'completed','command' => $arguments["command"], 'updated_count' => $old, 'created_count' => $new, 'errors_count' => $errors, 'runtime' => $runtime,'data_checksum' => null);
        SystemJob::updateOrCreate(['job_id' => $job_id],$array);
        $this->info(print_r($output));

    }
}
