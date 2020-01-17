<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Mail\NotificationMail;
use Illuminate\Support\Facades\Mail;

use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Database;
use Carbon\Carbon;

use App\Models\Notification;
use App\Models\Project;

class every5Second extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'second:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check Firebase Data';

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
        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/nodemcu-test-2161a-f457b052328a.json');
        $firebase = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->withDatabaseUri('https://nodemcu-test-2161a.firebaseio.com/')
            ->createDatabase();

        $gasLimit          = $firebase->getReference('2C-F4-32-5D-E5-75/Automation/GasLimit')->getSnapshot()->getValue();
        $soilHumidityLimit = $firebase->getReference('2C-F4-32-5D-E5-75/Automation/SoilHumLimit')->getSnapshot()->getValue();
        $tempretureLimit   = $firebase->getReference('2C-F4-32-5D-E5-75/Automation/TempLimit')->getSnapshot()->getValue();        

        while (true) {
            $gasValue = last($firebase->getReference('2C-F4-32-5D-E5-75/Data/Gas')->getSnapshot()->getValue());
            if ($gasValue > $gasLimit) {
                $message = "gaz değeri olması gerekenden fazla olarak algılandı! Fan çalıştırıldı.";
                $this->createNotification($message, 'Gas');
            }

            $soilHumidityValue = last($firebase->getReference('2C-F4-32-5D-E5-75/Data/SoilHumidity')->getSnapshot()->getValue());
            if ($soilHumidityValue > $soilHumidityLimit) {
                $message = "toprak nemi değeri olması gerekenden fazla olarak algılandı! Su pompası çalıştırıldı.";
                $this->createNotification($message, 'SoilHumidity');
            }

            $tempratureValue = last($firebase->getReference('2C-F4-32-5D-E5-75/Data/Tempreture')->getSnapshot()->getValue());
            if ($tempratureValue > $tempretureLimit) {
                $message = "sıcaklık değeri olması gerekenden fazla olarak algılandı! Fan çalıştırıldı.";
                $this->createNotification($message, 'Tempreture');
            }

            $movementValue = last($firebase->getReference('2C-F4-32-5D-E5-75/Data/Movement')->getSnapshot()->getValue());
            if ($movementValue == 1) {
                $message = "bir hareket algılandı! Alarm çalıştırıldı.";
                $this->createNotification($message, 'Movement');
            }

            sleep(30);
        }
        
    }

    public function createNotification($notificationMessage, $inputType)
    {
        $info = array();
        $inputId = DB::table('inputs')->where('firebase_code', $inputType)->get()->first()->id;
        $projectAreaKitId = DB::table('project_area_kit')->where([
                ['mac_adress', '=', '2C-F4-32-5D-E5-75'],
                ['is_online', '=', '1'],
            ])->get()->first()->project_area_id; // get project_area id
        $projectArea = DB::table('project_area')->where('id', $projectAreaKitId)->get()->first(); // get project_area        
        $project = Project::find($projectArea->id)->get()->first(); // get project
        $customer =  $project->customer; // get customer        
        
        $notificationObject = new \stdClass();
        $notificationObject->customerName = $customer->first_name.' '.$customer->last_name;
        $notificationObject->customerId = $project->customer->id;
        $notificationObject->projectName = $project->name;
        $notificationObject->areaName = $projectArea->name;
        $notificationObject->message = $notificationObject->customerName.', '.$notificationObject->projectName.' projesi '.$notificationObject->areaName.' içinde '.$notificationMessage ;

        $lastOneHourNotificationCount = Notification::where([
            ['input_id', '=', $inputId],
            ['created_at', '>', Carbon::now()->subHour(1)],
        ])->get()->count();

        if($lastOneHourNotificationCount == 0) {
            Notification::create([
                'customer_id'  => $notificationObject->customerId,
                'input_id'     => $inputId,  
                'notification' => $notificationObject->message, 
            ]);

            Mail::to($customer->email)->send(new NotificationMail($notificationObject));

            echo "Notification created for ".$inputType;
        }
        else {
            echo "Notification did not created for ".$inputType;
        }
    }
}
