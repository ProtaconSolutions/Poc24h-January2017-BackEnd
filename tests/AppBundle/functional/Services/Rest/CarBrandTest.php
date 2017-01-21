<?php
declare(strict_types = 1);
/**
 * /tests/AppBundle/functional/Services/Rest/CarBrandTest.php
 *
 * @author  TLe, Tarmo Leppänen <tarmo.leppanen@protacon.com>
 */
namespace AppBundle\functional\Services\Rest;

use App\Entity\CarBrand as CarBrandEntity;
use App\Repository\CarBrand as CarBrandRepository;
use App\Services\Rest\CarBrand as CarBrandService;
use App\Tests\RestServiceTestCase;

/**
 * Class CarBrandTest
 *
 * @package AppBundle\functional\Services\Rest
 * @author  TLe, Tarmo Leppänen <tarmo.leppanen@protacon.com>
 */
class CarBrandTest extends RestServiceTestCase
{
    /**
     * @var CarBrandService
     */
    protected $service;

    /**
     * @var string
     */
    protected $serviceName = 'app.services.rest.car_brand';

    /**
     * @var string
     */
    protected $entityName = CarBrandEntity::class;

    /**
     * @var string
     */
    protected $repositoryName = CarBrandRepository::class;

    /**
     * {@inheritdoc}
     */
    protected $entityCount = false;
}
