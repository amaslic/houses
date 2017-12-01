@include('layouts.header')
@include('layouts.nav')


<style>
    body, html {
    height: 100%;
    width: 100%;
    }
    .modal{
        z-index: 999;
    }
    .modal-backdrop{
        z-index: 990;
    }
    .modal-dialog{
        padding-top: 150px;
    }
    #map{

        min-height: 884px;
        height: 100%;
    }
</style>

<div class="container-main">
   
<form action="getpaths" method="post">
    <input type="text" name="day"  style="max-width:25px" />
    <input type="text" name="month"  style="max-width:25px" />
    <input type="text" name="year"  style="max-width:40px" />

</form>

</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>





         
@include('layouts.footer')



