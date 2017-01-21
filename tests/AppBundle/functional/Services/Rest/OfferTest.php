<?php
declare(strict_types = 1);
/**
 * /tests/AppBundle/functional/Services/Rest/OfferTest.php
 *
 * @author  TLe, Tarmo Leppänen <tarmo.leppanen@protacon.com>
 */
namespace AppBundle\functional\Services\Rest;

use App\Entity\Offer as OfferEntity;
use App\Repository\Offer as OfferRepository;
use App\Services\Rest\Offer as OfferService;
use App\Tests\RestServiceTestCase;

/**
 * Class OfferTest
 *
 * @package AppBundle\functional\Services\Rest
 * @author  TLe, Tarmo Leppänen <tarmo.leppanen@protacon.com>
 */
class OfferTest extends RestServiceTestCase
{
    /**
     * @var OfferService
     */
    protected $service;

    /**
     * @var string
     */
    protected $serviceName = 'app.services.rest.offer';

    /**
     * @var string
     */
    protected $entityName = OfferEntity::class;

    /**
     * @var string
     */
    protected $repositoryName = OfferRepository::class;

    /**
     * {@inheritdoc}
     */
    protected $entityCount = false;
}
