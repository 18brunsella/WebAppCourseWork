function hangman() {
    console.clear();
    console.log("New Game Started")

    // Pick a random word
    var word = randomWord();
    console.log(word);

    // Make a "guess" string with underbars
    // where each letter will go. We will fill
    // this in with letters as we find them.
    var guess = '';
    for(var i=0; i<word.length;  i++) {
        guess += '_';
    }

    present();
    document.getElementById("word").value = word;
    setGuess(guess);

    // Guesses var
    var guesses = 6;
    var gameOver = false;

    function present(){
        // The HTML for the page
        var html = '<p id="image"><img id="hangmanImg" width="125" height="300" src="images/hm0.png"></p>';
        var img = 0;

        html += '<p id="guess"></p>';
        html += '<form>';
        html += '<input type="hidden" id="word" value="' + word + '">';
        html += '<p><label for="letter">Letter: </label><input type="text" id="letter"></p>';
        html += '<p><input type="submit" id="try" value="Guess!"> <input type="submit" id="new" value="New Game"> </p>';
        html += '<p id="message">&nbsp;</p>';
        html += '</form>';

        document.getElementById("play-area").innerHTML = html;
    }

    document.getElementById("try").onclick = function(event) {
        event.preventDefault();
        if(gameOver){
            document.getElementById("message").innerHTML = "The Game is over"
        }

        var letter = document.getElementById("letter").value;
        if(letter === null || letter == ""){
            document.getElementById("message").innerHTML = "You must enter a letter!";
        }else if(letter.length >= 2 || !isLetter(letter)) {
            guesses--;
            updateHangmanImg();
        }else{
            document.getElementById("message").innerHTML = "";
            processGuess(letter);
        }

        document.getElementById("letter").value = "";

        if(guesses === 0){
            setGuess(word);
            document.getElementById("message").innerHTML = "You guessed poorly!";
            gameOver = true;
        }else if(guess === word){
            document.getElementById("message").innerHTML = "You win!";
            gameOver = true;
        }
    }

    // Checks if the letter is indeed a letter
    function isLetter(char){
        return char.length === 1 && char.match(/[a-z]/i);
    }

    function processGuess(letter){
        var newGuess = '';
        var match = false;
        for(var i=0; i < word.length; i++){
            console.log("Guess: " + letter);
            if(letter === guess.charAt(i)){
                document.getElementById("message").innerHTML = "You already guessed " + letter
            }else if(letter === word.charAt(i)){
                console.log("Found a matching letter");
                newGuess += letter;
                match = true;
            }else if(isLetter(guess.charAt(i))){
                newGuess += guess.charAt(i);
            }else{
                newGuess += "_";
            }
        }

        if(match === false){
            console.log("Did not find a matching letter");
            guesses--;
            updateHangmanImg();
        }

        guess = newGuess;
        setGuess(guess);
    }

    // New Game
    document.getElementById("new").onclick = function(event){
        event.preventDefault();
        console.log("New Game Started")
        word = randomWord();
        console.log(word);
        document.getElementById("word").value = word;
        guesses = 6;
        // Make a "guess" string with underbars
        // where each letter will go. We will fill
        // this in with letters as we find them.
        guess = '';
        for(var i=0; i<word.length;  i++) {
            guess += '_';
        }
        setGuess(guess);
        updateHangmanImg();

        document.getElementById("message").innerHTML = "";
    }

    function updateHangmanImg(){
        var hangmanImg = document.getElementById('hangmanImg');
        if(guesses === 6){
            hangmanImg.src = "images/hm0.png";
        }else if(guesses === 5){
            hangmanImg.src = "images/hm1.png";
        }else if(guesses === 4){
            hangmanImg.src = "images/hm2.png";
        }else if(guesses === 3){
            hangmanImg.src = "images/hm3.png";
        }else if(guesses === 2){
            hangmanImg.src = "images/hm4.png";
        }else if(guesses === 1){
            hangmanImg.src = "images/hm5.png";
        }else{
            hangmanImg.src = "images/hm6.png";
        }
    }

}

// Set the guess in the from
function setGuess(guess) {
    var g = '';
    for(var i=0; i<guess.length; i++) {
        g += guess.charAt(i) + ' ';
    }

    document.getElementById("guess").innerHTML = g;
}


function randomWord() {
    var words = ["moon","home","mega","blue","send","frog","book","hair","late",
        "club","bold","lion","sand","pong","army","baby","baby","bank","bird","bomb","book",
        "boss","bowl","cave","desk","drum","dung","ears","eyes","film","fire","foot","fork",
        "game","gate","girl","hose","junk","maze","meat","milk","mist","nail","navy","ring",
        "rock","roof","room","rope","salt","ship","shop","star","worm","zone","cloud",
        "water","chair","cords","final","uncle","tight","hydro","evily","gamer","juice",
        "table","media","world","magic","crust","toast","adult","album","apple",
        "bible","bible","brain","chair","chief","child","clock","clown","comet","cycle",
        "dress","drill","drink","earth","fruit","horse","knife","mouth","onion","pants",
        "plane","radar","rifle","robot","shoes","slave","snail","solid","spice","spoon",
        "sword","table","teeth","tiger","torch","train","water","woman","money","zebra",
        "pencil","school","hammer","window","banana","softly","bottle","tomato","prison",
        "loudly","guitar","soccer","racket","flying","smooth","purple","hunter","forest",
        "banana","bottle","bridge","button","carpet","carrot","chisel","church","church",
        "circle","circus","circus","coffee","eraser","family","finger","flower","fungus",
        "garden","gloves","grapes","guitar","hammer","insect","liquid","magnet","meteor",
        "needle","pebble","pepper","pillow","planet","pocket","potato","prison","record",
        "rocket","saddle","school","shower","sphere","spiral","square","toilet","tongue",
        "tunnel","vacuum","weapon","window","sausage","blubber","network","walking","musical",
        "penguin","teacher","website","awesome","attatch","zooming","falling","moniter",
        "captain","bonding","shaving","desktop","flipper","monster","comment","element",
        "airport","balloon","bathtub","compass","crystal","diamond","feather","freeway",
        "highway","kitchen","library","monster","perfume","printer","pyramid","rainbow",
        "stomach","torpedo","vampire","vulture"];

    return words[Math.floor(Math.random() * words.length)];
}