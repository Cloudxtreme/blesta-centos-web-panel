<?php
/**
 * en_us language for the Cwp module
 */
// Basics
$lang['Cwp.name'] = "Centos Web Panel";
$lang['Cwp.module_row'] = "Server";
$lang['Cwp.module_row_plural'] = "Servers";
$lang['Cwp.module_group'] = "Server Group";
$lang['Cwp.tab_stats'] = "Statistics";
$lang['Cwp.tab_client_stats'] = "Statistics";
$lang['Cwp.tab_client_actions'] = "Actions";

// Module management
$lang['Cwp.add_module_row'] = "Add Server";
$lang['Cwp.add_module_group'] = "Add Server Group";
$lang['Cwp.manage.module_rows_title'] = "Servers";
$lang['Cwp.manage.module_groups_title'] = "Server Groups";
$lang['Cwp.manage.module_rows_heading.name'] = "Server Label";
$lang['Cwp.manage.module_rows_heading.hostname'] = "Hostname";
$lang['Cwp.manage.module_rows_heading.accounts'] = "Accounts";
$lang['Cwp.manage.module_rows_heading.options'] = "Options";
$lang['Cwp.manage.module_groups_heading.name'] = "Group Name";
$lang['Cwp.manage.module_groups_heading.servers'] = "Server Count";
$lang['Cwp.manage.module_groups_heading.options'] = "Options";
$lang['Cwp.manage.module_rows.count'] = "%1\$s / %2\$s"; // %1$s is the current number of accounts, %2$s is the total number of accounts available
$lang['Cwp.manage.module_rows.edit'] = "Edit";
$lang['Cwp.manage.module_groups.edit'] = "Edit";
$lang['Cwp.manage.module_rows.delete'] = "Delete";
$lang['Cwp.manage.module_groups.delete'] = "Delete";
$lang['Cwp.manage.module_rows.confirm_delete'] = "Are you sure you want to delete this server?";
$lang['Cwp.manage.module_groups.confirm_delete'] = "Are you sure you want to delete this server group?";
$lang['Cwp.manage.module_rows_no_results'] = "There are no servers.";
$lang['Cwp.manage.module_groups_no_results'] = "There are no server groups.";


$lang['Cwp.order_options.first'] = "First non-full server";

// Add row
$lang['Cwp.add_row.box_title'] = "Add Cwp Server";
$lang['Cwp.add_row.basic_title'] = "Basic Settings";
$lang['Cwp.add_row.name_servers_title'] = "Name Servers";
$lang['Cwp.add_row.notes_title'] = "Notes";
$lang['Cwp.add_row.name_server_btn'] = "Add Additional Name Server";
$lang['Cwp.add_row.name_server_col'] = "Name Server";
$lang['Cwp.add_row.name_server_host_col'] = "Hostname";
$lang['Cwp.add_row.name_server'] = "Name server %1\$s"; // %1$s is the name server number (e.g. 3)
$lang['Cwp.add_row.remove_name_server'] = "Remove";
$lang['Cwp.add_row.add_btn'] = "Add Server";

$lang['Cwp.edit_row.box_title'] = "Edit Cwp Server";
$lang['Cwp.edit_row.basic_title'] = "Basic Settings";
$lang['Cwp.edit_row.name_servers_title'] = "Name Servers";
$lang['Cwp.edit_row.notes_title'] = "Notes";
$lang['Cwp.edit_row.name_server_btn'] = "Add Additional Name Server";
$lang['Cwp.edit_row.name_server_col'] = "Name Server";
$lang['Cwp.edit_row.name_server_host_col'] = "Hostname";
$lang['Cwp.edit_row.name_server'] = "Name server %1\$s"; // %1$s is the name server number (e.g. 3)
$lang['Cwp.edit_row.remove_name_server'] = "Remove";
$lang['Cwp.edit_row.add_btn'] = "Edit Server";

$lang['Cwp.row_meta.server_name'] = "Server Label";
$lang['Cwp.row_meta.host_name'] = "Hostname";
$lang['Cwp.row_meta.user_name'] = "User Name";
$lang['Cwp.row_meta.key'] = "Remote Api Key";
$lang['Cwp.row_meta.use_ssl'] = "Use SSL when connecting to the API (recommended)";
$lang['Cwp.row_meta.account_limit'] = "Account Limit";

// Package fields
$lang['Cwp.package_fields.type'] = "Account Type";
$lang['Cwp.package_fields.type_standard'] = "Standard";
$lang['Cwp.package_fields.type_reseller'] = "Reseller";
$lang['Cwp.package_fields.package'] = "Cwp Package";
$lang['Cwp.package_fields.acl'] = "Access Control List";
$lang['Cwp.package_fields.acl_default'] = "Default";

// Service fields
$lang['Cwp.service_field.domain'] = "Domain";
$lang['Cwp.service_field.username'] = "Username";
$lang['Cwp.service_field.password'] = "Password";
$lang['Cwp.service_field.confirm_password'] = "Confirm Password";

