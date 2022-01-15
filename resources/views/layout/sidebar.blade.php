
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
        <button id="sendSMS" class="btn btn-primary btn-block">Send Bulk SMS <i class="mdi mdi-plus"></i>
        </button>
      </div>
    </li>
    <li class="nav-item {{ active_class(['/']) }}">
      <a class="nav-link" href="{{ url('/') }}">
        <i class="menu-icon mdi mdi-television"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <li id="customers" class="nav-item {{ active_class(['charts/chartjs']) }}">
      <a class="nav-link">
        <i class="menu-icon mdi mdi-account-multiple-plus"></i>
        <span class="menu-title">All customers</span>
      </a>
    </li>
    <li id="targets" class="nav-item {{ active_class(['charts/chartjs']) }}">
      <a class="nav-link">
        <i class="menu-icon mdi mdi-application"></i>
        <span class="menu-title">Customers group</span>
      </a>
    </li>
    <li id="importCustomer" class="nav-item {{ active_class(['charts/chartjs']) }}">
      <a class="nav-link">
        <i class="menu-icon mdi mdi-download"></i>
        <span class="menu-title">Import customer</span>
      </a>
    </li>
    <li id="SMSReport" class="nav-item {{ active_class(['charts/chartjs']) }}">
      <a class="nav-link">
        <i class="menu-icon mdi mdi-checkbox-marked-circle-outline"></i>
        <span class="menu-title">Broadcast History</span>
      </a>
    </li>
    <li id="incomming" class="nav-item {{ active_class(['charts/chartjs']) }}">
      <a class="nav-link">
        <i class="menu-icon mdi mdi-checkbox-marked-circle-outline"></i>
        <span class="menu-title">Incomming SMS</span>
      </a>
    </li>
    <li id="auto_reply" class="nav-item {{ active_class(['charts/chartjs']) }}">
      <a class="nav-link">
        <i class="menu-icon mdi mdi-checkbox-marked-circle-outline"></i>
        <span class="menu-title">Auto reply SMS</span>
      </a>
    </li>
    
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

<!-- script to load send sms page -->
@section('js')
  <!-- script to load sms report page -->
  <script>
    $(document).ready(function(){
        var token = $('input[name="_token"]').val();
        function displaySMSReport(){
            $.ajax({
              url:'{{route('SMSReport')}}',
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

        $('#SMSReport').on('click',function(){
            displaySMSReport();
        });
    });
</script>

<script>
    $(document).ready(function(){
        var token = $('input[name="_token"]').val();
        function displaySendSMS(){
            $.ajax({
              url:'{{route('sendSMS')}}',
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

        $('#sendSMS').on('click',function(){
            displaySendSMS();
        });
    });
</script>


<!-- script to load import customer page -->
<script>
    $(document).ready(function(){
        var token = $('input[name="_token"]').val();
        function displayImportCustomer(){
            $.ajax({
              url:'{{route('importCustomer')}}',
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

        $('#importCustomer').on('click',function(){
            displayImportCustomer();
        });
    });
</script>

<!-- script to display all customers table -->
<script>
    $(document).ready(function(){
        var token = $('input[name="_token"]').val();
        function displayAllCustomer(){
            $.ajax({
              url:'{{route('customers')}}',
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

        $('#customers').on('click',function(){
            displayAllCustomer();
        });
    });
</script>

<!-- script to display all targets table -->
<script>
    $(document).ready(function(){
        var token = $('input[name="_token"]').val();
        function displayTargetsTable(){
            $.ajax({
              url:'{{route('targets')}}',
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

        $('#targets').on('click',function(){
            displayTargetsTable();
        });
    });
</script>

<!-- script to create a single contact -->
<script>
    $(document).ready(function(){
       // show create contact modal
       $('#createRecord').click(function(){
          $('#createRecordModal').modal('show');
      });
       // implementation when submit button is clicked from create contact modal
      $('#createRecordForm').on('submit', function(event){
          event.preventDefault();
          if($('#createContactBtn').val() == 'Create'){
              $.ajax({
                  url:"{{ route('api.createCustomer') }}",
                  method:"POST",
                  data: new FormData(this),
                  contentType:false,
                  cache:false,
                  processData:false,
                  dataType:'json',
                  beforeSend: function()
                  {
                      $('#createContactBtn').html('<i class="fa fa-circle-o-notch fa-spin"></i>');                            
                  },
                  success:function(data){
                      var html = '';
                      if(data.errors){
                          html = '<div class="alert alert-danger alert-block" style="height:30px;padding:2px;">';
                          for(var count = 0; count<data.errors.length; count++){
                              html += '<p>' + data.errors[count] + '</p>';
                          }
                          html += '</div>';
                          $('#createContactBtn').html('Create'); 
                      }
                      if(data.success){
                          html = '<div class = "alert alert-success alert-block" style="height:30px;padding:2px;">'
                          + data.success + '<button type="button" class="close" data-dismiss="alert">x</button</div>';
                          // empty form field values  
                          $('#createRecordForm')[0].reset();
                          $('#createContactBtn').html('Create');

                      }
                      // render error or success message in html variable to span element with id value form_result
                      $('#form_result').html(html);
                  }
              })
          }
      });
    });
</script>
@endsection

