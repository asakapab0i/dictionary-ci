    <div class="container">
      <div class="row">
        <div class="col-md-8 custom-main-workplace">
          <div class="custom-add-form">

               <form role="form">
            <div class="form-group">
              <label for="word">Word</label>
              <?php 
              $data = array('name' => 'word',
                            'id' => 'word',
                            'size' => '50',
                            'class' => 'form-control'
                            );
              echo form_input($data);
              ?>
            </div>
            <div class="form-group">
              <label for="definition">Definition</label>
              <?php 
              $data = array('name' => 'definition',
                            'id' => 'definition',
                            'size' => '50',
                            'class' => 'form-control',
                            'style' => 'margin: 0px 16.328125px 0px 0px; height: 150px; width: 487px;'
                            );
              echo form_textarea($data);
              ?>
            </div>
            <div class="form-group">
              <label for="example">Example</label>
               <?php 
              $data = array('name' => 'example',
                            'id' => 'example',
                            'size' => '50',
                            'class' => 'form-control',
                            'style'=> 'margin: 0px 16.328125px 0px 0px; height: 150px; width: 487px;'
                            );
              echo form_textarea($data);
              ?>
            </div>

             <div class="form-group">
              <label for="tags">Related Tags</label>
               <?php 
              $data = array('name' => 'tags',
                            'id' => 'tags',
                            'size' => '50',
                            'class' => 'form-control'
                            );
              echo form_input($data);
              ?>
            </div>

             <div class="form-group">
              <label for="pname">Psuedo Name</label>
               <?php 
              $data = array('name' => 'pname',
                            'id' => 'pname',
                            'size' => '50',
                            'class' => 'form-control'
                            );
              echo form_input($data);
              ?>
            </div>

             <div class="form-group">
              <label for="tags">Email</label>
               <?php 
              $data = array('name' => 'email',
                            'id' => 'email',
                            'size' => '50',
                            'class' => 'form-control'
                            );
              echo form_input($data);
              ?>
            </div>


            <button type="submit" class="btn btn-default">Submit</button>
        </form>
            
          </div>
        </div>
        <div class="col-md-4 custom-mailing-list">
          <h5>Subscribe to our mailing list!</h5>
          <?php //$this->load->view('template/sidebar')?>
        </div>
      </div>
    <!-- {side_bar} -->
    </div> <!-- /container -->
    
