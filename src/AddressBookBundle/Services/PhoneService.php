<?php

namespace AddressBookBundle\Services;

use AddressBookBundle\Entity\Contact;
use AddressBookBundle\Entity\Phone;
use AddressBookBundle\Repository\PhoneRepository;
use InvalidArgumentException;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;


/**
 * Class PhoneService
 *
 * @package AddressBookBundle\Services
 */
class PhoneService
{
    /** @var PhoneRepository $phoneRepository */
    protected $phoneRepository;

    /** @var ValidatorInterface $validator */
    protected $validator;


    /**
     * PhoneService constructor.
     *
     * @param PhoneRepository    $phoneRepository
     * @param ValidatorInterface $validator
     */
    public function __construct(
        PhoneRepository $phoneRepository,
        ValidatorInterface $validator
    )
    {
        $this->phoneRepository = $phoneRepository;
        $this->validator       = $validator;
    }

    /**
     * @param Contact       $contact
     * @param FormInterface $form
     *
     * @return array
     */
    public function getContactPhones(Contact $contact, FormInterface $form)
    {
        /** @var Phone[] $phones */
        $phones        = $this->hydratephones($form);
        $phoneNumbers  = [];
        /** @var Phone $phone */
        foreach ($phones as $phone) {
            $phoneNumber = $this->phoneRepository->findOneBy([
                    'countryCode' => $phone->getCountryCode(),
                    'number'      => $phone->getNumber(),
                ]) ?? $phone;
            $phoneNumber->setContact($contact);
            $phoneNumbers[] = $phoneNumber;
        }

        $this->phoneRepository->persistPhoneNumbers($phoneNumbers);
        return $phoneNumbers;
    }

    /**
     * @param FormInterface $form
     *
     * @return array
     */
    private function hydratePhones(FormInterface $form)
    {
        $phoneNumbers = [];
        $phones = $form->get('phones')->getData();
        $phoneCounter = 0;
        foreach ($phones as $phone) {
            $phoneNumber = new Phone();
            $phoneNumber->setCountryCode($form['countryCode_'.$phoneCounter]->getData());
            $phoneNumber->setNumber($phone);
            $this->isValidPhoneNumber($phoneNumber);
            $phoneNumbers[] = $phoneNumber;
            $phoneCounter++;
        }

        return $phoneNumbers;
    }

    /**
     * @param Phone $phone
     */
    private function isValidPhoneNumber(Phone $phone)
    {
        $phoneErrors = $this->validator->validate($phone);
        $errors       = [];
        if ($phoneErrors->count() > 0) {
            /** @var ConstraintViolationInterface $phoneError */
            foreach ($phoneErrors as $phoneError) {
                $errors[] = [
                    "errorMessage"      => $phoneError->getMessage(),
                    "errorPropertyPath" => $phoneError->getPropertyPath(),
                ];
            }

            throw new InvalidArgumentException('Invalid Address: '.json_decode($errors));
        }
    }

}
