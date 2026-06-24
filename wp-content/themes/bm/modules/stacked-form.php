<?php $uid = 'form_' . get_row_index(); ?>

<?php $anchor = get_sub_field('anchor_name'); ?>
<section id="stacked-form" class="contact stacked-form bm-beige">
    <div <?php if ($anchor): ?>id="<?php echo esc_attr($anchor); ?>"<?php endif; ?> class="container">
    <div class="row">
      <div class="col-12 mb-4">
        <h2 class="text-center">
          <?php the_sub_field('heading'); ?>
        </h2>

      </div>

      <div class="col-12 col-md-10 form-left mx-auto">
          <p><?php the_sub_field('txt'); ?></p>
        <!-- Toggle Button -->
        <div style="display: flex; justify-content: center;">
        <a id="<?php echo $uid; ?>_btn" class="btn btn-green mt-3">Complete Form</a>
        </div>
      </div>

      <div class="col-12 col-md-10 mx-auto" id="<?php echo $uid; ?>_form" style="display: none;">
        <?php
          $form_object = get_sub_field('form');
          gravity_form_enqueue_scripts($form_object['id'], true);
          gravity_form($form_object['id'], false, false, false, '', true, 1);
        ?>
      </div>
    </div>
  </div>
</section>

<style>
  section.contact.stacked-form .gform_wrapper .ginput_container input, 
  section.contact.stacked-form .gform_wrapper .ginput_container select, 
  section.contact.stacked-form .gform_wrapper .ginput_container textarea {
    background-color: #fff;
  }
  section.contact.stacked-form .gform_wrapper ::-webkit-input-placeholder { /* Chrome */
  color: #32214c !important;
  }
  section.contact.stacked-form .gform_wrapper :-ms-input-placeholder { /* IE 10+ */
    color: #32214c !important;
  }
  section.contact.stacked-form .gform_wrapper ::-moz-placeholder { /* Firefox 19+ */
    color: #32214c !important;
    opacity: 1 !important;
  }
  section.contact.stacked-form .gform_wrapper :-moz-placeholder { /* Firefox 4 - 18 */
    color: #32214c !important;
    opacity: 1 !important;
  }
  .contact.stacked-form .gsection, .contact.stacked-form .gfield.gfield--type-html {
    padding-top: 20px!important;
  }
  section.contact.stacked-form .gform_wrapper .ginput_container input, 
  section.contact.stacked-form .gform_wrapper .ginput_container select, 
  section.contact.stacked-form .gform_wrapper .ginput_container textarea {
    color: #32214c !important;
  }
  section.contact .gform-datepicker {
    width: 100%!important;
  }
  section.contact.stacked-form p {
    text-align: left!important;
    font-weight: 300;
  }
  .section.contact.stacked-form h2 {
   color:#a395b7!important;
  }
  section.contact.stacked-form .gform_wrapper.gravity-theme input[type=color], 
  section.contact.stacked-form .gform_wrapper.gravity-theme input[type=date], 
  section.contact.stacked-form .gform_wrapper.gravity-theme input[type=datetime-local], 
  section.contact.stacked-form .gform_wrapper.gravity-theme input[type=datetime], 
  section.contact.stacked-form .gform_wrapper.gravity-theme input[type=email], 
  section.contact.stacked-form .gform_wrapper.gravity-theme input[type=month], 
  section.contact.stacked-form .gform_wrapper.gravity-theme input[type=number], 
  section.contact.stacked-form .gform_wrapper.gravity-theme input[type=password], 
  section.contact.stacked-form .gform_wrapper.gravity-theme input[type=search], 
  section.contact.stacked-form .gform_wrapper.gravity-theme input[type=tel], 
  section.contact.stacked-form .gform_wrapper.gravity-theme input[type=text], 
  section.contact.stacked-form .gform_wrapper.gravity-theme input[type=time], 
  section.contact.stacked-form .gform_wrapper.gravity-theme input[type=url], 
  section.contact.stacked-form .gform_wrapper.gravity-theme input[type=week], 
  section.contact.stacked-form .gform_wrapper.gravity-theme select, section.contact.stacked-form .gform_wrapper.gravity-theme textarea {
    padding: 5px!important;
    font-size: 1.2rem;
  }
  #<?php echo $uid; ?>_form {
  opacity: 0;
  transition: opacity 0.6s ease-in-out;
  }

  #<?php echo $uid; ?>_form.fade-in {
    opacity: 1;
  }
</style>
<?php
add_action('wp_footer', function() use ($uid) {
?>
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const button = document.getElementById("<?php echo $uid; ?>_btn");
      const form = document.getElementById("<?php echo $uid; ?>_form");

      if (button && form) {
        button.addEventListener("click", function () {
          form.classList.add("fade-in");
          form.style.display = "block";
          button.style.display = "none";
        });
      }
    });
  </script>
<?php
});
?>