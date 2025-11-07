   
        <div class="my-3 my-md-5">
          <div class="container">
                            <?php 
             if($this->session->flashdata("error_msg") != ''){?>
             <div class="alert alert-danger">
                 <button class="close" data-dismiss="alert"></button>
                 <?php echo $this->session->flashdata("error_msg");?>
             </div>
          <?php
            }
          ?>
          <?php 
             if($this->session->flashdata("success") != ''){?>
             <div class="alert alert-success">
                 <button class="close" data-dismiss="alert"></button>
                 <?php echo $this->session->flashdata("success");?>
             </div>
          <?php
            }
          ?>
            <div class="row">

              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Tasks <span style="font-size: 12px;color:#2d89ef;">Show 5 of 400 <i class="fa fa-question-circle"></i></span></h3>
                  </div>
                  <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap">
                      <thead>
                        <tr>
                          <th class="w-1">No.</th>
                          <th>Invoice Subject</th>
                          <th>Client</th>
                          <th>VAT No.</th>
                          <th>Created</th>
                          <th>Status</th>
                          <th>Price</th>
                          <th></th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td><span class="text-muted">001401</span></td>
                          <td><a href="invoice.html" class="text-inherit">Design Works</a></td>
                          <td>
                            Carlson Limited
                          </td>
                          <td>
                            87956621
                          </td>
                          <td>
                            15 Dec 2017
                          </td>
                          <td>
                            <span class="status-icon bg-success"></span> Paid
                          </td>
                          <td>$887</td>
                          <td class="text-right">
                            <a href="javascript:void(0)" class="btn btn-secondary btn-sm">Manage</a>
                            <div class="dropdown">
                              <button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">Actions</button>
                            </div>
                          </td>
                          <td>
                            <a class="icon" href="javascript:void(0)">
                              <i class="fe fe-edit"></i>
                            </a>
                          </td>
                        </tr>
                        <tr>
                          <td><span class="text-muted">001402</span></td>
                          <td><a href="invoice.html" class="text-inherit">UX Wireframes</a></td>
                          <td>
                            Adobe
                          </td>
                          <td>
                            87956421
                          </td>
                          <td>
                            12 Apr 2017
                          </td>
                          <td>
                            <span class="status-icon bg-warning"></span> Pending
                          </td>
                          <td>$1200</td>
                          <td class="text-right">
                            <a href="javascript:void(0)" class="btn btn-secondary btn-sm">Manage</a>
                            <div class="dropdown">
                              <button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">Actions</button>
                            </div>
                          </td>
                          <td>
                            <a class="icon" href="javascript:void(0)">
                              <i class="fe fe-edit"></i>
                            </a>
                          </td>
                        </tr>
                        <tr>
                          <td><span class="text-muted">001403</span></td>
                          <td><a href="invoice.html" class="text-inherit">New Dashboard</a></td>
                          <td>
                            Bluewolf
                          </td>
                          <td>
                            87952621
                          </td>
                          <td>
                            23 Oct 2017
                          </td>
                          <td>
                            <span class="status-icon bg-warning"></span> Pending
                          </td>
                          <td>$534</td>
                          <td class="text-right">
                            <a href="javascript:void(0)" class="btn btn-secondary btn-sm">Manage</a>
                            <div class="dropdown">
                              <button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">Actions</button>
                            </div>
                          </td>
                          <td>
                            <a class="icon" href="javascript:void(0)">
                              <i class="fe fe-edit"></i>
                            </a>
                          </td>
                        </tr>
                        <tr>
                          <td><span class="text-muted">001404</span></td>
                          <td><a href="invoice.html" class="text-inherit">Landing Page</a></td>
                          <td>
                            Salesforce
                          </td>
                          <td>
                            87953421
                          </td>
                          <td>
                            2 Sep 2017
                          </td>
                          <td>
                            <span class="status-icon bg-secondary"></span> Due in 2 Weeks
                          </td>
                          <td>$1500</td>
                          <td class="text-right">
                            <a href="javascript:void(0)" class="btn btn-secondary btn-sm">Manage</a>
                            <div class="dropdown">
                              <button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">Actions</button>
                            </div>
                          </td>
                          <td>
                            <a class="icon" href="javascript:void(0)">
                              <i class="fe fe-edit"></i>
                            </a>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

            </div>


            <div class="row">

              <div class="col-sm-6 col-lg-4">

                <div class="row text-center" id="custom_buttons">
                  <button type="button" class="btn btn-success"><i class="fe fe-check-square"></i> Start This Task</button>
                  <button style="margin-left: 3%;margin-right: 3%;" type="button" class="btn btn-info"><i class="fe fe-edit"></i> Edit This Task</button>
                  <button type="button" class="btn btn-warning"><i class="fe fe-loader"></i> Do Task Later</button>
                </div>

                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title">CLIENT</h4>
                  </div>
                  <div class="card-body o-auto">
                    <ul class="list-unstyled list-separated">
                      <li class="list-separated-item">
                        <div class="row align-items-center">
                          <div class="col">
                            <div>
                              <a href="javascript:void(0)" style="color: #2d89ef !important;font-weight: bold;" class="text-inherit">Amanda Hunt</a>
                            </div>
                            <small class="d-block item-except text-sm text-muted h-1x"><i style="font-size: 12px;" class="fe fe-phone"></i> (484) 545-4755</small>
                          </div>
                          <div class="col-auto">
                            <br>
                            <small class="d-block item-except text-sm text-muted h-1x"> Portage, IN 4812</small>
                          </div>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>

                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">TASK DETAILS</h3>
                    <div class="card-options">
                      <a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
                    </div>
                  </div>
                  <div class="card-body">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam deleniti fugit incidunt, iste, itaque minima neque pariatur perferendis sed suscipit velit vitae voluptatem. A consequuntur, deserunt eaque error nulla temporibus!
                  </div>
                </div>
              </div>

              <div class="col-sm-6 col-lg-4">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">FORMS <span style="font-size: 12px;color:#2d89ef;">Mortgage Info (Quick)</span></h3>
                  </div>
                  <div class="card-body o-auto" style="height: 22rem">
                    <div class="form-group">
                      <label class="form-label">Sequence:</label>
                      <select class="custom-select">
                            <option value="EQUALS" selected="">Equals</option>
                            <option value="NOT_EQUALS">Not equals</option>
                            <option value="HAS_KEY">Has key</option>
                            <option value="NOT_HAS_KEY">Not has key</option>
                            <option value="HAS_VALUE">Has value</option>
                            <option value="NOT_HAS_VALUE">Not has value</option>
                            <option value="IS_EMPTY">Is empty</option>
                            <option value="NOT_EMPTY">Is not empty</option>
                            <option value="GREATER_THAN">Greater than</option>
                            <option value="LESS_THAN">Less than</option>
                          </select>
                    </div>
                    <div class="form-group">
                      <label class="form-label">Los Filename:</label>
                      <input type="text" name="field-name" class="form-control" data-mask="00:00:00" data-mask-clearifnotmatch="true" />
                    </div>
                    <div class="form-group">
                      <label class="form-label">Referrer</label>
                      <input type="text" name="field-name" class="form-control" data-mask="000.000.000.000.000,00" data-mask-reverse="true" />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Date</label>
                        <div class="row gutters-xs">
                          <div class="col-5">
                            <select name="user[month]" class="form-control custom-select">
                              <option value="">Month</option>
                              <option value="1">January</option>
                              <option value="2">February</option>
                              <option value="3">March</option>
                              <option value="4">April</option>
                              <option value="5">May</option>
                              <option selected="selected" value="6">June</option>
                              <option value="7">July</option>
                              <option value="8">August</option>
                              <option value="9">September</option>
                              <option value="10">October</option>
                              <option value="11">November</option>
                              <option value="12">December</option>
                            </select>
                          </div>
                          <div class="col-3">
                            <select name="user[day]" class="form-control custom-select">
                              <option value="">Day</option>
                              <option value="1">1</option>
                              <option value="2">2</option>
                              <option value="3">3</option>
                              <option value="4">4</option>
                              <option value="5">5</option>
                              <option value="6">6</option>
                              <option value="7">7</option>
                              <option value="8">8</option>
                              <option value="9">9</option>
                              <option value="10">10</option>
                              <option value="11">11</option>
                              <option value="12">12</option>
                              <option value="13">13</option>
                              <option value="14">14</option>
                              <option value="15">15</option>
                              <option value="16">16</option>
                              <option value="17">17</option>
                              <option value="18">18</option>
                              <option value="19">19</option>
                              <option selected="selected" value="20">20</option>
                              <option value="21">21</option>
                              <option value="22">22</option>
                              <option value="23">23</option>
                              <option value="24">24</option>
                              <option value="25">25</option>
                              <option value="26">26</option>
                              <option value="27">27</option>
                              <option value="28">28</option>
                              <option value="29">29</option>
                              <option value="30">30</option>
                              <option value="31">31</option>
                            </select>
                          </div>
                          <div class="col-4">
                            <select name="user[year]" class="form-control custom-select">
                              <option value="">Year</option>
                              <option value="2014">2014</option>
                              <option value="2013">2013</option>
                              <option value="2012">2012</option>
                              <option value="2011">2011</option>
                              <option value="2010">2010</option>
                              <option value="2009">2009</option>
                              <option value="2008">2008</option>
                              <option value="2007">2007</option>
                              <option value="2006">2006</option>
                              <option value="2005">2005</option>
                              <option value="2004">2004</option>
                              <option value="2003">2003</option>
                              <option value="2002">2002</option>
                              <option value="2001">2001</option>
                              <option value="2000">2000</option>
                              <option value="1999">1999</option>
                              <option value="1998">1998</option>
                              <option value="1997">1997</option>
                              <option value="1996">1996</option>
                              <option value="1995">1995</option>
                              <option value="1994">1994</option>
                              <option value="1993">1993</option>
                              <option value="1992">1992</option>
                              <option value="1991">1991</option>
                              <option value="1990">1990</option>
                              <option selected="selected" value="1989">1989</option>
                              <option value="1988">1988</option>
                              <option value="1987">1987</option>
                              <option value="1986">1986</option>
                              <option value="1985">1985</option>
                              <option value="1984">1984</option>
                              <option value="1983">1983</option>
                              <option value="1982">1982</option>
                              <option value="1981">1981</option>
                              <option value="1980">1980</option>
                              <option value="1979">1979</option>
                              <option value="1978">1978</option>
                              <option value="1977">1977</option>
                              <option value="1976">1976</option>
                              <option value="1975">1975</option>
                              <option value="1974">1974</option>
                              <option value="1973">1973</option>
                              <option value="1972">1972</option>
                              <option value="1971">1971</option>
                              <option value="1970">1970</option>
                              <option value="1969">1969</option>
                              <option value="1968">1968</option>
                              <option value="1967">1967</option>
                              <option value="1966">1966</option>
                              <option value="1965">1965</option>
                              <option value="1964">1964</option>
                              <option value="1963">1963</option>
                              <option value="1962">1962</option>
                              <option value="1961">1961</option>
                              <option value="1960">1960</option>
                              <option value="1959">1959</option>
                              <option value="1958">1958</option>
                              <option value="1957">1957</option>
                              <option value="1956">1956</option>
                              <option value="1955">1955</option>
                              <option value="1954">1954</option>
                              <option value="1953">1953</option>
                              <option value="1952">1952</option>
                              <option value="1951">1951</option>
                              <option value="1950">1950</option>
                              <option value="1949">1949</option>
                              <option value="1948">1948</option>
                              <option value="1947">1947</option>
                              <option value="1946">1946</option>
                              <option value="1945">1945</option>
                              <option value="1944">1944</option>
                              <option value="1943">1943</option>
                              <option value="1942">1942</option>
                              <option value="1941">1941</option>
                              <option value="1940">1940</option>
                              <option value="1939">1939</option>
                              <option value="1938">1938</option>
                              <option value="1937">1937</option>
                              <option value="1936">1936</option>
                              <option value="1935">1935</option>
                              <option value="1934">1934</option>
                              <option value="1933">1933</option>
                              <option value="1932">1932</option>
                              <option value="1931">1931</option>
                              <option value="1930">1930</option>
                              <option value="1929">1929</option>
                              <option value="1928">1928</option>
                              <option value="1927">1927</option>
                              <option value="1926">1926</option>
                              <option value="1925">1925</option>
                              <option value="1924">1924</option>
                              <option value="1923">1923</option>
                              <option value="1922">1922</option>
                              <option value="1921">1921</option>
                              <option value="1920">1920</option>
                              <option value="1919">1919</option>
                              <option value="1918">1918</option>
                              <option value="1917">1917</option>
                              <option value="1916">1916</option>
                              <option value="1915">1915</option>
                              <option value="1914">1914</option>
                              <option value="1913">1913</option>
                              <option value="1912">1912</option>
                              <option value="1911">1911</option>
                              <option value="1910">1910</option>
                              <option value="1909">1909</option>
                              <option value="1908">1908</option>
                              <option value="1907">1907</option>
                              <option value="1906">1906</option>
                              <option value="1905">1905</option>
                              <option value="1904">1904</option>
                              <option value="1903">1903</option>
                              <option value="1902">1902</option>
                              <option value="1901">1901</option>
                              <option value="1900">1900</option>
                              <option value="1899">1899</option>
                              <option value="1898">1898</option>
                              <option value="1897">1897</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    <div class="form-group">
                      <label class="form-label">Telephone</label>
                      <input type="text" name="field-name" class="form-control" data-mask="(00) 0000-0000" data-mask-clearifnotmatch="true" />
                    </div>
                    <div class="form-group">
                        <div class="form-label">Is mortgage active?</div>
                        <div class="custom-controls-stacked">
                          <label class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" name="example-inline-radios" value="option1" checked="">
                            <span class="custom-control-label">Yes</span>
                          </label>
                          <label class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" name="example-inline-radios" value="option2">
                            <span class="custom-control-label">No</span>
                          </label>
                        </div>
                      </div>
                    <div class="text-right">
                      <button style="padding: 0.2rem 0.75rem;" type="submit" class="btn btn-primary ml-auto">Send data</button>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-6 col-lg-4">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Members</h3>
                  </div>
                  <div class="card-body o-auto" style="padding: 0.3rem 0.8rem;height: 22rem">
                    <ul class="list-unstyled list-separated">
                      <li class="list-separated-item">
                        <div class="row align-items-center">
                          <div class="col-auto">
                            <label class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" name="example-checkbox1" value="option1" checked="">
                              <span class="custom-control-label"></span>
                            </label>
                          </div>
                          <div class="col" style="padding: 0;">
                            <div>
                              <a href="javascript:void(0)" class="text-inherit">04/05/20 02:57PM Call</a>
                            </div>
                            <small class="d-block item-except text-sm text-muted h-1x">A Task was automatically scheduled for Make New Lead "Intro" Call</small>
                          </div>
                          <div class="col-auto">
                            <div class="item-action dropdown">
                              <a href="javascript:void(0)" class="icon"><i style="color: #2d89ef;" class="fa fa-envelope"></i></a>
                            </div>
                          </div>
                        </div>
                      </li>
                      <li class="list-separated-item">
                        <div class="row align-items-center">
                          <div class="col-auto">
                            <label class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" name="example-checkbox1" value="option1" checked="">
                              <span class="custom-control-label"></span>
                            </label>
                          </div>
                          <div class="col" style="padding: 0;">
                            <div>
                              <a href="javascript:void(0)" class="text-inherit">04/05/20 02:57PM Call</a>
                            </div>
                            <small class="d-block item-except text-sm text-muted h-1x">A Task was automatically scheduled for Make New Lead "Intro" Call</small>
                          </div>
                          <div class="col-auto">
                            <div class="item-action dropdown">
                              <a href="javascript:void(0)" class="icon"><i style="color: #2d89ef;" class="fa fa-envelope"></i></a>
                            </div>
                          </div>
                        </div>
                      </li>
                      <li class="list-separated-item">
                        <div class="row align-items-center">
                          <div class="col-auto">
                            <label class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" name="example-checkbox1" value="option1" checked="">
                              <span class="custom-control-label"></span>
                            </label>
                          </div>
                          <div class="col" style="padding: 0;">
                            <div>
                              <a href="javascript:void(0)" class="text-inherit">04/05/20 02:57PM Call</a>
                            </div>
                            <small class="d-block item-except text-sm text-muted h-1x">A Task was automatically scheduled for Make New Lead "Intro" Call</small>
                          </div>
                          <div class="col-auto">
                            <div class="item-action dropdown">
                              <a href="javascript:void(0)" class="icon"><i style="color: #2d89ef;" class="fa fa-envelope"></i></a>
                            </div>
                          </div>
                        </div>
                      </li>
                      <li class="list-separated-item">
                        <div class="row align-items-center">
                          <div class="col-auto">
                            <label class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" name="example-checkbox1" value="option1" checked="">
                              <span class="custom-control-label"></span>
                            </label>
                          </div>
                          <div class="col" style="padding: 0;">
                            <div>
                              <a href="javascript:void(0)" class="text-inherit">04/05/20 02:57PM Call</a>
                            </div>
                            <small class="d-block item-except text-sm text-muted h-1x">A Task was automatically scheduled for Make New Lead "Intro" Call</small>
                          </div>
                          <div class="col-auto">
                            <div class="item-action dropdown">
                              <a href="javascript:void(0)" class="icon"><i style="color: #2d89ef;" class="fa fa-envelope"></i></a>
                            </div>
                          </div>
                        </div>
                      </li>
                      <li class="list-separated-item">
                        <div class="row align-items-center">
                          <div class="col-auto">
                            <label class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" name="example-checkbox1" value="option1" checked="">
                              <span class="custom-control-label"></span>
                            </label>
                          </div>
                          <div class="col" style="padding: 0;">
                            <div>
                              <a href="javascript:void(0)" class="text-inherit">04/05/20 02:57PM Call</a>
                            </div>
                            <small class="d-block item-except text-sm text-muted h-1x">A Task was automatically scheduled for Make New Lead "Intro" Call</small>
                          </div>
                          <div class="col-auto">
                            <div class="item-action dropdown">
                              <a href="javascript:void(0)" class="icon"><i style="color: #2d89ef;" class="fa fa-envelope"></i></a>
                            </div>
                          </div>
                        </div>
                      </li>
                      <li class="list-separated-item">
                        <div class="row align-items-center">
                          <div class="col-auto">
                            <label class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" name="example-checkbox1" value="option1" checked="">
                              <span class="custom-control-label"></span>
                            </label>
                          </div>
                          <div class="col" style="padding: 0;">
                            <div>
                              <a href="javascript:void(0)" class="text-inherit">04/05/20 02:57PM Call</a>
                            </div>
                            <small class="d-block item-except text-sm text-muted h-1x">A Task was automatically scheduled for Make New Lead "Intro" Call</small>
                          </div>
                          <div class="col-auto">
                            <div class="item-action dropdown">
                              <a href="javascript:void(0)" class="icon"><i style="color: #2d89ef;" class="fa fa-envelope"></i></a>
                            </div>
                          </div>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>

            </div>


            <div class="row mb-4">
            <div class="col-lg-12 text-right" id="footer_buttons">
              <button type="button" class="btn btn-gray"><i class="fe fe-chevron-left mr-2"></i>Previous Task</button>
              <button type="button" class="btn btn-gray"><i class="fe fe-check mr-2"></i>Mark Task as Complete</button>
              <button type="button" class="btn btn-info">Next Task<i class="fe fe-chevron-right"></i></button>
              <button type="button" class="btn btn-outline-primary">Close</button>
            </div>
          </div>


          </div>
        </div>


      </div>