<?php
declare(strict_types = 1);
/**
 * /tests/AppBundle/functional/Services/Rest/ServiceTypeTest.php
 *
 * @author  TLe, Tarmo Leppänen <tarmo.leppanen@protacon.com>
 */
namespace AppBundle\functional\Services\Rest;

use App\Entity\ServiceType as ServiceTypeEntity;
use App\Repository\ServiceType as ServiceTypeRepository;
use App\Services\Rest\ServiceType as ServiceTypeService;
use App\Tests\RestServiceTestCase;

/**
 * Class ServiceTypeTest
 *
 * @package AppBundle\functional\Services\Rest
 * @author  TLe, Tarmo Leppänen <tarmo.leppanen@protacon.com>
 */
class ServiceTypeTest extends RestServiceTestCase
{
    /**
     * @var ServiceTypeService
     */
    protected $service;

    /**
     * @var string
     */
    protected $serviceName = 'app.services.rest.service_type';

    /**
     * @var string
     */
    protected $entityName = ServiceTypeEntity::class;

    /**
     * @var string
     */
    protected $repositoryName = ServiceTypeRepository::class;

    /**
     * {@inheritdoc}
     */
    protected $entityCount = false;
}
