<link href="http://code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css" rel="stylesheet">
<script src="http://code.jquery.com/jquery-1.11.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.1/jquery-ui.js"></script>

<style type="text/css">
  

table {
    border-spacing: collapse;
    border-spacing: 0;
}
td {
    width: 50px;
    height: 25px;
    border: 1px solid black;
}


</style>

<table>
    <tbody>
        <tr>
            <td>1</td>
            <td>2</td>
        </tr>
        <tr>
            <td>3</td>
            <td>4</td>
        </tr>
        <tr>
            <td>5</td>
            <td>6</td>
        </tr>
        <tr>
            <td>7</td>
            <td>8</td>
        </tr>
        <tr>
            <td>9</td>
            <td>10</td>
        </tr>  
    <tbody>    
</table>


<script>
    $('tbody').sortable();
</script>