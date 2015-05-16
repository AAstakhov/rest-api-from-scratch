<?php

namespace AAstakhov\Controller;

/**
 * Controller for getting address data
 */
class AddressController
{
    /**
     * @var array
     */
    private $addresses = [];

    public function getAddressAction($requestParameters)
    {
        $this->fetchAddressesFromFile();
        $id = $requestParameters['id'];
        $address = $this->addresses[$id];
        return json_encode($address);
    }

    private function fetchAddressesFromFile()
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