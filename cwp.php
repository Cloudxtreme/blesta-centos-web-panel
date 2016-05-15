<?php

/**
 * Centos Web Panel Module
 *
 * @package blesta
 * @subpackage blesta.components.modules.Cwp
 * @copyright César Araujo @ Virtual2.
 * @license http://www.blesta.com/license/ The Blesta License Agreement
 * @link http://www.virtual2.net/ Virtual2
 */
class Cwp extends Module
{

    /**
     * @var string The version of this module
     */
    private static $version = "1.0.0";
    /**
     * @var string The authors of this module
     */
    private static $authors = array(array('name' => "César Araújo @ Virtual2", 'url' => "http://www.virtual2.net"));

    /**
     * Initializes the module
     */
    public function __construct()
    {

        // Load components required by this module
        Loader::loadComponents($this, array("Input"));

        // Load the language required by this module
        Language::loadLang("Cwp", null, dirname(__FILE__) . DS . "language" . DS);

        // Load the config
        //$this->loadConfig(dirname(__FILE__) . DS . "config.json");

        Configure::errorReporting(E_ALL);
    }

    /**
     * Returns the name of this module
     *
     * @return string The common name of this module
     */
    public function getName()
    {
        return Language::_("Cwp.name", true);
    }

    /**
     * Returns the version of this gateway
     *
     * @return string The current version of this gateway
     */
    public function getVersion()
    {
        return self::$version;
    }

    /**
     * Returns the name and url of the authors of this module
     *
     * @return array The name and url of the authors of this module
     */
    public function getAuthors()
    {
        return self::$authors;
    }

    /**
     * Returns all tabs to display to an admin when managing a service whose
     * package uses this module
     *
     * @param stdClass $package A stdClass object representing the selected package
     * @return array An array of tabs in the format of method => title. Example: array('methodName' => "Title", 'methodName2' => "Title2")
     */
    public function getAdminTabs($package)
    {
        return array(
            'tabStats' => Language::_("Cwp_stats", true)
        );
    }

    /**
     * Returns all tabs to display to a client when managing a service whose
     * package uses this module
     *
     * @param stdClass $package A stdClass object representing the selected package
     * @return array An array of tabs in the format of method => title. Example: array('methodName' => "Title", 'methodName2' => "Title2")
     */
    public function getClientTabs($package)
    {
        return array(
            'tabClientActions' => Language::_("Cpanel.tab_client_actions", true),
            'tabClientStats' => Language::_("Cpanel.tab_client_stats", true)
        );
    }

    /**
     * Returns a noun used to refer to a module row (e.g. "Server")
     *
     * @return string The noun used to refer to a module row
     */
    public function moduleRowName()
    {
        return Language::_("Cwp.module_row", true);
    }

    /**
     * Returns a noun used to refer to a module row in plural form (e.g. "Servers", "VPSs", "Reseller Accounts", etc.)
     *
     * @return string The noun used to refer to a module row in plural form
     */
    public function moduleRowNamePlural()
    {
        return Language::_("Cwp.module_row_plural", true);
    }

    /**
     * Returns a noun used to refer to a module group (e.g. "Server Group")
     *
     * @return string The noun used to refer to a module group
     */
    public function moduleGroupName()
    {
        return Language::_("Cwp.module_group", true);
    }

    /**
     * Returns the key used to identify the primary field from the set of module row meta fields.
     *
     * @return string The key used to identify the primary field from the set of module row meta fields
     */
    public function moduleRowMetaKey()
    {
        return "server_name";
    }

    /**
     * Returns an array of available service deligation order methods. The module
     * will determine how each method is defined. For example, the method "first"
     * may be implemented such that it returns the module row with the least number
     * of services assigned to it.
     *
     * @return array An array of order methods in key/value paris where the key is the type to be stored for the group and value is the name for that option
     * @see Module::selectModuleRow()
     */
    public function getGroupOrderOptions()
    {
        return array('first' => Language::_("Cwp.order_options.first", true));
    }

