<?php
declare(strict_types = 1);
/**
 * /tests/AppBundle/integration/Controller/CarBrandControllerTest.php
 *
 * @author  TLe, Tarmo Leppänen <tarmo.leppanen@protacon.com>
 */
namespace AppBundle\integration\Controller;

use App\Controller\CarBrandController;
use App\Repository\CarBrand as CarBrandRepository;
use App\Services\Rest\CarBrand as CarBrandResourceService;
use App\Tests\RestControllerTestCase;

/**
 * Class CarBrandControllerTest
 *
 * @package AppBundle\functional\Controller
 * @author  TLe, Tarmo Leppänen <tarmo.leppanen@protacon.com>
 */
class CarBrandControllerTest extends RestControllerTestCase
{
    /**
     * @var string
     */
    protected static $controllerName = CarBrandController::class;

    /**
     * @var string
     */
    protected static $resourceServiceName = CarBrandResourceService::class;

    /**
     * @var string
     */
    protected static $repositoryName = CarBrandRepository::class;
}
