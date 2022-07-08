<?php

namespace App\Http\Controllers;

use HubSpot\Factory;
use HubSpot\Client\Crm\Companies\ApiException;

class HubspotController extends Controller
{
    public function index()
    {
        ini_set('max_execution_time', 180);
        $client = Factory::createWithApiKey("c56639c1-1983-4523-9a62-f4a0fe22e6ab");
        $loopDataCompanies = true;
        $loopDataContacts = true;

        $apiResponseCompanies = null;
        $apiResponseContacts = null;
        $companiesList = [];
        $contactsList = [];

        $filterCompany = new \HubSpot\Client\Crm\Companies\Model\Filter();
        $filterCompany
            ->setOperator('GTE')
            ->setPropertyName('createdate')
            ->setValue('1623196801');

        $filterGroupfilterCompany = new \HubSpot\Client\Crm\Companies\Model\FilterGroup();
        $filterGroupfilterCompany
            ->setFilters([$filterCompany]);

        $searchRequestCompanies = new \HubSpot\Client\Crm\Companies\Model\PublicObjectSearchRequest();
        $searchRequestCompanies
            ->setFilterGroups([$filterGroupfilterCompany])
            ->setLimit(100) // L'api limite le nombre de résultats maximal par requete à 100.
            ->setProperties(["name", "country", "city", "domain", "industry", "phone", "zip", "numberofemployees", "phone;"]);

        // Si il existe plus de 100 résultats, passage à la page suivante pour récuperer le tout
        while ($loopDataCompanies) {
            try {
                $apiResponseCompanies = $client->crm()->companies()->searchApi()->doSearch($searchRequestCompanies);
                if (!empty($apiResponseCompanies['paging'])) {
                    $searchRequestCompanies->setAfter($apiResponseCompanies['paging']['next']['after']);
                } else {
                    $loopDataCompanies = false;
                }
                array_push($companiesList, $apiResponseCompanies['results']);
            } catch (ApiException $e) {
                echo "Exception when calling search_api->do_search: ", $e->getMessage();
            }
        }

        $companiesList = call_user_func_array('array_merge', $companiesList);

        // dd($companiesList);
        // sleep(1);
        foreach ($companiesList as $value) {
            for ($i = 1; $i <= 10; $i++) {
                // $companyId = $value['id'];

                $filterContact = new \HubSpot\Client\Crm\Contacts\Model\Filter();
                $filterContact
                    ->setOperator('EQ')
                    ->setPropertyName('company')
                    ->setValue('hubspot');

                $filterGroupfilterContact = new \HubSpot\Client\Crm\Contacts\Model\FilterGroup();
                $filterGroupfilterContact
                    ->setFilters([$filterContact]);

                $searchRequestContacts = new \HubSpot\Client\Crm\Contacts\Model\PublicObjectSearchRequest();
                $searchRequestContacts
                    ->setFilterGroups([$filterGroupfilterContact])
                    ->setLimit(100)
                    ->setProperties(["company", "associatedcompanyid", "email",]);

                while ($loopDataContacts) {
                    for ($v = 1; $v <= 1; $v++) {
                        try {
                            $apiResponseContacts = $client->crm()->contacts()->searchApi()->doSearch($searchRequestContacts);
                            if (!empty($apiResponseContacts['paging'])) {
                                $searchRequestContacts->setAfter($apiResponseContacts['paging']['next']['after']);
                            } else {
                                $loopDataContacts = false;
                            }
                            // foreach ($apiResponseContacts['results'] as $contact) {
                            //     $contact->companyid = $companyId;
                            // }

                            array_push($contactsList, $apiResponseContacts['results']);
                        } catch (ApiException $e) {
                            echo "Exception when calling search_api->do_search: ", $e->getMessage();
                        }
                    }
                    // sleep(2);
                }
            }
            // sleep(2);
        }

        return view('hubspot', [
            'response' => $contactsList
        ]);
    }

    // public static function addCompanyId(Model\SimplePublicObject $contact, int $companyId)
    // {
    //     array_push($contact, ['companyid' => $companyId]);
    // }
}