    /**
     * Determines which module row should be attempted when a service is provisioned
     * for the given group based upon the order method set for that group.
     *
     * @return int The module row ID to attempt to add the service with
     * @see Module::getGroupOrderOptions()
     */
    public function selectModuleRow($module_group_id)
    {
        if (!isset($this->ModuleManager))
            Loader::loadModels($this, array("ModuleManager"));

        $group = $this->ModuleManager->getGroup($module_group_id);

        if ($group) {
            switch ($group->add_order) {
                default:
                case "first":

                    foreach ($group->rows as $row) {
                        if ($row->meta->account_limit > (isset($row->meta->account_count) ? $row->meta->account_count : 0))
                            return $row->id;
                    }

                    break;
            }
        }
        return 0;
    }



    /**
     * Returns the rendered view of the manage module page
     *
     * @param mixed $module A stdClass object representing the module and its rows
     * @param array $vars An array of post data submitted to or on the manager module page (used to repopulate fields after an error)
     * @return string HTML content containing information to display when viewing the manager module page
     */
    public function manageModule($module, array &$vars)
    {
        // Load the view into this object, so helpers can be automatically added to the view
        $this->view = new View("manage", "default");
        $this->view->base_uri = $this->base_uri;
        $this->view->setDefaultView("components" . DS . "modules" . DS . "Cwp" . DS);

        // Load the helpers required for this view
        Loader::loadHelpers($this, array("Form", "Html", "Widget"));
        $this->view->set("module", $module);

        return $this->view->fetch();
    }

    /**
     * Returns the value used to identify a particular service
     *
     * @param stdClass $service A stdClass object representing the service
     * @return string A value used to identify this service amongst other similar services
     */
    public function getServiceName($service)
    {
        foreach ($service->fields as $field) {
            if ($field->key == "Cwp_domain")
                return $field->value;
        }
        return null;
    }

    /**
     * Returns the rendered view of the add module row page
     *
     * @param array $vars An array of post data submitted to or on the add module row page (used to repopulate fields after an error)
     * @return string HTML content containing information to display when viewing the add module row page
     */
    public function manageAddRow(array &$vars)
    {
        // Load the view into this object, so helpers can be automatically added to the view
        $this->view = new View("add_row", "default");
        $this->view->base_uri = $this->base_uri;
        $this->view->setDefaultView("components" . DS . "modules" . DS . "cwp" . DS);

        // Load the helpers required for this view
        Loader::loadHelpers($this, array("Form", "Html", "Widget"));

        // Set unspecified checkboxes
        if (!empty($vars)) {
            if (empty($vars['use_ssl']))
                $vars['use_ssl'] = "false";
        }

        $this->view->set("vars", (object)$vars);
        return $this->view->fetch();
    }

    /**
     * Returns the rendered view of the edit module row page
     *
     * @param stdClass $module_row The stdClass representation of the existing module row
     * @param array $vars An array of post data submitted to or on the edit module row page (used to repopulate fields after an error)
     * @return string HTML content containing information to display when viewing the edit module row page
     */
    public function manageEditRow($module_row, array &$vars)
    {
        // Load the view into this object, so helpers can be automatically added to the view
        $this->view = new View("edit_row", "default");
        $this->view->base_uri = $this->base_uri;
        $this->view->setDefaultView("components" . DS . "modules" . DS . "cwp" . DS);

        // Load the helpers required for this view
        Loader::loadHelpers($this, array("Form", "Html", "Widget"));

        if (empty($vars))
            $vars = $module_row->meta;
        else {
            // Set unspecified checkboxes
            if (empty($vars['use_ssl']))
                $vars['use_ssl'] = "false";
        }

        $this->view->set("vars", (object)$vars);
        return $this->view->fetch();
    }

