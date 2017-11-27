



(function( $ ) {
  var $content = $('.hentry');
  
  // var $form = $('#quote-submission-form');
  $('#new-quote-button').on('click', function(e){
    e.preventDefault();
  
     $content.empty();
     $.ajax({
        method: 'GET',
        url: api_vars.root_url + '/wp/v2/posts?filter[orderby]=rand&filter[posts_per_page]=1' 
         
        
     })
     .done( function(data) {
      var slug = data[0].slug;
      
      
      console.log(data);
      var quoteContent = data[0].excerpt.rendered,
      authorName = data[0].title.rendered,
      quoteSource = data[0]._qod_quote_source,
      quoteUrl = data[0]._qod_quote_source_url;
  
      var content = '';
      content += '<p>' + quoteContent + '</p>';
      content += '<div class="author-source-container">' + '<p>' +  authorName + '</p>';
      content += '<a href="' + quoteUrl + '">';
      content += quoteSource + '</a>' + '</div>';
      
      $('.hentry').append(content,history.pushState(null,null,slug));

     });
  });

  $('#submit-quote').on('click', function(e){
    e.preventDefault();
    var quoteContent = $('#quote-content').val(),
    authorName = $('#quote-author').val(),
    quoteSource = $('#quote-source').val(),
    quoteUrl = $('#quote-source-url').val();


    $.ajax({
      method: 'POST',
      url: api_vars.root_url + '/wp/v2/posts',
      data:{
        title: authorName,
        content: quoteContent,
        _qod_quote_source: quoteSource,
        _qod_quote_source_url: quoteUrl,
        status: 'publish'
      },
      beforeSend: function(xhr) {
        xhr.setRequestHeader( 'X-WP-Nonce', api_vars.nonce );
     }
    }).done ( function (){
      window.location.reload();
      alert('submitted');
    })
  });  
  

})( jQuery );

