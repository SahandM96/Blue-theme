<?php
/*
Template Name: Contact Us
*/
?>
<?php get_header(); ?>
  <div class="Main_Page">
    <div class="Contact">
    <div class="Contact-form">
      <?php
        echo do_shortcode('[contact-form-7 id="457" title="Untitled"]');
       ?>
    </div>
     <div class="Contact-info" dir="rtl">
       <table dir="rtl">
          <h6>راه های تماس</h6>
         <tr>
           <td>
             <img src="<?php bloginfo(template_directory)?>/images/mobile.png" alt="" />
           </td>
           <td >مدیریت :09113922169</td>
         </tr>
         <tr>
           <td>
             <img src="<?php bloginfo(template_directory)?>/images/phone.png" alt="" />
           </td>
           <td >
             رستوران :
           </td>
         </tr>
         <tr dir="ltr">
           <td>
             <img src="<?php bloginfo(template_directory)?>/images/email.png" alt="" />
           </td>
           <td >
             Email:info@blue--restaurant.com
           </td>
         </tr>
         <tr>
           <td>
             <img src="<?php bloginfo(template_directory)?>/images/address.png" alt="" />
           </td>
           <td >
              آدرس: سیاه بیشه رستوران آبی
           </td>
         </tr>
       </table>
     </div>
 </div>
</div>
<!-- dont close this class it's trick -->
<?php get_footer(); ?>
