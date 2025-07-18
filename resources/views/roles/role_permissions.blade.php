@extends('adminlte::page')

@section('title', 'Role Permissions')

@section('content_header')
@stop

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header alert d-flex justify-content-between align-items-center">
          <a class="btn btn-sm btn-success back-button" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
            <h3>{{ __('adminlte::adminlte.role_permissions') }}</h3>
          </div>
          <div class="card-body pb-3">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif
            <form id="addRoleForm" method="post", action="{{ route('role.savePermissions') }}">
              @csrf
              <div class="card-body">
                <div class="role-name">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label for="role_name">{{ __('adminlte::adminlte.role_name') }}</label>
                        <input type="hidden" name="role_id" id="role_id">
                        <select name="role_name" class="form-control" id="role_name">
                            <option value="" hidden>Select Role</option>
                          @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                          @endforeach
                        </select>
                        @if($errors->has('role_name'))
                          <div class="error">{{ $errors->first('role_name') }}</div>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
                
                <div class="role-permissions " id="role-permissions"      @can('edit_permission')  @else style="pointer-events: none;"  @endcan>
                  <label for="permissions[]" class="label">{{ __('adminlte::adminlte.permissions') }}</label>
                  <label id="permissions[]-error" class="error" for="permissions[]" style="font-weight: 400 !important;"></label>
                  <br>
                  @if($errors->has('permissions'))
                    <div class="error">{{ $errors->first('permissions') }}</div>
                  @endif

                  <div class="custom_check_wrap">
                    <div class="custom-check">
                      <input type="checkbox" id="full_access" class="">
                      <span></span>       
                    </div>
                    <strong>FULL ACCESS</strong>                     
                  </div> 

                  <div class="title">
                    <h5>Users Management</h5>
                    <hr/>
                  </div>

                  <div class="row permissions-section">
                    <div class="col-4">
                      <div class="form-group">
                        <div class="permissions-section-inner-sec">
                          <p class="headings"><strong class="list-text">Users</strong></p>
                          <div class="custom_check_wrap">
                            <div class="custom-check">
                              <input type="checkbox" id="appusers_permissions" class="ckbCheckAll">
                              <span></span>
                            </div>
                              <strong class="list-text">Select All</strong>
                          </div>
                          <div id="checkBoxes">
                            @foreach($appUsersPermissions as $permission)
                              <div class="custom_check_wrap">
                                <div class="custom-check">
                                  <input type="checkbox" class="checkBoxClass appUserscheckBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
                                  <span></span>
                                </div>
                                  <label class="mb-0">{{ $permission->name }}</label>
                              </div>
                            @endforeach
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-4">
                      <div class="form-group">
                        <div class="permissions-section-inner-sec">
                          <p class="headings"><strong class="list-text">Voters</strong></p>
                          <div class="custom_check_wrap">
                            <div class="custom-check">
                              <input type="checkbox" id="voter_permissions" class="ckbCheckAll">
                              <span></span>
                            </div>
                              <strong class="list-text">Select All</strong>
                          </div>
                          <div id="checkBoxes">
                            @foreach($voter_permissions as $permission)
                              <div class="custom_check_wrap">
                                <div class="custom-check">
                                  <input type="checkbox" class="checkBoxClass votercheckBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
                                  <span></span>
                                </div>
                                  <label class="mb-0">{{ $permission->name }}</label>
                              </div>
                            @endforeach
                          </div>
                        </div>
                      </div>
                    </div>
                    

                    <div class="col-4">
                      <div class="form-group">
                        <div class="permissions-section-inner-sec">
                          <p class="headings"><strong class="list-text">Champion</strong></p>
                          <div class="custom_check_wrap">
                            <div class="custom-check">
                              <input type="checkbox" id="champion_permissions" class="ckbCheckAll">
                              <span></span>
                            </div>
                              <strong class="list-text">Select All</strong>
                          </div>
                          <div id="checkBoxes">
                            @foreach($champion_permissions as $permission)
                              <div class="custom_check_wrap">
                                <div class="custom-check">
                                  <input type="checkbox" class="checkBoxClass championcheckBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
                                  <span></span>
                                </div>
                                  <label class="mb-0">{{ $permission->name }}</label>
                              </div>
                            @endforeach
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-4">
                      <div class="form-group">
                        <div class="permissions-section-inner-sec">
                          <p class="headings"><strong class="list-text">Admins</strong></p>
                          <div class="custom_check_wrap">
                            <div class="custom-check">
                              <input type="checkbox" id="admins_permissions" class="ckbCheckAll">
                              <span></span>
                            </div>
                              <strong class="list-text">Select All</strong>
                          </div>
                          <div id="checkBoxes">
                            @foreach($adminPermissions as $permission)
                              <div class="custom_check_wrap">
                                <div class="custom-check">
                                  <input type="checkbox" class="checkBoxClass adminscheckBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
                                  <span></span>
                                </div>
                                <label class="mb-0">{{ $permission->name }}</label>
                              </div>
                            @endforeach
                          </div>
                        </div>
                      </div>
                    </div>
                 
                  </div>

                  <div class="title d-none">
                    <h5>Products Management</h5>
                    <hr/>
                  </div>

                  <div class="row permissions-section d-none">
                   <!--  <div class="col-4">
                      <div class="form-group">
                        <div class="permissions-section-inner-sec">
                          <p class="headings"><strong class="list-text">Products</strong></p>
                          <div class="custom_check_wrap">
                            <div class="custom-check">
                              <input type="checkbox" id="products_permissions" class="ckbCheckAll">
                              <span></span>
                            </div>
                              <strong class="list-text">Select All</strong>
                          </div>
                          <div id="checkBoxes">
                            @foreach($productPermissions as $permission)
                              <div class="custom_check_wrap">
                                <div class="custom-check">
                                  <input type="checkbox" class="checkBoxClass productsheckBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
                                  <span></span>
                                </div>
                                  <label class="mb-0">{{ $permission->name }}</label>
                              </div>
                            @endforeach
                          </div>
                        </div>
                      </div>
                    </div> -->


                   
                  </div>

