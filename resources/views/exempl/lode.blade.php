<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Ajax $.Load Method Example of Loading Data from External File</title>

<script src="{{asset('assets/js/jquery.min.js')}}"></script>  
<script type="text/javascript">
$(document).ready(function(){
    $("button").click(function(){
                  //alert();
        //$("#output").load("/exopl");
    });
});
</script>
<style type="text/css" media="screen">
  .formClass
{
    padding: 15px;
    border: 12px solid #23384E;
    background: #28BAA2;
    margin-top: 10px;
}   
</style>
</head>
<body>
    <div class="formClass">
    <div id="output">
        <h2>Click button to load new content inside DIV box</h2>
    </div>
    <button type="button">Click to Load Content</button>
    <div>
</body>
</html>                            