document.addEventListener('DOMContentLoaded', function () {
    const board = document.getElementById('board');
    const cells = board.getElementsByClassName('cell');
    const playerScoreElement = document.getElementById('playerScore');
    const computerScoreElement = document.getElementById('computerScore');
    const messageElement = document.getElementById('message'); // New element for the message
    let currentPlayer = 'X';
    let playerScore = 0;
    let computerScore = 0;

    board.addEventListener('click', handleCellClick);

    function handleCellClick(event) {
        const cell = event.target;
        if (!cell.textContent && currentPlayer === 'X') {
            cell.textContent = 'X'; // Human player's move
            if (checkWinner('X')) {
                playerScore++;
                updateScores();
                setTimeout(() => {
                    alert('You win!');
                    resetBoard();
                }, 100);
                return;
            } else if ([...cells].every(cell => cell.textContent !== '')) {
                setTimeout(() => {
                    alert("It's a draw!");
                    resetBoard();
                }, 100);
                return;
            }
            // Show the "Thinking" message
            messageElement.textContent = 'Computer: Thinking...';
            messageElement.style.display = 'block';
            setTimeout(() => {
                makeComputerMove();
                messageElement.style.display = 'none';
            }, 500); // Adjust the delay as needed
        }
    }

    function makeComputerMove() {
        const bestMove = findBestMove();
        if (bestMove !== -1) {
            cells[bestMove].textContent = 'O';
            if (checkWinner('O')) {
                computerScore++;
                updateScores();
                setTimeout(() => {
                    alert('Computer wins!');
                    resetBoard();
                }, 100);
            }
        }
    }

    function findBestMove() {
        let bestMove = -1;
        let bestScore = -Infinity;
        for (let i = 0; i < cells.length; i++) {
            if (!cells[i].textContent) {
                cells[i].textContent = 'O';
                let score = minimax(cells, 0, false);
                cells[i].textContent = '';
                if (score > bestScore) {
                    bestScore = score;
                    bestMove = i;
                }
            }
        }
        return bestMove;
    }

    //Minimax algorithm for AI move calculation
    function minimax(board, depth, isMaximizing) {
        const scores = {
            X: -1,
            O: 1,
            draw: 0
        };

        if (checkWinner('O')) {
            return scores['O'];
        }

        if (checkWinner('X')) {
            return scores['X'];
        }

        if ([...cells].every(cell => cell.textContent !== '')) {
            return scores['draw'];
        }

        if (isMaximizing) {
            let bestScore = -Infinity;
            for (let i = 0; i < cells.length; i++) {
                if (!cells[i].textContent) {
                    cells[i].textContent = 'O';
                    const score = minimax(cells, depth + 1, false);
                    cells[i].textContent = '';
                    bestScore = Math.max(score, bestScore);
                }
            }
            return bestScore;
        } else {
            let bestScore = Infinity;
            for (let i = 0; i < cells.length; i++) {
                if (!cells[i].textContent) {
                    cells[i].textContent = 'X';
                    const score = minimax(cells, depth + 1, true);
                    cells[i].textContent = '';
                    bestScore = Math.min(score, bestScore);
                }
            }
            return bestScore;
        }
    }

    // Check if a player has won the game
    function checkWinner(player) {
        const winningCombinations = [
            [0, 1, 2], [3, 4, 5], [6, 7, 8],
            [0, 3, 6], [1, 4, 7], [2, 5, 8],
            [0, 4, 8], [2, 4, 6]
        ];

        for (const combination of winningCombinations) {
            const [a, b, c] = combination;
            if (cells[a].textContent === player && cells[b].textContent === player && cells[c].textContent === player) {
                return true;
            }
        }
        return false;
    }

    function resetBoard() {
        for (const cell of cells) {
            cell.textContent = '';
        }
        currentPlayer = 'X';
    }

    function updateScores() {
        playerScoreElement.textContent = playerScore;
        computerScoreElement.textContent = computerScore;
    }
});