// Service management
$lang['Cwp.tab_stats.info_title'] = "Information";
$lang['Cwp.tab_stats.info_heading.field'] = "Field";
$lang['Cwp.tab_stats.info_heading.value'] = "Value";
$lang['Cwp.tab_stats.info.domain'] = "Domain";
$lang['Cwp.tab_stats.info.ip'] = "IP Address";
$lang['Cwp.tab_stats.bandwidth_title'] = "Bandwidth";
$lang['Cwp.tab_stats.bandwidth_heading.used'] = "Used";
$lang['Cwp.tab_stats.bandwidth_heading.limit'] = "Limit";
$lang['Cwp.tab_stats.bandwidth_value'] = "%1\$s MB"; // %1$s is the amount of bandwidth in MB
$lang['Cwp.tab_stats.bandwidth_unlimited'] = "unlimited";
$lang['Cwp.tab_stats.disk_title'] = "Disk";
$lang['Cwp.tab_stats.disk_heading.used'] = "Used";
$lang['Cwp.tab_stats.disk_heading.limit'] = "Limit";
$lang['Cwp.tab_stats.disk_value'] = "%1\$s MB"; // %1$s is the amount of disk in MB
$lang['Cwp.tab_stats.disk_unlimited'] = "unlimited";


// Client actions
$lang['Cwp.tab_client_actions.change_password'] = "Change Password";
$lang['Cwp.tab_client_actions.field_Cwp_password'] = "Password";
$lang['Cwp.tab_client_actions.field_Cwp_confirm_password'] = "Confirm Password";
$lang['Cwp.tab_client_actions.field_password_submit'] = "Update Password";


// Client Service management
$lang['Cwp.tab_client_stats.info_title'] = "Information";
$lang['Cwp.tab_client_stats.info_heading.field'] = "Field";
$lang['Cwp.tab_client_stats.info_heading.value'] = "Value";
$lang['Cwp.tab_client_stats.info.domain'] = "Domain";
$lang['Cwp.tab_client_stats.info.ip'] = "IP Address";
$lang['Cwp.tab_client_stats.bandwidth_title'] = "Bandwidth Usage (Month to Date)";
$lang['Cwp.tab_client_stats.disk_title'] = "Disk Usage";
$lang['Cwp.tab_client_stats.usage'] = "(%1\$s MB/%2\$s MB)"; // %1$s is the amount of resource usage, %2$s is the resource usage limit
$lang['Cwp.tab_client_stats.usage_unlimited'] = "(%1\$s MB/∞)"; // %1$s is the amount of resource usage


// Service info
$lang['Cwp.service_info.username'] = "Username";
$lang['Cwp.service_info.password'] = "Password";
$lang['Cwp.service_info.server'] = "Server";
$lang['Cwp.service_info.options'] = "Options";
$lang['Cwp.service_info.option_login'] = "Log in";


// Tooltips
$lang['Cwp.service_field.tooltip.username'] = "You may leave the username blank to automatically generate one.";
$lang['Cwp.service_field.tooltip.password'] = "You may leave the password blank to automatically generate one.";


// Errors
$lang['Cwp.!error.server_name_valid'] = "You must enter a Server Label.";
$lang['Cwp.!error.host_name_valid'] = "The Hostname appears to be invalid.";
$lang['Cwp.!error.user_name_valid'] = "The User Name appears to be invalid.";
$lang['Cwp.!error.remote_key_valid'] = "The Remote Key appears to be invalid.";
$lang['Cwp.!error.remote_key_valid_connection'] = "A connection to the server could not be established. Please check to ensure that the Hostname, User Name, and Remote Key are correct.";
$lang['Cwp.!error.account_limit_valid'] = "Account Limit must be left blank (for unlimited accounts) or set to some integer value.";
$lang['Cwp.!error.name_servers_valid'] = "One or more of the name servers entered are invalid.";
$lang['Cwp.!error.name_servers_count'] = "You must define at least 2 name servers.";
$lang['Cwp.!error.meta[type].valid'] = "Account type must be either standard or reseller.";
$lang['Cwp.!error.meta[package].empty'] = "A Cwp Package is required.";
$lang['Cwp.!error.api.internal'] = "An internal error occurred, or the server did not respond to the request.";
$lang['Cwp.!error.module_row.missing'] = "An internal error occurred. The module row is unavailable.";

$lang['Cwp.!error.Cwp_domain.format'] = "Please enter a valid domain name, e.g. domain.com.";
$lang['Cwp.!error.Cwp_domain.test'] = "Domain name can not start with 'test'.";
$lang['Cwp.!error.Cwp_username.format'] = "The username may contain only letters and numbers and may not start with a number.";
$lang['Cwp.!error.Cwp_username.test'] = "The username may not begin with 'test'.";
$lang['Cwp.!error.Cwp_username.length'] = "The username must be between 1 and 16 characters in length.";
$lang['Cwp.!error.Cwp_password.valid'] = "Password must be at least 8 characters in length.";
$lang['Cwp.!error.Cwp_password.matches'] = "Password and Confirm Password do not match.";
?>