     <!--/ END Form Wizard -->
                                        <?php $user_type = $this->session->userdata('user_type_1');
                                                        if($user_type == 'Administrator')
                                                        {?>
                   


                                                    <div class="col-sm-4">
                                                    <div class="input-group-prepend">
                                                                <button class="btn btn-info" type="button">Search</button>
                                                            </div>
                                                        <input type="text" class="form-control" name="searh_text" id="search_text" placeholder="Search Through Employee ID, Name, City" aria-label=""
                        aria-describedby="basic-addon1">
                                                    </div>
                                                        <?php }
                                                     ?>














                                                     