<!--                   <div class="title">
                    <h5>Orders Management</h5>
                    <hr/>
                  </div>

                  <div class="row permissions-section">
 -->                   <!--  <div class="col-4">
                      <div class="form-group">
                        <div class="permissions-section-inner-sec">
                          <p class="headings"><strong class="list-text">Orders</strong></p>
                          <div class="custom_check_wrap">
                            <div class="custom-check">
                              <input type="checkbox" id="orders_permissions" class="ckbCheckAll">
                              <span></span>
                            </div>
                              <strong class="list-text">Select All</strong>
                          </div>
                          <div id="checkBoxes">
                            @foreach($orderPermissions as $permission)
                              <div class="custom_check_wrap">
                                <div class="custom-check">
                                  <input type="checkbox" class="checkBoxClass orderscheckBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
                                  <span></span>
                                </div>
                                  <label class="mb-0">{{ $permission->name }}</label>
                              </div>
                            @endforeach
                          </div>
                        </div>
                      </div>
                    </div> -->

<!-- 
                   
                  </div> -->


                 {{--  <div class="title">
                    <h5>Payments</h5>
                    <hr/>
                  </div>

                  <div class="row permissions-section">
                    <div class="col-4">
                      <div class="form-group">
                        <div class="permissions-section-inner-sec">
                          <p class="headings"><strong class="list-text">Payment Transactions</strong></p>
                          <div class="custom_check_wrap">
                            <div class="custom-check">
                              <input type="checkbox" id="payments_permissions" class="ckbCheckAll">
                              <span></span>
                            </div>
                              <strong class="list-text">Select All</strong>
                          </div>
                          <div id="checkBoxes">
                            @foreach($transactionPermissions as $permission)
                              <div class="custom_check_wrap">
                                <div class="custom-check">
                                  <input type="checkbox" class="checkBoxClass paymentcheckBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
                                  <span></span>
                                </div>
                                  <label class="mb-0">{{ $permission->name }}</label>
                              </div>
                            @endforeach
                          </div>
                        </div>
                      </div>
                    </div>


                   
                  </div> --}}


                  <div class="title">
                    <h5>Content Management</h5>
                    <hr/>
                  </div>

                  <div class="row permissions-section">
                   
                    
                    <div class="col-4">
                      <div class="form-group">
                        <div class="permissions-section-inner-sec">
                          <p class="headings"><strong class="list-text">Website</strong></p>
                          <div class="custom_check_wrap">
                            <div class="custom-check">
                              <input type="checkbox" id="mobile_permissions" class="ckbCheckAll">
                              <span></span>
                            </div>
                              <strong class="list-text">Select All</strong>
                          </div>
                          <div id="checkBoxes">
                            @foreach($mobileContentPermissions as $permission)
                              <div class="custom_check_wrap">
                                <div class="custom-check">
                                  <input type="checkbox" class="checkBoxClass mobilecheckBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
                                  <span></span>
                                </div>
                                <label class="mb-0">{{ $permission->name }}</label>
                              </div>
                            @endforeach
                          </div>
                        </div>
                      </div>
                    </div> 
                  </div>

