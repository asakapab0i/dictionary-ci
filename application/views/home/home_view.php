    <div class="container">
    	<div class="row">
    		<div class="col-md-8 custom-main-workplace">
                {words}
                    <article class="custom-word">
                        <header>
                            <h4><?php echo anchor('dictionary/define/{word}/{example_id}', '{word}');?></h4>
                            <p class="custom-date">{datew}</p>
                        </header>
                        <p>{definition}</p>
                        {tag_generator}
                                {tags}
                            {/tag_generator} <br/>
                         by: <a href="#" class="btn btn-info">{name}</a> 
                         <button class="btn btn-warning">share this</button> 
                         <button class="btn btn-warning">discuss this</button>
                    </article>
                {/words}
            
          

    			{pagination_links}
    		</div>
    		<div class="col-md-4 custom-mailing-list">
    			<h5>Subscribe to our mailing list!</h5>
    			<?php $this->load->view('template/sidebar')?>
    		</div>
    	</div>
    <!-- {side_bar} -->
    </div> <!-- /container -->
    
