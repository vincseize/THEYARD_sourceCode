<!doctype html>
<html>
<head>
<meta charset="utf-8">

<link href="jquery.multiselectTags.css" rel="stylesheet" type="text/css">
<style>
body { font-family:'Open Sans' Arial, Helvetica, sans-serif}
ul,li { margin:0; padding:0; list-style:none;}
.label { color:#000; font-size:16px;}
</style>
</head>
<body>
    

<h2>Tags</h2>
<select name="langOpt3[]" multiple id="langOpt3">




<option value="C++">Tag1</option>

        <select>
<option value='step1'/>step1</option>
<option value='step2'/>step2</option>
        </select>



<option value="C#">Tag2</option>
<option value="Java">Tag3</option>
<option value="Objective-C">Tag4</option>
<option value="JavaScript">Tag5</option>
<option value="Perl">Tag6</option>
<option value="PHP">Tag7</option>
<option value="Ruby on Rails">Tag8</option>
<option value="Android">Tag9</option>
<option value="iOS">Tag10</option>
<option value="HTML">Tag11</option>
<option value="XML">Tag12</option>
</select>


<script src="jquery.minTags.js"></script>
<script src="jquery.multiselectTags.js"></script>
<script>

$('#langOpt3').multiselect({
    columns: 1,
    placeholder: 'Select Tags',
    search: true,
    selectAll: true
});


</script>
</body>
</html>