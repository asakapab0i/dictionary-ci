    <div class="container">
    	<div class="row">
    		<div class="col-md-8 custom-main-workplace">
                {authors}
                     
                          <article class="custom-word">
                        <header>
                            <h4><?php echo anchor('dictionary/permalink/{word}/{defid}', '{word}');?></h4>
                            <p class="custom-date">{datew}</p>
                        </header>
                        <p>{definition}</p>
                         by: <a href="#" class="btn btn-info">{name}</a> 
                         <button class="btn btn-warning">share this</button> 
                         <button class="btn btn-warning">discuss this</button>
                    </article>                    
                   

                {/authors}
    		</div>
    		<div class="col-md-4 custom-mailing-list">
            sidebar
    		</div>
    	</div>
    <!-- {side_bar} -->
    </div> <!-- /container -->
    