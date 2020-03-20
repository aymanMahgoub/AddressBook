<?php

namespace AddressBookBundle\Controller;

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
     * @Route("/", name="homepage")
     * @Template()
     */
    public function indexAction()
    {
        $contacts = $this->contactRepository->findAll();

        return [
            'contacts' => $contacts,
        ];
    }

}