<!-- 
                  <div class="title">
                    <h5>Users Feedback</h5>
                    <hr/>
                  </div>

                  <div class="row permissions-section"> -->
                    <!-- <div class="col-4">
                      <div class="form-group">
                        <div class="permissions-section-inner-sec">
                          <p class="headings"><strong class="list-text">Contact Us</strong></p>
                          <div class="custom_check_wrap">
                            <div class="custom-check">
                              <input type="checkbox" id="contactus_permissions" class="ckbCheckAll">
                              <span></span>
                            </div>
                              <strong class="list-text">Select All</strong>
                          </div>
                          <div id="checkBoxes">
                            @foreach($contactUSPermissions as $permission)
                              <div class="custom_check_wrap">
                                <div class="custom-check">
                                  <input type="checkbox" class="checkBoxClass contactUsCheckBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
                                  <span></span>
                                </div>
                                  <label class="mb-0">{{ $permission->name }}</label>
                              </div>
                            @endforeach
                          </div>
                        </div>
                      </div>
                    </div> -->


                     <!--  <div class="col-4">
                      <div class="form-group">
                        <div class="permissions-section-inner-sec">
                          <p class="headings"><strong class="list-text">Review</strong></p>
                          <div class="custom_check_wrap">
                            <div class="custom-check">
                              <input type="checkbox" id="review_permission" class="ckbCheckAll">
                              <span></span>
                            </div>
                              <strong class="list-text">Select All</strong>
                          </div>
                          <div id="checkBoxes">
                            @foreach($reviewPermissions as $permission)
                              <div class="custom_check_wrap">
                                <div class="custom-check">
                                  <input type="checkbox" class="checkBoxClass reviewCheckBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
                                  <span></span>
                                </div>
                                  <label class="mb-0">{{ $permission->name }}</label>
                              </div>
                            @endforeach
                          </div>
                        </div>
                      </div>
                    </div> -->


                     

