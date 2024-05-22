let currentPlayer = 'X';
let scoreX = 0;
let scoreO = 0;
const board = document.getElementById('board');
const cells = board.getElementsByClassName('cell');
const scoreXElement = document.getElementById('scoreX');
const scoreOElement = document.getElementById('scoreO');

function makeMove(cell) {
  if (!cell.textContent) {
    cell.textContent = currentPlayer;
    cell.classList.add(currentPlayer);
    if (checkWinner()) {
      updateScore(currentPlayer);
      setTimeout(() => {
        alert(`${currentPlayer} wins!`);
        resetBoard();
      }, 100);
    } else if ([...cells].every(cell => cell.textContent !== '')) {
      setTimeout(() => {
        alert("It's a draw!");
        resetBoard();
      }, 100);
    } else {
      currentPlayer = currentPlayer === 'X' ? 'O' : 'X';
    }
  }
}

function checkWinner() {
  const winningCombinations = [
    [0, 1, 2], [3, 4, 5], [6, 7, 8],
    [0, 3, 6], [1, 4, 7], [2, 5, 8],
    [0, 4, 8], [2, 4, 6]
  ];

  for (const combination of winningCombinations) {
    const [a, b, c] = combination;
    if (cells[a].textContent && cells[a].textContent === cells[b].textContent && cells[a].textContent === cells[c].textContent) {
      return true;
    }
  }
  return false;
}

function updateScore(player) {
  if (player === 'X') {
    scoreX++;
    scoreXElement.textContent = scoreX;
  } else {
    scoreO++;
    scoreOElement.textContent = scoreO;
  }
}

function resetBoard() {
  for (const cell of cells) {
    cell.textContent = '';
    cell.classList.remove('X', 'O');
  }
  currentPlayer = 'X';
}