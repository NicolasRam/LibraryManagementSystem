<?php
/**
 * Created by PhpStorm.
 * User: moulaye
 * Date: 24/07/18
 * Time: 11:22
 */

namespace App\Controller;


use App\Form\UserLoginType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UserController extends Controller
{
    /**
     * connection
     *
     * @Route(
     *     {
     *          "fr": "/connexion",
     *          "en": "/login"
     *      },
     *     name="user_login"
     * )
     *
     * @param Request             $request
     * @param AuthenticationUtils $authenticationUtils
     *
     * @return Response
     */
    public function login(Request $request, AuthenticationUtils $authenticationUtils)
    {
        /**
         * If user is login and is granted permissions go to home page
         *
         * @Todo add home controller
         * @Todo add permission check
         */
        if ($this->getUser()) {
            return $this->redirectToRoute('home');
        }

        /**
         * Retrieve user login form
         */
        $form = $this->createForm(UserLoginType::class, ['email' => $authenticationUtils->getLastUsername()]);

        /**
         * Get error message
         */
        $error = $authenticationUtils->getLastAuthenticationError();

        return $this->render('user/login.html.twig',
            [
                'form' => $form->createView(),
                'error' => $error,
            ]
        );
    }

    /**
     * @Route({
     *     "fr": "/deconnexion",
     *     "en": "/logout"
     * }, name="security_logout")
     */
    public function logout()
    {
    }

}