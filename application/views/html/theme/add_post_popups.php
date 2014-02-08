

                            <div id="add_picture_popup" class="login-form popup">
                                <div id="message_popup_title">Dodaj sliku</div>
                                <div id="message_popup_message"></div>
                                
                                <div id="add_picture_popup_message_error" class="popup_message_error"></div>

                                <form id="form_picture" method="post" >
                                    <div class="form-group">
                                      <input type="text" class="form-control login-field" value="" placeholder="Title" id="name" name="name">
                                      <!--<label class="login-field-icon fui-user" for="login-name"></label>-->
                                    </div>

                                    <div class="form-group">
                                      <textarea type="text" class="form-control login-field" value="" placeholder="text" id="text" name="text"></textarea>
                                      <!--<label class="login-field-icon fui-user" for="login-name"></label>-->
                                    </div>

                                    <div class="form-group">
                                      <input type="file" class="form-control" value="" placeholder="Browse" id="file" name="file">
                                      <!--<label class="login-field-icon fui-user" for="login-name"></label>-->
                                    </div>
                                </form>

                                <button class="btn btn-info btn-lg btn-block" onClick="picture_submit(<?PHP echo $theme_id; ?>);">Submit</button>
                                

                            </div>

                    
                    
                         

                            <div id="add_video_popup" class="login-form popup">
                                <div id="message_popup_title">Dodaj sliku</div>
                                <div id="message_popup_message"></div>
                                
                                <div id="add_video_popup_message_error" class="popup_message_error"></div>

                                <form id="form_video" method="post" >
                                    <div class="form-group">
                                      <input type="text" class="form-control login-field" value="" placeholder="Title" id="name" name="name">
                                      <!--<label class="login-field-icon fui-user" for="login-name"></label>-->
                                    </div>
                                    <div class="form-group">
                                      <textarea type="text" class="form-control login-field" value="" placeholder="text" id="text" name="text"></textarea>
                                      <!--<label class="login-field-icon fui-user" for="login-name"></label>-->
                                    </div>
                                    <div class="form-group">
                                      <input type="text" class="form-control login-field" value="" placeholder="Video link" id="item" name="item">
                                      <!--<label class="login-field-icon fui-user" for="login-name"></label>-->
                                    </div>


                                </form>

                                <button class="btn btn-info btn-lg btn-block" onClick="video_submit(<?PHP echo $theme_id; ?>);">Submit</button>
                                

                            </div>

                         



                            <div id="add_text_popup" class="login-form popup">
                                <div id="message_popup_title">Dodaj tekst</div>
                                <div id="message_popup_message"></div>
                                
                                <div id="add_text_popup_message_error" class="popup_message_error"></div>

                                <form id="form_text" method="post" >
                                    <div class="form-group">
                                      <input type="text" class="form-control login-field" value="" placeholder="Title" id="name" name="name">
                                      <!--<label class="login-field-icon fui-user" for="login-name"></label>-->
                                    </div>
                                    <div class="form-group">
                                      <textarea type="text" class="form-control login-field" value="" placeholder="text" id="text" name="text"></textarea>
                                      <!--<label class="login-field-icon fui-user" for="login-name"></label>-->
                                    </div>

                                </form>

                                <button class="btn btn-info btn-lg btn-block" onClick="text_submit(<?PHP echo $theme_id; ?>);">Submit</button>
                                

                            </div>