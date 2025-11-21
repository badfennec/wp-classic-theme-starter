<?php 
use Badfennec\Frontend\Components;

	get_header();
	
	?>

	<div class="container">
		<?php

		echo 'Hello WP Theme';
		Components::get_component( 'spacer', ['min' => 50, 'max' => 100] );
		Components::get_component( 'thumb-handler', [
			'mobile_id'	=> 5,
			'video_desktop' => 'http://localhost:10432/wp-content/uploads/2025/11/mov_bbb.mp4'
		] );
		echo 'Hello WP Theme';

		Components::get_component( 'carousel-standard' );
		Components::get_component( 'search-bar' );

		?>

		<div class="my-20 flex gap-10">
			<?php Components::get_component( 'button-arrow', [
				'title' => 'Read More',
				'url'   => '#',
				'target'=> '_blank',
				'reverse' => true,
				'attrs'  => [
					'data-test' => '123'
				]
			] ); ?>

			<?php Components::get_component( 'button-arrow', [
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
			<?php Components::get_component( 'accordion-standard', $accordionArgs ); ?>
		</div>

		<?php

		$tabsArgs = [
			'loop' => [
				[
					'title' => 'Tabs Item 1',
					'content'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'
				],
				[
					'title' => 'Tabs Item 2',
					'content'  => 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.'
				],
				[
					'title' => 'Tabs Item 3',
					'content'  => 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
				],
				[
					'title' => 'Tabs Item 4',
					'content'  => 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
				],
				[
					'title' => 'Tabs Item 5',
					'content'  => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam. Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.'
				]
			]
		];		

		?>

		<div class="mt-10 mx-auto max-w-[800px]">
			<?php Components::get_component( 'tabs-standard', $tabsArgs ); ?>
		</div>

		<pre class="mt-20">
			<?php print_r( \Badfennec\Queries\PostQueries::get_post_related(1) ); ?>
		</pre>

	</div>

	<?php

	get_footer();