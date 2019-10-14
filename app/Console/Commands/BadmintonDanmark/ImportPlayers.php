<?php

namespace App\Console\Commands\BadmintonDanmark;

use App\Helpers\Helpers;
use App\Helpers\UUID;
use App\Models\SystemJob;
use Illuminate\Console\Command;
use App\Models\BadmintonPeople\BpClub;
use App\Models\BadmintonPeople\BpPlayer;
use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ImportPlayers extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:players
                            { club=620006 : Club number }';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import players from XML';

    /**
     * @var FilesystemManager
     */
    private $filesystemManager;

    public function __construct(FilesystemManager $filesystemManager)
    {
        $this->filesystemManager = $filesystemManager;
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
        $file = "DBF_Downloads/DBF.xml";
        if(!$this->filesystemManager->disk()->exists($file)){
            $this->call('download:xml');
            if(!$this->filesystemManager->disk()->exists($file)) {
                $this->error('could not find ' . $file);
                Log::error($arguments["command"] . " - " . 'could not find ' . $file);
                return;
            }
        }

        $xml = $this->filesystemManager->disk()->get($file);
        $data_checksum = Storage::size($file);
        $xml=simplexml_load_string($xml);
        $this->info("Reading XML file");

        if($xml === false){
            $this->error('Filed to load XML');
            return;
        }
        $new = 0;
        $old = 0;
        $i = 0;
        $errors = 0;
        $club_arg = $this->argument('club');

        foreach($xml->c as $elems) {
            $attr = $elems->attributes();
            if($club_arg == "all" || $club_arg == $attr->id) {
                $club = BpClub::find($attr->id);
                if($club) {
                    $club_id = $club->club_id;

                    foreach ($elems->p as $player) {
                        $pInfo = $player->attributes();
                        $id = null;
                        $name = null;
                        $gender = null;
                        $birthdate = null;
                        $group = null;

                        $id = $pInfo->id;
                        $name = $pInfo->nam;
                        $gender = $pInfo->gen;
                        $birthdate = $pInfo->dat;


                        foreach ($player->g as $group => $val1) {
                            $group = $val1->attributes()->nam;

                        }

                        $i++;
                        if ($id) {
                            $bpPlayer = BpPlayer::updateOrCreate(['dbf_id' => $id], ['club_id' => $club_id, 'name' => $name, 'gender' => $gender, 'birthday' => $birthdate, 'age_group' => $group]);
                            //$bpClub = BpClub::updateOrCreate(['id' => $id],['club_id' => $id, 'name' => $name, 'team_name' => $team_name, 'address' => $address, 'postal_code' => $postal_code, 'city' => $city, 'contact_email' => $email, 'email' => $email, 'association' => $association, 'area' => $area]);
                            $this->info($id . ": " . $name . " - " . $club_id);
                            if ($bpPlayer->wasRecentlyCreated) {
                                $new++;
                            } elseif ($bpPlayer->wasChanged()) {
                                $old++;
                            }
                        } else {
                            $errors++;
                        }

                        if($i%100 == 0) {
                            $array = array('status'=> 'incomplete','command' => $arguments["command"],'arguments' => $arguments["club"], 'updated_count' => $old, 'created_count' => $new, 'errors_count' => $errors, 'runtime' => $time->elapsed(),'data_checksum' => $data_checksum);
                            SystemJob::updateOrCreate(['job_id' => $job_id],$array);
                        }
                    }
                } else {
                    $this->error("No club found for id: " . $attr->id);
                    $errors++;
                }
            }
        }

        $this->info("Number of new players added : ".$new);
        $this->info("Number of players updated: ". $old);
        $runtime = $time->elapsed();
        $array = array('status'=> 'completed','command' => $arguments["command"],'arguments' => $arguments["club"], 'updated_count' => $old, 'created_count' => $new, 'errors_count' => $errors, 'runtime' => $runtime,'data_checksum' => $data_checksum);
        SystemJob::updateOrCreate(['job_id' => $job_id],$array);
        $this->info(print_r($array));
    }

}
