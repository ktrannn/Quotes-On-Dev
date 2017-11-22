
(function( $ ) {
  $('#new-quote-button').on('click', function(event) {
     event.preventDefault();
     $.ajax({
        method: 'post',
        url: 'http://localhost:3000/quotesondev/ .wp-json/wp/v2/posts';
        data: {
           'action': 'red_comment_ajax',
           'security': red_vars.comment_nonce,
           'the_post_id': red_vars.post_id
        }
     }).done( function(response) {
        alert('Success! Comments are closed for this post.');
     });
  });
})( jQuery );