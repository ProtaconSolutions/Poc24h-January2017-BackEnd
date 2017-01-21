<?php
declare(strict_types = 1);
/**
 * /tests/AppBundle/integration/Controller/OfferControllerTest.php
 *
 * @author  TLe, Tarmo Leppänen <tarmo.leppanen@protacon.com>
 */
namespace AppBundle\integration\Controller;

use App\Controller\OfferController;
use App\Repository\Offer as OfferRepository;
use App\Services\Rest\Offer as OfferResourceService;
use App\Tests\RestControllerTestCase;

/**
 * Class OfferControllerTest
 *
 * @package AppBundle\functional\Controller
 * @author  TLe, Tarmo Leppänen <tarmo.leppanen@protacon.com>
 */
class OfferControllerTest extends RestControllerTestCase
{
    /**
     * @var string
     */
    protected static $controllerName = OfferController::class;

    /**
     * @var string
     */
    protected static $resourceServiceName = OfferResourceService::class;

    /**
     * @var string
     */
    protected static $repositoryName = OfferRepository::class;
}
