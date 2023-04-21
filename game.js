const rows = 20;
const cols = 35;

const gamebox = document.getElementById("gamebox");
const grid = createGrid(rows, cols);
gamebox.appendChild(grid);

function createGrid(rows, cols) {
    const grid = document.createElement("div");
    grid.classList.add("grid");
    grid.style.setProperty("--grid-rows", rows);
    grid.style.setProperty("--grid-cols", cols);
    for (let i = 0; i < rows * cols; i++) {
      const cell = document.createElement("div");
      cell.className = "cell";
      grid.appendChild(cell);
    }
    return grid;
  }

