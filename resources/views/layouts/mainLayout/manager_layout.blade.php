<!DOCTYPE html>
<html lang="en">
<head>

    @include('layouts.mainLayout.partials.main_head')
</head>
<body>

<div class="content">
@include('layouts.mainLayout.partials.manager_navbar')

    <div class="strip">
        <div class="container">
            <div id="MyClockDisplay" class="clock" onload="showTime()"></div>
            <script>
                function showTime(){
                    var date = new Date();
                    var h = date.getHours(); // 0 - 23
                    var m = date.getMinutes(); // 0 - 59
                    var s = date.getSeconds(); // 0 - 59
                    var session = "AM";

                    if(h == 0){
                        h = 12;
                    }

                    if(h > 12){
                        h = h - 12;
                        session = "PM";
                    }

                    h = (h < 10) ? "0" + h : h;
                    m = (m < 10) ? "0" + m : m;
                    s = (s < 10) ? "0" + s : s;

                    var time = h + ":" + m + ":" + s + " " + session;
                    document.getElementById("MyClockDisplay").innerText = time;
                    document.getElementById("MyClockDisplay").textContent = time;

                    setTimeout(showTime, 1000);

                }

                showTime();
            </script>

            <div class="social">
                <a href="https://www.facebook.com/groups/189044132827/" class="fa fa-facebook"></a>
                <a href="#" class="fa fa-instagram"></a>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
@yield('content')
</div>

<!--end-main-container-part-->

@include('layouts.mainLayout.partials.manager_footer')


<script  src="{{ asset('js/main_js/jquery.min.js') }}"></script>


<script  src="{{ asset('js/main_js/responsiveslides.min.js') }}"></script>


<!-- js -->
<script type="text/javascript">
</body>
</html>