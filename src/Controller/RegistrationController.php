<?php
namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'register')]
    public function register(Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RegisterFormType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            // Check if the user already exists
            $existingUser = $entityManager->getRepository(User::class)->findOneBy(['email' => $user->getEmail()]);

            if (!empty($existingUser)) {
                $this->addFlash('error', 'Uživatel s tímto emailem již existuje.');
            } else {
                $entityManager->persist($user);
                $entityManager->flush();
            }

            //TODO: Add a flash message and redirect to home page (oh and don't forget to make one!)
            $this->addFlash('success', 'Registrace proběhla úspěšně. Nyní se můžete přihlásit.');

            return $this->redirectToRoute('App\Controller\RegistrationController::register');
        }

        return $this->render('register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
