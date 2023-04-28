<?php

namespace App\Controller\Frontend;

use App\Repository\ContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    public function __construct(
        private readonly ContactRepository $contactRepository
    ) {
    }
}
