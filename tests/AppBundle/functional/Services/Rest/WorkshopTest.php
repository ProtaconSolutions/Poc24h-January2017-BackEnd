<?php
declare(strict_types = 1);
/**
 * /tests/AppBundle/functional/Services/Rest/WorkshopTest.php
 *
 * @author  TLe, Tarmo Leppänen <tarmo.leppanen@protacon.com>
 */
namespace AppBundle\functional\Services\Rest;

use App\Entity\Workshop as WorkshopEntity;
use App\Repository\Workshop as WorkshopRepository;
use App\Services\Rest\Workshop as WorkshopService;
use App\Tests\RestServiceTestCase;

/**
 * Class WorkshopTest
 *
 * @package AppBundle\functional\Services\Rest
 * @author  TLe, Tarmo Leppänen <tarmo.leppanen@protacon.com>
 */
class WorkshopTest extends RestServiceTestCase
{
    /**
     * @var WorkshopService
     */
    protected $service;

    /**
     * @var string
     */
    protected $serviceName = 'app.services.rest.workshop';

    /**
     * @var string
     */
    protected $entityName = WorkshopEntity::class;

    /**
     * @var string
     */
    protected $repositoryName = WorkshopRepository::class;

    /**
     * {@inheritdoc}
     */
    protected $entityCount = false;
}
