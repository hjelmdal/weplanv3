<?php

namespace App\Console\Commands\BadmintonDanmark;

use App\Helpers\Helpers;
use App\Helpers\UUID;
use App\Models\BadmintonPeople\BpClub;
use App\Models\SystemJob;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Support\Facades\Storage;

class ImportClubs extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:clubs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import clubs from XML';

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
        $errors = 0;
        $i = 0;
        foreach($xml->c as $elems) {
            $attr = $elems->attributes();
            $team_name = null;
            $name = null;
            $id = null;
            $address = null;
            $postal_code = null;
            $city = null;
            $contact_email = null;
            $email = null;
            $association = null;
            $area = null;


            $id = trim($attr->id);
            $name = $attr->nm1;
            $team_name = $attr->nm2;
            $address = $attr->adr;
            if(strlen($attr->zip) == 4) {
                $postal_code = $attr->zip;
            } else {
                $postal_code = NULL;
            }
            $city = $attr->city;
            $email = $attr->email;
            $association = $attr->medlemaf;
            $area = $attr->amtsforening;



            $inserts = ['club_id' => $id,'name' => $team_name, 'team_name' => $name, 'address' => $address, 'postal_code' => $postal_code, 'city' => $city, 'email' => $email, 'association' => $association, 'area' => $area];


            $i++;


            if(is_numeric(trim($id))) {


                $bpClub = BpClub::updateOrCreate(['id' => $id], ['name' => $name, 'team_name' => $team_name, 'address' => $address, 'postal_code' => $postal_code, 'city' => $city, 'contact_email' => $email, 'email' => $email, 'association' => $association, 'area' => $area]);
                if ($bpClub->wasRecentlyCreated) {
                    $new++;
                } elseif($bpClub->wasChanged()) {
                    $old++;
                }
            } else {
                $this->info("Club Id is formatted incorrect: " . $id);
                $errors++;
            }



        }
        $this->info("Number of new clubs added : ".$new);
        $this->info("Number of clubs updated: ". $old);
        $runtime = $time->elapsed();
        $this->info("Runtime: ". $runtime);
        $array = array('status'=>'completed','command' => $arguments["command"],'updated_count' => $old, 'created_count' => $new, 'errors_count' => $errors, 'runtime' => $runtime,'data_checksum' => $data_checksum);
        SystemJob::updateOrCreate(['job_id' => $job_id],$array);
        $this->setIds();
    }

    private function setIds() {
        $arguments = $this->arguments();
        $job_id = UUID::v4();
        $time = Helpers::elapsedTime();
        $signature = $this->signature . " setIds";
        $client = new Client();
        $response = $client->get('http://www.badmintonpeople.dk/sportsresults/components/clubcomponents/clublistclientscript.aspx?unionid=1');
        $body = $response->getBody()->getContents();
        $data_checksum = mb_strlen($body, '8bit');
        $needle = 'var SportsResultsTeamList =';
        $pos = strpos($body, $needle);
        $pos += strlen($needle);

        $clubsStr = rtrim(trim(substr($body, $pos)), ';');
        $clubsStr = str_replace("'", '"', $clubsStr);
        $clubs = json_decode($clubsStr, true);
        $i = 0;
        $old = 0;
        $new = 0;
        $errors = 0;
        foreach ($clubs AS $clubPair){
            $cName = str_replace("–","-",$clubPair[0]);
            $club = BpClub::where('team_name', $cName)->first();
            if($club == null){
                $this->error($clubPair[1].' '.$clubPair[0]);
                $errors++;
            } else {
                $club->club_id = $clubPair[1];
                $old++;
                $club->save();
                $this->info($clubPair[1] . " associated with: " . $clubPair[0]);
            }
        }
        $runtime = $time->elapsed();
        $array = array('status'=>'completed','command' => $arguments["command"] ." (setIds)",'updated_count' => $old, 'created_count' => $new, 'errors_count' => $errors, 'runtime' => $runtime,'data_checksum' => $data_checksum);
        SystemJob::updateOrCreate(['job_id' => $job_id],$array);
        $this->info(dd($array));
    }

}
