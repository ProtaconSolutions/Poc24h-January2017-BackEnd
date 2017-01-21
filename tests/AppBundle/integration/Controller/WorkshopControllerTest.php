<?php
declare(strict_types = 1);
/**
 * /tests/AppBundle/integration/Controller/WorkshopControllerTest.php
 *
 * @author  TLe, Tarmo Leppänen <tarmo.leppanen@protacon.com>
 */
namespace AppBundle\integration\Controller;

use App\Controller\WorkshopController;
use App\Repository\Workshop as WorkshopRepository;
use App\Services\Rest\Workshop as WorkshopResourceService;
use App\Tests\RestControllerTestCase;

/**
 * Class WorkshopControllerTest
 *
 * @package AppBundle\functional\Controller
 * @author  TLe, Tarmo Leppänen <tarmo.leppanen@protacon.com>
 */
class WorkshopControllerTest extends RestControllerTestCase
{
    /**
     * @var string
     */
    protected static $controllerName = WorkshopController::class;

    /**
     * @var string
     */
    protected static $resourceServiceName = WorkshopResourceService::class;

    /**
     * @var string
     */
    protected static $repositoryName = WorkshopRepository::class;
}
