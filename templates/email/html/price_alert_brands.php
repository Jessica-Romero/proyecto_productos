<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 * @var string $content
 */

echo '<p>'.__('A price alert has been occured!').'</p>';

echo '<p>'.__('This alert belongs to this brand: ').$brandName[0]->name. '</p>';

echo '<table>';
echo    '<thead>';
echo        '<tr>';
echo            '<th>'.__('SKU').'</th>';
echo            '<th>'.__('Name').'</th>';
echo            '<th>'.__('Price').'</th>';
echo            '<th>'.__('Competitor Price').'</th>';
echo            '<th>'.__('Competitor Name').'</th>';
echo        '</tr>';
echo    '</thead>';
echo    '<tbody>';
for( $i=0; $i<count($products); $i++){
        echo '<tr>';
        echo '<td>' . $products[$i]['product']->sku. '</td>';
        echo '<td>' . $products[$i]['product']->name . '</td>';
        echo '<td>' . $products[$i]->price . '</td>';
        echo '<td>' . $competitors[$i]->price . '</td>';
        echo '<td>' . $competitors[$i]['competitor']->name . '</td>';
        echo '</tr>';

}
echo  '</tbody>';
echo '</table>';
