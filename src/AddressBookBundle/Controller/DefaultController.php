<?php

namespace AddressBookBundle\Controller;

use AddressBookBundle\Entity\Contact;
use AddressBookBundle\Form\ContactFormType;
use AddressBookBundle\Repository\ContactRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /** @var ContactRepository $contactRepository */
    protected $contactRepository;

    /**
     * DefaultController constructor.
     *
     * @param ContactRepository $contactRepository
     */
    public function __construct(ContactRepository $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    /**
     * @Route("/", name="home")
     * @Template()
     */
    public function indexAction()
    {
        $contacts = $this->contactRepository->findAll();

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
     */
    public function addAction(Request $request)
    {
        $contact = new Contact();
        $action  = $request->get('_route');
        $form    = $this->contactForm($contact, $action);

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
