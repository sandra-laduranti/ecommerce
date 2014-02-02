<?php $this->_title = "Accueil" ?>
<div id="bienvenue">
  <p>Bienvenue chez nous amis teasers puisse l'alcool vous donner la joie de vivre !</p>
</div>
<!--SLIDES DES ALCOOLS-->
            <div class="wrapper">

                       <!-- Beginning of the slider markup -->
                      <div id="metaContainer">

                         
                          <div class="backLink"><a href="#" title="Back" id="back">Back</a></div>

                          <!-- The sliderr works with virtually any HTML element (div, span etc) but for the sake of simplicity I have used images in this demo -->
                          <div id="slideContainer">
                            <div id="slideShim">
                                <a href="#"><img src="assets/img/slides/vin.png" alt="Slide One" /></a>
                                <a href="#"><img src="assets/img/slides/vin2.png" alt="Slide Two" /></a>
                                <a href="#"><img src="assets/img/slides/vin3.png" alt="Slide Three" /></a>
                            </div>
                          </div>

                        <div class="forwardLink"><a href="#" title="Forward" id="forward">Forward</a></div>
                        <div id="pager" class=""></div>
                      </div>
                       <!-- End of the slider markup -->
                       <link rel="stylesheet" href="styles/screen.css" type="text/css" media="screen" />  
            <script type="text/javascript" src="scripts/jquery.cycle.all.min.js"></script>
            <script type="text/javascript">
            $(document).ready(function(){

              $('#slideShim').cycle({ 
                  fx:     'fade',
                  speed:  1500,
                  timeout: 4000,
                  prev:   '#back',
                  next:   '#forward',
                  pause:  1,
                  pager:  '#pager'
              });

          });
            </script>
          </div>

<div id="Bmessage">
  <p>La maison Para'tease vous offre un grand choix d'alcool allant de la bière au champagne en passant par les vins. Nous espéronsque vous trouverez chez nous tout le bonheur que vous espériez. Bon voyage !</p>
</div>
