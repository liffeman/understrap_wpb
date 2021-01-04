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
$className .= ' ' .$countdown_color;

$section_anchor = $id;


$num_of_races = get_field('antal_tavlingar');
$show_teams = get_field('show_team');
$show_ss = get_field('show_ss');
$races = get_field('races');
$race_1 = $races['race_1_land'];
$race_2 = $races['race_2_land'];
$race_3 = $races['race_3_land'];
$race_4 = $races['race_4_land'];
$race_5 = $races['race_5_land'];
$race_6 = $races['race_6_land'];
$race_7 = $races['race_7_land'];
$race_8 = $races['race_8_land'];

?>
<?php if( !empty($section_anchor) ){
echo '<a class="anchor" id="' . $section_anchor . '"></a>';
}
?>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
	<div class="container">
		<?php echo $num_of_races;?>
		<div style="overflow-x:auto;">
		<table class="standings table table-striped">
			<thead class="standingshead">
				<tr>
					<th class="pos-col">Pos</th>
					<th class="driver-col">Förare</th>
					<?php if ( get_field('show_team') ):?><th>Team</th><?php endif; ?>
					<?php if ($num_of_races > 0) :?><th class="race-col race1"><span class="flag-icon flag-icon-<?php echo strtolower($race_1);?>"></span></th>
						<?php if ( get_field('show_ss') ):?><?php if ($num_of_races > 0) :?><th class="race-col-ss ml-2 ss1">SS</th><?php endif;?><?php endif; ?>
					<?php endif;?>
					<?php if ($num_of_races > 1) :?><th class="race-col race2"><span class="flag-icon flag-icon-<?php echo strtolower($race_2);?>"></span></th>
						<?php if ( get_field('show_ss') ):?><?php if ($num_of_races > 1) :?><th class="race-col-ss ml-2 ss2">SS</th><?php endif;?><?php endif; ?>
					<?php endif;?>
					<?php if ($num_of_races > 2) :?><th class="race-col race3"><span class="flag-icon flag-icon-<?php echo strtolower($race_3);?>"></span></th>
						<?php if ( get_field('show_ss') ):?><?php if ($num_of_races > 2) :?><th class="race-col-ss ml-2 ss3">SS</th><?php endif;?><?php endif; ?>
					<?php endif;?>
					<?php if ($num_of_races > 3) :?><th class="race-col race4"><span class="flag-icon flag-icon-<?php echo strtolower($race_4);?>"></span></th>
						<?php if ( get_field('show_ss') ):?><?php if ($num_of_races > 3) :?><th class="race-col-ss ml-2 ss4">SS</th><?php endif;?><?php endif; ?>
					<?php endif;?>
					<?php if ($num_of_races > 4) :?><th class="race-col race5"><span class="flag-icon flag-icon-<?php echo strtolower($race_5);?>"></span></th>
						<?php if ( get_field('show_ss') ):?><?php if ($num_of_races > 4) :?><th class="race-col-ss ml-2 ss5">SS</th><?php endif;?><?php endif; ?>
					<?php endif;?>
					<?php if ($num_of_races > 5) :?><th class="race-col race6"><span class="flag-icon flag-icon-<?php echo strtolower($race_6);?>"></span></th>
						<?php if ( get_field('show_ss') ):?><?php if ($num_of_races > 5) :?><th class="race-col-ss ml-2 ss6">SS</th><?php endif;?><?php endif; ?>
					<?php endif;?>
					<?php if ($num_of_races >6) :?><th class="race-col race7"><span class="flag-icon flag-icon-<?php echo strtolower($race_7);?>"></span></th>
						<?php if ( get_field('show_ss') ):?><?php if ($num_of_races > 6) :?><th class="race-col-ss ml-2 ss7">SS</th><?php endif;?><?php endif; ?>
					<?php endif;?>
					<?php if ($num_of_races > 7) :?><th class="race-col race8"><span class="flag-icon flag-icon-<?php echo strtolower($race_8);?>"></span></th>
						<?php if ( get_field('show_ss') ):?><?php if ($num_of_races > 7) :?><th class="race-col-ss ml-2 ss8">SS</th><?php endif;?><?php endif; ?>
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
					<tr>
						<td class="pos-col"><?php
							$placering += 1;
							echo $placering
						?></td>
						<td class="driver-col"><span class="flag-icon flag-icon-<?php echo strtolower($row['driver_country_land']);?> mr-2"></span> <?php echo $row['driver'];?></td>
						<?php if ( get_field('show_team') ):?><td><?php echo $row['team'];?></td><?php endif; ?>
						<?php if ($num_of_races > 0) :?><td class="race-col race1"><?php echo $row['col_1'];?></td>
							<?php if ( get_field('show_ss') ):?><?php if ($num_of_races > 0) :?><td class="race-col-ss ss1"><?php echo $row['ss_col_1'];?></td><?php endif;?><?php endif; ?>
						<?php endif;?>
						<?php if ($num_of_races > 1) :?><td class="race-col race2"><?php echo $row['col_2'];?></td>
							<?php if ( get_field('show_ss') ):?><?php if ($num_of_races > 1) :?><td class="race-col-ss ss2"><?php echo $row['ss_col_2'];?></td><?php endif;?><?php endif; ?>
						<?php endif;?>
						<?php if ($num_of_races > 2) :?><td class="race-col race3"><?php echo $row['col_3'];?></td>
							<?php if ( get_field('show_ss') ):?><?php if ($num_of_races > 2) :?><td class="race-col-ss ss3"><?php echo $row['ss_col_3'];?></td><?php endif;?><?php endif; ?>
						<?php endif;?>
						<?php if ($num_of_races > 3) :?><td class="race-col race4"><?php echo $row['col_4'];?></td>
							<?php if ( get_field('show_ss') ):?><?php if ($num_of_races > 3) :?><td class="race-col-ss ss4"><?php echo $row['ss_col_4'];?></td><?php endif;?><?php endif; ?>
						<?php endif;?>
						<?php if ($num_of_races > 4) :?><td class="race-col race5"><?php echo $row['col_5'];?></td>
							<?php if ( get_field('show_ss') ):?><?php if ($num_of_races > 4) :?><td class="race-col-ss ss5"><?php echo $row['ss_col_5'];?></td><?php endif;?><?php endif; ?>
						<?php endif;?>
						<?php if ($num_of_races > 5) :?><td class="race-col race6"><?php echo $row['col_6'];?></td>
							<?php if ( get_field('show_ss') ):?><?php if ($num_of_races > 5) :?><td class="race-col-ss ss6"><?php echo $row['ss_col_6'];?></td><?php endif;?><?php endif; ?>
						<?php endif;?>
						<?php if ($num_of_races > 6) :?><td class="race-col race7"><?php echo $row['col_7'];?></td>
							<?php if ( get_field('show_ss') ):?><?php if ($num_of_races > 6) :?><td class="race-col-ss ss7"><?php echo $row['ss_col_7'];?></td><?php endif;?><?php endif; ?>
						<?php endif;?>
						<?php if ($num_of_races > 7) :?><td class="race-col race8"><?php echo $row['col_8'];?></td>
							<?php if ( get_field('show_ss') ):?><?php if ($num_of_races > 7) :?><td class="race-col-ss ss8"><?php echo $row['ss_col_8'];?></td><?php endif;?><?php endif; ?>
						<?php endif;?>
						<td class="total-col"><?php echo $row['total'];?></td>
					</tr>
				<?php endforeach; ?>

			<?php endif; ?>

		</table>
		</div>
	</div>
</div>



