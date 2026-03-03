<style>
  .table tr:nth-child(even) {background: #e7e7e7;}
</style>
<section class="txt table bm-white">
  <div class="container">
    <div class="row">
      
        <div class="col-12 col-lg-12 mx-auto" style="padding-bottom: 20px;">
           <?php if( get_sub_field('title') ): ?>
                <h2>
                  <?php the_sub_field('title'); ?>
                </h2>
           <?php endif; ?>
           
           <?php if( get_sub_field('description') ): ?>
                  <?php the_sub_field('description'); ?>
           <?php endif; ?>
           
        </div>
        <div class="col-12 col-lg-12 mx-auto">
          <?php 
            $table = get_sub_field('table');
          ?>
          <?php if ( ! empty ( $table ) ) {

              echo '<table border="0" class="table">';
          
                  if ( ! empty( $table['caption'] ) ) {
          
                      echo '<caption>' . $table['caption'] . '</caption>';
                  }
          
                  if ( ! empty( $table['header'] ) ) {
          
                      echo '<thead>';
          
                          echo '<tr>';
          
                              foreach ( $table['header'] as $th ) {
          
                                  echo '<th>';
                                      echo $th['c'];
                                  echo '</th>';
                              }
          
                          echo '</tr>';
          
                      echo '</thead>';
                  }
          
                  echo '<tbody>';
          
                      foreach ( $table['body'] as $tr ) {
          
                          echo '<tr>';
          
                              foreach ( $tr as $td ) {
          
                                  echo '<td>';
                                      echo $td['c'];
                                  echo '</td>';
                              }
          
                          echo '</tr>';
                      }
          
                  echo '</tbody>';
          
              echo '</table>';
          } ?>

        </div>

    </div>
  </div>
</section>
