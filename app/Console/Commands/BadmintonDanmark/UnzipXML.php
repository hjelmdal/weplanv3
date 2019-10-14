<?php

namespace App\Console\Commands\BadmintonDanmark;

use App\Helpers\Helpers;
use App\Helpers\UUID;
use App\Models\SystemJob;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use wapmorgan\UnifiedArchive\UnifiedArchive;
use Illuminate\Filesystem\FilesystemManager;


class UnzipXML extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'unzip:xml';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Unzip DBF and rename it to xml';

    /**
     * Execute the console command.
     *
     * @return mixed
     */

    /**
     * @var FilesystemManager
     */
    private $filesystemManager;

    public function __construct(FilesystemManager $filesystemManager)
    {
        $this->filesystemManager = $filesystemManager;
        parent::__construct();
    }

    public function handle()
    {
        $arguments = $this->arguments();
        $job_id = UUID::v4();
        $time = Helpers::elapsedTime();
        $file = "DBF_Downloads/DBF.zip";
        if(!$this->filesystemManager->disk()->exists($file)) {
            $this->error('could not find ' . $file);
            $errors = 1;
            $data_checksum = null;
        } else {
            $abPath = storage_path('app' . '/' . $file);
            $this->info('unzipping ' . $abPath);
            $baseDir = pathinfo($abPath)['dirname'];
            $archive = UnifiedArchive::open($abPath);
            $archive->extractFiles($baseDir);

            $this->info('Renaming to ' . $baseDir . '/DBF.xml');
            rename($baseDir . '/DBF.stm', $baseDir . '/DBF.xml');
            $data_checksum = Storage::size("DBF_Downloads/DBF.xml");
            $errors = 0;
        }
        $runtime = $time->elapsed();
        SystemJob::updateOrCreate(['id' => null],['job_id' => $job_id,'status'=> 'completed','command' => $arguments["command"], 'updated_count' => null, 'created_count' => 1, 'errors_count' => $errors, 'runtime' => $runtime,'data_checksum' => $data_checksum]);

    }
}
