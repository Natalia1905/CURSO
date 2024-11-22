const cards = [
  {id: 1, images: "juegos/normal/curso2/images/cloudd.png"},
  {id: 2, images: "juegos/normal/curso2/images/heart.png"},
  {id: 3, images: "juegos/normal/curso2/images/flower.png"},
  {id: 4, images: "juegos/normal/curso2/images/egg.png"},
  {id: 5, images: "juegos/normal/curso2/images/icecream.png"},
  {id: 6, images: "juegos/normal/curso2/images/rainbow.png"},
  {id: 7, images: "juegos/normal/curso2/images/sun.png"},
  {id: 8, images: "juegos/normal/curso2/images/mushroom.png"},
];
let moveCount = 0;
let startTime,timerInterval;
let timerStarted = false;
let firstCard,secondCard;
let lockBoard = false;
let matches = 0;
let cardArray = [...cards,...cards];
cardArray.sort(()=>0.5-Math.random());
const gameBoard = document.querySelector(".memory-game");

function createCard(card) {
  const cardElement = document.createElement("div");
  cardElement.classList.add("card");
  cardElement.dataset.id = card.id;
  cardElement.innerHTML = `
    <div class="front-face"><img src="${card.images}" alt="Card Image"  ></div>
    <div class="back-face"><img src="juegos/normal/curso2/images/back.jpg" alt="Card Image" ></div>
  `
  cardElement.addEventListener("click",flipCard);
  gameBoard.appendChild(cardElement);
}

cardArray.forEach(createCard);

function flipCard() {
  if(lockBoard) return;
  if(this === firstCard) return;
  if(!timerStarted) {
    startTimer();
    timerStarted = true;
  }
  this.classList.add("flip");
  if(!firstCard) {
    firstCard = this;
    return;
  }
  secondCard = this;
  lockBoard = true;
  updateMoveCounter();
  checkForMatch();
}

function startTimer() {
  startTime = new Date();
  timerInterval = setInterval(()=>{
    const elapsedTime =new Date() - startTime;
    const minutes = Math.floor(elapsedTime/60000);
    const seconds = Math.floor((elapsedTime%60000)/1000);
    document.getElementById("timer").textContent = `Time: ${minutes.toString().padStart(2,'0')}:${seconds.toString().padStart(2,'0')}`;
  },1000);
}

function updateMoveCounter() {
  moveCount++;
  document.getElementById("moveCounter").textContent = `Move: ${moveCount}`;
}

function checkForMatch() {
  let isMatch = firstCard.dataset.id === secondCard.dataset.id;
  isMatch ? disableCards() : unflipCards();
}

function disableCards() {
  firstCard.removeEventListener("click",flipCard);
  secondCard.removeEventListener("click",flipCard);

  resetBoard();
  matches++;
  if(matches === cards.length) {
    stopTimer();
    winningMessage.classList.add("show");
    setTimeout(function(){
      winningMessage.classList.remove("show");
    },2000);
  }
}

function unflipCards() {
  setTimeout(()=>{
    firstCard.classList.remove("flip");
    secondCard.classList.remove("flip");
    resetBoard();
  },1500);
}

function resetBoard() {
  [firstCard,secondCard,lockBoard] = [null,null,false];
}

function stopTimer() {
  clearInterval(timerInterval);
}

function resetGame() {
   moveCount = -1;
   updateMoveCounter();
   resetTimer();
   timerStarted = false;
   [firstCard,secondCard,lockBoard] = [null,null,false];
   matches = 0;
   cardArray.sort(()=>0.5-Math.random());
   while (gameBoard.firstChild) {
    gameBoard.removeChild(gameBoard.firstChild);
   }
   cardArray.forEach(createCard);
}

document.getElementById("resetButton").addEventListener("click",resetGame);

function resetTimer() {
  clearInterval(timerInterval);
  document.getElementById("timer").textContent = "Time: 00:00";
}































