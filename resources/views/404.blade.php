<html>
<head>

<style type=text/css>
@import 'https://fonts.googleapis.com/css?family=Inconsolata';

html {
  min-height: 100%;
}

body {
  box-sizing: border-box;
  height: 100%;
  background-color: #000000;
  background-image: radial-gradient(#11581E, #041607), url("https://media.giphy.com/media/oEI9uBYSzLpBK/giphy.gif");
  background-repeat: no-repeat;
  background-size: cover;
  font-family: 'Inconsolata', Helvetica, sans-serif;
  font-size: 1.5rem;
  color: rgba(128, 255, 128, 0.8);
  text-shadow:
      0 0 1ex rgba(51, 255, 51, 1),
      0 0 2px rgba(255, 255, 255, 0.8);
}

.noise {
  pointer-events: none;
  position: absolute;
  width: 100%;
  height: 100%;
  background-image: url("https://media.giphy.com/media/oEI9uBYSzLpBK/giphy.gif");
  background-repeat: no-repeat;
  background-size: cover;
  z-index: -1;
  opacity: .02;
}

.overlay {
  pointer-events: none;
  position: absolute;
  width: 100%;
  height: 100%;
  background:
      repeating-linear-gradient(
      180deg,
      rgba(0, 0, 0, 0) 0,
      rgba(0, 0, 0, 0.3) 50%,
      rgba(0, 0, 0, 0) 100%);
  background-size: auto 4px;
  z-index: 1;
}

.overlay::before {
  content: "";
  pointer-events: none;
  position: absolute;
  display: block;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  width: 100%;
  height: 100%;
  background-image: linear-gradient(
      0deg,
      transparent 0%,
      rgba(32, 128, 32, 0.2) 2%,
      rgba(32, 128, 32, 0.8) 3%,
      rgba(32, 128, 32, 0.2) 3%,
      transparent 100%);
  background-repeat: no-repeat;
  animation: scan 7.5s linear 0s infinite;
}

@keyframes scan {
  0%        { background-position: 0 -100vh; }
  35%, 100% { background-position: 0 100vh; }
}

.terminal {
  box-sizing: inherit;
  position: absolute;
  height: 100%;
  width: 1000px;
  max-width: 100%;
  padding: 4rem;
  text-transform: uppercase;
}

.output {
  color: rgba(128, 255, 128, 0.8);
  text-shadow:
      0 0 1px rgba(51, 255, 51, 0.4),
      0 0 2px rgba(255, 255, 255, 0.8);
}

.output::before {
  content: "> ";
}

/*
.input {
  color: rgba(192, 255, 192, 0.8);
  text-shadow:
      0 0 1px rgba(51, 255, 51, 0.4),
      0 0 2px rgba(255, 255, 255, 0.8);
}

.input::before {
  content: "$ ";
}
*/

a {
  color: #fff;
  text-decoration: none;
}

a::before {
  content: "[";
}

a::after {
  content: "]";
}

.errorcode {
  color: white;
}
</style>
</head>

<body>

<div class="noise"></div>
<div class="overlay"></div>
<div class="terminal">
  <h1>Error <span class="errorcode">404</span></h1>
  <p class="output">The page you are looking for might have been removed, had its name changed or is temporarily unavailable.</p>
  <p class="output">Please try to <a href="#" onclick="goBack()">go back</a> </p>
  <p class="output">Good luck.</p>
</div>


</body>
</html>


<script>
    var $copyContainer = $(".copy-container"),
    $replayIcon = $('#cb-replay'),
    $copyWidth = $('.copy-container').find('p').width();

var mySplitText = new SplitText($copyContainer, {type:"words"}),
    splitTextTimeline = new TimelineMax();
var handleTL = new TimelineMax();

// WIP - need to clean up, work on initial state and handle issue with multiple lines on mobile

var tl = new TimelineMax();

tl.add(function(){
  animateCopy();
  blinkHandle();
}, 0.2)

function animateCopy() {
  mySplitText.split({type:"chars, words"}) 
  splitTextTimeline.staggerFrom(mySplitText.chars, 0.001, {autoAlpha:0, ease:Back.easeInOut.config(1.7), onComplete: function(){
    animateHandle()
  }}, 0.05);
}

function blinkHandle() {
  handleTL.fromTo('.handle', 0.4, {autoAlpha:0},{autoAlpha:1, repeat:-1, yoyo:true}, 0);
}

function animateHandle() {
  handleTL.to('.handle', 0.7, {x:$copyWidth, ease:SteppedEase.config(12)}, 0.05);
}

$('#cb-replay').on('click', function(){
  splitTextTimeline.restart()
  handleTL.restart()
})

function goBack() {
            window.history.back()
        }
</script>