<?php

namespace App\vStack\Commands;

use Illuminate\Console\Command;

class createResource extends Command
{
    protected $signature = 'vstack:make-resource {resource} {table}';
    public function __construct()
    {
        parent::__construct();
    }
    public function handle()
    {
        $data = $this->arguments();
        $resource = $data["resource"];
        $table = @$data["table"] ? $data["table"] : $resource;
        $totalSteps = 2;
        $bar = $this->output->createProgressBar($totalSteps);
        $this->createModel($bar, $resource, $table);
        $this->createResource($bar, $resource, $table);
        $bar->finish();
    }

    private function createResource($bar, $resource, $table)
    {
        $bar->start();
        $dir = app_path("\\Http\\Resources");
        $resource_path = $dir . "\\" . $resource . ".php";
        $content =
            '<?php
namespace App\Http\Resources;
use App\vStack\Resource;
class ' . $resource . ' extends Resource
{
    public $model = "App\Http\Models\\' . $resource . '";
}';
        $dir = app_path("\\Http\\Models");
        file_put_contents($resource_path, $content);
        $bar->advance();
        echo "\ncreated resource $resource_path.php\n";
    }

    private function createModel($bar, $resource, $table)
    {
        $bar->start();
        $dir = app_path("\\Http\\Models");
        $model_path = $dir . "\\" . $resource . ".php";
        $content =
            '<?php
namespace App\Http\Models;
use App\vStack\Models\DefaultModel;
class ' . $resource . ' extends DefaultModel
{
    protected $table = "' . $table . '";
    // public $cascadeDeletes = [];
    // public $restrictDeletes = [];
}';
        $this->makeDir($dir);
        file_put_contents($model_path, $content);
        $bar->advance();
        echo "\ncreated model $model_path.php\n";
    }

    private function makeDir($dir)
    {
        if (!is_dir($dir)) mkdir($dir, 777, true);
    }
}
