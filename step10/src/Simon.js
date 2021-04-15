import * as $ from 'jquery';

export const Simon = function(sel) {
    const that = this;

    this.sequence = []
    this.state = "initial";
    this.sequence.push(Math.floor(Math.random() * 4));
    this.current = 0;

    this.initialize = function() {
        console.log('Simon started');

        const div = $(sel);
        div.html(
            '<form>' +
            '<p>' +
            '<input type="button" value="Red">' +
            '<input type="button" value="Green">' +
            '<input type="button" value="Blue">' +
            '<input type="button" value="Yellow">' +
            '</p>' +
            '<p>' +
            '<input id="start" type="button" value="Start">' +
            '</p>' +
            '</form>' +
            '<audio id="red" src="audio/red.mp3" preload="auto"></audio>' +
            '<audio id="green" src="audio/green.mp3" preload="auto"></audio>' +
            '<audio id="blue" src="audio/blue.mp3" preload="auto"></audio>' +
            '<audio id="yellow" src="audio/yellow.mp3" preload="auto"></audio>' +
            '<audio id="buzzer" src="audio/buzzer.mp3" preload="auto"></audio>'
        );

        this.form = div.find('form');
        const start = this.form.find('#start');
        start.click(function(event) {
            that.onStart();
        });
    }

    this.onStart = function() {
        console.log('Start button pressed');

        const start = this.form.find('#start');
        start.remove();

        this.configureButton(0, "red");
        this.configureButton(1, "green");
        this.configureButton(2, "blue");
        this.configureButton(3, "yellow");

        this.play();
    }

    this.configureButton = function(ndx, color) {
        var button = $(this.form.find("input").get(ndx));
        var that = this;

        button.click(function(event) {
            document.getElementById(color).currentTime = 0;
            document.getElementById(color).play();
            that.buttonPress(ndx);
        });

        button.mousedown(function(event) {
            button.css("background-color", color);
        });

        button.mouseup(function(event) {
            button.css("background-color", "lightgrey");
        });
    }

    this.play = function() {
        this.state = "play";    // State is now playing
        this.current = 0;       // Starting with the first one

        this.playCurrent();
    }

    this.playCurrent = function() {
        var that = this;

        if(this.current < this.sequence.length) {
            // We have one to play
            var colors = ['red', 'green', 'blue', 'yellow'];
            console.log("Playing: " + this.sequence[this.current])
            document.getElementById(colors[this.sequence[this.current]]).play();
            this.buttonOn(this.sequence[this.current])
            this.current++;

            window.setTimeout(function() {
                that.playCurrent();
            }, 1000);
        } else {
            this.current = 0;
            this.buttonOn(-1);
            this.state = "enter";
        }
    }

    this.buttonOn = function(button) {
        var colors = ['red', 'green', 'blue', 'yellow'];
        for (var i = 0; i < 4; i++) {
            var instButton = $(this.form.find("input").get(i));
            if(button == i){
                instButton.css("background-color", colors[i]);
            }else{
                instButton.css("background-color", "lightgrey");
            }
        }
    }

    this.buttonPress = function(index) {
        var that = this;
        console.log("Pressed Button: " + index);
        // If the person gets the sequence wrong
        if(index !== that.sequence[that.current]){
            // Play the buzzer
            console.log("Restarting game...")
            document.getElementById("buzzer").play();
            window.setTimeout(function() {
                that.initialize();
                that.sequence = [];
                that.state = "initial";
                that.current = 0;
                that.sequence.push(Math.floor(Math.random() * 4));
            }, 1000);
        }
        // If the person gets the sequence right
        else if(that.current >= that.sequence.length - 1){
            console.log("Adding additional color to sequence")
            that.sequence.push(Math.floor(Math.random() * 4));
            window.setTimeout(function() {
                that.playCurrent();
            }, 1000);
            that.current = 0;
            return;
        }
        else {
            that.current++;
        }
    }

    // Ensure this is the last line of the function!
    this.initialize();
}


