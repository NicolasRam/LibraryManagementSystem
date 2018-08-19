<?php
/**
 * Created by PhpStorm.
 * User: moula
 * Date: 18/08/2018
 * Time: 18:27
 */

namespace App\Controller\API;

use App\Repository\MemberRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class MemberController
 * @package App\Controller\API
 *
 * @Route("/api/members")
 */
class MemberController extends Controller
{
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
    public function count( MemberRepository $memberRepository )
    {
        $membersCount = $memberRepository->count([]);

        return new JsonResponse( [ 'membersCount' => $membersCount ] );
    }
}