    /**
     * Adds the module row on the remote server. Sets Input errors on failure,
     * preventing the row from being added. Returns a set of data, which may be
     * a subset of $vars, that is stored for this module row
     *
     * @param array $vars An array of module info to add
     * @return array A numerically indexed array of meta fields for the module row containing:
     *    - key The key for this meta field
     *    - value The value for this key
     *    - encrypted Whether or not this field should be encrypted (default 0, not encrypted)
     */
    public function addModuleRow(array &$vars)
    {
        $meta_fields = array("server_name", "host_name", "key", "use_ssl", "account_limit", "name_servers", "notes");
        $encrypted_fields = array("key");

        // Set unspecified checkboxes
        if (empty($vars['use_ssl']))
            $vars['use_ssl'] = "false";

        $this->Input->setRules($this->getRowRules($vars));

        // Validate module row
        if ($this->Input->validates($vars)) {

            // Build the meta data for this row
            $meta = array();
            foreach ($vars as $key => $value) {

                if (in_array($key, $meta_fields)) {
                    $meta[] = array(
                        'key' => $key,
                        'value' => $value,
                        'encrypted' => in_array($key, $encrypted_fields) ? 1 : 0
                    );
                }
            }

            return $meta;
        }
    }

    /**
     * Builds and returns the rules required to add/edit a module row (e.g. server)
     *
     * @param array $vars An array of key/value data pairs
     * @return array An array of Input rules suitable for Input::setRules()
     */
    private function getRowRules(&$vars)
    {
        $rules = array(
            'server_name' => array(
                'valid' => array(
                    'rule' => "isEmpty",
                    'negate' => true,
                    'message' => Language::_("Cwp.!error.server_name_valid", true)
                )
            ),
            'host_name' => array(
                'valid' => array(
                    'rule' => array(array($this, "validateHostName")),
                    'message' => Language::_("Cwp.!error.host_name_valid", true)
                )
            ),
            'key' => array(
                'valid' => array(
                    'last' => true,
                    'rule' => "isEmpty",
                    'negate' => true,
                    'message' => Language::_("Cwp.!error.remote_key_valid", true)
                ),
                'valid_connection' => array(
                    'rule' => array(array($this, "validateConnection"), $vars['host_name'], $vars['use_ssl']),
                    'message' => Language::_("Cwp.!error.remote_key_valid_connection", true)
                )
            ),
            'account_limit' => array(
                'valid' => array(
                    'rule' => array("matches", "/^([0-9]+)?$/"),
                    'message' => Language::_("Cwp.!error.account_limit_valid", true)
                )
            ),
            'name_servers' => array(
                'count' => array(
                    'rule' => array(array($this, "validateNameServerCount")),
                    'message' => Language::_("Cwp.!error.name_servers_count", true)
                ),
                'valid' => array(
                    'rule' => array(array($this, "validateNameServers")),
                    'message' => Language::_("Cwp.!error.name_servers_valid", true)
                )
            )
        );

        return $rules;
    }

    /**
     * Edits the module row on the remote server. Sets Input errors on failure,
     * preventing the row from being updated. Returns a set of data, which may be
     * a subset of $vars, that is stored for this module row
     *
     * @param stdClass $module_row The stdClass representation of the existing module row
     * @param array $vars An array of module info to update
     * @return array A numerically indexed array of meta fields for the module row containing:
     *    - key The key for this meta field
     *    - value The value for this key
     *    - encrypted Whether or not this field should be encrypted (default 0, not encrypted)
     */
    public function editModuleRow($module_row, array &$vars)
    {
        $meta_fields = array("server_name", "host_name", "key", "use_ssl", "account_limit", "account_count", "name_servers", "notes");
        $encrypted_fields = array("key");

        // Set unspecified checkboxes
        if (empty($vars['use_ssl']))
            $vars['use_ssl'] = "false";

        $this->Input->setRules($this->getRowRules($vars));

        // Validate module row
        if ($this->Input->validates($vars)) {

            // Build the meta data for this row
            $meta = array();
            foreach ($vars as $key => $value) {

                if (in_array($key, $meta_fields)) {
                    $meta[] = array(
                        'key' => $key,
                        'value' => $value,
                        'encrypted' => in_array($key, $encrypted_fields) ? 1 : 0
                    );
                }
            }

            return $meta;
        }
    }

