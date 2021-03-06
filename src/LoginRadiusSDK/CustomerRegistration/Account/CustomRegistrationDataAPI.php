<?php

/**
 * @link                : http://www.loginradius.com
 * @category            : CustomerRegistration
 * @package             : CustomRegistrationDataAPI
 * @author              : LoginRadius Team
 * @license             : https://opensource.org/licenses/MIT
 */

namespace LoginRadiusSDK\CustomerRegistration\Account;

use LoginRadiusSDK\Utility\Functions;

/**
 * Custom Registration Data API
 *
 * This is the main class to communicate with LoginRadius Customer Registration Data API.
 */
class CustomRegistrationDataAPI {

    /**
     *
     * @param type $apikey
     * @param type $apisecret
     * @param type $options
     */
    public function __construct($apikey = '', $apisecret = '', $options = array()) {
        new Functions($apikey, $apisecret, $options);
    }

    /**
     * This API is create account.
     *
     * @param json $data
     * @return type
     * {
     * "Data": [
     *  {
     * "type": "",
     * "key": "",
     * "value": "",
     * "parentid": "",
     *  "code": "",
     *  "isactive": true
     *  }
     *  ]     
     * }
     */
    public function addRegistrationData($data, $fields = '*') {
        return $this->apiClientHandler("registrationdata", array('fields' => $fields), array('method' => 'POST', 'post_data' => $data, 'content_type' => 'json'));
    }

    /**
     * This API is used to retrieve dropdown data.
     *
     * @param $type  
     * @param string $parentid    
     * @param string $skip    
     * @param string $limit    
     * @return type json object
     */
    public function getRegistrationData($type, $parent_id = '', $skip = '', $limit = '', $fields = '*') {
        return $this->apiClientHandler("registrationdata/" . $type, array('parentid' => $parent_id, 'skip' => $skip, 'limit' => $limit, 'fields' => $fields));
    }

    /**
     * This API allows you to update member of dropDown.
     * @param $recordid 
     * {
     * "IsActive": true,
     * "Type": "",
     * "Key": "",
     * "Value": "",
     * "ParentId": "",
     * "Code": ""
     * }
     *
     * return type
     */
    public function updateRegistrationData($recordid, $data, $fields = '*') {
        return $this->apiClientHandler("registrationdata/" . $recordid, array('fields' => $fields), array('method' => 'PUT', 'post_data' => $data, 'content_type' => 'json'));
    }

    /**
     * This API allows you to delete a member from dropDownList.
     * @param $record_id    
     *
     * return {"IsDeleted": "true"}
     */
    public function deleteRegistrationData($record_id, $fields = '*') {
        return $this->apiClientHandler('registrationdata/' . $record_id, array('fields' => $fields), array('method' => 'DELETE', 'post_data' => true));
    }

    /**
     * handle account APIs
     *
     * @param type $path
     * @param type $query_array
     * @param type $options
     * @return type
     */
    private function apiClientHandler($path, $query_array = array(), $options = array()) {
        return Functions::apiClient("/identity/v2/manage/" . $path, $query_array, array_merge(array('authentication' => 'secret'), $options));
    }

}
