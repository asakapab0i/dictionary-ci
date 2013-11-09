    <div class="container">
    	<div class="row">
    		<div class="col-md-8 custom-main-workplace">
               <p><?php echo anchor('dictionary/browse/{letter}', 'browse the {total_words} words for letter a', 'class="btn btn-info"');?></p>
              <div class="inline">
                    {list_of_words}
                        <?php echo anchor('dictionary/define/{word}', '{word}', "class='btn btn-success custom-list-word' "); ?>
                    {/list_of_words}
              </div>
    		</div>
    		<div class="col-md-4 custom-mailing-list">
    			<h5>Subscribe to our mailing list!</h5>
    			<?php $this->load->view('template/sidebar')?>
    		</div>
    	</div>
    <!-- {side_bar} -->
    </div> <!-- /container -->
    
