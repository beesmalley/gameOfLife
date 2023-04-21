const rows = 20;
const cols = 35;


const gamebox = document.getElementById("gamebox");
const grid = createGrid(rows, cols);
gamebox.appendChild(grid);

function resetGrid() {
    const cells = grid.querySelectorAll(".cell");
    cells.forEach((cell) => {
      cell.setAttribute("data-status", "dead");
    });
  }

  const resetButton = document.getElementById("reset");
  resetButton.addEventListener("click", resetGrid);

  const startButton = document.getElementById("start");
  startButton.addEventListener("click", start);

  const stopButton = document.getElementById("stop");
  stopButton.addEventListener("click", stop);

  const upOneButton = document.getElementById("upOne");
  upOneButton.addEventListener("click", () => {
    increment(1);
  });
  
  const upManyButton = document.getElementById("upMany");
  upManyButton.addEventListener("click", () => {
    increment(23);
  });


  let intervalId;

  function start() {
    intervalId = setInterval(() => {
      updateCells();
    }, 1000);
  }

  function increment(times){
    for(let i=0;i<times;i++){
        updateCells();
    }
  }
  
  function stop() {
    clearInterval(intervalId);
  }

function createGrid(rows, cols) {
    const grid = document.createElement("div");
    grid.classList.add("grid");
    grid.style.setProperty("--grid-rows", rows);
    grid.style.setProperty("--grid-cols", cols);
    for (let i = 0; i < rows * cols; i++) {
      const cell = document.createElement("div");
      cell.className = "cell";
      cell.setAttribute("data-status", "dead");
      grid.appendChild(cell);
    }
    return grid;
  }

  function updateCells() {
    const cells = grid.querySelectorAll(".cell");
    const cellArray = Array.from(cells);
  
    cellArray.forEach((cell, index) => {
      const col = index % cols;
      const row = Math.floor(index / cols);
  
      const neighbors = getNeighbors(row, col, cellArray);
      const liveNeighbors = neighbors.filter((n) => n.getAttribute("data-status") === "alive");
  
      if (cell.getAttribute("data-status") === "alive") {
        if (liveNeighbors.length < 2 || liveNeighbors.length > 3) {
          cell.setAttribute("data-status", "dead");
        }
      } else {
        if (liveNeighbors.length === 3) {
          cell.setAttribute("data-status", "alive");
        }
      }
    });
  }

  function getNeighbors(row, col, cellArray) {
    const neighbors = [];
    for (let i = row - 1; i <= row + 1; i++) {
      for (let j = col - 1; j <= col + 1; j++) {
        if (i >= 0 && i < rows && j >= 0 && j < cols && !(i === row && j === col)) {
          const index = i * cols + j;
          const neighbor = cellArray[index];
          neighbors.push(neighbor);
        }
      }
    }
    return neighbors;
  }

  grid.addEventListener("click", (e) => {
    const cell = e.target;
    if (cell.classList.contains("cell")) {
      if (cell.getAttribute("data-status") === "dead") {
        cell.setAttribute("data-status", "alive");
      } else {
        cell.setAttribute("data-status", "dead");
      }
    }
  });

  

  function pulsarPattern() {
    const cells = grid.querySelectorAll(".cell");
    const cellArray = Array.from(cells);
    const middleRow = Math.floor(rows / 2);
    const middleCol = Math.floor(cols / 2);
  
    // set top left quadrant of Pulsar pattern
    setCellStatus(cellArray, middleRow - 2, middleCol - 2, "alive");
    setCellStatus(cellArray, middleRow - 2, middleCol - 1, "alive");
    setCellStatus(cellArray, middleRow - 2, middleCol, "alive");
    setCellStatus(cellArray, middleRow - 1, middleCol - 2, "alive");
    setCellStatus(cellArray, middleRow - 1, middleCol, "alive");
    setCellStatus(cellArray, middleRow, middleCol - 2, "alive");
    setCellStatus(cellArray, middleRow, middleCol - 1, "alive");
    setCellStatus(cellArray, middleRow, middleCol, "alive");
  
    // set bottom right quadrant of Pulsar pattern
    setCellStatus(cellArray, middleRow + 2, middleCol + 2, "alive");
    setCellStatus(cellArray, middleRow + 2, middleCol + 1, "alive");
    setCellStatus(cellArray, middleRow + 2, middleCol, "alive");
    setCellStatus(cellArray, middleRow + 1, middleCol + 2, "alive");
    setCellStatus(cellArray, middleRow + 1, middleCol, "alive");
    setCellStatus(cellArray, middleRow, middleCol + 2, "alive");
    setCellStatus(cellArray, middleRow, middleCol + 1, "alive");
  }
  
  function setCellStatus(cellArray, row, col, status) {
    const index = row * cols + col;
    const cell = cellArray[index];
    cell.setAttribute("data-status", status);
  }
  
  const animateSelect = document.querySelector("select");

  animateSelect.addEventListener("change", () => {
    if (animateSelect.value === "The Pulsar") {
      pulsarPattern();
    } else if (animateSelect.value === "The Toad") {
      toadPattern();
    } else if (animateSelect.value === "The Beacon") {
      beaconPattern();
    } else {
      clearGrid();
    }
  });

  function toadPattern() {
    const cells = grid.querySelectorAll(".cell");
    const cellArray = Array.from(cells);
    const middleRowIndex = Math.floor((20 - 2) / 2);
    const middleColIndex = Math.floor((35 - 4) / 2);
    const toadIndexes = [
      middleRowIndex * 35 + middleColIndex,
      middleRowIndex * 35 + middleColIndex + 1,
      middleRowIndex * 35 + middleColIndex + 2,
      (middleRowIndex + 1) * 35 + middleColIndex - 1,
      (middleRowIndex + 1) * 35 + middleColIndex,
      (middleRowIndex + 1) * 35 + middleColIndex + 1,
    ];
  
    cellArray.forEach((cell, index) => {
      if (toadIndexes.includes(index)) {
        cell.setAttribute("data-status", "alive");
      } else {
        cell.setAttribute("data-status", "dead");
      }
    });
  }

  function beaconPattern() {
    const cells = grid.querySelectorAll(".cell");
    const cellArray = Array.from(cells);
    const middleRowIndex = Math.floor((20 - 4) / 2);
    const middleColIndex = Math.floor((35 - 4) / 2);
    const beaconIndexes = [
      middleRowIndex * 35 + middleColIndex,
      middleRowIndex * 35 + middleColIndex + 1,
      (middleRowIndex + 1) * 35 + middleColIndex,
      (middleRowIndex + 1) * 35 + middleColIndex + 1,
      (middleRowIndex + 2) * 35 + middleColIndex + 2,
      (middleRowIndex + 2) * 35 + middleColIndex + 3,
      (middleRowIndex + 3) * 35 + middleColIndex + 2,
      (middleRowIndex + 3) * 35 + middleColIndex + 3,
    ];
  
    cellArray.forEach((cell, index) => {
      if (beaconIndexes.includes(index)) {
        cell.setAttribute("data-status", "alive");
      } else {
        cell.setAttribute("data-status", "dead");
      }
    });
  }



