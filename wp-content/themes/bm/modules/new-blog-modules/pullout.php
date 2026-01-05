<style>
  .snippet {
    color: #fff;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    padding: 20px;
    -ms-flex-wrap: wrap;
        flex-wrap: wrap;
    -webkit-box-pack: center;
        -ms-flex-pack: center;
            justify-content: center;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
        -ms-flex-direction: column;
            flex-direction: column;
  }
  .pull-out-section a:hover {
    text-decoration: none;
  }
  .pull-out-section {
    margin-top: 30px;
    margin-bottom: 30px;
  }
</style>

<section class="pull-out-section">
  <div class="container">
    <?php $link = get_sub_field('add_link'); ?>

    <?php
      $link_url = $link['url'];
      $link_title = $link['title'];
      $link_target = $link['target'] ? $link['target'] : '_self';
      ?>

    <a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
      <div class="row d-flex flex-row">
        <?php $link = get_sub_field('add_link'); ?>
      
  
         <div class="col-12 col-md-4 mx-auto img-box" style="background: url('/wp-content/uploads/2020/07/BM_blog_graphic.jpg') 50%/cover no-repeat; color: #FFFFFF; min-height:200px;"></div>
     
        
      
          <div class="col-12 col-md-8 snippet" style="background-color:#a395b7;">
             <?php if( get_sub_field('title') ): ?>
                  <h4>
                    <?php the_sub_field('title'); ?>
                  </h4>
             <?php endif; ?>
             <?php the_sub_field('description'); ?>
  
          </div>
      
      
  
      </div>
    </a>
  </div>
</section>
