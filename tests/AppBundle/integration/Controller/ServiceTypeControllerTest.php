<?php
declare(strict_types = 1);
/**
 * /tests/AppBundle/integration/Controller/ServiceTypeControllerTest.php
 *
 * @author  TLe, Tarmo Leppänen <tarmo.leppanen@protacon.com>
 */
namespace AppBundle\integration\Controller;

use App\Controller\ServiceTypeController;
use App\Repository\ServiceType as ServiceTypeRepository;
use App\Services\Rest\ServiceType as ServiceTypeResourceService;
use App\Tests\RestControllerTestCase;

/**
 * Class ServiceTypeControllerTest
 *
 * @package AppBundle\functional\Controller
 * @author  TLe, Tarmo Leppänen <tarmo.leppanen@protacon.com>
 */
class ServiceTypeControllerTest extends RestControllerTestCase
{
    /**
     * @var string
     */
    protected static $controllerName = ServiceTypeController::class;

    /**
     * @var string
     */
    protected static $resourceServiceName = ServiceTypeResourceService::class;

    /**
     * @var string
     */
    protected static $repositoryName = ServiceTypeRepository::class;
}
