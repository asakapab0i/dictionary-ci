    <div class="container">
      <div class="row">
        <div class="col-md-8 custom-main-workplace">
          <div class="custom-add-form">
              
               <?php 
                $attributes = array('method' => 'post','role' => 'form','class' => 'email', 'id' => 'add-form');
                echo form_open('add/save', $attributes);
                ?>
            <div class="form-group">
              <label for="word">Word - 'ambot', 'hello world', 'utot'</label>
              <?php 
              $data = array('value' => set_value('word'),
                            'name' => 'word',
                            'id' => 'word',
                            'size' => '50',
                            'class' => 'form-control'
                            );
              echo form_input($data);
              ?>
            </div>
            <div class="form-group">
              <label for="definition">Definition - 'this is awesome-word i just discovered!'</label>
              <?php 
              $data = array('value' => set_value('definition'),
                            'name' => 'definition',
                            'id' => 'definition',
                            'size' => '50',
                            'class' => 'form-control',
                            'style' => 'margin: 0px 16.328125px 0px 0px; height: 150px; width: 487px;'
                            );
              echo form_textarea($data);
              ?>
            </div>
            <div class="form-group">
              <label for="example">Example - what an awesome-word that is!</label>
               <?php 
              $data = array('value' => set_value('example'),
                            'name' => 'example',
                            'id' => 'example',
                            'size' => '50',
                            'class' => 'form-control',
                            'style'=> 'margin: 0px 16.328125px 0px 0px; height: 150px; width: 487px;'
                            );
              echo form_textarea($data);
              ?>
            </div>

             <div class="form-group">
              <label for="tags">Related Tags - 'awesome, word, phrase, so cool'</label>
               <?php 
              $data = array('value' => set_value('tags'),
                            'name' => 'tags',
                            'id' => 'tags',
                            'size' => '50',
                            'class' => 'form-control'
                            );
              echo form_input($data);
              ?>
            </div>

             <div class="form-group">
              <label for="pname">Psuedo Name - 'juan tamad'</label>
               <?php 
              $data = array('value' => set_value('pname'),
                            'name' => 'pname',
                            'id' => 'pname',
                            'size' => '50',
                            'class' => 'form-control'
                            );
              echo form_input($data);
              ?>
            </div>

             <div class="form-group">
              <label for="tags">Email - 'juan@tamad.com'</label>
               <?php 
              $data = array('value' => set_value('email'),
                            'name' => 'email',
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
         

              <?php 
        if ($success != true) {
            echo validation_errors();
        }elseif ($success == false) {
            ?>

             <div class="alert alert-success">
            <p>Your newly defined word is submitted. Thank you</p>
          </div>

            <?php
        }{

          ?>
         
          <p>Sidebar</p>
      <?php
        }
            ?>


        </div>
      </div>
    <!-- {side_bar} -->
    </div> <!-- /container -->
    
