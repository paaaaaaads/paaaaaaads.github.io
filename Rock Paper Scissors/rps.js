        const modal = document.querySelector('.modal');
        const playerImage = document.getElementById('playerImage');
        const computerImage = document.getElementById('computerImage');
        const playerWinner = document.getElementById('playerWinner');
        const computerWinner = document.getElementById('computerWinner');
            
        function countdown() {
            let count = 5;
            const countdownElement = document.querySelector('.countdown');

            const interval = setInterval(() => {
                count--;
                countdownElement.innerHTML = count;

                if (count === 0) {
                    clearInterval(interval);
                    modal.style.display = 'none';
                    playGame(autoMove());
                    playerImage.classList.remove('player');
                    computerImage.classList.remove('computer');
                    countdownElement.innerHTML = 5;
                }
            }, 1000);

            function stopCountdown() {
                clearInterval(interval);
            }

            const playButtons = document.querySelectorAll('.playButton');
            const audio = document.getElementById('myAudio');

            playButtons.forEach(function (playButton) {
                playButton.addEventListener('click', function () {

                    stopCountdown();
                    playerImage.classList.remove('player');
                    computerImage.classList.remove('computer');
                    countdownElement.innerHTML = 5;
                    audio.pause();
                    audio.currentTime = 0;
                });
            });

        }

        function startGame() {
            const startButton = document.querySelector('.startButton');
            const audio = document.getElementById('myAudio');

            modal.style.display = 'flex';
            countdown();
            playerImage.classList.add('player');
            computerImage.classList.add('computer');
            computerWinner.style.visibility = 'hidden';
            playerWinner.style.visibility = 'hidden';
            playerWinner.innerHTML = 'Winner';
            computerWinner.innerHTML = 'Winner';
            winner.style.visibility = 'hidden';

            playerImage.src = 'Images/PlayerRock.svg';
            computerImage.src = 'Images/Rock.svg';
            audio.play();
        }

        let score = JSON.parse(sessionStorage.getItem('score')) || {
            wins: 0,
            loss: 0,
            ties: 0
        };

        function scoreDisplay() {
            const playerScore = document.getElementById('playerScore');
            const computerScore = document.getElementById('computerScore');
            playerScore.innerHTML = `${score.wins}`;
            computerScore.innerHTML = `${score.loss}`;
        }

        scoreDisplay();

        function resetScore() {
            score = {
                wins: 0,
                loss: 0,
                ties: 0
            };

            sessionStorage.removeItem('score');
            const confirmed = confirm(`Would you like to reset the score?`);
            if (confirmed) {

                scoreDisplay();

                const winner = document.getElementById('winner');
                playerWinner.style.visibility = 'hidden';
                computerWinner.style.visibility = 'hidden';
                playerWinner.innerHTML = 'Winner';
                computerWinner.innerHTML = 'Winner';
                winner.style.visibility = 'hidden';
            }

        }

        function autoMove() {
            const randomNumber = Math.random()

            let autoMove = '';

            if (randomNumber >= 0 && randomNumber < 1 / 3) {
                autoMove = 'Rock';
                computerImage.src = 'Images/Rock.svg';
            }
            else if (randomNumber >= 1 / 3 && randomNumber < 2 / 3) {
                autoMove = 'Paper';
                computerImage.src = 'Images/Paper.svg';
            }
            else if (randomNumber >= 2 / 3 && randomNumber < 1) {
                autoMove = 'Scissors';
                computerImage.src = 'Images/Scissors.svg';
            }

            return autoMove;
        }

        function pickcomputerMove() {
            const randomNumber = Math.random()

            let computerMove = '';

            if (randomNumber >= 0 && randomNumber < 1 / 3) {
                computerMove = 'Rock';
            }
            else if (randomNumber >= 1 / 3 && randomNumber < 2 / 3) {
                computerMove = 'Paper';
            }
            else if (randomNumber >= 2 / 3 && randomNumber < 1) {
                computerMove = 'Scissors';
            }

            return computerMove;
        }

        function playGame(playerMove) {

            const computerMove = pickcomputerMove();

            let result = '';

            if (playerMove === 'Rock') {

                playerImage.src = 'Images/PlayerRock.svg';

                if (computerMove === 'Rock') {
                    computerImage.src = 'Images/Rock.svg';
                    computerWinner.innerHTML = 'Tie';
                    playerWinner.innerHTML = 'Tie';
                    computerWinner.style.visibility = 'visible';
                    playerWinner.style.visibility = 'visible';
                    result = 'It\'s a tie!';
                }
                else if (computerMove === 'Paper') {
                    computerImage.src = 'Images/Paper.svg';
                    computerWinner.style.visibility = 'visible';
                    result = 'You lose!';
                }
                else if (computerMove === 'Scissors') {
                    computerImage.src = 'Images/Scissors.svg';
                    playerWinner.style.visibility = 'visible';
                    result = 'You win!';
                }
            }

            else if (playerMove === 'Paper') {
                playerImage.src = 'Images/PlayerPaper.svg';
                if (computerMove === 'Rock') {
                    computerImage.src = 'Images/Rock.svg';
                    playerWinner.style.visibility = 'visible';
                    result = 'You win!';
                }
                else if (computerMove === 'Paper') {
                    computerImage.src = 'Images/Paper.svg';
                    computerWinner.innerHTML = 'Tie';
                    playerWinner.innerHTML = 'Tie';
                    computerWinner.style.visibility = 'visible';
                    playerWinner.style.visibility = 'visible';
                    result = 'It\'s a tie!';
                }
                else if (computerMove === 'Scissors') {
                    computerImage.src = 'Images/Scissors.svg';
                    computerWinner.style.visibility = 'visible';
                    result = 'You lose!';
                }
            }

            else if (playerMove === 'Scissors') {
                playerImage.src = 'Images/PlayerScissors.svg';
                if (computerMove === 'Rock') {
                    computerImage.src = 'Images/Rock.svg';
                    computerWinner.style.visibility = 'visible';
                    result = 'You lose!';
                }
                else if (computerMove === 'Paper') {
                    computerImage.src = 'Images/Paper.svg';
                    playerWinner.style.visibility = 'visible';
                    result = 'You win!';
                }
                else if (computerMove === 'Scissors') {
                    computerImage.src = 'Images/Scissors.svg';
                    computerWinner.innerHTML = 'Tie';
                    playerWinner.innerHTML = 'Tie';
                    computerWinner.style.visibility = 'visible';
                    playerWinner.style.visibility = 'visible';
                    result = 'It\'s a tie!';
                }
            }

            if (result === 'You win!') {
                score.wins++;
            }
            else if (result === 'You lose!') {
                score.loss++;
            }
            else if (result === 'It\'s a tie!') {
                score.ties++;
            }

            sessionStorage.setItem('score', JSON.stringify(score));

            const winner = document.getElementById('winner');
            winner.innerHTML = `You picked ${playerMove}. Computer picked ${computerMove}. ${result}`
            winner.style.visibility = 'visible';

            modal.style.display = 'none';
            scoreDisplay();
        }