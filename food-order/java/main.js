// Select Landing Page Element
let landingPage = document.querySelector(".landing-page");

// Get Array Of Imgs
let imagsArray = ["01.png", "02.png", "03.png", "04.png", "05.png", "06.png", "07.png", "08.png", "09.png", "10.png", ];

// Change Background Image Url
landingPage.style.backgroundImage = 'url("img/01.png")';




setInterval(() => {

    // Get Random Numer
    let randomNumber = Math.floor(Math.random() * imagsArray.length);

    // Change Background Image Url
    landingPage.style.backgroundImage = 'url("img/' + imagsArray[randomNumber] + '")';

}, 5000);


//















/* Rating */

/*
* Variables
*/
const productRating = document.getElementById('product1');
const stars = productRating.querySelectorAll('.star');
let rating = 0;

/*
* Event Listeners
*/
window.addEventListener('click', e => {
if(!e.target.matches('.star')) return;
e.preventDefault();

const starID = parseInt(e.target.getAttribute('data-star'));
const starScreenReaderText = e.target.querySelector('.screen-reader');
    
removeClassFromElements('is-active', stars);
highlightStars(starID);

resetScreenReaderText(stars);
starScreenReaderText.textContent = `${starID} Stars Selected`;

  rating = starID; // set rating
});

// Highlight on hover
window.addEventListener('mouseover', e => {
if(!e.target.matches('.star')) return;

removeClassFromElements('is-active', stars);
const starID = parseInt(e.target.getAttribute('data-star'));
highlightStars(starID);
});

//If a rating has been clicked, snap back to that rating on mouseleave
productRating.addEventListener('mouseleave', e => {
removeClassFromElements('is-active', stars);
if (rating === 0) return;
highlightStars(rating);
});

/*
* Functions
*/

// Highlight active star and all those upto it
function highlightStars(starID) {  
for (let i = 0; i < starID; i++) {
    stars[i].classList.add('is-active')
}
}

function removeClassFromElements(className, elements) {
for(let i = 0; i < elements.length; i++) {
    elements[i].classList.remove(className)
}
}

function resetScreenReaderText(stars) {
for(let i = 0; i < stars.length; i++) {
    const starID = stars[i].getAttribute('data-star');
    const text = stars[i].querySelector('.screen-reader');
    
    text.textContent = `${starID} Stars`;
}
}
