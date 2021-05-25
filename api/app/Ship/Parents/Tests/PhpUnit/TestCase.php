<?php
declare(strict_types=1);

namespace App\Ship\Parents\Tests\PhpUnit;

use Apiato\Core\Abstracts\Tests\PhpUnit\TestCase as AbstractTestCase;
use App\Containers\Authentication\Tests\Helper\TestAuthenticationHelperTrait;
use App\Containers\Enterprise\Tests\Traits\DeleteEnterprisesTrait;
use App\Containers\User\Tests\Traits\DeleteAllUsersTrait;
use App\Ship\Parents\Tests\Traits\EmptyResultAssertionsTrait;
use App\Ship\Parents\Tests\Traits\PositiveResultAssertionsTrait;
use Faker\Generator;
use Illuminate\Contracts\Console\Kernel as ApiatoConsoleKernel;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Testing\RefreshDatabaseState;

abstract class TestCase extends AbstractTestCase
{
    use DeleteEnterprisesTrait;
    use TestAuthenticationHelperTrait;
    use EmptyResultAssertionsTrait;
    use PositiveResultAssertionsTrait;
    use EmptyResultAssertionsTrait;
    use DeleteAllUsersTrait;

    protected const DEFAULT_STATUS_OK = 'ok';
    protected const OBJECTS = [
        'course' => 'Course',
        'test' => 'Test',
    ];

    protected string $token;

    public function setUp(): void
    {
        parent::setUp();
        $this->deleteEnterprises();
        $this->deleteAllUsers();
    }

    /**
     * Reset the test environment, after each test.
     */
    public function tearDown():void
    {
        parent::tearDown();
    }

    public function shouldRefreshDB():bool
    {
        return true;
    }

    /*
     * Refresh tables in test db
     * run migration, test seeds
     * */
    public function refreshTestDatabase():void
    {
        if ($this->shouldRefreshDB()) {
            $this->artisan('migrate:fresh');

            $this->artisan('db:seed', ['--class' => 'TestDatabaseSeeder']);

            RefreshDatabaseState::$migrated = true;
        }

        $this->app[ApiatoConsoleKernel::class]->setArtisan(null);
    }

    public function createApplication():Application
    {
        $this->baseUrl = env('API_FULL_URL'); // this reads the value from `phpunit.xml` during testing

        // override the default subDomain of the base URL when subDomain property is declared inside a test
        $this->overrideSubDomain();

        $app = require __DIR__ . '/../../../../../bootstrap/app.php';

        $app->make(ApiatoConsoleKernel::class)->bootstrap();

        // create instance of faker and make it available in all tests
        $this->faker = $app->make(Generator::class);

        config(['database.default' => env('TEST_DB_CONNECTION_NAME')]);

        return $app;
    }

    final public function getUri(string $path):string
    {
        return getenv('API_URL').$path;
    }

    public function getRandomInternalCode(string $codePrefix = null):string
    {
        if ($codePrefix === null) {
            $codePrefix = 'code';
        }
        return $codePrefix . random_int(1, 999999999);
    }

    final public function getRandomEnterpriseId():int
    {
        return random_int(1, 99999999);
    }
}
