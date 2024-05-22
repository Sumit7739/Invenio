const board = document.getElementById('board');
const cells = board.getElementsByClassName('cell');
const playerScoreElement = document.getElementById('playerScore');
const computerScoreElement = document.getElementById('computerScore');
let playerScore = 0;
let computerScore = 0;
let currentPlayer = 'X';
let gameOver = false;

function makeMove(cell) {
    if (!cell.textContent && !gameOver) {
        cell.textContent = 'X'; // Human player's move

        if (checkWinner('X')) {
            setTimeout(() => {
                alert('You win!');
                playerScore++;
                updateScore();
                resetBoard();
            }, 100);
        } else if ([...cells].every(cell => cell.textContent !== '')) {
            setTimeout(() => {
                alert("It's a draw!");
                resetBoard();
            }, 100);
        } else {
            currentPlayer = 'O';
            makeComputerMove();
        }
    }
}

function makeComputerMove() {
    const emptyCells = [...cells].filter(cell => !cell.textContent);

    if (emptyCells.length > 0) {
        const randomIndex = Math.floor(Math.random() * emptyCells.length);
        const computerMove = emptyCells[randomIndex];
        computerMove.textContent = 'O'; // Computer's move

        if (checkWinner('O')) {
            setTimeout(() => {
                alert('Computer wins!');
                computerScore++;
                updateScore();
                resetBoard();
            }, 100);
        } else if ([...cells].every(cell => cell.textContent !== '')) {
            setTimeout(() => {
                alert("It's a draw!");
                resetBoard();
            }, 100);
        } else {
            currentPlayer = 'X';
        }
    }
}

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
    gameOver = false;
}

function updateScore() {
    playerScoreElement.textContent = playerScore;
    computerScoreElement.textContent = computerScore;
}