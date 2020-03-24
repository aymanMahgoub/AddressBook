<?php

namespace Tests\AddressBookBundle\Services;

use AddressBookBundle\Services\ContactService;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class ContactServiceTest extends TestCase
{

    /**
     * @expectedException  InvalidArgumentException
     */
    public function testDeleteInvalidContact()
    {
        /** @var ContactService $contactService */
        $contactService = $this->createMock(ContactService::class);
        $contactService->deleteContact(-1);
    }

}
