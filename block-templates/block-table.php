<?php

/**
 * Standings Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'custom-block-' . $block['id'];
if( !empty($block['anchor']) ) {
	$id = $block['anchor'];
}
// Create class attribute allowing for custom "className" and "align" values.
$className = 'custom-block';
$className .= ' standings';
$className .= ' d-flex flex-column flex-wrap justify-items-center';
if( !empty($block['className']) ) {
	$className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
	$className .= ' align' . $block['align'];
}

$section_anchor = $id;


$num_of_races = get_field('antal_tavlingar');
$show_teams = get_field('show_team');
$show_ss = get_field('show_ss');
$ss_title = get_field('ss_title');
$races = get_field('races');
$race_1 = get_field('race_1');
$race_2 = get_field('race_2');
$race_3 = get_field('race_3');
$race_4 = get_field('race_4');
$race_5 = get_field('race_5');
$race_6 = get_field('race_6');
$race_7 = get_field('race_7');
$race_8 = get_field('race_8');
$race_9 = get_field('race_9');
$race_10 = get_field('race_10');
$race_11 = get_field('race_11');
$race_12 = get_field('race_12');
if ($ss_title) {
	$ss_th = $ss_title;
} else {
	$ss_th = 'SS';
}
?>
<?php if( !empty($section_anchor) ){
echo '<a class="anchor" id="' . $section_anchor . '"></a>';
}
?>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
	<div class="container">
		<div style="overflow-x:auto;">
		<table class="standings table table-striped">
			<thead class="standingshead">
				<tr>
					<th class="pos-col">Pos</th>
					<th class="driver-col">Förare</th>
					<?php if ( get_field('show_team') ):?><th>Team</th><?php endif; ?>
					<?php if ($num_of_races > 0) :?><th class="race-col race1"><span class="flag-icon flag-icon-<?php echo strtolower($race_1['land']);?>"></span></th>
						<?php if ( get_field('show_ss') ):?><?php if ($num_of_races > 0) :?><th class="race-col-ss ml-2 ss1"><?php echo $ss_th; ?></th><?php endif;?><?php endif; ?>
					<?php endif;?>
					<?php if ($num_of_races > 1) :?><th class="race-col race2"><span class="flag-icon flag-icon-<?php echo strtolower($race_2['land']);?>"></span></th>
						<?php if ( get_field('show_ss') ):?><?php if ($num_of_races > 1) :?><th class="race-col-ss ml-2 ss2"><?php echo $ss_th; ?></th><?php endif;?><?php endif; ?>
					<?php endif;?>
					<?php if ($num_of_races > 2) :?><th class="race-col race3"><span class="flag-icon flag-icon-<?php echo strtolower($race_3['land']);?>"></span></th>
						<?php if ( get_field('show_ss') ):?><?php if ($num_of_races > 2) :?><th class="race-col-ss ml-2 ss3"><?php echo $ss_th; ?></th><?php endif;?><?php endif; ?>
					<?php endif;?>
					<?php if ($num_of_races > 3) :?><th class="race-col race4"><span class="flag-icon flag-icon-<?php echo strtolower($race_4['land']);?>"></span></th>
						<?php if ( get_field('show_ss') ):?><?php if ($num_of_races > 3) :?><th class="race-col-ss ml-2 ss4"><?php echo $ss_th; ?></th><?php endif;?><?php endif; ?>
					<?php endif;?>
					<?php if ($num_of_races > 4) :?><th class="race-col race5"><span class="flag-icon flag-icon-<?php echo strtolower($race_5['land']);?>"></span></th>
						<?php if ( get_field('show_ss') ):?><?php if ($num_of_races > 4) :?><th class="race-col-ss ml-2 ss5"><?php echo $ss_th; ?></th><?php endif;?><?php endif; ?>
					<?php endif;?>
					<?php if ($num_of_races > 5) :?><th class="race-col race6"><span class="flag-icon flag-icon-<?php echo strtolower($race_6['land']);?>"></span></th>
						<?php if ( get_field('show_ss') ):?><?php if ($num_of_races > 5) :?><th class="race-col-ss ml-2 ss6"><?php echo $ss_th; ?></th><?php endif;?><?php endif; ?>
					<?php endif;?>
					<?php if ($num_of_races >6) :?><th class="race-col race7"><span class="flag-icon flag-icon-<?php echo strtolower($race_7['land']);?>"></span></th>
						<?php if ( get_field('show_ss') ):?><?php if ($num_of_races > 6) :?><th class="race-col-ss ml-2 ss7"><?php echo $ss_th; ?></th><?php endif;?><?php endif; ?>
					<?php endif;?>
					<?php if ($num_of_races > 7) :?><th class="race-col race8"><span class="flag-icon flag-icon-<?php echo strtolower($race_8['land']);?>"></span></th>
						<?php if ( get_field('show_ss') ):?><?php if ($num_of_races > 7) :?><th class="race-col-ss ml-2 ss8"><?php echo $ss_th; ?></th><?php endif;?><?php endif; ?>
					<?php endif;?>
					<?php if ($num_of_races > 8) :?><th class="race-col race9"><span class="flag-icon flag-icon-<?php echo strtolower($race_9['land']);?>"></span></th>
						<?php if ( get_field('show_ss') ):?><?php if ($num_of_races > 8) :?><th class="race-col-ss ml-2 ss9"><?php echo $ss_th; ?></th><?php endif;?><?php endif; ?>
					<?php endif;?>
					<?php if ($num_of_races > 9) :?><th class="race-col race10"><span class="flag-icon flag-icon-<?php echo strtolower($race_10['land']);?>"></span></th>
						<?php if ( get_field('show_ss') ):?><?php if ($num_of_races > 9) :?><th class="race-col-ss ml-2 ss10"><?php echo $ss_th; ?></th><?php endif;?><?php endif; ?>
					<?php endif;?>
					<?php if ($num_of_races > 10) :?><th class="race-col race11"><span class="flag-icon flag-icon-<?php echo strtolower($race_11['land']);?>"></span></th>
						<?php if ( get_field('show_ss') ):?><?php if ($num_of_races > 10) :?><th class="race-col-ss ml-2 ss11"><?php echo $ss_th; ?></th><?php endif;?><?php endif; ?>
					<?php endif;?>
					<?php if ($num_of_races > 11) :?><th class="race-col race12"><span class="flag-icon flag-icon-<?php echo strtolower($race_12['land']);?>"></span></th>
						<?php if ( get_field('show_ss') ):?><?php if ($num_of_races > 11) :?><th class="race-col-ss ml-2 ss12"><?php echo $ss_th; ?></th><?php endif;?><?php endif; ?>
					<?php endif;?>
					<th class="total-col">Totalt</th>
				</tr>
			</thead>
			<?php
			// get repeater field data
			$repeater = get_field('table_row');

			// vars
			$order = array();

			// populate order
			$placering = 0;

			foreach( $repeater as $i => $row ) {
				$order[ $i ] = $row['total'];
			}

			// multisort
			array_multisort( $order, SORT_DESC, $repeater );


			// loop through repeater
			if( $repeater ): ?>

				<?php foreach( $repeater as $i => $row ): ?>
					<?php
						$team_name = $row['team'];
						if ($row['R_col_1']) {$cell_1 =  'R'; } else { if($row['col_1']){ $cell_1 = $row['col_1']; } else { $cell_1 = ' - '; } }
						if ($row['R_col_2']) {$cell_2 =  'R'; } else { if($row['col_2']){ $cell_2 = $row['col_2']; } else { $cell_2 = ' - '; } }
						if ($row['R_col_3']) {$cell_3 =  'R'; } else { if($row['col_3']){ $cell_3 = $row['col_3']; } else { $cell_3 = ' - '; } }
						if ($row['R_col_4']) {$cell_4 =  'R'; } else { if($row['col_4']){ $cell_4 = $row['col_4']; } else { $cell_4 = ' - '; } }
						if ($row['R_col_5']) {$cell_5 =  'R'; } else { if($row['col_5']){ $cell_5 = $row['col_5']; } else { $cell_5 = ' - '; } }
						if ($row['R_col_6']) {$cell_6 =  'R'; } else { if($row['col_6']){ $cell_6 = $row['col_6']; } else { $cell_6 = ' - '; } }
						if ($row['R_col_7']) {$cell_7 =  'R'; } else { if($row['col_7']){ $cell_7 = $row['col_7']; } else { $cell_7 = ' - '; } }
						if ($row['R_col_8']) {$cell_8 =  'R'; } else { if($row['col_8']){ $cell_8 = $row['col_8']; } else { $cell_8 = ' - '; } }
						if ($row['R_col_9']) {$cell_9 =  'R'; } else { if($row['col_9']){ $cell_9 = $row['col_9']; } else { $cell_9 = ' - '; } }
						if ($row['R_col_10']) {$cell_10 =  'R'; } else { if($row['col_10']){ $cell_10 = $row['col_10']; } else { $cell_10 = ' - '; } }
						if ($row['R_col_11']) {$cell_11 =  'R'; } else { if($row['col_11']){ $cell_11 = $row['col_11']; } else { $cell_11 = ' - '; } }
						if ($row['R_col_12']) {$cell_12 =  'R'; } else { if($row['col_12']){ $cell_12 = $row['col_12']; } else { $cell_12 = ' - '; } }
					?>

						<tr>
						<td class="pos-col"><?php
							$placering += 1;
							echo $placering
						?></td>
						<td class="driver-col"><span class="flag-icon flag-icon-<?php echo strtolower($row['driver_country_land']);?> mr-2"></span> <?php echo $row['driver'];?></td>
						<?php if ( get_field('show_team') ):?><td><?php echo esc_html( $team_name->post_title );?></td><?php endif; ?>
						<?php if ($num_of_races > 0) :?><td class="race-col race1"><?php echo $cell_1; ?></td>
							<?php if ( get_field('show_ss') ):?><?php if ($num_of_races > 0) :?><td class="race-col-ss ss1"><?php echo $row['ss_col_1'];?></td><?php endif;?><?php endif; ?>
						<?php endif;?>
						<?php if ($num_of_races > 1) :?><td class="race-col race2"><?php echo $cell_2; ?></td>
							<?php if ( get_field('show_ss') ):?><?php if ($num_of_races > 1) :?><td class="race-col-ss ss2"><?php echo $row['ss_col_2'];?></td><?php endif;?><?php endif; ?>
						<?php endif;?>
						<?php if ($num_of_races > 2) :?><td class="race-col race3"><?php echo $cell_3; ?></td>
							<?php if ( get_field('show_ss') ):?><?php if ($num_of_races > 2) :?><td class="race-col-ss ss3"><?php echo $row['ss_col_3'];?></td><?php endif;?><?php endif; ?>
						<?php endif;?>
						<?php if ($num_of_races > 3) :?><td class="race-col race4"><?php echo $cell_4; ?></td>
							<?php if ( get_field('show_ss') ):?><?php if ($num_of_races > 3) :?><td class="race-col-ss ss4"><?php echo $row['ss_col_4'];?></td><?php endif;?><?php endif; ?>
						<?php endif;?>
						<?php if ($num_of_races > 4) :?><td class="race-col race5"><?php echo $cell_5; ?></td>
							<?php if ( get_field('show_ss') ):?><?php if ($num_of_races > 4) :?><td class="race-col-ss ss5"><?php echo $row['ss_col_5'];?></td><?php endif;?><?php endif; ?>
						<?php endif;?>
						<?php if ($num_of_races > 5) :?><td class="race-col race6"><?php echo $cell_6; ?></td>
							<?php if ( get_field('show_ss') ):?><?php if ($num_of_races > 5) :?><td class="race-col-ss ss6"><?php echo $row['ss_col_6'];?></td><?php endif;?><?php endif; ?>
						<?php endif;?>
						<?php if ($num_of_races > 6) :?><td class="race-col race7"><?php echo $cell_7; ?></td>
							<?php if ( get_field('show_ss') ):?><?php if ($num_of_races > 6) :?><td class="race-col-ss ss7"><?php echo $row['ss_col_7'];?></td><?php endif;?><?php endif; ?>
						<?php endif;?>
						<?php if ($num_of_races > 7) :?><td class="race-col race8"><?php echo $cell_8; ?></td>
							<?php if ( get_field('show_ss') ):?><?php if ($num_of_races > 7) :?><td class="race-col-ss ss8"><?php echo $row['ss_col_8'];?></td><?php endif;?><?php endif; ?>
						<?php endif;?>
						<?php if ($num_of_races > 8) :?><td class="race-col race9"><?php echo $cell_9; ?></td>
							<?php if ( get_field('show_ss') ):?><?php if ($num_of_races > 8) :?><td class="race-col-ss ss9"><?php echo $row['ss_col_9'];?></td><?php endif;?><?php endif; ?>
						<?php endif;?>
						<?php if ($num_of_races > 9) :?><td class="race-col race10"><?php echo $cell_10; ?></td>
							<?php if ( get_field('show_ss') ):?><?php if ($num_of_races > 9) :?><td class="race-col-ss ss10"><?php echo $row['ss_col_10'];?></td><?php endif;?><?php endif; ?>
						<?php endif;?>
						<?php if ($num_of_races > 10) :?><td class="race-col race11"><?php echo $cell_11; ?></td>
							<?php if ( get_field('show_ss') ):?><?php if ($num_of_races > 10) :?><td class="race-col-ss ss11"><?php echo $row['ss_col_11'];?></td><?php endif;?><?php endif; ?>
						<?php endif;?>
						<?php if ($num_of_races > 11) :?><td class="race-col race12"><?php echo $cell_12; ?></td>
							<?php if ( get_field('show_ss') ):?><?php if ($num_of_races > 11) :?><td class="race-col-ss ss12"><?php echo $row['ss_col_12'];?></td><?php endif;?><?php endif; ?>
						<?php endif;?>
						<td class="total-col"><?php echo $row['total'];?></td>
					</tr>
				<?php endforeach; ?>

			<?php endif; ?>

		</table>
		</div>
	</div>
</div>

