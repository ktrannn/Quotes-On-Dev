<?php



get_header(); ?>


<div id="primary" class="content-area">  
  <main id="main" class="site-main">
    <section>
      <header>
        <?php the_title( '<h1 class="entry-title">', '</h1>' );?>
  
      </header>

      <?php if( is_user_logged_in() && current_user_can( 'edit_posts' )):  ?>
      <div>
          <form>
          <div class="quote-submission-wrapper"> 
            <div class="quote-author-box">
              <label for="quote-author">Author of Quote</label>
              <input type="text" name="quote_author" id="quote-author">
            </div>
            <div>
              <label for="quote-content">Quote</label>
              <textarea rows="3" cols="20" name="quote_content" id="quote-content"></textarea>
            </div>
            <div class="quote-source-box">
              <label for="quote-source">Where did you find this quote?</label>
              <input type="text" name="quote_source" id="quote-source">
            </div>
            <div class="quote-source-url-box">
              <label for="quote-source-url">Provide the URL of quote source.</label>
              <input type="url" name="quote_source_url" id="quote-source-url">
            </div>
            <input type="submit" id ="submit-quote" value="Submit Quote">
          </div>  
          </form>
          <p class="submit-sucess-message"></p>
        <?php else: ?>
        <p>Sorry, you must be logged in to submit a quote!</p>
        <p><?php echo sprintf( '<a href="%1s">%2s</a>',
        esc_url(wp_login_url()), 'Click Here to Log In' )?></p>

        <?php endif; ?>

    </section>
  </main>
</div>











<?php get_footer(); ?>