    /**
     * Deletes the module row on the remote server. Sets Input errors on failure,
     * preventing the row from being deleted.
     *
     * @param stdClass $module_row The stdClass representation of the existing module row
     */
    public function deleteModuleRow($module_row)
    {

    }

    /**
     * Validates that the nameservers given are formatted correctly
     *
     * @param array $name_servers An array of name servers
     * @return boolean True if every name server is formatted correctly, false otherwise
     */
    public function validateNameServers($name_servers)
    {
        if (is_array($name_servers)) {
            foreach ($name_servers as $name_server) {
                if (!$this->validateHostName($name_server))
                    return false;
            }
        }
        return true;
    }

    /**
     * Validates that the given hostname is valid
     *
     * @param string $host_name The host name to validate
     * @return boolean True if the hostname is valid, false otherwise
     */
    public function validateHostName($host_name)
    {
        if (strlen($host_name) > 255) {
            return false;
        }
        return $this->Input->matches($host_name, "/^([a-z0-9]|[a-z0-9][a-z0-9\-]{0,61}[a-z0-9])(\.([a-z0-9]|[a-z0-9][a-z0-9\-]{0,61}[a-z0-9]))+$/");
    }

    /**
     * Validates that at least 2 name servers are set in the given array of name servers
     *
     * @param array $name_servers An array of name servers
     * @return boolean True if the array count is >= 2, false otherwise
     */
    public function validateNameServerCount($name_servers)
    {
        if (is_array($name_servers) && count($name_servers) >= 2)
            return true;
        return false;
    }

    /**
     * Tries to get a validate_api method
     * @return boolean True if the connection is valid, false otherwise
     */
    public function validateConnection($key, $host_name, $use_ssl)
    {
        try {

            $api = $this->initializeApi($host_name, $key, $use_ssl);
            $result = $api->validateApi();
            if ($result == 0) {
                return true;
            }
            return false;
        } catch (Exception $e) {
            var_dump($e);
            // Trap any errors encountered, could not validate connection
        }
        return false;
    }

    /**
     * Initializes the Cwp api and returns an instance of that object with the given $host, $user, and $pass set
     *
     * @param string $host The host to the cPanel server
     * @param string $key The api key
     * @param string $use_ssl determining if using ssl or not
     * @return Cpanel Api The CpanelApi instance
     */
    private function initializeApi($host, $key, $use_ssl = true)
    {
        Loader::load(dirname(__FILE__) . DS . "apis" . DS . "cwp_api.php");

        $api = new CwpApi();
        $api->set_host($host);
        $api->set_key($key);
        $api->set_port(($use_ssl ? 2031 : 2030));
        $api->set_protocol("http" . ($use_ssl ? "s" : ""));
        return $api;
    }

