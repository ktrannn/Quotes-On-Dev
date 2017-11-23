



(function( $ ) {
  var $content = $('.hentry');
  // var quoteAuthor = $('#quote-author').val();

  $('#new-quote-button').on('click', function(e) {
    e.preventDefault();
  
     $content.empty();
     $.ajax({
        method: 'GET',
        url: api_vars.root_url + '/wp/v2/posts?filter[orderby]=rand&filter[posts_per_page]=1' 
        
     })
     .done( function(data) {
      

      console.log(data);
      $('.hentry').append(
        data[0].excerpt.rendered,
        data[0].title.rendered,
        '<a>' + data[0]._qod_quote_source + '</a>'
      );
     });
  });
})( jQuery );

// output += '<a href="' + articleLink + '">';
// output += '<div class="articlePic" style="background-image:url(' + image + ')">';
// output += '<p class="text">' + articleText + '</p></div>';
// output += '</a></li>';