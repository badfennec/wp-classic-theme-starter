<?php 
use Badfennec\Frontend\Components;

	get_header();
	
	?>

	<div class="container">

		<div class="flex">
			<div>
				<label><input type="radio" name="test" value="1" checked> 1</label><br>
				<label><input type="radio" name="test" value="2"> 2</label><br>
				<label><input type="radio" name="test" value="3"> 3</label>
			</div>

			<div>
				<label><input type="checkbox" name="test" value="3"> 3</label>
			</div>
		</div>

		<div class="wp-block-gallery">
			<a href="https://images.unsplash.com/photo-1596370743446-6a7ef43a36f9?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=240&q=80">
				<img src="https://images.unsplash.com/photo-1596370743446-6a7ef43a36f9?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=240&q=80" />
			</a>
			<a href="https://images.unsplash.com/photo-1446630073557-fca43d580fbe?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=240&q=80">
				<img src="https://images.unsplash.com/photo-1446630073557-fca43d580fbe?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=240&q=80" />
			</a>
		</div>

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

	</div>

	<?php

	get_footer();