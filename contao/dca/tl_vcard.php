<?php

use Contao\DataContainer;
use Contao\DC_Table;

$GLOBALS['TL_DCA']['tl_vcard'] = [
	'config' => [
		'dataContainer' => DC_Table::class,
		'enableVersioning' => true,
		'sql' => [
			'keys' => [
				'id' => 'primary',
			],
		],
	],
	'list' => [
		'sorting' => [
			'mode' => DataContainer::MODE_SORTED,
			'fields' => ['lastname', 'firstname'],
			'flag' => DataContainer::SORT_INITIAL_LETTER_ASC,
			'panelLayout' => 'filter;search,limit',
		],
		'label' => [
			'fields' => ['lastname', 'firstname'],
			'format' => '%s, %s',
		],
	],
	'palettes' => [
		'__selector__' => ['kind'],
		'default' => 'kind',
		'individual' => 'kind;{personal_legend},photo,gender,honoricPrefixes,honoricSuffixes,firstname,lastname,additionalNames,nickname,dateOfBirth,language,timezone,tags;{professional_legend},company,jobtitle,role;{contact_legend},addresses,phones,emailAddresses,urls;{calendar_legend},calendarURL,calendarRequestURL;{notes_legend},note',
		'organization' => 'kind;{general_legend},organizationName,logo,tags,language,timezone;{contact_legend},addresses,phones,emailAddresses,urls;{calendar_legend},calendarURL,calendarRequestURL;{notes_legend},note',
	],
	'fields' => [
		'id' => [
			'sql' => 'int(10) unsigned NOT NULL auto_increment',
		],
		'tstamp' => [
			'sql' => "int(10) unsigned NOT NULL default '0'",
		],
		'kind' => [
			'search' => true,
			'inputType' => 'select',
			'options' => [
				'individual',
				'org',
			],
			'reference' => &$GLOBALS['TL_LANG']['tl_vcard']['kind_options'],
			'eval' => ['submitOnChange' => true, 'tl_class' => 'w50'],
			'sql' => "varchar(32) NOT NULL default ''",
		],
		'organisationName' => [
			'search' => true,
			'inputType' => 'text',
			'eval' => ['mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50 clr'],
			'sql' => "varchar(255) NOT NULL default ''",
		],
		'gender' => [
			'search' => true,
			'inputType' => 'select',
			'options' => [
				'F',
				'M',
				'D',
			],
			'reference' => &$GLOBALS['TL_LANG']['tl_vcard']['gender_options'],
			'eval' => ['includeBlankOption' => true, 'tl_class' => 'w50 clr'],
			'sql' => "varchar(1) NOT NULL default ''",
		],
		'firstname' => [
			'search' => true,
			'inputType' => 'text',
			'eval' => ['mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50 clr'],
			'sql' => "varchar(255) NOT NULL default ''",
		],
		'lastname' => [
			'search' => true,
			'inputType' => 'text',
			'eval' => ['mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'],
			'sql' => "varchar(255) NOT NULL default ''",
		],
		'additionalNames' => [
			'search' => true,
			'inputType' => 'text',
			'eval' => ['maxlength' => 255, 'tl_class' => 'w50'],
			'sql' => "varchar(255) NOT NULL default ''",
		],
		'nickname' => [
			'search' => true,
			'inputType' => 'text',
			'eval' => ['maxlength' => 255, 'tl_class' => 'w50'],
			'sql' => "varchar(255) NOT NULL default ''",
		],
		'honoricPrefixes' => [
			'search' => true,
			'inputType' => 'text',
			'eval' => ['maxlength' => 255, 'tl_class' => 'w50 clr'],
			'sql' => "varchar(255) NOT NULL default ''",
		],
		'honoricSuffixes' => [
			'search' => true,
			'inputType' => 'text',
			'eval' => ['maxlength' => 255, 'tl_class' => 'w50'],
			'sql' => "varchar(255) NOT NULL default ''",
		],
		'photo' => [
			'inputType' => 'fileTree',
			'eval' => ['filesOnly' => true, 'fieldType' => 'radio', 'tl_class' => 'w50'],
			'sql' => 'binary(16) NULL',
		],
		'dateOfBirth' => [
			'search' => true,
			'inputType' => 'text',
			'eval' => ['rgxp' => 'date', 'datepicker' => true, 'tl_class' => 'w50 wizard'],
			'sql' => "varchar(10) NOT NULL default ''",
		],
		'tags' => [
			'inputType' => 'listWizard',
			'eval' => ['tl_class' => 'clr'],
			'sql' => 'blob NULL',
		],
		'language' => [
			'search' => true,
			'inputType' => 'select',
			'eval' => ['tl_class' => 'w50'],
			'sql' => "varchar(64) NOT NULL default ''",
		],
		'timezone' => [
			'search' => true,
			'inputType' => 'select',
			'options_callback' => static function () {
				return array_values(DateTimeZone::listIdentifiers());
			},
			'eval' => ['maxlength' => 64, 'tl_class' => 'w50'],
			'sql' => "varchar(64) NOT NULL default ''",
		],
		'logo' => [
			'inputType' => 'fileTree',
			'eval' => ['filesOnly' => true, 'fieldType' => 'radio', 'tl_class' => 'w50'],
			'sql' => 'binary(16) NULL',
		],
		'company' => [
			'search' => true,
			'inputType' => 'text',
			'eval' => ['maxlength' => 255, 'tl_class' => 'w50'],
			'sql' => "varchar(255) NOT NULL default ''",
		],
		'jobtitle' => [
			'search' => true,
			'inputType' => 'text',
			'eval' => ['maxlength' => 255, 'tl_class' => 'w50'],
			'sql' => "varchar(255) NOT NULL default ''",
		],
		'role' => [
			'search' => true,
			'inputType' => 'text',
			'eval' => ['maxlength' => 255, 'tl_class' => 'w50'],
			'sql' => "varchar(255) NOT NULL default ''",
		],
		'addresses' => [
			'inputType' => 'group',
			'palette' => ['type', 'pobox', 'extended', 'street', 'city', 'state', 'zip', 'country'],
			'fields' => [
				'type' => [
					'inputType' => 'select',
					'options' => [
						'home',
						'work',
						'school',
						'other',
					],
					'eval' => ['tl_class' => 'w50'],
				],
				'pobox' => [
					'inputType' => 'text',
					'eval' => ['maxlength' => 255, 'tl_class' => 'w50'],
				],
				'extended' => [
					'inputType' => 'text',
					'eval' => ['maxlength' => 255, 'tl_class' => 'w50'],
				],
				'street' => [
					'inputType' => 'text',
					'eval' => ['maxlength' => 255, 'tl_class' => 'w50'],
				],
				'city' => [
					'inputType' => 'text',
					'eval' => ['maxlength' => 255, 'tl_class' => 'w50'],
				],
				'state' => [
					'inputType' => 'text',
					'eval' => ['maxlength' => 255, 'tl_class' => 'w50'],
				],
				'zip' => [
					'inputType' => 'text',
					'eval' => ['maxlength' => 20, 'tl_class' => 'w50'],
				],
				'country' => [
					'inputType' => 'text',
					'eval' => ['maxlength' => 255, 'tl_class' => 'w50'],
				],
			],
			'sql' => 'blob NULL',
		],
		'phones' => [
			'inputType' => 'group',
			'palette' => ['type', 'number'],
			'fields' => [
				'type' => [
					'inputType' => 'select',
					'options' => [
						'home',
						'work',
						'mobile',
						'fax',
						'pager',
						'textphone',
						'iphone',
						'applewatch',
						'other',
					],
					'eval' => ['tl_class' => 'w50'],
				],
				'number' => [
					'inputType' => 'text',
					'eval' => ['rgxp' => 'phone', 'maxlength' => 64, 'tl_class' => 'w50'],
				],
			],
			'sql' => 'blob NULL',
		],
		'emailAddresses' => [
			'inputType' => 'group',
			'palette' => ['type', 'email'],
			'fields' => [
				'type' => [
					'inputType' => 'select',
					'options' => [
						'home',
						'work',
						'other',
					],
					'eval' => ['tl_class' => 'w50'],
				],
				'email' => [
					'inputType' => 'text',
					'eval' => ['rgxp' => 'email', 'maxlength' => 255, 'tl_class' => 'w50'],
				],
			],
			'sql' => 'blob NULL',
		],
		'urls' => [
			'inputType' => 'group',
			'palette' => ['type', 'url'],
			'fields' => [
				'type' => [
					'inputType' => 'select',
					'options' => [
						'home',
						'work',
						'other',
					],
					'eval' => ['tl_class' => 'w50'],
				],
				'url' => [
					'inputType' => 'text',
					'eval' => ['rgxp' => 'url', 'maxlength' => 255, 'tl_class' => 'w50'],
				],
			],
			'sql' => 'blob NULL',
		],
		'calendarURL' => [
			'search' => true,
			'inputType' => 'text',
			'eval' => ['rgxp' => 'url', 'tl_class' => 'w50'],
			'sql' => 'text NULL',
		],
		'calendarRequestURL' => [
			'search' => true,
			'inputType' => 'text',
			'eval' => ['rgxp' => 'url', 'tl_class' => 'w50'],
			'sql' => 'text NULL',
		],
		'calendarFreeBusyURL' => [
			'search' => true,
			'inputType' => 'text',
			'eval' => ['rgxp' => 'url', 'tl_class' => 'w50'],
			'sql' => 'text NULL',
		],
		'note' => [
			'inputType' => 'textarea',
			'eval' => ['rte' => 'tinyMCE', 'tl_class' => 'clr'],
			'sql' => 'text NULL',
		],
	],
];
