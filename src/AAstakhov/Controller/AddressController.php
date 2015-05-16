<?php

namespace AAstakhov\Controller;

/**
 * Controller for getting address data
 */
class AddressController
{
    private $addresses = [];

    function getAddressAction($requestParameters)
    {
        $this->rcd();
        $id = $requestParameters['id'];
        $address = $this->addresses[$id];
        return json_encode($address);
    }

    function rcd()
    {
        $file = fopen('example.csv', 'r');
        while (($line = fgetcsv($file)) !== FALSE) {
            $this->addresses[] = [
                'name' => $line[0],
                'phone' => $line[1],
                'street' => $line[2]
            ];
        }

        fclose($file);
    }
}