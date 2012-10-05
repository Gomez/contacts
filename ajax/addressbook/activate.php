<?php
/**
 * Copyright (c) 2011 Thomas Tanghus <thomas@tanghus.net>
 * Copyright (c) 2011 Bart Visscher <bartv@thisnet.nl>
 * This file is licensed under the Affero General Public License version 3 or
 * later.
 * See the COPYING-README file.
 */


OCP\JSON::checkLoggedIn();
OCP\JSON::checkAppEnabled('contacts');
OCP\JSON::callCheck();

$id = $_POST['id'];

try {
	$book = OC_Contacts_Addressbook::find($id); // is owner access check
} catch(Exception $e) {
	OCP\JSON::error(
		array(
			'data' => array(
				'message' => $e->getMessage(),
				'file'=>$_POST['file']
			)
		)
	);
	exit();
}

if(!OC_Contacts_Addressbook::setActive($id, $_POST['active'])) {
	OCP\Util::writeLog('contacts',
		'ajax/activation.php: Error activating addressbook: '. $id,
		OCP\Util::ERROR);
	OCP\JSON::error(array(
		'data' => array(
			'message' => OC_Contacts_App::$l10n->t('Error (de)activating addressbook.'))));
	exit();
}

OCP\JSON::success(array(
	'active' => OC_Contacts_Addressbook::isActive($id),
	'id' => $id,
	'addressbook'   => $book,
));