<!-- 
                   
         

                   
                  </div>
 -->
                  

                  
{{-- 
                  <div class="title">
                    <h5>Misc Data Management</h5>
                    <hr/>
                  </div>

                  <div class="row permissions-section">
                    <div class="col-4">
                      <div class="form-group">
                        <div class="permissions-section-inner-sec">
                          <p class="headings"><strong class="list-text">Subscription Plans   </strong></p>
                          <div class="custom_check_wrap">
                            <div class="custom-check">
                              <input type="checkbox" id="subscription_permissions" class="ckbCheckAll">
                              <span></span>
                            </div>
                              <strong class="list-text">Select All</strong>
                          </div>
                          <div id="checkBoxes">
                            @foreach($subscriptionPermissions as $permission)
                              <div class="custom_check_wrap">
                                <div class="custom-check">
                                  <input type="checkbox" class="checkBoxClass subscriptioncheckBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
                                  <span></span>
                                </div>
                                <label class="mb-0">{{ $permission->name }}</label>
                              </div>
                            @endforeach
                          </div>
                        </div>
                      </div>
                    </div>


                     <div class="col-4">
                      <div class="form-group">
                        <div class="permissions-section-inner-sec">
                          <p class="headings"><strong class="list-text">Interests </strong></p>
                          <div class="custom_check_wrap">
                            <div class="custom-check">
                              <input type="checkbox" id="interests_permissions" class="ckbCheckAll">
                              <span></span>
                            </div>
                              <strong class="list-text">Select All</strong>
                          </div>
                          <div id="checkBoxes">
                            @foreach($interestsPermissions as $permission)
                              <div class="custom_check_wrap">
                                <div class="custom-check">
                                  <input type="checkbox" class="checkBoxClass interestscheckBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
                                  <span></span>
                                </div>
                                <label class="mb-0">{{ $permission->name }}</label>
                              </div>
                            @endforeach
                          </div>
                        </div>
                      </div>
                    </div>


                    <div class="col-4">
                      <div class="form-group">
                        <div class="permissions-section-inner-sec">
                          <p class="headings"><strong class="list-text"> Destinations </strong></p>
                          <div class="custom_check_wrap">
                            <div class="custom-check">
                              <input type="checkbox" id="destinations_permissions" class="ckbCheckAll">
                              <span></span>
                            </div>
                              <strong class="list-text">Select All</strong>
                          </div>
                          <div id="checkBoxes">
                            @foreach($destinationsPermissions as $permission)
                              <div class="custom_check_wrap">
                                <div class="custom-check">
                                  <input type="checkbox" class="checkBoxClass destinationscheckBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
                                  <span></span>
                                </div>
                                <label class="mb-0">{{ $permission->name }}</label>
                              </div>
                            @endforeach
                          </div>
                        </div>
                      </div>
                    </div>


                          <div class="col-4">
                      <div class="form-group">
                        <div class="permissions-section-inner-sec">
                          <p class="headings"><strong class="list-text"> Ethinicity </strong></p>
                          <div class="custom_check_wrap">
                            <div class="custom-check">
                              <input type="checkbox" id="ethinicity_permissions" class="ckbCheckAll">
                              <span></span>
                            </div>
                              <strong class="list-text">Select All</strong>
                          </div>
                          <div id="checkBoxes">
                            @foreach($ethinicityPermissions as $permission)
                              <div class="custom_check_wrap">
                                <div class="custom-check">
                                  <input type="checkbox" class="checkBoxClass ethinicitycheckBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
                                  <span></span>
                                </div>
                                <label class="mb-0">{{ $permission->name }}</label>
                              </div>
                            @endforeach
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    
                  

                  </div>
 --}}


                  



              
                  <div class="title">
                    <h5>Access Control</h5>
                    <hr/>
                  </div>

                  <div class="row permissions-section">
                    <div class="col-4">
                      <div class="form-group">
                        <div class="permissions-section-inner-sec">
                          <p class="headings"><strong class="list-text">Roles</strong></p>
                          <div class="custom_check_wrap">
                            <div class="custom-check">
                              <input type="checkbox" id="roles_permissions" class="ckbCheckAll">
                              <span></span>
                            </div>
                              <strong class="list-text">Select All</strong>
                          </div>
                          <div id="checkBoxes">
                            @foreach($rolesPermissions as $permission)
                              <div class="custom_check_wrap">
                                <div class="custom-check">
                                  <input type="checkbox" class="checkBoxClass rolescheckBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
                                  <span></span>
                                </div>
                                <label class="mb-0">{{ $permission->name }}</label>
                              </div>
                            @endforeach
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="form-group">
                        <div class="permissions-section-inner-sec">
                          <p class="headings"><strong class="list-text">Permissions</strong></p>
                          <div class="custom_check_wrap">
                            <div class="custom-check">
                              <input type="checkbox" id="access_permissions" class="ckbCheckAll">
                              <span></span>
                            </div>
                              <strong class="list-text">Select All</strong>
                          </div>
                          <div id="checkBoxes">
                            @foreach($permissionPermissions as $permission)
                              <div class="custom_check_wrap">
                                <div class="custom-check">
                                  <input type="checkbox" class="checkBoxClass accesscheckBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
                                  <span></span>    
                                </div>
                                <label class="mb-0">{{ $permission->name }}</label>
                              </div>
                            @endforeach
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

              
                  </div>

                  
                  <div class="title">
                    <h5>Recycle Bin</h5>
                    <hr/>
                  </div>

                  <div class="row permissions-section"  @can('edit_permission')  @else style="pointer-events: none;"  @endcan>
                    <div class="col-6">
                      <div class="form-group">
                        <div class="permissions-section-inner-sec">
                          <div class="custom_check_wrap">
                            <div class="custom-check">
                              <input type="checkbox" id="restore_permissions" class="ckbCheckAll">
                              <span></span>
                            </div>
                              <strong class="list-text">Select All</strong>
                          </div>
                          <div id="checkBoxes">
                            @foreach($recycle_binPermissions as $permission)

                                  <div class="custom_check_wrap">
                                  <div class="custom-check">
                                    <input type="checkbox" class="checkBoxClass restorecheckBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
                                    <span></span>
                                  </div>
                                    <label class="mb-0">{{ $permission->name }}</label>
                                </div>


                            @endforeach
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>

              </div>
              <!-- /.card-body -->
              <div class="card-footer pt-0">
                @can('edit_permission')
                <button type="submit" class="btn btn-primary     ">{{ __('adminlte::adminlte.save') }}</button>
                @endcan
              </div>
            </form>
          </div>
        </div>
      </div>
  </div>
