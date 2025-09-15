<?php
namespace Lukasbableck\ContaoVcardBundle\EventListener\DataContainer;

use Contao\CoreBundle\DependencyInjection\Attribute\AsCallback;
use Contao\DataContainer;
use Lukasbableck\ContaoVcardBundle\Model\VcardModel;

#[AsCallback(table: 'tl_vcard', target: 'list.label.label')]
class VcardLabelCallbackListener {
    public function __invoke(array $row, string $label, DataContainer $dc, array $labels): array {
        $model = VcardModel::findByPk($row['id']);
        if (null === $model) {
            return $labels;
        }

        $labels = [];
        $labels[] = $model->getFormattedName();
        $labels[] = $row['kind'] ? '<span class="tl_gray">['.$GLOBALS['TL_LANG']['tl_vcard']['kind_options'][$row['kind']].']</span>' : '';

        return $labels;
    }
}
