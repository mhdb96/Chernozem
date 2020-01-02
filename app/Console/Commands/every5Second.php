<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Request;

use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Database;

use App\Models\Category;

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
        while(1) {

        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/nodemcu-test-2161a-f457b052328a.json');
        $firebase = (new Factory)
        ->withServiceAccount($serviceAccount)
        ->withDatabaseUri('https://nodemcu-test-2161a.firebaseio.com/')
        ->createDatabase();     
        $reference = $firebase->getReference('2C-F4-32-5D-E5-75/Data/Gas');
        $snapshot = $reference->getSnapshot();
        $value = $snapshot->getValue();                                
        $last = last($value);        
        if($last['value'] > 200) {            
            $firebase->getReference('2C-F4-32-5D-E5-75/Setters/Fan')->set(1);
        }
        else {
            $firebase->getReference('2C-F4-32-5D-E5-75/Setters/Fan')->set(0);
        }
        $reference = $firebase->getReference('2C-F4-32-5D-E5-75/Data/SoilHumidity');
        $snapshot = $reference->getSnapshot();
        $value = $snapshot->getValue();                                
        $last = last($value);        
        if($last['value'] < 500 && $last['value'] != 0) {            
            $firebase->getReference('2C-F4-32-5D-E5-75/Setters/Pump')->set(0);
        }
        else {
            $firebase->getReference('2C-F4-32-5D-E5-75/Setters/Pump')->set(1);
        }
        sleep(3);
        }
        
    }
}
