



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
      var quoteContent = data[0].excerpt.rendered,
      authorName = data[0].title.rendered,
      quoteSource = data[0]._qod_quote_source,
      quoteUrl = data[0]._qod_quote_source_url;
  
      var content = '';
      content += '<p>' + quoteContent + '</p>';
      content += '<p>' + authorName + '</p>';
      content += '<a href="' + quoteUrl + '">';
      content += quoteSource + '</a>';
      $('.hentry').append(content);
      
     });
  });

















})( jQuery );

