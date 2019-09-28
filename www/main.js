$(document).ready(function() {
    $('#message-btn-fermer').click(function(){
        $('.col-md-12').slideUp('slow');
    });

    $.ajax({
        method : "get",
        url    : "jsonEstConnecte.php",
        success: onSuccessEstConnecte,
        error  : onError
    });

    $('#form-login').submit(function(){
        $.ajax({
            method: $(this).attr('method'),
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: onSuccessLogin,
            error: onError
        });
        return false;
    });

     $('#form-logout').submit(function(){
        $.ajax({
            method: $(this).attr('method'),
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: onSuccessLogout,
            error: onError
        });
        return false;
    });

    $('#cardSearchNum').submit(function(){
        $.ajax({
            method : $(this).attr('method'),
            url    : $(this).attr('action'),
            data   : $(this).serialize(),
            success: onSuccessCardSearch,
            error  : onError
        });
        return false;
    });

    $('#cardSearchSerie').submit(function(){
        $.ajax({
            method : $(this).attr('method'),
            url    : $(this).attr('action'),
            data   : $(this).serialize(),
            success: onSuccessCardSearchSerie,
            error  : onError
        });
        return false;
    });
	
});

function onSuccessLogin(retour){
    console.log(retour);
    if (retour.success){
        $('#form-login').hide();
        $('#form-logout').fadeIn('slow');
        $('#message').html(retour.message); 
    } else{

    }
}
function onSuccessLogout(retour){
    console.log(retour);
    if (retour.success){
        $('#form-logout').hide();
        $('#form-login').fadeIn('slow');
        $('#message').html(retour.message); 
    } else{

    }
}
function onSuccessEstConnecte(retour){
    console.log(retour);
    if (retour.success){
        $('#form-logout').fadeIn('slow');
    }
    else {
        $('#form-login').fadeIn('slow');
    }
    $('#message').html(retour.message)
                 .fadeIn('fast');
}
function onSuccessCardSearch(retour){
    if (retour.success) {
        var searchResult = $('#cardSearchResult');
        searchResult.html('<div class="Card">' +
            '<div class="NumCard"' + retour.Carte + '</div>' +
            '<div class="SerieCard">' +	retour.serieCard + '</div>' +
            '<div class="PicCard"><a href="javascript:void(0)" onclick="addCardDeck();"><img class="card" id="' +	retour.carte + '"src="http://wsdecks.com/static/img/' + retour.carteLink + '.gif"/></a></div>' +
            '<div class="NameCard">' + retour.nameCard + '</div>' +
            '<div class="LevelCard">' +	retour.levelCard + '</div>' +
            '<div class="CoutCard">' + retour.coutCard + '</div>' +
            '<div class="ColorCard">' +	retour.colorCard + '</div>' +
            '<div class="TriggerCard"' + retour.triggerCard + '</div>' +
            '<div class="TypeCard"' + retour.typeCard + '</div>')
            .show();
    }
    else {
        var searchResult = $('#cardSearchResult');
        searchResult.html('');
        alert('La carte ' + retour.carte);
    }
}

function onSuccessCardSearchSerie(retour) {
    if (retour.success) {
        var searchResult = $('#cardSearchResult').html('');
        for (var i = 0; i < retour.nbCard; ++i) {
            searchResult.append('<div class="Card">' +
                '<div class="NumCard">' + retour.carte[i] + '</div>' +
                '<div class="SerieCard">' + retour.serieCard + '</div>' +
                '<div class="PicCard"><a href="javascript:void(0)" id="' + retour.carte[i] + '" onclick="addCardDeck(this);"><img class="card" src="http://wsdecks.com/static/img/' + retour.carteLink[i] + '.gif"/></a></div>' +
                '<div class="NameCard">' + retour.nameCard[i] + '</div>' +
                '<div class="LevelCard">' + retour.levelCard[i] + '</div>' +
                '<div class="CoutCard">' + retour.coutCard[i] + '</div>' +
                '<div class="ColorCard">' + retour.colorCard[i] + '</div>' +
                '<div class="TriggerCard">' + retour.triggerCard[i] + '</div>' +
                '<div class="TypeCard">' + retour.typeCard[i] + '</div><br/><br/>');
        }
        searchResult.show();
    }
}

