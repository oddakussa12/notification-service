
<nav class="sidebar sidebar-offcanvas dynamic-active-class-disabled sidebar"
  style="position:fixed;height:200px;overflow-y:scroll;">
  <ul class="nav">
    <li class="nav-item nav-profile not-navigation-link">
      <div class="nav-link">
        <div class="user-wrapper">
          <div class="profile-image">
            <img src="https://lh3.googleusercontent.com/a-/AOh14Ggu4BP4WamHdFcVsrDCWWQjY2iq2NKQqmV4e-ovxA=s96-c-rg-br100" >
          </div>
          <div class="text-wrapper">
            <p class="profile-name">Odda Kussa</p>
            <div class="dropdown" data-display="static">
              <a href="#" class="nav-link d-flex user-switch-dropdown-toggler" id="UsersettingsDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <small class="designation text-muted">Administrator</small>
                <span class="status-indicator online"></span>
              </a>
              <div class="dropdown-menu" aria-labelledby="UsersettingsDropdown">
                <a class="dropdown-item p-0">
                  <div class="d-flex border-bottom">
                    <div class="py-3 px-4 d-flex align-items-center justify-content-center">
                      <i class="mdi mdi-bookmark-plus-outline mr-0 text-gray"></i>
                    </div>
                    <div class="py-3 px-4 d-flex align-items-center justify-content-center border-left border-right">
                      <i class="mdi mdi-account-outline mr-0 text-gray"></i>
                    </div>
                    <div class="py-3 px-4 d-flex align-items-center justify-content-center">
                      <i class="mdi mdi-alarm-check mr-0 text-gray"></i>
                    </div>
                  </div>
                </a>
                <a class="dropdown-item mt-2"> Manage Accounts </a>
                <a class="dropdown-item"> Change Password </a>
                <a class="dropdown-item"> Check Inbox </a>
                <a class="dropdown-item"> Sign Out </a>
              </div>
            </div>
          </div>
        </div>
        <button id="sendSMS" class="btn btn-primary btn-block">User reports <i class="mdi mdi-bullhorn"></i>
        </button>
      </div>
    </li>
    <li id="dash" class="nav-item {{ active_class(['/']) }}">
      <a class="nav-link">
        <i class="menu-icon mdi mdi-television"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <li id="email_accounts" class="nav-item {{ active_class(['/']) }}">
      <a class="nav-link">
        <i class="menu-icon mdi mdi mdi-email-lock"></i>
        <span class="menu-title">Email accounts</span>
      </a>
    </li>
    <li id="email_templates" class="nav-item {{ active_class(['/']) }}">
      <a class="nav-link">
        <i class="menu-icon mdi mdi-email-outline"></i>
        <span class="menu-title">Email templates</span>
      </a>
    </li>
    <li id="sms_messages" class="nav-item {{ active_class(['/']) }}">
      <a class="nav-link">
        <i class="menu-icon mdi mdi-cellphone-android"></i>
        <span class="menu-title">SMS Messages</span>
      </a>
    </li>
    <li id="sms_messages" class="nav-item {{ active_class(['/']) }}">
      <a class="nav-link">
        <i class="menu-icon mdi mdi-camera-timer"></i>
        <span class="menu-title">Schedules</span>
      </a>
    </li>
    
    {{-- <li class="nav-item {{ active_class(['basic-ui/*']) }}">
      <a class="nav-link" data-toggle="collapse" href="#basic-ui" aria-expanded="{{ is_active_route(['basic-ui/*']) }}" aria-controls="basic-ui">
        <i class="menu-icon mdi mdi-account-multiple-plus"></i>
        <span class="menu-title">Customers</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse {{ show_class(['basic-ui/*']) }}" id="basic-ui">
        <ul class="nav flex-column sub-menu">
          <li id="customers"  class="nav-item {{ active_class(['basic-ui/buttons']) }}">
            <a class="nav-link">Active customers</a>
          </li>
          <li id="disabledCustomers" class="nav-item {{ active_class(['basic-ui/dropdowns']) }}">
            <a class="nav-link">Disabled customers</a>
          </li>
        </ul>
      </div>
    </li>
    <li class="nav-item {{ active_class(['basic-ui/*']) }}">
      <a class="nav-link" data-toggle="collapse" href="#basic-uii" aria-expanded="{{ is_active_route(['basic-ui/*']) }}" aria-controls="basic-ui">
        <i class="menu-icon mdi mdi-alert-octagon"></i>
        <span class="menu-title">User Reports</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse {{ show_class(['basic-ui/*']) }}" id="basic-uii">
        <ul class="nav flex-column sub-menu">
          <li id="customers"  class="nav-item {{ active_class(['basic-ui/buttons']) }}">
            <a class="nav-link">Bad answer reports</a>
          </li>
          <li id="disabledCustomers" class="nav-item {{ active_class(['basic-ui/dropdowns']) }}">
            <a class="nav-link">Bad reply reports</a>
          </li>
        </ul>
      </div>
    </li>

    <li class="nav-item {{ active_class(['basic-ui/*']) }}">
      <a class="nav-link" data-toggle="collapse" href="#basic-questions" aria-expanded="{{ is_active_route(['basic-ui/*']) }}" aria-controls="basic-ui">
        <i class="menu-icon mdi mdi-comment-question-outline"></i>
        <span class="menu-title">Questions</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse {{ show_class(['basic-ui/*']) }}" id="basic-questions">
        <ul class="nav flex-column sub-menu">
          <li id="unapproved" class="nav-item {{ active_class(['basic-ui/dropdowns']) }}">
            <a class="nav-link">Unapproved questions</a>
          </li>
          <li id="approved" class="nav-item {{ active_class(['basic-ui/dropdowns']) }}">
            <a class="nav-link">Approved questions</a>
          </li>
          <li id="rejected" class="nav-item {{ active_class(['basic-ui/dropdowns']) }}">
            <a class="nav-link">Rejected questions</a>
          </li>
        </ul>
      </div>
    </li>

    
    <li id="tagscategories" class="nav-item">
      <a class="nav-link">
        <i class="menu-icon mdi mdi-folder-outline"></i>
        <span class="menu-title">Tags and categories</span>
      </a>
    </li>
    <li id="blogs" class="nav-item">
      <a class="nav-link">
        <i class="menu-icon mdi mdi-alphabetical"></i>
        <span class="menu-title">Blogs</span>
      </a>
    </li> --}}





    
    <li class="nav-item {{ active_class(['basic-ui/*']) }}">
      <a class="nav-link" data-toggle="collapse" href="#basic-ui" aria-expanded="{{ is_active_route(['basic-ui/*']) }}" aria-controls="basic-ui">
        <i class="menu-icon mdi mdi-dna"></i>
        <span class="menu-title">Basic UI Elements</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse {{ show_class(['basic-ui/*']) }}" id="basic-ui">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item {{ active_class(['basic-ui/buttons']) }}">
            <a class="nav-link" href="{{ url('/basic-ui/buttons') }}">Buttons</a>
          </li>
          <li class="nav-item {{ active_class(['basic-ui/dropdowns']) }}">
            <a class="nav-link" href="{{ url('/basic-ui/dropdowns') }}">Dropdowns</a>
          </li>
          <li class="nav-item {{ active_class(['basic-ui/typography']) }}">
            <a class="nav-link" href="{{ url('/basic-ui/typography') }}">Typography</a>
          </li>
        </ul>
      </div>
    </li>

    <li class="nav-item {{ active_class(['charts/chartjs']) }}">
      <a class="nav-link" href="{{ url('/charts/chartjs') }}">
        <i class="menu-icon mdi mdi-chart-line"></i>
        <span class="menu-title">Charts</span>
      </a>
    </li>
    <li class="nav-item {{ active_class(['tables/basic-table']) }}">
      <a class="nav-link" href="{{ url('/tables/basic-table') }}">
        <i class="menu-icon mdi mdi-table-large"></i>
        <span class="menu-title">Tables</span>
      </a>
    </li>
    <li class="nav-item {{ active_class(['icons/material']) }}">
      <a class="nav-link" href="{{ url('/icons/material') }}">
        <i class="menu-icon mdi mdi-emoticon"></i>
        <span class="menu-title">Icons</span>
      </a>
    </li>
    <li class="nav-item {{ active_class(['user-pages/*']) }}">
      <a class="nav-link" data-toggle="collapse" href="#user-pages" aria-expanded="{{ is_active_route(['user-pages/*']) }}" aria-controls="user-pages">
        <i class="menu-icon mdi mdi-lock-outline"></i>
        <span class="menu-title">User Pages</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse {{ show_class(['user-pages/*']) }}" id="user-pages">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item {{ active_class(['user-pages/login']) }}">
            <a class="nav-link" href="{{ url('/user-pages/login') }}">Login</a>
          </li>
          <li class="nav-item {{ active_class(['user-pages/register']) }}">
            <a class="nav-link" href="{{ url('/user-pages/register') }}">Register</a>
          </li>
          <li class="nav-item {{ active_class(['user-pages/lock-screen']) }}">
            <a class="nav-link" href="{{ url('/user-pages/lock-screen') }}">Lock Screen</a>
          </li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="https://www.bootstrapdash.com/demo/star-laravel-free/documentation/documentation.html" target="_blank">
        <i class="menu-icon mdi mdi-file-outline"></i>
        <span class="menu-title">Documentation</span>
      </a>
    </li>  
  </ul>