</div>
@endsection

@section('css')
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <style>
    strong.list-text {
      position: relative;
      left: -8px;
      top: -3px;
    }
    span.list-text {
      position: relative;
      left: -8px;
      top: -3px;
    }
    /* .role-permissions { display:none; } */
  </style>
@stop

@section('js')
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

  <script>
    $(document).ready(function() {
      checkAll();
      $("input[type='checkbox']").change(function() {
        checkAll();
      });
      $("#role_name").change(function() {
        $('input').filter(':checkbox').prop('checked',false);
        var role = $(this);
        $("#role_id").val(role.val());
        $(".checkBoxClass").removeAttr('checked');
        var id = $("#role_name").val();
        $.ajax({
          url: "{{ route('role.permissions') }}",
          type: 'post',
          data: {
            role_id: id
          },
          dataType: "JSON",
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function(res) {
            for (let i = 0; i < res.length; i++) {
              const response = res[i];
              var permissionId = "#button_"+response.permission_id;
              $(permissionId).prop('checked', 'true');
              checkAll();
            }
          }
        });
      });
      
      $('#addRoleForm').validate({
        ignore: [],
        debug: false,
        rules: {
          role_name: {
            required: true
          },
          "permissions[]":{
            required: true
          }
        },
        messages: {
          role_name: {
            required: "The Role Name field is required"
          },
          "permissions[]": {
            required: "You must select at least one permission",
          }
        }
      });
    });
    
    function checkAll() {
      $("#full_access").click(function() {
        $("input[type=checkbox]").prop('checked', this.checked)
      })
      $("#appusers_permissions").click(function() {
        $(".appUserscheckBox").prop('checked', this.checked)
      })

      $("#voter_permissions").click(function() {
        $(".votercheckBox").prop('checked', this.checked)
      })
      $("#champion_permissions").click(function() {
        $(".championcheckBox").prop('checked', this.checked)
      })
      $("#marketing_user_permissions").click(function() {
        $(".MarketingUsercheckBox").prop('checked', this.checked)
      })

      $("#products_permissions").click(function() {
        $(".productsheckBox").prop('checked', this.checked)
      })

      $("#contactus_permissions").click(function() {
        $(".contactUsCheckBox").prop('checked', this.checked)
      })

      $("#admins_permissions").click(function() {
        $(".adminscheckBox").prop('checked', this.checked)
      })

      $("#mobile_permissions").click(function() {
        $(".mobilecheckBox").prop('checked', this.checked)
      })
      $("#subscription_permissions").click(function() {
        $(".subscriptioncheckBox").prop('checked', this.checked)
      })
      $("#interests_permissions").click(function() {
        $(".interestscheckBox").prop('checked', this.checked)
      })
       $("#destinations_permissions").click(function() {
        $(".destinationscheckBox").prop('checked', this.checked)
      })
        $("#ethinicity_permissions").click(function() {
        $(".ethinicitycheckBox").prop('checked', this.checked)
      })
      $("#roles_permissions").click(function() {
        $(".rolescheckBox").prop('checked', this.checked)
      })      
      $("#access_permissions").click(function() {
        $(".accesscheckBox").prop('checked', this.checked)
      })      
      $("#restore_permissions").click(function() {

        $(".restorecheckBox").prop('checked', this.checked)
      }) 

      $("#orders_permissions").click(function() {

        $(".orderscheckBox").prop('checked', this.checked)
      }) 

      $("#payments_permissions").click(function() {

        $(".paymentcheckBox").prop('checked', this.checked)
      })  


       $("#review_permission").click(function() {

        $(".reviewCheckBox").prop('checked', this.checked)
      })    

      ////////////////////////////////////////

      if($('.checkBoxClass:checked').length == $('.checkBoxClass').length) {
        $("#full_access").prop('checked', 'true');
      }
      else {
        $("#full_access").prop('checked', false);
      }
      if($('.appUserscheckBox:checked').length == $('.appUserscheckBox').length) {
        $("#appusers_permissions").prop('checked', 'true');
      }
      else {
        $("#appusers_permissions").prop('checked', false);
      }
      if($('.votercheckBox:checked').length == $('.votercheckBox').length) {
        $("#voter_permissions").prop('checked', 'true');
      }
      else {
        $("#voter_permissions").prop('checked', false);
      }

      if($('.championcheckBox:checked').length == $('.championcheckBox').length) {
        $("#champion_permissions").prop('checked', 'true');
      }
      else {
        $("#champion_permissions").prop('checked', false);
      }

      if($('.adminscheckBox:checked').length == $('.adminscheckBox').length) {
        $("#admins_permissions").prop('checked', 'true');
      }
      else {
        $("#admins_permissions").prop('checked', false);
      }
      
  
      if($('.mobilecheckBox:checked').length == $('.mobilecheckBox').length) {
        $("#mobile_permissions").prop('checked', 'true');
      }
      else {
        $("#mobile_permissions").prop('checked', false);
      }
      if($('.subscriptioncheckBox:checked').length == $('.subscriptioncheckBox').length) {
        $("#subscription_permissions").prop('checked', 'true');
      }
      else {
        $("#subscription_permissions").prop('checked', false);
      }
        if($('.interestscheckBox:checked').length == $('.interestscheckBox').length) {
        $("#interests_permissions").prop('checked', 'true');
      }
      else {
        $("#interests_permissions").prop('checked', false);
      }

        if($('.destinationscheckBox:checked').length == $('.destinationscheckBox').length) {
        $("#destinations_permissions").prop('checked', 'true');
      }
      else {
        $("#destinations_permissions").prop('checked', false);
      }


       if($('.ethinicitycheckBox:checked').length == $('.ethinicitycheckBox').length) {
        $("#ethinicity_permissions").prop('checked', 'true');
      }
      else {
        $("#destinations_permissions").prop('checked', false);
      }


      if($('.rolescheckBox:checked').length == $('.rolescheckBox').length) {
        $("#roles_permissions").prop('checked', 'true');
      }
      else {
        $("#roles_permissions").prop('checked', false);
      }
      if($('.accesscheckBox:checked').length == $('.accesscheckBox').length) {
        $("#access_permissions").prop('checked', 'true');
      }
      else {
        $("#access_permissions").prop('checked', false);
      }
      if($('.restorecheckBox:checked').length == $('.restorecheckBox').length) {
        $("#restore_permissions").prop('checked', 'true');
      }
      else {
        $("#restore_permissions").prop('checked', false);
      } 

      if($('.contactUsCheckBox:checked').length == $('.contactUsCheckBox').length) {
        $("#contactus_permissions").prop('checked', 'true');
      }
      else {
        $("#contactus_permissions").prop('checked', false);
      } 

      if($('.productsheckBox:checked').length == $('.productsheckBox').length) {
        $("#products_permissions").prop('checked', 'true');
      }
      else {
        $("#products_permissions").prop('checked', false);
      } 

      if($('.MarketingUsercheckBox:checked').length == $('.MarketingUsercheckBox').length) {
        $("#marketing_user_permissions").prop('checked', 'true');
      }
      else {
        $("#marketing_user_permissions").prop('checked', false);
      } 

      if($('.orderscheckBox:checked').length == $('.orderscheckBox').length) {
        $("#orders_permissions").prop('checked', 'true');
      }
      else {
        $("#orders_permissions").prop('checked', false);
      } 

      if($('.paymentcheckBox:checked').length == $('.paymentcheckBox').length) {
        $("#payments_permissions").prop('checked', 'true');
      }
      else {
        $("#payments_permissions").prop('checked', false);
      } 

     if($('.reviewCheckBox:checked').length == $('.reviewCheckBox').length) {
        $("#review_permission").prop('checked', 'true');
      }
      else {
        $("#review_permission").prop('checked', false);
      }

    }
  </script>
@stop