function dispSNum(){
    $('#cardSearchSerie').fadeOut('fast');
    $('#cardSearchNum').fadeIn('fast');
    return false;
}

function dispSSerie(){
    $('#cardSearchNum').fadeOut('fast');
    $('#cardSearchSerie').fadeIn('fast');
    return false;
}

function onError(retour){
    alert("Une erreur sauvage est apparue !!!");
}

var Deck = []; //array du deck (un array d'objet Carte)
function Carte (num, nbFois){ //objet Carte
    this.num = num;
    this.nbFois = nbFois;
}

function addCardDeck(obj){ //ici, on ajoute/modifie un objet Carte dans l'array Deck
    //lors de click sur image dans searchResult
    var isIn = false;
	var nbCard = 0;
    for (var i = 0; i < Deck.length; i++) {
        if (Deck[i].num == $(obj).attr("id")) {
            isIn = true;
            if (Deck[i].nbFois == 4) {
                alert('Cette carte est déjà 4 fois dans votre deck. si son effet indique qu\'il est possible d\'en mettre plus, la base de donnée ne gère pas encore cette exception.');
            }
            else {
                var Total = ++Deck[i].nbFois;

                $('#nbFois' + i).text('X ' + Total);
            }
            break;
        }
    }
    if (!isIn){
        Deck.push(new Carte($(obj).attr("id"), 1));
        $('#deck').append('<div id="' + Deck[Deck.length - 1].num.replace('/','') + '"><a href="javascript:void(0)" onclick="removeCardDeck(this);" id="' + Deck[Deck.length - 1].num + 'l">' + Deck[Deck.length - 1].num + ' <div id="nbFois' + (Deck.length-1) + '">X ' + Deck[Deck.length - 1].nbFois + '</div></a></div>');
    }
	
	for (var i = 0; i < Deck.length; i++) {
		nbCard += Deck[i].nbFois;
		if (nbCard == 4){
			$('#deck').append('<div id="SEND"><br/><br/><br/><a href="javascript:void(0)" onclick="sendDeck(Deck);">Submit your deck</a></div>');
			
		}
		if (nbCard > 4){
			$('#SEND').remove();
		}
	}

    /*affiche l'id / nom / nbFois (recuperation nom depuis BD avec id) ?*/
}

function removeCardDeck(obj){ //ici, on supprime/modifie un objet Carte dans l'array Deck
    //lors de click sur ligne dans deck
	
	var nbCard = 0;
    for (var i = 0; i < Deck.length; i++) {
        if (Deck[i].num == $(obj).attr("id").slice(0, -1)) {
            if (Deck[i].nbFois == 1) {
                $('#' + Deck[i].num.replace('/','')).remove();
				Deck.splice(i, 1);
            }
            else {
                var Total = --Deck[i].nbFois;
                $('#nbFois' + i).text('X ' + Total);
            }
            break;
        }
    }
	
	for (var i = 0; i < Deck.length; i++) {
		if (nbCard == 4){//normalement 50, mais pour test, on met moins
			$('#deck').append('<div id="SEND"><br/><br/><br/><a href="javascript:void(0)" onclick="sendDeck(Deck);">Submit your deck</a></div>');
		}
		if (nbCard < 4){
			$('#SEND').remove();
		}
	}
	
    /*si nbFois de l'id = 1 => suppresion de l'id dans deck
    * si NbFois > 1 => Nbfois - 1
    */
}

function sendDeck(deck){
	var deck_json = JSON.stringify(Deck);
	console.log(deck_json);
	$.ajax({
			method : "POST",
			url    : "sendDeck.php",
			data   : {deck: deck_json}/*.serialize*/,
			success: onSuccessSendDeck,
			error  : onError
		});
	//return false;
}

function onSuccessSendDeck(retour){
    //lors de validation du deck
	if(retour.success){
		console.log(retour.chose);
		console.log(retour.numeroCarte);
		console.log(retour.i);
		console.log(retour.dump);
	}
    /*si ncClimax > 8 => alert(deck invalide : trop de climax)
    * si nbClimax < 8 => alert(vous avez moins de 8 climax, êtes vous sûr ? (y/n))
    * nommer deck
    * ajout des id et nbFois dans vecteur ? => deja dans vecteur
    * ajout du deck dans decklist
    * ajout des cartes dans deckcomposition
    */
}