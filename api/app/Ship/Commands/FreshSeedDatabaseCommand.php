<?php


namespace App\Ship\Commands;


use App\Ship\Parents\Commands\ConsoleCommand;
use ClickHouseDB\Client;

class FreshSeedDatabaseCommand extends ConsoleCommand
{

  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'apiato:migrate:fresh {--seed}';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Fresh databases and seed data';

  /**
   * Create a new command instance.
   */
  public function __construct()
  {
    parent::__construct();
  }

  /**
   * Execute the console command.
   *
   * @return void
   */
  public function handle(Client $client)
  {
    foreach ($client->showTables() as $tableName => $value) {
      $client->write("DROP TABLE IF EXISTS $tableName");
    }
    $this->call("migrate:fresh", ['--seed' => $this->option('seed')]);
  }
}
