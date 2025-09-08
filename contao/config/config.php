<?php

use Lukasbableck\ContaoVcardBundle\Model\VcardModel;

$GLOBALS['BE_MOD']['vcard'] = [
	'vcard' => [
		'tables' => ['tl_vcard'],
	],
];

$GLOBALS['TL_MODELS']['tl_vcard'] = VcardModel::class;
