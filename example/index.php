<?php

        $config = array(
            "login" => '6dd490faf9cb87a9862245da41170ff2',
            "tran_key" => '024h1IlD'
        );

        $ptp = new \PlaceToPay\SDK_PtP\SDK_PtP($config);
        $banks = $ptp->getBankList();
        var_dump($banks);