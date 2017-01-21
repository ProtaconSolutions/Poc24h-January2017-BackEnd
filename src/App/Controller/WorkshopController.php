<?php
declare(strict_types=1);
/**
 * /src/App/Controller/WorkshopController.php
 *
 * @author  TLe, Tarmo Leppänen <tarmo.leppanen@protacon.com>
 */
namespace App\Controller;

use App\Traits\Rest\Roles as RestAction;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class WorkshopController
 *
 * @Route(
 *      service="app.controller.workshop",
 *      path="/workshop",
 *  )
 *
 * @package App\Controller
 * @author  TLe, Tarmo Leppänen <tarmo.leppanen@protacon.com>
 */
class WorkshopController extends RestController
{
    // Traits
    use RestAction\Anon\Find;
    use RestAction\Anon\FindOne;
    use RestAction\Anon\Count;
    use RestAction\Anon\Ids;
    use RestAction\Admin\Create;
    use RestAction\Admin\Update;
    use RestAction\Admin\Delete;
}
