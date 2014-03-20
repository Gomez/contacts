<?php
/**
 * ownCloud - Load contact PHOTO or LOGO
 *
 * @author Thomas Tanghus
 * @copyright 2014 Thomas Tanghus (thomas@tanghus.net)
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU AFFERO GENERAL PUBLIC LICENSE
 * License as published by the Free Software Foundation; either
 * version 3 of the License, or any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU AFFERO GENERAL PUBLIC LICENSE for more details.
 *
 * You should have received a copy of the GNU Affero General Public
 * License along with this library.  If not, see <http://www.gnu.org/licenses/>.
 *
 */

namespace OCA\Contacts\Utils\TemporaryPhoto;

use OCA\Contacts\Contact as ContactObject,
	OCA\Contacts\Utils\TemporaryPhoto as AbstractTemporaryPhoto;

/**
 * This class loads the PHOTO or LOGO property from a contact.
 */
class Contact extends AbstractTemporaryPhoto {

	/**
	 * The Contact object to load the image from
	 *
	 * @var OCA\Contacts\Contact
	 */
	protected $contact;

	public function __construct(\OCP\IServerContainer $server, $contact) {
		if (!$contact instanceof ContactObject) {
			throw new \Exception(
				__METHOD__
				. ' Second argument must be an instance of OCA\\Contacts\\Contact'
			);
		}

		parent::__construct($server);
		$this->contact = $contact;
		$this->processImage();
	}

	/**
	 * Do what's needed to get the image from storage
	 * depending on the type.
	 */
	protected function processImage() {
		$this->image = $this->contact->getPhoto();
	}

}