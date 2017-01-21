<?php
declare(strict_types = 1);
/**
 * /tests/AppBundle/integration/Entity/WorkshopTest.php
 *
 * @author  TLe, Tarmo Leppänen <tarmo.leppanen@protacon.com>
 */
namespace AppBundle\integration\Entity;

use App\Entity\Workshop;
use App\Tests\EntityTestCase;

/**
 * Class WorkshopTest
 *
 * @package AppBundle\integration\Entity
 * @author  TLe, Tarmo Leppänen <tarmo.leppanen@protacon.com>
 */
class WorkshopTest extends EntityTestCase
{
    /**
     * @var Workshop
     */
    protected $entity;

    /**
     * @var string
     */
    protected $entityName = Workshop::class;
}
