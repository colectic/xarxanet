/**
* Anniversary JS scripts
*/

var element1 = document.querySelector('.front #confetti');
var element2 = document.querySelector('.front #confetti');
var element3 = document.querySelector('.front #confetti');


setTimeout(() => {
  party.confetti(element1, {
    count: party.variation.range(46, 60),
    speed: party.variation.range(50, 295),
    spread: party.variation.range(90, 180),
    size: party.variation.range(0.4, 1.9)
  });
}, 600);

setTimeout(() => {
  party.confetti(element2, {
    count: party.variation.range(50, 60),
    speed: party.variation.range(20, 300),
    spread: party.variation.range(20, 120),
    size: party.variation.range(0.2, 1.1)
  });
}, 1600);

setTimeout(() => {
  party.confetti(element3, {
    count: party.variation.range(40, 55),
    speed: party.variation.range(50, 300),
    spread: party.variation.range(50, 180),
    size: party.variation.range(0.6, 1.75)
  });
}, 3600);
