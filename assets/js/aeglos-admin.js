var authenticationSuccess = function(response) {
  console.log(response);
  $('.display').toggle();
  token = Trello.token();
  console.log('Token : ' + token);
  Trello.get('/member/me/boards?token=' + token, successboard, errorboard);
  Trello.get('/members/me/tokens?webhooks=true', successwebhooks, errorwebhooks);

};

// SI PROBLEME CONNEXION
var authenticationFailure = function(response) {
  console.log(response);
};

// CONNEXION
$('#connect').click(function() {
  Trello.authorize({
    type: 'popup',
    name: 'Aeglos Trello',
    scope: {
      read: 'true',
      write: 'true',
      account: 'true'
    },
    expiration: 'never',
    success: authenticationSuccess,
    error: authenticationFailure
  });
});

// DECONNEXION
$('#disconnect').click(function() {
  Trello.deauthorize();
  $('.display').toggle();
  $('#getboards').empty();
  $('#getlists').empty();
});

$('#addcard').click(function() {
  Trello.addCard({
    url:"https://developers.trello.com/add-card",
    name:"Add a Card with a URL attachment"
  });
});

var boardname;
// SI BOARDS RÉCUPÉRÉ : AFFICHAGE
var successboard = function(responseGet) {
  console.log(responseGet);
  $('#getboards').append('<h2>Mes Boards</h2>');
  $(responseGet).each(function(index){

    $('#getboards').append('<a class="board" data-id="' + responseGet[index].id + '" data-name="' + responseGet[index].name + '" href="' + responseGet[index].shortUrl+ '" target="_blank">' + responseGet[index].name + '</a><br />');
    $('#getboards').append('<p>ID BOARD : ' + responseGet[index].id + '</p><br />');

  });
};

// SI BOARDS NON RÉCUPÉRÉS
var errorboard = function(errorGet) {
  console.log(errorGet);
};

// SI LIST RÉCUPÉRÉS
var successwebhooks = function(success) {
  console.log(success);
  $('#getlists').show();
  $('#getlists').append('<h2>Mes WebHooks</h2>');
  $(success).each(function(index){

    $('#getlists').append('<p>' + success[index].identifier + '</p>');

  });
};
// SI LIST NON RÉCUPÉRÉS
var errorwebhooks = function(error) {
  console.log(error);
};

$('body').on('click', '.board' ,function(e) {
  e.preventDefault();
  id = $(this).data('id');
  boardname = $(this).data('name');
  console.log('id = ' + id);
  Trello.get('/boards/' + id + '/cards', successcards, errorcards);
});
var successcards = function(success) {
  console.log(success);
  $('#my-cards').empty();
  $('#my-cards').append('<h2>' + boardname + '</h2>');
  $('#my-cards').append('<ul>');

  $(success).each(function(index){

    $('#my-cards').append('<h3>Nom card : <a class="card" data-card="' + success[index].shortLink + '" href="#!">' + success[index].name + '</a></h3>');
    $('#my-cards').append('Description : ' + success[index].desc + '<br />');
    $(success[index].labels).each(function(i) {
      $('#my-cards').append('Label : ' + success[index].labels[i].color);
    });

  });
  $('#my-cards').append('</ul>');

};
var errorcards = function(error) {
  console.log(error);
};

$('#aeglos').on('click', '.card', function() {
  Trello.get('/cards/' + $(this).data('card') + '/checklists', successdetail, errordetail);

});

var successdetail = function(success) {
  console.log(success);
};
var errordetail = function(error) {
  console.log(error);
};
