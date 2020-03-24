<?php

namespace AddressBookBundle\Controller;

use AddressBookBundle\Entity\Contact;
use AddressBookBundle\Entity\Phone;
use AddressBookBundle\Form\ContactFormType;
use AddressBookBundle\Repository\ContactRepository;
use AddressBookBundle\Services\ContactService;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\OptimisticLockException;
use Exception;
use InvalidArgumentException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DefaultController
 *
 * @package AddressBookBundle\Controller
 */
class DefaultController extends Controller
{
    /** @var ContactService $contactService */
    protected $contactService;

    /** @var ContactRepository $contactRepository */
    protected $contactRepository;

    /**
     * DefaultController constructor.
     *
     * @param ContactService    $contactService
     * @param ContactRepository $contactRepository
     */
    public function __construct(
        ContactService $contactService,
        ContactRepository $contactRepository

    ) {
        $this->contactService = $contactService;
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
     *
     * @return array|RedirectResponse
     * @throws NonUniqueResultException
     * @throws OptimisticLockException
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
                $file = $form->get('picture')->getData();
                $pictureName = md5(uniqid()).'.'.$file->guessExtension();
                $file->move(
                    $this->getParameter("upload_path"),
                    $pictureName
                );
                $contact->setPicture($pictureName);
                $this->contactService->saveContact($contact, $form);
                $this->addFlash('success', 'Contact added successFully! ');

                return $this->redirect($this->generateUrl('home'));
            } catch (InvalidArgumentException $exception) {
                $this->addFlash('error', 'Argument invalid or null '. $exception);
            }
        }
        return [
            'form' => $form->createView(),
        ];
    }

    /**
     * @param Contact $contact
     * @param string  $action
     *
     * @return FormInterface
     */
    private function contactForm(Contact $contact, string $action)
    {
        return $this->createForm(ContactFormType::class, $contact, [
            'action' => $this->generateUrl($action, ['id' => $contact->getId()]),
            'method' => 'POST',
        ]);
    }

    /**
     * @param int $id
     * @Route("/{id}/delete-contact", name="delete-contact")
     *
     * @return RedirectResponse
     */
    public function deleteContact(int $id)
    {
        try {
            $this->contactService->deleteContact($id);
            $this->addFlash('success', 'Contact deleted successFully! ');
        } catch (Exception $exception) {
            $this->addFlash('error', 'Something went wrong when deleting contact');
        }

        return $this->redirect($this->generateUrl('home'));
    }

    /**
     * @param Request $request
     * @param int     $id
     * @Route("/{id}/edit-contact", name="edit-contact")
     * @Template()
     *
     * @return array|RedirectResponse
     * @throws NonUniqueResultException
     * @throws OptimisticLockException
     */
    public function editAction(Request $request, int $id)
    {
        /** @var Contact $contact */
        $contact     = $this->contactRepository->find($id);
        $pictureName = $contact->getPicture();
        $action      = $request->get('_route');
        $form        = $this->contactForm($contact, $action);
        $this->setContactFormData($form, $contact);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();
            try {
                $file = $form->get('picture')
                    ->getData();
                if ($file) {
                    $pictureName = md5(uniqid()).'.'.$file->guessExtension();
                    $file->move(
                        $this->getParameter("upload_path"),
                        $pictureName
                    );
                }
                $contact->setPicture($pictureName);
                $this->contactService->saveContact($contact, $form);
                $this->addFlash('success', 'Contact edited successFully! ');

                return $this->redirect($this->generateUrl('home'));
            } catch (InvalidArgumentException $exception) {
                $this->addFlash('error', 'Argument invalid or null '. $exception);
            }
        }

        return [
            'form' => $form->createView(),
        ];
    }

    /**
     * @param FormInterface $form
     * @param Contact       $contact
     */
    private function setContactFormData(FormInterface &$form, Contact $contact)
    {
        $address      = $contact->getAddress();
        $phones       = $contact->getPhones()->toArray();
        $phoneNumbers = [];
        $form->get('street')->setData($address->getStreet());
        $form->get('country')->setData($address->getCountry());
        $form->get('buildingNumber')->setData($address->getBuildingNumber());
        $form->get('city')->setData($address->getCity());
        /** @var Phone $phone */
        foreach ($phones as $phone) {
            $phoneNumbers[] = $phone->getCountryCode().$phone->getNumber();
        }
        $form->get('phones')->setData($phoneNumbers);
    }

}
