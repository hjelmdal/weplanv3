<?php

namespace App\Console\Commands\BadmintonDanmark;

use App\Helpers\Helpers;
use App\Helpers\UUID;
use App\Models\SystemJob;
use GuzzleHttp\Client;
use function GuzzleHttp\Psr7\stream_for;
use Illuminate\Console\Command;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class DownloadXML extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'download:xml';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Download DBF XML data file from BadmintonPeople';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(){
        $arguments = $this->arguments();
        $job_id = UUID::v4();
        $time = Helpers::elapsedTime();
        $bar = null;
        $errors = 1;
        $tmpFile  = tempnam(sys_get_temp_dir(), uniqid(strftime('%G-%m-%d'), true));
        $resource = fopen($tmpFile, 'w');
        $stream = stream_for($resource);
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'https://badmintonplayer.dk',
            // You can set any number of default request options.
            'timeout'  => 60,
        ]);
        $progressCallback = function($downloadTotal,$downloadedBytes,$uploadTotal,$uploadedBytes) use ($bar) {
            if($bar == null){
                $bar = $this->output->createProgressBar($downloadTotal);
            }
            $bar->setProgress($downloadedBytes);
            $this->line("");
            if($downloadTotal === $downloadedBytes){
                $bar->finish();

            }
        };
        $client->request('GET', '/DBF/DownloadRankings', [
            'save_to' => $stream,
            'progress' => $progressCallback,
        ]);
        fclose($resource);
        $this->line("");

        $file = $this->moveToLocalStorage($tmpFile);
        $data_checksum = Storage::size($file);
        $errors = 0;

        $this->unzip();

        $runtime = $time->elapsed();
        SystemJob::updateOrCreate(['id' => null],['job_id' => $job_id,'status'=> 'completed','command' => $arguments["command"], 'updated_count' => 1, 'created_count' => null, 'errors_count' => $errors, 'runtime' => $runtime,'data_checksum' => $data_checksum]);

    }

    /**
     * @param $tmpFile
     * @return string
     */
    private function moveToLocalStorage(string $tmpFile)
    {
        $folder = 'DBF_Downloads';
        $fileName = 'DBF.zip';
        $filePath = $folder . '/' . $fileName;
        $this->info('Moving ' . $tmpFile . ' to ' . $filePath);
        Storage::putFileAs($folder, new File($tmpFile), $fileName);
        return $filePath;
    }

    private function unzip()
    {
        $this->call('unzip:xml');
    }
}
