<?php 
use Badfennec\Frontend\Components;

	get_header();
	
	?>

	<div class="container">
		<?php

		echo 'Hello WP Theme';
		Components::get_components( 'spacer', ['min' => 50, 'max' => 100] );
		Components::get_components( 'thumb-handler', [
			'mobile_id'	=> 5,
			'video_desktop' => 'http://localhost:10432/wp-content/uploads/2025/11/mov_bbb.mp4'
		] );
		echo 'Hello WP Theme';

		Components::get_components( 'carousel-standard' );
		Components::get_components( 'search-bar' );

		?>

		<div class="my-20 flex gap-10">
			<?php Components::get_components( 'button-arrow', [
				'title' => 'Read More',
				'url'   => '#',
				'target'=> '_blank',
				'reverse' => true,
				'attrs'  => [
					'data-test' => '123'
				]
			] ); ?>

			<?php Components::get_components( 'button-arrow', [
				'title' => 'Read More',
				'url'   => '#',
				'target'=> '_blank',
				'attrs'  => [
					'data-test' => '123'
				]
			] ); ?>
		</div>

		<?php

		$accordionArgs = [
			'loop' => [
				[
					'title' => 'Accordion Item 1',
					'text'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'
				],
				[
					'title' => 'Accordion Item 2',
					'text'  => 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.'
				],
				[
					'title' => 'Accordion Item 3',
					'text'  => 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
				],
				[
					'title' => 'Accordion Item 4',
					'text'  => 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
				],
				[
					'title' => 'Accordion Item 5',
					'text'  => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam. Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.'
				]
			]
		];		

		?>

		<div class="mt-10 mx-auto max-w-[600px]">
			<?php Components::get_components( 'accordion-standard', $accordionArgs ); ?>
		</div>

	</div>

	<?php

	get_footer();