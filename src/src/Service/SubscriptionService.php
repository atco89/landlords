<?php

namespace App\Service;

use App\Repository\SubscriptionRepository;

class SubscriptionService
{

    public function __construct(
        private readonly SubscriptionRepository $subscriptionRepository,
    )
    {
    }

}