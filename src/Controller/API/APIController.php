<?php
/**
 * Created by PhpStorm.
 * User: moula
 * Date: 18/08/2018
 * Time: 18:27.
 */

namespace App\Controller\API;

use stdClass;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ApiController.
 *
 * @Route("/api")
 */
class APIController extends Controller
{
    public function __construct()
    {
    }

    /**
     * @Route(
     *     "/books/call-to-action",
     *     name="api_call_to_action",
     *     defaults={
     *          "_api_item_operation_name"="count",
     *          "_api_receive"=false
     *      }
     * )
     *
     * @return JsonResponse
     */
    public function callToAction()
    {
        return new JsonResponse(
            [
                'actions' => [
                        'title' => 'Ouverture d\'une Nouvelle librairie',
                        'content' => 'Nous sommes heureux de vous annoncer l\'ouverture de notre nouvelle librairie.',
                        'link' => 'j\'y vais',
                    ],
            ]
        );
    }

    /**
     * @Route(
     *     "/services/info",
     *     name="api_service_info",
     *     defaults={
     *          "_api_item_operation_name"="count",
     *          "_api_receive"=false
     *      }
     * )
     *
     * @return JsonResponse
     */
    public function servicesInfo()
    {
        return new JsonResponse(
            [
                'status' => "success",
                'info' => [
                    'active' => true,
                    'taxt' => 1.1,
                    'currency' => "euro",
                    'currency' => "euro",
                ]
            ], 200
        );
    }

    /**
     * @Route(
     *     "/books/latest-posts",
     *     name="api_latest_posts",
     *     defaults={
     *          "_api_item_operation_name"="latest_posts",
     *          "_api_receive"=false
     *      }
     * )
     *
     * @return JsonResponse
     */
    public function latestPosts()
    {
        return new JsonResponse(
            [
                'posts' => [],
            ]
        );
    }

    /**
     * @Route(
     *     "/services/listFeaturedNews",
     *     name="api_featured_news",
     *     defaults={
     *          "_api_item_operation_name"="latest_posts",
     *          "_api_receive"=false
     *      }
     * )
     *
     * @return JsonResponse
     */
    public function featuredNews()
    {
        $news = [];

        $new = new stdClass();

        $new->id = 1;
        $new->title = 'title 1';
        $new->brief_content = 'brief content';
        $new->full_content = 'full content';
        $new->image = 'https://media.gibert.com/media/catalog/product/cache/9793e3cb2e3429cff6c2eb752d5a8af6/c/_/c_9781474908580-9781474908580_1.jpg';
        $new->draft = 0;
        $new->status = 'status';
        $new->created_at = '0000-00-00 00:00:00';
        $new->last_update = '0000-00-00 00:00:00';

        $news[] = $new;

        $new = new stdClass();

        $new->id = 2;
        $new->title = 'title 2';
        $new->brief_content = 'brief content';
        $new->full_content = 'full content';
        $new->image = 'https://media.gibert.com/media/catalog/product/cache/9793e3cb2e3429cff6c2eb752d5a8af6/c/_/c_9781474908580-9781474908580_1.jpg';
        $new->draft = 0;
        $new->status = 'status';
        $new->created_at = '0000-00-00 00:00:00';
        $new->last_update = '0000-00-00 00:00:00';

        $news[] = $new;

        $new = new stdClass();

        $new->id = 3;
        $new->title = 'title 3';
        $new->brief_content = 'brief content';
        $new->full_content = 'full content';
        $new->image = 'https://media.gibert.com/media/catalog/product/cache/9793e3cb2e3429cff6c2eb752d5a8af6/c/_/c_9781474908580-9781474908580_1.jpg';
        $new->draft = 0;
        $new->status = 'status';
        $new->created_at = '0000-00-00 00:00:00';
        $new->last_update = '0000-00-00 00:00:00';

        $news[] = $new;


        return new JsonResponse($news);
    }
}
