<?php
$page = $_SERVER['PHP_SELF'];
$sec = "900";
?>

<head>
  <link rel="stylesheet" type="text/css" href="style.css">
  <meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
</head>
<body>
<div class="slideshow-container">


<?php
 
function getFeed($feed_url) {
     
    $content = file_get_contents($feed_url);
    $x = new SimpleXmlElement($content);
        
    $i=0;
    foreach($x->channel->item as $entry) if ($i < 5) {


      # middels deze string kun je de afbeelding uitlezen
    	# $entry->xpath('enclosure/@url')[0];
    	# dit zorgt ervoor dat de high res image wordt gebruikt in plaats van de standaard thumbnail
    	$image = str_replace(sqr256,sqr1024,$entry->xpath('enclosure/@url')[0]);
?>    	
      <div class="mySlides fade">
        <img src="<?php echo "$image" ?>" style="width:100%">
      <div class="content">
        <div class="title"><?php echo "$entry->title"?></div>
        <div class="description"><?php echo "$entry->description" ?></div>
      </div>
      </div>
 <?php
        $i +=1;
}
}
?>

</div>

<?php
getFeed("https://www.nu.nl/rss/algemeen");
?>
</body>
<script>

var slideIndex = 0;
showSlides();

function showSlides() {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}
  slides[slideIndex-1].style.display = "block";
  setTimeout(showSlides, 10000); // Change image every 10 seconds
}
  </script>