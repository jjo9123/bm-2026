<?php if( get_sub_field('quote') ): ?>
<style>
  .single section.quotes {
    padding: 20px 0 30px;
  }
  section.quotes .quote:before {
    color: #8ed300;
    content: '“';
    display: block;
    font-family: gil-sans-nova;
    font-size: 4rem;
    font-weight: 500;
    line-height: 10px;
    margin-top: 40px;
  }
   section.quotes .quote:after {
    color: #8ed300;
    content: '”';
    display: block;
    font-family: gil-sans-nova;
    font-size: 4rem;
    font-weight: 500;
    line-height: 10px;
    margin-top: 40px;
  }
</style>
<section class="quotes text-center <?php if( get_sub_field('white_or_grey') == 'grey'): ?> grey<?php endif; ?>">
  <div class="container">
    <div class="row">
      
      <div class="col-12 mx-auto quote">
           
                <p>
                  <?php the_sub_field('quote'); ?>
                </p>

      </div>

    </div>
  </div>
</section>
<?php endif; ?>