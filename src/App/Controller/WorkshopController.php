<?php
declare(strict_types=1);
/**
 * /src/App/Controller/WorkshopController.php
 *
 * @author  TLe, Tarmo Leppänen <tarmo.leppanen@protacon.com>
 */
namespace App\Controller;

use App\Entity\CarBrand;
use App\Entity\ServiceType;
use App\Entity\Workshop;
use App\Services\Rest\Workshop as WorkshopService;
use App\Traits\Rest\Roles as RestAction;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class WorkshopController
 *
 * @Route(
 *      service="app.controller.workshop",
 *      path="/workshop",
 *  )
 *
 * @method WorkshopService getResourceService()
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

    /**
     * Method to attach car brand to specified workshop.
     *
     * @Route(
     *      "/car_brand/{workshop}/{carBrand}",
     *      requirements={
     *          "workshop" = "^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$",
     *          "carBrand" = "^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$",
     *      }
     *  )
     *
     * @Method({"POST"})
     *
     * @Security("has_role('ROLE_ADMIN')")
     *
     * @ParamConverter(
     *     "workshop",
     *     class="AppBundle:Workshop"
     *  )
     * @ParamConverter(
     *     "carBrand",
     *     class="AppBundle:CarBrand"
     *  )
     *
     * @throws  \Symfony\Component\HttpKernel\Exception\HttpException
     * @throws  \Symfony\Component\Validator\Exception\ValidatorException
     * @throws  \Doctrine\ORM\OptimisticLockException
     * @throws  \Doctrine\ORM\ORMInvalidArgumentException
     *
     * @param   Request     $request
     * @param   Workshop    $workshop
     * @param   CarBrand    $carBrand
     *
     * @return  \Symfony\Component\HttpFoundation\Response
     */
    public function attachCarBrand(Request $request, Workshop $workshop, CarBrand $carBrand)
    {
        // If car brand already has workshop use 200 otherwise 201
        $httpStatus = $workshop->getCarBrands()->contains($carBrand) ? 200 : 201;

        // Attach car brand
        $workshop->addCarBrand($carBrand);

        // Store entity
        $this->getResourceService()->save($workshop);

        return $this->getResponseService()->createResponse($request, $workshop, $httpStatus);
    }

    /**
     * Method to detach car brand from specified workshop.
     *
     * @Route(
     *      "/car_brand/{workshop}/{carBrand}",
     *      requirements={
     *          "workshop" = "^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$",
     *          "carBrand" = "^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$",
     *      }
     *  )
     *
     * @Method({"DELETE"})
     *
     * @Security("has_role('ROLE_ADMIN')")
     *
     * @ParamConverter(
     *     "workshop",
     *     class="AppBundle:Workshop"
     *  )
     * @ParamConverter(
     *     "carBrand",
     *     class="AppBundle:CarBrand"
     *  )
     *
     * @throws  \Symfony\Component\HttpKernel\Exception\HttpException
     * @throws  \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     * @throws  \Symfony\Component\Validator\Exception\ValidatorException
     * @throws  \Doctrine\ORM\OptimisticLockException
     * @throws  \Doctrine\ORM\ORMInvalidArgumentException
     *
     * @param   Request     $request
     * @param   Workshop    $workshop
     * @param   CarBrand    $carBrand
     *
     * @return  \Symfony\Component\HttpFoundation\Response
     */
    public function detachCarBrand(Request $request, Workshop $workshop, CarBrand $carBrand)
    {
        // Car brand does not have this workshop
        if (!$workshop->getCarBrands()->contains($carBrand)) {
            $message = sprintf(
                'Workshop \'%s\' does not have car brand \'%s\'.',
                $workshop->getName(),
                $carBrand->getName()
            );

            throw new NotFoundHttpException($message);
        }

        // Detach car brand
        $workshop->removeCarBrand($carBrand);

        // Store entity
        $this->getResourceService()->save($workshop);

        return $this->getResponseService()->createResponse($request, $workshop, 200);
    }

    /**
     * Method to attach service type to specified workshop.
     *
     * @Route(
     *      "/service_type/{workshop}/{serviceType}",
     *      requirements={
     *          "workshop" = "^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$",
     *          "serviceType" = "^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$",
     *      }
     *  )
     *
     * @Method({"POST"})
     *
     * @Security("has_role('ROLE_ADMIN')")
     *
     * @ParamConverter(
     *     "workshop",
     *     class="AppBundle:Workshop"
     *  )
     * @ParamConverter(
     *     "serviceType",
     *     class="AppBundle:ServiceType"
     *  )
     *
     * @throws  \Symfony\Component\HttpKernel\Exception\HttpException
     * @throws  \Symfony\Component\Validator\Exception\ValidatorException
     * @throws  \Doctrine\ORM\OptimisticLockException
     * @throws  \Doctrine\ORM\ORMInvalidArgumentException
     *
     * @param   Request     $request
     * @param   Workshop    $workshop
     * @param   ServiceType $serviceType
     *
     * @return  \Symfony\Component\HttpFoundation\Response
     */
    public function attachServiceType(Request $request, Workshop $workshop, ServiceType $serviceType)
    {
        // If car brand already has workshop use 200 otherwise 201
        $httpStatus = $workshop->getServiceTypes()->contains($serviceType) ? 200 : 201;

        // Attach service type
        $workshop->addServiceType($serviceType);

        // Store entity
        $this->getResourceService()->save($workshop);

        return $this->getResponseService()->createResponse($request, $workshop, $httpStatus);
    }

    /**
     * Method to detach service type from specified workshop.
     *
     * @Route(
     *      "/car_brand/{workshop}/{serviceType}",
     *      requirements={
     *          "workshop" = "^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$",
     *          "serviceType" = "^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$",
     *      }
     *  )
     *
     * @Method({"DELETE"})
     *
     * @Security("has_role('ROLE_ADMIN')")
     *
     * @ParamConverter(
     *     "workshop",
     *     class="AppBundle:Workshop"
     *  )
     * @ParamConverter(
     *     "serviceType",
     *     class="AppBundle:ServiceType"
     *  )
     *
     * @throws  \Symfony\Component\HttpKernel\Exception\HttpException
     * @throws  \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     * @throws  \Symfony\Component\Validator\Exception\ValidatorException
     * @throws  \Doctrine\ORM\OptimisticLockException
     * @throws  \Doctrine\ORM\ORMInvalidArgumentException
     *
     * @param   Request     $request
     * @param   Workshop    $workshop
     * @param   ServiceType $serviceType
     *
     * @return  \Symfony\Component\HttpFoundation\Response
     */
    public function detachServiceType(Request $request, Workshop $workshop, ServiceType $serviceType)
    {
        // Car brand does not have this workshop
        if (!$workshop->getServiceTypes()->contains($serviceType)) {
            $message = sprintf(
                'Workshop \'%s\' does not have service type \'%s\'.',
                $workshop->getName(),
                $serviceType->getName()
            );

            throw new NotFoundHttpException($message);
        }

        // Detach workshop to car brand
        $workshop->removeServiceType($serviceType);

        // Store car brand
        $this->getResourceService()->save($workshop);

        return $this->getResponseService()->createResponse($request, $workshop, 200);
    }

    /**
     * @Route("/cities")
     * @Route("/cities/")
     *
     * @Method({"GET"})
     *
     * @throws  \Symfony\Component\HttpKernel\Exception\HttpException
     *
     * @param   Request $request
     *
     * @return  \Symfony\Component\HttpFoundation\Response
     */
    public function cities(Request $request)
    {
        $cities = $this->getResourceService()->getRepository()->getCities();

        return $this->getResponseService()->createResponse($request, $cities, 200);
    }
}