</nav>


@section('js')

<!-- script to show email templates -->
<script>
  $(document).ready(function(){
      var token = $('input[name="_token"]').val();
      function email_templates(){
          $.ajax({
            url:'{{route('emailTemplates')}}',
              cache:false,
              method:'GET',
              beforeSend: function()
              {  
                  $("#loading-overlay").show();
              },
              success:function(data){
                  $('#odda').empty();
                  $('#odda').append(data);
                  $("#loading-overlay").hide();
              }
          });
      }

      $('#email_templates').on('click',function(){
        email_templates();
      });
  });
</script>

<!-- script to show email accounts -->
<script>
  $(document).ready(function(){
      var token = $('input[name="_token"]').val();
      function emailAccounts(){
          $.ajax({
            url:'{{route('emailAccounts')}}',
              cache:false,
              method:'GET',
              beforeSend: function()
              {  
                  $("#loading-overlay").show();
              },
              success:function(data){
                  $('#odda').empty();
                  $('#odda').append(data);
                  $("#loading-overlay").hide();
              }
          });
      }

      $('#email_accounts').on('click',function(){
          emailAccounts();
      });
  });
</script>

{{-- sms messages  --}}
<script>
  $(document).ready(function(){
      var token = $('input[name="_token"]').val();
      function smsMessages(){
          $.ajax({
            url:'{{route('smsMessages')}}',
              cache:false,
              method:'GET',
              beforeSend: function()
              {  
                  $("#loading-overlay").show();
              },
              success:function(data){
                  $('#odda').empty();
                  $('#odda').append(data);
                  $("#loading-overlay").hide();
              }
          });
      }

      $('#sms_messages').on('click',function(){
          smsMessages();
      });
  });
