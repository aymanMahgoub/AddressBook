<?php

namespace AddressBookBundle\Controller;

use AddressBookBundle\Entity\Contact;
use AddressBookBundle\Form\ContactFormType;
use AddressBookBundle\Services\ContactService;
use Doctrine\ORM\NonUniqueResultException;
use InvalidArgumentException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /** @var ContactService $contactService */
    protected $contactService;

    /**
     * DefaultController constructor.
     *
     * @param ContactService $contactService
     */
    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }

    /**
     * @Route("/", name="home")
     * @Template()
     */
    public function indexAction()
    {
        $contacts = $this->contactService->getAllContacts();

        return [
            'contacts' => $contacts,
        ];
    }

    /**
     * @param Request $request
     * @Route("/new-contact", name="create_new_contact")
     * @Template()
     *
     * @return array
     * @throws NonUniqueResultException
     */
    public function addAction(Request $request)
    {
        $contact = new Contact();
        $action  = $request->get('_route');
        $form    = $this->contactForm($contact, $action);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();
            try {
                $this->contactService->saveContact($contact, $request);
            } catch (InvalidArgumentException $exception) {
               dump('Invalid');die;
            }
        }
        return [
            'form' => $form->createView(),
        ];
    }

    private function contactForm(Contact $contact, string $action)
    {
        return $this->createForm(ContactFormType::class, $contact, [
            'action' => $this->generateUrl($action, ['id' => $contact->getId()]),
            'method' => 'POST',
        ]);
    }

}
