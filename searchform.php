<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
	<fieldset class="search-box">
		<label>
			<input type="search" class="search-field" placeholder="SEARCH ..." value="<?php echo esc_attr( get_search_query() ); ?>" name="s" title="Search for:" />
		</label>
		<button class="search-submit">
			<?php echo esc_html( '' ); ?>
			<a id="search-toggle" class="search-toggle" aria-hidden="true">
			<i class="fa fa-search"></i>
		</a>
		</button>
	</fieldset>
</form>
