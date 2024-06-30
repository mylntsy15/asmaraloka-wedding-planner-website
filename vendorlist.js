 $(document).ready(function () {
      $('.dropdown-toggle').dropdown();
    });

    $('#search-icon').click(function () {
      $('.search-form').toggle();
    });

   
function fetchSearchSuggestions(query) {
    $.ajax({
      url: 'search.php', 
      method: 'GET',
      data: { query: query },
      dataType: 'json',
      success: function(response) {
        
        displaySearchSuggestions(response);
      },
      error: function(xhr, status, error) {
        console.error('Error fetching search suggestions:', error);
      }
    });
  }
  
  
  function displaySearchSuggestions(suggestions) {
    var searchResults = $('#search-results'); 
    searchResults.empty(); 
    
    
    suggestions.forEach(function(suggestion) {
      var suggestionItem = $('<div class="suggestion"></div>').text(suggestion);
      suggestionItem.click(function() {
        
        $('#search-input').val(suggestion); 
        $('.search-form').hide(); 
      });
      searchResults.append(suggestionItem);
    });
  }
  
  