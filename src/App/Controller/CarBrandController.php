<?php
declare(strict_types=1);
/**
 * /src/App/Controller/CarBrandController.php
 *
 * @author  TLe, Tarmo Leppänen <tarmo.leppanen@protacon.com>
 */
namespace App\Controller;

use App\Traits\Rest\Roles as RestAction;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class CarBrandController
 *
 * @Route(
 *      service="app.controller.car_brand",
 *      path="/car_brand",
 *  )
 *
 * @package App\Controller
 * @author  TLe, Tarmo Leppänen <tarmo.leppanen@protacon.com>
 */
class CarBrandController extends RestController
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
