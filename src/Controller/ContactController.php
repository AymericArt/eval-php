<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request as Request;

class ContactController extends AbstractController
{

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @Route("/contact", name="contact")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function contact(Request $request, \Swift_Mailer $mailer) {

        $local = $request->getLocale();
        $form = $this->createFormBuilder()
        ->add('language', ChoiceType::class, [
            'choices' => [
                'EN' => 'en',
                'FR' => 'fr'
            ],
            'data' => $local,
            'label' => false
        ])
        ->getForm();

        $contactForm = $this->createForm(ContactFormType::class);
        $contactForm->handleRequest($request);

        if ($contactForm->isSubmitted()) {
            if ($contactForm->isValid() && $contactForm->getData()['hiddenInput'] === null) {
                $contact = new Contact();

                $contact->setEmail($contactForm->getData()['email']);
                $contact->setName($contactForm->getData()['name']);
                $contact->setContent($contactForm->getData()['content']);
                $contact->setDate(new \DateTime());
                $contact->setStatus(false);

                $this->em->persist($contact);
                $this->em->flush();

                $messageFromClient = (new \Swift_Message('Hello'))
                    ->setFrom($contact->getEmail())
                    ->setTo('aa99518@live.fr')
                    ->setBody(
                        $this->renderView(
                            'mail/fromClient.html.twig',
                            ['contact' => $contact]
                        ),
                        'text/html'
                    )
                ;

                $messageToClient = (new \Swift_Message('Hello'))
                    ->setFrom('aa99518@live.fr')
                    ->setTo($contact->getEmail())
                    ->setBody(
                        $this->renderView(
                            'mail/toClient.html.twig',
                            []

                        ),
                        'text/html'
                    )
                ;

                try {
                    $mailer->send($messageFromClient);
                    $mailer->send($messageToClient);

                    return $this->render('main/contactValidate.html.twig', [
                        'local'       => $local,
                        'contactForm' => $contactForm->createView()
                    ]);

                } catch (\Swift_TransportException $e) {
                    echo $e->getMessage();
                }
            }
        }

        return $this->render('main/contact.html.twig', [
            'local'       => $local,
            'form'        => $form->createView(),
            'contactForm' => $contactForm->createView()
        ]);
    }

}