    /**
     * Adds the service to the remote server. Sets Input errors on failure,
     * preventing the service from being added.
     *
     * @param stdClass $package A stdClass object representing the selected package
     * @param array $vars An array of user supplied info to satisfy the request
     * @param stdClass $parent_package A stdClass object representing the parent service's selected package (if the current service is an addon service)
     * @param stdClass $parent_service A stdClass object representing the parent service of the service being added (if the current service is an addon service service and parent service has already been provisioned)
     * @param string $status The status of the service being added. These include:
     *    - active
     *    - canceled
     *    - pending
     *    - suspended
     * @return array A numerically indexed array of meta fields to be stored for this service containing:
     *    - key The key for this meta field
     *    - value The value for this key
     *    - encrypted Whether or not this field should be encrypted (default 0, not encrypted)
     * @see Module::getModule()
     * @see Module::getModuleRow()
     */
    public function addService($package, array $vars = null, $parent_package = null, $parent_service = null, $status = "pending")
    {
        $row = $this->getModuleRow();

        if (!$row) {
            $this->Input->setErrors(array('module_row' => array('missing' => Language::_("Cwp.!error.module_row.missing", true))));
            return;
        }

        $api = $this->getApi($row->meta->host_name, $row->meta->user_name, $row->meta->key, $row->meta->use_ssl);

        // Generate username/password
        if (array_key_exists('cpanel_domain', $vars)) {
            Loader::loadModels($this, array("Clients"));

            // Generate a username
            if (empty($vars['cpanel_username']))
                $vars['cpanel_username'] = $this->generateUsername($vars['cpanel_domain']);

            // Generate a password
            if (empty($vars['cpanel_password'])) {
                $vars['cpanel_password'] = $this->generatePassword();
                $vars['cpanel_confirm_password'] = $vars['cpanel_password'];
            }

            // Use client's email address
            if (isset($vars['client_id']) && ($client = $this->Clients->get($vars['client_id'], false)))
                $vars['cpanel_email'] = $client->email;
        }

        $params = $this->getFieldsFromInput((array)$vars, $package);

        $this->validateService($package, $vars);

        if ($this->Input->errors())
            return;

        // Only provision the service if 'use_module' is true
        if ($vars['use_module'] == "true") {

            $masked_params = $params;
            $masked_params['password'] = "***";
            $this->log($row->meta->host_name . "|createacct", serialize($masked_params), "input", true);
            unset($masked_params);
            $result = $this->parseResponse($api->createacct($params));

            if ($this->Input->errors())
                return;

            // If reseller and we have an ACL set, update the reseller's ACL
            if ($package->meta->type == "reseller" && $package->meta->acl != "")
                $api->setacls(array('reseller' => $params['username'], 'acllist' => $package->meta->acl));

            // Update the number of accounts on the server
            $this->updateAccountCount($row);
        }

        // Return service fields
        return array(
            array(
                'key' => "cwp_domain",
                'value' => $params['domain'],
                'encrypted' => 0
            ),
            array(
                'key' => "cwp_username",
                'value' => $params['username'],
                'encrypted' => 0
            ),
            array(
                'key' => "cwp_password",
                'value' => $params['password'],
                'encrypted' => 1
            ),
            array(
                'key' => "cwp_confirm_password",
                'value' => $params['password'],
                'encrypted' => 1
            )
        );
    }

    /**
     *  This function returns a message based on the error number
     * @param $number
     */
    private function errorReporting($number)
    {
        if ($number == 1) {
            $message = "This function was not implemented.";
            //Language::_("Cwp.!error.module_row.missing", true)
        }

        if ($number == "2") {
            $message = "Allowed IP's not set or you don't have access! Please check in the centos web panel server if /usr/local/cwp/.conf/api_allowed.conf has the Blesta ip.";
        }

        if ($number == "3") {
            $message = "Invalid key provided, please check if the api in centos web panel config /usr/local/cwp/.conf/api_key.conf.";
        }

        if ($number == "4") {
            $message = "Please check all fields (only lower caps are allowed and no special characters).";
        }

        if ($number == "5") {
            $message = "The specified username already exits in the centos web panel database.";
        }

        if ($number == "6") {
            $message = "Something went terrible bad!";
        }

        // Lets throw some errors
        $this->Input->setErrors(array(
            'api' => array(
                'result' => $message
            )));

    }

    /**
     * When doing upgrades
     * @param string $current_version
     */
    public function upgrade($current_version)
    {
        // Ensure new version is greater than installed version
        if (version_compare($this->version, $current_version) < 0) {
            $this->Input->setErrors(array(
                'version' => array(
                    'invalid' => "Sorry, downgrades are not allowed."
                )
            ));
            return;
        }
    }

}

?>