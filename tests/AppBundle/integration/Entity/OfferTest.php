<?php
declare(strict_types = 1);
/**
 * /tests/AppBundle/integration/Entity/OfferTest.php
 *
 * @author  TLe, Tarmo Leppänen <tarmo.leppanen@protacon.com>
 */
namespace AppBundle\integration\Entity;

use App\Entity\Offer;
use App\Tests\EntityTestCase;

/**
 * Class OfferTest
 *
 * @package AppBundle\integration\Entity
 * @author  TLe, Tarmo Leppänen <tarmo.leppanen@protacon.com>
 */
class OfferTest extends EntityTestCase
{
    /**
     * @var Offer
     */
    protected $entity;

    /**
     * @var string
     */
    protected $entityName = Offer::class;
}
