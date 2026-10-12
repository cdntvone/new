<?php $hack_title = 'Contact Us'; get_header(); ?>
   <div class="jumbo-hero d-none d-md-block" style="background-image:url(https://i2.wp.com/tmdb.org/t/p/original/z1EBf0SqPC4dXIwg9NmxNBegxas.jpg)">
      <div class="container">
         <div class="jumbo-hero__inner">
            <h1 class="header">Contact Us</h1>
         </div>
      </div>
   </div>
   <section class="mopie-fade">
      <div class="container">
      <div class="row">
      <div class="col">
         <p align="justify">Have any question, comment, suggestion or news tip to pass along to <?php echo $_SERVER['SERVER_NAME'];?>?</p>
         <p align="justify">We are open to discuss all of the possibilities with you. This page offering the right way to
            sent any comments to&nbsp;<?php echo $_SERVER['SERVER_NAME'];?> admin related to your feedback, news coverage and other issues
            related to this site.
         </p>
         <p>We are happy to hear information from you please write a subject format:</p>
         <ul>
            <li><strong>Claim Picture</strong>&nbsp;[picture name] [url to real picture] : if you are the real owner to
               claim your picture and need back links.
            </li>
            <li><strong>Submit Wallpapers</strong>&nbsp;[wallpaper name] : if you wanna submit your or your wallpaper design
               to us.
            </li>
            <li><strong>Advertise</strong>&nbsp;: if you interested to advertising on our site.</li>
            <li><strong>Support</strong> : if you need our support.</li>
         </ul>
         <p>And send all your inquiries to our official mail at <a href="mailto:<?php echo options( 'email' ); ?>"><?php echo options( 'email' ); ?></a></p>
         <p align="justify">Don’t hesitate to contact us according your concerns and don’t worry, all of your comment are
            welcome. :) 
         </p>
         <p align="justify">Thank you.</p>
      </div>
   </section>
<?php get_footer();?>