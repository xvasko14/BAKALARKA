<!DOCTYPE html>
<html lang="en">
<head>
<title>Admin</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="{{ asset('css/backend_css/bootstrap.min.css') }}" />
<link rel="stylesheet" href="{{ asset('css/backend_css/bootstrap-responsive.min.css') }}" />
<link rel="stylesheet" href="{{ asset('css/backend_css/fullcalendar.css') }}" />
<link rel="stylesheet" href="{{ asset('css/backend_css/matrix-style.css') }}" />
<link rel="stylesheet" href="{{ asset('css/backend_css/matrix-media.css') }}" />
<link href="{{ asset('fonts/backend_fonts/css/font-awesome.css') }}"rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('css/backend_css/jquery.gritter.css') }}" />
<!--<link href="{{ asset('css/app.css') }}" rel="stylesheet">  PRIDANE ZO ZAKALDNEHO SUBORU --> 
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</head>
<body>

@include('layouts.adminLayout.admin_header')
@include('layouts.adminLayout.admin_sidebar')



@yield('obsah')

<!--end-main-container-part-->

@include('layouts.adminLayout.admin_footer')

<script src="{{ asset('js/backend_js/excanvas.min.js') }}"></script> 
<script src="{{ asset('js/backend_js//jquery.min.js') }}"></script> 
<script src="{{ asset('js/backend_js//jquery.ui.custom.js') }}"></script> 
<script src="{{ asset('js/backend_js//bootstrap.min.js') }}"></script> 
<script src="{{ asset('js/backend_js//jquery.flot.min.js') }}"></script> 
<script src="{{ asset('js/backend_js//jquery.flot.resize.min.js') }}"></script> 
<script src="{{ asset('js/backend_js//jquery.peity.min.js') }}"></script> 
<script src="{{ asset('js/backend_js//fullcalendar.min.js') }}"></script> 
<script src="{{ asset('js/backend_js//matrix.js') }}"></script> 
<script src="{{ asset('js/backend_js//matrix.dashboard.js') }}"></script> 
<script src="{{ asset('js/backend_js//jquery.gritter.min.js') }}"></script> 
<script src="{{ asset('js/backend_js//matrix.interface.js') }}"></script> 
<script src="{{ asset('js/backend_js//matrix.chat.js') }}"></script> 
<script src="{{ asset('js/backend_js//jquery.validate.js') }}"></script> 
<script src="{{ asset('js/backend_js//matrix.form_validation.js') }}"></script> 
<script src="{{ asset('js/backend_js//jquery.wizard.js') }}"></script> 
<script src="{{ asset('js/backend_js//jquery.uniform.js') }}"></script> 
<script src="{{ asset('js/backend_js//select2.min.js') }}"></script> 
<script src="{{ asset('js/backend_js//matrix.popover.js') }}"></script> 
<script src="{{ asset('js/backend_js//jquery.dataTables.min.js') }}"></script> 
<script src="{{ asset('js/backend_js//matrix.tables.js') }}"></script> 
<script src="{{ asset('js/app.js') }}" defer></script>   <!--PRIDANE ZO ZAKALDNEHO SUBORU-->
<script type="text/javascript">

  // This function is called from the pop-up menus to transfer to
  // a different page. Ignore if the value returned is a null string:
  function goPage (newURL) {

      // if url is empty, skip the menu dividers and reset the menu selection to default
      if (newURL != "") {
      
          // if url is "-", it is this page -- reset the menu:
          if (newURL == "-" ) {
              resetMenu();            
          } 
          // else, send page to designated URL            
          else {  
            document.location.href = newURL;
          }
      }
  }

// resets the menu selection upon entry to this page:
function resetMenu() {
   document.gomenu.selector.selectedIndex = 2;
}
</script>
</body>
</html>
