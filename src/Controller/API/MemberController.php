<?php
/**
 * Created by PhpStorm.
 * User: moula
 * Date: 18/08/2018
 * Time: 18:27.
 */

namespace App\Controller\API;

use App\Repository\MemberRepository;
use App\Service\Client\APIMemberManagement;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class MemberController.
 *
 * @Route("/api/members")
 */
class MemberController extends Controller
{
    /**
     * @var MemberRepository
     */
    private $memberRepository;
    /**
     * @var APIMemberManagement
     */
    private $apiMemberManagement;

    /**
     * MemberController constructor.
     *
     * @param MemberRepository $memberRepository
     */
    public function __construct(MemberRepository $memberRepository, APIMemberManagement $apiMemberManagement)
    {
        $this->memberRepository = $memberRepository;
        $this->apiMemberManagement = $apiMemberManagement;
    }

    /**
     * @Route(
     *     "/count",
     *     name="api_member_count",
     *     defaults={
     *          "#_api_resource_class"=Member::class,
     *          "_api_item_operation_name"="count",
     *          "_api_receive"=false
     *      }
     * )
     */
    public function count()
    {
        $membersCount = $this->memberRepository->count([]);

        return new JsonResponse(['membersCount' => $membersCount]);
    }

    /**
     * @Route(
     *     "/current",
     *     name="api_member_current",
     *     defaults={
     *          "_api_item_operation_name"="get_current",
     *          "_api_receive"=false
     *      }
     * )
     */
    public function current(Request $request)
    {
        return new JsonResponse($this->getUser());
    }

    /**
     * @Route(
     *     "/subscribe",
     *     name="api_member_subscribe",
     *     defaults={
     *          "_api_item_operation_name"="get_subscribe",
     *          "_api_receive"=false
     *      }
     * )
     */
    public function subscribe(Request $request)
    {
        $member = $this->apiMemberManagement->subscribe($request,);

        return new JsonResponse($this->getUser());
    }
}