</script>


<!-- script to show unapproved questions -->
<script>
    $(document).ready(function(){
        var token = $('input[name="_token"]').val();
        function unapprovedQuestions(){
            $.ajax({
              url:'{{route('unapprovedQuestions')}}',
                cache:false,
                method:'GET',
                beforeSend: function()
                {  
                    $("#loading-overlay").show();
                },
                success:function(data){
                    $('#odda').empty();
                    $('#odda').append(data);
                    $("#loading-overlay").hide();
                }
            });
        }

        $('#unapproved').on('click',function(){
            unapprovedQuestions();
        });
    });
</script>
<!-- script to show approved questions -->
<script>
    $(document).ready(function(){
        var token = $('input[name="_token"]').val();
        function approvedQuestions(){
            $.ajax({
              url:'{{route('approvedQuestions')}}',
                cache:false,
                method:'GET',
                beforeSend: function()
                {  
                    $("#loading-overlay").show();
                },
                success:function(data){
                    $('#odda').empty();
                    $('#odda').append(data);
                    $("#loading-overlay").hide();
                }
            });
        }

        $('#approved').on('click',function(){
            approvedQuestions();
        });
    });
</script>
<!-- script to show rejected questions -->
<script>
    $(document).ready(function(){
        var token = $('input[name="_token"]').val();
        function rejectedQuestions(){
            $.ajax({
              url:'{{route('rejectedQuestions')}}',
                cache:false,
                method:'GET',
                beforeSend: function()
                {  
                    $("#loading-overlay").show();
                },
                success:function(data){
                    $('#odda').empty();
                    $('#odda').append(data);
                    $("#loading-overlay").hide();
                }
            });
        }

        $('#rejected').on('click',function(){
            rejectedQuestions();
        });
    });
</script>
<!-- script to show categories and tags page -->
<script>
    $(document).ready(function(){
        var token = $('input[name="_token"]').val();
        function displyTagsCategories(){
            $.ajax({
              url:'{{route('categorytag')}}',
                cache:false,
                method:'GET',
                beforeSend: function()
                {  
                    $("#loading-overlay").show();
                },
                success:function(data){
                    $('#odda').empty();
                    $('#odda').append(data);
                    $("#loading-overlay").hide();
                }
            });
        }

        $('#tagscategories').on('click',function(){
            displyTagsCategories();
        });
    });
</script>

<!-- script to show blogs page -->
<script>
    $(document).ready(function(){
        var token = $('input[name="_token"]').val();
        function displyBlogs(){
            $.ajax({
              url:'{{route('blogs')}}',
                cache:false,
                method:'GET',
                beforeSend: function()
                {  
                    $("#loading-overlay").show();
                },
                success:function(data){
                    $('#odda').empty();
                    $('#odda').append(data);
                    $("#loading-overlay").hide();
                }
            });
        }

        $('#blogs').on('click',function(){
            displyBlogs();
        });
    });
</script>

@endsection

