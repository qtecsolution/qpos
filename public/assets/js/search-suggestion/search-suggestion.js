
const input = document.querySelector('#hiringmanager');
const suggestion = document.querySelector('.desktop-suggestions');

input.addEventListener('keyup', (e) => {
  let suggestionData = e.target.value;
    console.log('0');
  if(suggestionData) {
    suggestion.classList.add('active');
  } else {
    suggestion.classList.remove('active');
  }
});

