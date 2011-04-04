<?php
/**
 * See horde/config/prefs.php for documentation on the structure of this file.
 *
 * IMPORTANT: Local overrides MUST be placed in pref.local.php, or
 * prefs-servername.php if the 'vhosts' setting has been enabled in Horde's
 * configuration.
 */

$prefGroups['Sample'] = array(
    'column' => _("Sample Prefs"),
    'label' => _("Sample Pref"),
    'desc' => _("Set your sample preference."),
    'members' => array('sample')
);

$_prefs['sample'] = array(
    'value' => '',
    'locked' => false,
    'type' => 'text',
    'desc' => _("This is your sample preference.")
);
